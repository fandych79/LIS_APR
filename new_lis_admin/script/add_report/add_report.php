<?php
require_once("../../lib/class.sqlserver.php");
$db = new SQLSRV();
$db->connect();

$sqlreport = "select * from Tbl_SE_Program where program_group = 'RPT' order by program_urut asc";
$db->executeQuery($sqlreport);
$reportList = $db->lastResults;

//print_r($reportList);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<table align="center" width="960" border="0" style="">
<tr style="margin-bottom:px;">
<td align="center"><img src="../../images/Header Mega (L).png" width=100%></td>
</tr>
</table>

<div style="margin-left:25%;margin-right:25%;">
<hr/>
<div style="margin-top:10px;">
<form id="formReport" method="post" enctype="application/x-www-form-urlencoded" action="add_report_process.php">
<table border="0" style="width:100%" cellspacing="0" cellpadding="0">
	<tr>
		<td rowspan="13" style="width:300px">
		<select id="report" name="report" size="15" style="width:300px;" onChange="viewDetail();">
		<?php
		for ($x=0;$x<count($reportList);$x++) {
			$value = $reportList[$x]['program_code'];
			$show = $reportList[$x]['program_name'];
			$seq = $reportList[$x]['program_urut'];
			$ver = $reportList[$x]['program_version'];
			$target = $reportList[$x]['program_desc'];
		?>
		<option value="<?=$value;?>"><?=$show;?></option>
		<?php
		}
		?>
		</select>
		</td>
	</tr>	
	<tr>
		<td style="width:5px">&nbsp;</td>
		<td style="width:5px">&nbsp;</td>
		<td style="width:100px">&nbsp;</td>
		<td style="width:1px">&nbsp;</td>
		<td style="width:250px">&nbsp;</td>
	</tr>
		
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="button" value="New Report" onClick="getNew();" style="width:100%"></td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Report Code</td>
		<td>&nbsp;</td>
		<td><input type="text" id="code" name="code" value="" style="width:100%"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Report Name</td>
		<td>&nbsp;</td>
		<td><input type="text" id="nama" name="nama" value="" style="width:100%"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Sequence</td>
		<td>&nbsp;</td>
		<td><input type="text" id="seq" name="seq" value="" style="width:100%"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Version</td>
		<td>&nbsp;</td>
		<td><input type="text" id="ver" name="ver" value="" style="width:100%"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>Targey</td>
		<td>&nbsp;</td>
		<td><input type="text" id="target" name="target" value="" style="width:85%">.php</td>
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
		<td><input type="hidden" id="stat" name="stat" value="new"></td>
		<td>&nbsp;</td>
		<td><input type="button" value="Save" style="width:100%" onClick="goSave();"></td>
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

</body>

<script>

var jsontext = '<?=json_encode($reportList);?>';
var resultList = JSON.parse(jsontext);
var e = document.getElementById("report");

function viewDetail() {
	//alert(e.selectedIndex);
	//alert(resultList[e.selectedIndex]['program_code']);
	
	document.getElementById("code").readOnly = true;
	
	document.getElementById("stat").value = "edit";
	document.getElementById("code").value = resultList[e.selectedIndex]['program_code'];
	document.getElementById("nama").value = resultList[e.selectedIndex]['program_name'];
	document.getElementById("ver").value = resultList[e.selectedIndex]['program_version'];
	document.getElementById("seq").value = resultList[e.selectedIndex]['program_urut'];
	document.getElementById("target").value = resultList[e.selectedIndex]['program_desc'];
}

function getNew() {
	
	document.getElementById("code").readOnly = false;
	
	document.getElementById("stat").value = "new";
	document.getElementById("code").value = "";
	document.getElementById("nama").value = "";
	document.getElementById("ver").value = "";
	document.getElementById("seq").value = "";
	document.getElementById("target").value = "";
	
}

function goSave() {
	
	if (document.getElementById("code").value == "") {
		alert("Please fill form completely.");
		return false;
	}
	if (document.getElementById("nama").value == "") {
		alert("Please fill form completely.");
		return false;
	}
	if (document.getElementById("ver").value == "") {
		alert("Please fill form completely.");
		return false;
	}
	if (document.getElementById("seq").value == "") {
		alert("Please fill form completely.");
		return false;
	}
	
	if (document.getElementById("target").value == "") {
		alert("Please fill form completely.");
		return false;
	}
	
	
	document.getElementById("formReport").submit();
	return true;
}

</script>
</html>