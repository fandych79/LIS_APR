<?
	
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$maxofficer = 5;
	$x = 1;
	
	$v_luas_tnh = 0;
	$v_luas_bang = 0;
	$value_smf = 0;
	$value_sm = 0;
	
	//echo $_POST['theid'];
	$theid = $_POST['theid'];
	$strsql="SELECT * FROM Tbl_Cust_MasterCol WHERE col_id = '$theid'";
	//echo $strsql;
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$appjenis = $rows['cust_jeniscol'];
		}
	}
	
	//$strsql="select COUNT(col_id) as jml_officer from appraisal_officer where SUBSTRING(col_id,1,10) = '$custnomid'";
	$strsql="select COUNT(col_id) as jml_officer from appraisal_officer where col_id like '%$custnomid%'";
	//echo $strsql;
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$v_jmlofficer = $rows['jml_officer'];
		}
	}
	//echo $v_jmlofficer;
	
	//$strsql="select COUNT(col_id) as jml_officersign from appraisal_officer where SUBSTRING(col_id,1,10) = '$custnomid' and flag = 'S'";
	$strsql="select COUNT(col_id) as jml_officersign from appraisal_officer where col_id like '%$custnomid%' and flag = 'S'";
	//echo $strsql;
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$v_jmlsign = $rows['jml_officersign'];
		}
	}
	//echo $v_jmlsign;
	
	if($appjenis == "V01")
	{
		$strsqlv01="SELECT * FROM appraisal_vhc WHERE _collateral_id = '$theid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$v_type = $rowsv01['_type'];
				//echo $v_type;
				$v_merk = $rowsv01['_merk'];
				$v_model = $rowsv01['_model'];
				$v_jns = $rowsv01['_jns_kendaraan'];
				$v_thnpem = $rowsv01['_thnpembuatan'];
				$v_silinder_isi = $rowsv01['_silinder_isi'];
				$v_silinder_warna = $rowsv01['_silinder_wrn'];
				$v_norangka = $rowsv01['_norangka'];
				$v_nomesin = $rowsv01['_nomesin'];
				$v_bpkb_tgl = $rowsv01['_bpkb_tgl'];
				$v_stnk_exp = $rowsv01['_stnk_exp'];
				$v_faktur_tgl = $rowsv01['_faktur_tgl'];
				$v_bahanbakar = $rowsv01['_bahanbakar'];
				$v_bpkb_nama = $rowsv01['_bpkb_nama'];
				$v_bpkb_addr1 = $rowsv01['_bpkb_addr1'];
				$v_bpkb_addr2 = $rowsv01['_bpkb_addr2'];
				$v_bpkb_addr3 = $rowsv01['_bpkb_addr3'];
				$v_perlengkapan = $rowsv01['_perlengkapan'];
				$v_notes = $rowsv01['_notes'];
				$v_opini = $rowsv01['_opini'];
			}
		}
		
		$strsqlv01="SELECT * FROM appraisal_vhc_value WHERE _collateral_id = '$theid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$value_kend = $rowsv01['_nilai_kendaraan'];
				//echo $v_type;
				$value_savety = $rowsv01['_safety_margin'];
				$value_likuidasi = $rowsv01['_nilai_likuidasi'];
				$value_opini = $rowsv01['_opini'];
				$value_jml = $rowsv01['jml'];
			}
		}
	}
	else if($appjenis=="BA1" || $appjenis=="RUK" || $appjenis=="KI2")
	{
		$strsqlv01="SELECT * FROM appraisal_tnb WHERE _collateral_id = '$theid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$v_type = $rowsv01['_type_jaminan'];
				//echo $v_type;
				$v_lokasi = $rowsv01['_lokasi_rumah'];
				$v_jmllnt = $rowsv01['_jumlah_lantai'];
				$v_luas_bang = $rowsv01['_luas_bangunan'];
				$v_panj_bang = $rowsv01['_panjang_bangunan'];
				$v_leb_bang = $rowsv01['_lebar_bangunan'];
				$v_arah_bang = $rowsv01['_arah_bangunan'];
				$v_umur_bang = $rowsv01['_umur_bangunan'];
				$v_thn_bang = $rowsv01['_tahun_dibangun'];
				$v_thn_renov = $rowsv01['_tahun_renovasi'];
				$v_luas_tnh = $rowsv01['_luas_tanah'];
				$v_pan_tnh = $rowsv01['_panjang_tanah'];
				$v_leb_tnh = $rowsv01['_lebar_tanah'];
				$v_utara = $rowsv01['_sisi_utara'];
				$v_timur = $rowsv01['_sisi_timur'];
				$v_selatan = $rowsv01['_sisi_selatan'];
				$v_barat = $rowsv01['_sisi_barat'];
				$v_lat = $rowsv01['_latitude'];
				$v_long = $rowsv01['_longitude'];
				$v_notes = $rowsv01['_notes'];
				$v_opini = $rowsv01['_opini'];
			}
		}
		
		$strsqlv01="SELECT * FROM appraisal_tnb_value WHERE _collateral_id = '$theid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$value_tnhpm = $rowsv01['_nilai_tanah_perm2'];
				//echo $v_type;
				$value_tnht = $rowsv01['_nilai_tanah_total'];
				$value_lbf = $rowsv01['_luas_bang_fisik'];
				$value_bfpm = $rowsv01['_nilai_bang_fisik_perm2'];
				$value_bft = $rowsv01['_nilai_bang_fisik_total'];
				$value_bimb = $rowsv01['_luas_bang_imb'];
				$value_bimbpm = $rowsv01['_nilai_bangunan_perm2'];
				$value_bimbt = $rowsv01['_nilai_bangunan_total'];
				$value_tf = $rowsv01['_nilai_total_fisik'];
				$value_ti = $rowsv01['_nilai_total_imb'];
				$value_sm = $rowsv01['_cef_tanah'];
				$value_lf = $rowsv01['_nilai_cef_bangunan'];
				$value_li = $rowsv01['_nilai_cef_tanah'];
				$value_bfp = $rowsv01['_nilai_bang_fisik_percent'];
				$value_bip = $rowsv01['_nilai_bang_imb_percent'];
				$value_smf = $rowsv01['_cef_bangunan'];
				$value_op = $rowsv01['_opini'];
				$_nilai_total_fisik_agunan = $rowsv01['_nilai_total_fisik_agunan'];
				$_nilai_total_cef_agunan = $rowsv01['_nilai_total_cef_agunan'];
				$luas_bangunan = $rowsv01['_luas_bangunan'];
			}
		}
	}
	else if($appjenis=="TAN")
	{
		$strsqlv01="SELECT * FROM appraisal_lnd WHERE _collateral_id = '$theid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$v_luas_tnh = $rowsv01['_luas_tanah'];
				$v_pan_tnh = $rowsv01['_panjang_tanah'];
				$v_leb_tnh = $rowsv01['_lebar_tanah'];
				$v_utara = $rowsv01['_sisi_utara'];
				$v_timur = $rowsv01['_sisi_timur'];
				$v_selatan = $rowsv01['_sisi_selatan'];
				$v_barat = $rowsv01['_sisi_barat'];
				$v_lat = $rowsv01['_latitude'];
				$v_long = $rowsv01['_longitude'];
				$v_notes = $rowsv01['_notes'];
				$v_opini = $rowsv01['_opini'];
			}
		}
		
		$strsqlv01="SELECT * FROM appraisal_lnd_value WHERE _collateral_id = '$theid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$value_tnhpm = $rowsv01['_nilai_tanah_perm2'];
				//echo $v_type;
				$value_tnht = $rowsv01['_nilai_tanah_total'];
				$value_sm = $rowsv01['_safety_margin'];
				$value_lf = $rowsv01['_nilai_likuidasi'];
				$value_op = $rowsv01['_opini'];
			}
		}
	}
