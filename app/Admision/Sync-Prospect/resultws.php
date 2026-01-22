<?php 
if(!empty($_GET)){
$status = $_GET['e'];

$res_pwc = $_GET['i'];

$message = $_GET['m'];

$array_res = explode('|', $res_pwc);

$id_pwc = $array_res[0];
$cargo = $array_res[1];

$array_cargo = explode('@', $cargo);

$no_cargo = $array_cargo[0];
$monto_ficha = $array_res[4];

if($status == 200){
    $m_result = 'Registro Correcto';
    $bg = 'bg-success';
}else{
    $m_result = 'Error al generar el envío a Power Campus';
    $bg = 'bg-warning';
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


    <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                      <h3 class="card-title"><span class="badge <?php echo $bg; ?>"><?php echo $m_result ?></span></h3>
                      <p style="color: red;"><?php if($status != '200'){echo $status."<br>".$message;}?></p>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Id Power Campus: <?php echo $id_pwc; ?></li>
                        <li class="list-group-item">Monto Ficha de Pago: <?php echo '$ '.number_format($monto_ficha,2); ?></li>
                    </ul>
                    <br><br>
                    <a class="btn btn-primary" href="http://ng-pwrc-ss3upo/ReportServer/Pages/ReportViewer.aspx?%2fNacer%2fReference_ChargeCredit_UPO&rs:Format=PDF&ChargesId=<?php echo $no_cargo; ?>">Descargar ficha de pago</a>
                    <p style="font-size: 12px; color: grey;">Clic derecho y seleccionar "Abrir enlace en una pestaña nueva" para descargar</p>
                    <br>
                    <a class="btn btn-primary" href="http://10.0.1.6:8080/ProdNG/ReportesPwC-UPO/fichaInscripcionUPO/solFichaInsc.php?idpwc=<?php echo ltrim($id_pwc, 'P'); ?>">Formato de Inscripción</a>
                    <p style="font-size: 12px; color: grey;">Clic derecho y seleccionar "Abrir enlace en una pestaña nueva" para descargar</p>
                </div>
    </div>    
    <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center text-center">
                            <div class="col">
                                <a href="sync-prospect.php" class="btn btn-warning">Regresar a formulario de captura</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center text-center">
                            <div class="col">
                            <div class="input-group">
                                <span class="input-group-text">Respuesta Servicio de Integración</span>
                                <textarea class="form-control" aria-label="With textarea" rows="10" cols="30" style="font-size: 12px; font-style: italic;">
                                  <?php 
                                  echo "Estatus: ". $status;
                                  echo "\n";
                                  echo $res_pwc;
                                  echo "\n";
                                  echo $message;
                                  ?>
                                </textarea>
                            </div>
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
} // Cierra validación de GET
?>