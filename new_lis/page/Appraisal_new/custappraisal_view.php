<?
	
	require ("../../lib/open_con.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	//echo $_POST['theid'];
	
	if($custnomid != "")
	{
		$strsqlv01="SELECT * FROM appraisal_custmaster WHERE _custnomid = '$custnomid'";
		//echo $strsqlv01;
		$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
		if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlconv01))
		{
			if($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
			{
				$_name = $rowsv01['_cust_name'];
				$_alamat = $rowsv01['_cust_addr'];
				$_kelurahan = $rowsv01['_cust_kelurahan'];
				$_kecamatan = $rowsv01['_cust_kecamatan'];
				$_kota = $rowsv01['_cust_kota'];
				$_provinsi = $rowsv01['_cust_propinsi'];
				$_kd_pos = $rowsv01['_cust_kodepos'];
				$_tlp = $rowsv01['_cust_telp1'];
				$_hp = $rowsv01['_cust_hp1'];
				$_hp2 = $rowsv01['_cust_hp2'];
				$_email = $rowsv01['_cust_email1'];
				$_ot1 = $rowsv01['_cust_orangterdekat1'];
				$_ot2 = $rowsv01['_cust_orangterdekat2'];
				$_norek = $rowsv01['_cust_norek'];
				$_custcif = $rowsv01['_cust_cif'];
				$_custlistid = $rowsv01['_cust_lisid'];
				$_custlistype = $rowsv01['_cust_listype'];
				$_cust_appraiser_id = $rowsv01['_cust_appraiser_id'];
			}
		}
	}
?>
<html>
	<head>
		<title>Appraisal</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
	</head>
	<body style="margin:0;">
		<!--<div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
		<br><br><br>-->
		<form id="frm" name="frm" method="post">
			<div class="divcenter">
				<table border="1" style ="width:900px; border-color:black;" align="center" id="preview2">
					<tr>
						<td align="center" colspan="2" style="font-size:14pt;height:70px;">CUSTOMER APPRAISAL</td>
					</tr>
					<tr>
						<td width="50%">
							<table border="0" style="margin:10px 5px;">
								<tr>
									<td style="width:30%;">Customer ID</td>
									<td>&nbsp;</td>
									<td style="width:70%;">
										: <?php echo $custnomid?>
									</td>
								</tr>
								<tr>
									<td style="width:20%;">Customer CIF</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										: <?php echo $_custcif?>
									</td>
								</tr>
								<tr>
									<td style="width:20%;">Customer LIS Type</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										: <?php echo $_custlistype?>
									</td>
								</tr>
								<tr>
									<td style="width:20%;">Nama</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										: <?php echo $_name?>
									</td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_alamat?>
									</td>
								</tr>
								<tr>
									<td>Kelurahan</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_kelurahan?>
									</td>
								</tr>
								<tr>
									<td>Kecamatan</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_kecamatan?>
									</td>
								</tr>
								<tr>
									<td>Kota</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_kota?>
									</td>
								</tr>
								<tr>
									<td>Provinsi</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_provinsi?>
									</td>
								</tr>
								<tr>
									<td>Kode pos</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_kd_pos?>
									</td>
								</tr>
								<tr>
									<td>Telepon</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_tlp?>
									</td>
								</tr>
								<tr>
									<td>Handphone</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_hp?>
									</td>
								</tr>
							</table>
						</td>
						<td width="50%;" valign="top">
							<table border="0" style="margin:10px 5px;">
								
								<tr>
									<td>Yang dapat dihubungi</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_ot1?>
									</td>
								</tr>
								<tr>
									<td>Handphone</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_hp2?>
									</td>
								</tr>
								<tr>
									<td style="width:30%;">Email</td>
									<td>&nbsp;</td>
									<td style="width:70%;">
										: <?php echo $_email?>
									</td>
								</tr>
								
								<!--
								<tr>
									<td>Orang Terdekat 2</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_ot2?>
									</td>
								</tr>
								<tr>
									<td>Nomer Rekening</td>
									<td>&nbsp;</td>
									<td>
										: <?php echo $_norek?>
									</td>
								</tr>
								!-->
								<tr>
									<td style="width:20%;">Appraiser ID</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										: <?php echo $_cust_appraiser_id?>
									</td>
								</tr>
							</table>
						</td>
					</td>
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
		</form>
	</body>
</html>