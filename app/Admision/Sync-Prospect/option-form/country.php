<?php
$option_country = '';
$zip_code = $_POST['zip_code'];


require_once '../../../../logic/conn_ms.php';

$sql = "SELECT DISTINCT CODE_COUNTRY from pb_zip_address where ZIP_CODE = '$zip_code';";
$res = $mysqli->query($sql);
$val_res = $res->num_rows;

                        if($val_res == 1){
                            $row = mysqli_fetch_assoc($res);
                                    
                                        $option_country .= '<option value="'.$row['CODE_COUNTRY'].'" selected>México</option>';
                        }else{
                            $option_country .= '<option value="" selected>No se identifico el país</option>';
                        }   

echo $option_country;
?>