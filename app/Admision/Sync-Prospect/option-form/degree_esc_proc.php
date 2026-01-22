<?php

$sqlD = "SELECT CODE_VALUE_KEY, LONG_DESC from CODE_DEGREE where STATUS = 'A' AND CODE_VALUE_KEY != 'EDUCO' ORDER BY LONG_DESC ASC";

$getD = sqlsrv_query($conn, $sqlD);
                        if($getD == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            echo '<option value = "" selected> Seleccione nivel anterior</option>';
                            while($rowD = sqlsrv_fetch_array($getD, SQLSRV_FETCH_ASSOC))
                                    {
                                        echo '<option value="'.$rowD['CODE_VALUE_KEY'].'">'.$rowD['LONG_DESC'].'</option>';
                                    }
                        sqlsrv_free_stmt($getD);
                        //sqlsrv_close($conn);
                        }   

?>