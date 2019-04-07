<div align=center>
		<TABLE cellPadding=5 width="700" border=1>
			<TR>
				<?
					$lainnyacol_code = $type;
					$lainnyacol_name = $type;
					$lainnyacol_nomordokumen = "";
					$lainnyacol_nilaijaminan = "";
					
					$tsqlcash = "SELECT * FROM Tbl_Cust_MasterCol where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					$acash = sqlsrv_query($conn, $tsqlcash);
					if ( $acash === false)
						die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($acash))
					{  
						if($rowcash = sqlsrv_fetch_array($acash, SQLSRV_FETCH_ASSOC))
						{ 
							$lainnyacol_nilaijaminan = $rowcash['nilai_col'];
						}
					}
					
					$tsqllainnya = "SELECT * FROM tbl_COL_Lainnya where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";

					$alainnya= sqlsrv_query($conn, $tsqllainnya);

					if ( $alainnya === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($alainnya))
					{  
						if($rowlainnya = sqlsrv_fetch_array($alainnya, SQLSRV_FETCH_ASSOC))
						{ 
							$lainnyacol_code = $rowlainnya['col_code'];
							$lainnyacol_nomordokumen = $rowlainnya['col_nomordokumen'];
							$lainnyacol_nilaijaminan = $rowlainnya['col_nilaijaminan'];
						}
					}
				
				?>
				<TD align=left valign=top>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=100% align=center valign=top>
								<font face=Arial size=2><b>LAINNYA</b></font>
							</td>
   	                    </tr>
						<tr>
							<td width=100% align=left valign=top>
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
								<input type=text id=lainnyaap_lisregno name=lainnyaap_lisregno size=20 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly  style="background:#FF0">
							</td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Collateral ID &nbsp;</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text id=lainnyacol_id name=lainnyacol_id size=20 maxlength=20 value='<? echo $col_id; ?>' readonly=readonly style="background:#FF0"> 
							</td>
   	                    </tr>
						<?
							$tsqllainnya = "SELECT * FROM TblCollateralType WHERE COL_CODE = '$type'";

							$alainnya= sqlsrv_query($conn, $tsqllainnya);

							if ( $alainnya === false)
								die( FormatErrors( sqlsrv_errors() ) );

							if(sqlsrv_has_rows($alainnya))
							{  
								if($rowlainnya = sqlsrv_fetch_array($alainnya, SQLSRV_FETCH_ASSOC))
								{ 
									$lainnyacol_name = $rowlainnya['col_name'];
								}
							}
						?>
						<tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Jenis Jaminan &nbsp;</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lainnyacol_code name=lainnyacol_code size=20 maxlength=20 value='<? echo $lainnyacol_name; ?>' readonly=readonly nai="ALAMAT TANAH " style="background:#FF0">
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Nomor Dokumen Jaminan &nbsp;</font>
							</td>
							<td width=80% align=left valign=top>
								<textarea id="lainnyacol_nomordokumen" name="lainnyacol_nomordokumen" style="width:400px;height:150px;background:#FF0" nai="Keterangan "><? echo $lainnyacol_nomordokumen; ?></textarea>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Nilai Jaminan &nbsp;</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text id=lainnyacol_nilaijaminan name=lainnyacol_nilaijaminan size=20 maxlength=20 value='<? echo numberFormat($lainnyacol_nilaijaminan); ?>' nai="NILAI JAMINAN " style="background:#FF0" onKeyPress="return isNumberKey(event)" onKeyUp="outputMoney('lainnyacol_nilaijaminan')">
							</td>
   	                    </tr>
						
   	                    
					</TABLE>
					<BR>
				</TD>
			</TR>
		</TABLE>
     </div>