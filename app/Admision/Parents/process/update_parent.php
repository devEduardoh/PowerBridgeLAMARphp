<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../../../logic/conn_ss.php';

$parent_type = $_POST['parentesco'];
$nombre = $_POST['nombre'];
$segNombre = $_POST['nombre2'];
$apPaterno = $_POST['apaterno'];
$apMaterno = $_POST['amaterno'];
$direccion = $_POST['calle'];
$colonia = $_POST['colonia'];
$cp = $_POST['zip_code'];
$ciudad = $_POST['ciudad'];
$municipio = $_POST['municipio'];
$estado = $_POST['estado'];
$celular = $_POST['telmov'];
$otroNumero = $_POST['telotro'];
$email = $_POST['correo'];
$lugarTrabajo = $_POST['trabajo'];
$userUpdate = $_POST['username'];
$ParentId = $_POST['ParentId'];
$id = $_POST['id'];
$update = 0;

$sql_update = "UPDATE NG_Parents
                SET PARENT_TYPE = '$parent_type'
                    ,FIRST_NAME = '$nombre'
                    ,MIDDLE_NAME = '$segNombre'
                    ,LAST_NAME = '$apPaterno'
                    ,Last_Name_Prefix = '$apMaterno'
                    ,ADDRESS_LINE_1 = '$direccion'
                    ,ADDRESS_LINE_2 = '$colonia'
                    ,ZIP_CODE = '$cp'
                    ,CITY = '$ciudad'
                    ,COUNTY = '$municipio'
                    ,STATE = '$estado'
                    ,CELPHONE = '$celular'
                    ,OTHERPHONE = '$otroNumero'
                    ,Email = '$email'
                    ,WORKPLACE = '$lugarTrabajo'
                    ,REVISION_DATE = CONVERT(DATE, GETDATE())
                    ,REVISION_TIME = CONVERT(TIME, GETDATE())
                    ,REVISION_OPID = '$userUpdate'
                WHERE ParentId = $ParentId";
//echo $sql_update;
//echo '<br><br><br>';

$get_u = sqlsrv_query($conn, $sql_update);
                    if($get_u == FALSE){
                        print_r(sqlsrv_errors());
                    }else{
                            $filas = sqlsrv_rows_affected($get_u); 
                            if ($filas === -1) {
                                $update = 2;
                            } else {
                                $update = 1;
                            } 
                        }
                        sqlsrv_free_stmt($get_u);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Redirigiendo...</title>
</head>
<body>
    <form id="redirigirForm" action="../parents.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <input type="hidden" name="update" value="<?php echo $update; ?>">
    </form>

    <script>
        document.getElementById("redirigirForm").submit();
    </script>
</body>
</html>
<?php 
}
?>
