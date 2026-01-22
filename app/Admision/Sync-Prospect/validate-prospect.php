<?php
session_start();
if (!isset($_SESSION['iduser'])) {
    header('Location: ../../index.php');
    exit();
}elseif($_SESSION['level'] == 1){
        $id_user = $_SESSION['iduser'];
        $name = $_SESSION['names'];
        $surname = $_SESSION['surnames'];
        $level = $_SESSION['level'];
        $area = $_SESSION['area'];
        $des_area = $_SESSION['d_area'];
        $des_level = $_SESSION['d_level'];
        $username = $_SESSION['username'];
}else{
    header('Location: ../../index.php');
    exit();
}

if(!empty($_POST)){

require_once('../../../logic/conn_ss.php');
require_once('../../../logic/conn_ms.php');

// Datos Personales

$nombre_1 = trim($_POST["nombre"]);
$nombre_2 = trim($_POST["nombre_2"]);
$apaterno = trim($_POST["apaterno"]);
$amaterno = trim($_POST["amaterno"]);
$edocivil = $_POST["edocivil"];
$genero = $_POST["genero"];
$fechanac = $_POST["fechanac"];
$fecha_nacimiento = date('m-d-Y', strtotime($fechanac));
$edo_nac = $_POST["edo_nac"];
$lugar_nac = $_POST["lugar_nac"];
$telmov = trim($_POST["telmov"]);
$telcasa = trim($_POST["telcasa"]);
$correo = trim($_POST["correo"]);
$t_sangre = $_POST["t_sangre"];
$enf_cronica = $_POST["enf_cronica"];
$alergias = $_POST["alergias"];

$nom_completo_1 = $nombre_1." ".$nombre_2." ".$apaterno." ".$amaterno;
$nom_completo_2 = str_replace("  "," ", $nom_completo_1);
$nom_completo = trim($nom_completo_2);

if($edo_nac == '88'){
    $lugar_nacPWC = "EXTRANJERO";
    $natal_pais = "492";
}else{
    $natal_pais = "MEXICO";
    $lugar_nacPWC = $lugar_nac;
}

// Datos domicilio

$calle = $_POST["calle"];
$num = $_POST["num"];
$zip_code = $_POST["zip_code"];
$pais = $_POST["pais"];
$estado = $_POST["estado"];
$municipio = $_POST["municipio"];
$ciudad = $_POST["ciudad"];
$colonia = $_POST["colonia"];

// Datos académicos

$anio = $_POST["anio"];
$periodo = $_POST["periodo"];
$sesion = $_POST["sesion"];
$nivel = $_POST["nivel"];
$programa = $_POST["programa"];
$carrera = $_POST["carrera"];
$turno = $_POST["turno"];
$t_ingreso = $_POST["t_ingreso"];
$cct = $_POST["cct"] ?? '24PSU0017W';
$esc_proc = $_POST["esc_proc"] ?? '000099781';
$nivel_anterior = $_POST["nivel_anterior"];
$promedio = $_POST["promedio"];

// Datos Pag,"<br>"o
$fecha_pag = $_POST["fecha_pag"];
$beca_crm = $_POST["beca_crm"];
$beca_parc = $_POST["beca_parc"];
$porcentaje_beca = $_POST["porcentaje_beca"]?? null;
$fecha_limpago = date('d-m-Y', strtotime($fecha_pag));



// Genera CURP

if($genero == 'M'){
    $genero_curp = 'H';
}elseif($genero == 'F'){
    $genero_curp = 'M';
}else {
    $genero_curp = 'No definido';
}

require_once('option-form/curp.php');

$nombre          = $nombre_1.''.$nombre_2; 
$apellidoPaterno = $apaterno;
$apellidoMaterno = $amaterno;
$fecha           = $fechanac;
$sexo            = $genero_curp; // X (H o M)
$entidad         = $edo_nac; // XX (01-32, 87-88)


try
{
    $curpObj     = new Curp($nombre, $apellidoPaterno, $apellidoMaterno, $fecha, $sexo, $entidad);
    $curp        = $curpObj->curp;
    
}
catch(Exception $e)
{
    echo $e->getMessage();
}

$idoportunidadCRM = 'NEOTEL-'.substr($curp,0,10);

$nombre_tutor = $_POST["nombre_tutor"] ?? null;
$tel_tutor = $_POST["tel_tutor"] ?? null;
$tel_tutor2 = $_POST["tel_tutor2"] ?? null;
$correo_tutor = $_POST["correo_tutor"] ?? null;
$zip_code_tutor = $_POST["zip_code_tutor"] ?? null;
$estado_tutor = $_POST["estado_tutor"] ?? null;
$municipio_tutor = $_POST["municipio_tutor"] ?? null;
$colonia_tutor = $_POST["colonia_tutor"] ?? null;
$dir_tutor = $_POST["dir_tutor"] ?? null;
$trabajo_tutor = $_POST["trabajo_tutor"] ?? null;
$nombre_emer = $_POST["nombre_emer"] ?? null;
$tel_emer = $_POST["tel_emer"] ?? null;

$empresa = $_POST["empresa"] ?? null;
$zip_code_emp = $_POST["zip_code_emp"] ?? null;
$estado_emp = $_POST["estado_emp"] ?? null;
$municipio_emp = $_POST["municipio_emp"] ?? null;
$colonia_emp = $_POST["colonia_emp"] ?? null;
$dir_emp = $_POST["dir_emp"] ?? null;
$puesto = $_POST["puesto"] ?? null;
$fecha_ingemp = $_POST["fecha_ingemp"] ?? null;

$nombre_padre = $_POST["nombre_padre"] ?? null;
$nombre_padre2 = $_POST["nombre_padre2"] ?? null;
$apaterno_padre = $_POST["apaterno_padre"] ?? null;
$amaterno_padre = $_POST["amaterno_padre"] ?? null;
$parentesco_padre = $_POST["parentesco_padre"] ?? null;
$zip_code_padre = $_POST["zip_code_padre"] ?? null;
$estado_padre = $_POST["estado_padre"] ?? null;
$municipio_padre = $_POST["municipio_padre"] ?? null;
$ciudad_padre = $_POST["ciudad_padre"] ?? null;
$colonia_padre = $_POST["colonia_padre"] ?? null;
$calle_padre = $_POST["calle_padre"] ?? null;
$num_padre = $_POST["num_padre"] ?? null;
$telmov_padre = $_POST["telmov_padre"] ?? null;
$telotro_padre = $_POST["telotro_padre"] ?? null;
$correo_padre = $_POST["correo_padre"] ?? null;
$trabajo_padre = $_POST["trabajo_padre"] ?? null;

$nombre_madre = $_POST["nombre_madre"] ?? null;
$nombre_madre2 = $_POST["nombre_madre2"] ?? null;
$apaterno_madre = $_POST["apaterno_madre"] ?? null;
$amaterno_madre = $_POST["amaterno_madre"] ?? null;
$parentesco_madre = $_POST["parentesco_madre"] ?? null;
$zip_code_madre = $_POST["zip_code_madre"] ?? null;
$estado_madre = $_POST["estado_madre"] ?? null;
$municipio_madre = $_POST["municipio_madre"] ?? null;
$ciudad_madre = $_POST["ciudad_madre"] ?? null;
$colonia_madre = $_POST["colonia_madre"] ?? null;
$calle_madre = $_POST["calle_madre"] ?? null;
$num_madre = $_POST["num_madre"] ?? null;
$telmov_madre = $_POST["telmov_madre"] ?? null;
$telotro_madre = $_POST["telotro_madre"] ?? null;
$correo_madre = $_POST["correo_madre"] ?? null;
$trabajo_madre = $_POST["trabajo_madre"] ?? null;


?>
<!doctype html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>SyncProspect | PowerBridge</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="../../../assets/images/favicon.ico" />
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../../../assets/css/core/libs.min.css" />
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../../../assets/css/hope-ui.min.css?v=2.0.0" />
      <!-- Custom Css -->
      <link rel="stylesheet" href="../../../assets/css/custom.min.css?v=2.0.0" />
      <!-- Dark Css -->
      <link rel="stylesheet" href="../../../assets/css/dark.min.css"/>
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../../../assets/css/customizer.min.css" />
      <!-- RTL Css -->
      <link rel="stylesheet" href="../../../assets/css/rtl.min.css"/>
      <script type="text/javascript">
        window.onload = function () {
        document.forms['formulario'].addEventListener('submit', avisarUsuario);
        }

        function avisarUsuario(evObject) {
        evObject.preventDefault();
        var botones = document.querySelectorAll('.btn-formulario');
        for (var i=0; i<botones.length; i++) {botones[i].disabled = true; }
        var nuevoNodo = document.createElement('h2');
        nuevoNodo.innerHTML = '<div class="alert alert-info" style="width: 450px; margin-left: 3%; font-size: 16px;" role="alert">Enviando a PwC</div>';
        document.body.appendChild(nuevoNodo);
        var retrasar = setTimeout(procesaDentroDe2Segundos, 2000);
        }

        function procesaDentroDe2Segundos() {document.forms['formulario'].submit();}
    </script>
  </head>
  <body>
    <div >
      <!-- loader Start -->
      <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>      </div>
      <!-- loader END -->
     
      <main class="main-content">
        
<div style="width: 98%;">
<div class="row">
   <div class="col-md-12 col-lg-12">
   <!-- Contenido del Frame -->
   
   <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                    <h5>Revisión información del Prospecto: <?php echo $nom_completo; ?></h5>
                </div>
                <div class="card-body"></div>
                </div>
    </div>

    <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                      <h6 class="card-title">Validación de duplicados</h6>
                    </div>
                </div>
                <div class="card-body">
                    <?php 
                    require_once('validate_duplicates.php');
                    ?>
                </div>
    </div>

    <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Validación de Oferta Académica y Ficha de Pago</h6>
                    </div>
                </div>
                <div class="card-body">
                    <?php 
                    require_once('price_list.php');
                    ?>
                </div>
    </div>
    
    <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center text-center">
                            <div class="col">
                                <a href="javascript:window.history.back();"><button type="submit" class="btn btn-warning">Regresar a la captura</button></a>
                            </div>
                            <div class="col align-items-center text-center">
                            <form action="sendws.php" method="post" name="formulario">                      
                                <label style="font-size: 16px; color:red;" class="form-label" for="Curp"><b>Ajustar CURP de manera manual</b></label>
                                <input type="text" class="form-control form-control-sm" id="Curp" name="Curp" value="<?php echo $curp; ?>">
                                <br>
                                    <input type="hidden" name="Nombre" value="<?php echo $nombre_1 ; ?>">
                                    <input type="hidden" name="SegundoNombre" value="<?php echo $nombre_2 ; ?>">
                                    <input type="hidden" name="ApellidoPaterno" value="<?php echo $apaterno; ?>">
                                    <input type="hidden" name="ApellidoMaterno" value="<?php echo $amaterno; ?>">
                                    <input type="hidden" name="NombreCompleto" value="<?php echo $nom_completo; ?>">
                                    <input type="hidden" name="Matricula" value="<?php echo $idoportunidadCRM; ?>">
                                    <input type="hidden" name="TelMovil" value="<?php echo $telmov; ?>">
                                    <input type="hidden" name="TelCasa" value="<?php echo $telcasa; ?>">
                                    <input type="hidden" name="CorreoElectronico" value="<?php echo $correo; ?>">
                                    <!--input type="hidden" name="Curp" value="<?php// echo $curp; ?>"-->
                                    <input type="hidden" name="Calle" value="<?php echo $calle; ?>">
                                    <input type="hidden" name="Numero" value="<?php echo $num; ?>">
                                    <input type="hidden" name="Colonia" value="<?php echo $colonia; ?>">
                                    <input type="hidden" name="Ciudad" value="<?php echo $ciudad; ?>">
                                    <input type="hidden" name="Estado" value="<?php echo $estado; ?>">
                                    <input type="hidden" name="CodigoPostal" value="<?php echo $zip_code; ?>">
                                    <input type="hidden" name="Pais" value="<?php echo $pais; ?>">
                                    <input type="hidden" name="Municipio" value="<?php echo $municipio; ?>">
                                    <input type="hidden" name="EstadoCivil" value="<?php echo $edocivil; ?>">
                                    <input type="hidden" name="Genero" value="<?php echo $genero; ?>">
                                    <input type="hidden" name="FechaNacimiento" value="<?php echo $fecha_nacimiento; ?>">
                                    <input type="hidden" name="NivelAcademico" value="<?php echo $nivel; ?>">
                                    <input type="hidden" name="ProgramaAcademico" value="<?php echo $programa; ?>">
                                    <input type="hidden" name="Ciclo" value="<?php echo $periodo; ?>">
                                    <input type="hidden" name="Anio" value="<?php echo $anio; ?>">
                                    <input type="hidden" name="Periodo" value="<?php echo $periodo; ?>">
                                    <input type="hidden" name="Sesion" value="<?php echo $sesion; ?>">
                                    <input type="hidden" name="Grado" value="<?php echo $nivel; ?>">
                                    <input type="hidden" name="Curriculo" value="<?php echo $carrera; ?>">
                                    <input type="hidden" name="Campus" value="<?php echo $campus_org; ?>">
                                    <input type="hidden" name="TurnoUPO" value="<?php echo $turno; ?>">
                                    <input type="hidden" name="idoportunidadCRM" value="<?php echo $idoportunidadCRM; ?>">
                                    <input type="hidden" name="promedio" value="<?php echo $promedio; ?>">
                                    <input type="hidden" name="turno" value="<?php echo $turno; ?>">
                                    <input type="hidden" name="clvebeca" value="<?php echo $beca_crm; ?>">
                                    <input type="hidden" name="tipoIngreso" value="<?php echo $t_ingreso; ?>">
                                    <input type="hidden" name="fechalimpago" value="<?php echo $fecha_limpago; ?>">
                                    <input type="hidden" name="clvebeca2" value="<?php echo $beca_parc; ?>">

                                    <input type="hidden" name="En_Accidente_Avisar" value="<?php echo $nombre_emer; ?>">
                                    <input type="hidden" name="Telefono_En_Accidente_Avisar" value="<?php echo $tel_emer; ?>">
                                    <input type="hidden" name="Natal_Pais" value="<?php echo $natal_pais; ?>">
                                    <input type="hidden" name="Natal_Ciudad_Estado" value="<?php echo $lugar_nacPWC; ?>">
                                    <input type="hidden" name="Escuela_Procedencia" value="<?php echo $esc_proc; ?>">
                                    <input type="hidden" name="Grado_Escuela_Procedencia" value="<?php echo $nivel_anterior; ?>">
                                    <input type="hidden" name="Tut_Nombre" value="<?php echo $nombre_tutor; ?>">
                                    <input type="hidden" name="Tut_Direccion" value="<?php echo $dir_tutor; ?>">
                                    <input type="hidden" name="Tut_Colonia" value="<?php echo $colonia_tutor; ?>">
                                    <input type="hidden" name="Tut_Ciudad" value="<?php echo $municipio_tutor; ?>">
                                    <input type="hidden" name="Tut_Estado" value="<?php echo $estado_tutor; ?>">
                                    <input type="hidden" name="Tut_CP" value="<?php echo $zip_code_tutor; ?>">
                                    <input type="hidden" name="Tut_Telefono_1" value="<?php echo $tel_tutor; ?>">
                                    <input type="hidden" name="Tut_Telefono_2" value="<?php echo $tel_tutor2; ?>">
                                    <input type="hidden" name="Tut_Correo" value="<?php echo $correo_tutor; ?>">
                                    <input type="hidden" name="Tut_LugarTrabajo" value="<?php echo $trabajo_tutor; ?>">
                                    <input type="hidden" name="Emp_Empresa" value="<?php echo $empresa; ?>">
                                    <input type="hidden" name="Emp_Ciudad" value="<?php echo $municipio_emp; ?>">
                                    <input type="hidden" name="Emp_CP" value="<?php echo $zip_code_emp; ?>">
                                    <input type="hidden" name="Emp_Estado" value="<?php echo $estado_emp; ?>">
                                    <input type="hidden" name="Emp_Colonia" value="<?php echo $colonia_emp; ?>">
                                    <input type="hidden" name="Emp_Direccion" value="<?php echo $dir_emp; ?>">
                                    <input type="hidden" name="Emp_Posicion" value="<?php echo $puesto; ?>">
                                    <input type="hidden" name="Emp_FechaIngreso" value="<?php echo $fecha_ingemp; ?>">
                                    <input type="hidden" name="Asesor_Neotel" value="<?php echo $name.' '.$surname; ?>">
                                    <input type="hidden" name="Sa_TipoSangre" value="<?php echo $t_sangre; ?>">
                                    <input type="hidden" name="Sa_Enfermedades" value="<?php echo $enf_cronica; ?>">
                                    <input type="hidden" name="Sa_Alergias" value="<?php echo $alergias; ?>">
                                    <input type="hidden" name="Pa_Tipo" value="<?php echo $parentesco_padre; ?>">
                                    <input type="hidden" name="Pa_Nombre" value="<?php echo $nombre_padre; ?>">
                                    <input type="hidden" name="Pa_SegundoNombre" value="<?php echo $nombre_padre2; ?>">
                                    <input type="hidden" name="Pa_ApellidoPaterno" value="<?php echo $apaterno_padre; ?>">
                                    <input type="hidden" name="Pa_ApellidoMaterno" value="<?php echo $amaterno_padre; ?>">
                                    <input type="hidden" name="Pa_Calle" value="<?php echo $calle_padre; ?>">
                                    <input type="hidden" name="Pa_Numero" value="<?php echo $num_padre; ?>">
                                    <input type="hidden" name="Pa_Colonia" value="<?php echo $colonia_padre; ?>">
                                    <input type="hidden" name="Pa_CP" value="<?php echo $zip_code_padre; ?>">
                                    <input type="hidden" name="Pa_Ciudad" value="<?php echo $ciudad_padre; ?>">
                                    <input type="hidden" name="Pa_Municipio" value="<?php echo $municipio_padre; ?>">
                                    <input type="hidden" name="Pa_Estado" value="<?php echo $estado_padre; ?>">
                                    <input type="hidden" name="Pa_TelMovil" value="<?php echo $telmov_padre; ?>">
                                    <input type="hidden" name="Pa_TelOtro" value="<?php echo $telotro_padre; ?>">
                                    <input type="hidden" name="Pa_CorreoElectronico" value="<?php echo $correo_padre; ?>">
                                    <input type="hidden" name="Pa_LugarTrabajo" value="<?php echo $trabajo_padre; ?>">
                                    <input type="hidden" name="Ma_Tipo" value="<?php echo $parentesco_madre; ?>">
                                    <input type="hidden" name="Ma_Nombre" value="<?php echo $nombre_madre; ?>">
                                    <input type="hidden" name="Ma_SegundoNombre" value="<?php echo $nombre_madre2; ?>">
                                    <input type="hidden" name="Ma_ApellidoPaterno" value="<?php echo $apaterno_madre; ?>">
                                    <input type="hidden" name="Ma_ApellidoMaterno" value="<?php echo $amaterno_madre; ?>">
                                    <input type="hidden" name="Ma_Calle" value="<?php echo $calle_madre; ?>">
                                    <input type="hidden" name="Ma_Numero" value="<?php echo $num_madre; ?>">
                                    <input type="hidden" name="Ma_Colonia" value="<?php echo $colonia_madre; ?>">
                                    <input type="hidden" name="Ma_CP" value="<?php echo $zip_code_madre; ?>">
                                    <input type="hidden" name="Ma_Ciudad" value="<?php echo $ciudad_madre; ?>">
                                    <input type="hidden" name="Ma_Municipio" value="<?php echo $municipio_madre; ?>">
                                    <input type="hidden" name="Ma_Estado" value="<?php echo $estado_madre; ?>">
                                    <input type="hidden" name="Ma_TelMovil" value="<?php echo $telmov_madre; ?>">
                                    <input type="hidden" name="Ma_TelOtro" value="<?php echo $telotro_madre; ?>">
                                    <input type="hidden" name="Ma_CorreoElectronico" value="<?php echo $correo_madre; ?>">
                                    <input type="hidden" name="Ma_LugarTrabajo" value="<?php echo $trabajo_madre; ?>">
                                    
                                    <button type="submit" class="btn btn-success btn-formulario">Enviar prospecto a PwC</button>
                            </form>
                            </div>
                        </div>
                    </div>
                    </div>
    <!-- CIERRA Contenido del Frame -->
   </div> 
</div>
</div>
            
</main>
      <!-- Wrapper End-->
    <!-- Library Bundle Script -->
    <script src="../../../assets/js/core/libs.min.js"></script>
    <!-- External Library Bundle Script -->
    <script src="../../../assets/js/core/external.min.js"></script>
    <!-- Widgetchart Script -->
    <script src="../../../assets/js/charts/widgetcharts.js"></script>
    <!-- mapchart Script -->
    <script src="../../../assets/js/charts/vectore-chart.js"></script>
    <script src="../../../assets/js/charts/dashboard.js" ></script>
    <!-- fslightbox Script -->
    <script src="../../../assets/js/plugins/fslightbox.js"></script>
    <!-- Settings Script -->
    <script src="../../../assets/js/plugins/setting.js"></script>
    <!-- Slider-tab Script -->
    <script src="../../../assets/js/plugins/slider-tabs.js"></script>
    <!-- Form Wizard Script -->
    <script src="../../../assets/js/plugins/form-wizard.js"></script>
    <!-- AOS Animation Plugin-->
    <!-- App Script -->
    <script src="../../../assets/js/hope-ui.js" defer></script>
  </body>
</html>
<?php 
}
?>