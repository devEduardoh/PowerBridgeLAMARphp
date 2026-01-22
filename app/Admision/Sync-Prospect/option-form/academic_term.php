<?php
$optionsPeriodo = '<option value="">Selecciona Periodo</option>';
$anio = $_POST['anio'];

require_once '../../../../logic/conn_ss.php';

$sql = "SELECT DISTINCT ACADEMIC_TERM, CONCAT('Campaña C',CA.CODE_XDESC, ' (',PL.ACADEMIC_TERM,')') AS PERIODO FROM NG_PriceList PL
            INNER JOIN CODE_ACATERM CA ON PL.ACADEMIC_TERM = CA.CODE_VALUE_KEY
            WHERE ACADEMIC_YEAR = '$anio' AND ACADEMIC_TERM IN ('2S', '3C')  ORDER BY PL.ACADEMIC_TERM DESC;";

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $optionsPeriodo .= '<option value="'.$row['ACADEMIC_TERM'].'">'.$row['PERIODO'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        sqlsrv_close($conn);
                        }   

echo $optionsPeriodo;
?>