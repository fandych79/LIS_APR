<?php

require ("../lib/open_con.php");
require ("../lib/formatError.php");
if ($_REQUEST['btnname']=="add")
{
	$newbranchid=$_REQUEST['newbranchid'];
	$strsql = "insert into tbl_branchcluster(branch,flowcode,branchto,method,flag) values ('".$_REQUEST['newbranchid']."','".$_REQUEST['flow']."','".$_REQUEST['method']."','".$_REQUEST['branch']."','1')";
	//echo $strsql;
	
	require("ajaxreturncluster.php");

}


?>