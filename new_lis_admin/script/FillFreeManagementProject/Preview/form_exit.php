<?php
session_start();
$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form_exit" name="form_exit" action="../../../menu.php" method="post">
<input type="hidden" id="userid" name="userid" value="<? echo $reg_userID;?>" />
<input type="hidden" id="userpwd" name="userpwd" value="<? echo $reg_userPWD;?>" />
</form>
</body>
</html>
<script>
document.form_exit.submit();
</script>