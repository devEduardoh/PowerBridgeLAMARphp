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
FROM pb_logdispersion
WHERE idValida = $id_loteVal ORDER BY numLinea;";

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
        $numLineaP = $rowsProcess['numLinea'];
        $col1p = $rowsProcess['col1'];
        $col2p = $rowsProcess['col2'];
        $col3p = $rowsProcess['col3'];

        $spp = "DECLARE    @return_value int,
            @Status nvarchar(max),
            @Error nvarchar(max)

EXEC    @return_value = [dbo].[sp_NG_ProcesaDispPB]
        @BatchId = '$lote_procesa',
        @RecordId = '$numLineaP',
        @Column1 = '$col1p',
        @Column2 = '$col2p',
        @Column3 = '$col3p',
        @Status = @Status OUTPUT,
        @Error = @Error OUTPUT

        SELECT @Status as N'Estatus',
            @Error as N'DetError',
            @return_value as return_value;";
       
             //echo $spp. "<br>";
        
        $get_spp = sqlsrv_query($conn, $spp);
        if($get_spp == FALSE){
            $contPrDis['cont_ngPrDisErr'] ++;
            $contPrDis['detalle_err_ngPrDisp'] .= "Error en ProcesaDisp SP para línea $numLineaP: " . print_r(sqlsrv_errors(), true) . "<br>";
        }
        else{

        $res_spp = false;

        do {
            $res_spp = sqlsrv_fetch_array($get_spp, SQLSRV_FETCH_ASSOC);
            if($res_spp !== false && isset($res_spp['Estatus'])){
                break; // Encontramos el result set correcto
            }
            $res_spp = false;
        }while(sqlsrv_next_result($get_spp) !== false);
            
            if($res_spp !== false && isset($res_spp['Estatus'])){
                $estatus_sp = $res_spp['Estatus'] ?? '';
                $error_sp = $res_spp['DetError'] ?? '';
                $return_value = $res_spp['return_value'] ?? '';
                
                $contPrDis['cont_ngPrDisOk'] ++;

                // Escapar variables para la consulta MySQL
                $estatus_sp_escaped = $mysqli->real_escape_string($estatus_sp);
                $error_sp_escaped = $mysqli->real_escape_string($error_sp);
                $id_user_escaped = $mysqli->real_escape_string($id_user);

                // Inicia update en log dispersion
                $sql_uplog = "UPDATE pb_logdispersion
                            SET idProcesa = $lote_procesa,
                                numLineaProcesa = $numLineaP,
                                estatusProcesa = '$estatus_sp_escaped',
                                detalleProcesa = '$error_sp_escaped',
                                userProcesa = '$id_user_escaped',
                                dateProcesa = NOW()
                            WHERE id_log = $regBita;";
                        
                // Ejecutar la consulta de actualización
                if (mysqli_query($mysqli, $sql_uplog)) {
                    $contPrDis['cont_updlog'] ++;
                } else {
                    $contPrDis['cont_errUpdlog'] ++;
                    $contPrDis['detalle_err_Updlog'] .= "Error al actualizar en el log para línea $numLineaP: " . mysqli_error($mysqli) . "<br>";
                }

                sqlsrv_free_stmt($get_spp);
            }
            else{
                $contPrDis['cont_ngPrDisErr'] ++;
                $contPrDis['detalle_err_ngPrDisp'] .= "No se obtuvieron resultados del SP para línea $numLineaP<br>";
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