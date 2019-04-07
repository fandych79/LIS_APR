<?
?>
<html>
	<head>
		<title>Appraisal</title>
		<link rel="stylesheet" href="../../../bin/css/css-bj.css" type="text/css" />
		<link rel="shortcut icon" href="../../../bin/img/favicon.png" type="image/x-icon">
		<link href="../../../bin/css/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
		<script src="../../../bin/css/SpryMenuBar.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../../bin/bootstrap/dist/js/jquery-1.11.3.js" ></script>
		<script type="text/javascript" src="../../../bin/bootstrap/dist/js/bootstrap.min.js" ></script>
		
		<script type="text/javascript" src="../../../bin/js/datatable.js"></script>
		<script type="text/javascript" src="../../../bin/js/bootstraptable.js"></script>
		<script type="text/javascript" src="../../../bin/js/bootstrap-datepicker.min.js"></script>
		
		<link href="../../../bin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../../bin/bootstrap/dist/css/bootstrap-datepicker.min.css"></link>
		<link rel="stylesheet" href="../../../bin/bootstrap/dist/css/bootstrap-datepicker3.min.css"></link>
		
		<script language="javascript" type="text/javascript" src="../../../bin/javascript/niceforms.js"></script>
		<link href="../../../bin/css/table.css" rel="stylesheet" type="text/css" />
		<link href="../../../css/crw.css" rel="stylesheet" type="text/css" />
		
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
		<script type="text/javascript" src="../../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../../js/accounting.js" ></script>
		<script type="text/javascript" src="../../../js/my.js" ></script>
		<link href="../../../css/d.css" rel="stylesheet" type="text/css" />
	</head>
	<body style="margin:0;">
		<form id="frm" name="frm" method="post" class="preview2">
			<div class="divcenter">
				<table border="1" style ="width:100%; border-color:black;" align="center" id="preview2" cellspacing="0">
					<tr>
						<td align="center" colspan="2" style="font-size:12pt;">
							
							<?
							
							$tsql2 = "select * from Tbl_Cust_MasterCol where ap_lisregno = '$custnomid' and col_id = '$col_id'";
							$sqlconv02 = sqlsrv_query($conn, $tsql2);
							if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
							if(sqlsrv_has_rows($sqlconv02))
							{
								while($rowsv00 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
								{
									$j = 0;
									switch($rowsv00['cust_jeniscol']){
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
										$j=1;
										break;
									default:
										$jenis = "Lainnya";
										break;
								}
									echo "Jaminan ".$rowsv00['col_id']." - ".$jenis;
									echo "</br></br>";
									
							?>
									

											<?php
											
											$tsql = "select * from appraisal_datapembanding where custnomid = '$custnomid' and collateral_id = '".$rowsv00['col_id']."'";
											$sqlconv01 = sqlsrv_query($conn, $tsql);
											if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
											if(sqlsrv_has_rows($sqlconv01))
											{
												while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
												{
													echo "<table border=\"1\" cellspacing=\"0\" width=\"100%\" style=\"table-layout:fixed\">";
													echo "<tr>";
													echo "<td rowspan=\"11\" width=\"20%\" valign=\"top\">".$rowsv01['description1']."</td>";
													echo "<td width=\"30%\">Luas Tanah </td>";
													echo "<td width=\"50%\">".$rowsv01['luas_tanah']." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Nilai per m<sup>2</sup> Tanah </td>";
													echo "<td width=\"50%\">".number_format($rowsv01['nilai_perm2_tanah'])." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Nilai Total Tanah </td>";
													echo "<td width=\"50%\">".number_format($rowsv01['nilai_total_tanah'])." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Luas Bangunan </td>";
													echo "<td width=\"50%\">".$rowsv01['luas_bangunan']." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Nilai per m<sup>2</sup> Bangunan </td>";
													echo "<td width=\"50%\">".number_format($rowsv01['nilai_perm2_bangunan'])." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Nilai Total Bangunan </td>";
													echo "<td width=\"50%\">".number_format($rowsv01['nilai_total_bangunan'])." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Nilai Sarana dan Prasarana </td>";
													echo "<td width=\"50%\">".number_format($rowsv01['nilai_sarana_prasarana'])." </td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Nilai Total Asset </td>";
													echo "<td width=\"50%\">".number_format($rowsv01['nilai_total_asset'])." </td>";
													echo "</tr>";
													
													echo "<tr>";
													echo "<td width=\"30%\">Tanggal Kunjungan</td>";
													echo "<td width=\"30%\">".$rowsv01['description2']."</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Officer</td>";
													echo "<td width=\"30%\">".$rowsv01['officer']."</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width=\"30%\">Keterangan</td>";
													echo "<td width=\"30%\" style=\"overflow-x:auto\">".$rowsv01['keterangan']."</td>";
													echo "</tr>";
													echo "</table> <hr>";
												}
											}
											?>
									
							
							<?
								echo "</br></br>";
								}
							}
							?>
						</td>
					</td>
				</table>
				<div>&nbsp;</div>
										<input type="hidden" id="txtcustlisid" name="txtcustlisid" alt="Customer LIS ID" maxlength="50" value="<?php echo $_custlistid?>" style="width:100%; background-color:#ffff00;"/>
										<input id="txtnorek" name="txtnorek" alt="No Rekening" type="hidden" maxlength="100" value="<?php echo $_norek?>" style="width:100%; background-color:#ffff00;" />
				<?
					//require ("../../../requirepage/hiddenfield.php");
				?>
		</form>
	</body>
</html>