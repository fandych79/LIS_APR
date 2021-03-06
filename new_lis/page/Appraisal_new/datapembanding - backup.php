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
				var status = '0';
				
				<?php
					$strsqlv01="SELECT * FROM tbl_cust_mastercol WHERE ap_lisregno = '$custnomid'";
					$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
					if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($sqlconv01))
					{
						while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
						{
							$m_col_id = $rowsv01['col_id'];
							
							$tsql = "select count(*) as ct from appraisal_datapembanding where collateral_id = '$m_col_id'";
							$sqlconv02 = sqlsrv_query($conn, $tsql);
							if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
							if(sqlsrv_has_rows($sqlconv02))
							{
								while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
								{
									//echo $rowsv02['ct'];exit;
									
									if($rowsv02['ct']>=2)
									{
										?>
										status = '1';
										<?
									}
									else
									{
										?>
										status = '0';
										<?
									}
								}
							}
						}
						
					}
				?>
				
				//alert(status);
				if(status == '1')
				{
					document.frm.action = "./datapembanding_do.php?act=saveflow&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>";
					document.frm.submit();
				}
				else
				{
					alert('Harap isi data pembanding masing-masing minimal 2');
				}
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
				<table border="1" style ="width:900px; border-color:black;" align="center" id="tblform">
					<tr>
						<td align="center" colspan="2" style="font-size:14pt;height:70px;">DATA PEMBANDING</td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="font-size:12pt;">
							<div align="left" style="height:50px;padding-left:20px;padding-top:20px;">
								<img src="../../bin/img/add_new.png" style="width:30px;"/> Tambah data pembanding :
									<?php
										$strsqlv01="SELECT * FROM tbl_cust_mastercol WHERE ap_lisregno = '$custnomid'";
										$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
										if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlconv01))
										{
											while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
											{
												$m_col_id = $rowsv01['col_id'];
												$m_cust_jeniscol = $rowsv01['cust_jeniscol'];
												
												switch($m_cust_jeniscol){
													case "TAN":
														$jenis = "Tanah";
														break;
													case "BA1":
														$jenis = "Tanah dan Bangunan";
														break;
													case "RUK":
														$jenis = "Ruko";
														break;
													case "KI2":
														$jenis = "Kios";
														break;
													case "V01":
														$jenis = "Kendaraan";
														break;
													default:
														$jenis = "Lainnya";
														break;
												}
?>
                        <a href="datapembanding_act.php?custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>&jeniscol=<?=$m_cust_jeniscol?>"><? echo $jenis ?></A>&nbsp &nbsp
<?												
											}
										}
									?>
							</div>
						
							<div align="left" style="padding:20px;">
							<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Collateral ID</th>
										<th>Description</th>
										<th>Nilai (Rp)</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Collateral ID</th>
										<th>Description</th>
										<th>Nilai (Rp)</th>
										<th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									
									$tsql = "select * from appraisal_datapembanding where custnomid = '$custnomid' order by collateral_id";
									$sqlconv01 = sqlsrv_query($conn, $tsql);
									if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
									if(sqlsrv_has_rows($sqlconv01))
									{
										while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
										{
												$m_cust_jeniscol = $rowsv01['cust_jeniscol'];
												$total = $rowsv01['amount1']+$rowsv01['amount2']+$rowsv01['amount3']+$rowsv01['amount4'];
												switch($m_cust_jeniscol){
													case "TAN":
														$jenis = "Tanah";
														break;
													case "BA1":
														$jenis = "Tanah dan Bangunan";
														break;
													case "RUK":
														$jenis = "Ruko";
														break;
													case "KI2":
														$jenis = "Kios";
														break;
													case "V01":
														$jenis = "Kendaraan";
														break;
													default:
														$jenis = "Lainnya";
														break;
												}

											echo "<tr>";
											echo "<td>".$rowsv01['collateral_id'] . " - " . $jenis ."</td>";
											echo "<td>".str_replace("Pembanding","Independent",$rowsv01['description1'])."</td>";
											echo "<td align=right>".number_format($total)."</td>";
											?>
											<td>
												<a href="datapembanding_act.php?id=<?=$rowsv01['idx']?>&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>&jeniscol=<?=$m_cust_jeniscol?>"">EDIT</a> | 
												<a href="javascript:funcDelete('<?=$rowsv01['idx']?>')">DELETE</a>
											</td>
											<?
											echo "</tr>";
										}
									}
									?>
								</tbody>
							</table>
							</div>
						</td>
					</td>
					<tr>
						<td colspan="2" align="center" height="50px">
							<input type="button" id="btnadd" name="btnadd" value="Save" class="buttonsaveflow" onclick="save();"/>
						</td>
					</tr>
				</table>
				<div>&nbsp;</div>
										<input type="hidden" id="txtcustlisid" name="txtcustlisid" alt="Customer LIS ID" maxlength="50" value="<?php echo $_custlistid?>" style="width:100%; background-color:#ffff00;"/>
										<input id="txtnorek" name="txtnorek" alt="No Rekening" type="hidden" maxlength="100" value="<?php echo $_norek?>" style="width:100%; background-color:#ffff00;" />
				<?
					require ("../../requirepage/hiddenfield.php");
				?>
		</form>
	</body>
</html>