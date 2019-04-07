<?php

$serverName = "127.0.0.1,1433";
$connectionOptions = array( "Database"=>"DB_APPRAISAL_PRODUKTIF", "UID"=>"user", "PWD"=>"user" );
//$serverName = "10.11.10.54,1433";
//$connectionOptions = array( "Database"=>"db_kartukredit", "UID"=>"LIS", "PWD"=>"Master#123" );

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));
$confmsg = "adsfasdf";

?>