	<div align=center>
		<TABLE cellPadding=5 width="700" border=1>
			<TR>
				<?
					$lndcol_addr1 = "";
					$lndcol_addr2 = "";
					$lndcol_addr3 = "";
					$lndcol_kodepos = "";
					$lndcol_certtype = "";
					$lndcol_certno = "";
					$lndcol_certatasnama = "";
					$lndcol_luastanah = "";
					$lndcol_certdate = "";
					$lndcol_certdue = "";
					$lndcol_relcode = "";
					$lndcol_haktanggungan = "";
					$lndcol_haktanggungantgl = "";
					$lndcol_identification = "";
					$lndcol_njopyear = "";
					$lndcol_njopval = "";
					$lndcol_remark = "";
					$lndcol_gssuno = "";
					$lndcol_gssutgl = "";
					
					$bldcol_addr1 = "";
					$bldcol_addr2 = "";
					$bldcol_addr3 = "";
					$bldcol_kodepos = "";
					$bldcol_type = "RMH";
					$bldcol_imbno = "";
					$bldcol_imbdate = "";
					$bldcol_imbluas = "";
					$bldcol_njopyear = "";
					$bldcol_njopval = "";
					$bldcol_devname = "";
					
					$tsqlbuilding = "SELECT * FROM tbl_COL_Building where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";

					$abuilding= sqlsrv_query($conn, $tsqlbuilding);

					if ( $abuilding === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($abuilding))
					{  
						if($rowbuilding = sqlsrv_fetch_array($abuilding, SQLSRV_FETCH_ASSOC))
						{
							$bldcol_addr1 = $rowbuilding['col_addr1'];
							$bldcol_addr2 = $rowbuilding['col_addr2'];
							$bldcol_addr3 = $rowbuilding['col_addr3'];
							$bldcol_kodepos = $rowbuilding['col_kodepos'];
							$bldcol_type = $rowbuilding['col_type'];
							$bldcol_imbno = $rowbuilding['col_imbno'];
							$bldcol_imbdate = $rowbuilding['col_imbdate']->format('Y/m/d');
							$bldcol_imbluas = $rowbuilding['col_imbluas'];
							$bldcol_njopyear = $rowbuilding['col_njopyear'];
							$bldcol_njopval = $rowbuilding['col_njopval'];
							$bldcol_devname = $rowbuilding['col_devname'];
						}
					}
					
					$tsqlland = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";

					$aland= sqlsrv_query($conn, $tsqlland);

					if ( $aland === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($aland))
					{  
						if($rowland = sqlsrv_fetch_array($aland, SQLSRV_FETCH_ASSOC))
						{ 
							$lndcol_addr1 = $rowland['col_addr1'];
							$lndcol_addr2 = $rowland['col_addr2'];
							$lndcol_addr3 = $rowland['col_addr3'];
							$lndcol_kodepos = $rowland['col_kodepos'];
							$lndcol_certtype = $rowland['col_certtype'];
							$lndcol_certno = $rowland['col_certno'];
							$lndcol_certatasnama = $rowland['col_certatasnama'];
							$lndcol_luastanah = $rowland['col_certluas'];
							$lndcol_certdate = $rowland['col_certdate']->format('Y/m/d');
							$lndcol_certdue = $rowland['col_certdue']->format('Y/m/d');
							$lndcol_relcode = $rowland['col_relcode'];
							$lndcol_haktanggungan = $rowland['col_haktanggungan'];
							$lndcol_haktanggungantgl = $rowland['col_haktanggungantgl']->format('Y/m/d');
							$lndcol_identification = $rowland['col_identification'];
							$lndcol_njopyear = $rowland['col_njopyear'];
							$lndcol_njopval = $rowland['col_njopval'];
							$lndcol_remark = $rowland['col_remark'];
							$lndcol_gssuno = $rowland['col_gssuno'];
							$lndcol_gssutgl = $rowland['col_gssutgl']->format('Y/m/d');
						}
					}
				?>
				<TD align=left valign=top>
