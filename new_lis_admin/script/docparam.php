<?
require ("../lib/open_con.php");
require ("../lib/formatError.php");

$utilformname=$_REQUEST['utilformname'];
$utilformfield=$_REQUEST['utilformfield'];
//$newcluster=$_POST['newcluster'];


//echo $utilformname."<br/>";
//echo $utilformfield."<br/>";

$newwfid="";
$newwfname="";
$idregion="";
$nameregion="";
if(isset($_REQUEST['newwfid']))
{
$newwfid=$_REQUEST['newwfid'];
}
if(isset($_REQUEST['newwfname']))
{
$newwfname=$_REQUEST['newwfname'];
}

//echo $newwfid;



$tmpwhere='';
$tmp="";
$strsql="select * from tbl_docparamworkflow where wf_id='".$newwfid."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_REQUEST['query']);
$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlcon))
{
	while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		$tmp.=$rows['doc_id']."','";
	}
}
$tmpwhere="where doc_id not in('".substr($tmp,0,-3)."')";
//echo '(\''.$newbranchname.'\')';

//echo $tmpwhere;


if(!isset($_GET['a']))
{
$request_A=1;
}
else
{
$request_A=$_GET['a'];
}
//echo $request_A;

$selected1="";
if($request_A=='1')
{
$selected1="selected";
}

$selected2="";
if($request_A=='2')
{
$selected2="selected";
}

$selected3="";
if($request_A=='3')
{
$selected3="selected";
}



