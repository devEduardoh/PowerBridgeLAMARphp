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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['datos']) && isset($_POST['file'])) {
        
    // Decodificar el JSON recibido
    $datos = json_decode($_POST['datos'], true);
    
    $name_file = $_POST['file'];

    if ($datos !== null && is_array($datos)) {

        $record_count = count($datos);
        
        require_once 'process/ngvalidate.php';
        $result_validate = execute_NGValida($datos, $id_user, $name_file ,$conn, $mysqli);

    }else{
        $error_post = 'NO SE ENVIARON DATOS O EL FORMATO ES INCORRECTO';
        exit();
    }

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
       
            <!-- Card principal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        Resultado validación de Cobranza en PowerCampus
                    </h4>
                </div>

                <div class="card-body">
                    <?php 
                    if($record_count == $result_validate['contadores']['cont_ngvalok'] and $record_count == $result_validate['contadores']['cont_insertlog']
                        and ($result_validate['contadores']['cont_ngvalerr'] + $result_validate['contadores']['cont_errlog']) == 0){
                            
                            $idloteValida = $result_validate['lote_valida'];

                            require_once 'process/getvalidate.php';
                            $result_getvalidate = getValida( $idloteValida, $conn);
                            if($result_getvalidate['status_result'] > 0) {
                        ?>

                            <div class="table-scroll-container table-responsive">
                            <table class="table table-striped">
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
                                    <th>Resultado Validación</th>
                                    <th>Detalle validación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $result_getvalidate['rows']; ?>
                            </tbody>                            
                                <tfoot>
                                    <tr>
                                        <td colspan="8" style="font-size: small; color: red;">
                                            <?php 
                                            if($result_getvalidate['ERR_NGVALIDA'] > 0) {
                                                echo "<strong>Existen errores en los registros validados en PwC. Por favor revisar detalle en columna 'Detalle validación'
                                                <br>Puede procesar el lote, sólo tenga en cuenta que los registros con error no serán cargados al sistema.</strong>";
                                            }
                                            ?>
                                        </td>
                                        <td colspan="4"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-12 col-lg-3">
                                <form action="payment_dispersionPwC.php" method="post">
                                                <input type="hidden" name="idlote" value="<?php echo $idloteValida; ?>">
                                                <input type="hidden" name="lineas" value="<?php echo $record_count; ?>">
                                                <button type="submit" class="btn btn-primary" id="btnEnviar">Procesar lote en PwC</button>
                                            </form>
                                </div>
                                <div class="col-md-12 col-lg-9">
                                        <div id="alertProcessing" style="display: none;">
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                         Por favor espera, se está procesando el archivo...
                                        </div>
                                        </div>
                                </div>
                            </div>
                                        
                                        
                            <?php

                            }else{

                                echo '<div class="alert alert-warning  mt-3" role="alert">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                        </svg>
                                            <strong>Hubo un error al recuperar los registros del lote'.$idloteValida.'</strong>
                                        </div>';
                            }
                        }else{
                    
                    ?>

            <div class="alert alert-warning  mt-3" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                </svg>
                    <strong>El archivo se proceso con errores</strong>
            </div>
            <div class="alert alert-warning  mt-3" role="alert">
                        Lote: <?php echo $result_validate['lote_valida']; ?> <br>
                        Registros con error en validación: <?php echo $result_validate['contadores']['cont_ngvalerr']; ?> <br>
                        Registros con error en log: <?php echo $result_validate['contadores']['cont_errlog']; ?> <br>   
                        Registros validados PwC: <?php echo $result_validate['contadores']['cont_ngvalok']; ?> <br>   
                        Registros Insertados en Log: <?php echo $result_validate['contadores']['cont_insertlog']; ?> <br>
            </div>
            <div class="alert alert-secondary" role="alert">
                        Detalle de errores en validación PwC: <br>
                        <p style="font-size: small;"><em><?php echo $result_validate['contadores']['detalle_err_ngval']; ?></em></p>
                        <pre style="white-space: pre-wrap;"></pre>
                        Detalle de errores insercción en Log: <br>
                        <p style="font-size: small;"><em><?php echo $result_validate['contadores']['detalle_err_log']; ?></em></p>
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
        document.addEventListener('DOMContentLoaded', function () {
            const btnEnviar = document.getElementById('btnEnviar');
            const alertProcessing = document.getElementById('alertProcessing');

            if (btnEnviar) {
                const form = btnEnviar.closest('form');
                
                form.addEventListener('submit', function (e) {
                    btnEnviar.disabled = true;
                    alertProcessing.style.display = 'block';
                });
            }
        });
    </script>
  </body>
</html>