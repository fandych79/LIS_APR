<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?$txtid=$_GET['Texcustnomid'];?>
<body>
<form action="pk.php" method="get">
<table style="background-color:#;"width="250"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
  <tr>
    <td>Customer ID</td>
    <td><input type="text" name="text" value="<?echo $txtid;?>"></input></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input name="submit" type="submit" value="submit" /></td>

  </tr>
</table>
</form>
</body>
</html>