<?
	
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
  require ("../../lib/open_con_dm_mysql.php");
	
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

  $custcif = "";
	$strsql="SELECT _custcif FROM appraisal_request WHERE _custnomid = '$custnomid'";
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
		{
			$custcif = $rows['_custcif'];
		}
	}

    $statusdoc="";
    $kondisistatusdoc = "";
		$strsqlv01="SELECT * FROM Tbl_DocCol WHERE doc_col_type = '$appjenis'";
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
		    $statusdoc .= $rowsv01['doc_id'] . ",";
        $kondisistatusdoc .= "doc_type='" . $rowsv01['doc_id'] . "' or ";
			}
		}

    if ($kondisistatusdoc != "")
    {
	     $kondisistatusdoc = "AND (" . substr($kondisistatusdoc,0,strlen($kondisistatusdoc)-3) . ")";
    } 

  $ipdm = "";
  $userdm = "";
	$strsql="select control_value from ms_control where control_code='IPDM'";
	//echo $strsql;
	$sqlcon = sqlsrv_query($conn, $strsql);
	if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlcon))
	{
		if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_NUMERIC))
		{
	 		$arrsplit=explode(",",$rows[0]);
	 		$ipdm = $arrsplit[0];
	 		$userdm = $arrsplit[1];
		}
	}
