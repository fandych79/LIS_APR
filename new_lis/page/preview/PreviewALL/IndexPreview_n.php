<?	
	require_once ("../../../lib/formatError.php");
	require_once ("../../../lib/open_con.php");
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Expires" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-cache">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PREVIEWALL</title>
<script type="text/javascript" src="../../../js/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="../../../js/full_function.js"></script>
<link href="../../../css/crw.css" rel="stylesheet" type="text/css" />
</head>
<form id="formentry" name="formentry" method="POST" action="doIndex_n.php">
<table width="1000px" align="center" style="border:1px solid black;" class="preview2">
<tr>
	<td colspan="2" style="text-align:center;font-weight:bold;">PREVIEW ALL</td>
</tr>
<tr>
	<td colspan="2" >
		<table width="70%" align="center" style="border:1px solid black;" class="preview2">
		<tr>
			<td style="width:200px">
				Masukkan Nomor Aplikasi : 
			</td>
			<td style="width:200px">
				<input type="text" id="idx" name="idx" style="width:200px;" /> 
			</td>
			<td style="width:200px">
				<input type="submit" style="width:150px;background-color:blue;color:white;" value="Submit" /> 
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</form>
</body>
</html> 