<?
	require('../../lib/open_conLIS.php');
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$strsqlv01="select * from tbl_COL_Building where col_id in (select col_id from Tbl_Cust_MasterCol where ap_lisregno = '$custnomid' and flaginsert = '1' and flagdelete = '0' and cust_jeniscol = 'BA1')";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$col_imbluas = $rowsv01['col_imbluas'];
		}
	}
	
	$strsqlv01="select * from tbl_COL_LAND where col_id in (select col_id from Tbl_Cust_MasterCol where ap_lisregno = '$custnomid' and flaginsert = '1' and flagdelete = '0' and cust_jeniscol = 'BA1')";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$col_certluas = $rowsv01['col_certluas'];
			$col_addr1 = $rowsv01['col_addr1'];
		}
	}
	sqlsrv_close( $conn );
	
	require ("../../lib/open_con.php");
	
	$custfullname = "";
	
	$strsqlv01="SELECT * FROM appraisal_custmaster WHERE _custnomid = '$custnomid'";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$custfullname = $rowsv01['_cust_name'];
		}
	}
	
	
	
	$tanggal_beritaacara = "";
	$nama_petugas1 = "";
	$jabatan_petugas1 = "";
	$nama_petugas2 = "";
	$jabatan_petugas2 = "";
	$strsqlv01="SELECT * FROM berita_acara_trans2 WHERE custnomid = '$custnomid'";
	$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
	if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlconv01))
	{
		if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
		{
			$tanggal_beritaacara = $rowsv01['tanggal_beritaacara'];
			$nama_petugas1 = $rowsv01['nama_petugas1'];
			$jabatan_petugas1 = $rowsv01['jabatan_petugas1'];
			$nama_petugas2 = $rowsv01['nama_petugas2'];
			$jabatan_petugas2 = $rowsv01['jabatan_petugas2'];
		}
	}
	
	
	
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
					$('.tanggal').datepicker({format: 'yyyy-mm-dd',todayBtn: "linked"});
					$(".tanggal").keydown(function(e){
						e.preventDefault();
					});
					
					showvalue();
				} );
				
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
		
			<div class="divcenter">
				<table border="1" style ="width:900px; border-color:black;" align="center" class="preview2">
					<tr>
						<td align="center" colspan="2" style="font-size:14pt;height:70px;">BERITA ACARA PEMERIKSAAN</td>
					</tr>
					<form class="contact_form" action="beritaacara_do.php" method="post" name="contact_form">
					<tr>
						<td align="center" colspan="2" style="font-size:12pt;">
							<table align="left" width="100%" style="margin:5px;">
							<tr>
								<td colspan="2">
									Pada hari ini <?=$tanggal_beritaacara;?>
									kami yang bertanda tangan di bawah ini :
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding:20px;">
									Nama
								</td>
								<td width="70%">
									Jabatan
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-left:20px;padding-top:5px;">
									1. <?php echo $nama_petugas1;?>
								</td>
								<td width="70%">
									<?php echo $jabatan_petugas1;?>
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-left:20px;padding-top:5px;">
									2. <?php echo $nama_petugas2;?>
								</td>
								<td width="70%">
									<?php echo $jabatan_petugas2;?>
								</td>
							</tr>
							<tr>
								<td colspan="2"  style="padding-top:20px;padding-bottom:20px;">
									Telah melakukan peninjauan setempat jaminan dari debitur dengan data-data sebagai berikut : 
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-top:5px;">
									Debitur
								</td>
								<td width="70%">
									: <?=$custfullname;?>
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-top:5px;">
									Pengembang (Developer)
								</td>
								<td width="70%">
									: -
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-top:5px;">
									Luas Bangunan/Tanah
								</td>
								<td width="70%">
									: <?=$col_imbluas;?>/<?=$col_certluas;?>
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-top:5px;">
									Lokasi Perumahan
								</td>
								<td width="70%">
									: <?=$col_addr1;?>
								</td>
							</tr>
							<tr>
								<td width="30%" style="padding-top:5px;">
									Blok & Nomor
								</td>
								<td width="70%">
									: -
								</td>
							</tr>
							<tr>
								<td colspan="2"  style="padding-top:20px;padding-bottom:20px;">
									<table align="left" width="98%"  border="1px"  cellspacing="0" >
									<tr>
										<td rowspan="2" align="center">No.</td>
										<td rowspan="2" align="center">Perihal/Pekerjaan</td>
										<td align="center">Kesiapan</td>
										<td align="center">Kondisi</td>
										<td rowspan="2" align="center">Catatan</td>
										<td rowspan="2" align="center">Keterangan</td>
									</tr>
									<tr>
										<td align="center"> Ada/Tidak</td>
										<td align="center"> Pekerjaan</td>
									</tr>
									<?
										require_once ("../../lib/open_con.php");
										$strsqlv01="SELECT * FROM berita_acara_header WHERE flag = '1' order by seq";
										$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
										if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlconv01))
										{
											while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
											{
												$header_code = $rowsv01['code'];
												$header_description = $rowsv01['description'];
												
									?>
									<tr>
										<td>&nbsp;</td>
										<td><strong><?=$header_description;?></strong></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<?
												
											$strsqlv02="SELECT * FROM berita_acara_detail WHERE flag = '1' and header_code = '$header_code' order by seq";
											$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
											if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
											if(sqlsrv_has_rows($sqlconv02))
											{
												while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
												{
													$detail_code = $rowsv02['code'];
													$detail_description = $rowsv02['description'];
													$detail_seq = $rowsv02['seq'];
											
											$kesiapan = "";
											$kondisi = "";
											$catatan = "";
											$keterangan = "";
											$strsqlv03="SELECT * FROM berita_acara_trans WHERE flag = '1' and detail_code = '$detail_code' and custnomid = '$custnomid'";
											$sqlconv03 = sqlsrv_query($conn, $strsqlv03);
											if ( $sqlconv03 === false)die( FormatErrors( sqlsrv_errors() ) );
											if(sqlsrv_has_rows($sqlconv03))
											{
												if($rowsv03 = sqlsrv_fetch_array($sqlconv03, SQLSRV_FETCH_ASSOC))
												{
													$kesiapan = $rowsv03['kesiapan'];
													$kondisi = $rowsv03['kondisi'];
													$catatan = $rowsv03['catatan'];
													$keterangan = $rowsv03['keterangan'];
												}
											}
									?>
									
									<tr>
										<td align="right"><?=$detail_seq;?>.</td>
										<td><?=$detail_description;?></td>
										<td><?=$kesiapan;?></td>
										<td><?=$kondisi?></td>
										<td><?=$catatan?></td>
										<td><?=$keterangan?></td>
									</tr>
									<?
											
												}
											}
											}
										}
										require ("../../requirepage/hiddenfield.php");
									?>
									</table>
								</td>
							</tr>
							
							</table>
						</td>
						</form>	
					</td>
				<form id="frm" name="frm" method="post">
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
				<?
				?>
				</form>
		
	</body>
</html>