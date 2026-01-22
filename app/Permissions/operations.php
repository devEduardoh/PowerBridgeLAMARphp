<?php 
// Recupera menus de acceso por usuario desde la base de datos

function getUserOperations($mysqli, $id_user, $id_menu) {

    // Sanitizar parámetro por seguridad
    $id_user = intval($id_user);

    $sql = "SELECT DISTINCT
            u.iduser
            , u.names
            , u.surnames
            , pe.id_areamenu
            , pe.id_operation
            , op.operation_description
            , op.operation_legend
            , op.route_operation 
            FROM pb_user u
            INNER JOIN pb_user_permissions pe on u.iduser = pe.id_user
            INNER JOIN pb_areamenu me on pe.id_areamenu = me.id_areamenu
            INNER JOIN pb_area_operations op on pe.id_operation = op.id_operation
            WHERE u.iduser = $id_user and pe.id_areamenu = $id_menu";

    $result = mysqli_query($mysqli, $sql);

    // Si ocurre error en la consulta
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($mysqli));
    }
    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $options.= '<div class=" d-flex profile-media align-items-top mb-2">
                     <div class="profile-dots-pills border-primary mt-1"></div>
                     <div class="ms-4">
                        <a href="'.$row['route_operation'].'" target="frame-cont"><h6 class=" mb-1">'.$row['operation_description'].'</h6></a>
                        <span class="mb-0" style="font-size: x-small;">'.$row['operation_description'].'</span>
                     </div>
                  </div>';
    }

    return $options; // Devuelve texto con los menus en formato HTML
}
?>