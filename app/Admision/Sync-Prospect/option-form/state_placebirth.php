<?php

$sql_state = "SELECT DISTINCT CODE_STATE_CURP, STATE FROM pb_code_placebirth ORDER by STATE;;";
$res_state = $mysqli->query($sql_state);
$val_res_state = $res_state->num_rows;

                        if($val_res_state > 0){
                            while($row_state = mysqli_fetch_assoc($res_state))
                                    {
                                        echo '<option value="'.$row_state['CODE_STATE_CURP'].'">'.$row_state['STATE'].'</option>';
                                    }
                            
                        }else{
                            echo '<option value="" >No hay estados</option>';
                        }   
?>