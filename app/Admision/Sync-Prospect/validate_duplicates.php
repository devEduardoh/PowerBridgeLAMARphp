<?php

//$curp = "AEAA061220MMCRGRA1";
$curp_12 = substr( $curp,0,12);

$sql_alum = "SELECT LegalName, GOVERNMENT_ID, PE.PEOPLE_CODE_ID FROM PEOPLE PE
INNER JOIN PEOPLETYPE PET ON PE.PEOPLE_CODE_ID = PET.PEOPLE_CODE_ID AND PET.PEOPLE_TYPE IN ('STUD','APP')
WHERE GOVERNMENT_ID = '$curp'";


$sql_dup_alum = "SELECT LegalName, GOVERNMENT_ID, PE.PEOPLE_CODE_ID FROM PEOPLE PE
INNER JOIN PEOPLETYPE PET ON PE.PEOPLE_CODE_ID = PET.PEOPLE_CODE_ID AND PET.PEOPLE_TYPE IN ('STUD','APP')
WHERE SUBSTRING(GOVERNMENT_ID,1,12) = '$curp_12'";





$get = sqlsrv_query($conn, $sql_alum);
$alum = sqlsrv_has_rows( $get );

$get2 = sqlsrv_query($conn, $sql_dup_alum);
$alum_dupli = sqlsrv_has_rows( $get2 );

if($alum  === True){    
    if($get == FALSE){
        print_r(sqlsrv_errors());
    }
    else{
        echo '<div class="table-responsive mt-">
            <table id="basic-table" class="table table-striped mb-0" role="grid">
                <thead>
                        <tr>
                            <th scope="col" colspan="3">Alumno existente CURP: '.$curp.'</th>
                        </tr>
                    <tr>
                    <th scope="col">Alumno</th>
                    <th scope="col">Id PowerCampus</th>
                    <th scope="col">CURP</th>
                    </tr>
                </thead>
                <tbody>';
        while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                {
                    echo '<tr>
                            <td>'.$row['LegalName'].'</td>
                            <td>'.$row['PEOPLE_CODE_ID'].'</td>
                            <td><b>'.$row['GOVERNMENT_ID'].'</b></td>
                        </tr>';
                }
                echo '<tr>
                                <td colspan="3"><a href="javascript:window.history.back();"><button type="submit" class="btn btn-primary">Regresar a la captura</button></a></td>
                            </tr>
                    </tbody>
                    </table>
                    </div>';

    sqlsrv_free_stmt($get);
    //sqlsrv_close($conn);
    }   
}elseif($alum_dupli === True){

        if($get2 == FALSE){
            print_r(sqlsrv_errors());
        }
        else{
            echo '<div class="table-responsive mt-1">
            <table id="basic-table" class="table table-striped mb-0" role="grid">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3">Posibles duplicados CURP: '.$curp.'</th>
                        </tr>
                        <tr>
                        <th scope="col">Alumno</th>
                        <th scope="col">Id PowerCampus</th>
                        <th scope="col">CURP</th>
                        </tr>
                    </thead>
                    <tbody>';
            while($row2 = sqlsrv_fetch_array($get2, SQLSRV_FETCH_ASSOC))
                    {
                        echo '<tr>
                                <td>'.$row2['LegalName'].'</td>
                                <td>'.$row2['PEOPLE_CODE_ID'].'</td>
                                <td><b>'.$row2['GOVERNMENT_ID'].'</b></td>
                            </tr>';
                    }
                    echo '<tr>
                                <td colspan="3"><a href="javascript:window.history.back();"><button type="submit" class="btn btn-primary">Regresar a la captura</button></a></td>
                            </tr>
                        </tbody>
                        </table>
                        </div>';
    
        sqlsrv_free_stmt($get2);
        sqlsrv_close($conn);
        }   
    
}else{
        echo '<div class="alert alert-info" role="alert">
                    No hay coincidencias por la CURP: <b>'.$curp.'</b>
            </div>';
}
?>

