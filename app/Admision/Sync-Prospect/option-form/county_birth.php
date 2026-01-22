<?php
$option_county = '';
$edo_nac = $_POST['edo_nac'];

require_once '../../../../logic/conn_ms.php';

$sql = "SELECT DISTINCT PLACE_BIRTH, COUNTY FROM pb_code_placebirth WHERE CODE_STATE_CURP = '$edo_nac' ORDER BY COUNTY;";
$res = $mysqli->query($sql);
$val_res = $res->num_rows;

                        if($val_res == 1){
                            $row = mysqli_fetch_assoc($res);
                            $option_county .= '<option value="'.$row['PLACE_BIRTH'].'" selected>'.$row['COUNTY'].'</option>';
                        }elseif($val_res > 1){
                            while($row = mysqli_fetch_assoc($res))
                                    {
                                        $option_county .= '<option value="'.$row['PLACE_BIRTH'].'">'.$row['COUNTY'].'</option>';
                                    }
                        }else{
                            $option_county .= '<option value="" >No se identifico ningún municipio</option>';
                        }   

echo $option_county;

?>