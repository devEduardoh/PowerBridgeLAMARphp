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
$update = 0;
require_once '../../../logic/conn_ss.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = 'P'.$_POST['id']; // Obtener el valor del campo 'id'
    $val_parent = 1;
    $update = $_POST['update'];
    
    $sql_p = "SELECT DISTINCT PAR.ParentId, PAR.PEOPLE_CODE_ID, PE.LegalName, PAR.PARENT_TYPE, PAR.FIRST_NAME, PAR.MIDDLE_NAME, PAR.LAST_NAME
      , PAR.Last_Name_Prefix, PAR.ADDRESS_LINE_1, PAR.ADDRESS_LINE_2, PAR.ZIP_CODE, PAR.CITY, CTY.LONG_DESC COUNTY
      , STA.LONG_DESC STATE, PAR.CELPHONE, PAR.OTHERPHONE, PAR.Email, PAR.WORKPLACE, PAR.SOURCE, PAR.CREATE_DATE, PAR.CREATE_TIME
      , PAR.CREATE_OPID, PAR.REVISION_DATE, PAR.REVISION_TIME, PAR.REVISION_OPID
        FROM NG_Parents PAR
        INNER JOIN PEOPLE PE ON PAR.PEOPLE_CODE_ID = PE.PEOPLE_CODE_ID
        LEFT OUTER JOIN CODE_COUNTY CTY ON CTY.CODE_VALUE_KEY = PAR.COUNTY
        LEFT OUTER JOIN CODE_STATE STA ON STA.CODE_VALUE_KEY = PAR.STATE
        WHERE PAR.PEOPLE_CODE_ID = '$id' ORDER BY PAR.SOURCE DESC;";
                $get_p = sqlsrv_query($conn, $sql_p);
                    if($get_p == FALSE){
                        print_r(sqlsrv_errors());
                    }else{
                            $val_parent = 1;
                            
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
<?php if($update == 1){
echo '<div class="row">
    <div class="col">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                Información Actualizada. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>';
}elseif($update == 2){
    echo '<div class="row">
    <div class="col">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                No fue posible actualizar la información, intente nuevamente. 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>';
} 
?>
<div class="row">
   <div class="col-md-12 col-lg-12">
   <!-- Contenido del Frame -->
   <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Padres de alumnos</h6>
                    </div>
                </div>
                <div class="card-body">
                       
                        <div class="row">                            
                            <div class="col form-group">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <label style="font-size: 14px;" class="form-label" for="id">ID de Alumno PwC</label>
                                    <input type="text" class="form-control form-control-sm" id="id" name="id" maxlength="9" placeholder="000012345" required>
                                    <input type="hidden" name="update" value="0">
                                    <br>
                                    <button type="submit" class="btn btn-success">Buscar padres del alumno(a)</button>
                                </form>
                            </div>
                            <div class="col"></div><div class="col"></div>
                            <!--div class="col"></!--div>
                            <div-- class="col">
                                    <a href="allparents.php"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Listado completo</button></a>
                            </div-->
                            
                        </div>
                </div>
    </div>
    <?php if($val_parent == 1){ ?>
    <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h6 class="card-title">Resultado de la búsqueda para el ID <?php echo $id; ?></h6>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                    <?php 
                    $leyenda_boton;
                    $source;
                    $contador = 1;
                    while($rowp = sqlsrv_fetch_array($get_p, SQLSRV_FETCH_ASSOC)) { 

                    if($rowp['PARENT_TYPE'] == '' OR $rowp['PARENT_TYPE'] == NULL){
                        $leyenda_boton = '<button type="submit" class="btn btn-primary rounded-pill ">
                                            <span class="btn-inner">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                            </span>
                                           Complementar Información
                                        </button>';
                     }else{
                        $leyenda_boton = '<button type="submit" class="btn btn-primary rounded-pill ">
                                            <span class="btn-inner">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                </svg>
                                            </span>
                                            Actualizar Información
                                        </button>';
                     }

                     if($rowp['SOURCE'] == 'UD3'){$source = "DE LA MADRE";}elseif($rowp['SOURCE'] == 'UD1'){$source = "DEL PADRE";}else{$source = "NO IDENTIFICADO";}

                     if($contador == 1){
                        echo '<div class="col-12"><p>Alumno(a): '.$rowp['LegalName'].'</p></div>';
                     }
                        ?>
                
                <div class="col">
                            <div class="bd-example table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" colspan="2">REGISTRO <?php echo $source; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Nombres</th>
                                        <td><?php echo $rowp['FIRST_NAME'].' '.$rowp['MIDDLE_NAME']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Apellidos</th>
                                        <td><?php echo $rowp['LAST_NAME'].' '.$rowp['Last_Name_Prefix']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Parentesco</th>
                                        <td><?php echo ucfirst(strtolower($rowp['PARENT_TYPE'])); ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">C.P</th>
                                        <td><?php echo $rowp['ZIP_CODE']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Estado</th>
                                        <td><?php echo $rowp['STATE']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Municipio</th>
                                        <td><?php echo $rowp['COUNTY']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ciudad</th>
                                        <td><?php echo $rowp['CITY']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Colonia</th>
                                        <td><?php echo $rowp['ADDRESS_LINE_2']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Calle y número</th>
                                        <td><?php echo $rowp['ADDRESS_LINE_1']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Teléfono Móvil</th>
                                        <td><?php echo $rowp['CELPHONE']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Otro Teléfono</th>
                                        <td><?php echo $rowp['OTHERPHONE']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Correo Electrónico</th>
                                        <td><?php echo $rowp['Email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lugar de Trabajo</th>
                                        <td><?php echo $rowp['WORKPLACE']; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center p-2"><form action="detail-parent.php" method="post">
                                        <input type="hidden" name="ParentId" value="<?php echo $rowp['ParentId']; ?>">
                                        <?php echo $leyenda_boton; ?> 
                                        </form></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                      </div>

                      <?php 
                      $contador ++;
                                }
                                if($contador == 1){
                                    require_once 'process/validate_id.php';
                                    $student_info = validate_id($conn, $id);
                                      
                                    if($student_info['id_pwc'] == 0){
                                        echo '<div class="col-12">
                                            <div class="card border-warning">
                                                <div class="card-body">
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Advertencia:</strong> El ID de alumno ingresado no existe en el sistema.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    }else{
                                        echo '<div class="col-12"><p><b>No existe información de padres del alumno </b>'.$student_info['name_student'].'</p></div>';
                                        echo '<form action="process/load_parents.php" method="post">
                                        <input type="hidden" name="id" value="'.$student_info['id_pwc'].'">
                                            <button type="submit" class="btn btn-primary rounded-pill ">
                                            <span class="btn-inner">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                                                <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                                                </svg>
                                            </span>
                                            Capturar Información de Padres
                                        </button>
                                        </form>';

                                    }

                                    
                                }
                      ?>
<?php }     ?>
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