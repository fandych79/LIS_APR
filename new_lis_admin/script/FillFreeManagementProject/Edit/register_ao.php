<?php
include ("../lib/formatError.php");
require ("../lib/open_con.php");

if(isset($_REQUEST['naiMsg']))
{
	$naiMsg = "<br>".$_REQUEST['naiMsg']."<br>";
}
else
{
	$naiMsg = "";
}

$var_ff=$_REQUEST['FF'];
$var_fn=$_REQUEST['FN'];
$var_table=$_REQUEST['TABLE'];

$sfn = $_REQUEST['SFN'];
$sf = $_REQUEST['SF'];

//echo $var_ff."<br>";
//echo $var_fn."<br>";
//echo $var_table."<br>";
$var_sql = "select * from $var_table where $var_fn='$var_ff' and $sfn = '$sf'";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>register_ao</title>
<script type="text/javascript" src='../../../js/jquery-1.7.2.min.js' ></script>
<script type="text/javascript" src="../../../js/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../../js/datetimepicker_css.js"></script>
<script type="text/javascript" src="../../../js/full_function.js"></script>
<script language="javascript">
function editPage()
{
document.formview.in_ao_code.readOnly = false
document.formview.in_ao_code.style.backgroundColor = "#FFF";
document.formview.in_ao_name.readOnly = false
document.formview.in_ao_name.style.backgroundColor = "#FFF";
document.formview.in_ao_branch_code.readOnly = false
document.formview.in_ao_branch_code.style.backgroundColor = "#FFF";
document.formview.in_ao_hp_number.readOnly = false
document.formview.in_ao_hp_number.style.backgroundColor = "#FFF";
document.formview.in_ao_nik.readOnly = false
document.formview.in_ao_nik.style.backgroundColor = "#FFF";
//document.formview.in_ao_flag.readOnly = false
//document.formview.in_ao_flag.style.backgroundColor = "#FFF";
document.formview.in_ao_flag.value = "Y"
//document.formview.in_ao_active.readOnly = false
//document.formview.in_ao_active.style.backgroundColor = "#FFF";
document.formview.in_ao_active.value = "Y"
//document.formview.in_ao_create_userid.readOnly = false
//document.formview.in_ao_create_userid.style.backgroundColor = "#FFF";
document.formview.in_ao_create_userid.value = "ADMIN"
//document.formview.in_ao_create_time.readOnly = false
//document.formview.in_ao_create_time.style.backgroundColor = "#FFF";
document.formview.in_ao_tl.readOnly = false
document.formview.in_ao_tl.style.backgroundColor = "#FFF";
document.formview.sektor.readOnly = false
document.formview.sektor.style.backgroundColor = "#FFF";
document.formview.nominal_target.readOnly = false
document.formview.nominal_target.style.backgroundColor = "#FFF";
document.formview.app_target.readOnly = false
document.formview.app_target.style.backgroundColor = "#FFF";
document.formview._desc.readOnly = false
document.formview._desc.style.backgroundColor = "#FFF";
document.formview.startdate.disabled = false
document.formview.startdate.style.backgroundColor = "#FFF";
document.formview.enddate.disabled = false
document.formview.enddate.style.backgroundColor = "#FFF";

document.formview.edit_button.disabled = true;
document.formview.save_button.disabled = false;
}

