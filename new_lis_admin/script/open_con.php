<?php
$serverName = "(local)\SQLEXPRESS";
$connectionOptions = array("Database"=>"db_lis_mega");

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));
?>

