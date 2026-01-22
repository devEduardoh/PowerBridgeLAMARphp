<?php 
// Recupera menus de acceso por usuario desde la base de datos

function getUserMenus($mysqli, $id_user, $id_menu) {

    // Sanitizar parámetro por seguridad
    $id_user = intval($id_user);

    $sql = "SELECT DISTINCT
                u.iduser,
                u.names,
                u.surnames,
                me.id_areamenu,
                me.description,
                me.route
            FROM pb_user u
            INNER JOIN pb_user_permissions pe ON u.iduser = pe.id_user
            INNER JOIN pb_areamenu me ON pe.id_areamenu = me.id_areamenu
            WHERE u.iduser = $id_user";

    $result = mysqli_query($mysqli, $sql);

    // Si ocurre error en la consulta
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($mysqli));
    }
    if($id_menu != 0){
        $menus = '<li class="nav-item"><a class="nav-link " href="../../app">Inicio</a></li>';
    } else {
        $menus = '';
    }
    while ($row = mysqli_fetch_assoc($result)) {
        if($id_menu == $row['id_areamenu']){
            continue; // Saltar el menú actual
        }
        $menus.= '<li class="nav-item"><a class="nav-link " href="'.$row['route'].'?m='.$row['id_areamenu'].'">'.$row['description'].' </a></li>';
    }
    return $menus; // Devuelve texto con los menus en formato HTML
}
?>