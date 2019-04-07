<?php

require ("../../lib/class.sqlserver.php");
$sql = new SQLSRV();
$sql->connect();

//$workflow_sql = "select * from tbl_workflow where wf_proc_code = 'WRK' order by wf_urut ASC";
$workflow_sql = "select * from tbl_workflow order by wf_urut ASC";
$sql->executeQuery($workflow_sql);
$workflow_list = $sql->lastResults;

$proc_sql = "select * from tbl_processing";
$sql->executeQuery($proc_sql);
$proc_list = $sql->lastResults;

for ($x=0;$x<count($proc_list);$x++)
{
	$code = $proc_list[$x]['proc_code'];
	
	$flow_sql = "select * from tbl_processing_auto where proc_code = '$code'";
	$sql->executeQuery($flow_sql);
	
	if($sql->lastCounts > 0)
	{
		$flow_auto_list[$code] = $sql->lastResults;
	}
}

echo "<pre>";
//print_r($flow_auto_list);
echo "</pre>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PARAMETER_AUTOPROCESSING</title>
</head>

<script>
function fetchauto()
{
	unCheckAll();
	
	var flow_auto_list = <?=json_encode($flow_auto_list,JSON_FORCE_OBJECT);?>;
	var proc = document.getElementById('processing');

	var arr = [];
	for (var prop in flow_auto_list[proc.value]) {
		arr.push(flow_auto_list[proc.value][prop]);
	}
	console.log(proc.value + " " +arr.length);
	
	for (x=0;x<arr.length;x++)
	{
		console.log(arr[x]['proc_flow_auto']);
		var getcode = arr[x]['proc_flow_auto'];
		document.getElementById(getcode).checked = true;
	}
}

function checkAll() {    
    var inputsFields = document.getElementById('form_processing');
    var inputs = inputsFields.elements;
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'checkbox') {
            inputs[i].checked =true;
        }
    }
}

function unCheckAll(){
    var inputsFields = document.getElementById('form_processing');
    var inputs = inputsFields.elements;
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type == 'checkbox') {
            inputs[i].checked =false;
        }
    }
}


</script>

<body>

<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>
<div align=center>
	<table style="background-color:#;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
		<tr>
			<td width=100% align=left valign=top>
				<a HREF="javascript:changeMenu('../../../menu.php')"><font face=Arial size=2>Back To Main</font></a>
			</td>
		</tr>
		<tr>
			<td width=100% align=center valign=top>
				<font face=Arial size=3><b>MANAGE AUTO PROCESSING</b></font>
			</td>
		</tr>
	</table>
	<form id="form_processing" method="POST" action="process_param_processing.php">
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="25%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="75%">&nbsp;</td>
		</tr>
		<tr valign="top">
			<td align="right">
				<select id="processing" name='processing' onchange="fetchauto();">
					<option value="null">- PICK -</option>
					<?
					for ($x=0;$x<count($proc_list);$x++)
					{
						$code = $proc_list[$x]['proc_code'];
						$name = $proc_list[$x]['proc_name'];
						echo "<option value='$code'>$name</option>";
					}
					?>
				</select>
			</td>
			<td>&nbsp;</td>
			<td>
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
				<?
				for ($x=0;$x<count($workflow_list);$x++)
				{
					$y=$x+1;
					$code = $workflow_list[$x]['wf_id'];
					$name = $workflow_list[$x]['wf_name'];
					echo "<td width='250px'><input type='checkbox' name='flow_auto[]' id='$code' value='$code'><label for='$code'>$name</label></td>";
					
					if($y%4==0)
					{
						echo "</tr>";
						echo "<tr>";
					}
				}
				?>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3" align="center"><input type="submit" value"Submit"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		</table>
		
		</form>
		
</div>

   	      
</body>
</html>