<?php
if(isset($_REQUEST['err']))
{
	$err = $_REQUEST['err'];
	$errMsg = "ERROR CODE [".$err."]";
}
else
{
	$errMsg = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Restricted</title>
</head>

<body>
<center>You Can't Access this page.</center>
<br>
<center><?=$errMsg;?></center>
</body>
</html>