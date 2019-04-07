<?php
    
require ("../lib/open_con.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Appraisal Entry</title>
<script language="Javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+'aprdbentry.php?Custnomid='+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function popOrNot(selObj,restore) {
  var parms = "width=1000,height=600,scrollbars=yes,maximize=yes,resizable=yes"; 
  var opt = selObj.options[selObj.selectedIndex].value.split(':');
  var target =opt[0];
  var loc = opt[1];
  window.open(loc,target,parms);
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>
<BODY bgcolor=#FFFFCC>
<?php
if (isset($_GET["Custnomid"]) && $_GET["Custnomid"]!="")  { // jika querystring tbl ada
	$Custnomid = $_GET["Custnomid"]; 
?>
<?php
 $tsql = "SELECT * FROM TBL_COL_CUSTOMER where ap_lisregno = '$Custnomid'";

	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($a))
   {  
?>
<? if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
	{
?>
<table width = "600" align = "center" border = "1">
<tr>
<td>
	
	<table width = "500" align = "center" border = "0">
	<tr>
			<td colspan = "1" style="padding-left : 10px;" align = "left">Customer ID</td>
			<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustnomid" type="text" value="<? echo $Custnomid;?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
	</tr>

	<tr>
			<td colspan = "1" style="padding-left : 10px;" align = "left">Customer Name</td>
			<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustfullname" type="text" value="<? echo $row["cust_name"]; ?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
	</tr>
	<tr>
			<td colspan = "3" style="padding-left : 10px;" align = "left">&nbsp </td>
	</tr>
	<tr>
			<td colspan = "3" style="padding-left : 10px;" align = "left">PILIH JENIS COLLATERAL</td>
	</tr>
	<tr>
			<td colspan = "3" style="padding-left : 10px;" align = "left">&nbsp </td>
	</tr>
	<tr>
			<td width = "25%" style="padding-left : 10px;">Land</td>
			<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
			<td width = "20%" style="padding-left : 10px;">
				<select name="actions" id="actions" onchange="popOrNot(this,0)">
				<?
					for($m=0; $m < 11; $m++)
					{
				?>
					<option value="_blank:./entryland.php?custnomid=<? echo $Custnomid; ?>&custfullname=<? echo $row["cust_name"]; ?>&txtjumlahland=<? echo $m; ?>"><? echo $m; ?></option>
				<?
					}
				?>
				</select>
			</td>
			<td width = "20%" style="padding-left : 10px;"><input type=hidden name=custnomid value='<? echo $Custnomid; ?>'><input type=hidden name=custfullname value='<? echo $row["cust_name"]; ?>'><input name="btnsubmit" type="submit" value="VIEW" /></td>	
	</tr>
	<tr>
			<td width = "25%" style="padding-left : 10px;">Building</td>
			<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
			<td width = "20%" style="padding-left : 10px;">
				<select name="actions" id="actions" onchange="popOrNot(this,0)">
				<?
					for($m=0; $m < 11; $m++)
					{
				?>
					<option value="_blank:./entrybuilding.php?custnomid=<? echo $Custnomid; ?>&custfullname=<? echo $row["cust_name"]; ?>&txtjumlahbuilding=<? echo $m; ?>"><? echo $m; ?></option>
				<?
					}
				?>
				</select>
			</td>
			<td width = "20%" style="padding-left : 10px;"><input type=hidden name=custnomid value='<? echo $Custnomid; ?>'><input type=hidden name=custfullname value='<? echo $row["cust_name"]; ?>'><input name="btnsubmit" type="submit" value="VIEW" /></td>			
	</tr>
	<tr>
			<td width = "25%" style="padding-left : 10px;">Vehicle</td>
			<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
			<td width = "20%" style="padding-left : 10px;">
				<select name="actions" id="actions" onchange="popOrNot(this,0)">
				<?
					for($m=0; $m < 11; $m++)
					{
				?>
					<option value="_blank:./entryvehicle.php?custnomid=<? echo $Custnomid; ?>&custfullname=<? echo $row["cust_name"]; ?>&txtjumlahvehicle=<? echo $m; ?>"><? echo $m; ?></option>
				<?
					}
				?>
				</select>
			</td>
			<form action="viewvehicle.php" method=get>
			<td width = "20%" style="padding-left : 10px;"><input type=hidden name=custnomid value='<? echo $Custnomid; ?>'><input type=hidden name=custfullname value='<? echo $row["cust_name"]; ?>'><input name="btnsubmit" type="submit" value="VIEW" /></td>	
			</form>
	</tr>
	<tr>
			<td colspan = "3">&nbsp </td>
	</tr>
	</table>

</td>
</tr>
</table>
<?php
	}	
}
?>

<?php
} else { // else dari if (isset($_GET["tbl"]) && $_GET["tbl"]!="")
?>
<?
	$tsql = "SELECT * FROM TBL_COL_APP";
	$a = sqlsrv_query($conn, $tsql);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($a))
	{
		   
	?>
	<p align="center">Pilih Customer  
	  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
	  
		<option><? echo '--List REGNO--'; ?></option>
			<?
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{  	
			?>
		<option><? echo $row["ap_lisregno"]; }?></option>
	  </select>
	</p>
<?
	}
}	
?>

</body>
</html>
<?
   	require("../lib/close_con.php");
?> 