?>
<html>
	<head>
		<title>Appraisal</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<script type="text/javascript" src="../../js/my.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">		
			function changeform(theid)
			{
				document.frm.theid.value = theid;
				document.frm.action = "./view_custappraisal.php";
				document.frm.submit();
			}
			function klikSign(thecolid)
			{
        submitform = window.confirm("Setuju ?")
        if (submitform == true)
        {	
				   document.frm.thesignstatus.value = "SIGN";
				   document.frm.thecolid.value = thecolid;
				   document.frm.action = "./appraisal_sign.php";
				   document.frm.submit();
				}
				else
				{
					return false;
				}
			}
			function klikUnSign(thecolid)
			{
        submitform = window.confirm("Tidak Setuju ?")
        if (submitform == true)
        {
				   document.frm.thesignstatus.value = "UNSIGN";
				   document.frm.thecolid.value = thecolid;
				   document.frm.action = "./appraisal_sign.php";
				   document.frm.submit();
				}
				else
				{
					return false;
				}
			}
		</script>
	</head>
	<body style="margin:0;">
		<div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
		<br><br><br>
		<form id="frm" name="frm" method="post">
			<div class="divcenter">
				<table id="tblform" border="1" style ="width:900px; border-color:black;" cellspacing="0">
					<tr>
						<td colspan="2">
							<table>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>					
								<tr>
									<td>&nbsp;</td>
									<td><h3>FORM ENTRY APPRAISAL VALUE (<? echo $custnomid ?>) </h3></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<table>
								<tr>
