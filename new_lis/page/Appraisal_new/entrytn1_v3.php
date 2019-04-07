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
					$lndcol_devname = "";
					
					$tsqlcash = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					$acash = sqlsrv_query($conn, $tsqlcash);
					if ( $acash === false)
						die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($acash))
					{  
						if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
						{ 
							$lndcol_njopval = $rowcash['nilai_col'];
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
							$lndcol_certdate = $rowland['col_certdate']->format('Y/m/d');;
							$lndcol_certdue = $rowland['col_certdue']->format('Y/m/d');;
							$lndcol_relcode = $rowland['col_relcode'];
							$lndcol_haktanggungan = $rowland['col_haktanggungan'];
							$lndcol_haktanggungantgl = $rowland['col_haktanggungantgl']->format('Y/m/d');;
							$lndcol_identification = $rowland['col_identification'];
							$lndcol_njopyear = $rowland['col_njopyear'];
							$lndcol_njopval = $rowland['col_njopval'];
							$lndcol_remark = $rowland['col_remark'];
							$lndcol_devname = $rowland['col_devname'];
						}
					}
				
				?>
				<TD align=left valign=top>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=100% align=center valign=top>
								<font face=Arial size=2><b><?=$type_name;?></b></font>
							</td>
   	                    </tr>
						<tr>
							<td width=100% align=left valign=top>
								&nbsp;
							</td>
   	                    </tr>						
					</TABLE>
					
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Application Number &nbsp</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=lndap_lisregno name=lndap_lisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly  style="background:#FF0">
							</td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Collateral ID &nbsp</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=lndcol_id name=lndcol_id size=20 maxlength=20 value='<? echo $col_id; ?>' readonly=readonly style="background:#FF0"> 
							</td>
   	                    </tr>
						<tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Alamat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_addr1 name=lndcol_addr1 size=50 maxlength=50 value='<? echo $lndcol_addr1; ?>' nai="ALAMAT TANAH " style="background:#FF0">
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Kelurahan / Kecamatan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_addr2 name=lndcol_addr2 size=50 maxlength=50 value='<? echo $lndcol_addr2; ?>' nai="ALAMAT CALON DEBITUR TANAH ">
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Kota / Kabupaten &nbsp;</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_addr3 name=lndcol_addr3 size=50 maxlength=50 value='<? echo $lndcol_addr3; ?>' nai="ALAMAT 3 TANAH ">
							</td>
   	                    </tr>
						
   	                    <tr>
							<td width=20% align=left valign=top>
								Kodepos
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_kodepos name=lndcol_kodepos size=20 maxlength=5 value='<? echo $lndcol_kodepos; ?>' nai="KODE POS TANAH " style="background:#FF0"  onKeyPress="return isNumberKey(event)">
								<!--<input type=text id=lndcol_kelurahan name=lndcol_kelurahan size=20 maxlength=5 value=''  >-->
							</td>
   	                    </tr>
						
						<input type="hidden" naizip="naizip" id="in_zipcodelnd" name="Kode Pos Land " value="lndcol_kodepos|lndcol_kelurahan|tarkecamatan"/>
									
						<?php
							 $tsql = "SELECT * FROM RFCERTTYPE";
								$a = sqlsrv_query($conn, $tsql);

								  if ( $a === false)
								  die( FormatErrors( sqlsrv_errors() ) );

							   if(sqlsrv_has_rows($a))
							   { 
							   
							?>
   	                    <!--<tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tipe Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>

							<select id=lndcol_certtype name=lndcol_certtype  nai="TIPE SERTIFIKAT TANAH " style="background:#FF0" onchange="CheckCert();">
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
						?>-->
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Nomor Surat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_certno name=lndcol_certno size=50 maxlength=50 value='<? echo $lndcol_certno; ?>'  nai="NOMOR SERTIFIKAT TANAH " style="background:#FF0" onBlur="fujielndcertno()"> <span  id="reinalndcertno"></span>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Pemegang Hak Atas Surat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_certatasnama name=lndcol_certatasnama size=50 maxlength=50 value='<? echo $lndcol_certatasnama; ?>'   nai="PEMEGANG HAK ATAS SERTIFIKAT TANAH " style="background:#FF0">
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Luas Tanah &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_luastanah name=lndcol_luastanah size=20 maxlength=8 value='<? echo $lndcol_luastanah; ?>' onKeyPress="return isNumberKey(event)"   nai="LUAS TANAH " style="background:#FF0" > m2
								<font face=Arial size=2 color=blue></font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Terbit Surat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_certdate name=lndcol_certdate size=20 maxlength=10 value='<? echo $lndcol_certdate; ?>' readonly=readonly   nai="TANGGAL TERBIT SERTIFIKAT TANAH " style="background:#FF0">
		   		    							  <a href="javascript:NewCssCal('lndcol_certdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
							</td>
   	                    </tr>
						<Script Language="JavaScript">
						function CheckCert()
						{
							//alert(document.formentry.lndcol_certtype.value);
							if(document.formentry.lndcol_certtype.value=="SHGB")
							{
								document.formentry.lndcol_certdue.style.backgroundColor="#FF0";
							}
							else
							{
								document.formentry.lndcol_certdue.style.backgroundColor="";								
							}
						}
						</Script>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Jatuh Tempo Surat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_certdue name=lndcol_certdue size=20 maxlength=10 value='<? echo $lndcol_certdue; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO SERTIFIKAT TANAH ">
		   		    							  <a name =lnccol_certdueimg  href="javascript:NewCssCal('lndcol_certdue','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2" /></A>
								<font face=Arial size=2 color=blue></font>
							</td>
   	                    </tr>
						<!--<?php
							 $tsql = "SELECT * FROM RFRELATION WHERE ACTIVE = 'True'";
								$a = sqlsrv_query($conn, $tsql);

								  if ( $a === false)
								  die( FormatErrors( sqlsrv_errors() ) );

							   if(sqlsrv_has_rows($a))
							   { 
							   
						?>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Kode Relasi &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<select id=lndcol_relcode name=lndcol_relcode  nai="RELCODE TANAH " style="background:#FF0" onchange="changedeveloper('lndcol');">
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
					if($lndcol_relcode=="DVL")
					{
						$vh = "visibility:visible;";
					}
?>
						<tr style="<?php echo $vh;?>" id="lndcol_devname">
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Developer &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=lndcol_devname name=lndcol_devname size=50 maxlength=50 style="background:#FF0" value='<? echo $lndcol_devname; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_haktanggungan name=lndcol_haktanggungan size=50 maxlength=50 value='<? echo $lndcol_haktanggungan; ?>' >
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_haktanggungantgl name=lndcol_haktanggungantgl size=20 maxlength=10 value='<? echo $lndcol_haktanggungantgl; ?>' readonly=readonly   nai="TANGGAL HAK TANGGUNGAN TANAH " style="background:#FFFFFF">
		   		    							  <a href="javascript:NewCssCal('lndcol_haktanggungantgl','yyyyMMdd')"><img src="../../Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue></font>
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
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Identifikasi &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<select id=lndcol_identification name=lndcol_identification  nai="IDENTIFICATION TANAH " style="background:#FF0">
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
<!--
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>NJOP Year &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_njopyear name=lndcol_njopyear size=20 maxlength=4 value='<? echo $lndcol_njopyear; ?>'  onKeyPress="return isNumberKey(event)" nai="NJOPYEAR TANAH " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>NJOP Value &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_njopval name=lndcol_njopval size=20 maxlength=20 value='<? echo numberFormat($lndcol_njopval); ?>' onKeyUp="outputMoney('lndcol_njopval')" onKeyPress="return isNumberKey(event)" nai="NJOPVAL TANAH " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>
							</td>
   	                    </tr>
-->
   	                    <!--<tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Remark &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lndcol_remark name=lndcol_remark size=50 maxlength=50 value='<? echo $lndcol_remark; ?>'   nai="REMARK TANAH " style="background:#FF0">
							</td>
   	                    </tr>-->
   	                    
					</TABLE>
								<input type=hidden id=lndcol_njopyear name=lndcol_njopyear value='<? echo $lndcol_njopyear; ?>'>
								<input type=hidden id=lndcol_njopval name=lndcol_njopval value='<? echo numberFormat($lndcol_njopval); ?>'>
					<BR>
				</TD>
			</TR>
		</TABLE>
     </div>