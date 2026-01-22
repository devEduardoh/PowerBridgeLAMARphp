<?php
$option_state = '';
$zip_code = $_POST['zip_code'];

require_once '../../../../logic/conn_ms.php';

$sql_state = "SELECT DISTINCT CODE_STATE, STATE FROM pb_zip_address where ZIP_CODE = '$zip_code';";
$res_state = $mysqli->query($sql_state);
$val_res_state = $res_state->num_rows;

                        if($val_res_state == 1){
                            $row_state = mysqli_fetch_assoc($res_state);
                            $option_state .= '<option value="'.$row_state['CODE_STATE'].'" selected>'.$row_state['STATE'].'</option>';
                        }elseif($val_res_state > 1){
                            while($row_state = mysqli_fetch_assoc($res_state))
                                    {
                                        $option_state .= '<option value="'.$row_state['CODE_STATE'].'">'.$row_state['STATE'].'</option>';
                                    }
                        }else{
                            $option_state .= '<option value="" >No hay estados con el CP proporcionado</option>';
                        }   

echo $option_state;
?>