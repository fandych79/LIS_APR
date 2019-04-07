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
			$tsqlcash = "SELECT * FROM tblcollateraltype where col_code = '$type'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$type_name = $rowcash['col_name'];
				}
			}

			
			$tsqlcash = "SELECT * FROM tbl_col_cash_v3 where ap_lisregno = '$custnomid' AND col_id = '$colid'";

			$acash = sqlsrv_query($conn, $tsqlcash);

			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($acash))
			{  
				$tampil = 1;
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$cash_norek = $rowcash['cash_norek'];
					$cash_atasnama = $rowcash['cash_atasnama'];
					$cash_nominal = $rowcash['cash_nominal'];
					$cash_jangkawaktu = $rowcash['cash_jangkawaktu'];
					$cash_tanggal_mulai = $rowcash['cash_tanggal_mulai']->format('Y/m/d');
					$cash_tanggal_berakhir = $rowcash['cash_tanggal_berakhir']->format('Y/m/d');
					$cash_keterangan = $rowcash['cash_keterangan'];
				}
			}
			else
			{
				echo '<div align="center" style="padding-left : 10px;" style="padding-right : 10px;"><br><font size=4px; color="red" style="padding-left : 1px;"><strong>BELUM DIISI DETAILNYA</strong></font><br></div>';
			}

			
				if($tampil == 1)
				{
?>
	
		<table width = "100%" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong><? echo $type_name; ?></strong></td>			
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
						<tr>
							<td width=30% align=left valign=top>No Rekening</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_norek;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Atas Nama</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_atasnama;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Nominal</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo numberFormat($cash_nominal);?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Jangka Waktu</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_jangkawaktu;?> </td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Tanggal Mulai</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_tanggal_mulai;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Tanggal Berakhir</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $cash_tanggal_berakhir;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Keterangan</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo nl2br($cash_keterangan);?></td>
   	                    </tr>
						
					</table>
				</td>
			</tr>
			
		</table>
		
<?
				}
				else{}
?>