<?php
include ("../lib/formatError.php");
require ("../lib/open_con.php");


$userid=$_REQUEST['userid'];
$userpwd=$_REQUEST['userpwd'];
$userbranch=$_REQUEST['userbranch'];
$userregion=$_REQUEST['userregion'];
$randomtime=time();

header("location:./report/appraisal_new/do_report.php");
	
?>

