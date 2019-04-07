<?php
session_start();
include ("../lib/formatError.php");
require ("../lib/open_con.php");

if(isset($_REQUEST['naiMsg']))
{
	$naiMsg = "<br>".$_REQUEST['naiMsg']."<br>";
}
else
{
	$naiMsg = "";
}

if(isset($_REQUEST['in_userid']) && isset($_REQUEST['in_userpwd']))
{
	$userid = $_REQUEST['in_userid'];
	$userpwd = $_REQUEST['in_userpwd'];
	
	$_SESSION['nai_userid'] = $userid;
	$_SESSION['nai_userpwd'] = $userpwd;
	
	//echo $_SESSION['nai_userid']."if";
}
else
{
	//echo $_SESSION['nai_userid']."else";
}

$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];

//GET USER ADMIN BRANCH
$tsql = "select * from tbl_se_user where user_id = '$reg_userID'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);

$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if ( $sqlConn === false)
  die( FormatErrors( sqlsrv_errors() ) );

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		$reg_userBranch = $row['user_branch_code'];
	}
}
sqlsrv_free_stmt( $sqlConn );

//echo "--".$reg_userBranch."--";

if($reg_userBranch == "888")
{
	$addtitle = "KPNO 888";
}
else if(substr($reg_userBranch,0,1) == "8")
{
	$addtitle = "Region $reg_userBranch";
}
else
{
	$addtitle = "Branch $reg_userBranch";
}
	


$conditionRegion = "";

// WHERE CONDITION 

if(isset($_REQUEST['searchContent']))
{
	$temp = $_REQUEST['searchContent'];
	//echo "ada";
}
else
{
	$temp = "";
	//echo "gak ada";
}

if(strlen($temp) != 0)
{
	//echo "SEARCH";
	
	if($reg_userBranch == "888")
	{
		$searchContent = "where ao_branch_code like '%$temp%' or ao_code like '%$temp%' or ao_name like '%$temp%' or ao_hp_number like '%$temp%' or ao_nik like '%$temp%'";
	}
	else if(substr($reg_userBranch,0,1) == "8")
	{
		//GET BRANCH UNDER REGION
		$tsql = "select * from tbl_branch where branch_region_code = '$reg_userBranch'";
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_POST['query']);
		
		$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
		
		if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn))
		{
			$rowCount = sqlsrv_num_rows($sqlConn);
			while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
			{
				$conditionRegion = $conditionRegion."ao_branch_code = ".$row['branch_code']." or ";
			}
		}
		sqlsrv_free_stmt( $sqlConn );
		
		$conditionRegion = substr($conditionRegion,0,strlen($conditionRegion) - 3);
		
		//echo $conditionRegion;
		//exit;
		
		$searchContent = "where ao_code like '%$temp%' or ao_name like '%$temp%' or ao_hp_number like '%$temp%' or ao_nik like '%$temp%' and ($conditionRegion)";
	}
	else
	{
		$searchContent = "where ao_branch_code = '$reg_userBranch' and (ao_code like '%$temp%' or ao_name like '%$temp%' or ao_hp_number like '%$temp%' or ao_nik like '%$temp%')";
	}
}
else
{
	//echo "NO SEARCH";
	
	if($reg_userBranch == "888")
	{
		$searchContent = "";
	}
	else if(substr($reg_userBranch,0,1) == "8")
	{
		//GET BRANCH UNDER REGION
		$tsql = "select * from tbl_branch where branch_region_code = '$reg_userBranch'";
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_POST['query']);
		
		$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
		
		if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn))
		{
		$rowCount = sqlsrv_num_rows($sqlConn);
			while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
			{
				$conditionRegion = $conditionRegion."ao_branch_code = ".$row['branch_code']." or ";
			}
		}
		sqlsrv_free_stmt( $sqlConn );
		
		$conditionRegion = substr($conditionRegion,0,strlen($conditionRegion) - 3);
		
		//echo $conditionRegion;
		//exit;
		
		$searchContent = "where $conditionRegion";
	}
	else
	{
		$searchContent = "where ao_branch_code = '$reg_userBranch'";
	}
}


// RULE PAGE
if(isset($_REQUEST['currentPage']))
{
	$currentPage = $_REQUEST['currentPage'];
}
else
{
	$currentPage = 1;
}

if(isset($_REQUEST['rowPerPage']))
{
	$rowPerPage = $_REQUEST['rowPerPage'];
}
else
{
	$rowPerPage = 5;
}

if($currentPage <= 0)
{
	$currentPage = 1;
}

