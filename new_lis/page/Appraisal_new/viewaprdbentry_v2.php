<?php
	require ("../../lib/formatError.php");
	require ("../../lib/open_con.php");
	require ("../../requirepage/parameter.php");

	/*$userid=$_GET['userid'];
	$userpwd=$_GET['userpwd'];
	$userbranch=$_GET['userbranch'];
	$userregion=$_GET['userregion'];
	$userwfid=$_GET['userwfid'];
	$userpermission=$_GET['userpermission'];
	$buttonaction=$_GET['buttonaction'];*/
	$Custnomid=$_GET['custnomid'];
	$custnomid = $Custnomid;
	
	if(isset($userid) && isset($userpwd) && isset($userbranch) && isset($userregion) && isset($userwfid) )
{
}
else
{
	//header("location:restricted.php");
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
   	   //header("location:restricted.php");
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
/* 
 $tsql = "select * from Tbl_Workflow where wf_id='$userwfid'";
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
$wfname = "Collateral";
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ViewAppraisalEntry</title>
<link rel="stylesheet" type="text/css" href="../../lib/tab-view.css" />
<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../lib/slide_down.js"></script>
<script type="text/javascript" src="../../js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="../../js/full_function.js"></script>
<link href="../../css/crw.css" rel="stylesheet" type="text/css" />
<Script Language="JavaScript">
function goSave()
{
	var FormName="formentry";
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
		document.formsubmit.action = "doaprdbentry.php";
		submitform = window.confirm("<? echo $confmsg;?>")
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
   document.formsubmit.action = "doaprdbentry.php";

	varmsg = "Approve <? echo $Custnomid; ?> <? //echo $wfname; ?> ?";

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
	$tsql = "SELECT *,'nama'= case when custsex='0' then custbusname else custfullname end FROM tbl_customerMasterPerson where custnomid = '$Custnomid'";

	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
	  die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($a))
	{  
		if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			$custfullname = $row["nama"];
		}
	}
?>
	<table width = "1100px" align = "center" border = "0" class="preview">
	<form id="formentry" name="formentry" method="post" action="">
	<tr>	
		<td colspan="2" align="center"><strong>View Collateral</strong></td>
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
		$colid = "";
		$jeniscol = "";
		$rowcountjaminan = 0;
		$tsql = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' AND FLAGDELETE = '0'";//echo $tsql;
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
		<td width="20%" valign="top">
			<table width = "100%" align = "center" border = "0">
				<?
					$arraycolid = explode("|", $colid);
					$arrayjeniscol = explode("|", $jeniscol);
					$jenisjaminan = "";
					for($i=0; $i<$rowcountjaminan; $i++)
					{
						$warna = "";
						if($i%2==0)
						{
							$warna = "class=green";
						}
						else
						{
							$warna = "class=green";
						}
					$tsql = "SELECT * FROM TblCollateralType where col_code = '$arrayjeniscol[$i]' AND col_active = 'Y'";//echo $tsql;
					$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

					if ( $a === false)
					die( FormatErrors( sqlsrv_errors() ) );
					
					if(sqlsrv_has_rows($a))
					{ 	
						while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
						{
							$kodeJaminan = $arraycolid[$i];
							$jenisjaminan = $row['col_name'];
						}
					}
						
				?>
				<tr>
					<td>
					<? echo '<input type="button" '.$warna.' style="width:200px;" id="swapbutton" value="'.$jenisjaminan.'" onclick="yukiswap(\''.$arraycolid[$i].'\', \''.$arrayjeniscol[$i].'\')">'; ?>
					<? echo '<input type="button" '.$warna.' style="width:200px;" id="swapbutton" value="KJPP" onclick="aprkjpp(\''.$arraycolid[$i].'\', \''.$arrayjeniscol[$i].'\')">'; ?>
					<? if($arrayjeniscol[$i]=="TAN"||$arrayjeniscol[$i]=="BA1"||$arrayjeniscol[$i]=="RUK"||$arrayjeniscol[$i]=="KI2") {echo '<input type="button" '.$warna.' style="width:200px;background-color:purple;" id="swapbutton" value="Nilai PBB" onclick="nilaipbbview(\''.$arraycolid[$i].'\', \''.$arrayjeniscol[$i].'\')">'; }?>
                    <!--<input type='button' class='orange' style='width:100%;' value='Pictures' onclick='window.open("viewaprimage_v2.php?custnomid=<? echo $custnomid; ?>&userid=<? echo $userid; ?>&userpwd=<? echo $userpwd; ?>&userbranch=<? echo $userbranch; ?>&userregion=<? echo $userregion; ?>&userwfid=<? echo $userwfid; ?>&userpermission=<? echo $userpermission; ?>&buttonaction=<? echo $buttonaction; ?>&fileindex1=<? echo $kodeJaminan;?>");'>-->
                     <?echo "<hr>";?>
                    </td>
				</tr>
				<?
					}
				?>
			</table>		
            
            <br><br><br>	
			<?
				$jmlview = 0;
				$tsqlview = "SELECT COUNT(*) as jmlview FROM TBL_CUST_MASTERCOL WHERE AP_LISREGNO = '$Custnomid' AND FLAGINSERT = '0' AND FLAGDELETE = '0'";
				$aview = sqlsrv_query($conn, $tsqlview);

				  if ( $aview === false)
				  die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aview))
				{  
					if($rowview = sqlsrv_fetch_array($aview, SQLSRV_FETCH_ASSOC))
					{
						$jmlview = $rowview['jmlview'];
					}
				}
				if($jmlview == 0)
				{
			?>
				<?
					//------------------------------------------------------------------------
					$tsql = "SELECT * FROM Tbl_FCOL WHERE txn_id='$Custnomid'";
					$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params = array(&$_POST['query']);
					$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
					$rowCount = sqlsrv_num_rows($sqlConn);

					if ( $sqlConn === false)
					die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($sqlConn))
					{
						while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
						{
							$NowFlow = $row[1];
						}
					}
					sqlsrv_free_stmt( $sqlConn );
					
					if($NowFlow=="I" && $rowcountjaminan != 0)
					{
				?>
				
				<div align="center"><?require ("../../requirepage/btnbacktoflow.php"); ?></div>
				<div align="center"><input type='button' class='blue' style='width:115px;' value='Submit' onclick='yukicheck();'>
				
				<input type="hidden" name="userpermission" value='C'></div>	
			<?
					}
					else if($NowFlow=="C")
					{
					
			?>	
				<div align="center"><font size=2px; color="red" style="padding-left : 1px;"><i>Telah disubmit</i></font></div>
				
				<div align="center"><?require ("../../requirepage/btnbacktoflow.php"); ?></div>
			<?
					}
					else if($NowFlow=="A")
					{
			?>
				<div align="center"><font size=2px; color="red" style="padding-left : 1px;"><i>Telah disetujui</i></font></div>
				
				<div align="center"><?require ("../../requirepage/btnbacktoflow.php"); ?></div>
			<?
					}
				}
				else
				{
			?>
				<div align="center"><font size=2px; color="red" style="padding-left : 1px;"><i>Semua jaminan belum terisi</i></font></div>		
			<?
				}
			?>
			<br>
		</td>		
		<td width="75%" valign="top">
			<table width = "560" align = "center" border = "0">
				<tr>
					<td width="100%" id="yukirin" valign="top"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><? //require("../../requirepage/btnview.php");?></td>
	</tr>

		<input type="hidden" name="act" value='<? echo $userid; ?>'>
		<input type="hidden" name="userid"  value='<? echo $userid; ?>'>
		<input type="hidden" name="userpwd" value='<? echo $userpwd; ?>'>
		<input type="hidden" name="userbranch" value='<? echo $userbranch; ?>'>
		<input type="hidden" name="userregion" value='<? echo $userregion; ?>'>
		<input type="hidden" name="buttonaction" value='<? echo $buttonaction; ?>'>
		<input type="hidden" name="userwfid"  value='<? echo $userwfid; ?>'>
		<input type="hidden" id="custnomid" name="custnomid" value='<? echo $Custnomid; ?>'>
		<input type="hidden" id="custfullname" name="custfullname" value='<? echo $custfullname; ?>'>
		<input type='hidden' id='indra' name='indra' value=''>
	</form>
	</table>
	
	<script type="text/javascript">
		function yukiswap(id, jenis) {
			var a="swap";
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
					$("#yukirin").html(response);
				}
			});
		}
		function nilaipbbview(id, jenis) {
			var a="swappbb";
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
					$("#yukirin").html(response);
				}
			});
		}
		function yukicheck() {		
			var custnomid=$("#custnomid").val();
			
			document.formentry.indra.value = "CHECK";
			document.formentry.target = "utama";
			document.formentry.action = "doaprdbentry_v2.php";
			submitform = window.confirm("<? echo $confmsg;?>")
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
		function yukiview() {
			var custnomid=$("#custnomid").val();
			
			document.formentry.indra.value = "VIEWPIC";
			document.formentry.target = "utama";
			document.formentry.action = "doaprdbentry_v2.php";
			document.formentry.submit();
		}
		function aprkjpp(id, jenis) {
			var a="kjpp";
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
					$("#yukirin").html(response);
				}
			});
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