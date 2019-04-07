<?
require ("../lib/open_con.php");
require ("../lib/formatError.php");

$utilformname=$_POST['utilformname'];
$utilformfield=$_POST['utilformfield'];
$newcluster=$_POST['newcluster'];




$newbranchid="";
$newbranchname="";
$idregion="";
$nameregion="";
if(isset($_REQUEST['newbranchid']))
{
$newbranchid=$_REQUEST['newbranchid'];
}
if(isset($_REQUEST['newbranchname']))
{
$newbranchname=$_REQUEST['newbranchname'];
}




if(!isset($_REQUEST['fromthispage']))
{

$strsql = "delete from tbl_branchcluster_oto where branch='".$newbranchid."'
INSERT INTO tbl_branchcluster_oto
(branch,flowcode,branchto,method,flag)
SELECT branch,flowcode,branchto,method,flag
FROM tbl_branchcluster where branch='".$newbranchid."'
";
//$strsql = "delete from tbl_branchcluster where flowcode='".$flowde."' and branch='".$newbranchid."'";


$params = array(&$_POST['query']);
$stmt = sqlsrv_prepare( $conn, $strsql, $params);
if(!$stmt ){
echo "Error in preparing statement.\n";
die( print_r( sqlsrv_errors(), true));
}
if(!sqlsrv_execute( $stmt)){
echo "Error in executing statement.\n";
die( print_r( sqlsrv_errors(), true));
}
sqlsrv_free_stmt( $stmt);

}


//echo '(\''.$newbranchname.'\')';

