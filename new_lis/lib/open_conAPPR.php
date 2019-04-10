<?php
ini_set("display_errors", 0);

$serverName = "127.0.0.1";
$connectionOptions = array( "Database"=>"DB_APPRAISAL_PRODUKTIF", "UID"=>"user", "PWD"=>"user" );

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));

$ipdm="127.0.0.1";
$confmsg = "Are you sure?";
?>
