<?php

$sql_pl = "SELECT DISTINCT TOP 1 CONCAT(PL.ACADEMIC_TERM,'-',ACADEMIC_YEAR) PERIODO
                    , CD.LONG_DESC NIVEL
                    , CP.LONG_DESC PROGRAMA
                    , CC.LONG_DESC CARRERA
                    , ORG.ORG_CODE_ID 
                    , CCC.LONG_DESC CONCEPTO
                    , PL.AMOUNT
                    , CA.LONG_DESC CAMPUS
			FROM NG_PriceList PL
			INNER JOIN CODE_DEGREE CD ON PL.DEGREE = CD.CODE_VALUE_KEY
			INNER JOIN CODE_PROGRAM CP ON PL.PROGRAM = CP.CODE_VALUE_KEY
            INNER JOIN CODE_CURRICULUM CC ON PL.CURRICULUM = CC.CODE_VALUE_KEY
			INNER JOIN CODE_CHARGECREDIT CCC ON PL.CHARGE_CREDIT_CODE = CCC.CODE_VALUE_KEY
			INNER JOIN org_conversion ORG ON PL.ACADEMIC_SESSION = ORG.CODE_ACASESSION
            INNER JOIN CODE_ACASESSION CA ON PL.ACADEMIC_SESSION = CA.CODE_VALUE_KEY
            WHERE ACADEMIC_YEAR = '$anio' AND ACADEMIC_TERM = '$periodo' AND PL.ACADEMIC_SESSION = '$sesion' 
			AND DEGREE = '$nivel' AND PROGRAM = '$programa' AND PL.CURRICULUM = '$carrera'";

        

                        $get_pl = sqlsrv_query($conn, $sql_pl);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            $row_pl = sqlsrv_fetch_array($get_pl, SQLSRV_FETCH_ASSOC);

                                $monto_total = $row_pl['AMOUNT']-($row_pl['AMOUNT']*($porcentaje_beca/100));
                                $descuento = $porcentaje_beca."%";
                           

                            
                            $campus_org = $row_pl['ORG_CODE_ID'];
                            
                            echo '
                            <div class="table-responsive mt-1">
                            <table id="basic-table" class="table table-striped mb-0" role="grid">
                            <thead>
                                <tr>
                                <th>Periodo</th>
                                <th>Nivel</th>
                                <th>Programa</th>
                                <th>Carrera</th>
                                <th>Campus</th>
                                <th>Concepto Nvo. Ingreso</th>
                                <th>Monto Concepto</th>
                                <th>% Beca o Descuento</th>
                                <th>Monto a pagar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>'.$row_pl['PERIODO'].'</td>
                                    <td>'.$row_pl['NIVEL'].'</td>
                                    <td>'.$row_pl['PROGRAMA'].'</td>
                                    <td>'.$row_pl['CARRERA'].'</td>
                                    <td>'.$row_pl['CAMPUS'].'</td>
                                    <td>'.$row_pl['CONCEPTO'].'</td>
                                    <td>$ '.number_format($row_pl['AMOUNT'], 2).'</td>
                                    <th scope="col">'.$descuento.'</th>
                                    <td>$ '.number_format($monto_total, 2).'</td>
                                </tr>
                            </tbody>
                            </table>
                            </div>';
                            
                                        
                            
                        sqlsrv_free_stmt($get_pl);
                        sqlsrv_close($conn);
                        }   


?>