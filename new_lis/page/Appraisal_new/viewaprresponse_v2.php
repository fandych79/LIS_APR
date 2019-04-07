<?php
	include ("../../lib/formatError.php");
	require ("../../lib/open_con.php");
	
	$Custnomid=$_GET['custnomid'];
	$custnomid = $Custnomid;
	$userid=$_GET['userid'];
	$userpwd=$_GET['userpwd'];
	$userbranch=$_GET['userbranch'];
	$userregion=$_GET['userregion'];
	$userwfid=$_GET['userwfid'];
	$userpermission=$_GET['userpermission'];
	$buttonaction=$_GET['buttonaction'];

	
	if(isset($userid) && isset($userpwd) && isset($userbranch) && isset($userregion) && isset($userwfid) )
{
}
else
{
	header("location:restricted.php");
}

// SECURITY
   $tsql = "SELECT COUNT(*) FROM Tbl_SE_User
   					WHERE user_id='$userid'
   					AND user_pwd='$userpwd'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
   		   $thecount = $row[0];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   if ($thecount == 0)
   {
   	   header("location:restricted.php");
   }

   $tsql = "SELECT COUNT(*) FROM Tbl_SE_UserProgram
   					WHERE user_id='$userid'
   					AND program_code='$userwfid'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
   		   $thecount = $row[0];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   if ($thecount == 0)
   {
	   //header("location:restricted.php");
   }

   $tsql = "SELECT * FROM Tbl_SE_UserProgram
   					WHERE user_id='$userid'
   					AND program_code='$userwfid'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   $userpinp = "";
   $userpchk = "";
   $userpapr = "";
   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
		$userpinp = substr($row[2],1-1,1);
		$userpchk = substr($row[2],2-1,1);
		$userpapr = substr($row[2],3-1,1);
      }
   }
   sqlsrv_free_stmt( $sqlConn );

// END SECURITY

// PROFILE USER ID (AO / TL / PINCA)
   $tsql = "SELECT user_ao_code, user_level_code, user_child FROM Tbl_SE_User
   					WHERE user_id='$userid'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
   		   $profileaocode = $row[0];
   		   $profilelevelcode = $row[1];
   		   $profileuserchild = $row[2];
      }
	}
   sqlsrv_free_stmt( $sqlConn );

   // END PROFILE
//SELECT From Tbl_Workflow & PrevFlow
 /*   $tsql = "select * from Tbl_Workflow where wf_id='$userwfid'";
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
   		   $wfname = $row[1];
   		   $wftime = $row[3];
   		   $wfscore = $row[4];
   		   $wfaction = $row[5];
   		   $wfflag = $row[7];
      }
	}
   sqlsrv_free_stmt( $sqlConn );
//END GET WFNAME
*/
$wfname = "Aprraisal Response";
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Appraisal Entry</title>
<script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../js/full_function.js"></script>
<link href="../../css/crw.css" rel="stylesheet" type="text/css" />
<Script Language="JavaScript">
function goSave()
{
	var FormName="formsubmit";
	var elem = document.getElementById(FormName).elements;
	for(var i = 0; i < elem.length; i++)
	{
		elem[i].value = elem[i].value.toUpperCase();
	}
	
	var StatusAllowSubmit=true;
	var elem = document.getElementById(FormName).elements;
	for(var i = 0; i < elem.length; i++)
	{
		if(elem[i].style.backgroundColor=="#ff0")
		{
			if(elem[i].value == "")
			{
				alert(elem[i].nai + " field Must be filled");	
				StatusAllowSubmit=false				
				break;
			}
		}
	}
	
	if(StatusAllowSubmit == true)
	{			
		document.formsubmit.target = "utama";
		document.formsubmit.action = "do_saveflow.php";
		submitform = window.confirm("Approve <? echo $Custnomid; ?> <? echo $wfname; ?> ?")
		if (submitform == true)
		{
			document.formsubmit.submit();
			return true;
		}
		else
		{
			return false;
		} 
	}
}
function goApprove(theid)
{
   document.formsubmit.target = "utama";
   document.formsubmit.approvepermission.value = theid;
   //alert(document.formsubmit.approvepermission.value);
   document.formsubmit.act.value = "saveform";
   document.formsubmit.action = "doviewaprresponse.php";

	varmsg = "Approve <? echo $Custnomid; ?> <? echo $wfname; ?> ?";

   submitform = window.confirm(varmsg);
   if (submitform == true)
   {
			document.formsubmit.submit();
			return true;
   }
   else
   {
	  return false;
   } 
}
</Script>
</head>
<BODY>
<?php
	$custfullname = "";
	$tsql = "SELECT * FROM tbl_customerMasterPerson where custnomid = '$Custnomid'";

	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
	  die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($a))
	{  
		if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			$custfullname = $row["custfullname"];
		}
	}
