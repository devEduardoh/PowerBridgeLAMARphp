<?php
$option_city = '';
$zip_code = $_POST['zip_code'];

require_once '../../../../logic/conn_ms.php';

$sql = "SELECT DISTINCT CITY from pb_zip_address where ZIP_CODE =  '$zip_code';";
$res = $mysqli->query($sql);
$val_res = $res->num_rows;

                        if($val_res == 1){
                            $row = mysqli_fetch_assoc($res);
                            $option_city .= '<option value="'.$row['CITY'].'" selected>'.$row['CITY'].'</option>';
                        }elseif($val_res > 1){
                            while($row = mysqli_fetch_assoc($res))
                                    {
                                        $option_city .= '<option value="'.$row['CITY'].'">'.$row['CITY'].'</option>';
                                    }
                        }else{
                            $option_city .= '<option value="" >No se identifico la ciudad</option>';
                        }   

echo $option_city;

?>