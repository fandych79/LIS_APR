<?php
require ("../lib/formatError.php");
require ("../lib/open_con.php");


$userid=$_REQUEST['userid'];
$userpwd=$_REQUEST['userpwd'];
$userbranch=$_REQUEST['userbranch'];
$userregion=$_REQUEST['userregion'];
$userwfid=$_REQUEST['userwfid'];
$custnomid=$_REQUEST['custnomid'];
$userpermission=$_REQUEST['userpermission'];
$buttonaction=$_REQUEST['buttonaction'];

$childbranch="";
$strsql="select branch_name,* from tbl_branchcluster a
		join tbl_branch b on a.branchto = b.branch_code 
		where a.branchto = '".$userbranch."' and a.flowcode='".$userwfid."'";
$sqlcon = sqlsrv_query($conn, $strsql);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlcon))
{
	while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		$childbranch .=$rows['branch']."','";
	}
}

$usertmp="";
$strsqlshow="select * from Tbl_TemporariUserAkses where  tua_nomid='".$custnomid."' and tua_wfid='".$userwfid."'";
//echo $strsqlshow;
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_REQUEST['query']);
$sqlcon = sqlsrv_query($conn, $strsqlshow, $params, $cursorType);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
$rowCounter = sqlsrv_num_rows($sqlcon);
if(sqlsrv_has_rows($sqlcon))
{
	while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		$usertmp=$rows['tua_userid'];
	}
}
$flagpindah=1;

echo $childbranch;
if($childbranch!="")
{
	if($rowCounter=="0")
	{
	$flagpindah="0";
	$strsql="insert into Tbl_TemporariUserAkses(tua_wfid,tua_userid,tua_nomid,tua_time) values('".$userwfid."','".$userid."','".$custnomid."',GETDATE())";
	$params = array(&$_POST['query']);
	$stmt = sqlsrv_prepare( $conn, $strsql, $params);
	if(!$stmt ){
	echo "Error in preparing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	if(!sqlsrv_execute( $stmt)){
	echo "Error in executing statement.\n";
	die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);
	}
	else
	{
		
		$flagpindah="1";
	}
}
else{ $flagpindah=0;}


	
	
?>

<html>
	<head>
		<script type="text/javascript" src="../js/jquery-1.7.2.min.js" ></script>
		<script>
			function pindahkeflow()
			{
				document.getElementById('formsubmit').action = "./form<?=$userwfid;?>.php";
				document.getElementById('formsubmit').submit();	
			}
			
			function keflow()
			{	
				document.getElementById('formsubmit').action = "./flow.php";
				document.getElementById('formsubmit').submit();	
			}
			
		</script>
		<style type="text/css">
			a{text-decoration:none;color:#0000FF;}
			
		</style>
	</head>
	<body <? if($flagpindah=="0"){ echo 'onload="pindahkeflow();"'; }?>>
		<form id="formsubmit" name="formsubmit" method="POST">
			
			<? if($flagpindah=="1"){ ?>
			<div style="text-align:center;margin-top:10px;">Aplikasi ini sudah di ambil <?=$usertmp?></div>
			<div style="text-align:center;"><a href="javascript:keflow();">Kembali ke flow</a></div>
			
			<?}?>
			<?
				echo '
				<div>
				<input type="hidden" name="userid" id="userid" value="'.$userid.'" />
				<input type="hidden" name="userpwd" id="userpwd" value="'.$userpwd.'" />
				<input type="hidden" name="userbranch" id="userbranch" value="'.$userbranch.'" />
				<input type="hidden" name="userregion" id="userregion" value="'.$userregion.'" />
				<input type="hidden" name="userwfid" id="userwfid" value="'.$userwfid.'" />
				<input type="hidden" name="custnomid" id="custnomid" value="'.$custnomid.'" />
				<input type="hidden" name="userpermission" id="userpermission" value="'.$userpermission.'" />
				<input type="hidden" name="buttonaction" id="buttonaction" value="'.$buttonaction.'" />
				</div>
				';
			?>
			
		</form>
	</body>
</html>