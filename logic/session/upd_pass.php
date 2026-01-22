<?php
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip = $_SERVER['REMOTE_ADDR'];
}
if($ip == '::1' OR $ip == '200.52.75.186' OR $ip == '10.0.1.25' OR $ip == '10.0.1.6')
{
require_once '../conn_ms.php';
$error = 0;
if(!empty($_GET)){ 
    $iduser = $_GET['u_'];
    $m = '';
    if(!empty($_POST))
    {
        $p1 = $_POST['pass1'];
        $p2 = $_POST['pass2'];

        if($p1 != $p2){
            $m = '<div class="alert alert-right alert-warning alert-dismissible fade show mb-3" role="alert">
                        <span>Las contraseñas no coinciden, intente de nuevo</span>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
          }
          else{
          $nvo_pass = mysqli_real_escape_string($mysqli,$_POST['pass2']);
          $pass_encrypt = password_hash($nvo_pass, PASSWORD_DEFAULT);
          
          
         $sql = "UPDATE pb_user SET pass = '$pass_encrypt', pass_temp =  NOW()  WHERE iduser = '$iduser'";
      
              if ($mysqli->query($sql) === TRUE) {            
                    header("Location:../../index.php?error=4");
                    
              } else {
                header("Location:../../index.php?error=5");
              }
            }

    }
?>
<!doctype html>
<html lang="es" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Actualice su Contraseña</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../../assets/images/favicon.ico">
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../../assets/css/core/libs.min.css">
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=4.0.0">
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../../assets/css/custom.min.css?v=4.0.0">
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../../assets/css/customizer.min.css?v=4.0.0">
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="../../assets/css/rtl.min.css?v=4.0.0">
      
      
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0" style="background-image: url('../../assets/images/auth/01.jpg'); background-size: cover;">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
          </div>
      </div>    </div>
    <!-- loader END -->
    
<div class="wrapper">
<div>
    <div class="container" style="color: aliceblue;">
        <div class="row">
            <div class="col"></div>
            <div class="col">
            <h2 class="mb-0 mt-4 text-white">Actualice su contraseña</h2>
            <br>
            <form action="<?php $_SERVER['PHP_SELF']; ?>" class="login" method="POST">
            <div class="form-group">
                                       <label for="1" class="form-label">Nueva contraseña</label>
                                       <input type="password" class="form-control" id="1" aria-describedby="new_pass" placeholder=" " name="pass1" required>
                                    </div>
                                    <div class="form-group">
                                       <label for="2" class="form-label">Confirme la contraseña</label>
                                       <input type="password" class="form-control" id="2" aria-describedby="confirm_pass" placeholder=" " name="pass2" required>
                                    </div>
                <div class="text-center">
                    <button type="submit" class="btn bg-white text-primary d-inline-flex align-items-center">Actualizar</button>
                    </form>
                    <br><br>
                    <?php echo $m; ?>
                    <br><br>
                    <a style="color: aliceblue;" href="../../">Regresar a inicio</a>
                </div>
                
            </div>
        </div>
    </div>
   
</div>
      </div>
    <!-- Library Bundle Script -->
    <script src="../../assets/js/core/libs.min.js"></script>
    <!-- External Library Bundle Script -->
    <script src="../../assets/js/core/external.min.js"></script>
    <!-- Widgetchart Script -->
    <script src="../../assets/js/charts/widgetcharts.js"></script>
    <!-- mapchart Script -->
    <script src="../../assets/js/charts/vectore-chart.js"></script>
    <script src="../../assets/js/charts/dashboard.js" ></script>
    <!-- fslightbox Script -->
    <script src="../../assets/js/plugins/fslightbox.js"></script>
    <!-- Settings Script -->
    <script src="../../assets/js/plugins/setting.js"></script>
    <!-- Slider-tab Script -->
    <script src="../../assets/js/plugins/slider-tabs.js"></script>
    <!-- Form Wizard Script -->
    <script src="../../assets/js/plugins/form-wizard.js"></script>
    <!-- AOS Animation Plugin-->
    <!-- App Script -->
    <script src="../../assets/js/hope-ui.js" defer></script>
  </body>
</html>
<?php 
}
}
?>