function savePage()
{

	cekHistory("AO Code : ",document.formview.backup_ao_code.value,document.formview.in_ao_code.value);
	cekHistory("AO Name : ",document.formview.backup_ao_name.value,document.formview.in_ao_name.value);
	cekHistory("AO Branch : ",document.formview.backup_ao_branch_code.value,document.formview.in_ao_branch_code.value);
	cekHistory("AO HP : ",document.formview.backup_ao_hp_number.value,document.formview.in_ao_hp_number.value);
	cekHistory("AO NIK : ",document.formview.backup_ao_nik.value,document.formview.in_ao_nik.value);
	cekHistory("AO TL : ",document.formview.backup_ao_tl.value,document.formview.in_ao_tl.value);
	
	cekHistory("Sektor Industri : ",document.formview.bsektor.value,document.formview.sektor.value);
	cekHistory("Target Nominal : ",document.formview.bnominal_target.value,document.formview.nominal_target.value);
	cekHistory("Target Applikasi : ",document.formview.bapp_target.value,document.formview.app_target.value);
	cekHistory("Keterangan : ",document.formview.b_desc.value,document.formview._desc.value);
	cekHistory("Tanggal Mulai : ",document.formview.bstartdate.value,document.formview.startdate.value);
	cekHistory("Tanggal Berakhir : ",document.formview.benddate.value,document.formview.enddate.value);
	
	
	

	naiMsg = "Are you sure want to edit this data ?\n\n";
	
	arrdata = document.formview.actionhistory.value.split('<br>');
	
	for (i=0;i<arrdata.length-1;i++)
	{
		naiMsg = naiMsg + arrdata[i] + "\n";
	}

	
	naiconfirm = window.confirm(naiMsg);
	if(naiconfirm == true)
	{	
		document.formview.action = "../do_edit/do_register_ao.php";
		document.formview.submit();
	}
	else
	{
	}
}

function deletePage()
{
	naimsg = window.confirm("Are you sure want to delete this ?");
	if(naimsg == true)
	{
		document.formview.action = "../do_delete/do_register_ao.php";
		document.formview.submit();
	}
	else
	{
	}

}

function loadPage()
{
document.formview.edit_button.disabled = false;
document.formview.save_button.disabled = true;
document.formview.in_ao_code.readOnly = true
document.formview.in_ao_code.style.backgroundColor = "#CCC";
document.formview.in_ao_name.readOnly = true
document.formview.in_ao_name.style.backgroundColor = "#CCC";
document.formview.in_ao_branch_code.readOnly = true
document.formview.in_ao_branch_code.style.backgroundColor = "#CCC";
document.formview.in_ao_hp_number.readOnly = true
document.formview.in_ao_hp_number.style.backgroundColor = "#CCC";
document.formview.in_ao_nik.readOnly = true
document.formview.in_ao_nik.style.backgroundColor = "#CCC";
document.formview.in_ao_flag.readOnly = true
document.formview.in_ao_flag.style.backgroundColor = "#CCC";
document.formview.in_ao_active.readOnly = true
document.formview.in_ao_active.style.backgroundColor = "#CCC";
document.formview.in_ao_create_userid.readOnly = true
document.formview.in_ao_create_userid.style.backgroundColor = "#CCC";
document.formview.in_ao_create_time.readOnly = true
document.formview.in_ao_create_time.style.backgroundColor = "#CCC";
document.formview.in_ao_tl.readOnly = true
document.formview.in_ao_tl.style.backgroundColor = "#CCC";

document.formview.sektor.readOnly = true
document.formview.sektor.style.backgroundColor = "#CCC";
document.formview.nominal_target.readOnly = true
document.formview.nominal_target.style.backgroundColor = "#CCC";
document.formview.app_target.readOnly = true
document.formview.app_target.style.backgroundColor = "#CCC";
document.formview._desc.readOnly = true
document.formview._desc.style.backgroundColor = "#CCC";
document.formview.startdate.disabled = true
document.formview.startdate.style.backgroundColor = "#CCC";
document.formview.enddate.disabled = true
document.formview.enddate.style.backgroundColor = "#CCC";
}

function cekHistory(thefield,thebackup,thenew)
{
	if (thebackup != thenew)
	{
		document.formview.actionhistory.value = document.formview.actionhistory.value + thefield + thebackup + " >> " + thenew + "<br>";
	}
}
</script>
</head>
<body style="font-size:12px;font-family:Arial, Helvetica, sans-serif" link="#0000FF" onload="loadPage()">
<form name="formview" action="" method="post" />
<div align="center">
<table align="center" width="800" border="0" style="">
  <tr style="margin-bottom:px;">
    <td><img src="../../../../lismega_DEVEL/images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
