<?php
require ("../../lib/open_con.php");
require ("../../lib/sqlserverAPR.php");
require ("../../requirepage/parameter.php");


$SQL = new MYSQL();
$SQL->connect();
$debug = false;

$_custnomid = $_REQUEST['custnomid'];

$tsql = "
delete from Tbl_FSTART where txn_id='$_custnomid'
delete from appraisal_task where _custnomid ='$_custnomid'
delete from Tbl_Information_Head  where custnomid ='$_custnomid'
UPDATE appraisal_request set _flag='N' where _custnomid ='$_custnomid'";
$SQL->executeNonQuery($tsql);



require ("../../requirepage/do_saveflow.php");	

header("location:../flow.php?userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");
?>