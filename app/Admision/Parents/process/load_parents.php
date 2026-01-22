<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../../../../logic/conn_ss.php';

    $id = $_POST['id'];

    $sql = "INSERT INTO [dbo].[NG_Parents]
           ([PEOPLE_CODE_ID]
           ,[PARENT_TYPE]
           ,[FIRST_NAME]
           ,[MIDDLE_NAME]
           ,[LAST_NAME]
           ,[Last_Name_Prefix]
           ,[ADDRESS_LINE_1]
           ,[ADDRESS_LINE_2]
           ,[ZIP_CODE]
           ,[CITY]
           ,[CELPHONE]
           ,[OTHERPHONE]
           ,[Email]
           ,[WORKPLACE]
           ,[SOURCE]
           ,[CREATE_DATE]
           ,[CREATE_TIME]
           ,[CREATE_OPID]
           ,[REVISION_DATE]
           ,[REVISION_TIME]
           ,[REVISION_OPID])
SELECT distinct AC.PEOPLE_CODE_ID
, '' PARENT_TYPE
, '' FIRST_NAME
, '' MIDDLE_NAME
, '' LAST_NAME
, '' Last_Name_Prefix
, '' ADDRESS_LINE_1
, '' ADDRESS_LINE_2
, '' ZIP_CODE
, '' CITY
, '' CELPHONE
, '' OTHERPHONE
, '' Email
, '' WORKPLACE
, 'UD1' SOURCE
, dbo.fnMakeDate(getdate()) CREATE_DATE
, dbo.fnMakeTime(getdate()) CREATE_TIME
, 'SCTCRM' CREATE_OPID
, dbo.fnMakeDate(getdate()) REVISION_DATE
, dbo.fnMakeTime(getdate()) REVISION_TIME
, 'SCTCRM' REVISION_OPID
FROM ACADEMIC AC
INNER JOIN PEOPLE PE ON AC.PEOPLE_CODE_ID = PE.PEOPLE_CODE_ID
LEFT OUTER JOIN NG_Parents NP ON AC.PEOPLE_CODE_ID = NP.PEOPLE_CODE_ID AND NP.SOURCE = 'UD1'
WHERE AC.PEOPLE_CODE_ID = '$id' 
AND AC.ACADEMIC_SESSION != ''
AND NP.PEOPLE_CODE_ID IS NULL
UNION
SELECT DISTINCT AC.PEOPLE_CODE_ID
, '' PARENT_TYPE
, '' FIRST_NAME
, '' MIDDLE_NAME
, '' LAST_NAME
, '' Last_Name_Prefix
, '' ADDRESS_LINE_1
, '' ADDRESS_LINE_2
, '' ZIP_CODE
, '' CITY
, '' CELPHONE
, '' OTHERPHONE
, '' Email
, '' WORKPLACE
, 'UD3' SOURCE
, dbo.fnMakeDate(getdate()) CREATE_DATE
, dbo.fnMakeTime(getdate()) CREATE_TIME
, 'SCTCRM' CREATE_OPID
, dbo.fnMakeDate(getdate()) REVISION_DATE
, dbo.fnMakeTime(getdate()) REVISION_TIME
, 'SCTCRM' REVISION_OPID
FROM ACADEMIC AC
INNER JOIN PEOPLE PE ON AC.PEOPLE_CODE_ID = PE.PEOPLE_CODE_ID
LEFT OUTER JOIN NG_Parents NP ON AC.PEOPLE_CODE_ID = NP.PEOPLE_CODE_ID AND NP.SOURCE = 'UD1'
WHERE AC.PEOPLE_CODE_ID = '$id' 
AND AC.ACADEMIC_SESSION != '' 
AND AC.ENROLL_SEPARATION != 'BAJA'
AND NP.PEOPLE_CODE_ID IS NULL
ORDER BY AC.PEOPLE_CODE_ID, SOURCE";

    $get = sqlsrv_query($conn, $sql);

    if ($get === false) {
        die(print_r(sqlsrv_errors(), true));
    }else{
        echo '<form id="redirigirForm" action="../parents.php" method="post">
                    <input type="hidden" name="id" value="'.substr($id,1,9).'">
                    <input type="hidden" name="update" value="0">
                </form>

    <script>
        document.getElementById("redirigirForm").submit();
    </script>';

    }

}else{
 echo '<h1 style="color: red;">Error</h1>';
}

?>