<table width="800" border="1">
<tr>
<td><div align="center">REGISTER_AO</div></td>
</tr>
<tr>
<td><div align="left"><a href="../preview/register_ao.php">Back</a>&nbsp;</div></td>
</tr>
</table>
</div>
<br>
<div align="center">
<table width="800" border="1" cellpadding="0" cellspacing="0">
<?
$tsql = $var_sql;
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);

$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if ( $sqlConn === false)
die( FormatErrors( sqlsrv_errors() ) );

if(sqlsrv_has_rows($sqlConn))
{
$rowCount = sqlsrv_num_rows($sqlConn);
while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
{
if(isset($row['ao_code']))
{
?>
<tr>
<td width="50%">AO CODE</td>
<td width="50%">
<input type="text" id="in_ao_code" name="in_ao_code" size="80" value="<? echo $row['ao_code']; ?>" />
<input type="hidden" id="backup_ao_code" name="backup_ao_code" size="80" value="<? echo $row['ao_code']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_name']))
{
?>
<tr>
<td width="50%">NAME</td>
<td width="50%">
<input type="text" id="in_ao_name" name="in_ao_name" size="80" value="<? echo $row['ao_name']; ?>" />
<input type="hidden" id="backup_ao_name" name="backup_ao_name" size="80" value="<? echo $row['ao_name']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_branch_code']))
{
?>
<tr>
<td width="50%">BRANCH</td>
<td width="50%">
<input type="text" id="in_ao_branch_code" name="in_ao_branch_code" size="80" value="<? echo $row['ao_branch_code']; ?>" />
<input type="hidden" id="backup_ao_branch_code" name="backup_ao_branch_code" size="80" value="<? echo $row['ao_branch_code']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_hp_number']))
{
?>
<tr>
<td width="50%">HP&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_hp_number" name="in_ao_hp_number" size="80" value="<? echo $row['ao_hp_number']; ?>" />
<input type="hidden" id="backup_ao_hp_number" name="backup_ao_hp_number" size="80" value="<? echo $row['ao_hp_number']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_nik']))
{
?>
<tr>
<td width="50%">NIK&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_nik" name="in_ao_nik" size="80" value="<? echo $row['ao_nik']; ?>" />
<input type="hidden" id="backup_ao_nik" name="backup_ao_nik" size="80" value="<? echo $row['ao_nik']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_flag']))
{
?>
<tr>
<td width="50%">FLAG&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_flag" name="in_ao_flag" size="80" value="<? echo $row['ao_flag']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_active']))
{
?>
<tr>
<td width="50%">ACTIVE&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_active" name="in_ao_active" size="80" value="<? echo $row['ao_active']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_create_userid']))
{
?>
<tr>
<td width="50%">CREATE BY&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_create_userid" name="in_ao_create_userid" size="80" value="<? echo $row['ao_create_userid']; ?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_create_time']))
{
?>
<tr>
<td width="50%">CREATE TIME&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_create_time" name="in_ao_create_time" size="80" value="<? echo $row['ao_create_time']->format('d-m-Y H:i');?>" />
</td>
</tr>
<?
}
else
{
}
if(isset($row['ao_tl']))
{
?>
<tr>
<td width="50%">TL&nbsp;</td>
<td width="50%">
<input type="text" id="in_ao_tl" name="in_ao_tl" size="80" value="<? echo $row['ao_tl']; ?>" />
<input type="hidden" id="backup_ao_tl" name="backup_ao_tl" size="80" value="<? echo $row['ao_tl']; ?>" />
</td>
</tr>
<?
}
else
{
}
break;
}
}
sqlsrv_free_stmt( $sqlConn );

$sektor="";
$nominal_target="0";
$_desc="";
$startdate="";
$enddate="";
$app_target="0";
$tsql = "select * from tbl_ao_target where ao_code='".$var_ff."' and ao_branch='".$sf."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		$sektor=$row['sektor'];
		$nominal_target=$row['nominal_target'];
		$app_target=$row['app_target'];
		$_desc=$row['_desc'];
		$startdate=$row['startdate']->format('Y-m-d');
		$enddate=$row['enddate']->format('Y-m-d');
	}
}

?>
<tr>
<td width="50%">Sektor Industri</td>
<td width="50%">
<input type="text" id="sektor" name="sektor" size="80" value="<? echo $sektor; ?>" />
<input type="hidden" id="bsektor" name="bsektor" size="80" value="<? echo $sektor; ?>" />
</td>
</tr>
<tr>
<td width="50%">Target Nominal</td>
<td width="50%">
<input type="text" id="nominal_target" name="nominal_target" size="80" value="<? echo $nominal_target; ?>" onkeydown="return isNumberKey(event)" />
<input type="hidden" id="bnominal_target" name="bnominal_target" size="80" value="<? echo $nominal_target; ?>"  onkeydown="return isNumberKey(event)"/>
</td>
</tr>
<tr>
<td width="50%">Target Applikasi</td>
<td width="50%">
<input type="text" id="app_target" name="app_target" size="80" value="<? echo $app_target; ?>"  onkeydown="return isNumberKey(event)"/>
<input type="hidden" id="bapp_target" name="bapp_target" size="80" value="<? echo $app_target; ?>"  onkeydown="return isNumberKey(event)"/>
</td>
</tr>
<tr>
<td width="50%">Keterangan</td>
<td width="50%">
<textarea cols="30" rows="5" style="width:98.5%" id="_desc" name="_desc"  ><? echo $_desc; ?></textarea>
<input type="hidden" id="b_desc" name="b_desc"  value="<? echo $_desc; ?>" />
</td>
</tr>
<tr>
<td width="50%">Start date</td>
<td width="50%">
<input type="text" id="startdate" name="startdate" size="80" value="<? echo $startdate; ?>"  onFocus="NewCssCal(this.id,'YYYYMMDD');"/>
<input type="hidden" id="bstartdate" name="bstartdate" size="80" value="<? echo $startdate; ?>" />
</td>
</tr>
<tr>
<td width="50%">end date</td>
<td width="50%">
<input type="text" id="enddate" name="enddate" size="80" value="<? echo $enddate; ?>"  onFocus="NewCssCal(this.id,'YYYYMMDD');"/>
<input type="hidden" id="benddate" name="benddate" size="80" value="<? echo $enddate; ?>" />
</td>
</tr>

</table>
<table width="800" border="0">
<tr>
<td><div align="center"><? echo $naiMsg;?>&nbsp;</div></td>
</tr>
<tr>
<td>
<center>
<input type="hidden" id="actionhistory" name="actionhistory" value="">
<input type="hidden" id="var_ff" name="var_ff" value="<? echo $var_ff; ?>">
<input type="hidden" id="var_fn" name="var_fn" value="<? echo $var_fn; ?>">
<input type="hidden" id="var_sf" name="var_sf" value="<? echo $sf; ?>">
<input type="hidden" id="var_sfn" name="var_sfn" value="<? echo $sfn; ?>">
<input type="hidden" id="var_table" name="var_table" value="<? echo $var_table; ?>">
<input type="button" id="edit_button" name="edit_button" value="Edit" onclick="editPage()">
<input type="button" id="save_button" name="save_button" value="Save" onclick="savePage()">
<input type="button" id="delete_button" name="delete_button" value="Delete" onclick="deletePage()">
</center>
&nbsp;
</td>
</tr>
</table>
</form>
</div>
</body>
</html>
<?
require("../lib/close_con.php");
?>
