<div align=center>
	<TABLE cellPadding=5 width="700" border=1>
		<TR>
		<?
			$ruko_haktanggungan = "";
			$ruko_haktanggungantgl = "";
			$ruko_relcode = "";
			$ruko_njopyearlnd = "";
			$ruko_njopvallnd = "";
			$ruko_keteranganlnd = "";
			$ruko_certno = "";
			$ruko_certtype = "";
			$ruko_certluas = "";
			$ruko_certdate = "";
			$ruko_certdue = "";
			$ruko_certatasnama = "";
			$ruko_gssuno = "";
			$ruko_gssutgl = "";
			$ruko_imbno = "";
			$ruko_imbdate = "";
			$ruko_imbluas = "";
			$ruko_njopyearbld = "";
			$ruko_njopvalbld = "";
			$ruko_keteranganbld = "";
			$ruko_ppjb = "";
			$ruko_devname="";
			
			$lndcol_addr1 = "";
			$lndcol_addr2 = "";
			$lndcol_addr3 = "";
			$lndcol_kodepos = "";
			
			$tsqlruko = "SELECT * FROM tbl_COL_Ruko where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					$aruko = sqlsrv_query($conn, $tsqlruko);

					if ( $aruko === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($aruko))
					{  
						if($rowruko = sqlsrv_fetch_array($aruko, SQLSRV_FETCH_ASSOC))
						{ 
							$ruko_haktanggungan = $rowruko['col_haktanggungan'];
							$ruko_haktanggungantgl = $rowruko['col_haktanggungantgl']->format('Y/m/d');
							$ruko_relcode = $rowruko['col_relcode'];
							$ruko_njopyearlnd = $rowruko['col_njopyearlnd'];
							$ruko_njopvallnd = $rowruko['col_njopvallnd'];
							$ruko_keteranganlnd = $rowruko['col_keteranganlnd'];
							$ruko_certno = $rowruko['col_certno'];
							$ruko_certtype = $rowruko['col_certtype'];
							$ruko_certluas = $rowruko['col_certluas'];
							$ruko_certdate = $rowruko['col_certdate']->format('Y/m/d');
							$ruko_certdue = $rowruko['col_certdue']->format('Y/m/d');
							$ruko_certatasnama = $rowruko['col_certatasnama'];
							$ruko_gssuno = $rowruko['col_gssuno'];
							$ruko_gssutgl = $rowruko['col_gssutgl']->format('Y/m/d');
							$ruko_imbno = $rowruko['col_imbno'];
							$ruko_imbdate = $rowruko['col_imbdate']->format('Y/m/d');
							$ruko_imbluas = $rowruko['col_imbluas'];
							$ruko_njopyearbld = $rowruko['col_njopyearbld'];
							$ruko_njopvalbld = $rowruko['col_njopvalbld'];
							$ruko_keteranganbld = $rowruko['col_keteranganbld'];
							$ruko_ppjb = $rowruko['col_ppjb'];
							$ruko_devname = $rowruko['col_devname'];
						}
					}
					
					$tsqlland = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					//echo $tsqlland;
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
						}
					}
			
		?>
			<TD align=left valign=top>
				<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
					<tr>
					   <td width=100% align=center valign=top>
							<font face=Arial size=2><b>RUKO / RU-KAN / RU-KIOS</b></font>
					   </td>
					</tr>
					<tr>
					   <td width=100% align=center valign=top>
						 &nbsp;
					   </td>
					</tr>
				</TABLE>
				<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=30% align=left valign=top colspan=2>
								<strong>Tanah</strong>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_aplisregno name=ruko_aplisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly style="background:#FF0">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_colid name=ruko_colid size=20 maxlength=20 value='<? echo $col_id; ?>' readonly=readonly style="background:#FF0">
   	                       </td>
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
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Hak Tanggungan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<input type=text id=ruko_haktanggungan name=ruko_haktanggungan size=20 maxlength=20 value='<? echo $ruko_haktanggungan; ?>'  nai="HAK TANGGUNGAN " >
							</td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Hak Tanggungan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_haktanggungantgl name=ruko_haktanggungantgl size=20 maxlength=10 value='<? echo $ruko_haktanggungantgl; ?>' readonly=readonly nai="TANGGAL HAK TANGGUNGAN ">
		   		    							  <a href="javascript:NewCssCal('ruko_haktanggungantgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
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
   	                          <font face=Arial size=2>Hubungan Pemegang Hak Calon Debitur &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <select id=ruko_relcode name=ruko_relcode  nai="RELCODE TANAH " style="background:#FF0" onchange="changedeveloper('ruko');">
									<option value="" selected="selected">- Tipe Relasi -</option>
									
									<?
										While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
										{
											$varselected = "";
											if($ruko_relcode == $rowType["REL_CODE"])
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
						?>
<!--
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>NJOP YEAR &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_njopyearlnd name=ruko_njopyearlnd size=20 maxlength=4 value='<? echo $ruko_njopyearlnd; ?>' style="background:#FF0" nai="NJOP YEAR TANAH " onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>NJOP VAL &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_njopvallnd name=ruko_njopvallnd size=20 maxlength=20 value='<? echo numberFormat($ruko_njopvallnd); ?>' style="background:#FF0" nai="NJOP VAL TANAH " onKeyUp="outputMoney('ruko_njopvallnd')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
-->
<?
					$vh = "visibility:hidden;";
					if($ruko_relcode=="DVL")
					{
						$vh = "visibility:visible;";
					}
?>
						<tr style="<?php echo $vh;?>" id="ruko_devname">
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Developer &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_devname name=ruko_devname size=50 maxlength=50 style="background:#FF0" value='<? echo $ruko_devname; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Keterangan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_keteranganlnd name=ruko_keteranganlnd size=50 maxlength=50 value='<? echo $ruko_keteranganlnd; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Sertifikat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_certno name=ruko_certno size=50 maxlength=50 value='<? echo $ruko_certno; ?>' onBlur="fujierukocertno()"> <span  id="reinarukocertno"></span>
   	                       </td>
   	                    </tr>
						<?php
							 $tsql = "SELECT * FROM RFCERTTYPE";
								$a = sqlsrv_query($conn, $tsql);

								  if ( $a === false)
								  die( FormatErrors( sqlsrv_errors() ) );

							   if(sqlsrv_has_rows($a))
							   { 
							   
							?>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tipe Sertifikat &nbsp;</font>
							</td>
							<td width=80% align=left valign=top>

							<select id=ruko_certtype name=ruko_certtype  nai="TIPE SERTIFIKAT TANAH " >
							<option value="" selected="selected">- Tipe Sertifikat -</option>
							
							<?
								While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
								{
									$varselected = "";
									if($ruko_certtype == $rowType["CERTTYPE_ID"])
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
   	                          <font face=Arial size=2>Luas&nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_certluas name=ruko_certluas size=20 maxlength=8 value='<? echo $ruko_certluas; ?>' onKeyPress="return isNumberKey(event)" > m2
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_certdate name=ruko_certdate size=20 maxlength=10 value='<? echo $ruko_certdate; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('ruko_certdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Berakhir Hak &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_certdue name=ruko_certdue size=20 maxlength=10 value='<? echo $ruko_certdue; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('ruko_certdue','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Pemegang Hak &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_certatasnama name=ruko_certatasnama size=50 maxlength=50 value='<? echo $ruko_certatasnama; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor GS/SU &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_gssuno name=ruko_gssuno size=50 maxlength=50 value='<? echo $ruko_gssuno; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal GS/SU &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_gssutgl name=ruko_gssutgl size=20 maxlength=10 value='<? echo $ruko_gssutgl; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('ruko_gssutgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"><b>Bangunan</b></td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Nomor IMB &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=ruko_imbno name=ruko_imbno size=50 maxlength=50 value='<? echo $ruko_imbno; ?>'  nai="NOMOR IMB" style="background:#FF0" onBlur="fujierukoimbno()">  <span  id="reinarukoimbno"></span>
							</td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Tanggal IMB &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=ruko_imbdate name=ruko_imbdate size=20 maxlength=10 value='<? echo $ruko_imbdate; ?>' nai="IMB DATE TANAH DAN BANGUNGAN " style="background:#FFFFFF" readonly=readonly>
								<a href="javascript:NewCssCal('ruko_imbdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue></font>
							</td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Luas IMB &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=ruko_imbluas name=ruko_imbluas size=20 maxlength=8 value='<? echo $ruko_imbluas; ?>' nai="Luas IMB " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>m2
							</td>
						</tr>
<!--
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>NJOP Year &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=ruko_njopyearbld name=ruko_njopyearbld size=20 maxlength=4 value='<? echo $ruko_njopyearbld; ?>' onKeyPress="return isNumberKey(event)" nai="NJOPYEAR (BANGUNAN) TANAH DAN BANGUNGAN " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>
							</td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>NJOP Value &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=ruko_njopvalbld name=ruko_njopvalbld size=20 maxlength=20 value='<? echo numberFormat($ruko_njopvalbld); ?>' onKeyUp="outputMoney('ruko_njopvalbld')" onKeyPress="return isNumberKey(event)" nai="NJOPVAL (BANGUNAN) TANAH DAN BANGUNGAN " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>
							</td>
						</tr>
-->
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Keterangan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_keteranganbld name=ruko_keteranganbld size=50 maxlength=50 style="background:#FF0" value='<? echo $ruko_keteranganbld; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>PPJB &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=ruko_ppjb name=ruko_ppjb size=50 maxlength=50 value='<? echo $ruko_ppjb; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
				</TABLE>
								<input type=hidden id=ruko_njopyearbld name=ruko_njopyearbld value='<? echo $ruko_njopyearbld; ?>'>
								<input type=hidden id=ruko_njopvalbld name=ruko_njopvalbld value='<? echo numberFormat($ruko_njopvalbld); ?>'>
   	            <input type=hidden id=ruko_njopyearlnd name=ruko_njopyearlnd value='<? echo $ruko_njopyearlnd; ?>'>
   	            <input type=hidden id=ruko_njopvallnd name=ruko_njopvallnd value='<? echo numberFormat($ruko_njopvallnd); ?>'>
			</TD>
		</TR>
	</TABLE>
</div>