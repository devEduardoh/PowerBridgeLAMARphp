<?php 
/*
$serverName = "tcp:10.0.1.23,1433";
$connectionOptions = array("Database"=>"Campus",
    "Uid"=>"dev_PCLamar", "PWD"=>"T1Cd3v3l0p3r" ,"CharacterSet" => "UTF-8", 
    "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);

/*    $serverName = "tcp:10.0.1.27,1433";
$connectionOptions = array("Database"=>"Campus",
    "Uid"=>"dev_PCUPO", "PWD"=>"TiCd3v3l0p3ru40" ,"CharacterSet" => "UTF-8", 
    "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);
        
$serverName = "tcp:192.168.1.248,49170";
$connectionOptions = array("Database"=>"Campus_UI",
    "Uid"=>"sa", "PWD"=>"Des@rr0ll0T1c*2024" ,"CharacterSet" => "UTF-8", 
    "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);
*/
$serverName = "tcp:192.168.1.12,1433";
        $connectionOptions = array("Database"=>"Campus_LAMAR_TIC",
            "Uid"=>"DispPowBrd", "PWD"=>"D15p3rs10nTst" ,"CharacterSet" => "UTF-8", 
            "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);
        

sqlsrv_configure("WarningsReturnAsErrors", 0);
$conn = sqlsrv_connect($serverName, $connectionOptions);

if($conn == false){
    //die(FormatErrors(sqlsrv_errors()));
    print_r(sqlsrv_errors());
}else{
    //echo "Conexion a SQL SERVER correcta <br>";
}
?>