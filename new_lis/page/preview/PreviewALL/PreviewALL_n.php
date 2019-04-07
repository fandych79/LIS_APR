<?	
	require ("../../../lib/formatError.php");
	require ("../../../lib/open_con.php");

	$userid=$_GET['userid'];
	$userpwd=$_GET['userpwd'];
	$userbranch=$_GET['userbranch'];
	$userregion=$_GET['userregion'];
	$userwfid=$_GET['userwfid'];
	$userpermission=$_GET['userpermission'];
	$buttonaction=$_GET['buttonaction'];
	$Custnomid=$_GET['custnomid'];
	$custnomid = $Custnomid;
	
	
	
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
<body>
<form id="formentry" name="formentry" method="post">
<table width="1000px" align="center" style="border:1px solid black;" class="preview2">
<tr>
	<td colspan="2" style="text-align:center;font-weight:bold;">PREVIEW ALL</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<tr>
	<td colspan="2">
		<table width="1000px" align="center" style="" class="preview2">
		<tr>
			<td align="center" id="yukirin">
				<input type="button" value="MEFL" style="width:120px;background-color:blue;color:white;" onclick="nannan('MEFL')" title="MEMO FLOW"/>
				<input type="button" value="DOCM" style="width:120px;background-color:blue;color:white;" onclick="nannan('DOCM')" title="DOCUMENT MANAGEMENT"/>
				<input type="button" value="DATA ENTRY" style="width:120px;background-color:blue;color:white;" onclick="nannan('DATA')" title="DATA ENTRY"/>
				<input type="button" value="CEK FISIK" style="width:120px;background-color:blue;color:white;" onclick="nannan('VISIT')" title="CEK FISIK"/>
				</br>
				<input type="button" value="CEKLIST" style="width:120px;background-color:blue;color:white;" onclick="nannan('LIST')" title="CEKLIST"/>
				<input type="button" value="DOCUMENT" style="width:120px;background-color:blue;color:white;" onclick="nannan('DOC')" title="DOCUMENT"/>
				<input type="button" value="DATA PEMBANDING" style="width:120px;background-color:blue;color:white;" onclick="nannan('COMPR')" title="DATA PEMBANDING"/>
				<input type="button" value="NILAI APPRAISAL" style="width:120px;background-color:blue;color:white;" onclick="nannan('NILAI')" title="NILAI APPRAISAL"/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td id="sugananako" width="100%" class="preview2" cellpadding="0px" cellspacing="0px">
				&nbsp;
			</td>
		</tr>
		</table>
	
	
	</td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
<input type="hidden" id="userid" name="userid"  value='<? echo $userid; ?>'>
<input type="hidden" id="userpwd" name="userpwd" value='<? echo $userpwd; ?>'>
<input type="hidden" id="userbranch" name="userbranch" value='<? echo $userbranch; ?>'>
<input type="hidden" id="userregion" name="userregion" value='<? echo $userregion; ?>'>
<input type="hidden" id="buttonaction" name="buttonaction" value='<? echo $buttonaction; ?>'>
<input type="hidden" id="userwfid" name="userwfid" value='<? echo $userwfid; ?>'>
<input type="hidden" id="custnomid" name="custnomid" value='<? echo $Custnomid; ?>'>
<input type="hidden" id="custfullname" name="custfullname" value='<? echo $custfullname; ?>'>
</table>
</form>

<script type="text/javascript">
	function nannan(id) {
		var nan="SWAP";
		var id = id;
		
		//alert (id);
		var custnomid=$("#custnomid").val();
		var userid=$("#userid").val();
		var userpwd=$("#userpwd").val();
		var userbranch=$("#userbranch").val();
		var userregion=$("#userregion").val();
		var buttonaction=$("#buttonaction").val();
		var userwfid=$("#userwfid").val();
		
		$.ajax({
			type: "POST",
			url: "VIEW_ajax_n.php",
			data: "nan="+nan+"&id="+id+"&custnomid="+custnomid+"&userid="+userid+"&userpwd="+userpwd+"&userbranch="+userbranch+"&userregion="+userregion+"&buttonaction="+buttonaction+"&userwfid="+userwfid+"&random="+ <?php echo time(); ?> +"",
			success: function(response)
			{	//alert(response);
				$("#sugananako").html(response);
			}
		});
	}
</script>
</body>
</html> 