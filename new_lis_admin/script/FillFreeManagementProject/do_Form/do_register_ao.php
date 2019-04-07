<?php
session_start();
$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];
include ("../lib/formatError.php");
require ("../lib/open_con.php");
$in_Tbl_AO_ao_code = $_POST['in_ao_code'];
$in_Tbl_AO_ao_name = $_POST['in_ao_name'];
$in_Tbl_AO_ao_branch_code = $_POST['in_ao_branch_code'];
$in_Tbl_AO_ao_hp_number = $_POST['in_ao_hp_number'];
$in_Tbl_AO_ao_nik = $_POST['in_ao_nik'];
$in_Tbl_AO_ao_flag = $_POST['in_ao_flag'];
$in_Tbl_AO_ao_active = $_POST['in_ao_active'];
$in_Tbl_AO_ao_create_userid = $_POST['in_ao_create_userid'];
$in_Tbl_AO_ao_create_time = $_POST['in_ao_create_time'];
$in_Tbl_AO_ao_tl = $_POST['in_ao_tl'];

$thecount = 2;
$tsql = "SELECT COUNT(*) FROM Tbl_AO
			WHERE ao_code='$in_Tbl_AO_ao_code'
			AND ao_branch_code='$in_Tbl_AO_ao_branch_code'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
if ( $sqlConn === false)
die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
{
   $thecount = $row[0];
}
}
sqlsrv_free_stmt( $sqlConn );


if ($thecount < 1)
{
	$tsql ="insert into OTO_AO (system_userid,system_date,system_action,system_flag,system_desc,ao_code,ao_name,ao_branch_code,ao_hp_number,ao_nik,ao_flag,ao_active,ao_create_userid,ao_create_time,ao_tl) values ('$reg_userID',getdate(),'INPUT','R','$in_Tbl_AO_ao_code|$in_Tbl_AO_ao_branch_code|$in_Tbl_AO_ao_nik','$in_Tbl_AO_ao_code','$in_Tbl_AO_ao_name','$in_Tbl_AO_ao_branch_code','$in_Tbl_AO_ao_hp_number','$in_Tbl_AO_ao_nik','$in_Tbl_AO_ao_flag','$in_Tbl_AO_ao_active','$in_Tbl_AO_ao_create_userid',getdate(),'$in_Tbl_AO_ao_tl')";
	
	//echo $tsql."<br>";
	
	$params = array(&$_POST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
	if( $stmt )
	{
	} 
	else
	{
		echo "Error in preparing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	if( sqlsrv_execute( $stmt))
	{
	}
	else
	{
		echo "Error in executing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);
	
	$loguserid = $reg_userID;
	$logipaddr = $_SERVER['REMOTE_ADDR'];
	$logprogramcode = "AD030";
	$logproductcode = "-";
	$logdesc = "ADD AO - $in_Tbl_AO_ao_code|$in_Tbl_AO_ao_branch_code|$in_Tbl_AO_ao_nik";
	$logaction = "";
	$tsql = "INSERT INTO Tbl_SE_UserLog VALUES('$loguserid',getdate(),'$logipaddr','$logprogramcode','$logproductcode','$logdesc','$logaction')";
	$params = array(&$_POST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
	if( $stmt )
	{
	} 
	else
	{
		echo "Error in preparing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	
	if( sqlsrv_execute( $stmt))
	{
	}
	else
	{
		echo "Error in executing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);
}
else
{
	$tsql = "select * from tbl_AO where ao_code = '$in_Tbl_AO_ao_code' and ao_branch_code='$in_Tbl_AO_ao_branch_code'";
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
		   $the_AO_Name = $row['ao_name'];
		}
	}
	sqlsrv_free_stmt( $sqlConn );
	
	echo "AO Code <b>$in_Tbl_AO_ao_code</b> Sudah ada di cabang <b>$in_Tbl_AO_ao_branch_code</b> dengan AO <b>$the_AO_Name</b>";
	exit;
}

echo "<br>";

require("../lib/close_con.php");
header("location:../Form/register_ao.php?naiMsg=Data $in_Tbl_AO_ao_code Telah di daftar di menu OTORISASI untuk di INPUT")
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
//This is Demo Version
?>
