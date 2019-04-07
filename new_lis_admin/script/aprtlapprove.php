<?php
	 
require ("../lib/open_con.php");
?>
<?php
	require("../lib/open_con_apr.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Appraisal Entry</title>
<script language="Javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+'aprresponse.php?Texcustnomid='+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function popOrNot(selObj,restore) {
  var parms = "width=800,height=600,scrollbars=yes"; 
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
if (isset($_GET["Texcustnomid"]) && $_GET["Texcustnomid"]!="")  { // jika querystring tbl ada
	$Custnomid = $_GET["Texcustnomid"]; 
?>
<?php
 $tsql = "SELECT distinct * FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid'";
 

	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($a))
   {  

?>

	<table width = "500" align = "center" border = "0">
	<form id="form1" name="form1" method="get" action="doviewtlapprove.php"> 
		<tr>
			<td colspan = "1" style="padding-left : 10px;" align = "left">Customer ID</td>
			<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustnomid" type="text" value="<? echo $Custnomid;?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
		</tr>
		<?php
			$tsqla = "SELECT * FROM TBL_COL_CUSTOMER where ap_lisregno = '$Custnomid'";

			$aa = sqlsrv_query($conn, $tsqla);

			if ( $aa === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($aa))
			{  
				if($rowa = sqlsrv_fetch_array($aa, SQLSRV_FETCH_ASSOC))
				{
		?>
		<tr>
			<td colspan = "1" style="padding-left : 10px;" align = "left">Customer Name</td>
			<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustfullname" type="text" value="<? echo $rowa["cust_name"]; ?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
		</tr>
		<?php
				}
			}
		?>
		
		<?php
			$asql = "SELECT * FROM Tbl_CustomerFlag where custnomid = '$Custnomid' and custflagapr = 'R'";

			$apr = sqlsrv_query($conn, $asql);

			if ( $apr === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($apr))
			{
				if($rowap = sqlsrv_fetch_array($apr, SQLSRV_FETCH_ASSOC))
				{ 
		?>
		
		<tr>
			<td width = "40%" style="padding-left : 10px;">Jenis Collateral Customer</td>
			<td width = "60%" style="padding-left : 10px;">
				<select name="actions" id="actions" onchange="popOrNot(this,0)">
					<option>-=Select=-</option>
					<?
						while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
						{ 
					?>
					<option value="_blank:./viewtlapprove.php?custnomid=<? echo $Custnomid; ?>&custjeniscol=<? echo $row['cust_jeniscol'];?>"><? echo $row['cust_jeniscol']; ?></option>
					<?			
						}
						
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td width=80% align="center" colspan="2"><input type="submit" value="Approve" ></input><input type=hidden name=custnomid value='<? echo $Custnomid; ?>'></td>
		</tr>
		</form>
		<?php
				}
				else
				{}
			} 
			else
			{
		?>
		<tr>
			<td width = "40%" style="padding-left : 10px;">Jenis Collateral Customer</td>
			<td width = "60%" style="padding-left : 10px;"><select name="actions" id="actions" onchange="popOrNot(this,0)">
					<option>-=Kosong=-</option>

				</select></td>

		</tr>
		<?php
			}
		?>
		
	</table>




<?
		
	}
?>

<?php
} else { // else dari if (isset($_GET["tbl"]) && $_GET["tbl"]!="")
?>
<?
	$tsql = "Select * from APP where FLAG = '1'";

	$a = sqlsrv_query($connapr, $tsql);

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
			<option><? echo $row["AP_LISREGNO"]; }?></option>
		</select>
	</p>

<?
	}
}
?>
</BODY>
</html>
<?
   	require("../lib/close_con.php");
?>