?>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery-1.7.2.min.js" ></script>
		<style type="text/css">
			.unselected { border:1px solid indigo; background:blue; color:#ffffff;}
			.unselected.selected {border:1px solid red; background:orange; color:#ffffff; font-weight:bold;}
		</style>
		<script type="text/javascript">
			function add()
			{
			
				document.getElementById('btnname').value = "add";
				document.getElementById('formsubmit').action = "./do_paramwk.php";
				document.getElementById('formsubmit').submit();
			}
			function del(flow)
			{
				//alert(flow);
				document.getElementById('btnname').value = "del";
				document.getElementById('flowde').value = flow;
				document.getElementById('formsubmit').action = "./do_paramwk.php";
				document.getElementById('formsubmit').submit();
			}
			function edit(flow)
			{
				//alert(flow);
				document.getElementById('btnname').value = "edit";
				document.getElementById('flowde').value = flow;
				document.getElementById('formsubmit').action = "./do_paramwk.php";
				document.getElementById('formsubmit').submit();
			}
			function submitdata()
			{
				
			   opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=document.getElementById('tomaster').value;
			   self.close();
			}
			
			function checkdocument(thisid)
			{
				var unitfield= document.getElementById('utilformfield').value;
				var unitname= document.getElementById('utilformname').value;
				var newwfid= document.getElementById('newwfid').value;
				var newwfname= document.getElementById('newwfname').value;
				window.location.href = "docparam.php?a="+thisid+"&utilformname="+unitname+"&utilformfield="+unitfield+"&newwfid="+newwfid+"&newwfname="+newwfname;
			}
		</script>
	</head>
	<body>
		<form id="formsubmit" name="formsubmit" method="post">
			<input type="hidden" name="newwfid" id="newwfid" value="<?=$newwfid?>"/>
			<input type="hidden" name="newwfname" id="newwfname" value="<?=$newwfname?>"/>
			<input type="hidden" name="flagstatus" id="flagstatus"/>
			<input type="hidden" name="btnname" id="btnname"/>
			<input type="hidden" name="flowde" id="flowde"/>
			<input type="hidden" name="branchde" id="branchde"/>

			<input type="hidden" name="utilformname" id="utilformname" value="<?=$utilformname?>"/>
			<input type="hidden" name="utilformfield" id="utilformfield" value="<?=$utilformfield?>"/>
			
			
			<table align="center" border="1" style="width:80%;border:0px solid black;border-collapse:collapse;text-align:center;margin-top:10px;margin-bottom:20px;">
				<tr>
					<td colspan="2">
						<input type="button" class="unselected <?=$selected1?>" value="Doc Admin" onclick="checkdocument('1')"/>
						<input type="button" class="unselected <?=$selected2?>" value="Doc Colateral" onclick="checkdocument('2')"/>
						<input type="button" class="unselected <?=$selected3?>" value="Doc Person" onclick="checkdocument('3')"/>
					</td>
				</tr>
				<tr style="height:50px;line-height:50px;">
					<td colspan="2" style="background:#787878;color:#ffffff;">Adding Doc Parameter at <?=$newwfname?></td>
				</tr>
				<tr>
					<td style="">DOC PARAMETER</td>
					<td style="">Action</td>
				</tr>
				<tr>
					<td>
						<select style="width:100%;" id="flow" name="flow">
							<?
							$strsql="select * from(
									select doc_id,doc_name,'1' as 'a' from Tbl_DocAdmin
									union
									select doc_id,doc_name,'2' as 'a' from Tbl_DocCol
									union
									select doc_id,doc_name,'3' as 'a' from Tbl_DocPerson)
									tblxx  ".$tmpwhere." and a='".$request_A."'  order by doc_id";

							$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
							$params = array(&$_REQUEST['query']);
							$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
							if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
							//$rowCounter = sqlsrv_num_rows($sqlConn);
							if(sqlsrv_has_rows($sqlcon))
							{
								while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
								{
									echo '<option value="'.$rows['doc_id'].'">'.$rows['doc_id'].' - '.$rows['doc_name'].'</option>';
								}
							}
							?>
						</select>
					</td>
					<td style="">
					<? //echo $strsql; ?>
						<input type="button" value="add" onclick="add();"/>
					</td>
				</tr>
				
			</table>
			
			<?php

			$tmpbranchto='';
			$strsql="
			select ROW_NUMBER () OVER(ORDER BY doc_id) as 'seq',* from(
					select a.doc_id,a.doc_name,b.flag,b.wf_id, '1' as 'inicatagory' from Tbl_DocAdmin a
					join tbl_docparamworkflow b on a.doc_id= b.doc_id
					union
					select a.doc_id,a.doc_name,b.flag,b.wf_id,'2' as 'inicatagory' from Tbl_DocCol a
					join tbl_docparamworkflow b on a.doc_id= b.doc_id
					union
					select a.doc_id,a.doc_name,b.flag,b.wf_id, '3' as 'inicatagory' from Tbl_DocPerson a
					join tbl_docparamworkflow b on a.doc_id= b.doc_id
					)tblxx where wf_id='".$newwfid."' order by doc_id";
			//echo $strsql;
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_REQUEST['query']);
			$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
			if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
			//$rowCounter = sqlsrv_num_rows($sqlConn);
			if(sqlsrv_has_rows($sqlcon))
			{
				echo '<table align="center" border="1" style="width:80%;border:1px solid yellow;background:#fff000;border-collapse:collapse;text-align:center;">';
				echo '<tr style="background:#FF0031;color:#ffffff;">';
					echo '<td style="">No</td>';
					echo '<td style="">Nama Doc</td>';
					echo '<td style="">Type Doc</td>';
					echo '<td style="">Status</td>';
					echo '<td style="">Action</td>';
				echo '</tr>';
				while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
				{
					
					$tmpbranchto .=$rows['doc_id'].$rows['flag'].',';
					$asd="";
					if($rows['inicatagory']=='1'){$asd="Doc Admin";}
					else if($rows['inicatagory']=='2'){$asd="Doc Colateral";}
					else if($rows['inicatagory']=='3'){$asd="Doc Person";}
					echo '
						<tr>
							<td>'.$rows['seq'].'</td>
							<td>'.$rows['doc_id'].' - '.$rows['doc_name'].'</td>
							<td>'.$asd.'</td>';
							
							$flagstatus="Need Otorisasi Before Active";
							if($rows['flag']=="0"){$flagstatus="Active";}
							
							echo '<td>'.$flagstatus.'</td>';
							echo '<td>
							<!--<input type="button" value="edit" onclick="edit(\''.$rows['doc_id'].'\');"/>-->
							<input type="button" value="delete" onclick="del(\''.$rows['doc_id'].'\');"/></td>
						</tr>	
					';
				}
				
				echo '</table>';
				
				echo '<div style="text-align:center;">
					<input type="hidden" id="tomaster" name="tomaster" value="'.substr($tmpbranchto,0,-1).'" />

								<input type="button" value="SUBMIT" onclick="submitdata();" style="background:#00FFFF;border:1px solid #0255D0;"/>
				
				
					
				</div>';
			}
			?>
			
		</form>
	</body>
</html>
