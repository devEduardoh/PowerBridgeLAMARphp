<?php
$option_county = '';
$zip_code = $_POST['zip_code'];

require_once '../../../../logic/conn_ms.php';

$sql = "SELECT DISTINCT COUNTY from pb_zip_address where ZIP_CODE =  '$zip_code';";
$res = $mysqli->query($sql);
$val_res = $res->num_rows;

                        if($val_res == 1){
                            $row = mysqli_fetch_assoc($res);
                            $option_county .= '<option value="'.$row['COUNTY'].'" selected>'.$row['COUNTY'].'</option>';
                        }elseif($val_res > 1){
                            while($row = mysqli_fetch_assoc($res))
                                    {
                                        $option_county .= '<option value="'.$row['COUNTY'].'">'.$row['COUNTY'].'</option>';
                                    }
                        }else{
                            $option_county .= '<option value="" >No se identifico el municipio</option>';
                        }   

echo $option_county;

?>