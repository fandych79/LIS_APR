<?php
include ("../lib/formatError.php");
require ("../lib/open_con.php");
$in_rowPerPage = $_REQUEST['hide_rowPerPage'];
$in_currentPage = $_REQUEST['hide_currentPage'];
$in_searchContent = $_REQUEST['searchContent'];
header("location:../Preview/register_ao.php?rowPerPage=$in_rowPerPage&currentPage=$in_currentPage&searchContent=$in_searchContent");
require("../lib/close_con.php");
?>
