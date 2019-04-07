<?php

$serverName = "127.0.0.1";
$connectionOptions = array( "Database"=>"DB_APPRAISAL_PRODUKTIF", "UID"=>"user", "PWD"=>"user" );

/* Connect using Windows Authentication. */
$connapr = sqlsrv_connect( $serverName, $connectionOptions);
if( $connapr === false )
die( FormatErrors( sqlsrv_errors() ));

?>

