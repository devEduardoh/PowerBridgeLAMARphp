<?php
$options_beccrm = '<option value="">Selecciona la beca</option>';
$session = $_POST['sesion'];
$periodo = $_POST['periodo'];
$anio = $_POST['anio'];
$porcentaje = $_POST['porcentaje_beca'];

require_once '../../../../logic/conn_ss.php';

$sql = "SELECT 
            ACC.ACADEMIC_SESSION, 
            ACC.ACADEMIC_YEAR, 
            ACC.ACADEMIC_TERM,
            SCO.ScholarshipOfferingId ID_Beca_PwC,
            SCO.ScholarshipType Tipo_Beca,
            SCO.Name Nombre_Beca,
            scl.Percentage
            FROM ScholarshipOffering as SCO
            INNER JOIN ACADEMICCALENDAR AS ACC ON SCO.SessionPeriodId = ACC.SessionPeriodId
            INNER JOIN ScholarshipOfferingLevel SCL ON SCL.ScholarshipOfferingId = SCO.ScholarshipOfferingId
            where ACC.ACADEMIC_YEAR = '$anio' AND ACC.ACADEMIC_TERM = '$periodo' AND ACC.ACADEMIC_SESSION = '$session'
            AND SCO.ScholarshipType = 'BECAUPO' AND SCO.Name LIKE '%CRM%' AND SCL.Percentage = '$porcentaje'
            ORDER BY ACC.ACADEMIC_SESSION, ACC.ACADEMIC_TERM, SCO.ScholarshipOfferingId ";

            echo $sql;
          

                        $get = sqlsrv_query($conn, $sql);
                        if($get == FALSE){
                            print_r(sqlsrv_errors());
                        }
                        else{
                            while($row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC))
                                    {
                                        $options_beccrm .= '<option value="'.$row['ID_Beca_PwC'].'">'.$row['Nombre_Beca'].'</option>';
                                    }
                        sqlsrv_free_stmt($get);
                        
                        }   

echo $options_beccrm;

?>