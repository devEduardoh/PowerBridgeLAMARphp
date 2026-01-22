<?php
$optionsSesion = '<option value="">Selecciona el campus</option>';
$anio = $_POST['anio'];
$periodo = $_POST['periodo'];

require_once '../../../../logic/conn_ss.php';

$sql = "SELECT DISTINCT PL.ACADEMIC_SESSION , CA.LONG_DESC CAMPUS  FROM NG_PriceList PL
            INNER JOIN CODE_ACASESSION CA ON PL.ACADEMIC_SESSION = CA.CODE_VALUE_KEY
            WHERE ACADEMIC_YEAR = '$anio' AND ACADEMIC_TERM = '$periodo'";

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $optionsSesion .= '<option value="'.$row['ACADEMIC_SESSION'].'">'.$row['CAMPUS'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        sqlsrv_close($conn);
                        }   

echo $optionsSesion;

?>