<?php
   require ("../../lib/open_con.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Appraisal Entry</title>
<link rel="stylesheet" type="text/css" href="../../lib/tab-view.css" />
<script type="text/javascript" src="../../lib/datetimepicker_css.js"></script>
</head>
<BODY>
<?php
//if (isset($_GET["Texcustnomid"]) && $_GET["Texcustnomid"]!="")  { // jika querystring tbl ada
	$Custnomid = $_GET["Texcustnomid"];
	$tab = $_GET['tab'];
?>

<?
if($tab == "0")
{
?>

	<?php
	 $tsql = "SELECT * FROM tbl_customerMasterPerson where custnomid = '$Custnomid'";

		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   {  
	?>
	<? if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
	?>
	<table width = "800" align = "center" border = "1">
	<tr>
	<td>
		
		<table width = "500" align = "center" border = "0">
		<form action="doaprdbentry.php" method="post">
		<tr>
				<td colspan = "1" style="padding-left : 10px;" align = "left">Customer ID</td>
				<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustnomid" type="text" value="<? echo $Custnomid;?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
		</tr>

		<tr>
				<td colspan = "1" style="padding-left : 10px;" align = "left">Customer Name</td>
				<td colspan = "1" style="padding-left : 10px;" align = "left"><input name="txtcustfullname" type="text" value="<? echo $row["custfullname"]; ?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
				<td style="padding-left : 10px;" align="left"><a href="editaprdbentry.php?Texcustnomid=<? echo $Custnomid;?>&tab=edit">EDIT</a> </td>
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
				<td width = "20%" style="padding-left : 10px;"><input type=text name=jmllnd maxlength=3 size=1 value=0 style=text-align:center;></td>
		</tr>
		<tr>
				<td width = "25%" style="padding-left : 10px;">Building</td>
				<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
				<td width = "20%" style="padding-left : 10px;"><input type=text name=jmlbld maxlength=3 size=1 value=0 style=text-align:center;></td>
		</tr>
		<tr>
				<td width = "25%" style="padding-left : 10px;">Vehicle</td>
				<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
				<td width = "20%" style="padding-left : 10px;"><input type=text name=jmlvhc maxlength=3 size=1 value=0 style=text-align:center;></td>
		</tr>
		<tr>
				<td colspan = "3">&nbsp </td>
		</tr>
		<tr>
				<td colspan = "3" align=center><input type=Submit value=Submit><input type=Reset value=Reset><input type=hidden name=tab value='tab'</td>
		</tr>
		</form>
		</table>

	</td>
	</tr>
	</table>
	<?php
		}	
	}
	?>

<?
}// tutup if dari act I
else if ($tab == "tab")
{
?>
<?php
	$countlnd=$_GET['lnd'];
	$countbld=$_GET['bld'];
	$countvhc=$_GET['vhc'];
	 $tsql = "SELECT * FROM tbl_customerMasterPerson where custnomid = '$Custnomid'";

		$a = sqlsrv_query($conn, $tsql);

		  if ( $a === false)
		  die( FormatErrors( sqlsrv_errors() ) );

	   if(sqlsrv_has_rows($a))
	   {  
	?>
	<? if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
	?>
	<table width = "800" align = "center" border = "1">
	<tr>
	<td>
		
		<table width = "500" align = "center" border = "0">
		<form action="doaprdbentry.php" method="post">
		<tr>
				<td colspan = "1" style="padding-left : 10px;" align = "left">Customer ID</td>
				<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustnomid" type="text" value="<? echo $Custnomid;?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
		</tr>

		<tr>
				<td colspan = "1" style="padding-left : 10px;" align = "left">Customer Name</td>
				<td colspan = "2" style="padding-left : 10px;" align = "left"><input name="txtcustfullname" type="text" value="<? echo $row["custfullname"]; ?>" size="35" readonly="readonly" style="background-color:#FF9"/></td>
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
				<td width = "20%" style="padding-left : 10px;"><input type=text name=jmllnd maxlength=3 size=1 value='<? echo $countlnd;?>' style=text-align:center; readonly=readonly;></td>
		</tr>
		<tr>
				<td width = "25%" style="padding-left : 10px;">Building</td>
				<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
				<td width = "20%" style="padding-left : 10px;"><input type=text name=jmlbld maxlength=3 size=1 value='<? echo $countbld;?>' style=text-align:center; readonly=readonly;></td>
		</tr>
		<tr>
				<td width = "25%" style="padding-left : 10px;">Vehicle</td>
				<td width = "35%" style="padding-left : 10px;">Masukkan Jumlah :</td>
				<td width = "20%" style="padding-left : 10px;"><input type=text name=jmlvhc maxlength=3 size=1 value='<? echo $countvhc;?>' style=text-align:center; readonly=readonly;></td>
		</tr>
		<tr>
				<td colspan = "3">&nbsp </td>
		</tr>
		<tr>
				<td colspan = "3" align=center><input type=Submit value=Submit disabled="disabled"><input type=Reset value=Reset disabled="disabled"><input type=hidden name=act value='tab'></td>
		</tr>
		<tr>
				<td colspan = "3">&nbsp </td>
		</tr>
		</form>
		</table>

		<table width = 750 border="0" align="center">
			<form action="doaprdbentry.php" method="post">
			<tr>
				<td>
					<?php $id = isset($_GET['id']) ? $_GET['id'] : 1; ?>
					<div class="TabView" id="TabView">
						<div class="Tabs" style="width: 752px;">
						  <a <?=($id == 1) ? 'class="Current"' : 'href="entry.php?id=1"';?>>Land</a>
						  <a <?=($id == 2) ? 'class="Current"' : 'href="entry.php?id=2"';?>>Building</a>
						  <a <?=($id == 3) ? 'class="Current"' : 'href="entry.php?id=3"';?>>Vehicle</a>
					</div>
					
					<div class="Pages" style="width: 750px; height: 500px; background-color:#FFF;">
						  <div class="Page" style="display: <?=($id == 1) ? 'block' : 'none';?>"><div class="Pad"><? include("entryland.php"); ?></div></div>
						  <div class="Page" style="display: <?=($id == 2) ? 'block' : 'none';?>"><div class="Pad"><? include("entrybuilding.php");?></div></div>
						  <div class="Page" style="display: <?=($id == 3) ? 'block' : 'none';?>"><div class="Pad"><? include("entryvehicle.php");?></div></div>
						</div>
					</div>
					
				</td>
			</tr>
			<tr>
				<td align="center" >&nbsp </td>
			</tr>
			<tr>
				<td align="center" ><input type=Submit value=Submit>
				<input type=hidden name=tab value="insert">
				<input type=hidden name=custnomid value='<? echo $Custnomid; ?>'>
				<input type=hidden name=countlnd value='<? echo $countlnd; ?>'>
      		    <input type=hidden name=countbld value='<? echo $countbld; ?>'>
      		    <input type=hidden name=countvhc value='<? echo $countvhc; ?>'> 
				</td>
			</tr>
			</form>
		</table>
	</td>
	</tr>
	</table>
	<?php
		}	
	}
	?>

<?
} // tutup if dari tab
?>
<script type="text/javascript" src="../../lib/tab-view.js"></script>
<script type="text/javascript">
tabview_initialize('TabView');
</script>
</body>
</html>
<?
   	require("../../lib/close_con.php");
?> 