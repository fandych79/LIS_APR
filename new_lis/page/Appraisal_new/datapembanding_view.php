<?
	require ("../../lib/open_con.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
?>
<html>
	<head>
		<title>Appraisal</title>
		<link rel="stylesheet" href="../../bin/css/css-bj.css" type="text/css" />
		<link rel="shortcut icon" href="../../bin/img/favicon.png" type="image/x-icon">
		<link href="../../bin/css/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
		<script src="../../bin/css/SpryMenuBar.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../bin/bootstrap/dist/js/jquery-1.11.3.js" ></script>
		<script type="text/javascript" src="../../bin/bootstrap/dist/js/bootstrap.min.js" ></script>
		
		<script type="text/javascript" src="../../bin/js/datatable.js"></script>
		<script type="text/javascript" src="../../bin/js/bootstraptable.js"></script>
		<script type="text/javascript" src="../../bin/js/bootstrap-datepicker.min.js"></script>
		
		<link href="../../bin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../bin/bootstrap/dist/css/bootstrap-datepicker.min.css"></link>
		<link rel="stylesheet" href="../../bin/bootstrap/dist/css/bootstrap-datepicker3.min.css"></link>
		
		<script language="javascript" type="text/javascript" src="../../bin/javascript/niceforms.js"></script>
		<link href="../../bin/css/table.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			$(document).ready(function() {
				$('#example').DataTable();
			} );
		</script>
		
		<script>
			function funcDelete(id) {
				var r = confirm("Are you sure want to delete?");
				if (r == true) {
					window.location = "datapembanding_do.php?act=del&id=" +id + "&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>";
				}
			}
			function save()
			{
				document.frm.action = "./datapembanding_do.php?act=saveflow&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>";
				document.frm.submit();
			}
		</script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<script type="text/javascript" src="../../js/my.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
	</head>
	<body style="margin:0;">
		<div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
		<br><br><br>
		<form id="frm" name="frm" method="post">
			<div class="divcenter">
			
				
				
				<table border="1" style ="width:900px; border-color:black;" align="center" id="tblpreview">
					<tr>
						<td colspan="2"><a href="../flow.php?&userwfid=<?= $userwfid ?>&userpermission=<?= $userpermission ?>&buttonaction=<?= $buttonaction ?>&userbranch=<?= $userbranch ?>&userregion=<?= $userregion ?>&userid=<?= $userid ?>&userpwd=<?= $userpwd ?>">back to flow</a></td>
					</tr>
	
					<tr>
						<td align="center" colspan="2" style="font-size:12pt;">
						
							
							<div align="left" style="padding:20px;">
							
							<? echo '<iframe src="./../report/datapembanding/datapembanding.php?custnomid='.$custnomid.'&userid='.$userid.'&userpwd='.$userpwd.'&userbranch='.$userbranch.'&userregion='.$userregion.'&userwfid=&userpermission=A&buttonaction='.$buttonaction.'" height="600px" width="990px"></iframe>'; ?>
							<!--<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Collateral ID</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Collateral ID</th>
										<th>Description</th>
										<th>Amount</th>
										<th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									
									$tsql = "select * from appraisal_datapembanding2 where custnomid = '$custnomid'";
									$sqlconv01 = sqlsrv_query($conn, $tsql);
									if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
									if(sqlsrv_has_rows($sqlconv01))
									{
										while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
										{
											echo "<tr>";
											echo "<td>".$rowsv01['col_id']."</td>";
											echo "<td>".str_replace("Pembanding","Independent",$rowsv01['description1'])."</td>";
											echo "<td>".number_format($rowsv01['amount1'])."</td>";
											?>
											<td>
												<a href="datapembanding_act.php?act=v&id=<?=$rowsv01['idx']?>&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>">VIEW</a>
												
											</td>
											<?
											echo "</tr>";
										}
									}
									?>
								</tbody>
							</table>-->
							</div>
						</td>
					</td>
					<tr>
						<td colspan="2" align="center" height="50px">
							<?
							if($userid != "")
							{
							require ("../../requirepage/btnview.php");
							require ("../../requirepage/hiddenfield.php");
							}
							require("../../requirepage/btnprint.php");
						?>
						</td>
					</tr>
				</table>
				<div>&nbsp;</div>
				<input type="hidden" id="txtcustlisid" name="txtcustlisid" alt="Customer LIS ID" maxlength="50" value="<?php echo $_custlistid?>" style="width:100%; background-color:#ffff00;"/>
				<input id="txtnorek" name="txtnorek" alt="No Rekening" type="hidden" maxlength="100" value="<?php echo $_norek?>" style="width:100%; background-color:#ffff00;" />
		</form>
	</body>
</html>