<?php
include ("../lib/formatError.php");
require ("../lib/open_con.php");

$userid=$_REQUEST['userid'];
$userpwd=$_REQUEST['userpwd'];
$userbranch=$_REQUEST['userbranch'];
$userregion=$_REQUEST['userregion'];
$userwfid=$_REQUEST['userwfid'];

$in_rowPerPage = $_REQUEST['hide_rowPerPage'];
$in_currentPage = $_REQUEST['hide_currentPage'];
//$in_searchContent = $_REQUEST['searchContent'];
//echo "location:flow.php?rowPerPage=$in_rowPerPage&currentPage=$in_currentPage&userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion";
header("location:flow.php?rowPerPage=$in_rowPerPage&currentPage=$in_currentPage&userid=$userid&userpwd=$userpwd&userbranch=$userbranch&userregion=$userregion&userwfid=$userwfid");

?>