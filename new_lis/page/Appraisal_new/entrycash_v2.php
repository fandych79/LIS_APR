<div align=center>
	<TABLE cellPadding=5 width="700" border=1>
		<TR>
		<?
			$cash_matauang = "";
			$cash_nilai = "";
			$cash_noaccount = "";
			$cash_nobilyet = "";
			$cash_atasnama = "";
			$cash_hubungannasabah = "";
			$cash_alamat1 = "";
			$cash_alamat2 = "";
			$cash_alamat3 = "";
			$cash_tanggaljatuhtempo = "";
			$cash_cover = 1;
			$cash_keterangan = "";
			$cash_sukubunga = "";
			$cash_jangkawaktu = "";
			
			$tsqlcash = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$cash_matauang = $rowcash['currency_col'];
					$cash_nilai = $rowcash['nilai_col'];
				}
			}
			
			$tsqlcash = "SELECT * FROM tbl_COL_Cash where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$cash_matauang = $rowcash['cash_matauang'];
					$cash_nilai = $rowcash['cash_nilai'];
					$cash_noaccount = $rowcash['cash_noaccount'];
					$cash_nobilyet = $rowcash['cash_nobilyet'];
					$cash_atasnama = $rowcash['cash_atasnama'];
					$cash_hubungannasabah = $rowcash['cash_hubungannasabah'];
					$cash_alamat1 = $rowcash['cash_alamat1'];
					$cash_alamat2 = $rowcash['cash_alamat2'];
					$cash_alamat3 = $rowcash['cash_alamat3'];
					$cash_tanggaljatuhtempo = $rowcash['cash_tanggaljatuhtempo']->format('Y/m/d');
					$cash_cover = $rowcash['cash_cover'];
					$cash_keterangan = $rowcash['cash_keterangan'];
					$cash_sukubunga = $rowcash['cash_sukubunga'];
					$cash_jangkawaktu = $rowcash['cash_jangkawaktu'];
				}
			}
			
		?>
			<TD align=left valign=top>
				<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
					<tr>
					   <td width=100% align=center valign=top>
							<?
								if($type == "D01")
								{
							?>
								<font face=Arial size=2><b>DEPOSITO</b></font>
							<?
								}
								else if ($type == "TAB")
								{
							?>
								<font face=Arial size=2><b>TABUNGAN</b></font>
							<?
								}
							?>
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
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_aplisregno name=cash_aplisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly style="background:#FF0">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_colid name=cash_colid size=20 maxlength=20 value='<? echo $col_id; ?>' readonly=readonly style="background:#FF0">
   	                       </td>
   	                    </tr>
						<?
							$tsql = "SELECT * FROM Tbl_Currency WHERE CURR_ACTIVE = 'Y'";
							$b = sqlsrv_query($conn, $tsql);
							if ( $b === false)die( FormatErrors( sqlsrv_errors() ) );
							if(sqlsrv_has_rows($b))
							{ 
						?>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Mata Uang &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<select id="cash_matauang" name="cash_matauang"  nai="MATA UANG " style="background:#FF0" class="harus" >
								<option value="" selected="selected" >- Select -</option>
							<?
								While($rowType = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
								{
									$varselected = "";
									if($cash_matauang == $rowType["curr_code"])
									{
										$varselected = "selected";
									}
							?>	
									<option value="<? echo $rowType["curr_code"]; ?>" <? echo $varselected; ?>><? echo $rowType["curr_name"];?></option>
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
   	                          <font face=Arial size=2>Nilai &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_nilai name=cash_nilai size=20 maxlength=20 value='<? echo numberFormat($cash_nilai); ?>' style="background:#FF0" nai="NILAI " onKeyUp="outputMoney('cash_nilai')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<?
								if($type == "TAB")
								{
						?>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Account &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_noaccount name=cash_noaccount size=20 maxlength=19 value='<? echo $cash_noaccount; ?>' style="background:#FF0" nai="NOMOR ACCOUNT " onBlur="fujieaccount()"> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<?
								}
								else if ($type == "D01")
								{
						?>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Bilyet &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_nobilyet name=cash_nobilyet size=20 maxlength=19 value='<? echo $cash_nobilyet; ?>' style="background:#FF0" nai="NOMOR BILYET " onBlur="fujiebilyet()"> <span  id="reinacashbilyet"></span>
   	                       </td>
   	                    </tr>
						<?
								}
						?>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Suku Bunga &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_sukubunga name=cash_sukubunga size=20 maxlength=5 value='<? echo $cash_sukubunga; ?>' style="background:#FFF" nai="Suku Bunga " > %
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Atas Nama &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_atasnama name=cash_atasnama size=50 maxlength=50 value='<? echo $cash_atasnama; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Hubungan dengan debitur &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_hubungannasabah name=cash_hubungannasabah size=50 maxlength=50 value='<? echo $cash_hubungannasabah; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Alamat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_alamat1 name=cash_alamat1 size=50 maxlength=50 value='<? echo $cash_alamat1; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>&nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_alamat2 name=cash_alamat2 size=50 maxlength=50 value='<? echo $cash_alamat2; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>&nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_alamat3 name=cash_alamat3 size=50 maxlength=50 value='<? echo $cash_alamat3; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Jangka Waktu &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_jangkawaktu name=cash_jangkawaktu size=20 maxlength=10 value='<? echo $cash_jangkawaktu; ?>'  nai="Jangka Waktu " onKeyPress="return isNumberKey(event)">  Bulan
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal jatuh Tempo &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_tanggaljatuhtempo name=cash_tanggaljatuhtempo size=20 maxlength=10 value='<? echo $cash_tanggaljatuhtempo; ?>' readonly=readonly nai="TANGGAL JATUH TEMPO STNK VEHICLE ">
		   		    							  <a href="javascript:NewCssCal('cash_tanggaljatuhtempo','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2"><strong>Kesimpulan</strong></td>
						</tr>
						<tr>
							<td colspan="2">Kami telah melakukan penilaian terhadap objek diatas seusai dengan pengamatan kami. Kami yakin bahwa objek yang dinilai adalah yang dimaksud oleh BANK. Penilaian didasarkan pada data yang tersedia. Penilaian ini tidak dipengeruhi oleh kepentingan pribadi baik langsung maupun tidak langsung. Maka dari hasil pemeriksaan dan penilaian yang telah kami lakukan, maka Jaminan tersebut</td>
						</tr>
						<?

							if($cash_cover == 1)
							{
								$dicheck_1 = " checked='checked'";
								$dicheck_2 = "";
							}
							else
							{
								$dicheck_1 = "";
								$dicheck_2 = " checked='checked'";
							}
						?>
						<tr>
							<td colspan="2"><input type="radio" id="cover" name="cover" <? echo $dicheck_1; ?> value="1">Mengcover</input>  <input type="radio" id="cover" <? echo $dicheck_2; ?> name="cover" value="0" >Tidak Mengcover</input></td>
   	                    </tr>
						<tr>
							<td colspan="2">diterima untuk dijadikan sebagai jaminan dengan nilai seperti tersebut diatas. Dengan syarat dokumen harus sesuai</td>
						</tr>
						<tr>
							<td colspan="2"><textarea id="keterangan" name="keterangan" style="width:700px;height:150px;background:#FF0" nai="Keterangan "><? echo $cash_keterangan; ?></textarea></td>
						</tr>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</div>