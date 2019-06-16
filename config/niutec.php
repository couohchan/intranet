<?php
    $Dbserver = "SERVNIU";
    $Bd = "niutec";

    $connectionLink = array( "Database"=>"$Bd", "UID"=>"sa", "PWD"=>"mpro/2008", "CharacterSet" => "utf-8");
    $link = sqlsrv_connect( $Dbserver, $connectionLink);
    if( $link ) {
         //echo "Conexión establecida a $Bd <br>";
    }else{
    echo "Conexión no se pudo establecer a $Bd.<br />";
    die( print_r( sqlsrv_errors(), true));
    }
?>