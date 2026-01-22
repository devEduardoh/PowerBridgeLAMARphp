<?php

echo "Datos de la solicitud: <br>";
echo "<hr>";
echo "Datos personales: <br><br>";


echo "Primer nombre: ". $nombre_1 = $_POST["nombre"]."<br>";
echo "Segundo nombre: ". $nombre_2 = $_POST["nombre_2"]."<br>";
echo "Apellido Paterno: ". $apaterno = $_POST["apaterno"]."<br>";
echo "Apellido Materno: ". $amaterno = $_POST["amaterno"]."<br>";
echo "Estado Civil: ". $edocivil = $_POST["edocivil"]."<br>";
echo "Genero: ". $genero = $_POST["genero"]."<br>";
echo "Fecha de Nacimiento: ". $fechanac = $_POST["fechanac"]."<br>";
echo "Estado de Nacimiento: ". $edo_nac = $_POST["edo_nac"]."<br>";
echo "Telefono Movil: ". $telmov = $_POST["telmov"]."<br>";
echo "Telefono Casa: ". $telcasa = $_POST["telcasa"]."<br>";
echo "Correo: ". $correo = $_POST["correo"]."<br>";
echo "Tipo de Sangre: ". $t_sangre = $_POST["t_sangre"]."<br>";
echo "Enfermedades: ". $enf_cronica = $_POST["enf_cronica"]."<br>";
echo "Alergias: ". $alergias = $_POST["alergias"]."<br>";

// Datos domicilio
echo "<hr>";
echo "Datos domicilio: <br><br>";

echo "Calle: ". $calle = $_POST["calle"]."<br>";
echo "Número: ". $num = $_POST["num"]."<br>";
echo "CP: ". $zip_code = $_POST["zip_code"]."<br>";
echo "País: ". $pais = $_POST["pais"]."<br>";
echo "Estado: ". $estado = $_POST["estado"]."<br>";
echo "Municipio: ". $municipio = $_POST["municipio"]."<br>";
echo "Ciudad: ". $ciudad = $_POST["ciudad"]."<br>";
echo "Colonia: ". $colonia = $_POST["colonia"]."<br>";

// Datos académicos
echo "<hr>";
echo "Datos académicos: <br><br>";

echo "Año: ". $anio = $_POST["anio"]."<br>";
echo "Periodo: ". $periodo = $_POST["periodo"]."<br>";
echo "Sesión: ". $sesion = $_POST["sesion"]."<br>";
echo "Nivel: ". $nivel = $_POST["nivel"]."<br>";
echo "Programa: ". $programa = $_POST["programa"]."<br>";
echo "Carrera: ". $carrera = $_POST["carrera"]."<br>";
echo "Turno: ". $turno = $_POST["turno"]."<br>";
echo "Tipo de ingreso: ". $t_ingreso = $_POST["t_ingreso"]."<br>";
echo "CCT Esc. Procedencia: ". $cct = $_POST["cct"]."<br>";
echo "Esc. Procedencia: ". $esc_proc = $_POST["esc_proc"]."<br>";
echo "Nivel Anterior: ". $nivel_anterior = $_POST["nivel_anterior"]."<br>";
echo "Promedio: ". $promedio = $_POST["promedio"]."<br>";

// Becas y descuentos
echo "<hr>";
echo "Datos de beca: <br><br>";

echo "Porcentaje Beca: ". $porcentaje_beca = $_POST["porcentaje_beca"]."<br>";
echo "Beca Primer Pago: ". $beca_crm = $_POST["beca_crm"]."<br>";
echo "Beca Parcialidades: ". $beca_parc = $_POST["beca_parc"]."<br>";
echo "Fecha Límite de Pago: ". $fecha_pag = $_POST["fecha_pag"]."<br>";

// Contacto de emergencia y datos del tutor
echo "<hr>";
echo "Contacto de emergencia y datos del tutor: <br><br>";

echo "Tutor: ". $nombre_tutor = $_POST["nombre_tutor"]."<br>";
echo "Teléfono Móvil Tutor: ". $tel_tutor = $_POST["tel_tutor"]."<br>";
echo "Otro Teléfono Tutor: ". $tel_tutor2 = $_POST["tel_tutor2"]."<br>";
echo "Correo Tutor: ". $correo_tutor = $_POST["correo_tutor"]."<br>";
echo "C.P Tutor: ". $zip_code_tutor = $_POST["zip_code_tutor"]."<br>";
echo "Estado Tutor: ". $estado_tutor = $_POST["estado_tutor"]."<br>";
echo "Municipio Tutor: ". $municipio_tutor = $_POST["municipio_tutor"]."<br>";
echo "Colonia Tutor: ". $colonia_tutor = $_POST["colonia_tutor"]."<br>";
echo "Contacto de Emergencia: ". $nombre_emer = $_POST["nombre_emer"]."<br>";
echo "Teléfono Contacto Emergencia: ". $tel_emer = $_POST["tel_emer"]."<br>";

