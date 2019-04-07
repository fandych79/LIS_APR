
<?
 
require ("../lib/open_con.php");
$txtid=$_GET['Texcustnomid'];

?>

<html>
<head>
<script language="Javascript">
	function cek()
	{
		if(document.fo.text.value=="")
		{
			alert ("Nom ID Harus Di isi");
			return false;
		}
		document.fo.submit();
	}
</script>
</head>
<body>
<form action="do_ps2pdf.php" method="get" name="fo">
<table align="center" width="300" border="1">

  <tr>
    <td width="240">Input ID</td>
    <td width="144"><input name="text" type="text" value=<? echo $txtid;?>></td>
  </tr>
  <tr>
    <td align="right" colspan="2"><input type="button"  value="Submit" onclick=cek()></td>
  </tr>
</table>
</form>
</body>
</html>