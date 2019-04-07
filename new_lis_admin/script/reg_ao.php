<?php
$userid = $_REQUEST['userid'];
$userpwd = $_REQUEST['userpwd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BYPASS_REG_AO</title>
</head>

<body>
<form id="form_bypass_reg_ao" name="form_bypass_reg_ao" method="post" action="./FillFreeManagementProject/Preview/register_ao.php">
<input type="hidden" id="in_userid" name="in_userid" value="<? echo $userid; ?>" />
<input type="hidden" id="in_userpwd" name="in_userpwd" value="<? echo $userpwd; ?>" />
</form>
</body>
</html>
<script>
document.form_bypass_reg_ao.submit();
</script>
<?
//header("location:./FillFreeManagementProject/Preview/register_ao.php");
?>