$offsetPage = ($currentPage - 1)*$rowPerPage;
$lastRow = $offsetPage + $rowPerPage;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>REGISTER_AO</title>
<link rel="stylesheet" type="text/css" href="../../../style/d.css" />
<script language="javascript">
function goExit()
{
	document.form_exit.submit();
}
function SearchContentResult()
{
	document.form_register_ao.submit();
}

function rowPerPageValue()
{
	temp = document.form_register_ao.in_rowPerPage.value;
	document.form_register_ao.hide_rowPerPage.value = temp;
	document.form_register_ao.submit();
}

function currentPageValue(paramValue)
{
	if(paramValue == "next")
	{
		currPage = parseInt(document.form_register_ao.hide_currentPage.value);
		currPage = currPage + 1;
		document.form_register_ao.hide_currentPage.value = currPage;
	}
	else if(paramValue == "prev")
	{
		currPage = parseInt(document.form_register_ao.hide_currentPage.value);
		currPage = currPage - 1;
		document.form_register_ao.hide_currentPage.value = currPage;
	}
	document.form_register_ao.submit();
}
</script>
</head>

<body style="font-size:12px;font-family:Arial, Helvetica, sans-serif" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0" style="">
  <tr style="margin-bottom:px;">
    <td><img src="../../../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
<form name="form_register_ao" method="post" action="../do_Preview/do_register_ao.php">
<div align="center">
<input type="hidden" id="hide_currentPage" name="hide_currentPage" value="<? echo $currentPage;?>">
<input type="hidden" id="hide_rowPerPage" name="hide_rowPerPage" value="<? echo $rowPerPage;?>">
<? echo $naiMsg; ?>
<table width="800" border="1" cellpadding="0" cellspacing="0" >
<tr>
<td colspan="2"><div align="center">REGISTER_AO<br><? echo $addtitle;  ?></div></td>
</tr>
<tr>
<td width="400"><div align="left"><a href="../form/register_ao.php">Add New</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="./form_exit.php">Exit Register AO</a></div></td>
<td width="384"><div align="right">
  <input type="text" name="searchContent" id="searchContent" value="<? echo $temp; ?>" />
  <input type="button" name="btn_search" id="btn_search" onclick="SearchContentResult()" value="Search" />
</div></td>
</tr>
</table>
<table width="800" border="0">
<tr>
<td><div align="center">Row : <? echo $rowPerPage; ?> <BR>
<select name="in_rowPerPage" id="in_rowPerPage" onchange="rowPerPageValue()">
<option value="" selected="selected">Select</option>
<option value="5">5</option>
<option value="10">10</option>
<option value="20">20</option>
<option value="50">50</option>
<option value="100">100</option>
</select></div></td>
</tr>
<tr>
<td colspan="4"><div align="center">Page</div></td>
</tr>
<tr>
<td colspan="4">
<div align="center">
<a href="#" onclick="currentPageValue('prev')">Prev</a>
&nbsp;&nbsp;&nbsp;<? echo $currentPage; ?>&nbsp;&nbsp;&nbsp;
<a href="#" onclick="currentPageValue('next')">Next</a>
</div>
</td>
</tr> 
<tr> 
<td>&nbsp;</td> 
</tr> 
</table>
<br> 
<table width="800" border="1" cellpadding="0" cellspacing="0">

<tr>
<th bgcolor="#CCCCCC"><div align="center">AO CODE&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">AO NAME&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">BRANCH CODE&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">HP&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">NIK&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">FLAG&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">ACTIVE&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">CREATE BY&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">CREATE TIME&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">TL&nbsp;</div></th>
<th bgcolor="#CCCCCC"><div align="center">DETAILS&nbsp;</div></th>
</tr>
<?
$tsql = "select * from (select *,ROW_NUMBER() OVER(order by ao_branch_code) as ROW  from Tbl_AO $searchContent) Tbl_AO where ROW > $offsetPage and ROW <= $lastRow";

//echo $tsql."<br>";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
$rowCount = sqlsrv_num_rows($sqlConn);
while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
{
?>
<tr>
<td><div align="left"><? echo $row['ao_code'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_name'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_branch_code'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_hp_number'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_nik'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_flag'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_active'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_create_userid'];?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_create_time']->format('d-m-Y H:i');?>&nbsp;</div></td>
<td><div align="left"><? echo $row['ao_tl'];?>&nbsp;</div></td>
<td><div align="center"><a href="../Edit/register_ao.php?FF=<? echo $row['ao_code'];?>&FN=ao_code&TABLE=Tbl_AO&SF=<? echo $row['ao_branch_code'];?>&SFN=ao_branch_code">Click Here</a>&nbsp;</div></td>
</tr>
<?
}
}
sqlsrv_free_stmt( $sqlConn );
?>
</table>
</div>
</form>
</body>
</html>
<?
require("../lib/close_con.php");
?>
