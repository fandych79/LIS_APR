<?php
session_start();
$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];
include ("../lib/formatError.php");
require ("../lib/open_con.php");

$var_table = $_REQUEST['var_table'];

$var_ff=$_REQUEST['var_ff'];
$var_fn=$_REQUEST['var_fn'];

$sfn = $_REQUEST['var_sfn'];
$sf = $_REQUEST['var_sf'];


/*
$tsql = "delete from $var_table where $var_fn = '$var_ff' and $sfn = '$sf'";
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
*/

$tsql ="insert into OTO_AO (system_userid,system_date,system_action,system_flag,system_desc,ao_code,ao_branch_code,ao_nik) values ('$reg_userID',getdate(),'DELETE','R','AO Code >> $var_ff<br>AO Branch >> $sf<br>','$var_ff','$sf','0')";
	
echo $tsql."<br><br><br>";

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
$logdesc = "DELETE AO - $var_ff|$sf";
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

//header("location:../Preview/register_ao.php?naiMsg=Data $varff Telah di daftar di menu OTORISASI untuk di Delete");
header("location:../edit/register_ao.php?FF=$var_ff&FN=$var_fn&TABLE=$var_table&SF=$sf&SFN=$sfn&naiMsg=Data $var_ff Telah di daftar di menu OTORISASI untuk di DELETE");

?>