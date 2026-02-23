<?php

function execute_NGDispersion($id_loteVal, $id_user, $conn, $mysqli, $lines) {

    $contPrDis = [
        'cont_ngPrDisOk' => 0,
        'cont_ngPrDisErr' => 0,
        'cont_updlog' => 0,
        'cont_errUpdlog' => 0,
        'detalle_err_ngPrDisp' => '' ,
        'detalle_err_Updlog' => '' 
    ];


// Se recuperan datos a procesar de bitácora en MySQL

$sql_rowsLog = "SELECT id_log
	, idValida
    , numLinea
    , col1
    , col2
    , col3
FROM lamar.pb_logdispersion
WHERE idValida = $id_loteVal;";

$res_rowsLog = $mysqli->query($sql_rowsLog) ;
$val_rowsLog = $res_rowsLog->num_rows;

// Recuperamos consecutivo de PwC

$sql = "SELECT TOP 1 IdProcesa, (IdProcesa + 1) lote from NG_ProcesaDisp order by IdProcesa DESC;";

$get = sqlsrv_query($conn, $sql);
if($get == FALSE){
    print_r(sqlsrv_errors());
}
else{
    $row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC);
            
    $lote_procesa = $row['lote'];
    sqlsrv_free_stmt($get);
}

// Si el consecutivo es valido, se recorren registros y se validan con el SP, de lo contrario se muestra error
if(intval($lote_procesa) != 0 and $val_rowsLog == $lines){




    while ($rowsProcess = mysqli_fetch_assoc($res_rowsLog)) {
    
        $regBita = $rowsProcess['id_log'];
        $numLinea = $rowsProcess['numLinea'];
        $col1 = $rowsProcess['col1'];
        $col2 = $rowsProcess['col2'];
        $col3 = $rowsProcess['col3'];

        $spp = "SET NOCOUNT ON;
        DECLARE    @return_value int,
        @Status nvarchar(max),
        @Error nvarchar(max)

EXEC    @return_value = [dbo].[sp_NG_ProcesaDispPB]
        @BatchId = '$lote_procesa',
        @RecordId = '$numLinea',
        @Column1 = '$col1',
        @Column2 = '$col2',
        @Column3 = '$col3',
        @Status = @Status OUTPUT,
        @Error = @Error OUTPUT

        SELECT @Status as N'Estatus',
            @Error as N'DetError',
            @return_value as return_value;";
       
            //echo $sp. "<br>";

        $get_spp = sqlsrv_query($conn, $spp);
        if($get_spp == FALSE){
            //print_r(sqlsrv_errors());
            $contPrDis['cont_ngPrDisErr'] ++;
            $contPrDis['detalle_err_ngPrDisp'] .= "Error en ProcesaDisp SP para línea $numLinea: " . print_r(sqlsrv_errors(), true) . "\n";
        }
        else{
            $res_sp = sqlsrv_fetch_array($get_spp, SQLSRV_FETCH_ASSOC);
        
            if($res_sp !== false && $res_sp !== null){
                $estatus_sp = $res_sp['Estatus'];
                $error_sp = $res_sp['DetError'];

                $contPrDis['cont_ngPrDisOk'] ++;

    // Inicia update en log dispersion
            
                $sql_uplog ="UPDATE pb_logdispersion
                                SET idProcesa = $lote_procesa
                                , numLineaProcesa = $numLinea
                                , estatusProcesa = '$estatus_sp'
                                , detalleProcesa = '$error_sp'
                                , userProcesa = '$id_user'
                                , dateProcesa = NOW()
                                WHERE id_log = $regBita;";
                        
                        
                // Ejecutar la consulta de inserción
                if (mysqli_query($mysqli, $sql_uplog)) {
                    //echo "Registro insertado correctamente en el log.";
                    $contPrDis['cont_updlog'] ++;
                } else {
                    //echo "Error al insertar en el log: " . mysqli_error($conn_mysql);
                    $contPrDis['cont_errUpdlog'] ++;
                    $contPrDis['detalle_err_Updlog'] .= "Error al actualizar en el log para línea $numLinea: " . mysqli_error($mysqli) . "\n";
            }
            
            sqlsrv_free_stmt($get_spp);

           
        }
    }
}
}

return [
    'lote_procesa' => $lote_procesa,
    'contadores' => $contPrDis
];

}
?>