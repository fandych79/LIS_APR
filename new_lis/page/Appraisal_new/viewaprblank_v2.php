<?php
	require ("../../lib/formatError.php");
	require ("../../lib/open_con.php");

	$userid=$_GET['userid'];
	$userpwd=$_GET['userpwd'];
	$userbranch=$_GET['userbranch'];
	$userregion=$_GET['userregion'];
	$userwfid=$_GET['userwfid'];
	$userpermission=$_GET['userpermission'];
	$buttonaction=$_GET['buttonaction'];
	$Custnomid=$_GET['custnomid'];
	$custnomid = $Custnomid;
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
		document.formsubmit.action = "doaprdbentry.php";
		submitform = window.confirm("Submit <? echo $Custnomid; ?> <? echo $wfname; ?> ?")
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
		<td colspan="2" align="center"><font size=2px; color="red" style="padding-left : 1px;"><i>Sedang dalam proses</i></font></td>
	</tr>

</body>
</html>
<?
   	require("../../lib/close_con.php");
?> 