?>

	<table width = "800" align = "center" border = "0" class="preview">
	<form id="formentry" name="formentry" method="post" action="">
	<tr>	
		<td colspan="2" align="center"><strong>View Appraisal Response</strong></td>
	</tr>
	<tr>	
		<td colspan="2" align="center">&nbsp;</td>
	</tr>
	<tr>	
		<td colspan="2" align="center">Customer ID : <? echo $custnomid; ?></td>
	</tr>
	<tr>	
		<td colspan="2" align="center">Customer Name : <? echo $custfullname; ?></td>
	</tr>
	<tr>	
		<td colspan="2" align="center">&nbsp;</td>
	</tr>
	<tr>	
		<td colspan="2" align="center">&nbsp;</td>
	</tr>

<?php
	$flagapr = "";
	$tsql = "SELECT CUSTFLAGAPR FROM Tbl_CustomerFlag where custnomid = '$Custnomid'";

	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
	  die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($a))
	{  
		if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			$flagapr = $row["CUSTFLAGAPR"];
		}
	}
	
	$action = "";
	$tsql = "SELECT TXN_ACTION FROM Tbl_FAPR where TXN_ID = '$Custnomid'";

	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
	  die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($a))
	{  
		if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			$action = $row["TXN_ACTION"];
		}
	}
	
	if($flagapr == "Z")
	{
?>
<?php
	$colid = "";
	$jeniscol = "";
	$tsql = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' AND FLAGDELETE = '0' AND FLAGINSERT = '1'";
	$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );
	
	if(sqlsrv_has_rows($a))
	{  
		$rowcountjaminan = sqlsrv_num_rows($a);
		while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			if($colid == "")
			{
				$colid = $row['col_id'];
				$jeniscol = $row['cust_jeniscol'];
			}
			else
			{
				$colid = $colid."|".$row['col_id'];
				$jeniscol = $jeniscol."|".$row['cust_jeniscol'];
			}
		}
	}	
?>
	<tr>
		<td width="30%" valign="top">
			<table width = "100%" align = "center" border = "0">
				<?
					$arraycolid = explode("|", $colid);
					$arrayjeniscol = explode("|", $jeniscol);
					$jenisjaminan = "";
					for($i=0; $i<$rowcountjaminan; $i++)
					{
					
					$tsql = "SELECT * FROM TblCollateralType where col_code = '$arrayjeniscol[$i]' AND col_active = 'Y'";
					$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

					if ( $a === false)
					die( FormatErrors( sqlsrv_errors() ) );
					
					if(sqlsrv_has_rows($a))
					{ 	
						while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
						{
							$jenisjaminan = $row['col_name'];
						}
					}
						
				?>
				<tr>
					<td><? echo '<input type="button" class="green" style="width:160px;font-size:10px;height:23px;" id="swapbutton" value="'.$jenisjaminan.'" onclick="sasshiswap(\''.$arraycolid[$i].'\', \''.$arrayjeniscol[$i].'\')"> <input type="button" class="blue" value="cetak" width="30px"  onclick="sasshicetak(\''.$arraycolid[$i].'\', \''.$arrayjeniscol[$i].'\')"></td>'; //<input type="button" class="blue" value="cetak" width="30px"  onclick="sasshicetak(\''.$arraycolid[$i].'\', \''.$arrayjeniscol[$i].'\')">?>
				</tr>
				<?
					}
				?>
			</table>
			<div align="center"><input type='button' class='orange' style='width:220px;' value='Lihat Gambar Appraisal' onclick='window.open("viewresponseaprimage_v2.php?custnomid=<? echo $custnomid; ?>&userid=<? echo $userid; ?>&userpwd=<? echo $userpwd; ?>&userbranch=<? echo $userbranch; ?>&userregion=<? echo $userregion; ?>&userwfid=<? echo $userwfid; ?>&userpermission=<? echo $userpermission; ?>&buttonaction=<? echo $buttonaction; ?>");'></div>
			<br><br>
			<?
				if($action == "A")
				{
				
				}
				else
				{
			?>
			<!--<div align="center"><input type='button' class='blue' style='width:115px;' value='Approve' onclick='sasshiapprove();'>-->
			<?
				}
			?>
				
			
		</td>
		<td width="70%" valign="top">
			<table width = "560" align = "center" border = "1">
				<tr>
					<td width="100%" id="sasshi" valign="top"></td>
				</tr>
			</table>
		</td>
	</tr>
	
	
	
