<?php
include '../../../../logic/conn_ms.php';

// Numero de registros
$numero_de_registros = 1000;

if(!isset($_POST['palabraClave'])){

	// Obtener registros
	$stmt = $db->prepare("SELECT ORG_ID, CODE FROM upo.esc_proc ORDER BY ORG_ID LIMIT :limit");
	$stmt->bindValue(':limit', (int)$numero_de_registros, PDO::PARAM_INT);
	$stmt->execute();
	$usersList = $stmt->fetchAll();

}else{

	$search = $_POST['palabraClave'];// Palabra a buscar
	// Obtener registros
	$stmt = $db->prepare("SELECT ORG_ID, CODE FROM upo.esc_proc WHERE CODE like :CODE ORDER BY CODE LIMIT :limit");
	$stmt->bindValue(':CODE', '%'.$search.'%', PDO::PARAM_STR);
	$stmt->bindValue(':limit', (int)$numero_de_registros, PDO::PARAM_INT);
	$stmt->execute();
	$usersList = $stmt->fetchAll();

}
	
$response = array();

// Leer la informacion
foreach($escproc as $escuela){
	$response[] = array(
		"id" => $escuela['ORG_ID'],
		"text" => $escuela['CODE']
	);
}

echo json_encode($response);
exit();