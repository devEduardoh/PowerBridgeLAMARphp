<?php

$sql = "SELECT CODE_VALUE_KEY, LONG_DESC FROM CODE_POSITION WHERE STATUS = 'A' ORDER BY LONG_DESC";

$get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            echo '<option value = "" selected> Seleccione la posición del empleo</option>';
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        echo '<option value="'.$row['CODE_VALUE_KEY'].'">'.$row['LONG_DESC'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        //sqlsrv_close($conn);
                        }   

?>