<?
	}
	else
	{
?>
	<tr>	
		<td colspan="2" align="center"><font size=2px; color="red" style="padding-left : 1px;"><i>Belum di appraisal</i></font></td>
	</tr>
	<!--<tr>
		<td colspan = "2" style="padding-left : 10px;" align = "center"><a href="./flow.php?userid=<? echo $userid;?>&userpwd=<? echo $userpwd;?>&userbranch=<? echo $userbranch;?>&userregion=<? echo $userregion;?>&userwfid=<? echo $userwfid;?>">Kembali</a> </td>
	</tr>-->
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
<?
	}
?>
		<input type="hidden" name="userpermission" value='<? echo $userpermission; ?>'></div>	
		<input type="hidden" name="act" value='<? echo $userid; ?>'>
		<input type="hidden" name="userid"  value='<? echo $userid; ?>'>
		<input type="hidden" name="userpwd" value='<? echo $userpwd; ?>'>
		<input type="hidden" name="userbranch" value='<? echo $userbranch; ?>'>
		<input type="hidden" name="userregion" value='<? echo $userregion; ?>'>
		<input type="hidden" name="buttonaction" value='<? echo $buttonaction; ?>'>
		<input type="hidden" name="userwfid" value='APR'>
		<input type="hidden" id="custnomid" name="custnomid" value='<? echo $Custnomid; ?>'>
		<input type="hidden" id="custfullname" name="custfullname" value='<? echo $custfullname; ?>'>
		<input type='hidden' id='indra' name='indra' value=''>
	</form>
	</table>
	
	<script type="text/javascript">
		function sasshiswap(id, jenis) {
			var a="swapresponse";
			var colid = id;
			var jeniscol = jenis;
			var custnomid=$("#custnomid").val();
			var custfullname=$("#custfullname").val();

			$.ajax({
				type: "GET",
				url: "ajaxview_v2.php",
				data: "a="+a+"&colid="+colid+"&jeniscol="+jeniscol+"&custnomid="+custnomid+"&custfullname="+custfullname+"&random="+ <?php echo time(); ?> +"",
				success: function(response)
				{	//alert(response);
					$("#sasshi").html(response);
				}
			});
		}
		
		function sasshicetak(id, jenis) {
			var a="cetakresponse";
			var colid = id;
			var jeniscol = jenis;
			var custnomid=$("#custnomid").val();
			var custfullname=$("#custfullname").val();
			
			//alert(jeniscol);
			if(jeniscol == "BA1")
			{
				window.open("cetakbuildingresponse.php?custnomid="+custnomid+"&custfullname="+custfullname+"&colid="+colid+"&jeniscol="+jeniscol+"");
			}
			else
			{
			
			}
			
		}
		
		function sasshiview() {
			var custnomid=$("#custnomid").val();
			
			document.formentry.indra.value = "VIEWPICRESPONSE";
			document.formentry.target = "utama";
			document.formentry.action = "doaprdbentry_v2.php";
			document.formentry.submit();
		}
		function sasshiapprove() {		
			var custnomid=$("#custnomid").val();
			
			document.formentry.indra.value = "APPROVERESPONSE";
			document.formentry.target = "utama";
			document.formentry.action = "doaprdbentry_v2.php";
			submitform = window.confirm("Approve <? echo $Custnomid; ?> <? echo $wfname; ?> ?")
			if (submitform == true)
			{
				document.formentry.submit();
				return true;
			}
			else
			{
				return false;
			} 
		}
	</script>
	<script language="Javascript">
				name="utama";
	</script>
</body>
</html>
<?
   	require("../../lib/close_con.php");
?> 