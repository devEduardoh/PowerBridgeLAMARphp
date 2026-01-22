<?php

$sql = "SELECT DISTINCT TOP 1 ACADEMIC_YEAR FROM NG_PriceList ORDER BY ACADEMIC_YEAR DESC";

$get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            echo '<option value = "" selected> Seleccione el Año</option>';
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        echo '<option value="'.$row['ACADEMIC_YEAR'].'">'.$row['ACADEMIC_YEAR'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        //sqlsrv_close($conn);
                        }   

?>