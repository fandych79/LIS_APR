<?php
include ("../lib/formatError.php");
require ("../lib/open_con.php");

$tsql52 = "UPDATE tbl_counterdrawdown SET counterdrawdown = '0' WHERE regioncode = 'ALL'";
$a52 = sqlsrv_query($conn, $tsql52);
echo $tsql52;
?>