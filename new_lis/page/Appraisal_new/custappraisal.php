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
	if ($_cust_appraiser_id == "")
	{
		$_cust_appraiser_id = "indrasan";
	}
?>
<html>
	<head>
		<title>Appraisal</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			function save()
			{
				var aname=$("#name").val();
				var aalamat=$("#address").val();
				var akelurahan=$("#txtkel").val();
				var akecamatan=$("#txtkec").val();
				var akota=$("#txtkota").val();
				var aprovinsi=$("#txtpro").val();
				var akdpos=$("#zipcode").val();
				var atlp=$("#txttlp").val();
				var ahp1=$("#txthp").val();
				var aemail=$("#txtemail").val();
				var aot1=$("#txtot1").val();
				var acustcif=$("#txtcustcif").val();		
				var acustlistype=$("#acustlistype").val();		
				var acustappraiserid=$("#txtcustappraiserid").val();		
				
				if (aname=="")
				{
					alert("Silahkan isi nama.");
					$("#name").focus();
				}
				else if (aalamat=="")
				{
					alert("Silahkan isi alamat.");
					$("#address").focus();
				}
				else if (akelurahan=="")
				{
					alert("Silahkan isi kelurahan.");
					$("#txtkel").focus();
				}
				else if (akecamatan=="")
				{
					alert("Silahkan isi kecamatan.");
					$("#txtkec").focus();
				}
				else if (akota=="")
				{
					alert("Silahkan isi kota.");
					$("#txtkota").focus();
				}
				else if (aprovinsi=="")
				{
					alert("Silahkan isi provinsi.");
					$("#txtpro").focus();
				}
				else if (akdpos=="")
				{
					alert("Silahkan isi kodepos.");
					$("#zipcode").focus();
				}
				else if (atlp=="")
				{
					alert("Silahkan isi telepon.");
					$("#txttlp").focus();
				}
				else if (ahp1=="")
				{
					alert("Silahkan isi handphone.");
					$("#txthp").focus();
				}
				/*
				else if (aemail=="")
				{
					alert("Silahkan isi email.");
					$("#txtemail").focus();
				}
				*/
				else if (aot1=="")
				{
					alert("Silahkan isi orang terdekat.");
					$("#txtot1").focus();
				}else{
					document.frm.action = "./custappraisal_p.php";
					document.frm.submit();
				}
			}
		</script>
	</head>
	<body style="margin:0;">
		<div style="padding:0px;margin:0px;"><img src="../../images/header_lis2.jpg"></img></div>
		<br><br><br>
		<form id="frm" name="frm" method="post">
			<div class="divcenter">
				<table border="1" style ="width:900px; border-color:black;" align="center" id="tblform">
					<tr>
						<td align="center" colspan="2" style="font-size:14pt;height:70px;">ENTRY APPRAISAL</td>
					</tr>
					<tr>
						<td width="50%">
							<table border="0" style="margin:10px 5px;">
								<tr>
									<td style="width:30%;">Customer ID</td>
									<td>&nbsp;</td>
									<td style="width:70%;">
										<input type="text" id="custnomid" name="custnomid" alt="Customer ID" maxlength="50" value="<?php echo $custnomid?>" style="width:100%; background-color:#ffff00;"/>
									</td>
								</tr>
								<tr>
									<td style="width:20%;">Customer CIF</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										<input type="text" id="txtcustcif" name="txtcustcif" alt="Customer CIF" maxlength="50" value="<?php echo $_custcif?>" style="width:100%; background-color:#ffff00;"/>
									</td>
								</tr>
								<tr>
									<td style="width:20%;">Customer LIS Type</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										<input type="text" id="txtcustlistype" name="txtcustlistype" alt="Customer LIS ID" maxlength="50" value="<?php echo $_custlistype?>" style="width:100%; background-color:#ffff00;"/>
									</td>
								</tr>
								<tr>
									<td style="width:20%;">Nama</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										<input type="text" id="name" name="name" alt="Nama" maxlength="50" value="<?php echo $_name?>" style="width:100%; background-color:#ffff00;"/>
									</td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td>&nbsp;</td>
									<td>
										<input type="text" id="address" name="address" alt="Address" maxlength="100" value="<?php echo $_alamat?>" style="width:100%; background-color:#ffff00;"/>
									</td>
								</tr>
								<tr>
									<td>Kelurahan</td>
									<td>&nbsp;</td>
									<td>
										<input id="txtkel" name="txtkel" alt="txtkel" type="text" maxlength="30" value="<?php echo $_kelurahan?>" style="width:100%;background-color:#ffff00;" />
									</td>
								</tr>
								<tr>
									<td>Kecamatan</td>
									<td>&nbsp;</td>
									<td>
										<input id="txtkec" name="txtkec" alt="txtkec" type="text" maxlength="30" value="<?php echo $_kecamatan?>" style="width:100%;background-color:#ffff00;" />
									</td>
								</tr>
								<tr>
									<td>Kota</td>
									<td>&nbsp;</td>
									<td>
										<input id="txtkota" name="txtkota" alt="Kota" type="text" maxlength="50" value="<?php echo $_kota?>" style="width:100%; background-color:#ffff00;" />
									</td>
								</tr>
								<tr>
									<td>Provinsi</td>
									<td>&nbsp;</td>
									<td>
										<input id="txtpro" name="txtpro" alt="Provinsi" type="text" maxlength="30" value="<?php echo $_provinsi?>" style="width:100%; background-color:#ffff00;" />
									</td>
								</tr>
								<tr>
									<td>Kode pos</td>
									<td>&nbsp;</td>
									<td>
										<input id="zipcode" name="zipcode" alt="Kode Pos" type="text" maxlength="5" value="<?php echo $_kd_pos?>" onkeypress="return isNumberKey(event)" style="width:100%; background-color:#ffff00;" />
									</td>
								</tr>
								
								<tr>
									<td>Telepon</td>
									<td>&nbsp;</td>
									<td>
										<input id="txttlp" name="txttlp" alt="Telepon" type="text" maxlength="14" value="<?php echo $_tlp?>" onkeypress="return isNumberKey(event)" style="width:100%; background-color:#ffff00;" />
									</td>
								</tr>
								<tr>
									<td>Handphone</td>
									<td>&nbsp;</td>
									<td>
										<input id="txthp" name="txthp" alt="Handphone" type="text" maxlength="14" value="<?php echo $_hp?>" onkeypress="return isNumberKey(event)" style="width:100%; background-color:#ffff00;" />
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
										<input id="txtot1" name="txtot1" alt="txtot1" type="text" maxlength="30" value="<?php echo $_ot1?>" style="width:100%;background-color:#ffff00;" />
									</td>
								</tr>
								
								<tr>
									<td>Handphone</td>
									<td>&nbsp;</td>
									<td>
										<input id="txthp2" name="txthp2" alt="Handphone" type="text" maxlength="14" value="<?php echo $_hp2?>" onkeypress="return isNumberKey(event)" style="width:100%; background-color:#ffffff;" />
									</td>
								</tr>
								<tr>
									<td style="width:30%;">Email</td>
									<td>&nbsp;</td>
									<td style="width:70%;">
										<input type="text" id="txtemail" name="txtemail" alt="Email" maxlength="100" value="<?php echo $_email?>" style="width:100%; background-color:#ffffff;"/>
									</td>
								</tr>
								
								<!--
								<tr>
									<td>Orang Terdekat 2</td>
									<td>&nbsp;</td>
									<td>
										<input id="txtot2" name="txtot2" alt="txtot2" type="text" maxlength="30" value="<?php echo $_ot2?>" style="width:100%; background-color:#ffffff;" />
									</td>
								</tr>
								-->
								
								<tr>
									<td style="width:20%;">Appraiser ID</td>
									<td>&nbsp;</td>
									<td style="width:80%;">
										<input type="text" id="txtcustappraiserid" name="txtcustappraiserid" alt="Customer Appraiser ID" maxlength="50" readonly=readonly value="<?php echo $_cust_appraiser_id?>" style="width:100%; background-color:#ffff00;"/>
									</td>
								</tr>
							</table>
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