<?php
$option_colony = '';
$zip_code = $_POST['zip_code'];

require_once '../../../../logic/conn_ms.php';

$sql = "SELECT DISTINCT COLONY from pb_zip_address where ZIP_CODE =  '$zip_code';";
$res = $mysqli->query($sql);
$val_res = $res->num_rows;

        if($val_res == 1){ 
            $row = mysqli_fetch_assoc($res);
            $option_colony .= '<option value="'.$row['COLONY'].'" selected>'.$row['COLONY'].'</option>';
        }elseif($val_res > 1){
            $option_colony .= '<option selected> Seleccione la colonia</option>';
            while($row = mysqli_fetch_assoc($res))
                                    {
                                        $option_colony .= '<option value="'.$row['COLONY'].'">'.$row['COLONY'].'</option>';
                                    }
        }else{
            $option_colony .= '<option value="" >No se identifico la colonia</option>';  
        }   

echo $option_colony;

?>