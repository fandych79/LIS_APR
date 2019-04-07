<?php
require ("../lib/formaterror.php");
require ("../lib/open_con.php");
$inSearch = $_REQUEST['in_search'];
//echo $inSearch;


//GET PARAM BRANCH

$tsql = "select * from Tbl_branch";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if($sqlConn === false)
{
	die(FormatErrors(sqlsrv_errors()));
}

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	{
	   $param_branch[$row[0]]=$row[1];
	}
}
sqlsrv_free_stmt( $sqlConn );


// SELECT PARAM USER LEVEL
$tsql = "select * from tbl_se_level";
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
		$paramUserLevel[$row['level_code']] = $row['level_name'];
	}
}
sqlsrv_free_stmt( $sqlConn );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Assignment</title>
</head>

<body>
<div id="main" align="center">
<div id="header">
<table align="center" width="960" border="0" style="">
<tr style="margin-bottom:px;">
<td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
</tr>
</table>
</div>
<div id="workarea">
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th colspan="7" scope="col">USER FOR Re-ASSIGNMENT</th>
    </tr>
  <tr>
    <td><a href="manage_assignment.php">Back</a></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="960" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="20%" scope="col">USER ID</th>
    <th width="30%" scope="col">USER NAME</th>
    <th width="15%" scope="col">LEVEL</th>
    <!--<th width="10%" scope="col">DETAIL</th>!-->
    <th width="10%" scope="col">ASSIGN</th>
  </tr>
 



<?php
// SELECT USER SEARCH
$tsql = "select * from tbl_se_user where SUBSTRING(user_id,1,5) <> 'admin' and (user_id like '%$inSearch%' or user_name like '%$inSearch%')";
//echo $tsql;
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
		//echo $row['user_id'].$row['user_name']."<br>";
		$fromUserID = $row['user_id'];
		
		?>
		<tr>
		<td><? echo $row['user_id'];?></td>
		<td><? echo $row['user_name'];?></td>
		<td align="center"><? echo $paramUserLevel[$row['user_level_code']];?></td>
		<!--<td align="center"><a href="manage_assignment_detail_user.php?userid=<? echo $row['user_id'];?>">Click Here</a></td>!-->
        
        <?
		$tsql_check = "select * from tbl_assignment_history_log where assignment_status = 'A' and (assignment_from = '$fromUserID' or assignment_replace = '$fromUserID')";
		//echo $tsql;
		$cursorType_check = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params_check = array(&$_POST['query']);
		
		$sqlConn_check = sqlsrv_query($conn, $tsql_check, $params_check, $cursorType_check);
		
		if ( $sqlConn_check === false)
		  die( FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn_check))
		{
			$rowCount_check = sqlsrv_num_rows($sqlConn_check);
			if( $row_check = sqlsrv_fetch_array( $sqlConn_check, SQLSRV_FETCH_ASSOC))
			{
				$echoAssign = "<font color=\"#FF0000\">ON PROGRESS</font>";
			}
		}
		else
		{
			$echoAssign = "<a href=\"manage_assignment_replace_user.php?userid=$fromUserID\">Assign User</a>";
		}
		
		sqlsrv_free_stmt( $sqlConn_check );
		?>
        
		<td align="center"><? echo $echoAssign;?></td>
		</tr>
        <?
	}
}
else
{
	?>
	<tr>
	<td colspan="4" align="center"><? echo "<strong>$inSearch not Found</strong>";?></td>
	</tr>
    <?
}
sqlsrv_free_stmt( $sqlConn );
?>
</table>
<br>
<br>
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th colspan="7" scope="col">APPLICATION FOR Re-ASSIGNMENT</th>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="960" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="20%" scope="col">APPS ID</th>
    <th width="30%" scope="col">CUST NAME</th>
    <th width="15%" scope="col">BRANCH</th>
    <th width="10%" scope="col">AO CODE</th>
    <!--<th width="10%" scope="col">DETAIL</th>!-->
    <th width="10%" scope="col">ASSIGN</th>
  </tr>
 



<?php
// SELECT USER SEARCH
$tsql = "select * from tbl_customerMasterPerson left join Tbl_FNOM on txn_id = custnomid where custnomid like '%$inSearch%' or custfullname like '%$inSearch%' ";
//echo $tsql;
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
		//echo $row['user_id'].$row['user_name']."<br>";
		?>
		<tr>
		<td><? echo $row['custnomid'];?></td>
		<td><? echo $row['custfullname'];?></td>
		<td align="center"><? echo $param_branch[$row['custbranchcode']];?></td>
        <td align="center"><? echo $row['custaocode'];?></td>
        <!--<td align="center"><a href="manage_assignment_detail_apps.php?userid=<? echo $row['custnomid'];?>">Click Here</a></td>!-->	
        <td align="center"><a href="manage_assignment_replace_apps.php?apps=<? echo $row['custnomid'];?>&userid=<? echo $row['txn_user_id'];?>">Assign Apps</a></td>
		</tr>
        <?
	}
}
else
{
	?>
	<tr>
	<td colspan="5" align="center"><? echo "<strong>$inSearch not Found</strong>";?></td>
	</tr>
    <?
}
sqlsrv_free_stmt( $sqlConn );
?>
</table>
</div>
</div>
</body>
</html>