<?
							$strsql = "SELECT * FROM Tbl_Cust_MasterCol WHERE ap_lisregno = '$custnomid' and group_col = 'N' and flaginsert = '1' and flagdelete = '0'";
							$sqlcon = sqlsrv_query($conn, $strsql);
							if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
							if(sqlsrv_has_rows($sqlcon))
							{
								while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
								{
									$_id = $rows['col_id'];
									
									if($_id==$theid)
									{
										$btn = "buttonneg";
									}else{
										if($value_jml>0)
										{
											$btn = "buttongreen";
										}else{
											$btn = "button";
										}
									}
?>
									<td style="width:50px;">
<?
									if($rows['cust_jeniscol']=="BA1")
									{
?>									
										<input type="button" id="btntnb" name="btntnb" value="Tanah & Bangunan" class="<?php echo $btn;?>" style="width:200px;" onClick="changeform('<?php echo $_id?>');"/>
<?										
									} 
									else if ($rows['cust_jeniscol']=="V01")
									{
?>									
										<input type="button" id="btnvhc" name="btnvhc" value="Kendaraan" class="<?php echo $btn;?>" style="width:200px;" onClick="changeform('<?php echo $_id?>');"/>
<?	
									}
									else if ($rows['cust_jeniscol']=="RUK")
									{
?>									
										<input type="button" id="btnruk" name="btnruk" value="Ruko" class="<?php echo $btn;?>" style="width:200px;" onClick="changeform('<?php echo $_id?>');"/>
<?	
									}
									else if ($rows['cust_jeniscol']=="KI2")
									{
?>									
										<input type="button" id="btnkios" name="btnkios" value="Kios" class="<?php echo $btn;?>" style="width:200px;" onClick="changeform('<?php echo $_id?>');"/>
<?	
									}
									else if ($rows['cust_jeniscol']=="TAN")
									{
?>									
										<input type="button" id="btnlnd" name="btnlnd" value="Tanah" class="<?php echo $btn;?>" style="width:200px;" onClick="changeform('<?php echo $_id?>');"/>
<?	
									}
?>									
									</td>
<?								
								}
							}
?>
								</tr>
							</table>
						</td>
					</tr>
					
						

						