$key = $custcif . "_" . $custnomid;
$linkdmI = $ipdm. '/external_upload.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=upload&key=' . $key . '&dmstatusdoc=' . $statusdoc;
$linkdmA = $ipdm. '/external_view.php?dmuserid=' . $userdm . '&username=user&userpwd=ee11cbb19052e40b07aac0ca060c23ee&dmuserorganization=PRIVATE&thecabinet=eILk6fO0&dmbranchcode=' . $userbranch . '&act=cek&key=' . $key . '&dmstatusdoc=' . $statusdoc;
	
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
				$value_bimbpm = $rowsv01['_nilai_bang_imb_perm2'];
				$value_bimbt = $rowsv01['_nilai_bang_imb_total'];
				$value_tf = $rowsv01['_nilai_total_fisik'];
				$value_ti = $rowsv01['_nilai_total_imb'];
				$value_sm = $rowsv01['_safety_margin'];
				$value_lf = $rowsv01['_nilai_likuidasi_fisik'];
				$value_li = $rowsv01['_nilai_likuidasi_imb'];
				$value_bfp = $rowsv01['_nilai_bang_fisik_percent'];
				$value_bip = $rowsv01['_nilai_bang_imb_percent'];
				$value_smf = $rowsv01['_safety_margin_fisik'];
				$value_op = $rowsv01['_opini'];
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
		<script type="text/javascript" src="../../jquery/js/my.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function fnHitung() {
				var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('value_kend').value)))); //input ke dalam angka tanpa titik
				if (angka >= 1) {
				 var sf = document.getElementById('value_savety').value;
				 vsf = parseInt(angka)*parseInt(sf)/100;
				 hasil = parseInt(angka)-parseInt(vsf);
				 document.getElementById('value_likuidasi').value = tandaPemisahTitik(hasil);
				 return false; 
				}
			}
			function ntfHitung() {
				var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('value_tf').value)))); //input ke dalam angka tanpa titik
				if (angka >= 1) {
				 var sf = document.getElementById('value_smf').value;
				 vsf = parseInt(angka)*parseInt(sf)/100;
				 hasil = parseInt(angka)-parseInt(vsf);
				 document.getElementById('value_lf').value = tandaPemisahTitik(hasil);
				 return false; 
				}
			}
			function ntiHitung() {
				var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('value_ti').value)))); //input ke dalam angka tanpa titik
				if (angka >= 1) {
				 var sf = document.getElementById('value_sm').value;
				 vsf = parseInt(angka)*parseInt(sf)/100;
				 hasil = parseInt(angka)-parseInt(vsf);
				 document.getElementById('value_li').value = tandaPemisahTitik(hasil);
				 return false; 
				}
			}
			function nttHitung() {
				var angka = bersihPemisah(bersihPemisah(bersihPemisah(bersihPemisah(document.getElementById('value_tnht').value)))); //input ke dalam angka tanpa titik
				if (angka >= 1) {
				 var sf = document.getElementById('value_sm').value;
				 vsf = parseInt(angka)*parseInt(sf)/100;
				 hasil = parseInt(angka)-parseInt(vsf);
				 document.getElementById('value_lf').value = tandaPemisahTitik(hasil);
				 return false; 
				}
			}
			function changeform(theid)
			{
				document.frm.theid.value = theid;
				document.frm.action = "./appraisaldoc_view.php";
				document.frm.submit();
			}
			function savekendaraan(thecolid)
			{
				var vkend=$("#value_kend").val();
				var vsa=$("#value_savety").val();
				var vlik=$("#value_likuidasi").val();
				var vopi=$("#value_opini").val();
				
				if (vkend=="")
				{
					alert("Silahkan isi nilai kendaraan.");
					$("#value_kend").focus();
				}
				else if (vsa=="")
				{
					alert("Silahkan isi nilai safety.");
					$("#value_savety").focus();
				}
				else if (vlik=="")
				{
					alert("Silahkan isi nilai likuidasi.");
					$("#value_likuidasi").focus();
				}
				else if (vopi=="")
				{
					alert("Silahkan isi opini.");
					$("#value_opini").focus();
				}else{				
					document.frm.thecolid.value = thecolid;
					document.frm.action = "./appraisal_pkend.php";
					document.frm.submit();
				}
			}
			function savetnb(thecolid)
			{
				var vtpm=$("#value_tnhpm").val();
				var vtt=$("#value_tnht").val();
				var vlbf=$("#value_lbf").val();
				var vbfpm=$("#value_bfpm").val();
				var vbft=$("#value_bft").val();
				var vbimb=$("#value_bimb").val();
				var vbimbpm=$("#value_bimbpm").val();
				var vbimbt=$("#value_bimbt").val();
				var vtf=$("#value_tf").val();
				var vti=$("#value_ti").val();
				var vsm=$("#value_sm").val();
				var vlf=$("#value_lf").val();
				var vli=$("#value_li").val();
				var vbfp=$("#value_bfp").val();
				var vbip=$("#value_bip").val();
				var vsmf=$("#value_smf").val();
				var vopi=$("#value_op").val();			
				
				if (vtpm=="")
				{
					alert("Silahkan isi nilai tanah per meter.");
					$("#value_tnhpm").focus();
				}
				else if (vtt=="")
				{
					alert("Silahkan isi nilai tanah total.");
					$("#value_tnht").focus();
				}
				else if (vlbf=="")
				{
					alert("Silahkan isi nilai luas bangunan fisik.");
					$("#value_lbf").focus();
				}
				else if (vbfpm=="")
				{
					alert("Silahkan isi nilai bangunan fisik per meter.");
					$("#value_bfpm").focus();
				}
				else if (vbft=="")
				{
					alert("Silahkan isi nilai bangunan fisik total.");
					$("#value_bft").focus();
				}
				else if (vbimb=="")
				{
					alert("Silahkan isi nilai bangunan imb.");
					$("#value_bimb").focus();
				}
				else if (vbimbpm=="")
				{
					alert("Silahkan isi nilai bangunan imb per meter.");
					$("#value_bimbpm").focus();
				}
				else if (vbimbt=="")
				{
					alert("Silahkan isi nilai bangunan imb total.");
					$("#value_bimbt").focus();
				}
				else if (vtf=="")
				{
					alert("Silahkan isi nilai total fisik.");
					$("#value_tf").focus();
				}
				else if (vti=="")
				{
					alert("Silahkan isi nilai total imb.");
					$("#value_ti").focus();
				}
				else if (vsm=="")
				{
					alert("Silahkan isi nilai safety margin.");
					$("#value_sm").focus();
				}
				else if (vlf=="")
				{
					alert("Silahkan isi nilai likuidasi fisik.");
					$("#value_lf").focus();
				}
				else if (vli=="")
				{
					alert("Silahkan isi nilai likuidasi imb.");
					$("#value_li").focus();
				}
				else if (vbfp=="")
				{
					alert("Silahkan isi nilai bangunan fisik percent.");
					$("#value_bfp").focus();
				}
				else if (vbip=="")
				{
					alert("Silahkan isi nilai bangunan imb percent.");
					$("#value_lf").focus();
				}
				else if (vsmf=="")
				{
					alert("Silahkan isi nilai safety margin fisik.");
					$("#value_lf").focus();
				}
				else if (vopi=="")
				{
					alert("Silahkan isi opini.");
					$("#value_op").focus();
				}else{
					document.frm.thecolid.value = thecolid;
					document.frm.action = "./appraisal_ptnb.php";
					document.frm.submit();
				}
			}
			function savelnd(thecolid)
			{
				var vtpm=$("#value_tnhpm").val();
				var vtt=$("#value_tnht").val();
				var vsm=$("#value_sm").val();
				var vl=$("#value_lf").val();
				var vopi=$("#value_op").val();			
				
				if (vtpm=="")
				{
					alert("Silahkan isi nilai tanah per meter.");
					$("#value_tnhpm").focus();
				}
				else if (vtt=="")
				{
					alert("Silahkan isi nilai tanah total.");
					$("#value_tnht").focus();
				}
				else if (vsm=="")
				{
					alert("Silahkan isi nilai safety margin.");
					$("#value_sm").focus();
				}
				else if (vl=="")
				{
					alert("Silahkan isi nilai likuidasi.");
					$("#value_lf").focus();
				}
				else if (vopi=="")
				{
					alert("Silahkan isi opini.");
					$("#value_op").focus();
				}else{			
					document.frm.thecolid.value = thecolid;
					document.frm.action = "./appraisal_plnd.php";
					document.frm.submit();
				}
			}
			function uploadDocument(thelink)
			{
	        varwidth = 980;
	        varheight = 640;
	        varx = 0;
	        vary = 0;
          window.open(thelink,'lainnya','scrollbars=yes,width='+varwidth+',height='+varheight+',screenX='+varx+',screenY='+vary+',top='+varx+',left='+vary+',status=yes');
			}
		</script>
	</head>
	<body style="margin:0;">
		<!--<div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
		<br><br><br>-->
		<form id="frm" name="frm" method="post">
			<div class="divcenter">
				<table id="tblpreview" border="1" style ="width:900px; border-color:black;" align="center">
					<tr>
						<td colspan="2">
							<table>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>					
								<tr>
									<td>&nbsp;</td>
									<td><h3>STATUS UPLOAD DOCUMENT APPRAISAL (<? echo $custnomid ?>)</h3></td>
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
							require ("../../requirepage/hiddenfield.php");
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
						<td style="width:50%" valign="top" rowspan="2">
							<table class="tbl100">
								<tr>
									<td colspan="2"><h4>UPLOAD DOCUMENT KENDARAAN</h4></td>
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
										<td colspan="2"><h4><A HREF="javascript:uploadDocument('<? echo $linkdmA ?>')">DOCUMENT UPLOAD : KENDARAAN</A></h4></td>
									</tr>
