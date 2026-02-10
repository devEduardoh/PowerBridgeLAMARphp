<?php 
session_start();
if (!isset($_SESSION['iduser'])) {
    header('Location: ../index.php');
    exit();
}elseif(isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])){ 
   $id_user = $_SESSION['iduser'];
   $name = $_SESSION['names'];
   $surname = $_SESSION['surnames'];
   $des_area = $_SESSION['d_area'];
   $username = $_SESSION['username'];
   require_once '../logic/conn_ms.php';
}else{
    header('Location: ../index.php');
    exit();
}

require_once 'Permissions/menus.php';

$id_menu = 0;
$des_menu = "Inicio";

if(isset($_GET['m']) && !empty($_GET['m'])){
   
   $id_menu = intval($_GET['m']);
   $des_menu = getDesMenu($mysqli, $id_menu);
   // Recuperar nombre del menú desde la base de datos
  }



?>
<!doctype html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>PowerBridge | <?php echo $des_menu; ?></title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="../assets/images/favicon.ico" />
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../assets/css/core/libs.min.css" />
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../assets/css/hope-ui.min.css?v=2.0.0" />
      <!-- Custom Css -->
      <link rel="stylesheet" href="../assets/css/custom.min.css?v=2.0.0" />
      <!-- Dark Css -->
      <link rel="stylesheet" href="../assets/css/dark.min.css"/>
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../assets/css/customizer.min.css" />
      <!-- RTL Css -->
      <link rel="stylesheet" href="../assets/css/rtl.min.css"/>
      <link rel="stylesheet" href="../assets/css/main.css"/>
  </head>
  <body class="boxed-fancy">
    <div class="boxed-inner">
      <!-- loader Start -->
      <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>      </div>
      <!-- loader END -->
      <span class="screen-darken"></span>
      <main class="main-content">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
          <div class="container-fluid navbar-inner">
            <button data-trigger="navbar_main" class="d-lg-none btn btn-primary rounded-pill p-1 pt-0" type="button">
              <svg class="icon-20" width="20px"  viewBox="0 0 24 24">
                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
            </svg>
            </button>
            <a href="#" class="navbar-brand">
                <!--Logo start-->
                <img src="../assets/images/logo_m.png" class="img-fluid" width="195" height="33"></img>
                <!--logo End-->
            </a>
            <!-- Horizontal Menu Start -->
            <nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav mx-md-auto">
            <div class="container-fluid">
               <div class="offcanvas-header px-0">
                  <div class="navbar-brand ms-3">
                     <!--Logo start-->
                     <!--logo End-->
                     
                     <!--Logo start-->
                     <div class="logo-main">
                         <div class="logo-normal">
                           <img src="../assets/images/logo_m.png" class="img-fluid" width="195" height="33"></img>
                         </div>
                         <div class="logo-mini">
                           <img src="../assets/images/logo_m.png" class="img-fluid" width="195" height="33"></img>
                         </div>
                     </div>
                     <!--logo End-->
                  </div>
                  <button class="btn-close float-end"></button>
               </div>
               <ul class="navbar-nav">
                  <?php 
                  
                  $menus = getUserMenus($mysqli, $id_user, $id_menu);
                  if (empty($menus)) {
                     error_log('No menus returned for user ' . $id_user.' '.$usrname.' '.$surname);
                 }
                 echo $menus;
                  ?>
               </ul>
            </div> <!-- container-fluid.// -->
            </nav>
            <!-- Sidebar Menu End -->    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon">
                  <span class="navbar-toggler-bar bar1 mt-2"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                  <a href="../logic/session/logout.php"  class="nav-link" id="notification-drop">
                     <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.4" d="M7.29639 6.446C7.29639 3.995 9.35618 2 11.8878 2H16.9201C19.4456 2 21.5002 3.99 21.5002 6.436V17.552C21.5002 20.004 19.4414 22 16.9098 22H11.8775C9.35205 22 7.29639 20.009 7.29639 17.562V16.622V6.446Z" fill="currentColor"></path>                                <path d="M16.0374 11.4538L13.0695 8.54482C12.7627 8.24482 12.2691 8.24482 11.9634 8.54682C11.6587 8.84882 11.6597 9.33582 11.9654 9.63582L13.5905 11.2288H3.2821C2.85042 11.2288 2.5 11.5738 2.5 11.9998C2.5 12.4248 2.85042 12.7688 3.2821 12.7688H13.5905L11.9654 14.3628C11.6597 14.6628 11.6587 15.1498 11.9634 15.4518C12.1168 15.6028 12.3168 15.6788 12.518 15.6788C12.717 15.6788 12.9171 15.6028 13.0695 15.4538L16.0374 12.5448C16.1847 12.3998 16.268 12.2038 16.268 11.9998C16.268 11.7948 16.1847 11.5988 16.0374 11.4538Z" fill="currentColor"></path></svg>
                      <span class="bg-danger dots"></span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../assets/images/avatars/04.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                    <div class="caption ms-3 d-none d-md-block">
                        <h6 class="mb-0 caption-title"><?php echo $name." ".$surname;?></h6>
                        <p class="mb-0 caption-sub-title"><?php echo $des_area; ?></p>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>        <!--Nav End-->
        <div class="conatiner-fluid content-inner pb-0">
