<?php

function execute_NGValida($datos, $id_user, $name_file ,$conn, $mysqli) {

    $contadores = [
        'cont_ngvalok' => 0,
        'cont_ngvalerr' => 0,
        'cont_insertlog' => 0,
        'cont_errlog' => 0,
        'detalle_err_ngval' => '' ,
        'detalle_err_log' => '' 
    ];



// Recuperamos consecutivo de PwC

$sql = "SELECT TOP 1 idValida, (idValida + 1) lote from NG_ValidaDisp order by idValida DESC;";

$get = sqlsrv_query($conn, $sql);
if($get == FALSE){
    print_r(sqlsrv_errors());
}
else{
    $row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC);
            
    $lote_valida = $row['lote'];
    sqlsrv_free_stmt($get);
}

// Si el consecutivo es valido, se recorren registros y se validan con el SP, de lo contrario se muestra error
if(intval($lote_valida) != 0){

    foreach ($datos as $linea) {
    
        $numLinea = $linea['linea'];
        $col1 = $linea['columna1'];
        $col2 = $linea['columna2'];
        $col3 = $linea['columna3'];

        $sp = "SET NOCOUNT ON;
                DECLARE	@return_value int,
                @Status nvarchar(max),
                @Error nvarchar(max)

            EXEC	@return_value = [dbo].[sp_NG_ValidaDispPB]
                @BatchId = '$lote_valida',
                @RecordId = '$numLinea',
                @Column1 = '$col1',
                @Column2 = '$col2',
                @Column3 = '$col3',
                @Status = @Status OUTPUT,
                @Error = @Error OUTPUT

        SELECT @Status as N'Estatus',
            @Error as N'DetError',
            @return_value as return_value;";
       

        $get_sp = sqlsrv_query($conn, $sp);
        if($get_sp == FALSE){
            //print_r(sqlsrv_errors());
            $contadores['cont_ngvalerr'] ++;
            $contadores['detalle_err_ngval'] .= "Error en validación SP para línea $numLinea: " . print_r(sqlsrv_errors(), true) . "\n";
        }
        else{
            $res_sp = sqlsrv_fetch_array($get_sp, SQLSRV_FETCH_ASSOC);
        
            if($res_sp !== false && $res_sp !== null){
                $estatus_sp = $res_sp['Estatus'];
                $error_sp = $res_sp['DetError'];

                $contadores['cont_ngvalok'] ++;

    // Inicia inserccíón en log
            
                $sql_inlog ="INSERT INTO pb_logdispersion
                            (   archivo,
                                idValida,
                                numLinea,
                                col1,
                                col2,
                                col3,
                                estatusValida,
                                detalleValida,
                                userValida,
                                dateValida)
                                VALUES
                                ('$name_file',
                                $lote_valida,
                                 $numLinea,
                                '$col1',
                                '$col2',
                                '$col3',
                                '$estatus_sp',
                                '$error_sp',
                                '$id_user',
                                NOW()); ";
                        
                        // echo $sql_inlog;
                        // echo "<br>";

                // Ejecutar la consulta de inserción
                if (mysqli_query($mysqli, $sql_inlog)) {
                    //echo "Registro insertado correctamente en el log.";
                    $contadores['cont_insertlog'] ++;
                } else {
                    //echo "Error al insertar en el log: " . mysqli_error($conn_mysql);
                    $contadores['cont_errlog'] ++;
                    $contadores['detalle_err_log'] .= "Error al insertar en el log para línea $numLinea: " . mysqli_error($mysqli) . "\n";
            }
            
            sqlsrv_free_stmt($get_sp);

           
        }
    }
}
}

return [
    'lote_valida' => $lote_valida,
    'contadores' => $contadores
];

}
?>