<?php
session_start();

if(isset($_POST['userid']))
{
	$userid=$_POST['userid'];
	$userpwd=$_POST['userpwd'];
	
	$_SESSION['nai_userid'] = $userid;
	$_SESSION['nai_userpwd'] = $userpwd;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Assignment</title>
<script type="text/javascript" src="../../lismega_web_version_UAT/lib/jquery-1.6.4.min.js"></script>

<script>
function searchAssign(inField, e)
{
	var charCode;
    
    if(e && e.which)
	{
        charCode = e.which;
    }
	else if(window.event)
	{
        e = window.event;
        charCode = e.keyCode;
    }

    if(charCode == 13) 
	{        
		var in_search=$("#"+inField.id).val();

		//alert("Enter was pressed on " + inField.id + " = " + in_search );
		
		//alert(in_search);
		
		$("#formassignment").submit();
	}
}
</script>
</head>

<body>
<div id="main" align="center">
<div id="header">
<table align="center" width="960" border="0" style="">
<tr style="margin-bottom:px;">
<td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
</tr>
</table>
</div>
<div id="workarea">
<form id="formassignment" name="formassignment" action="do_manage_assignment.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th width="10%" scope="col">&nbsp;</th>
    <th width="10%" scope="col">&nbsp;</th>
    <th width="50%" scope="col">MANAGE ASSIGNMENT</th>
    <th width="10%" scope="col">&nbsp;</th>
    <th width="10%" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>Search :</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><input type="text" id="in_search" name="in_search" style="width:100%;height:25px" value="" onkeypress="searchAssign(this, event)" /></td>
    <td align="left"><img src="../images/searchButton.png" height="32" width="32"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="10%" scope="col">&nbsp;</th>
        <th width="15%" scope="col">&nbsp;</th>
        <th width="25%" scope="col">&nbsp;</th>
        <th width="15%" scope="col">&nbsp;</th>
        <th width="10%" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><a href="manage_assignment_authorized.php">Authorized Re-Assignment</a></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><a href="manage_assignment_history_log.php">History Re-Assignment Log</a></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>