<?//----------------------------------------------------------------------------------------------------------------- Tanah dan Bangunan ?>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
						<tr>
							<td width=100% align=center valign=top>
								<font face=Arial size=2><b>TANAH DAN BANGUNAN</b></font>
							</td>
						</tr>
					</TABLE>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
								<?//--------------------------------- Tanah?>
									<tr>
										<td width=100% align=left valign=top>
											&nbsp;
										</td>
									</tr>
									<tr>
										<td colspan="2" align="left" valign="top"><strong>TANAH</strong></td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Alamat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_addr1 name=lndbldcol_addr1 size=50 maxlength=50 value='<? echo $lndcol_addr1; ?>'  nai="ALAMAT (TANAH) TANAH DAN BANGUNGAN " style="background:#FF0">
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Kelurahan / Kecamatan &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_addr2 name=lndbldcol_addr2 size=50 maxlength=50 value='<? echo $lndcol_addr2; ?>' nai="ALAMAT CALON DEBITUR TANAH DAN BANGUNGAN ">
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Kota / Kabupaten &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_addr3 name=lndbldcol_addr3 size=50 maxlength=50 value='<? echo $lndcol_addr3; ?>' nai="ADDRESS 3 TANAH DAN BANGUNGAN ">
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											Kodepos
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_kodepos name=lndbldcol_kodepos size=20 maxlength=5 value='<? echo $lndcol_kodepos; ?>' nai="KODE POS TANAH DAN BANGUNGAN " style="background:#FF0" onKeyPress="return isNumberKey(event)">
										</td>
									</tr>
									
									<input type="hidden" naizip="naizip" id="in_zipcodelndbld" name="Kode Pos Land (Building) " value="lndbldcol_kodepos|lndbldcol_kelurahan|tarkecamatan"/>
									
									<?php
										 $tsql = "SELECT * FROM RFCERTTYPE";
											$a = sqlsrv_query($conn, $tsql);

											  if ( $a === false)
											  die( FormatErrors( sqlsrv_errors() ) );

										   if(sqlsrv_has_rows($a))
										   { 
										   
										?>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Tipe Sertifikat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<select id=lndbldcol_certtype name=lndbldcol_certtype  nai="TIPE SERTIFIKAT TANAH DAN BANGUNAN " style="background:#FF0" onchange="CheckCert()">
											<option value="" selected="selected">- Tipe Sertifikat -</option>
											
											<?
												While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
												{
													$varselected = "";
													if($lndcol_certtype == $rowType["CERTTYPE_ID"])
													{
														$varselected = "selected";
													}
											?>
											<option value="<? echo $rowType["CERTTYPE_ID"]; ?>"<? echo $varselected; ?>><? echo $rowType["CERTTYPE_DESC"];?></option>
											<?
												}
											?>
											</select>
										</td>
									</tr>
										<?
											}
										?>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Nomor Sertifikat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_certno name=lndbldcol_certno size=50 maxlength=50 value='<? echo $lndcol_certno; ?>' nai="NOMOR SERTIFIKAT TANAH DAN BANGUNAN " style="background:#FF0"  onBlur="fujiebldcertno()" > <span  id="reinabldcertno"></span>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_certdate name=lndbldcol_certdate size=20 maxlength=10 value='<? echo $lndcol_certdate; ?>' nai="TANGGAL TERBIT SERTIFIKAT TANAH DAN BANGUNAN " style="background:#FF0" readonly=readonly>
															  <a href="javascript:NewCssCal('lndbldcol_certdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
										  <font face=Arial size=2 color=blue></font>
										</td>
									</tr>
									<tr>
									   <td width=30% align=left valign=top>
										  <font face=Arial size=2>Nomor GS/SU &nbsp;</font>
									   </td>
									   <td width=70% align=left valign=top>
										  <input type=text id=lndbldcol_gssuno name=lndbldcol_gssuno size=50 maxlength=50 value='<? echo $lndcol_gssuno; ?>' nai="NOMOR GS/SU " style="background:#FF0">
									   </td>
									</tr>
									<tr>
									   <td width=30% align=left valign=top>
										  <font face=Arial size=2>Tanggal GS/SU &nbsp;</font>
									   </td>
									   <td width=70% align=left valign=top>
										  <input type=text id=lndbldcol_gssutgl name=lndbldcol_gssutgl size=20 maxlength=10 value='<? echo $lndcol_gssutgl; ?>' readonly=readonly nai="TANGGAL GS/SU " style="background:#FF0">
															  <a href="javascript:NewCssCal('lndbldcol_gssutgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
										  <font face=Arial size=2 color=blue></font>
									   </td>
									</tr>
									<Script Language="JavaScript">
										function CheckCert()
										{
											//alert(document.formentry.lndcol_certtype.value);
											if(document.formentry.lndbldcol_certtype.value=="SHGB")
											{
												document.formentry.lndbldcol_certdue.style.backgroundColor="#FF0";
											}
											else
											{
												document.formentry.lndbldcol_certdue.style.backgroundColor="";								
											}
										}
									</Script>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_certdue name=lndbldcol_certdue size=20 maxlength=10 value='<? echo $lndcol_certdue; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO SERTIFIKAT">
															  <a href="javascript:NewCssCal('lndbldcol_certdue','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_certatasnama name=lndbldcol_certatasnama size=50 maxlength=50 value='<? echo $lndcol_certatasnama; ?>' nai="PEMEGANG HAK ATAS SERTIFIKAT TANAH DAN BANGUNAN " style="background:#FF0">
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Luas Tanah &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_luastanah name=lndbldcol_luastanah size=20 maxlength=8 value='<? echo $lndcol_luastanah; ?>' nai="LUAS TANAH DAN BANGUNAN " style="background:#FF0" onKeyPress="return isNumberKey(event)" > m2
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
									<?php
										$tsql = "SELECT * FROM RFRELATION WHERE ACTIVE = 'True'";
										$a = sqlsrv_query($conn, $tsql);

										  if ( $a === false)
										  die( FormatErrors( sqlsrv_errors() ) );

										if(sqlsrv_has_rows($a))
										{ 
										   
									?>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Kode Relasi &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
										<select id=lndbldcol_relcode name=lndbldcol_relcode  nai="RELCODE TANAH DAN BANGUNAN " style="background:#FF0" onchange="changedeveloper('lndbldcol');">
											<option value="" selected="selected">- Tipe Relasi -</option>
											
											<?
												While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
												{
													$varselected = "";
													if($lndcol_relcode == $rowType["REL_CODE"])
													{
														$varselected = "selected";
													}
											?>
											<option value="<? echo $rowType["REL_CODE"]; ?>" <? echo $varselected; ?>><? echo $rowType["REL_DESC"];?></option>
											<?
												}
											?>
										</select>
										</td>
									</tr>
									<?
										}
								$vh = "visibility:hidden;";
								$sc = "background:#fff";
								if($lndcol_relcode=="DVL")
								{
									$vh = "visibility:visible;";
									$sc = "background:#FF0";
								}
