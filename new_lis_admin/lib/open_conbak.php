<?php
$serverName = "(local)\MEGASQLSERVER";
$connectionOptions = array("Database"=>"db_lis_mega_uat");

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));


?>

