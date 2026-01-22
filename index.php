<?php
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
   $ip = $_SERVER['REMOTE_ADDR'];
}
if($ip == '::1' OR $ip == '200.52.75.186' OR $ip == '10.0.1.25' OR $ip == '10.0.1.6' OR $ip == '192.168.1.13' OR $ip == '127.0.0.1')
{
$message_error = '';
if(isset($_GET['error'])){
    $error = $_GET['error'];
    switch($error){
      case 1:
        $message_error = '<div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
                                 <span>Contraseña incorrecta, verifique sus credenciales</span>
                                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
      break;
      case 2:
         $message_error = '<div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
                                 <span>Usuario o contraseña incorrectos, verifique sus credenciales</span>
                                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
        
      break;
      case 3:
        $message_error = '<div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
                                 <span>Contraseña incorrecta, solicite un restablecimiento al administrador del sistema</span>
                                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
      break;
      case 4:
        $message_error = '<div class="alert alert-left alert-success alert-dismissible fade show mb-3" role="alert">
                                 <span> Contraseña actualizada de manera correcta, ingrese con sus nuevas credenciales</span>
                              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
      break;
      case 5:
        $message_error = '<div class="alert alert-right alert-warning alert-dismissible fade show mb-3" role="alert">
                                 <span>Error al actualizar contraseña, intente nuevamente</span>
                                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
      break;
      case 6:
        $message_error = '<div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
                                 <span>No se enviaron datos de acceso</span>
                                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
      break;
      case 7:
            $message_error = '<div class="alert alert-right alert-warning alert-dismissible fade show mb-3" role="alert">
                                 <span>Usuario inactivo, contactar al administrador del sistema</span>
                                 <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>';
      break;
    }

}else{
    $error = 0;
}
?>
<!doctype html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>PowerBridge</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico" />
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="assets/css/core/libs.min.css" />
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="assets/css/hope-ui.min.css?v=2.0.0" />
      <!-- Custom Css -->
      <link rel="stylesheet" href="assets/css/custom.min.css?v=2.0.0" />
      <!-- Dark Css -->
      <link rel="stylesheet" href="assets/css/dark.min.css"/>
      <!-- Customizer Css -->
      <link rel="stylesheet" href="assets/css/customizer.min.css" />
      <!-- RTL Css -->
      <link rel="stylesheet" href="assets/css/rtl.min.css"/>
  </head>
  <body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
            <div class="col-md-6">
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">
                           <a href="../../dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">
                              <img src="assets/images/logo_m.png" class="img-fluid" width="100%" height="50px"></img>
                           </a>
                           <div class="text-center align-items-center">
                              <img src="assets/images/brands/LogotipoInstitucion.png" class="img-fluid" width="200" height=""></img>
                           </div>
                           <p class="text-center">Iniciar Sesión</p>
                           <form action="logic/session/session.php" method="POST">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="user" class="form-label">Usuario</label>
                                       <input type="text" class="form-control" id="user" aria-describedby="Usuario" placeholder=" " required name="usuario">
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="password" class="form-label">Contraseña</label>
                                       <input type="password" class="form-control" id="password" aria-describedby="password" placeholder=" " name="password" required>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                       <input type="checkbox" class="form-check-input" id="customCheck1">
                                       <label class="form-check-label" for="customCheck1">Recordar Acceso</label>
                                    </div>
                                    <a href="#">¿Olvidaste tu contraseña?</a>
                                 </div>
                              </div>
                              <div class="d-flex justify-content-center">
                                 <button type="submit" class="btn btn-primary">Ingresar</button>
                              </div>
                           </form>
                           <p class="mt-3 text-center">
                                 ¿No tienes una cuenta de PowerBridge? <a href="#" class="text-underline">Solicita tu acceso.</a>
                              </p>
                                 <?php echo $message_error; ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sign-bg">
                  <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                     <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                     <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                     <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                     <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                     </g>
                  </svg>
               </div>
            </div>
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="assets/images/auth/01.jpg" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
         </div>
      </section>
      </div>
    
    <!-- Library Bundle Script -->
    <script src="assets/js/core/libs.min.js"></script>
    <!-- External Library Bundle Script -->
    <script src="assets/js/core/external.min.js"></script>    
    <!-- Widgetchart Script -->
    <script src="assets/js/charts/widgetcharts.js"></script>    
    <!-- mapchart Script -->
    <script src="assets/js/charts/vectore-chart.js"></script>
    <script src="assets/js/charts/dashboard.js" ></script>    
    <!-- fslightbox Script -->
    <script src="assets/js/plugins/fslightbox.js"></script>    
    <!-- Settings Script -->
    <script src="assets/js/plugins/setting.js"></script>    
    <!-- Slider-tab Script -->
    <script src="assets/js/plugins/slider-tabs.js"></script>    
    <!-- Form Wizard Script -->
    <script src="assets/js/plugins/form-wizard.js"></script>    
    <!-- AOS Animation Plugin-->    
    <!-- App Script -->
    <script src="assets/js/hope-ui.js" defer></script>
  </body>
</html>
<?php 
}else{
   echo '<h1 style="color: red;"><b>Acceso denegado</b></h1>';
 }
?>