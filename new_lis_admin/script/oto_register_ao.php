<?
session_start();
include ("../lib/formatError.php");
require ("../lib/open_con.php");

if(isset($_REQUEST['msg']))
{
	$naiMsg = "<br>".$_REQUEST['msg']."<br>";
}
else
{
	$naiMsg = "";
}

if(isset($_REQUEST['userid']) && isset($_REQUEST['userpwd']))
{
	$userid = $_REQUEST['userid'];
	$userpwd = $_REQUEST['userpwd'];
	
	$_SESSION['nai_userid'] = $userid;
	$_SESSION['nai_userpwd'] = $userpwd;
	
	//echo $_SESSION['nai_userid']."if";
}
else
{
	//echo $_SESSION['nai_userid']."else";
}

$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Approval Otorisasi AO</title>
<LINK media=screen href="../style/menu.css" rel=stylesheet>
<script src='./javabits.js' language='Javascript'></script>
<script>
function goSubmitOto()
{
	naiConfirm = window.confirm("Anda Yakin akan melakukan approve otorisasi ?");
	if(naiConfirm == true)
	{

		document.formotoao.submit();

	}
	else
	{


	}
	
}
</script>
</head>

<body style="font-size:12px;font-family:Arial, Helvetica, sans-serif" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<div align="center">
<form id="formotoao" name="formotoao" action="do_oto_register_ao.php" method="post">
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>

 
   	   <div align=center>
<table style="background-color:#FFF;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
<tr>
<td width=100% align=left valign=top>
<A HREF="FillFreeManagementProject/Preview/form_exit.php"><font face=Arial size=2>Back To Main</font></A>
</td>
</tr>
<tr>
<td width=100% align=center valign=top>
<font face=Arial size=3><b>OTORISASI REGISTER AO</b></font>
</td>
</tr>
</table>
  <table width="800" border="1" cellspacing="1" cellpadding="1">
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">Time</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
<?


$tsql = "select * from oto_ao where system_flag = 'R' order by system_date ASC";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);

$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

if ( $sqlConn === false)
die( FormatErrors( sqlsrv_errors() ) );

if(sqlsrv_has_rows($sqlConn))
{
	$rowCount = sqlsrv_num_rows($sqlConn);
	$counter=0;
	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
	{
		$detail = "";
		
		$system_userid = $row['system_userid'];
		$system_date = $row['system_date'];
		$system_desc = $row['system_desc'];
		$system_action = $row['system_action'];
		
		$ao_code = $row['ao_code'];
		$ao_branch = $row['ao_branch_code'];
		
		if($system_action=="INPUT")
		{
			$detail = $detail.$system_action." Requested :"."<br><br>";
			$detail = $detail."AO Code : ".$row['ao_code']."<br>";
			$detail = $detail."AO Name : ".$row['ao_name']."<br>";
			$detail = $detail."AO Branch : ".$row['ao_branch_code']."<br>";
			$detail = $detail."AO HP : ".$row['ao_hp_number']."<br>";
			$detail = $detail."AO NIK : ".$row['ao_nik']."<br>";
			$detail = $detail."Create by : ".$row['ao_create_userid']."<br>";
			$detail = $detail."Team Leader : ".$row['ao_tl']."<br>";
		}
		else if ($system_action=="EDIT")
		{				
			$detail = $detail.$system_action." Requested :"."<br><br>".$system_desc."<br><a href=oto_detail_ao.php?aocode=$ao_code&aobranch=$ao_branch target=_new>Detail</a>";
		}
		else if ($system_action=="DELETE")
		{				
			$detail = $detail.$system_action." Requested :"."<br><br>".$system_desc."<br><a href=oto_detail_ao.php?aocode=$ao_code&aobranch=$ao_branch target=_new>Detail</a>";
		}
		
		?>
		<tr>
		<td align="center"><? echo $system_userid;?>&nbsp;</td>
		<td align="center"><? echo $system_date -> format("d-M-Y H:i");?>&nbsp;</td>
		<td align="left"><? echo $detail;?>&nbsp;</td>
		<td align="center"><input name="approved_<? echo $counter;?>" type="checkbox" value="<? echo $system_action."|".$row['ao_code']."|".$row['ao_branch_code']."|".$row['ao_nik'];?>" checked />&nbsp;</td>
		</tr>
		<?
		$counter++;
	}
}
sqlsrv_free_stmt( $sqlConn );  
?>  
  </table>
  <br>
  <br>
  <input type="hidden" id="action_counter" name="action_counter" value="<? echo $counter;?>" />
  <input type="button" id="btn_action" name="btn_action" onclick="goSubmitOto()" value="Action all Checklist" />
  <? echo $naiMsg;?>
</div>
</form>
</body>
</html>