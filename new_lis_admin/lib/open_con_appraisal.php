<?php
error_reporting(E_ALL & ~E_NOTICE);

$serverName = "127.0.0.1";
$connectionOptions = array( "Database"=>"DB_APPRAISAL_PRODUKTIF", "UID"=>"user", "PWD"=>"user" );

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));

?>
