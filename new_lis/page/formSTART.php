<?php
include ("../lib/formatError.php");
require ("../lib/open_con.php");
require ("../requirepage/parameter.php");

if(isset($userid) && isset($userpwd) && isset($userbranch) && isset($userregion) && isset($userwfid) )
{
}
else
{
	header("location:restricted.php");
}

	Header("Location:./appraisal_new/appraisal_task.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
	
require ("../lib/close_con.php");
?>

