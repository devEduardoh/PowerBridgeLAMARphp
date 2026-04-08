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

require_once '../../../logic/conn_ms.php';
require_once '../../../logic/conn_dis.php';

$error_post = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idlote'])) {
        
        $id_lote_valida = $_POST['idlote'];
        $lineas = $_POST['lineas'];
        require_once 'process/ngprocesadisp.php';
        $result_PrDis = execute_NGDispersion($id_lote_valida, $id_user, $conn, $mysqli, $lineas);

    }else{
        $error_post = 'NO SE ENVIARON DATOS';
        exit();
    }

?>
<!doctype html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Dispersion | PowerBridge</title>
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
      <link rel="stylesheet" href="../../../assets/css/main.css"/>
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
   
    <div class="row justify-content-center">
        <div>
        
            <!-- Card principal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        Resultado dispersión de Cobranza en PowerCampus
                    </h4>
                </div>

                <div class="card-body">
                    <?php  
                    
                            
                            $idloteProcesa = $result_PrDis['lote_procesa'];

                            require_once 'process/getprocesadisp.php';
                            $result_getProcesa = getProcesa( $idloteProcesa, $conn);
                            if($result_getProcesa['status_result'] > 0) {
                        ?>

                            <div class="table-scroll-container table-responsive">
                            <table class="table table-striped" id="procesa-table">
                            <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Registro (No.Linea)</th>
                                    <th>Año</th>
                                    <th>Periodo</th>
                                    <th>Sesión</th>
                                    <th>Id PwC</th>
                                    <th>Campus</th>
                                    <th>Sucursal</th>
                                    <th>Forma de Pago</th>
                                    <th>Monto</th>
                                    <th>Fecha de Pago</th>
                                    <th>Resultado Procesa/Dispersión</th>
                                    <th>Detalle Procesa/Dispersión</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $result_getProcesa['rows']; ?>
                            </tbody>                            
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                                <a href="payment_dispersion.php" class="btn btn-primary">Regresar</a>
                                        </td>
                                        <td colspan="2">
                                                <button class="btn btn-primary" onclick="copiarTabla()">Copiar Resultado </button>
                                        </td>
                                        <td colspan="6" style="font-size: small; color: red;">
                                            <?php 
                                            if($result_getProcesa['ERR_NGPROCESA'] > 0) {
                                                echo "<strong>Hay registros que NO fueron procesados por PwC. Por favor revisar detalle en columna 'Detalle Procesa/Dispersión'
                                                <br>Se deben de validar y ajustar dichos registros para poder procesarlos.</strong>";
                                            }
                                            ?>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                            <?php

                            }else{

                                echo '<div class="alert alert-warning  mt-3" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg>
                                            <strong>Hubo un error al recuperar los registros del lote'.$idloteProcesa.'</strong>
                                        </div>';
                            }
                            if($lineas != $result_PrDis['contadores']['cont_ngPrDisOk'] OR $lineas != $result_PrDis['contadores']['cont_updlog']
                            OR ($result_PrDis['contadores']['cont_ngPrDisErr'] + $result_PrDis['contadores']['cont_errUpdlog']) > 0){
                    
                    ?>

            <div class="alert alert-warning  mt-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                    <strong>El lote se proceso con errores</strong>
            </div>
            <div class="alert alert-warning  mt-3" role="alert">
                        Lote: <?php echo $result_PrDis['lote_procesa']; ?> <br>
                        Registros con error en dispersión: <?php echo $result_PrDis['contadores']['cont_ngPrDisErr']; ?> <br>
                        Registros con error en log: <?php echo $result_PrDis['contadores']['cont_errUpdlog']; ?> <br>   
                        Registros procesados PwC: <?php echo $result_PrDis['contadores']['cont_ngPrDisOk']; ?> <br>   
                        Registros Actualizados en Log: <?php echo $result_PrDis['contadores']['cont_updlog']; ?> <br>
            </div>
            <div class="alert alert-secondary" role="alert">
                        Detalle de errores en validación PwC: <br>
                        <p style="font-size: small;"><em><?php echo $result_PrDis['contadores']['detalle_err_ngPrDisp']; ?></em></p>
                        <pre style="white-space: pre-wrap;"></pre>
                        Detalle de errores insercción en Log: <br>
                        <p style="font-size: small;"><em><?php echo $result_PrDis['contadores']['detalle_err_Updlog']; ?></em></p>
            </div>
                       <?php 
                    }
                       
                       ?> 
                </div>
            </div>

        </div>
    </div>


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
    <script>
        // Copia la tabla de usuarios al portapapeles para compartir accesos rapidamente.
        function copiarTabla() {
            let tabla = document.getElementById("procesa-table");
            let rango = document.createRange();
            rango.selectNode(tabla);
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(rango);
            window.alert("Contenido copiado, pegue en una hoja de excel");
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
        }
    </script>

  </body>
</html>