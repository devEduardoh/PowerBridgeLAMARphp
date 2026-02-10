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
        <form method="POST" enctype="multipart/form-data">
            <!-- Card principal -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h4 class="card-title">
                        Dispersión de Cobranza PowerCampus
                    </h4>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <label for="archivo" class="form-label fw-semibold">
                            Archivo de dispersión
                        </label>
                        <input type="file" name="archivo" class="form-control" id="archivo" required>
                        <br>
                        <small class="text-muted">
                            Selecciona el archivo descargado de Payworks.
                        </small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" name="procesar" class="btn btn-primary">
                            <i class="ti ti-play me-1"></i>Cargar Archivo de Pagos
                        </button>
                    </div>
                </div>
            </div>
            </form> 

            <!-- Resultado de la cobranza -->
            <div class="card">
                <div class="card-body">
                    <h6 class="text-primary fw-semibold mb-3">
                        <i class="ti ti-report-analytics me-2"></i>
                        Resultado Carga de Archivo
                    </h6>
                    <?php
                        if (isset($_POST['procesar']) && isset($_FILES['archivo'])) {
                            $archivo = $_FILES['archivo'];
            
                            // Validar que se subió correctamente
                            if ($archivo['error'] === UPLOAD_ERR_OK) {
                                $rutaArchivo = $archivo['tmp_name'];
                                
                                // Leer el archivo línea por línea
                                $lineas = file($rutaArchivo, FILE_IGNORE_NEW_LINES);
                
                                if ($lineas === false) {
                                    echo '<div class="alert alert-danger">Error al leer el archivo.</div>';
                                } else {
                                    $totalLineas = count($lineas);
                                    
                                    echo '<div class="alert alert-success"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    Archivo procesado correctamente</div>';
                                    echo '<div class="alert alert-info">';
                                    echo '<strong>Información del archivo:</strong><br>';
                                    echo 'Total de líneas: ' . $totalLineas . '<br>';
                                    echo 'Registros procesados: ' . ($totalLineas - 2) . '<br>';
                                    echo 'Primera línea (descartada): ' . htmlspecialchars(substr($lineas[0], 0, 50)) . '...<br>';
                                    echo 'Última línea (descartada): ' . htmlspecialchars(substr($lineas[$totalLineas - 1], 0, 50)) . '...';
                                    echo '</div>';
                                    
                                    // Procesar las líneas (desde la línea 2 hasta la penúltima)
                                    $datos = [];
                                    
                                    for ($i = 1; $i < $totalLineas - 1; $i++) {
                                        $linea = $lineas[$i];
                                        
                                        // Buscar la posición donde empieza "000101" (inicio de columna 2)
                                        $pos_col2 = strpos($linea, '000101');
                                        
                                        // Buscar la última aparición del número (columna 3) 
                                        // Los últimos 6 caracteres sin espacios
                                        $linea_trimmed = rtrim($linea);
                                        $pos_col3 = strlen($linea_trimmed) - 6;
                                        
                                        // Extraer las columnas
                                        if ($pos_col2 !== false && $pos_col3 > 0) {
                                            $columna1 = trim(substr($linea, 0, $pos_col2));
                                            $columna2 = trim(substr($linea, $pos_col2, $pos_col3 - $pos_col2));
                                            $columna3 = trim(substr($linea, $pos_col3));
                                        } else {
                                            // Fallback a posiciones fijas si no encuentra el patrón
                                            $columna1 = trim(substr($linea, 0, 150));
                                            $columna2 = trim(substr($linea, 229, 46));
                                            $columna3 = trim(substr($linea, -6));
                                        }
                                        
                                        $datos[] = [
                                            'linea' => $i,
                                            'columna1' => $columna1,
                                            'columna2' => $columna2,
                                            'columna3' => $columna3
                                        ];
                                    }
                                    
                                    // Mostrar los datos en una tabla
                                    if (!empty($datos)) {
                                        echo '<h5 class="mt-4">Datos Extraídos (' . count($datos) . ' registros)</h5>';
                                        echo '<div class="table-responsive">';
                                        echo '<table class="table table-striped">';
                                        echo '<thead>';
                                        echo '<tr>';
                                        echo '<th style="width: 60px;">Línea</th>';
                                        echo '<th style="width: 45%;">Columna 1</th>';
                                        echo '<th style="width: 35%;">Columna 2</th>';
                                        echo '<th style="width: 10%;">Columna 3</th>';
                                        echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                        
                                        foreach ($datos as $registro) {
                                            echo '<tr>';
                                            echo '<td>' . $registro['linea'] . '</td>';
                                            echo '<td style="font-family: \'Courier New\', monospace; font-size: 12px;">' . htmlspecialchars($registro['columna1']) . '</td>';
                                            echo '<td style="font-family: \'Courier New\', monospace; font-size: 12px;">' . htmlspecialchars($registro['columna2']) . '</td>';
                                            echo '<td>' . htmlspecialchars($registro['columna3']) . '</td>';
                                            echo '</tr>';
                                        }
                                        
                                        echo '</tbody>';
                                        echo '</table>';
                                        echo '</div>';
                                        
                                        // Formulario para enviar los datos a otra página
                                        echo '<div class="card mt-4">';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title">Enviar datos a PowerCampus para validación</h5>';
                                        
                                        echo '<form method="POST" action="payment_validate.php">';
                                        // Convertir los datos a JSON para enviarlos
                                        echo '<input type="hidden" name="datos" value="' . htmlspecialchars(json_encode($datos)) . '">';
                                        
                                        echo '<div class="d-flex justify-content-end mt-3">';
                                        echo '<button type="submit" class="btn btn-success" id="btnEnviar">';
                                        echo '<i class="ti ti-send me-1"></i>Enviar registros';
                                        echo '</button>';
                                        echo '</div>';
                                        
                                        // Alert de procesamiento (oculto inicialmente)
                                        echo '<div id="alertProcessing" style="display: none; margin-top: 20px;">';
                                        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                                        echo ' Por favor espera, se está procesando el archivo...';
                                        echo '</div>';
                                        echo '</div>';
                                        
                                        echo '</form>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                }
                            } else {
                                echo '<div class="alert alert-danger">Error al subir el archivo. Código de error: ' . $archivo['error'] . '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-secondary">📁 Por favor, selecciona un archivo para procesar.</div>';
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