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

$dateProcesa = isset($_POST['dateProcesa']) ? $_POST['dateProcesa'] : null;

if (!$dateProcesa) {

    $subtitulo = "Últimos 30 archivos procesados";

    $sql_bita = "SELECT DISTINCT LD.archivo
                , LD.idValida
                , LD.idProcesa
                , DATE_FORMAT(LD.dateValida, '%d/%m/%Y') dateValida
                , DATE_FORMAT(LD.dateProcesa, '%d/%m/%Y') dateProcesa
                , count(LD.id_log) Lineas_Archivo
                , count(LD.numLinea) Registros_Validados
                , if(LD.idProcesa is null, 0, (SELECT count(numLineaProcesa) FROM lamar.pb_logdispersion WHERE idProcesa = LD.idProcesa and idValida = LD.idValida group by idProcesa, idValida)) Registros_Procesados
                , CONCAT(U.names,' ',U.surnames) Usuario
                FROM lamar.pb_logdispersion LD
                LEFT OUTER JOIN pb_user U ON LD.userProcesa = U.iduser
                GROUP BY LD.archivo
                , LD.idValida
                ORDER BY LD.dateValida DESC, LD.idValida DESC, LD.idProcesa DESC
LIMIT 30;";

}else{

    $dateProcesaformat = DateTime::createFromFormat('Y-m-d', $dateProcesa)->format('d/m/Y');
    $subtitulo = "Archivos procesados el día: ". $dateProcesaformat;

    $sql_bita = "SELECT DISTINCT LD.archivo
                    , LD.idValida
                    , LD.idProcesa
                    , DATE_FORMAT(LD.dateValida, '%d/%m/%Y') dateValida
                    , DATE_FORMAT(LD.dateProcesa, '%d/%m/%Y') dateProcesa
                    , count(LD.id_log) Lineas_Archivo
                    , count(LD.numLinea) Registros_Validados
                    , if(LD.idProcesa is null, 0, (SELECT count(numLineaProcesa) FROM lamar.pb_logdispersion WHERE idProcesa = LD.idProcesa and idValida = LD.idValida group by idProcesa, idValida)) Registros_Procesados
                    , CONCAT(U.names,' ',U.surnames) Usuario
                    FROM lamar.pb_logdispersion LD
                    LEFT OUTER JOIN pb_user U ON LD.userProcesa = U.iduser
                    WHERE date(LD.dateValida) = '$dateProcesa'
                    GROUP BY LD.archivo
                    , LD.idValida
                    ORDER BY LD.dateValida DESC, LD.idValida DESC, LD.idProcesa DESC;";

}

$res_bita = $mysqli->query($sql_bita) ;
$val_resbita = $res_bita->num_rows;

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
        
        
            <!-- Card principal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-sm-12">
                             <h4 class="card-title">
                                Archivos procesados en PowerCampus
                            </h4>
                            <blockquote><?php echo $subtitulo; ?></blockquote>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">   
                                <form method="POST" action="bita_dispersion.php">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" name="dateProcesa" id="dateProcesa" placeholder="Selecciona una fecha" value="<?php echo isset($dateProcesa) ? $dateProcesa : ''; ?>" required>
                                        <button class="btn btn-primary" type="submit">Filtrar</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                            <div class="table-scroll-container table-responsive">
                            <table class="table table-striped" id="procesa-table">
                            <thead>
                                <tr>
                                    <th>Archivo</th>
                                    <th>Fecha<br>carga</th>
                                    <th>Líneas<br>procesadas</th>
                                    <th>ID Válida PwC</th>
                                    <th>Registros<br>Válidados</th>
                                    <th>ID Procesa PwC</th>
                                    <th>Fecha<br>Dispersión PwC</th>
                                    <th>Registros<br>Procesados</th>
                                    <th>Detalle<br>Dispersión</th>
                                    <th>Usuario<br>procesa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($val_resbita > 0){
                                    while($row_bita = $res_bita->fetch_assoc()){

                                        if($row_bita['idProcesa'] != null){
                                                $post_envio = '<form method="POST" action="detailbita_dispersion.php">
                                                                <input type="hidden" name="idProcesa" value="' . $row_bita['idProcesa'] . '">
                                                                <button type="submit" class="btn btn-sm btn-info">Ver Detalle</button>
                                                                </form>';

                                        }else{
                                            $post_envio = '<span class="text-muted">No disponible</span>';
                                        }

                                        echo "<tr>
                                                <td>" . $row_bita['archivo'] . "</td>
                                                <td>" . $row_bita['dateValida'] . "</td>
                                                <td>" . $row_bita['Lineas_Archivo'] . "</td>
                                                <td>" . $row_bita['idValida'] . "</td>
                                                <td>" . $row_bita['Registros_Validados'] . "</td>
                                                <td>" . $row_bita['idProcesa'] . "</td>
                                                <td>" . $row_bita['dateProcesa'] . "</td>
                                                <td>" . $row_bita['Registros_Procesados'] . "</td>
                                                <td>".$post_envio."</td>
                                                <td>".($row_bita['Usuario'] ?? '-')."</td>
                                            </tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='10' class='text-center'>No se encontraron registros para la fecha seleccionada.</td></tr>";
                                }
                                ?>

                                
                            </tbody>                            
                            </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col"><a href="payment_dispersion.php" class="btn btn-info">Regresar</a></div>
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
  </body>
</html>