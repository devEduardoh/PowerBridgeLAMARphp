<?php

$sql = "SELECT CODE_VALUE_KEY, LONG_DESC TURNO FROM CODE_FULLPARTFLAG where STATUS = 'A'";

$get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            echo '<option value = "" selected> Seleccione el Turno</option>';
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        echo '<option value="'.$row['CODE_VALUE_KEY'].'">'.$row['TURNO'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        
                        }   

?>