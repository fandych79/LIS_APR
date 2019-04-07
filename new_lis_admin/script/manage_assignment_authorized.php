<?php
require ("../lib/formaterror.php");
require ("../lib/open_con.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authorized Assignment</title>

<script type="text/javascript" src="../../lismega_web_version_UAT/lib/jquery-1.6.4.min.js"></script>

<script>
function getCheckbox()
{
 	var naiConfirm = window.confirm("Anda yakin Authorized checklist tersebut ?");
	
	if(naiConfirm == true)
	{
		
		var saveValue = "";
		
		$(":checkbox").each(function() {
			if (this.checked) {
			//alert(this.value);
			saveValue = saveValue + this.value + "|";
			}
		});
		
		//alert(saveValue);
		
		$("#hid_saveValue").val(saveValue);
	
		$("#formsubmit").submit();	
	}
}
</script>

</head>

<body>
<div id="main" align="center">
<div id="header" align="center">
<table align="center" width="960" border="0" style="">
<tr style="margin-bottom:px;">
<td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
</tr>
</table>
</div>

<div id="workarea" align="center">
<form id="formsubmit" name="formsubmit" method="post" action="do_manage_assignment_authorized.php">
<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col" colspan="5">AUTHORIZED ASSIGNMENT</th>
  </tr>
  <tr>
    <td width="15%"><a href="manage_assignment.php">Back</a></td>
    <td width="15%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<table width="960" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col">ASSIGNMENT TYPE</th>
    <th scope="col">APPLICATION LINKED</th>
    <th scope="col">ORIGINAL USER</th>
    <th scope="col">REPLACE USER</th>
    <!--<th scope="col">DETAIL</th>!-->
    <th scope="col">ACTION</th>
  </tr>
  
  <?
  
	// SELECT ASSOC
	
	$tsql = "select * from tbl_assignment_history_log where assignment_status = 'A' and flag = '0'";
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
			?>
            <tr>
            <td align="center"><? echo $row['assignment_type'];?></td>
            <td align="center"><? echo $row['assignment_apps'];?></td>
            <td align="center"><? echo $row['assignment_from'];?></td>
            <td align="center"><? echo $row['assignment_replace'];?></td>
            <!--<td align="center">DETAIL</td>!-->
            <td align="center">
            <input id="ch_<? echo $row['assignment_ID'];?>" name="checkbox_authorized" type="checkbox" checked="checked" value="<? echo $row['assignment_ID'];?>" />
            </td>
            </tr>
            <?
		}
	}
	else
	{
		?>
        <tr>
        <td colspan="6" align="center">NO DATA FOUND</td>
        </tr>
        <?
	}
	sqlsrv_free_stmt( $sqlConn );
  
  ?>


</table>
<br><br><br>
<center>
<input type="hidden" id="hid_saveValue" name="hid_saveValue" value="">
<input type="button" id="submitButton" name="submitButton" onclick="getCheckbox()" value="Submit">
</center>
</form>

</div>

</div>
</body>
</html>