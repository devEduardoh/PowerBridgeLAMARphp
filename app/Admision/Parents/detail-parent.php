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

$val_parent = 0;
require_once '../../../logic/conn_ss.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ParentId = $_POST['ParentId']; // Obtener el valor del campo 'id'
    
    $val_parent;
    
    $sql_p = "SELECT DISTINCT TOP 1 PAR.ParentId, PAR.PEOPLE_CODE_ID, PAR.PARENT_TYPE, PAR.FIRST_NAME, PAR.MIDDLE_NAME, PAR.LAST_NAME
                , PAR.Last_Name_Prefix, PAR.ADDRESS_LINE_1, PAR.ADDRESS_LINE_2, PAR.ZIP_CODE, PAR.CITY, CTY.LONG_DESC COUNTY
                , STA.LONG_DESC STATE, PAR.CELPHONE, PAR.OTHERPHONE, PAR.Email, PAR.WORKPLACE, PAR.SOURCE, PAR.CREATE_DATE, PAR.CREATE_TIME
                , PAR.CREATE_OPID, PAR.REVISION_DATE, PAR.REVISION_TIME, PAR.REVISION_OPID, PE.LegalName, PE.PEOPLE_ID
                FROM NG_Parents PAR
                INNER JOIN PEOPLE PE ON PAR.PEOPLE_CODE_ID = PE.PEOPLE_CODE_ID
                LEFT OUTER JOIN CODE_COUNTY CTY ON CTY.CODE_VALUE_KEY = PAR.COUNTY
                LEFT OUTER JOIN CODE_STATE STA ON STA.CODE_VALUE_KEY = PAR.STATE
                WHERE PAR.ParentId = $ParentId";
    //echo $sql_p;
                
    $get_p = sqlsrv_query($conn, $sql_p);
                    if($get_p == FALSE){
                        print_r(sqlsrv_errors());
                    }else{
                            $val_parent = sqlsrv_has_rows( $get_p );
                        }
    
    
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
    <?php if($val_parent === True) {
        $source;
        $rowp = sqlsrv_fetch_array($get_p, SQLSRV_FETCH_ASSOC);
        if($rowp['SOURCE'] == 'UD3'){$source = "de la madre";}elseif($rowp['SOURCE'] == 'UD1'){$source = "del padre";}else{$source = "NO IDENTIFICADO";}
        ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h5 class="mb-1">Actualizar registro <?php echo $source; ?> Parentesco: <?php echo ucfirst(strtolower($rowp['PARENT_TYPE'])); ?></h5>
                        <p class="mb-1">Alumno(a): <?php echo $rowp['LegalName']; ?></p>
                        <small class="text-muted">ID: <?php echo $rowp['PEOPLE_CODE_ID']; ?></small>
                    </div>
                </div>
                <div class="card-body">

                                    <form action="process/update_parent.php" method="post">                        
                                    <div class="row">                        
                                    <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="nombre">Primer Nombre</label>
                                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="<?php echo $rowp['FIRST_NAME']; ?>" required>
                                    </div>
                                    <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="nombre2">Segundo Nombre</label>
                                        <input type="text" class="form-control form-control-sm" id="nombre2" name="nombre2" value="<?php echo $rowp['MIDDLE_NAME']; ?>">
                                    </div>
                                    <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="apaterno">Apellido Paterno</label>
                                        <input type="text" class="form-control form-control-sm" id="apaterno" name="apaterno" value="<?php echo $rowp['LAST_NAME']; ?>" required>
                                    </div>
                                    <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="amaterno">Apellido Materno</label>
                                        <input type="text" class="form-control form-control-sm" id="amaterno" name="amaterno" value="<?php echo $rowp['Last_Name_Prefix']; ?>">
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col form-group">
                                    <label for="pais" style="font-size: 14px;" class="form-label" for="parentesco">Parentesco</label>
                                        <select class="form-select form-select-sm mb-3 shadow-none" name="parentesco" id="parentesco" required onchange="validateParentesco()">
                                            <option value="">Selecciona una opción</option>
                                            <option value="PADRE" <?php echo ($rowp['PARENT_TYPE'] == 'PADRE') ? 'selected' : ''; ?>>Padre</option>
                                            <option value="MADRE" <?php echo ($rowp['PARENT_TYPE'] == 'MADRE') ? 'selected' : ''; ?>>Madre</option>
                                            <option value="ABUELO" <?php echo ($rowp['PARENT_TYPE'] == 'ABUELO') ? 'selected' : ''; ?>>Abuelo(a)</option>
                                            <option value="TIO" <?php echo ($rowp['PARENT_TYPE'] == 'TIO') ? 'selected' : ''; ?>>Tío(a)</option>
                                            <option value="HERMANO" <?php echo ($rowp['PARENT_TYPE'] == 'HERMANO') ? 'selected' : ''; ?>>Hermano(a)</option>
                                            <option value="TUTOR" <?php echo ($rowp['PARENT_TYPE'] == 'TUTOR') ? 'selected' : ''; ?>>Tutor(a)</option>
                                            <option value="OTRO" <?php echo ($rowp['PARENT_TYPE'] == 'OTRO') ? 'selected' : ''; ?>>Otro(a)</option>
                                        </select>
                                        <script>
                                        function validateParentesco() {
                                            var select = document.getElementById('parentesco');
                                            if (select.value === '') {
                                                select.setCustomValidity('Por favor seleccione un parentesco');
                                            } else {
                                                select.setCustomValidity('');
                                            }
                                        }
                                        </script>
                                        </div>
                                    <div class="col form-group">        
                                    <label style="font-size: 14px;" class="form-label" for="zip_code">Código Postal</label>
                                    <input type="text" class="form-control form-control-sm" id="zip_code" name="zip_code" value="<?php echo $rowp['ZIP_CODE']; ?>" required>
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
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="ciudad" id="ciudad"></select>
                                        </div>
                                        <div class="col form-group">
                                        <label style="font-size: 14px;" class="form-label" for="colonia">Colonia</label>
                                    <select class="form-select form-select-sm mb-3 shadow-none" name="colonia" id="colonia"></select>
                                    </div>
                                    <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="calle">Calle y Número</label>
                                    <input type="text" class="form-control form-control-sm" id="calle" name="calle" value="<?php echo $rowp['ADDRESS_LINE_1']; ?>">
                                    </div>
                                    </div>

                                    <div class="row">
                                    <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="telmov">Telefóno Móvil</label>
                                    <input type="tel" class="form-control form-control-sm" id="telmov" name="telmov" value="<?php echo $rowp['CELPHONE']; ?>">
                                    </div>
                                    <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="telotro">Otro Telefóno</label>
                                    <input type="tel" class="form-control form-control-sm" id="telotro" name="telotro" value="<?php echo $rowp['OTHERPHONE']; ?>">
                                    </div>
                                    <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="correo">Correo electrónico</label>
                                    <input type="email" class="form-control form-control-sm" id="correo" name="correo" value="<?php echo $rowp['Email']; ?>">
                                    </div>
                                    <div class="col form-group">
                                    <label style="font-size: 14px;" class="form-label" for="trabajo">Lugar de Trabajo</label>
                                    <input type="text" class="form-control form-control-sm" id="trabajo" name="trabajo" value="<?php echo $rowp['WORKPLACE']; ?>">  
                                    </div>
                                    
                                    <input type="hidden" name="ParentId" value="<?php echo $ParentId; ?>">
                                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                                    <input type="hidden" name="id" value="<?php echo $rowp['PEOPLE_ID']; ?>";>
                                    <br>
                                    
                                    </div>
                                    <hr>
                                    <div class="row">
                                    <div class="col form-group"></div>
                                    <div class="col form-group"></div>
                                    <div class="col form-group"><button type="submit" class="btn btn-warning">Actualizar Registro</button>
                                    </form>
                                    </div>
                                    <div class="col form-group"><form action="parents.php" method="post">
                                                                <input type="hidden" name="id" value="<?php echo $rowp['PEOPLE_ID']; ?>";>
                                                                <input type="hidden" name="update" value="0">
                                                                <button type="submit" class="btn btn-info">Cancelar</button>
                                                                </form>
                                    </div>
                                    </div>
            </div>
    </div>
    <?php 
        } // Cierre despliegue de contenido de padres
    ?>
   
</div>  <!-- cierre del Frame -->
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
    <!-- Form Script -->
    <script src="../../../assets/js/form_syncprospect.js"></script>
  </body>
</html><?php 

} // Cierre validación datos por POST
?>