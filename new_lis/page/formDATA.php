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

if($userpermission=="I")
{
	header("location:./appraisal_new/custappraisal.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
	
}
else
{
	header("location:./appraisal_new/custappraisal_view.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");
}
	
require ("../lib/close_con.php");
?>

