<?php
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 } else {
   $ip = $_SERVER['REMOTE_ADDR'];
 }
 if($ip == '::1' OR $ip == '200.52.75.186' OR $ip == '10.0.1.21' OR $ip == '10.0.1.6' OR $ip == '127.0.0.1' or $ip == '187.188.103.121' or $ip == '192.168.1.13')
 {
require('../conn_ms.php');	
$error = '';
if(!empty($_POST)){
    $usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
    $password = mysqli_real_escape_string($mysqli,$_POST['password']);
   

    $sql = "SELECT u.*
            , a.description_area
            FROM pb_user u 
            INNER JOIN pb_area a ON u.area = a.area
            WHERE username = '$usuario';";
    $result = $mysqli -> query ($sql);
    $users = $result -> num_rows;

    if($users == 1) {
        $row = $result -> fetch_assoc();
        $id_user = $row['iduser'];
        $row['username'];
        $row['pass_temp'];
        $row['pass'];
        
        $pass_temp = $row['pass_temp'];
        

        if(!$is_date AND $row['pass'] == ''){
    
            header("Location:upd_pass.php?u_=$id_user");

        }elseif($row['pass_temp'] != '' AND $row['pass'] != ''){
            $hash = $row['pass'];
            if(password_verify($password, $hash)){
                    session_start();
                    //echo "Sesion Iniciada";
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['names'] = $row['names'];
                    $_SESSION['surnames'] = $row['surnames'];
                    $_SESSION['iduser'] = $row['iduser'];
                    $_SESSION['d_area'] = $row['description_area'];
                    header("Location: ../../app/");

            }else{
            //echo $error = 1; // 'Contraseña incorrecta, verifique sus credenciales'
            header("Location:../../?error=1");
            exit();
        }
        }elseif(strpos($row['pass_temp'], 'Inactivo') !== false){
            //echo $error = 7; // 'Usuario Inactivo. Contacte al administrador del sistema'
            header("Location:../../?error=7");
            exit();
        }else{
            //echo $error = 3; // 'Contraseña incorrecta. <br> Solicité por favor restablecer su contraseña al administrador del sistema.'
            header("Location:../../?error=3");
            exit();
        }

  } else{
      //echo $error = 2; // 'Usuario o contraseña incorrectos, verifique sus credenciales'
      header("Location:../../?error=2");
      exit();
  }
}else{
    //echo $error = 6; // 'No se enviaron datos de acceso'
    header("Location:../../?error=6");
}

 }
?>