?>
<html>
	<head>
		<script type="text/javascript" src="../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript">
			function add()
			{
			
				document.getElementById('btnname').value = "add";
				document.getElementById('formsubmit').action = "./do_branchcluster.php";
				document.getElementById('formsubmit').submit();
			}
			function del(flow)
			{
			
				document.getElementById('btnname').value = "del";
				document.getElementById('flowde').value = flow;
				document.getElementById('branchde').value = document.getElementById('branch'+flow).value;
				document.getElementById('formsubmit').action = "./do_branchcluster.php";
				document.getElementById('formsubmit').submit();
			}
			function edit(flow)
			{
				//alert(flow);
				document.getElementById('btnname').value = "edit";
				document.getElementById('flowde').value = flow;
				document.getElementById('branchde').value = document.getElementById('branch'+flow).value;
				document.getElementById('formsubmit').action = "./do_branchcluster.php";
				document.getElementById('formsubmit').submit();
			}
			function submitdata()
			{
				
			   opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=document.getElementById('tomaster').value;
			   self.close();
			}
		</script>
	</head>
	<body>
		<form id="formsubmit" name="formsubmit" method="post">
			<input type="hidden" name="newbranchid" id="newbranchid" value="<?=$newbranchid?>"/>
			<input type="hidden" name="newbranchname" id="newbranchname" value="<?=$newbranchname?>"/>
			<input type="hidden" name="btnname" id="btnname"/>
			<input type="hidden" name="flowde" id="flowde"/>
			<input type="hidden" name="branchde" id="branchde"/>

			<input type="hidden" name="utilformname" id="utilformname" value="<?=$utilformname?>"/>
			<input type="hidden" name="utilformfield" id="utilformfield" value="<?=$utilformfield?>"/>
			<input type="hidden" name="newcluster" id="newcluster" value="<?=$newcluster?>"/>
			
			<table align="center" border="1" style="width:900px;border:0px solid black;border-collapse:collapse;text-align:center;margin-top:10px;margin-bottom:20px;">
				<tr style="height:50px;line-height:50px;">
					<td colspan="4" style="background:#787878;color:#ffffff;">Adding Cluster at branch <?=$newbranchname.' ('.$newbranchid.')'?></td>
				</tr>
				<tr>
					<td style="width:350px;">Flow</td>
					<td style="width:300px;">Change to Branch</td>
					<td style="width:150px;">Method</td>
					<td style="width:100px;">Action</td>
				</tr>
				<tr>
					<td>
						<select id="flow" name="flow">
							<?
							$strsql="select * from Tbl_Workflow where wf_id not in(select flowcode from tbl_branchcluster_oto where branch='".$newbranchid."') order by wf_urut";

							$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
							$params = array(&$_REQUEST['query']);
							$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
							if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
							//$rowCounter = sqlsrv_num_rows($sqlConn);
							if(sqlsrv_has_rows($sqlcon))
							{
								while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
								{
									echo '<option value="'.$rows['wf_id'].'">'.$rows['wf_name'].'</option>';
								}
							}
							?>

						</select>
					</td>
					<td>
						<select id="branch" name="branch">
							<?
							
							$strsql="select * from tbl_branch ";
							$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
							$params = array(&$_REQUEST['query']);
							$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
							if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
							//$rowCounter = sqlsrv_num_rows($sqlConn);
							if(sqlsrv_has_rows($sqlcon))
							{
								while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
								{
									echo '<option value="'.$rows['branch_code'].'">'.$rows['branch_code'].' - '.$rows['branch_name'].'</option>';
								}
							}

							
							?>
						</select>
					</td>
					<td>
						<select id="method" name="method">
							<option value="1">GET first</option>
						</select>
					</td>
					<td style="width:150px;">
						<input type="button" value="add" onclick="add();"/>
					</td>
				</tr>
				
			</table>
			
			<?php

			$tmpbranchto='';
			$strsql="
			select ROW_NUMBER () OVER(ORDER BY b.wf_urut) as 'seq',a.flag,a.method,
			b.wf_name,b.wf_id,a.branchto from tbl_branchcluster_oto a
			join Tbl_Workflow b on a.flowcode = b.wf_id
			where a.branch='".$newbranchid."'
			order by b.wf_urut";
			//echo $strsql;
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_REQUEST['query']);
			$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
			if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
			//$rowCounter = sqlsrv_num_rows($sqlConn);
			if(sqlsrv_has_rows($sqlcon))
			{
				echo '<table align="center" border="1" style="width:1000px;border:1px solid yellow;background:#fff000;border-collapse:collapse;text-align:center;">';
				echo '<tr style="background:#FF0031;color:#ffffff;">';
					echo '<td style="width:50px;">No</td>';
					echo '<td style="width:350px;">Flow</td>';
					echo '<td style="width:350px;">Ke Cabang</td>';
					echo '<td style="width:200px;">Method</td>';
					echo '<td style="width:250px;">Status</td>';
					echo '<td style="width:150px;">Action</td>';
				echo '</tr>';
				while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
				{
					
					$tmpbranchto .=$rows['branchto'].$rows['flag'].',';
					echo '
						<tr>
							<td>'.$rows['seq'].'</td>
							<td>'.$rows['wf_id'].' - '.$rows['wf_name'].'</td>';
							echo '<td>';
								echo '<select id="branch'.$rows['wf_id'].'" name="branch'.$rows['wf_id'].'">';
								$strsqlbranch="select * from tbl_branch ";
								$cursorTypebranch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
								$paramsbranch = array(&$_REQUEST['query']);
								$sqlconbranch = sqlsrv_query($conn, $strsqlbranch, $paramsbranch, $cursorTypebranch);
								if ( $sqlconbranch === false)die( FormatErrors( sqlsrv_errors() ) );
								//$rowCounter = sqlsrv_num_rowsbranch($sqlconbranchn);
								if(sqlsrv_has_rows($sqlconbranch))
								{
									while($rowsbranch = sqlsrv_fetch_array($sqlconbranch, SQLSRV_FETCH_ASSOC))
									{
										
										if($rowsbranch['branch_code']==$rows['branchto'])
										{
											echo '<option selected="selected" value="'.$rowsbranch['branch_code'].'">'.$rowsbranch['branch_code'].' - '.$rowsbranch['branch_name'].'</option>';
										}
										else
										{
											echo '<option value="'.$rowsbranch['branch_code'].'">'.$rowsbranch['branch_code'].' - '.$rowsbranch['branch_name'].'</option>';
										}
									}
								}
							echo '</td>';
							$opt1="";
							if($rowsbranch['method']=="1")
							{
							$opt1='selected="selected"';
							}
							echo 
							'
							<td>
								<select id="method" name="method">
									<option '.$opt1.' value="1">GET first</option>
								</select>
							</td>
							';
							$flagstatus="Need Otorisasi Before Active";
							if($rows['flag']=="0"){$flagstatus="Active";}
							
							echo '<td>'.$flagstatus.'</td>';
							echo '<td><input type="button" value="edit" onclick="edit(\''.$rows['wf_id'].'\');"/><input type="button" value="delete" onclick="del(\''.$rows['wf_id'].'\');"/></td>
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
