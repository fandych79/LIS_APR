<?php
#$serverName = "10.201.110.72";
#$connectionOptions = array("Database"=>"db_cts");

#$serverName = "10.110.4.123,1052";
#$connectionOptions = array( "Database"=>"db_test", "UID"=>"indra", "PWD"=>"indra" );

$serverName = "10.110.3.12,1433";
$serverName = "172.16.11.20,1433";
$connectionOptions = array( "Database"=>"db_cts_prod", "UID"=>"cts", "PWD"=>"Bii12345" );


$serverName = "(local)";
$connectionOptions = array("Database"=>"db_dm");

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));


?>

