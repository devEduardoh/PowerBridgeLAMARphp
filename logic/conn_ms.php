<?php
/*
$ServerName = "10.0.1.6"; // 10.0.1.6
$Username = "app_upo"; // 
$Password = "APPC0retUP0&2025*";
$NameBD = "upo";
*/

$ServerName = "127.0.0.1"; // 10.0.1.6
$Username = "root"; // 
$Password = "";
$NameBD = "upo";

$mysqli=new mysqli($ServerName, $Username, $Password, $NameBD); 
$mysqli->set_charset("utf8");
mysqli_options($mysqli, MYSQLI_OPT_LOCAL_INFILE, true);
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}else{
        //echo 'Conexion Correcta';
    }
?>