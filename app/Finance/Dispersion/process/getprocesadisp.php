<?php
function getProcesa($idlote, $conn) {
$rows_procesa = '';
$status_result = 0;
$err_ngprocesa = 0;
// Recuperamos consecutivo de PwC

$sql = "SELECT IdProcesa
        , NumLinea
        , AcademicYear
        , AcademicTerm
        , CA.LONG_DESC Academic_Session
        , IdPwC
        , Referencia
        , Campus
        , Sucursal
        , FormaPago
        , Amount
        , FORMAT(CAST(FechaPago AS DATETIME) + CAST(Hora AS DATETIME), 'dd/MM/yyyy HH:mm') AS FechaPago
        , StatusLinea
        , CONCAT(ValidaRegistro, ' Recibo No. ',ReceiptNumber) ValidaRegistro
        , DetalleError
        from NG_ProcesaDisp
        LEFT OUTER JOIN CODE_ACASESSION CA ON AcademicSession = CA.CODE_VALUE_KEY
        WHERE IdProcesa = $idlote ORDER BY NumLinea;";

$get = sqlsrv_query($conn, $sql);
if($get == FALSE){
    print_r(sqlsrv_errors());
}
else{
    while ($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC)) {
        
        if($row["StatusLinea"] != "A"){ $err_ngprocesa ++;}

        $rows_procesa .= "<tr>
                            <td>" . $row['IdProcesa'] . "</td>
                            <td>" . $row['NumLinea'] . "</td>
                            <td>" . $row['AcademicYear'] . "</td>
                            <td>" . $row['AcademicTerm'] . "</td>
                            <td>" . $row['Academic_Session'] . "</td>
                            <td>" . $row['IdPwC'] . "</td>
                            <td>" . $row['Campus'] . "</td>
                            <td>" . $row['Sucursal'] . "</td>
                            <td>" . $row['FormaPago'] . "</td>
                            <td>$" . number_format($row['Amount'], 2, '.', ',') . "</td>
                            <td>" . $row['FechaPago'] . "</td>
                            <td>" . $row['ValidaRegistro'] . "</td>
                            <td>" . $row['DetalleError'] . "</td>
                            </tr>";
        $status_result ++;
    }
    
    

}

sqlsrv_free_stmt($get);

return [
    'rows' => $rows_procesa,
    'status_result' => $status_result,
    'ERR_NGPROCESA' => $err_ngprocesa
];
}
?>