<?php 
$serverName = "tcp:10.0.1.27,1433";
$connectionOptions = array("Database"=>"Campus",
    "Uid"=>"dev_PCUPO", "PWD"=>"TiCd3v3l0p3ru40" ,"CharacterSet" => "UTF-8", 
    "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);

/*    $serverName = "tcp:10.0.1.27,1433";
$connectionOptions = array("Database"=>"Campus",
    "Uid"=>"dev_PCUPO", "PWD"=>"TiCd3v3l0p3ru40" ,"CharacterSet" => "UTF-8", 
    "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);
        
$serverName = "tcp:192.168.1.248,49170";
$connectionOptions = array("Database"=>"Campus_UI",
    "Uid"=>"sa", "PWD"=>"Des@rr0ll0T1c*2024" ,"CharacterSet" => "UTF-8", 
    "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);

$serverName = "tcp:192.168.1.12,1433";
        $connectionOptions = array("Database"=>"Campus_UPO_Reports",
            "Uid"=>"neotelref", "PWD"=>"N30t3lR3f3r3nc1@" ,"CharacterSet" => "UTF-8", 
            "LoginTimeout" => 300, "ConnectRetryCount" => 5, "MultipleActiveResultSets" => 1);
        */

$conn = sqlsrv_connect($serverName, $connectionOptions);

if($conn == false){
    //die(FormatErrors(sqlsrv_errors()));
    print_r(sqlsrv_errors());
}else{
    //echo "Conexion a SQL SERVER correcta <br>";
}
?>