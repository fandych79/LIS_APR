<?php

$serverName = "127.0.0.1,1433";
$connectionOptions = array( "Database"=>"db_kartukredit", "UID"=>"user", "PWD"=>"user" );

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));

$ipdm="127.0.0.1";
$confmsg = "Are you sure???";
?>