// Información del Padre
echo "<hr>";
echo "Información del Padre: <br><br>";

echo "Primer Nombre Padre: ". $nombre_padre = $_POST["nombre_padre"]."<br>";
echo "Segundo Nombre Padre: ". $nombre_padre2 = $_POST["nombre_padre2"]."<br>";
echo "Apellido Paterno Padre: ". $apaterno_padre = $_POST["apaterno_padre"]."<br>";
echo "Apellido Materno Padre: ". $amaterno_padre = $_POST["amaterno_padre"]."<br>";
echo "Parentesco Padre: ". $parentesco_padre = $_POST["parentesco_padre"]."<br>";
echo "C.P Padre: ". $zip_code_padre = $_POST["zip_code_padre"]."<br>";
echo "Estado Padre: ". $estado_padre = $_POST["estado_padre"]."<br>";
echo "Municipio Padre: ". $municipio_padre = $_POST["municipio_padre"]."<br>";
echo "Ciudad Padre: ". $ciudad_padre = $_POST["ciudad_padre"]."<br>";
echo "Colonia Padre: ". $colonia_padre = $_POST["colonia_padre"]."<br>";
echo "Calle Padre: ". $calle_padre = $_POST["calle_padre"]."<br>";
echo "No Padre: ". $num_padre = $_POST["num_padre"]."<br>";
echo "Tel. Móvil Padre: ". $telmov_padre = $_POST["telmov_padre"]."<br>";
echo "Otro Tel Padre: ". $telotro_padre = $_POST["telotro_padre"]."<br>";
echo "Correo Padre: ". $correo_padre = $_POST["correo_padre"]."<br>";
echo "Trabajo Padre: ". $trabajo_padre = $_POST["trabajo_padre"]."<br>";

// Información de la madre
echo "<hr>";
echo "Información de la Madre: <br><br>";

echo "Primer Nombre Madre: ". $nombre_padre = $_POST["nombre_madre"]."<br>";
echo "Segundo Nombre Madre: ". $nombre_padre2 = $_POST["nombre_madre2"]."<br>";
echo "Apellido Paterno Madre: ". $apaterno_padre = $_POST["apaterno_madre"]."<br>";
echo "Apellido Materno Madre: ". $amaterno_madre = $_POST["amaterno_madre"]."<br>";
echo "Parentesco Madre: ". $parentesco_padre = $_POST["parentesco_madre"]."<br>";
echo "C.P Madre: ". $zip_code_padre = $_POST["zip_code_madre"]."<br>";
echo "Estado Madre: ". $estado_padre = $_POST["estado_madre"]."<br>";
echo "Municipio Madre: ". $municipio_padre = $_POST["municipio_madre"]."<br>";
echo "Ciudad Madre: ". $ciudad_padre = $_POST["ciudad_madre"]."<br>";
echo "Colonia Madre: ". $colonia_padre = $_POST["colonia_madre"]."<br>";
echo "Calle Madre: ". $calle_padre = $_POST["calle_madre"]."<br>";
echo "No Madre: ". $num_padre = $_POST["num_madre"]."<br>";
echo "Tel. Móvil Madre: ". $telmov_padre = $_POST["telmov_madre"]."<br>";
echo "Otro Tel Madre: ". $telotro_padre = $_POST["telotro_madre"]."<br>";
echo "Correo Madre: ". $correo_padre = $_POST["correo_madre"]."<br>";
echo "Trabajo Madre: ". $trabajo_padre = $_POST["trabajo_madre"]."<br>";

// Información de empleo
echo "<hr>";
echo "Información de empleo: <br><br>";

echo "Empresa: ". $empresa = $_POST["empresa"]."<br>";
echo "C.P Empleo: ". $zip_code_emp = $_POST["zip_code_emp"]."<br>";
echo "Estado Empleo: ". $estado_emp = $_POST["estado_emp"]."<br>";
echo "Municipio Empleo: ". $municipio_emp = $_POST["municipio_emp"]."<br>";
echo "Posición Empleo: ". $puesto = $_POST["puesto"]."<br>";
echo "Fecha Ingreso Empleo: ". $fecha_ingemp = $_POST["fecha_ingemp"]."<br>";

























?>