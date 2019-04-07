<?php
$cash_matauang = 0;
					$cash_nilai = 0;
			
/*
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
			}*/
			
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
			
			$tsqlcash = "SELECT * FROM appraisal_mesin where  _collateral_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$jenis_mesin = $rowcash['jenis_mesin'];
					$nama_mesin = $rowcash['nama_mesin'];
					$nomor_mesin = $rowcash['nomor_mesin'];
					$nomor_surat = $rowcash['nomor_surat'];
					$tahun_pembuatan = $rowcash['tahun_pembuatan'];
					$umur_mesin = $rowcash['umur_mesin'];
					$keterangan = $rowcash['keterangan'];
				}
			}
			
		?>

		


<div align=center>
	<TABLE cellPadding=5 width="700" border=1>
		<TR>
		
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
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_aplisregno name=cash_aplisregno size=20 maxlength=20 value='<? echo $custnomid; ?>' readonly=readonly style="background:#FF0">
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
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Jenis Mesin &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=jenis_mesin name=jenis_mesin size=50 maxlength=200 value='<? echo $jenis_mesin; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Mesin &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=nama_mesin name=nama_mesin size=50 maxlength=200 value='<? echo $nama_mesin; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Mesin &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=nomor_mesin name=nomor_mesin size=50 maxlength=200 value='<? echo $nomor_mesin; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nomor Surat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=nomor_surat name=nomor_surat size=50 maxlength=200 value='<? echo $nomor_surat; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tahun Pembuatan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=tahun_pembuatan name=tahun_pembuatan size=10 maxlength=4 value='<? echo $tahun_pembuatan; ?>'  onBlur="ctyear(this.value, '<?php echo date("Y"); ?>')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Umur Mesin &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=umur_mesin name=umur_mesin size=10 maxlength=10 value='<? echo $umur_mesin; ?>' readonly> Tahun
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2"><strong>Keterangan</strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea id="keterangan" name="keterangan" style="width:700px;height:150px;background:#FF0" nai="Keterangan "><? echo $keterangan; ?></textarea></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						
						
				</TABLE>
			</TD>
		</TR>
	</TABLE>
	
</div>



<script type="text/javascript">
	$(this).blur(function(){});

	function ctyear(a, b){
		if(a>b){
			alert('Tahun Pembuatan melebihi tahun sekarang.');
		}else{
			var c = b - a;
			document.getElementById('umur_mesin').value=c;
		}
	}
		
</script>

