<?php
session_start();
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

$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];



//GET USER ADMIN BRANCH
$tsql = "select * from tbl_se_user where user_id = '$reg_userID'";
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
		$reg_userBranch = $row['user_branch_code'];
	}
}
sqlsrv_free_stmt( $sqlConn );

if($reg_userBranch == "888")
{
	$ConditionBranch = "";
}
else if(substr($reg_userBranch,0,1) == "8")
{
	$ConditionBranch = "where branch_region_code = $reg_userBranch";
}
else
{
	$ConditionBranch = "where branch_code = $reg_userBranch";
}

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
<script language="JavaScript">

  

function goSave()
{
FormName = "form_register_ao";
statusSubmit = true
elem = document.getElementById(FormName).elements;
for (x = 0; x < elem.length; x++)
{
	if(elem[x].style.backgroundColor=="#ff0")
	{
		if(elem[x].value == "")
		{
			alert(elem[x].nai + " field Must be filled");
			statusSubmit = false;
			elem[x].focus();
			break;
		}
	}
}
if (statusSubmit == true)
{
	document.getElementById(FormName).submit();
}
alert("This Form Generator is Demo Version");
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	return true;
}

function outputMoney(theid)
{
	varreplace = replace(eval("document.form_register_ao." + theid + ".value"),',','');
	eval("document.form_register_ao." + theid + ".value =  varreplace")
	number = eval("document.form_register_ao." + theid + ".value");
	newoutput = outputDollars(Math.floor(number-0) + '');
	eval("document.form_register_ao." + theid + ".value =  newoutput") 
}

function outputDollars(number)
{
	if (number.length <= 3)
		return (number == '' ? '0' : number);
	else
	{
		var mod = number.length%3;
		var output = (mod == 0 ? '' : (number.substring(0,mod)));
		for (i=0 ; i < Math.floor(number.length/3) ; i++)
	{
	if ((mod ==0) && (i ==0))
	output+= number.substring(mod+3*i,mod+3*i+3);
	else
	output+= ',' + number.substring(mod+3*i,mod+3*i+3);
}
	return (output);
}
}

function replace(string,text,by)
{
	var strLength = string.length, txtLength = text.length;
	if ((strLength == 0) || (txtLength == 0)) return string;

		var i = string.indexOf(text);
	if ((!i) && (text != string.substring(0,txtLength))) return string;
	if (i == -1) return string;

		var newstr = string.substring(0,i) + by;

	if (i+txtLength < strLength)
		newstr += replace(string.substring(i+txtLength,strLength),text,by);

	return newstr;
}
</script>
</head>
<body style="font-size:12px;font-family:Arial, Helvetica, sans-serif">
<div align="center">
<table align="center" width="800" border="0" style="">
  <tr style="margin-bottom:px;">
    <td><img src="../../../../lismega_DEVEL/images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
<table width="800" border="1">
<form name="form_register_ao" id="form_register_ao" method="post" action="../do_Form/do_register_ao.php">
<table width="800" border="1">
<tr>
<td><div align="center">REGISTER_AO</div></td>
</tr>
<tr>
<td><div align="left"><a href="../preview/register_ao.php">Back</a>&nbsp;</div></td>
</tr>
</table>
<br>
<table width="800" border="0">
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">AO CODE</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_code" id="in_ao_code" nai="ao_code" maxlength="20" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">NAME</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_name" id="in_ao_name" nai="ao_name" maxlength="50" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">BRANCH</div></td>
<td width="40%">
<div align="left">
<select name="in_ao_branch_code" id="in_ao_branch_code" nai="ao_branch_code">
<option selected="selected" value="">-Please Choose One-</option>
<?
$tsql = "SELECT * FROM Tbl_Branch $ConditionBranch";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
if ( $sqlConn === false)
die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
{
?>
<option value="<? echo $row[0]; ?>"><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
<?
}
}
sqlsrv_free_stmt( $sqlConn );
?>
</select>
</div>
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">HP</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_hp_number" id="in_ao_hp_number" nai="ao_hp_number" maxlength="25" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">NIK</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_nik" id="in_ao_nik" nai="ao_nik" maxlength="10" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">FLAG</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_flag" id="in_ao_flag" nai="ao_flag" maxlength="5" value="Y" readonly="readonly" style="background-color:#999999" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">ACTIVE</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_active" id="in_ao_active" nai="ao_active" maxlength="1" value="Y" readonly="readonly" style="background-color:#999999" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">CREATE BY</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_create_userid" id="in_ao_create_userid" nai="ao_create_userid" maxlength="20" value="<? echo $reg_userID; ?>" readonly="readonly" style="background-color:#999999" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">CREATE TIME</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_create_time" id="in_ao_create_time" nai="ao_create_time" value="<? echo date("d-m-Y H:i") ?>" readonly="readonly" style="background-color:#999999" /></div></td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%"><div align="left">TL</div></td>
<td width="40%"><div align="left"><input type="text" name="in_ao_tl" id="in_ao_tl" nai="ao_tl" maxlength="20" /></div></td>
<td width="10%">&nbsp;</td>
</tr>

<tr>
<td width="10%">&nbsp;</td>
<td width="40%">Sektor Industri</td>
<td width="40%">
<input type="text" id="sektor" name="sektor"  value="" />
<input type="hidden" id="bsektor" name="bsektor"  value="" />
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%">Target Nominal</td>
<td width="40%">
<input type="text" id="nominal_target" name="nominal_target"  value="0" onkeydown="return isNumberKey(event)"/>
<input type="hidden" id="bnominal_target" name="bnominal_target"  value=""  />
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%">Target Applikasi</td>
<td width="40%">
<input type="text" id="app_target" name="app_target"  value="0" onkeydown="return isNumberKey(event)"/>
<input type="hidden" id="bapp_target" name="bapp_target"  value="" />
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%">Keterangan</td>
<td width="40%">
<textarea cols="30" rows="5" style="" id="_desc" name="_desc"  ></textarea>
<input type="hidden" id="b_desc" name="b_desc"  value="<? echo $_desc; ?>" />
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%">Start date</td>
<td width="40%">
<input type="text" id="startdate" name="startdate"  readonly="readonly" value="<?echo date("Y-m-d");?>" onFocus="NewCssCal(this.id,'YYYYMMDD');"/>
<input type="hidden" id="bstartdate" name="bstartdate"   readonly="readonly"/>
</td>
<td width="10%">&nbsp;</td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td width="40%">end date</td>
<td width="40%">
<input type="text" id="enddate" name="enddate"   readonly="readonly" value="<?echo date("Y-m-d");?>" onFocus="NewCssCal(this.id,'YYYYMMDD');"/>
<input type="hidden" id="benddate" name="benddate"   />
</td>
<td width="10%">&nbsp;</td>
</tr>


</table>
<table width="800" border="0">
<tr>
<td>
<div align="center">
<input type="button" name="Save" id="Save" value="Save"onclick="goSave()" />
<? echo $naiMsg; ?>
</div>
</td>
</tr>
</table>
</form>
</div>
</body>
</html>
<?
require("../lib/close_con.php");