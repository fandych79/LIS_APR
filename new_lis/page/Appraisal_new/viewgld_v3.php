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

			
			$tsqlcash = "SELECT * FROM appraisal_gld where _collateral_id = '$colid'";

			$acash = sqlsrv_query($conn, $tsqlcash);

			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($acash))
			{  
				$tampil = 1;
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$gld_id_number = $rowcash['gld_id_number'];
					$gld_berat = $rowcash['gld_berat'];
					$gld_dimensi = $rowcash['gld_dimensi'];
					$gld_harga = $rowcash['gld_harga'];
					$gld_keterangan = $rowcash['gld_keterangan'];
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
							<td width=67%><? echo $type_name; ?></td>
						</tr>
						<tr>
							<td>Customer ID</td>
							<td width=3%>:</td>
							<td><? echo $custnomid; ?></td>
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
							<td width=30% align=left valign=top>ID Number</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $gld_id_number;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Berat</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $gld_berat;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Dimensi</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo $gld_dimensi;?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Harga</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo numberFormat($gld_harga);?></td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>Keterangan</td>
							<td width=3% align=left valign=top>:</td>
							<td width=67% align=left valign=top><? echo nl2br($gld_keterangan);?></td>
   	                    </tr>
						
					</table>
				</td>
			</tr>
			
		</table>
		
<?
				}
				else{}
?>