<?							
							if($appjenis=="V01")
							{
?>
					<tr>
						<td colspan="2" align="center">
						<?
							$col_id = $theid;
							
							require("../report/datapembanding/detail.php");	
							
						?>
						</td>
					</tr>
					<tr>
						<td style="width:50%" valign="top">
							<table class="tbl100">
								<tr>
									<td colspan="2"><h4>DATA KENDARAAN</h4></td>
								</tr>
								<tr>
									<td style="width:300px;">Type Kendaraan</td>
									<td  style="width:500px;">
										: <?php echo $v_type;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Merk Kendaraan</td>
									<td  style="width:500px;">
										: <?php echo $v_merk;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Model Kendaraan</td>
									<td  style="width:500px;">
										: <?php echo $v_model;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Jenis Kendaraan</td>
									<td  style="width:500px;">
										: <?php echo $v_jns;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Tahun Pembuatan</td>
									<td  style="width:500px;">
										: <?php echo $v_thnpem;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Isi Silinder</td>
									<td  style="width:500px;">
										: <?php echo $v_silinder_isi;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Warna Silinder</td>
									<td  style="width:500px;">
										: <?php echo $v_silinder_warna;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Nomer Rangka</td>
									<td  style="width:500px;">
										: <?php echo $v_norangka;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Nomer Mesin</td>
									<td  style="width:500px;">
										: <?php echo $v_nomesin;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Tanggal BPKB</td>
									<td  style="width:500px;">
										: <?php echo $v_bpkb_tgl;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">STNK Expired</td>
									<td  style="width:500px;">
										: <?php echo $v_stnk_exp;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Tanggal Faktur</td>
									<td  style="width:500px;">
										: <?php echo $v_faktur_tgl;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Bahan Bakar</td>
									<td  style="width:500px;">
										: <?php echo $v_bahanbakar;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Nama BPKB</td>
									<td  style="width:500px;">
										: <?php echo $v_bpkb_nama;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Alamat BPKB</td>
									<td  style="width:500px;">
										: <?php echo $v_bpkb_addr1;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Perlengkapan</td>
									<td  style="width:500px;">
										: <?php echo $v_perlengkapan;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Notes</td>
									<td  style="width:500px;">
										: <?php echo $v_notes;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Opini</td>
									<td  style="width:500px;">
										: <?php echo $v_opini;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
							</table>
						</td>
						<td style="width:50%" valign="top">
							<div>
								<table class="tbl100">
									<tr>
										<td colspan="2"><h4>NILAI KENDARAAN</h4></td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Kendaraan</td>
										<td style="width:250px;">
											<?echo number_format($value_kend);?>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">CEF</td>
										<td style="width:250px;">
											<?echo $value_savety;?>
											 %
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Likuidasi</td>
										<td style="width:250px;">
											<?echo number_format($value_likuidasi);?>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											Opini
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?echo $value_opini;?>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td valign="top" colspan="2" width="100%" align="center">
							<?
								$off = "";
								$strsqlv02="SELECT * FROM appraisal_officer where col_id = '$theid' order by seq";
								$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
								if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
								if(sqlsrv_has_rows($sqlconv02))
								{
									while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
									{
										$off = $rowsv02['officer_id'];
										$flag = $rowsv02['flag'];
							?>
									<div style="float:left;width:295px;height:120px;">
										</br>
										Officer <?=$x;?>
							<?php
										//$strsqlv01="SELECT * FROM appraisal_paramofficer where _appraiser_id = '$off'";
										$strsqlv01="SELECT user_id,user_name FROM tbl_se_user where user_id = '$off'";
										//echo $strsqlv01;
										$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
										if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlconv01))
										{
											while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
											{
												$id = $rowsv01['user_id'];
												$name = $rowsv01['user_name'];
																								
												$jvs = "javascript:klikSign('".$theid."')";
												$jvs2 = "javascript:klikUnSign('".$theid."')";
												
												if($flag == "")
												{
													if($off!="" && strtoupper($off) == strtoupper($userid))
													{
												    echo "</br>";
														echo '<input type="button" name="sign" id="sign" class="buttonsaveflow" onClick="'.$jvs.'" style="width:50%;" value="SIGN" />';
														echo '<br><br>';
														echo '<input type="button" name="unsign" id="unsign" onClick="'.$jvs2.'" style="width:50%;" value="NOT SIGN - ROLLBACK" />';
												    echo "</br><br>";
													}else{
												    echo "</br></br></br>";
														echo '<font style="color:red;font-weight:bold;">NOT SIGNED</font>';
												    echo "</br></br></br>";
													}
												}else if($flag == "S"){
												  echo "</br></br></br>";
													echo '<font style="color:green;font-weight:bold;">SIGNED</font>';
												  echo "</br></br></br>";
												}
												
												
												echo "<font style='font-weight:bold;'>".$name."</font>";
											}
										}
							?>
									</div>
							<?
									$x++;
									}
								}
							?>
						</td>
					</tr>
