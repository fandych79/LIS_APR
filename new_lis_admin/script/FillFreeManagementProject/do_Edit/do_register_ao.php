<?
session_start();
$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];
include ("../lib/formatError.php");
require ("../lib/open_con.php");
$var_ff=$_REQUEST['var_ff'];
$var_fn=$_REQUEST['var_fn'];

$sfn = $_REQUEST['var_sfn'];
$sf = $_REQUEST['var_sf'];


//$ao_code=$_REQUEST[''];
//$ao_branch=$_REQUEST[''];
$sektor=$_REQUEST['sektor'];
$app_target=$_REQUEST['app_target'];
$nominal_target=$_REQUEST['nominal_target'];
$_desc=$_REQUEST['_desc'];
$startdate=$_REQUEST['startdate'];
$enddate=$_REQUEST['enddate'];


$var_table=$_REQUEST['var_table'];
$var_allsets = "" ;
if(isset($_REQUEST['in_ao_code']))
{
	$var_allsets = $var_allsets."ao_code"." = '".$_REQUEST['in_ao_code']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_name']))
{
	$var_allsets = $var_allsets."ao_name"." = '".$_REQUEST['in_ao_name']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_branch_code']))
{
	$var_allsets = $var_allsets."ao_branch_code"." = '".$_REQUEST['in_ao_branch_code']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_hp_number']))
{
	$var_allsets = $var_allsets."ao_hp_number"." = '".$_REQUEST['in_ao_hp_number']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_nik']))
{
	$var_allsets = $var_allsets."ao_nik"." = '".$_REQUEST['in_ao_nik']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_flag']))
{
	$var_allsets = $var_allsets."ao_flag"." = '".$_REQUEST['in_ao_flag']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_active']))
{
	$var_allsets = $var_allsets."ao_active"." = '".$_REQUEST['in_ao_active']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_create_userid']))
{
	$var_allsets = $var_allsets."ao_create_userid"." = '".$_REQUEST['in_ao_create_userid']."',";
}
else
{
}
if(isset($_REQUEST['in_ao_create_time']))
{
	$var_allsets = $var_allsets."ao_create_time"." = getdate(),";
}
else
{
}
if(isset($_REQUEST['in_ao_tl']))
{
	$var_allsets = $var_allsets."ao_tl"." = '".$_REQUEST['in_ao_tl']."',";
}
else
{
}





/*
$var_allsets = substr($var_allsets,0,strlen($var_allsets)-1);
$sql_update="update $var_table set $var_allsets where $var_fn = '$var_ff' and $sfn = '$sf'";
$tsql = $sql_update;
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

$lastEdit = $_REQUEST['actionhistory'];

$tsql ="insert into OTO_AO (system_userid,system_date,system_action,system_flag,system_desc,ao_code,ao_branch_code,ao_nik) values ('$reg_userID',getdate(),'EDIT','R','$lastEdit','$var_ff','$sf','0')";
	
//echo $tsql."<br><br><br>";

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

$var_allsets = substr($var_allsets,0,strlen($var_allsets)-1);
$sql_update="update oto_ao set $var_allsets where $var_fn = '$var_ff' and $sfn = '$sf'";
	
//echo $tsql."<br><br><br>";

$tsql = $sql_update;
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
$logdesc = "EDIT AO - $lastEdit";
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





$tsql = "SELECT COUNT(*) as b FROM oto_ao_target WHERE ao_code='".$_REQUEST['in_ao_code']."' and ao_branch='".$_REQUEST['in_ao_branch_code']."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		$rowcount = $row['b'];
	}
}
sqlsrv_free_stmt( $sqlConn );





if($rowcount>0)
{
	$tsql="update oto_ao_target set 
			sektor='".$sektor."', 
			app_target='".$app_target."',
			nominal_target='".$nominal_target."' ,
			_desc='".$_desc."' ,
			startdate='".$startdate."' ,
			enddate='".$enddate."' 
			where ao_code='".$_REQUEST['in_ao_code']."' 
			and ao_branch='".$_REQUEST['in_ao_branch_code']."'";
}
else
{
	$tsql="insert into oto_ao_target ([ao_code],[ao_branch],[sektor],[app_target],[nominal_target],[_desc],[startdate],[enddate])
		   values('".$_REQUEST['in_ao_code']."','".$_REQUEST['in_ao_branch_code']."','".$sektor."','".$app_target."','".$nominal_target."','".$_desc."','".$startdate."','".$enddate."')";
}

$params = array(&$_POST['query']);
$stmt = sqlsrv_prepare( $conn, $tsql, $params);
if(!$stmt )
{
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
}
if(!sqlsrv_execute( $stmt))
{
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
}
sqlsrv_free_stmt( $stmt);




header("location:../edit/register_ao.php?FF=$var_ff&FN=$var_fn&TABLE=$var_table&SF=$sf&SFN=$sfn&naiMsg=Data $var_ff Telah di daftar di menu OTORISASI untuk di EDIT");
require("../lib/close_con.php");
?>