<?
    $urut = 0;
		$strsqlv01="SELECT * FROM Tbl_DocCol WHERE doc_col_type = '$appjenis'";
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_NUMERIC))
			{
				$urut++;
        $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Document
	        	                WHERE doc_index3='$custnomid'
	        	                AND doc_type='$rowsv01[0]'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $countrows=$rowtemp[0];
	      $statusdoc = "";
	      if ($countrows > 0)
	      {
	      	$statusdoc = "<font color=red><b>DONE </b></font>";
	      }
?>
									<tr>
										<td style="width:20px;"><? echo $urut ?></td>
										<td><? echo $statusdoc ?><? echo $rowsv01[1] ?></td>
									</tr>
<?
			}
		}
?>
								</table>
							</div>
						</td>
					</tr>
<?
				}
				else if($appjenis=="BA1" || $appjenis=="RUK" || $appjenis=="KI2")
				{
?>
					<tr>
						<td style="width:50%" valign="top" rowspan="2">
							<table class="tbl100">
								<tr>
									<td colspan="2"><h4>DATA TANAH DAN BANGUNAN</h4></td>
								</tr>
								<tr>
									<td style="width:300px;">Type Jaminan</td>
									<td  style="width:500px;">
										: <?php echo $v_type;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Lokasi Rumah</td>
									<td  style="width:500px;">
										: <?php echo $v_lokasi;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Jumlah Lantai</td>
									<td  style="width:500px;">
										: <?php echo $v_jmllnt;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Luas Bangunan</td>
									<td  style="width:500px;">
										: <?php echo $v_luas_bang;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Luas Tanah</td>
									<td  style="width:500px;">
										: <?php echo $v_luas_tnh;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Arah Bangunan</td>
									<td  style="width:500px;">
										: <?php echo $v_arah_bang;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Umur Bangunan</td>
									<td  style="width:500px;">
										: <?php echo $v_umur_bang;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Tahun Dibangun</td>
									<td  style="width:500px;">
										: <?php echo $v_thn_bang;?>
									</td>
								</tr>
								<tr>
									<td style="width:300px;">Tahun Renovasi</td>
									<td  style="width:500px;">
										: <?php echo $v_thn_renov;?>
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
										<td colspan="2"><h4><A HREF="javascript:uploadDocument('<? echo $linkdmA ?>')">DOCUMENT UPLOAD : TANAH DAN BANGUNAN</A></h4></td>
									</tr>
<?
    $urut = 0;
		$strsqlv01="SELECT * FROM Tbl_DocCol WHERE doc_col_type = '$appjenis'";
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_NUMERIC))
			{
				$urut++;
        $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Document
	        	                WHERE doc_index3='$custnomid'
	        	                AND doc_type='$rowsv01[0]'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $countrows=$rowtemp[0];
	      $statusdoc = "";
	      if ($countrows > 0)
	      {
	      	$statusdoc = "<font color=red><b>DONE </b></font>";
	      }
?>
									<tr>
										<td style="width:20px;"><? echo $urut ?></td>
										<td><? echo $statusdoc ?><? echo $rowsv01[1] ?></td>
									</tr>
<?
			}
		}
