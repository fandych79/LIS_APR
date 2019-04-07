<div align=center>
	<TABLE cellPadding=5 width="700" border=1>
		<TR>
		<?
			$kios_haktanggungan = "";
			$kios_haktanggungantgl = "";
			$kios_relcode = "";
			$kios_njopyearlnd = "";
			$kios_njopvallnd = "";
			$kios_keteranganlnd = "";
			$kios_certno = "";
			$kios_certtype = "";
			$kios_certluas = "";
			$kios_certdate = "";
			$kios_certdue = "";
			$kios_certatasnama = "";
			$kios_gssuno = "";
			$kios_gssutgl = "";
			$kios_imbno = "";
			$kios_imbdate = "";
			$kios_imbluas = "";
			$kios_njopyearbld = "";
			$kios_njopvalbld = "";
			$kios_keteranganbld = "";
			$kios_ppjb = "";
			$kios_devname = "";
			
			$lndcol_addr1 = "";
			$lndcol_addr2 = "";
			$lndcol_addr3 = "";
			$lndcol_kodepos = "";
			
			$tsqlkios = "SELECT * FROM appraisal_kios where _collateral_id = '$col_id'";

			$akios = sqlsrv_query($conn, $tsqlkios);

			if ( $akios === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($akios))
			{  
				if($rowkios = sqlsrv_fetch_array($akios, SQLSRV_FETCH_ASSOC))
				{ 
					$kios_haktanggungan = $rowkios['col_haktanggungan'];
					$kios_haktanggungantgl = $rowkios['col_haktanggungantgl']->format('Y/m/d');
					$kios_relcode = $rowkios['col_relcode'];
					$kios_njopyearlnd = $rowkios['col_njopyearlnd'];
					$kios_njopvallnd = $rowkios['col_njopvallnd'];
					$kios_keteranganlnd = $rowkios['col_keteranganlnd'];
					$kios_certno = $rowkios['col_certno'];
					$kios_certtype = $rowkios['col_certtype'];
					$kios_certluas = $rowkios['col_certluas'];
					$kios_certdate = $rowkios['col_certdate']->format('Y/m/d');
					$kios_certdue = $rowkios['col_certdue']->format('Y/m/d');
					$kios_certatasnama = $rowkios['col_certatasnama'];
					$kios_gssuno = $rowkios['col_gssuno'];
					$kios_gssutgl = $rowkios['col_gssutgl']->format('Y/m/d');
					$kios_imbno = $rowkios['col_imbno'];
					$kios_imbdate = $rowkios['col_imbdate']->format('Y/m/d');
					$kios_imbluas = $rowkios['col_imbluas'];
					$kios_njopyearbld = $rowkios['col_njopyearbld'];
					$kios_njopvalbld = $rowkios['col_njopvalbld'];
					$kios_keteranganbld = $rowkios['col_keteranganbld'];
					$kios_ppjb = $rowkios['col_ppjb'];
					$kios_devname = $rowkios['col_devname'];
				}
			}
			
			$tsqlland = "SELECT * FROM appraisal_land where _collateral_id = '$col_id'";

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
							<font face=Arial size=2><b><?=$type_name;?></b></font>
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
   	                          <input type=text id=kios_aplisregno name=kios_aplisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly style="background:#FF0">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_colid name=kios_colid size=20 maxlength=20 value='<? echo $col_id; ?>' readonly=readonly style="background:#FF0">
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
								<input type=text id=kios_haktanggungan name=kios_haktanggungan size=20 maxlength=20 value='<? echo $kios_haktanggungan; ?>'  nai="HAK TANGGUNGAN " >
							</td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Hak Tanggungan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_haktanggungantgl name=kios_haktanggungantgl size=20 maxlength=10 value='<? echo $kios_haktanggungantgl; ?>' readonly=readonly nai="TANGGAL HAK TANGGUNGAN ">
		   		    							  <a href="javascript:NewCssCal('kios_haktanggungantgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
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
   	                          <select id=kios_relcode name=kios_relcode  nai="RELCODE TANAH " style="background:#FF0" onchange="changedeveloper('kios');">
									<option value="" selected="selected">- Tipe Relasi -</option>
									
									<?
										While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
										{
											$varselected = "";
											if($kios_relcode == $rowType["REL_CODE"])
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
   	                          <input type=text id=kios_njopyearlnd name=kios_njopyearlnd size=20 maxlength=4 value='<? echo $kios_njopyearlnd; ?>' style="background:#FF0" nai="NJOP YEAR TANAH " onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>NJOP VAL &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_njopvallnd name=kios_njopvallnd size=20 maxlength=20 value='<? echo numberFormat($kios_njopvallnd); ?>' style="background:#FF0" nai="NJOP VAL TANAH " onKeyUp="outputMoney('kios_njopvallnd')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
-->
<?
					$vh = "visibility:hidden;";
					if($kios_relcode=="DVL")
					{
						$vh = "visibility:visible;";
					}
?>
						<tr style="<?php echo $vh;?>" id="kios_devname">
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Developer &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_devname name=kios_devname size=50 maxlength=50 style="background:#FF0" value='<? echo $kios_devname; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Keterangan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_keteranganlnd name=kios_keteranganlnd size=50 maxlength=50 value='<? echo $kios_keteranganlnd; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Sertifikat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_certno name=kios_certno size=50 maxlength=50 value='<? echo $kios_certno; ?>' onBlur="fujiekioscertno()"> <span  id="reinakioscertno"></span>
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

							<select id=kios_certtype name=kios_certtype  nai="TIPE SERTIFIKAT TANAH " >
							<option value="" selected="selected">- Tipe Sertifikat -</option>
							
							<?
								While($rowType = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
								{
									$varselected = "";
									if($kios_certtype == $rowType["CERTTYPE_ID"])
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
   	                          <input type=text id=kios_certluas name=kios_certluas size=20 maxlength=8 value='<? echo $kios_certluas; ?>' onKeyPress="return isNumberKey(event)" > m2
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_certdate name=kios_certdate size=20 maxlength=10 value='<? echo $kios_certdate; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('kios_certdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Berakhir Hak &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_certdue name=kios_certdue size=20 maxlength=10 value='<? echo $kios_certdue; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('kios_certdue','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Pemegang Hak &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_certatasnama name=kios_certatasnama size=50 maxlength=50 value='<? echo $kios_certatasnama; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor GS/SU &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_gssuno name=kios_gssuno size=50 maxlength=50 value='<? echo $kios_gssuno; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal GS/SU &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_gssutgl name=kios_gssutgl size=20 maxlength=10 value='<? echo $kios_gssutgl; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('kios_gssutgl','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
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
								<input type=text id=kios_imbno name=kios_imbno size=50 maxlength=50 value='<? echo $kios_imbno; ?>'  nai="NOMOR IMB" style="background:#FF0" onBlur="fujiekiosimbno()">  <span  id="reinakiosimbno"></span>
							</td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Tanggal IMB &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=kios_imbdate name=kios_imbdate size=20 maxlength=10 value='<? echo $kios_imbdate; ?>' nai="IMB DATE TANAH DAN BANGUNGAN " style="background:#FFFFFF" readonly=readonly>
								<a href="javascript:NewCssCal('kios_imbdate','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue></font>
							</td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Luas IMB &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=kios_imbluas name=kios_imbluas size=20 maxlength=8 value='<? echo $kios_imbluas; ?>' nai="Luas IMB " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>m2
							</td>
						</tr>
<!--
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>NJOP Year &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=kios_njopyearbld name=kios_njopyearbld size=20 maxlength=4 value='<? echo $kios_njopyearbld; ?>' onKeyPress="return isNumberKey(event)" nai="NJOPYEAR (BANGUNAN) TANAH DAN BANGUNGAN " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>
							</td>
						</tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>NJOP Value &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=kios_njopvalbld name=kios_njopvalbld size=20 maxlength=20 value='<? echo numberFormat($kios_njopvalbld); ?>' onKeyUp="outputMoney('kios_njopvalbld')" onKeyPress="return isNumberKey(event)" nai="NJOPVAL (BANGUNAN) TANAH DAN BANGUNGAN " style="background:#FF0">
								<font face=Arial size=2 color=blue></font>
							</td>
						</tr>
-->
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Keterangan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_keteranganbld name=kios_keteranganbld size=50 maxlength=50 style="background:#FF0" value='<? echo $kios_keteranganbld; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>PPJB &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=kios_ppjb name=kios_ppjb size=50 maxlength=50 value='<? echo $kios_ppjb; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>						
				</TABLE>
   	            <input type=hidden id=kios_njopyearlnd name=kios_njopyearlnd value='<? echo $kios_njopyearlnd; ?>'>
   	            <input type=hidden id=kios_njopvallnd name=kios_njopvallnd value='<? echo $kios_njopvallnd; ?>'>
								<input type=hidden id=kios_njopyearbld name=kios_njopyearbld value='<? echo $kios_njopyearbld; ?>'>
								<input type=hidden id=kios_njopvalbld name=kios_njopvalbld value='<? echo numberFormat($kios_njopvalbld); ?>'>
			</TD>
		</TR>
	</TABLE>
</div>