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
							
							$tsql = "select count(*) as ct from appraisal_datapembanding2 where col_id = '$m_col_id'";
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
				status = 1;
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
						<td colspan="2" style="padding: 5px;"><a href="../flow.php?&userwfid=<?= $userwfid ?>&userpermission=<?= $userpermission ?>&buttonaction=<?= $buttonaction ?>&userbranch=<?= $userbranch ?>&userregion=<?= $userregion ?>&userid=<?= $userid ?>&userpwd=<?= $userpwd ?>">back to flow</a></td>
					</tr>
					<tr>
						<td align="center" colspan="2" style="font-size:12pt;">
							<div align="left" style="padding-left:20px;padding-top:20px;">
								<a href="datapembanding_act.php?custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>"><img src="../../bin/img/add_new.png" style="width:30px;"/> Tambah data pembanding</a> <hr>
							
						
							<div align="left" style="padding:20px;">
							<table border="0" id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th style="width:200px">Collateral ID</th>
										<th>Keterangan</th>
										<th>Deskripsi</th>
										<th>harga 1</th>
										<th>harga 2</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>Collateral ID</th>
										<th>Keterangan</th>
										<th>Deskripsi</th>
										<th>harga 1</th>
										<th>harga 2</th>
										<th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									
									$tsql = "select * from appraisal_datapembanding2 a 
									join TblCollateralType b on a.col_code = b.col_code where
									 a.custnomid = '$custnomid' ";
									$sqlconv01 = sqlsrv_query($conn, $tsql);
									if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
									if(sqlsrv_has_rows($sqlconv01))
									{
										while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
										{
											$col_id = $rowsv01['col_id'];
											$col_name = $rowsv01['col_name'];
											$keterangan = $rowsv01['keterangan'];
											$harga1 = $rowsv01['harga1'];
											$harga2 = $rowsv01['harga2'];
											$m_col_id = $rowsv01['col_id'];
											$m_cust_jeniscol = $rowsv01['col_code'];
											$deskripsi = $rowsv01['deskripsi'];
											$col_name = $rowsv01['col_name'];
											$id = $rowsv01['id'];
											
											echo "<tr>";
											echo "<td>".$col_id . " - " . $col_name ."</td>";
											echo "<td>".str_replace("Pembanding","Independent",$keterangan)."</td>";
											echo "<td>".$deskripsi."</td>";
											echo "<td align=right>".number_format($harga1)."</td>";
											echo "<td align=right>".number_format($harga2)."</td>";
											?>
											<td>
												<a href="datapembanding_act.php?custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>&jeniscol=<?=$m_cust_jeniscol?>&col_id=<?=$m_col_id?>">EDIT</a> | 
												<a href="javascript:funcDelete('<?=$id?>')">DELETE</a>
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