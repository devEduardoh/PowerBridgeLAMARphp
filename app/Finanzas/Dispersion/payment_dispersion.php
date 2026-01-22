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
   <form action="" enctype="multipart/form-data">
    <div class="row justify-content-center">
        <div>

            <!-- Card principal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        Dispersión de Cobranza PowerCampus
                    </h4>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <label for="file" class="form-label fw-semibold">
                            Archivo de dispersión
                        </label>
                        <input 
                            type="file" 
                            class="form-control"
                            id="file"
                            required
                        >
                        <small class="text-muted">
                            Selecciona el archivo generado por PowerCampus.
                        </small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-play me-1"></i>
                            Ejecutar dispersión
                        </button>
                    </div>
                </div>
            </div>

            <!-- Resultado de la cobranza -->
            <div class="card">
                <div class="card-body">
                    <h6 class="text-primary fw-semibold mb-3">
                        <i class="ti ti-report-analytics me-2"></i>
                        Resultado de la cobranza
                    </h6>

                    <div class="alert alert-light mb-0">
                        <span class="text-muted">
                            Aún no se ha ejecutado ningún proceso de dispersión.
                        </span>
                    </div>
                </div>
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