<div class="row">
   <div class="col-md-12 col-lg-12">
      <div class="row row-cols-1">
         <div class="d-slider1 overflow-hidden ">
            <ul  class="swiper-wrapper list-inline m-0 p-0 mb-2">
               <li class="swiper-slide card card-slide">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div class="text-center">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.53162 2.93677C10.7165 1.66727 13.402 1.68946 15.5664 2.99489C17.7095 4.32691 19.012 6.70418 18.9998 9.26144C18.95 11.8019 17.5533 14.19 15.8075 16.0361C14.7998 17.1064 13.6726 18.0528 12.4488 18.856C12.3228 18.9289 12.1848 18.9777 12.0415 19C11.9036 18.9941 11.7693 18.9534 11.6508 18.8814C9.78243 17.6746 8.14334 16.134 6.81233 14.334C5.69859 12.8314 5.06584 11.016 5 9.13442C4.99856 6.57225 6.34677 4.20627 8.53162 2.93677ZM9.79416 10.1948C10.1617 11.1008 11.0292 11.6918 11.9916 11.6918C12.6221 11.6964 13.2282 11.4438 13.6748 10.9905C14.1214 10.5371 14.3715 9.92064 14.3692 9.27838C14.3726 8.29804 13.7955 7.41231 12.9073 7.03477C12.0191 6.65723 10.995 6.86235 10.3133 7.55435C9.63159 8.24635 9.42664 9.28872 9.79416 10.1948Z" fill="currentColor"></path><ellipse opacity="0.4" cx="12" cy="21" rx="5" ry="1" fill="currentColor"></ellipse></svg>
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Institución</p>
                           <!--h4 class="counter">ICEL</h4-->
                           <img src="../assets/images/brands/LogotipoInstitucion.png" class="img-fluid" width="80" height=""></img>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div class="text-center">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856ZM20.4933 4.89833C21.3244 4.89833 22 5.56203 22 6.37856C22 7.19618 21.3244 7.85989 20.4933 7.85989H13.9178C13.0856 7.85989 12.4101 7.19618 12.4101 6.37856C12.4101 5.56203 13.0856 4.89833 13.9178 4.89833H20.4933ZM3.50777 15.958H10.0833C10.9155 15.958 11.5911 16.6217 11.5911 17.4393C11.5911 18.2558 10.9155 18.9206 10.0833 18.9206H3.50777C2.67555 18.9206 2 18.2558 2 17.4393C2 16.6217 2.67555 15.958 3.50777 15.958ZM18.5611 20.7778C20.4611 20.7778 22 19.2648 22 17.3992C22 15.5325 20.4611 14.0196 18.5611 14.0196C16.6623 14.0196 15.1223 15.5325 15.1223 17.3992C15.1223 19.2648 16.6623 20.7778 18.5611 20.7778Z" fill="currentColor"></path>
                           </svg>                        
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Data</p>
                           <h4 class="counter">Campus</h4>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div class="text-center">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>                                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                          </svg>
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Modúlo</p>
                           <h4 class="counter"><?php echo $des_menu; ?></h4>
                        </div>
                     </div>
                  </div>
               </li>
               <li class="swiper-slide card card-slide">
                  <div class="card-body">
                     <div class="progress-widget">
                        <div class="text-center">
                           <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.67 1.99927H16.34C19.73 1.99927 22 4.37927 22 7.91927V16.0903C22 19.6203 19.73 21.9993 16.34 21.9993H7.67C4.28 21.9993 2 19.6203 2 16.0903V7.91927C2 4.37927 4.28 1.99927 7.67 1.99927ZM11.99 9.06027C11.52 9.06027 11.13 8.66927 11.13 8.19027C11.13 7.70027 11.52 7.31027 12.01 7.31027C12.49 7.31027 12.88 7.70027 12.88 8.19027C12.88 8.66927 12.49 9.06027 11.99 9.06027ZM12.87 15.7803C12.87 16.2603 12.48 16.6503 11.99 16.6503C11.51 16.6503 11.12 16.2603 11.12 15.7803V11.3603C11.12 10.8793 11.51 10.4803 11.99 10.4803C12.48 10.4803 12.87 10.8793 12.87 11.3603V15.7803Z" fill="currentColor"></path>
                          </svg>
                        </div>
                        <div class="progress-detail">
                           <p  class="mb-2">Versión</p>
                           <h4 class="counter">0.3</h4>
                        </div>
                     </div>
                  </div>
               </li>
               
            </ul>
            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-lg-2">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="card">
               <div class="card-header d-flex justify-content-between flex-wrap">
                  <div class="header-title">
                     <h4 class="card-title mb-2">Actividades</h4>
                     <p class="mb-0">
                        <svg class ="me-2 icon-24" width="24"  viewBox="0 0 24 24">
                           <path fill="#17904b" d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" />
                        </svg>
                        Opciones
                     </p>
                  </div>
               </div>
               <div class="card-body">
               <?php require_once 'Permissions/operations.php'; 
                  $options = getUserOperations($mysqli, $id_user, $id_menu);
                  if (empty($options)) {
                     error_log('No options returned for user ' . $id_user.' '.$username.' '.$surname);
                 }
                 echo $options;

                 if($id_menu == 0){
                     echo '<div class=" d-flex profile-media align-items-top mb-2">
                     <div class="profile-dots-pills border-primary mt-1"></div>
                     <div class="ms-4">
                        <a><p class=" mb-1">Seleccione una opción del menú para listar las actividades</p></a>
                     </div>
                  </div>';
                     

                 }

                  ?>

               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-12 col-lg-10">
      <div class="row">
      <div class="iframe-container">
         <iframe name="frame-cont"  frameborder="0"></iframe>
         </div>
      </div>
   </div> 
