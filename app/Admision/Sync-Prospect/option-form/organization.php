<?php
$optionOrganization = '<option value="">Selecciona la escuela de procedencia</option>';
$cct = $_POST['cct'];

 $search = str_replace(' ', '%', trim($cct));


require_once '../../../../logic/conn_ms.php';
/*
$sql = "SELECT ORG_ID, Code, SEVIS_SCHOOL_CODE FROM ORGANIZATION WHERE SEVIS_SCHOOL_CODE = '$cct'";

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $optionOrganization .= '<option value="'.$row['ORG_ID'].'">'.$row['Code'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        
                        }   
*/

$sql = "SELECT ORG_ID, CODE FROM upo.esc_proc WHERE CODE LIKE '%$search%'";
$res = $mysqli->query($sql);
$val_res = $res->num_rows;

if($val_res > 0){
    while($row = mysqli_fetch_assoc($res)){
        $optionOrganization .= '<option value="'.$row['ORG_ID'].'" selected>'.$row['CODE'].'</option>';
    }
    
}else{
    $optionOrganization .= '<option value="" >No se identifico la escuela de procedencia</option>';
}   

echo $optionOrganization;

?>