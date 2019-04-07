<div align=center>
	<TABLE cellPadding=5 width="700" border=1>
		<TR>
		<?			
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
			
			$tsqlcash = "SELECT * FROM tbl_col_termyn_v3 where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$term_nama_proyek = $rowcash['term_nama_proyek'];
					$term_lokasi_proyek = $rowcash['term_lokasi_proyek'];
					$term_pemilik_proyek = $rowcash['term_pemilik_proyek'];
					$term_nilai_proyek = $rowcash['term_nilai_proyek'];
					$term_tagihan_termyn = $rowcash['term_tagihan_termyn'];
					$term_fisik_proyek = $rowcash['term_fisik_proyek'];
					$term_jangka_waktu_proyek = $rowcash['term_jangka_waktu_proyek'];
					$term_pengikatan = $rowcash['term_pengikatan'];
					$term_keterangan = $rowcash['term_keterangan'];
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
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nama Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_nama_proyek name=term_nama_proyek size=50 maxlength=100 value='<? echo $term_nama_proyek; ?>' style="background:#FF0" nai="Nama Proyek "> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Lokasi Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_lokasi_proyek name=term_lokasi_proyek size=50 maxlength=100 value='<? echo $term_lokasi_proyek; ?>' style="background:#FF0" nai="Lokasi Proyek "> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Pemilik Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_pemilik_proyek name=term_pemilik_proyek size=50 maxlength=100 value='<? echo $term_pemilik_proyek; ?>' style="background:#FF0" nai="Pemilik Proyek "> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Nilai Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_nilai_proyek name=term_nilai_proyek size=20 maxlength=20 value='<? echo numberFormat($term_nilai_proyek); ?>' style="background:#FF0" nai="Nilai Proyek " onKeyUp="outputMoney('term_nilai_proyek')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tagihan Termyn &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_tagihan_termyn name=term_tagihan_termyn size=20 maxlength=20 value='<? echo numberFormat($term_tagihan_termyn); ?>' style="background:#FF0" nai="Tagihan Termyn " onKeyUp="outputMoney('term_tagihan_termyn')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Fisik Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_fisik_proyek name=term_fisik_proyek size=50 maxlength=100 value='<? echo $term_fisik_proyek; ?>' style="background:#FF0" nai="Fisik Proyek "> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Jangka Waktu Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_jangka_waktu_proyek name=term_jangka_waktu_proyek size=50 maxlength=50 value='<? echo $term_jangka_waktu_proyek; ?>' style="background:#FF0" nai="Jangka Waktu Proyek "> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Pengikatan Proyek &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=term_pengikatan name=term_pengikatan size=50 maxlength=50 value='<? echo $term_pengikatan; ?>' style="background:#FF0" nai="Fisik Proyek "> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2"><strong>Keterangan</strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea id="term_keterangan" name="term_keterangan" style="width:700px;height:150px;background:#FF0" nai="Keterangan "><? echo $term_keterangan; ?></textarea></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						
						
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</div>