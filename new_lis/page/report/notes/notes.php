<?php
//include ("class.sqlsrv.php");
include ("../../../lib/class.sqlserver.php");
require ("../../../requirepage/parameter.php");

$sqlsrv = new SQLSRV();
$sqlsrv->connect();

$id = $_REQUEST['custnomid'];

$query = "select wf_id, wf_name, wf_urut
		
		from Tbl_Workflow 
		order by wf_urut";
		
$sqlsrv->executeQuery($query);
$result = $sqlsrv->lastResults;
$j = count($result);

?>
<html>
	<head>
		<script type="text/javascript" src="jquery-1.10.2.js"></script>
		<script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
		<link href="jquery-ui-1.8rc3.custom.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
			body,td,tr,table,input{font-size:14px}
			table{background:darkblue;color:white;border:3px solid yellow;}
			table{border-collapse:collapse;}
			
		</style>
	</head>
	<body>
		<h2 align="center">
		<?
		echo "Notes diambil berdasarkan kode aplikasi $id";
		?>
		</h2>
		<table border="3" align="center">
			<tr style="line-height:30px;">
				<th width="230" align="center">Workflow</th>
				<th width="500" align="center">Notes</th>
			</tr>	
		<?
		$j = count($result);
		for($a=0; $a<$j; $a++)
		{
			
				$strsql="select *, 
						(select txn_notes from Tbl_F".$result[$a]['wf_id']." where txn_id='".$id."') as 'notes'
						from Tbl_Workflow where wf_id='".$result[$a]['wf_id']."'";
					
				$sqlsrv->executeQuery($strsql);
				$r2 = $sqlsrv->lastResults;	
					
			for($x=0;$x<count($r2);$x++)
			{
				$today = getdate();
			
				$alnumcolor="ABCDEF0123456789";
				//$numbercolor="0123456789";
				$randomcolor =substr (str_shuffle($alnumcolor),0,6);
			
			?>
				<tr style="line-height:30px;">
					<td style="padding-left:5px;"><?echo $result[$a]['wf_name']?></td>
					<td align="left" style="padding-left:5px;background:#F2F5A9;color:#000000;" ><?echo $r2[$x]['notes']?></td>
				</tr>
			<?
			}
		}
		?>
		</table>
	</body>
</html>