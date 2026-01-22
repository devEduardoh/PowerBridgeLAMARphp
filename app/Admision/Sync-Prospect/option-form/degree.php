<?php
$options_degree = '<option value="">Selecciona el nivel</option>';
$session = $_POST['sesion'];
$periodo = $_POST['periodo'];
$anio = $_POST['anio'];
require_once '../../../../logic/conn_ss.php';

$sql = "SELECT DISTINCT PL.DEGREE , CD.LONG_DESC NIVEL  FROM NG_PriceList PL
            INNER JOIN CODE_DEGREE CD ON PL.DEGREE = CD.CODE_VALUE_KEY
            WHERE ACADEMIC_YEAR = '$anio' AND ACADEMIC_TERM = '$periodo' AND PL.ACADEMIC_SESSION = '$session'";

            echo $sql;
        

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $options_degree .= '<option value="'.$row['DEGREE'].'">'.$row['NIVEL'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        sqlsrv_close($conn);
                        }   

echo $options_degree;

?>