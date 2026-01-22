<?php
// Afuera https://pbi.icel.edu.mx/WSNacerCRM-PwC92_UPO/WSNACER1.asmx?op=ProspectoNacerPwc
// Local http://localhost:8084/WSNacerCRM-PwC92_UPOV2/WSNACER1.asmx?op=ProspectoNacerPwc

if(!empty($_POST)) {

//$county = strval($_POST['Municipio']);

//$xmlBody = '';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost:8083/ProdNG/IntegrationsNG/WSNacerCRM-PwC92_UPOV2/WSNACER1.asmx?op=ProspectoNacerPwc',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ProspectoNacerPwc xmlns="http://tempuri.org/">
      <Nombre>'.$_POST['Nombre'].'</Nombre>
      <SegundoNombre>'.$_POST['SegundoNombre'].'</SegundoNombre>
      <ApellidoPaterno>'.$_POST['ApellidoPaterno'].'</ApellidoPaterno>
      <ApellidoMaterno>'.$_POST['ApellidoMaterno'].'</ApellidoMaterno>
      <NombreCompleto>'.$_POST['NombreCompleto'].'</NombreCompleto>
      <Matricula>'.$_POST['Matricula'].'</Matricula>
      <TelMovil>'.$_POST['TelMovil'].'</TelMovil>
      <TelCasa>'.$_POST['TelCasa'].'</TelCasa>
      <CorreoElectronico>'.$_POST['CorreoElectronico'].'</CorreoElectronico>
      <Curp>'.$_POST['Curp'].'</Curp>
      <Calle>'.$_POST['Calle'].'</Calle>
      <Numero>'.$_POST['Numero'].'</Numero>
      <Colonia>'.$_POST['Colonia'].'</Colonia>
      <Ciudad>'.$_POST['Ciudad'].'</Ciudad>
      <Estado>'.$_POST['Estado'].'</Estado>
      <CodigoPostal>'.$_POST['CodigoPostal'].'</CodigoPostal>
      <Pais>'.$_POST['Pais'].'</Pais>
      <Municipio>'.$_POST['Municipio'].'</Municipio>
      <EstadoCivil>'.$_POST['EstadoCivil'].'</EstadoCivil>
      <Genero>'.$_POST['Genero'].'</Genero>
      <FechaNacimiento>'.$_POST['FechaNacimiento'].'</FechaNacimiento>
      <NivelAcademico>'.$_POST['NivelAcademico'].'</NivelAcademico>
      <ProgramaAcademico>'.$_POST['ProgramaAcademico'].'</ProgramaAcademico>
      <Ciclo>'.$_POST['Ciclo'].'</Ciclo>
      <Anio>'.$_POST['Anio'].'</Anio>
      <Periodo>'.$_POST['Periodo'].'</Periodo>
      <Sesion>'.$_POST['Sesion'].'</Sesion>
      <Grado>'.$_POST['Grado'].'</Grado>
      <Curriculo>'.$_POST['Curriculo'].'</Curriculo>
      <Estatus>INSC</Estatus>
      <Decision>PEND</Decision>
      <Campus>'.$_POST['Campus'].'</Campus>
      <TurnoUPO>'.$_POST['TurnoUPO'].'</TurnoUPO>
      <TipoDireccion>CASA</TipoDireccion>
      <TipoCorreoInst></TipoCorreoInst>
      <CorreoElecInst></CorreoElecInst>
      <TipoCorreoPers>PERSONAL</TipoCorreoPers>
      <PaisTelMovil>MEXICO</PaisTelMovil>
      <TipoTelMovil>CEL</TipoTelMovil>
      <PaisTelCasa>MEXICO</PaisTelCasa>
      <TipoTelCasa>CASA</TipoTelCasa>
      <universidad>UPotosina</universidad>
      <idoportunidadCRM>'.$_POST['idoportunidadCRM'].'</idoportunidadCRM>
      <promedio>'.$_POST['promedio'].'</promedio>
      <modulo></modulo>
      <modalidad></modalidad>
      <turno>'.$_POST['turno'].'</turno>
      <tipobeca></tipobeca>
      <porBeca></porBeca>
      <porDesc></porDesc>
      <clvebeca>'.$_POST['clvebeca'].'</clvebeca>
      <clvedesc></clvedesc>
      <aplicaA></aplicaA>
      <Bono></Bono>
      <tipoIngreso>'.$_POST['tipoIngreso'].'</tipoIngreso>
      <descaplica></descaplica>
      <fechalimpago>'.$_POST['fechalimpago'].'</fechalimpago>
      <clvebeca2>'.$_POST['clvebeca2'].'</clvebeca2>
      <porcdesc2></porcdesc2>
      <tipodecurso></tipodecurso>
      <En_Accidente_Avisar>'.$_POST['En_Accidente_Avisar'].'</En_Accidente_Avisar>
      <Telefono_En_Accidente_Avisar>'.$_POST['Telefono_En_Accidente_Avisar'].'</Telefono_En_Accidente_Avisar>
      <Natal_Pais>'.$_POST['Natal_Pais'].'</Natal_Pais>
      <Natal_Ciudad_Estado>'.$_POST['Natal_Ciudad_Estado'].'</Natal_Ciudad_Estado>
      <Escuela_Procedencia>'.$_POST['Escuela_Procedencia'].'</Escuela_Procedencia>
      <Grado_Escuela_Procedencia>'.$_POST['Grado_Escuela_Procedencia'].'</Grado_Escuela_Procedencia>
      <Tut_Nombre>'.$_POST['Tut_Nombre'].'</Tut_Nombre>
      <Tut_Direccion>'.$_POST['Tut_Direccion'].'</Tut_Direccion>
      <Tut_Colonia>'.$_POST['Tut_Colonia'].'</Tut_Colonia>
      <Tut_Ciudad>'.$_POST['Tut_Ciudad'].'</Tut_Ciudad>
      <Tut_Estado>'.$_POST['Tut_Estado'].'</Tut_Estado>
      <Tut_CP>'.$_POST['Tut_CP'].'</Tut_CP>
      <Tut_Telefono_1>'.$_POST['Tut_Telefono_1'].'</Tut_Telefono_1>
      <Tut_Telefono_2>'.$_POST['Tut_Telefono_2'].'</Tut_Telefono_2>
      <Tut_Correo>'.$_POST['Tut_Correo'].'</Tut_Correo>
      <Tut_LugarTrabajo>'.$_POST['Tut_LugarTrabajo'].'</Tut_LugarTrabajo>
      <Emp_Empresa>'.$_POST['Emp_Empresa'].'</Emp_Empresa>
      <Emp_Ciudad>'.$_POST['Emp_Ciudad'].'</Emp_Ciudad>
      <Emp_CP>'.$_POST['Emp_CP'].'</Emp_CP>
      <Emp_Estado>'.$_POST['Emp_Estado'].'</Emp_Estado>
      <Emp_Colonia>'.$_POST['Emp_Colonia'].'</Emp_Colonia>
      <Emp_Direccion>'.$_POST['Emp_Direccion'].'</Emp_Direccion>
      <Emp_Posicion>'.$_POST['Emp_Posicion'].'</Emp_Posicion>
      <Emp_FechaIngreso>'.$_POST['Emp_FechaIngreso'].'</Emp_FechaIngreso>
      <Asesor_Neotel>'.$_POST['Asesor_Neotel'].'</Asesor_Neotel>
      <Sa_TipoSangre>'.$_POST['Sa_TipoSangre'].'</Sa_TipoSangre>
      <Sa_Enfermedades>'.$_POST['Sa_Enfermedades'].'</Sa_Enfermedades>
      <Sa_Alergias>'.$_POST['Sa_Alergias'].'</Sa_Alergias>
      <Pa_Tipo>'.$_POST['Pa_Tipo'].'</Pa_Tipo>
      <Pa_Nombre>'.$_POST['Pa_Nombre'].'</Pa_Nombre>
      <Pa_SegundoNombre>'.$_POST['Pa_SegundoNombre'].'</Pa_SegundoNombre>
      <Pa_ApellidoPaterno>'.$_POST['Pa_ApellidoPaterno'].'</Pa_ApellidoPaterno>
      <Pa_ApellidoMaterno>'.$_POST['Pa_ApellidoMaterno'].'</Pa_ApellidoMaterno>
      <Pa_Calle>'.$_POST['Pa_Calle'].'</Pa_Calle>
      <Pa_Numero>'.$_POST['Pa_Numero'].'</Pa_Numero>
      <Pa_Colonia>'.$_POST['Pa_Colonia'].'</Pa_Colonia>
      <Pa_CP>'.$_POST['Pa_CP'].'</Pa_CP>
      <Pa_Ciudad>'.$_POST['Pa_Ciudad'].'</Pa_Ciudad>
      <Pa_Municipio>'.$_POST['Pa_Municipio'].'</Pa_Municipio>
      <Pa_Estado>'.$_POST['Pa_Estado'].'</Pa_Estado>
      <Pa_TelMovil>'.$_POST['Pa_TelMovil'].'</Pa_TelMovil>
      <Pa_TelOtro>'.$_POST['Pa_TelOtro'].'</Pa_TelOtro>
      <Pa_CorreoElectronico>'.$_POST['Pa_CorreoElectronico'].'</Pa_CorreoElectronico>
      <Pa_LugarTrabajo>'.$_POST['Pa_LugarTrabajo'].'</Pa_LugarTrabajo>
      <Ma_Tipo>'.$_POST['Ma_Tipo'].'</Ma_Tipo>
      <Ma_Nombre>'.$_POST['Ma_Nombre'].'</Ma_Nombre>
      <Ma_SegundoNombre>'.$_POST['Ma_SegundoNombre'].'</Ma_SegundoNombre>
      <Ma_ApellidoPaterno>'.$_POST['Ma_ApellidoPaterno'].'</Ma_ApellidoPaterno>
      <Ma_ApellidoMaterno>'.$_POST['Ma_ApellidoMaterno'].'</Ma_ApellidoMaterno>
      <Ma_Calle>'.$_POST['Ma_Calle'].'</Ma_Calle>
      <Ma_Numero>'.$_POST['Ma_Numero'].'</Ma_Numero>
      <Ma_Colonia>'.$_POST['Ma_Colonia'].'</Ma_Colonia>
      <Ma_CP>'.$_POST['Ma_CP'].'</Ma_CP>
      <Ma_Ciudad>'.$_POST['Ma_Ciudad'].'</Ma_Ciudad>
      <Ma_Municipio>'.$_POST['Ma_Municipio'].'</Ma_Municipio>
      <Ma_Estado>'.$_POST['Ma_Estado'].'</Ma_Estado>
      <Ma_TelMovil>'.$_POST['Ma_TelMovil'].'</Ma_TelMovil>
      <Ma_TelOtro>'.$_POST['Ma_TelOtro'].'</Ma_TelOtro>
      <Ma_CorreoElectronico>'.$_POST['Ma_CorreoElectronico'].'</Ma_CorreoElectronico>
      <Ma_LugarTrabajo>'.$_POST['Ma_LugarTrabajo'].'</Ma_LugarTrabajo>
    </ProspectoNacerPwc>
  </soap:Body>
</soap:Envelope>',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: text/xml; charset=utf-8',
    //'Content-Length: ' . strlen($xmlBody),
    'SOAPAction: http://tempuri.org/ProspectoNacerPwc'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
echo '<br>';
$xml = new SimpleXMLElement($response);

/*echo "<pre>" . 'curl -X POST "http://localhost:8083/TestNG/WSNacerCRM-PwC92_UPOV2/WSNACER1.asmx?op=ProspectoNacerPwc" '
    . '-H "Content-Type: text/xml; charset=utf-8" '
    . '-H "SOAPAction: \"http://tempuri.org/ProspectoNacerPwc"" '
    . '-d ' . $xmlBody . "</pre>";*/


$xml->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
$xml->registerXPathNamespace('ns', 'http://tempuri.org/');

// Acceder al elemento `Codigo`
$codigo = $xml->xpath('//soap:Body/ns:ProspectoNacerPwcResponse/ns:ProspectoNacerPwcResult/ns:Codigo');
$estatus = $codigo[0];

// Acceder al elemento `IdPwc`
$idPwc = $xml->xpath('//soap:Body/ns:ProspectoNacerPwcResponse/ns:ProspectoNacerPwcResult/ns:IdPwc');
$id =  $idPwc[0];

$mensaje = $xml->xpath('//soap:Body/ns:ProspectoNacerPwcResponse/ns:ProspectoNacerPwcResult/ns:Mensaje');
$message =  $mensaje[0];

echo $estatus;
echo "<br>";
echo $id;

header("Location: resultws.php?e=".$estatus."&i=".$id."&m=".$message);
//echo '<a href="resultws.php?e='.$estatus.'&i='.$id.'">Visualizar resultado</a>';
die();

}

?>

<a href=""></a>