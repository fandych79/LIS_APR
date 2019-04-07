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
			
			$tsqlcash = "SELECT * FROM tblcollateraltype where col_code = '$cust_jeniscol'";
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
			
			$tsqlcash = "SELECT * FROM appraisal_keterangan where _collateral_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
				if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
				{ 
					$keterangan = $rowcash['keterangan'];
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



