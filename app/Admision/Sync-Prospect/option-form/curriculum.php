<?php
$options_curriculum = '<option value="">Selecciona la carrera</option>';
$session = $_POST['sesion'];
$periodo = $_POST['periodo'];
$anio = $_POST['anio'];
$nivel = $_POST['nivel'];
$programa = $_POST['programa'];

require_once '../../../../logic/conn_ss.php';

$sql = "SELECT DISTINCT PL.CURRICULUM , CC.LONG_DESC CARRERA  FROM NG_PriceList PL
            INNER JOIN CODE_CURRICULUM CC ON PL.CURRICULUM = CC.CODE_VALUE_KEY
            WHERE ACADEMIC_YEAR = '$anio' AND ACADEMIC_TERM = '$periodo' AND PL.ACADEMIC_SESSION = '$session' 
			AND DEGREE = '$nivel' AND PROGRAM = '$programa'";

            echo $sql;
        

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $options_curriculum .= '<option value="'.$row['CURRICULUM'].'">'.$row['CARRERA'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        sqlsrv_close($conn);
                        }   

echo $options_curriculum;

?>