<?
				}
				else if($appjenis=="BA1" || $appjenis=="RUK" || $appjenis=="KI2")
				{
?>
					<tr>
						<td colspan="2" align="center">
						<?
							$col_id = $theid;
							
							require("../report/datapembanding/detail.php");	
							
						?>
						</td>
					</tr>
					
					<tr>
					
						
						<td style="width:50%" valign="top" rowspan="1">
							<table class="tbl100" border="0">
								<tr>
									<td colspan="3"><h4>DATA TANAH DAN BANGUNAN</h4></td>
								</tr>
								<tr>
									<td style="width:300px;">Type Jaminan</td>
									<td style="width:10px;">:</td>
									<td  style="width:500px;"><?php echo $v_type;?></td>
								</tr>
								<tr>
									<td style="width:300px;" valign="top">Lokasi Rumah</td>
									<td style="width:10px;" valign="top">:</td>
									<td style="width:500px;"><?php echo $v_lokasi;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Jumlah Lantai</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_jmllnt;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Luas Bangunan</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_luas_bang;?>  m<sup>2</sup></td>
								</tr>
								<tr>
									<td style="width:300px;">Luas Tanah</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_luas_tnh;?> m<sup>2</sup></td>
								</tr>
								<tr>
									<td style="width:300px;">Arah Bangunan</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_arah_bang;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Umur Bangunan</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_umur_bang;?> Tahun</td>
								</tr>
								<tr>
									<td style="width:300px;">Tahun Dibangun</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_thn_bang;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Tahun Renovasi</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_thn_renov;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Utara</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_utara;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Timur</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_timur;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Selatan</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_selatan;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Barat</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_barat;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Latitude</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_lat;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Longitude</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_long;?></td>
								</tr>
								<tr>
									<td style="width:300px;">Notes</td>
									<td style="width:10px;">:</td>
									<td style="width:500px;"><?php echo $v_notes;?></td>
								</tr>
								<tr>
									<td style="width:300px;" valign="top">Opini</td>
									<td style="width:10px;" valign="top">:</td>
									<td style="width:500px;"><?php echo $v_opini;?></td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td style="width:10px;">&nbsp;</td>
									<td style="width:500px;">&nbsp;</td>
								</tr>
							</table>
						</td>
						<td style="width:50%" valign="top">
							<div>
								<table class="tbl100">
									<tr>
										<td colspan="2"><h4>PENILAIAN PEMERIKSA / PEJABAT BANK SUMSELBABEL </h4></td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Tanah Per m<sup>2</sup></td>
										<td style="width:250px;">
											: Rp. <?echo number_format($value_tnhpm);?>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Tanah Total</td>
										<td style="width:250px;">
											: Rp. <?echo number_format($value_tnht);?>
										</td>
									</tr>
									<!--
									<tr>
										<td style="width:180px;">CEF </td>
										<td style="width:250px;">
											<?echo $value_sm;?>
											 %
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai CEF Tanah </td>
										<td style="width:250px;">
											<?echo number_format($value_li);?>
										</td>
									</tr>
									-->
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">&nbsp;</td>
									</tr>
									<tr>
										<td style="width:180px;">Luas Bangunan </td>
										<td style="width:250px;">
											: <?echo $luas_bangunan;?> m<sup>2</sup>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Bangunan  Per m<sup>2<sup></td>
										<td style="width:250px;">
											: Rp. <?echo number_format($value_bimbpm);?>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Bangunan  Total</td>
										<td style="width:250px;">
											: Rp. <?echo number_format($value_bimbt);?>
										</td>
									</tr>
									<!--
									<tr>
										<td style="width:180px;">CEF Bangunan</td>
										<td style="width:250px;">
											<?echo $value_smf;?>
											 %
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai CEF Bangunan</td>
										<td style="width:250px;">
											<?echo number_format($value_lf);?>
										</td>
									</tr>
									-->
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">&nbsp;</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Total Fisik Agunan</td>
										<td style="width:250px;">
											: Rp. <?=number_format($_nilai_total_fisik_agunan)?>
										</td>
									</tr>
									<!--
									<tr>
										<td style="width:180px;">Nilai Total CEF Agunan</td>
										<td style="width:250px;">
											<?=number_format($_nilai_total_cef_agunan)?>
										</td>
									</tr>
									-->
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">
											Opini :
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?echo $value_op;?>
										</td>
									</tr>
								</table>
							</div>
					
						</td>
					</tr>
					
					<tr>
						<td valign="top" colspan="3"  width="100%" align="center">
							<?
								$off = "";
								$strsqlv02="SELECT * FROM appraisal_officer where col_id = '$theid' order by seq";
								//echo $strsqlv02;
								$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
								if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
								if(sqlsrv_has_rows($sqlconv02))
								{
									while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
									{
										$off = $rowsv02['officer_id'];
										$flag = $rowsv02['flag'];
							?>
									<div style="float:left;width:295px;height:120px;">
										</br>
										Officer <?=$x;?>
							<?php
//										$strsqlv01="SELECT * FROM appraisal_paramofficer where _appraiser_id = '$off'";
										$strsqlv01="SELECT user_id,user_name FROM tbl_se_user where user_id = '$off'";
										//echo $strsqlv01;
										$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
										if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlconv01))
										{
											while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
											{
												$id = $rowsv01['user_id'];
												$name = $rowsv01['user_name'];
																								
												$jvs = "javascript:klikSign('".$theid."')";
												$jvs2 = "javascript:klikUnSign('".$theid."')";
												
												if($flag == "")
												{
													if($off!="" && strtoupper($off) == strtoupper($userid))
													{
												    echo "</br>";
														echo '<input type="button" name="sign" id="sign" class="buttonsaveflow" onClick="'.$jvs.'" style="width:50%;" value="SIGN" />';
														echo '<br><br>';
														echo '<input type="button" name="unsign" id="unsign" onClick="'.$jvs2.'" style="width:50%;" value="NOT SIGN - ROLLBACK" />';
												    echo "</br><br>";
													}else{
												    echo "</br></br></br>";
														echo '<font style="color:red;font-weight:bold;">NOT SIGNED</font>';
												    echo "</br></br></br>";
													}
												}else if($flag == "S"){
												  echo "</br></br></br>";
													echo '<font style="color:green;font-weight:bold;">SIGNED</font>';
												  echo "</br></br></br>";
												}
												
												
												echo "<font style='font-weight:bold;'>".$name."</font>";
											}
										}
							?>
									</div>
							<?
									$x++;
									}
								}
							?>
						</td>
					</tr>