</div>
        </div>
        <!-- Footer Section Start -->
        <footer class="footer">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                    <li class="list-inline-item"><a href="#">Mapa de Sitio</a></li>
                </ul>
                <div class="right-panel">
                    ©<script>document.write(new Date().getFullYear())</script> Nacer Global.
                    Dirección de Tecnologías de Información
                    <span class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pc" viewBox="0 0 16 16">
                     <path d="M5 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm.5 14a.5.5 0 1 1 0 1 .5.5 0 0 1 0-1m2 0a.5.5 0 1 1 0 1 .5.5 0 0 1 0-1M5 1.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5M5.5 3h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1"/>
                     </svg>
                     </span>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->      </main>
      <!-- Wrapper End-->
    <!-- Library Bundle Script -->
    <script src="../assets/js/core/libs.min.js"></script>
    <!-- External Library Bundle Script -->
    <script src="../assets/js/core/external.min.js"></script>
    <!-- Widgetchart Script -->
    <script src="../assets/js/charts/widgetcharts.js"></script>
    <!-- mapchart Script -->
    <script src="../assets/js/charts/vectore-chart.js"></script>
    <script src="../assets/js/charts/dashboard.js" ></script>
    <!-- fslightbox Script -->
    <script src="../assets/js/plugins/fslightbox.js"></script>
    <!-- Settings Script -->
    <script src="../assets/js/plugins/setting.js"></script>
    <!-- Slider-tab Script -->
    <script src="../assets/js/plugins/slider-tabs.js"></script>
    <!-- Form Wizard Script -->
    <script src="../assets/js/plugins/form-wizard.js"></script>
    <!-- AOS Animation Plugin-->
    <!-- App Script -->
    <script src="../assets/js/hope-ui.js" defer></script>
  </body>
</html>