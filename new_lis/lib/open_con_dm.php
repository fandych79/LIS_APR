<?php
$ipdm="127.0.0.1";
$ipdm=$_SERVER['SERVER_ADDR'];
$serverName = $ipdm;
$connectionOptions = array( "Database"=>"DB_DM", "UID"=>"user", "PWD"=>"user" );

/* Connect using Windows Authentication. */
$conndm = sqlsrv_connect( $serverName, $connectionOptions);
if( $conndm === false )
die( FormatErrors( sqlsrv_errors() ));



?>