<?php 
session_start();
if (!isset($_SESSION['iduser'])) {
    header('Location: ../../index.php');
    exit();
}elseif(isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])){ 
        $id_user = $_SESSION['iduser'];
        $name = $_SESSION['names'];
        $surname = $_SESSION['surnames'];
        $des_area = $_SESSION['d_area'];
        $username = $_SESSION['username'];
}else{
    header('Location: ../../index.php');
    exit();
}

$currentDate = new DateTime();
$currentDate->modify('-19 years');

$min_birthday = $currentDate->format('Y-m-d');

require_once '../../../logic/conn_ss.php';
require_once '../../../logic/conn_ms.php';

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
   <form action="validate-prospect.php" method="post">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Datos Personales</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="1">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="1" name="nombre" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="2">Segundo Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="2" name="nombre_2">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="3">Apellido Paterno</label>
                                <input type="text" class="form-control form-control-sm" id="3" name="apaterno" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="4">Apellido Materno</label>
                                <input type="text" class="form-control form-control-sm" id="4" name="amaterno">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="5" style="font-size: 14px;" class="form-label">Estado Civil</label>
                                <select class="form-select form-select-sm mb-3 shadow-none"  name="edocivil" id="5"  required>
                                    <option selected>Selecciona una opción</option>
                                    <option value="CASA">Casado</option>
                                    <option value="SOLT">Soltero</option>
                                    <option value="CONC">Concubinato</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="9">Telefóno Móvil</label>
                                <input type="tel" class="form-control form-control-sm" id="9" placeholder="(55)12-34-56-78" name="telmov" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="10">Telefóno de Casa</label>
                                <input type="tel" class="form-control form-control-sm" id="10" placeholder="(55)12-34-56-78" name="telcasa" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="11">Correo electrónico</label>
                                <input type="email" class="form-control form-control-sm" id="11"placeholder="name@example.com" name="correo" required>
                            </div>

                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label for="6" style="font-size: 14px;" class="form-label">Género</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="genero" id="6"  required>
                                    <option selected>Selecciona una opción</option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                        <div class="col form-group">
                                <label for="edo_nac" style="font-size: 14px;" class="form-label">Estado de Nacimiento</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="edo_nac" id="edo_nac"  required>
                                    <option selected>Selecciona una opción</option>
                                    <?php require_once 'option-form/state_placebirth.php'; ?>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="lugar_nac" style="font-size: 14px;" class="form-label">Municipio de Nacimiento</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="lugar_nac" id="lugar_nac"  required></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="7">Fecha de Nacimiento</label>
                                <input style="font-size: 14px;" type="date" class="form-control" id="7" name="fechanac" value="<?php echo $min_birthday; ?>">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-3 form-group">
                                    <label style="font-size: 14px;" class="form-label" for="t_sangre">Tipo de Sangre</label>
                                        <select class="form-select form-select-sm mb-3 shadow-none" name="t_sangre" id="t_sangre">
                                            <?php require_once 'option-form/code_suffix.php'; ?>
                                        </select>
                            </div>
                            <div class="col-5 form-group">
                                <label style="font-size: 14px;" class="form-label" for="enf_cronica">¿Padece enfermedades crónicas?</label>
                                <input type="text" class="form-control form-control-sm" id="enf_cronica" placeholder="Indique que enfermedad(es)" name="enf_cronica">
                            </div>
                            <div class="col-4 form-group">
                                <label style="font-size: 14px;" class="form-label" for="alergias">Alergias</label>
                                <input type="text" class="form-control form-control-sm" id="alergias" placeholder="Indique las alergias" name="alergias">
                            </div>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Domicilio</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="zip_code">Código Postal</label>
                                <input type="text" class="form-control form-control-sm" id="zip_code" id="zip_code" name="zip_code" placeholder="00100" required>
                            </div>
                            <div class="col form-group">
                                <label for="pais" style="font-size: 14px;" class="form-label">País</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="pais" id="pais" required></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="estado">Estado</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="estado" id="estado" required></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="municipio">Municipio</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="municipio" id="municipio" required></select>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="ciudad">Ciudad</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="ciudad" id="ciudad" required></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="colonia">Colonia</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="colonia" id="colonia" required></select>
                        </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="12">Calle</label>
                                <input type="text" class="form-control form-control-sm" id="12" name="calle" required>
                            </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="13">Número</label>
                                <input type="text" class="form-control form-control-sm" id="13" name="num"  required>
                            </div>
                        </div>
                      
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Oferta Educativa</h6>
                    </div>
                </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="anio">Año</label>
                                        <select class="form-select form-select-sm mb-3 shadow-none" name="anio" id="anio" required>
                                            <?php require_once 'option-form/academic_year.php'; ?>
                                        </select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="periodo">Periodo</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="periodo" id="periodo" required></select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="sesion">Campus</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="sesion" id="sesion" required></select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="nivel">Nivel</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="nivel" id="nivel" required></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="programa">Programa</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="programa" id="programa" required></select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="carrera">Carrera</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="carrera" id="carrera" required></select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label">Turno</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="turno" id="turno" required>
                                        <?php require_once 'option-form/fullpart.php'; ?>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="14">Tipo de Ingreso</label>
                                        <select class="form-select form-select-sm mb-3 shadow-none" name="t_ingreso" id="14" required>
                                            <option selected>Selecciona una opción</option>
                                            <option value="PI">Primer Ingreso</option>
                                            <option value="EQ">Equivalencia</option>
                                        </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="cct">CCT o Nombre Escuela de Procedenca</label>
                                <input type="text" class="form-control form-control-sm" id="cct" name="cct" placeholder="CCT">
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="esc_proc">Escuela de Procedencia</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="esc_proc" id="esc_proc"></select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label">Nivel Escuela de Procedencia</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="nivel_anterior" id="nivel_anterior" required>
                                        <?php require_once 'option-form/degree_esc_proc.php'; ?>
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="14">Promedio</label>
                                    <input type="number" class="form-control form-control-sm" id="promedio" name="promedio" required step="0.01" min='6' max='10'>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Becas y Descuentos</h6>
                    </div>
                </div>
                <div class="card-body">
                            <div class="row">
                            <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="porcentaje_beca">Monto o Porcentaje</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="porcentaje_beca" id="porcentaje_beca"></select>
                                </div>
                            <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="beca_crm">Descuento o beca primer pago</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="beca_crm" id="beca_crm"></select>
                                </div>
                                <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="beca_parc">Beca parcialidades</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="beca_parc" id="beca_parc"></select>
                                </div>  
                                <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="fecha_pag">Fecha Límite de Pago</label>
                                        <input style="font-size: 14px;" type="date" class="form-control" id="fecha_pag" name="fecha_pag">
                                    </div>   
                            </div>
                            
                </div>
                </div>

                <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Contacto de emergencia y datos del tutor</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="nombre_tutor">Nombre completo del Tutor</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_tutor" name="nombre_tutor" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="tel_tutor">Telefóno</label>
                                <input type="tel" class="form-control form-control-sm" id="tel_tutor" placeholder="(55)12-34-56-78" name="tel_tutor" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="tel_tutor2">Telefóno Alternativo</label>
                                <input type="tel" class="form-control form-control-sm" id="tel_tutor2" placeholder="(55)12-34-56-78" name="tel_tutor2">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="correo_tutor">Correo electrónico</label>
                                <input type="email" class="form-control form-control-sm" id="correo_tutor"placeholder="name@example.com" name="correo_tutor" required>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="zip_code_tutor">Código Postal Tutor</label>
                                <input type="text" class="form-control form-control-sm" id="zip_code_tutor" name="zip_code_tutor" placeholder="00100" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="estado_tutor">Estado</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="estado_tutor" id="estado_tutor" required></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="municipio_tutor">Municipio</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="municipio_tutor" id="municipio_tutor" required></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="colonia">Colonia</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="colonia_tutor" id="colonia_tutor" required></select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="dir_tutor">Calle y Número del Tutor</label>
                                <input type="text" class="form-control form-control-sm" name="dir_tutor" id="dir_tutor" required>
                        </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="trabajo_tutor">Lugar de trabajo del Tutor</label>
                                <input type="text" class="form-control form-control-sm" name="trabajo_tutor" id="trabajo_tutor" required>
                        </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="nombre_emer">Nombre de Contacto de Emergencia</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_emer" name="nombre_emer" required>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="tel_emer">Telefóno Contacto de Emergencia</label>
                                <input type="tel" class="form-control form-control-sm" id="tel_emer" placeholder="(55)12-34-56-78" name="tel_emer" required>
                            </div>
                        </div>
                      
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Información del Padre</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="nombre_padre">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_padre" name="nombre_padre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="nombre_padre2">Segundo Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_padre2" name="nombre_padre2">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="apaterno_padre">Apellido Paterno</label>
                                <input type="text" class="form-control form-control-sm" id="apaterno_padre" name="apaterno_padre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="amaterno_padre">Apellido Materno</label>
                                <input type="text" class="form-control form-control-sm" id="amaterno_padre" name="amaterno_padre">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label for="pais" style="font-size: 14px;" class="form-label">Parentesco</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="parentesco_padre" id="parentesco_padre">
                                    <option selected>Selecciona una opción</option>
                                    <option value="PADRE">Padre</option>
                                    <option value="MADRE">Madre</option>
                                    <option value="ABUELO">Abuelo(a)</option>
                                    <option value="TIO">Tío(a)</option>
                                    <option value="HERMANO">Hermano(a)</option>
                                    <option value="TUTOR">Tutor(a)</option>
                                    <option value="OTRO">Otro(a)</option>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="zip_code_padre">Código Postal</label>
                                <input type="text" class="form-control form-control-sm" id="zip_code_padre" name="zip_code_padre" placeholder="00100" >
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="estado_padre">Estado</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="estado_padre" id="estado_padre"></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="municipio_padre">Municipio</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="municipio_padre" id="municipio_padre"></select>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="ciudad_padre">Ciudad</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="ciudad_padre" id="ciudad_padre"></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="colonia_padre">Colonia</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="colonia_padre" id="colonia_padre"></select>
                        </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="calle_padre">Calle</label>
                                <input type="text" class="form-control form-control-sm" id="calle_padre" name="calle_padre">
                            </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="num_padre">Número</label>
                                <input type="text" class="form-control form-control-sm" id="num_padre" name="num_padre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="telmov_padre">Telefóno Móvil</label>
                                <input type="tel" class="form-control form-control-sm" id="telmov_padre" placeholder="(55)12-34-56-78" name="telmov_padre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="telotro_padre">Otro Telefóno</label>
                                <input type="tel" class="form-control form-control-sm" id="telotro_padre" placeholder="(55)12-34-56-78" name="telotro_padre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="correo_padre">Correo electrónico</label>
                                <input type="email" class="form-control form-control-sm" id="correo_padre"placeholder="name@example.com" name="correo_padre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="trabajo_padre">Lugar de Trabajo</label>
                                <input type="text" class="form-control form-control-sm" id="trabajo_padre" name="trabajo_padre">
                            </div>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Información de la Madre</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="nombre_madre">Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_madre" name="nombre_madre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="nombre_madre2">Segundo Nombre</label>
                                <input type="text" class="form-control form-control-sm" id="nombre_madre2" name="nombre_madre2">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="apaterno_madre">Apellido Paterno</label>
                                <input type="text" class="form-control form-control-sm" id="apaterno_madre" name="apaterno_madre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="amaterno_madre">Apellido Materno</label>
                                <input type="text" class="form-control form-control-sm" id="amaterno_madre" name="amaterno_madre">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label for="pais" style="font-size: 14px;" class="form-label">Parentesco</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="parentesco_madre" id="parentesco_madre">
                                    <option selected>Selecciona una opción</option>
                                    <option value="PADRE">Padre</option>
                                    <option value="MADRE">Madre</option>
                                    <option value="ABUELO">Abuelo(a)</option>
                                    <option value="TIO">Tío(a)</option>
                                    <option value="HERMANO">Hermano(a)</option>
                                    <option value="TUTOR">Tutor(a)</option>
                                    <option value="OTRO">Otro(a)</option>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="zip_code_madre">Código Postal</label>
                                <input type="text" class="form-control form-control-sm" id="zip_code_madre" name="zip_code_madre" placeholder="00100">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="estado_madre">Estado</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="estado_madre" id="estado_madre"></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="municipio_madre">Municipio</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="municipio_madre" id="municipio_madre"></select>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="ciudad_madre">Ciudad</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="ciudad_madre" id="ciudad_madre"></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="colonia_madre">Colonia</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="colonia_madre" id="colonia_madre"></select>
                        </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="calle_madre">Calle</label>
                                <input type="text" class="form-control form-control-sm" id="calle_madre" name="calle_madre">
                            </div>
                        <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="num_madre">Número</label>
                                <input type="text" class="form-control form-control-sm" id="num_madre" name="num_madre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="telmov_madre">Telefóno Móvil</label>
                                <input type="tel" class="form-control form-control-sm" id="telmov_madre" placeholder="(55)12-34-56-78" name="telmov_madre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="telotro_madre">Otro Telefóno</label>
                                <input type="tel" class="form-control form-control-sm" id="telotro_madre" placeholder="(55)12-34-56-78" name="telotro_madre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="correo_madre">Correo electrónico</label>
                                <input type="email" class="form-control form-control-sm" id="correo_madre"placeholder="name@example.com" name="correo_madre">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="trabajo_madre">Lugar de Trabajo</label>
                                <input type="text" class="form-control form-control-sm" id="trabajo_madre" name="trabajo_madre">
                            </div>
                        </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Información de empleo</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="empresa">Empresa</label>
                                <input type="text" class="form-control form-control-sm" id="empresa" name="empresa">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="zip_code_emp">Código Postal Empresa</label>
                                <input type="text" class="form-control form-control-sm" id="zip_code_emp" name="zip_code_emp" placeholder="00100">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="estado_emp">Estado</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="estado_emp" id="estado_emp"></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="municipio_emp">Municipio</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="municipio_emp" id="municipio_emp"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="colonia_emp">Colonia</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="colonia_emp" id="colonia_emp"></select>
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="dir_emp">Calle y Número</label>
                                <input type="text" class="form-control form-control-sm" name="dir_emp" id="dir_emp">
                            </div>
                            <div class="col form-group">
                                <label style="font-size: 14px;" class="form-label" for="puesto">Puesto</label>
                                <select class="form-select form-select-sm mb-3 shadow-none" name="puesto" id="puesto">
                                    <?php require_once 'option-form/position_emp.php'; ?>
                                </select>
                            </div>
                            <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="fecha_ingemp">Fecha de ingreso al empleo</label>
                                        <input style="font-size: 14px;" type="date" class="form-control" id="fecha_ingemp" name="fecha_ingemp">
                                    </div>
                        </div>
                      
                </div>
            </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col align-items-center text-center">
                                <button type="submit" class="btn btn-primary">Enviar datos para validación</button>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                    </div>
            </form>
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
    <!-- Custom Script -->
    <script src="../../../assets/js/form_syncprospect.js"></script>
  </body>
</html>