<?
				}else if($appjenis=="TAN")
				{
?>
					<tr>
						<td colspan="2" align="center">
						<?
							$col_id = $theid;
							
							require("../report/datapembanding/detail.php");	
							
						?>
						</td>
					</tr>
					<tr>
						<td style="width:50%" valign="top">
							<table class="tbl100">
								<tr>
									<td colspan="2"><h4>DATA TANAH</h4></td>
								</tr>
								<tr>
									<td style="width:300px;">Luas Tanah</td>
									<td  style="width:500px;">
										: <?php echo $v_luas_tnh;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Panjang Tanah</td>
									<td  style="width:500px;">
										: <?php echo $v_pan_tnh;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Lebar Tanah</td>
									<td  style="width:500px;">
										: <?php echo $v_leb_tnh;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Utara</td>
									<td  style="width:500px;">
										: <?php echo $v_utara;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Timur</td>
									<td  style="width:500px;">
										: <?php echo $v_timur;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Selatan</td>
									<td  style="width:500px;">
										: <?php echo $v_selatan;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Sisi Barat</td>
									<td  style="width:500px;">
										: <?php echo $v_barat;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Latitude</td>
									<td  style="width:500px;">
										: <?php echo $v_lat;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Longitude</td>
									<td  style="width:500px;">
										: <?php echo $v_long;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Notes</td>
									<td  style="width:500px;">
										: <?php echo $v_notes;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Opini</td>
									<td  style="width:500px;">
										: <?php echo $v_opini;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
							</table>
						</td>
						<td style="width:50%" valign="top">
							<div>
								<table class="tbl100">
									<tr>
										<td colspan="2"><h4>NILAI TANAH</h4></td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Tanah Per m<sup>2</sup></td>
										<td style="width:250px;">
											<?echo number_format($value_tnhpm);?>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Tanah Total</td>
										<td style="width:250px;">
											<?echo number_format($value_tnht);?>
										</td>
									</tr>
									<tr>
										<td style="width:180px;">CEF</td>
										<td style="width:250px;">
											<?echo $value_sm;?>
											 %
										</td>
									</tr>
									<tr>
										<td style="width:180px;">Nilai Likuidasi</td>
										<td style="width:250px;">
											<?echo number_format($value_lf);?>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											Opini
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?echo $value_op;?>
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td valign="top" colspan="2" width="100%" align="center">
							<?
								$off = "";
								$strsqlv02="SELECT * FROM appraisal_officer where col_id = '$theid'";
								$sqlconv02 = sqlsrv_query($conn, $strsqlv02);
								if ( $sqlconv02 === false)die( FormatErrors( sqlsrv_errors() ) );
								if(sqlsrv_has_rows($sqlconv02))
								{
									while($rowsv02 = sqlsrv_fetch_array($sqlconv02, SQLSRV_FETCH_ASSOC))
									{
										$off = $rowsv02['officer_id'];
										$flag = $rowsv02['flag'];
							?>
									<div style="float:left;width:295px;height:120px;">
										</br>
										Officer <?=$x;?>
							<?php
										//$strsqlv01="SELECT * FROM appraisal_paramofficer where _appraiser_id = '$off'";
										$strsqlv01="SELECT user_id,user_name FROM tbl_se_user where user_id = '$off'";
										//echo $strsqlv01;
										$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
										if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
										if(sqlsrv_has_rows($sqlconv01))
										{
											while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
											{
												$id = $rowsv01['user_id'];
												$name = $rowsv01['user_name'];
																								
												$jvs = "javascript:klikSign('".$theid."')";
												$jvs2 = "javascript:klikUnSign('".$theid."')";
												
												if($flag == "")
												{
													if($off!="" && strtoupper($off) == strtoupper($userid))
													{
												    echo "</br>";
														echo '<input type="button" name="sign" id="sign" class="buttonsaveflow" onClick="'.$jvs.'" style="width:50%;" value="SIGN" />';
														echo '<br><br>';
														echo '<input type="button" name="unsign" id="unsign" onClick="'.$jvs2.'" style="width:50%;" value="NOT SIGN - ROLLBACK" />';
												    echo "</br><br>";
													}else{
												    echo "</br></br></br>";
														echo '<font style="color:red;font-weight:bold;">NOT SIGNED</font>';
												    echo "</br></br></br>";
													}
												}else if($flag == "S"){
												  echo "</br></br></br>";
													echo '<font style="color:green;font-weight:bold;">SIGNED</font>';
												  echo "</br></br></br>";
												}
												
												
												echo "<font style='font-weight:bold;'>".$name."</font>";
											}
										}
							?>
									</div>
							<?
									$x++;
									}
								}
							?>
						</td>
					</tr>
<?
				}else{
?>
					<tr>
						<td style="width:50%" valign="top" rowspan="2">
							<table class="tbl100">
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
								<tr>
									<td style="width:300px;">&nbsp;</td>
									<td  style="width:500px;">
										&nbsp;
									</td>
								</tr>
							</table>
						</td>
						<td style="width:50%" valign="top">
							<div>
								<table class="tbl100">
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
									<tr>
										<td style="width:180px;">&nbsp;</td>
										<td style="width:250px;">
										</td>
									</tr>
								</table>
							</div>
						</td>
					</tr>
<?
				}
?>
				</table>
				<div>&nbsp;</div>
				<?
//					require ("../../requirepage/hiddenfield.php");
						if($userid != "")
						{
							if($v_jmlofficer == $v_jmlsign)
							{
								require ("../../requirepage/btnview.php");
							}
							require ("../../requirepage/hiddenfield.php");
						}
						require("../../requirepage/btnprint.php");
				?>
				<input type="hidden" id="theid" name="theid" />
				<input type="hidden" id="thecolid" name="thecolid" />
				<input type="hidden" id="thesignstatus" name="thesignstatus" />
		</form>

		
	</body>
</html>