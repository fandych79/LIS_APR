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
			
			$tsqlcash = "SELECT * FROM appraisal_gld where _collateral_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$gld_id_number = $rowcash['gld_id_number'];
					$gld_berat = $rowcash['gld_berat'];
					$gld_dimensi = $rowcash['gld_dimensi'];
					$gld_harga = $rowcash['gld_harga'];
					$gld_keterangan = $rowcash['gld_keterangan'];
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
   	                          <font face=Arial size=2>ID Number &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=gld_id_number name=gld_id_number size=20 maxlength=100 value='<? echo $gld_id_number; ?>' style="background:#FF0" nai="NOMOR REKENING " onBlur="fujieaccount()"> <span  id="reinacashaccount"></span>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Berat &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=gld_berat name=gld_berat size=50 maxlength=50 value='<? echo $gld_berat; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Dimensi &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=gld_dimensi name=gld_dimensi size=50 maxlength=50 value='<? echo $gld_dimensi; ?>'>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Harga &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=gld_harga name=gld_harga size=20 maxlength=20 value='<? echo numberFormat($gld_harga); ?>' style="background:#FF0" nai="Harga " onKeyUp="outputMoney('gld_harga')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2"><strong>Keterangan</strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea id="gld_keterangan" name="gld_keterangan" style="width:700px;height:150px;background:#FF0" nai="Keterangan "><? echo $gld_keterangan; ?></textarea></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						
						
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</div>