?>
									<tr style="<?php echo $vh;?>" id="bldcol_devname">
									   <td width=30% align=left valign=top>
										  <font face=Arial size=2>Nama Developer &nbsp;</font>
									   </td>
									   <td width=70% align=left valign=top>
										  <input type=text id=bldcol_devname name=bldcol_devname size=50 maxlength=50 style="<?php echo $sc;?>" nai="NAMA DEVELOPER " value='<? echo $bldcol_devname; ?>'>
									   </td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Nomor Hak Tanggungan &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_haktanggungan name=lndbldcol_haktanggungan size=50 maxlength=50 nai="NOMOR HAK TANGGUNGAN TANAH DAN BANGUNAN " value='<? echo $lndcol_haktanggungan; ?>'>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Tanggal Hak Tanggungan &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_haktanggungantgl name=lndbldcol_haktanggungantgl size=20 maxlength=10 value='<? echo $lndcol_haktanggungantgl; ?>' nai="TANGGAL HAK TANGGUNGAN TANAH DAN BANGUNAN " readonly=readonly>
															  <a href="javascript:NewCssCal('lndbldcol_haktanggungantgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
<!--
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>NJOP Year &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_njopyear name=lndbldcol_njopyear size=20 maxlength=4 value='<? echo $lndcol_njopyear; ?>' nai="NJOPYEAR (TANAH) TANAH DAN BANGUNAN " style="background:#FF0" onKeyPress="return isNumberKey(event)" >
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>NJOP Value &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_njopval name=lndbldcol_njopval size=20 maxlength=20 value='<? echo numberFormat($lndcol_njopval); ?>' onKeyUp="outputMoney('lndbldcol_njopval')" nai="NJOPVAL (TANAH) TANAH DAN BANGUNAN " style="background:#FF0" onKeyPress="return isNumberKey(event)" >
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
-->
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Keterangan &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=lndbldcol_remark name=lndbldcol_remark size=50 maxlength=250 value='<? echo $lndcol_remark; ?>' nai="REMARK TANAH DAN BANGUNAN " >
										</td>
									</tr>
									<?//--------------------------------- Bangunan?>
									<tr>
										<td colspan="2" align="left" valign="top">&nbsp</td>
									</tr>
									<tr>
										<td colspan="2" align="left" valign="top"><strong>BANGUNAN</strong></td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Application Number &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldap_lisregno name=bldap_lisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>'  style="background:#FF0" readonly=readonly>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Collateral ID &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_id name=bldcol_id size=20 maxlength=20  value='<? echo $col_id; ?>' style="background:#FF0" readonly=readonly>
										</td>
									</tr>
									<!--
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Alamat &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_addr1 name=bldcol_addr1 size=50 maxlength=50 value='<? echo $bldcol_addr1; ?>' nai="ALAMAT TANAH DAN BANGUNGAN " style="background:#FF0">
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Kelurahan / Kecamatan &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_addr2 name=bldcol_addr2 size=50 maxlength=50 value='<? echo $bldcol_addr2; ?>' nai="ADDRESS 2 TANAH DAN BANGUNGAN " >
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Kota / Kabupaten &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_addr3 name=bldcol_addr3 size=50 maxlength=50 value='<? echo $bldcol_addr3; ?>' nai="ADDRESS 3 TANAH DAN BANGUNGAN " >
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											 Kodepos
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_kodepos name=bldcol_kodepos size=20 maxlength=5 value='<? echo $bldcol_kodepos; ?>' nai="KODE POS TANAH DAN BANGUNGAN " style="background:#FF0" onKeyPress="return isNumberKey(event)">
										</td>
									</tr>
									-->
									
									<input type="hidden" naizip="naizip" id="in_zipcodebld" name="Kode Pos Building " value="bldcol_kodepos|bldcol_kelurahan|tarkecamatan"/>
									
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Tipe Collateral &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<select id=bldcol_type name=bldcol_type value='<? echo $bldcol_type; ?>'  nai="TIPE COLLATERAL TANAH DAN BANGUNGAN " style="background:#FF0">
												<option value="" selected="selected">- Tipe Collateral -</option>
												<?
													if($bldcol_type == "RMH")
													{
														$varselected = "selected";
													}
												?>
												<option value="RMH" <? echo $varselected; ?>>Tanah dan Bangunan</option>
											</select>
										</td>
									</tr>
									<?php
										$tsql = "SELECT * FROM RFIDENTIFICATION WHERE ACTIVE = 'True'";
										$a = sqlsrv_query($conn, $tsql);

										  if ( $a === false)
										  die( FormatErrors( sqlsrv_errors() ) );

										if(sqlsrv_has_rows($a))
										{ 
										   
									?>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Identifikasi &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<select id=lndbldcol_identification name=lndbldcol_identification  nai="IDENTIFICATION TANAH DAN BANGUNAN " style="background:#FF0">
												<option value="" selected="selected">- Tipe Identifikasi -</option>
												
												<?
													While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
													{		
														$varselected = "";
														if($lndcol_identification == $rowType["IDTF_CODE"])
														{
															$varselected = "selected";
														}
												?>
												<option value="<? echo $rowType["IDTF_CODE"]; ?>" <? echo $varselected; ?>><? echo $rowType["IDTF_DESC"];?></option>
												<?
													}
												?>
											</select>
										</td>
									</tr>
									<?
										}
									?>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Nomor IMB &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_imbno name=bldcol_imbno size=50 maxlength=50 value='<? echo $bldcol_imbno; ?>'  nai="IMB NO TANAH DAN BANGUNGAN " style="background:#FFFFFF" onBlur="fujiebldimb()"> <span  id="reinabldimb"></span>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Tanggal IMB &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_imbdate name=bldcol_imbdate size=20 maxlength=10 value='<? echo $bldcol_imbdate; ?>' nai="IMB DATE TANAH DAN BANGUNGAN " style="background:#FFFFFF" readonly=readonly>
		   		    						<a href="javascript:NewCssCal('bldcol_imbdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>Luas IMB &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_imbluas name=bldcol_imbluas size=20 maxlength=8 value='<? echo $bldcol_imbluas; ?>' nai="IMB LUAS TANAH DAN BANGUNGAN " style="background:#FFFFFF">
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
<!--
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>NJOP Year &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_njopyear name=bldcol_njopyear size=20 maxlength=4 value='<? echo $bldcol_njopyear; ?>' onKeyPress="return isNumberKey(event)" nai="NJOPYEAR (BANGUNAN) TANAH DAN BANGUNGAN " style="background:#FF0">
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>
									<tr>
										<td width=30% align=left valign=top>
											<font face=Arial size=2>NJOP Value &nbsp;</font>
										</td>
										<td width=70% align=left valign=top>
											<input type=text id=bldcol_njopval name=bldcol_njopval size=20 maxlength=20 value='<? echo numberFormat($bldcol_njopval); ?>' onKeyUp="outputMoney('bldcol_njopval')" onKeyPress="return isNumberKey(event)" nai="NJOPVAL (BANGUNAN) TANAH DAN BANGUNGAN " style="background:#FF0">
											<font face=Arial size=2 color=blue></font>
										</td>
									</tr>	
-->
					</TABLE>
					<input type=hidden id=bldcol_njopyear name=bldcol_njopyear value='<? echo $bldcol_njopyear; ?>'>
					<input type=hidden id=bldcol_njopval name=bldcol_njopval value='<? echo numberFormat($bldcol_njopval); ?>'>
					<input type=hidden id=lndbldcol_njopyear name=lndbldcol_njopyear value='<? echo $lndcol_njopyear; ?>'>
					<input type=hidden id=lndbldcol_njopval name=lndbldcol_njopval value='<? echo numberFormat($lndcol_njopval); ?>'>
				</TD>
			</TR>
		</TABLE>
     </div>