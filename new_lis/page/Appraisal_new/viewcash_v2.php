<?
		$tampil = 0;
		$header = "";
		$jenisfasilitas = "";
		$namanomor = "";
		$nilainomor = "";
		
		$tsqlvehicle = "SELECT * from tbl_kodeproduk where produk_loan_type in(SELECT custcredittype FROM tbl_CustomerFacility where custnomid = '$custnomid')";
		$avehicle = sqlsrv_query($conn, $tsqlvehicle);

		if ( $avehicle === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($avehicle))
		{  
			while($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
			{ 
				if($jenisfasilitas == "")
				{
					$jenisfasilitas = "- ".$rowvehicle['produk_type_description'];
				}
				else
				{
					$jenisfasilitas = $jenisfasilitas."<br>- ".$rowvehicle['produk_type_description'];
				}
			}
		}

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
			$cash_diperiksaoleh = "";
			$cash_tanggalpemeriksaan = "";
			
			$tsqlcash = "SELECT * FROM tbl_COL_Cash where ap_lisregno = '$custnomid' AND col_id = '$colid'";

			$acash = sqlsrv_query($conn, $tsqlcash);

			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($acash))
			{  
				$tampil = 1;
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
					$cash_diperiksaoleh = $rowcash['cash_diperiksaoleh'];
					$cash_tanggalpemeriksaan = $rowcash['cash_tanggalpemeriksaan'];
					if($cash_tanggalpemeriksaan == "")
					{
					}
					else
					{
						$cash_tanggalpemeriksaan = $rowcash['cash_tanggalpemeriksaan']->format('Y/m/d');
					}
				}
			}
			else
			{
				echo '<div align="center" style="padding-left : 10px;" style="padding-right : 10px;"><br><font size=4px; color="red" style="padding-left : 1px;"><strong>BELUM DIISI DETAILNYA</strong></font><br></div>';
			}

			
			
				if($jeniscol == "D01")
				{
					$header = "Deposito";
					$namanomor = "Nomor Bilyet";
					$nilainomor = $cash_nobilyet;
				}
				else if ($jeniscol == "TAB")
				{
					$header = "Tabungan";
					$namanomor = "Nomor Account";
					$nilainomor = $cash_noaccount;
				}
		
				if($tampil == 1)
				{
?>
	
		<table width = "100%" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong><? echo $header; ?></strong></td>			
			</tr>
			</br>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" align="center">Data Customer</td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;">
					<table width = "80%" align = "center" border = "0">
						<tr>
							<td width=35% valign="top">Jenis Fasilitas</td>
							<td width=3% valign="top">:</td>
							<td width=67%><? echo $jenisfasilitas; ?></td>
						</tr>
						<tr>
							<td>Customer ID</td>
							<td width=3%>:</td>
							<td><? echo $custnomid; ?></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td width=3%>:</td>
							<td><? echo $custfullname; ?></td>
						</tr>
						<tr>
							<td>Diperiksa Oleh</td>
							<td width=3%>:</td>
							<td><? echo $cash_diperiksaoleh;?></td>
						</tr>
						<tr>
							<td>Tgl Pemeriksaan</td>
							<td width=3%>:</td>
							<td><? echo $cash_tanggalpemeriksaan;?></td>
						</tr>
					</table>
				</td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" align="center">Kepemilikan</td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;">
					<TABLE WIDTH=80% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
						<?
							$namacur = "";
							$tsqlcur = "SELECT * FROM Tbl_Currency WHERE CURR_ACTIVE = 'Y' AND CURR_CODE = '$cash_matauang'";
							$bcur = sqlsrv_query($conn, $tsqlcur);
							if ( $bcur === false)die( FormatErrors( sqlsrv_errors() ) );
							if(sqlsrv_has_rows($bcur))
							{ 
								While($rowType = sqlsrv_fetch_array($bcur, SQLSRV_FETCH_ASSOC))
								{
									$namacur = $rowType['curr_name'];
								}
							}
						?>
						<tr>
							<td width=35% align=left valign=top>Mata Uang</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_matauang." - ".$namacur; ?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Nilai</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo numberFormat($cash_nilai);?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Suku bunga</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_sukubunga;?> %</td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top><? echo $namanomor; ?></td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $nilainomor;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Atas Nama</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_atasnama;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Hubungan dengan nasabah</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_hubungannasabah;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Alamat</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_alamat1;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>&nbsp;</td>
							<td width=3% align=left valign=top>&nbsp;</td>
							<td width=67% align=left valign=top><? echo $cash_alamat2;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>&nbsp;</td>
							<td width=3% align=left valign=top>&nbsp;</td>
							<td width=67% align=left valign=top><? echo $cash_alamat3;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Jangka waktu</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_jangkawaktu;?> Bulan</td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Tanggal Jatuh Tempo</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_tanggaljatuhtempo;?></td>
   	                    </tr>
					</table>
				</td>
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" align="center">Kesimpulan</td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" align="left">Kami telah melakukan penilaian terhadap objek diatas seusai dengan pengamatan kami. Kami yakin bahwa objek yang dinilai adalah yang dimaksud oleh BANK. Penilaian didasarkan pada data yang tersedia. Penilaian ini tidak dipengeruhi oleh kepentingan pribadi baik langsung maupun tidak langsung. Maka dari hasil pemeriksaan dan penilaian yang telah kami lakukan, maka Jaminan tersebut</td>			
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
				<td width=100% colspan = "3" align="left"><input type="radio" id="cover" name="cover" <? echo $dicheck_1; ?> value="1" disabled="disabled">Mengcover</input>  <input type="radio" id="cover" <? echo $dicheck_2; ?> name="cover" value="0" disabled="disabled">Tidak Mengcover</input></td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" align="left">diterima untuk dijadikan sebagai jaminan dengan nilai seperti tersebt diatas. Dengan syarat dokumen harus sesuai</td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" align="left">
					<table width = "95%" align = "center" border = "1">
						<tr>
							<td><? echo $cash_keterangan; ?></td>
						</tr>
					</table>
			</tr>
		</table>
		
<?
				}
				else{}
?>