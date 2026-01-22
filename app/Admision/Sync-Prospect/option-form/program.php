<?php
$options_program = '<option value="">Selecciona el programa</option>';
$session = $_POST['sesion'];
$periodo = $_POST['periodo'];
$anio = $_POST['anio'];
$nivel = $_POST['nivel'];

require_once '../../../../logic/conn_ss.php';

$sql = "SELECT DISTINCT PL.PROGRAM , CP.LONG_DESC PROGRAMA  FROM NG_PriceList PL
            INNER JOIN CODE_PROGRAM CP ON PL.PROGRAM = CP.CODE_VALUE_KEY
            WHERE ACADEMIC_YEAR = '$anio' AND ACADEMIC_TERM = '$periodo' AND PL.ACADEMIC_SESSION = '$session' AND DEGREE = '$nivel'";

            echo $sql;
        

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $options_program .= '<option value="'.$row['PROGRAM'].'">'.$row['PROGRAMA'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        sqlsrv_close($conn);
                        }   

echo $options_program;

?>