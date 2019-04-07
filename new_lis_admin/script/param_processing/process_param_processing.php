<?php
require ("../../lib/class.sqlserver.php");
$sql = new SQLSRV();
$sql->connect();

$proc_code = $_REQUEST['processing'];
$flow_auto = $_REQUEST['flow_auto'];

echo $proc_code;

echo "<pre>";
print_r($flow_auto);
echo "</pre>";

$tsql = "delete tbl_processing_auto where proc_code='$proc_code'";
$sql->executeNonQuery($tsql);

for($x=0;$x<count($flow_auto);$x++)
{
	$flow = $flow_auto[$x];
	$tsql = "insert into tbl_processing_auto (proc_code,proc_flow_auto) values ('$proc_code','$flow')";
	$sql->executeNonQuery($tsql);
}

header("location:param_processing.php");
?>