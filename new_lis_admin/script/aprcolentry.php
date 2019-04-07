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
  eval(targ+".location='"+'aprcolentry.php?Texcustnomid='+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function cekthis()
{
    submitform = window.confirm("Submit Data ?")
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
</script>
</head>

<BODY bgcolor=#FFFFCC>
<?php
if (isset($_GET["Texcustnomid"]) && $_GET["Texcustnomid"]!="")  { // jika querystring tbl ada
	$Custnomid = $_GET["Texcustnomid"]; 
?>

<form action="doaprcolentry.php" method="get">

<?php
 $tsql = "SELECT * FROM tbl_customermasterperson where custnomid = '$Custnomid'";
	$a = sqlsrv_query($conn, $tsql);

	  if ( $a === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($a))
   {  
?>
<?
	if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
	{
	$branch = $row["custbranchcode"];
?>
	<table width = "700" align = "center" border = "1">
	<tr>
	<td>
     <table width="600" align="center" border="0">  
      <tr>
	  <tr>
        <td width="30%">Custnomid</td>
        <td width="3%" align="center">:</td>
        <td width="67%"><input name="txtcustnomid" type="text" value="<? echo $row["custnomid"];?>" size="50" readonly="readonly" style="background-color:#FF9"/></td>
      </tr>
      <tr>
        <td>Custfullname</td>
        <td align="center">:</td>
        <td><input name="txtcustfullname" type="text" value="<? echo $row["custfullname"];?>" size="50" readonly="readonly" style="background-color:#FF9"/></td>
      </tr>
	  
	<?php
		$tsql = "SELECT * FROM Tbl_Branch where branch_code = '$branch'";
		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   { 
			if($rowBranch = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{
	   
	?>
	  <tr>
        <td>Custregioncode</td>
        <td align="center">:</td>
        <td><input name="txtregioncode" type="text" value="<? echo $rowBranch["branch_region_code"];?>" size="50" readonly="readonly" style="background-color:#FF9"/></td>
      </tr>
    <?		
			}
		}
	?>
	  <tr>
        <td>Custbranchcode</td>
        <td align="center">:</td>
        <td><input name="txtbranchcode" type="text" value="<? echo $row["custbranchcode"];?>" size="50" readonly="readonly" style="background-color:#FF9"/></td>
      </tr>
      <tr>
        <td>Custaddr</td>
        <td align="center">:</td>
        <td><input name="txtcustaddr" type="text" value="<? echo $row["custaddr"];?>" size="50" readonly="readonly" style="background-color:#FF9"/></td>
      </tr>
      <tr>
        <td>Custtelp</td>
        <td align="center">:</td>
        <td><input name="txtcusttelp" type="text" value="<? echo $row["custtelp"];?>" size="50" readonly="readonly" style="background-color:#FF9"/></td>
      </tr>
	<?php
	 $tsql = "SELECT * FROM RFTAXATIONTYPE";
		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   { 
	   
	?>
	   <tr>
        <td>TAXATYPE</td>
        <td align="center">:</td>
		<td><select name="taxatype">
		<?
			While($rowTax = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{
		?>
		<option value="<? echo $rowTax["TAXATYPE_ID"]; ?>"><? echo $rowTax["TAXATYPE_DESC"];?></option>
		<?
			}
		?>
		</select> <font color="#FF0000">*)</font></td>
      </tr>
	<?
		}
	?>
	  
		<?php
		$tsql = "SELECT * FROM RFBUSINESSTYPE";
		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   { 
	   
	?>
	   <tr>
        <td>RFBUSINESSTYPE</td>
        <td align="center">:</td>
		<td><select name="businesstype">
		<?
			While($rowBus = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{
		?>
		<option value="<? echo $rowBus["BT_CODE"]; ?>"><? echo $rowBus["BT_DESC"];?></option>
		<?
			}
		?>
		</select> <font color="#FF0000">*)</font></td>
      </tr>
	<?
		}
	?>
		<tr>
        <td colspan = "3" align = "center">&nbsp</td>
        </tr>
	    <tr>
        <td colspan = "3" align = "center"><input name="btnsubmit" type="submit" value="SUBMIT" /><input name="btnreset" type="reset" value="RESET"/></td>
        </tr>
    </table>  
		
	</td>
	</tr>
	</table>
<?
	}
}
?>
</form> 


<?php
}
else if (isset($_GET["info"]) && $_GET["info"]!="")  { // jika querystring tbl ada
	$info = $_GET["info"]; 
?>
	<?
		$tsql = "SELECT * FROM tbl_customermasterperson";
		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   {
		   
	?>
	<p align="center">Pilih Customer  
	  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
	  
		<option><? echo '--List NOM ID--'; ?></option>
			<?
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{  	
			?>
		<option><? echo $row["custnomid"]; }?></option>
	  </select>
	</p>
	
	<p align="center" >
		<strong><font color="#FF0000"><?  echo $info; ?></font></strong>
	</p>
	<?
	   }
	?>

<?php
} else { // else dari if (isset($_GET["tbl"]) && $_GET["tbl"]!="")
?>

	<?
		$tsql = "SELECT * FROM tbl_customermasterperson";
		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   {
		   
	?>
	<p align="center">Pilih Customer  
	  <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
	  
		<option><? echo '--List NOM ID--'; ?></option>
			<?
				while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
				{  	
			?>
		<option><? echo $row["custnomid"]; }?></option>
	  </select>
	</p>
	<?
	   }
	?>
<?php
} // end if dari (isset($_GET["tbl"]) && $_GET["tbl"]!="")
?>
 
</body>
</html>
<?
   	require("../lib/close_con.php");
?> 