?>
								</table>
							</div>
						</td>
					</tr>
<?
				}else if($appjenis=="TAN")
				{
?>
					<tr>
						<td style="width:50%" valign="top" rowspan="2">
							<table class="tbl100">
								<tr>
									<td colspan="2"><h4>UPLOAD DOCUMENT TANAH</h4></td>
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
										<td colspan="2"><h4><A HREF="javascript:uploadDocument('<? echo $linkdmA ?>')">DOCUMENT UPLOAD : TANAH</A></h4></td>
									</tr>
<?
    $urut = 0;
		$strsqlv01="SELECT * FROM Tbl_DocCol WHERE doc_col_type = '$appjenis'";
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_NUMERIC))
			{
				$urut++;
        $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Document
	        	                WHERE doc_index3='$custnomid'
	        	                AND doc_type='$rowsv01[0]'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $countrows=$rowtemp[0];
	      $statusdoc = "";
	      if ($countrows > 0)
	      {
	      	$statusdoc = "<font color=red><b>DONE </b></font>";
	      }
?>
									<tr>
										<td style="width:20px;"><? echo $urut ?></td>
										<td><? echo $statusdoc ?><? echo $rowsv01[1] ?></td>
									</tr>
<?
			}
		}
?>
								</table>
							</div>
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
						if($userid != "")
						{
						require ("../../requirepage/btnview.php");
						require ("../../requirepage/hiddenfield.php");
						}
						require("../../requirepage/btnprint.php");
				?>
				<input type="hidden" id="theid" name="theid" />
				<input type="hidden" id="thecolid" name="thecolid" />
		</form>
	</body>
</html>