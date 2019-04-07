<?php
	
	//include ("../../../lib/formatError.php");
	require ("../../../lib/open_con.php");

	$userid = $_GET['userid'];
	$userpwd = $_GET['userpwd'];
	$userbranch = $_GET['userbranch'];
	$userregion = $_GET['userregion'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SUMMARY APPRAISAL</title>
<script type="text/javascript" src="../../../js/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../../js/full_function.js"></script>
<link href="../../../css/crw.css" rel="stylesheet" type="text/css" />
<Script language="JAVASCRIPT">
 function goSave()
{
	if(document.getElementById('tgl1').value=="")
	{
		alert('Dari Tanggal harus diisi');
		
	}
	else if(document.getElementById('tgl2').value=="")
	{
		alert('Sampai Tanggal harus diisi');
		
	}
	else
	{
		document.formsubmit.target = "utama";
		document.formsubmit.action = "do_report.php";		
		document.formsubmit.submit();
	}
}
        
</Script>

	<style type="text/css" media="print">
		.NonPrintable
		{
		  display: none;
		}
	</style>
	
	<style type="text/css" media="print">
		.break{
		page-break-before: always;
		}
	</style> 
</head>
<BODY>
<script language="Javascript">
				name="utama";
</script>

<Table width =800 border='0' align=center>
	<tr>
		<td>
		<form id="formsubmit" name="formsubmit" action="do_report.php" method=post>
			<table width=60% border=0 style="border:1px solid black;padding:5px;" cellpadding=0 cellspacing=0 align=center>
			<tr>
				<td align=center colspan=2><strong>REPORT APPRAISAL</strong></td>
			</tr>
			<tr>
				<td align=center colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width=50% align=left valign=top>
					<font face=Arial size=2>Dari tanggal </font>
				</td>
				<td width=50% align=left valign=top>
					<input type=text id=tgl1 name=tgl1 readonly=readonly nai="DARI TANGGAL" style="background:#FF0"> </input>
					<a href="javascript:NewCssCal('tgl1','ddMMyyyy')"><img src="../../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
					<font face=Arial size=2 color=blue></font>
				</td>
			</tr>
			<tr>
				<td width=40% align=left valign=top>
					<font face=Arial size=2>Sampai tanggal</font>
				</td>
				<td width=60% align=left valign=top>
					<input type=text id=tgl2 name=tgl2 readonly=readonly nai="SAMPAI TANGGAL" style="background:#FF0"> </input>
					<a href="javascript:NewCssCal('tgl2','ddMMyyyy')"><img src="../../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
					<font face=Arial size=2 color=blue></font>
				</td>
			</tr>
			<tr>
				<td align=center colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td align=center colspan=2><input type=button value=INPUT class=blue onclick=goSave()> <input type=reset class=red value=RESET></td>
			</tr>
			<input type="hidden" id="userid" name="userid" value="<? echo $userid;?>" >
			<input type="hidden" id="userpwd" name="userpwd" value="<? echo $userpwd;?>" >
			<input type="hidden" id="userbranch" name="userbranch" value="<? echo $userbranch;?>" >
			<input type="hidden" id="userregion" name="userregion" value="<? echo $userregion;?>" >
		</form>	
		</td>
	</tr>
	</Table>

</BODY>
</html>
<?
   	//require("../../../lib/close_con.php");
?>