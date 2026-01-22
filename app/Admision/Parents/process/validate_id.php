<?php 
// Recupera datos académicos de un alumno
function validate_id($conn, $id) {

    $sql = "SELECT TOP 1
                pe.PEOPLE_CODE_ID,
                pe.LegalName,
                ac.ACADEMIC_TERM,
                ac.ACADEMIC_YEAR
            FROM PEOPLE pe
            INNER JOIN ACADEMIC ac 
                ON pe.PEOPLE_CODE_ID = ac.PEOPLE_CODE_ID 
                AND ac.ENROLL_SEPARATION = 'INSC' 
                AND ac.ACADEMIC_SESSION != ''
            WHERE pe.PEOPLE_CODE_ID = ?
            ORDER BY ac.ACADEMIC_YEAR DESC, ac.ACADEMIC_TERM DESC";

    $params = array($id);
    $get = sqlsrv_query($conn, $sql, $params);

    if ($get === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($get, SQLSRV_FETCH_ASSOC);

    if ($row) {
        $id_pwc = $row['PEOPLE_CODE_ID'];
        $name_student = $row['LegalName'];
    } else {
        $id_pwc = 0;
        $name_student = 'Alumno no encontrado';
    }

    return array(
        'id_pwc' => $id_pwc,
        'name_student' => $name_student
    );
}
?>
