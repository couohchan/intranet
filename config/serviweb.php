<?php
    
    $serverName = "DESKTOP-SNFQJCJ";    
    //$serverName = "servconta\compac";
    $datos = "serviweb";

    $connectionInfo = array( "Database"=>"$datos", "UID"=>"sa", "PWD"=>"covi", "CharacterSet" => "utf-8");
    //$connectionInfo = array( "Database"=>"$datos", "UID"=>"sa", "PWD"=>"compac", "CharacterSet" => "utf-8");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn ) {
         //echo "Conexión establecida a $datos <br>";
    }else{
    echo "Conexión no se pudo establecer a $datos.<br />";
    die( print_r( sqlsrv_errors(), true));
    }

//    $Dbserver = "SKYNET\INTRANET";
//    $Bd = "niutec";
//
//    $connectionLink = array( "Database"=>"$Bd", "UID"=>"sa", "PWD"=>"covi", "CharacterSet" => "utf-8");
//    $link = sqlsrv_connect( $Dbserver, $connectionLink);
//    if( $link ) {
//         echo "Conexión establecida a $Bd <br>";
//    }else{
//    echo "Conexión no se pudo establecer a $Bd.<br />";
//    die( print_r( sqlsrv_errors(), true));
//    }
?>