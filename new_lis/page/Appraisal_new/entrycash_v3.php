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
			$type_name = "";
			
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
			
			$tsqlcash = "SELECT * FROM tbl_col_cash_v3 where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
			$acash = sqlsrv_query($conn, $tsqlcash);
			if ( $acash === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($acash))
			{  
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
   	                          <font face=Arial size=2>Nomor Rekening &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_norek name=cash_norek size=20 maxlength=19 value='<? echo $cash_norek; ?>' style="background:#FF0" nai="NOMOR REKENING " onBlur="fujieaccount()"> <span  id="reinacashaccount"></span>
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
   	                          <font face=Arial size=2>Nominal &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_nominal name=cash_nominal size=20 maxlength=20 value='<? echo numberFormat($cash_nominal); ?>' style="background:#FF0" nai="NOMINAL " onKeyUp="outputMoney('cash_nilai')" onKeyPress="return isNumberKey(event)">
   	                       </td>
   	                    </tr>
						<?if($type=="D01"){?>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Jangka Waktu &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_jangkawaktu name=cash_jangkawaktu size=20 maxlength=10 value='<? echo $cash_jangkawaktu; ?>'  nai="Jangka Waktu " onKeyPress="return isNumberKey(event)">  Bulan
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<?}?>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Mulai &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_tanggal_mulai name=cash_tanggal_mulai size=20 maxlength=10 value='<? echo $cash_tanggal_mulai; ?>' readonly=readonly nai="TANGGAL MULAI ">
		   		    							  <a href="javascript:NewCssCal('cash_tanggal_mulai','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=30% align=left valign=top>
   	                          <font face=Arial size=2>Tanggal Berakhir &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <input type=text id=cash_tanggal_berakhir name=cash_tanggal_berakhir size=20 maxlength=10 value='<? echo $cash_tanggal_berakhir; ?>' readonly=readonly nai="TANGGAL MULAI ">
		   		    							  <a href="javascript:NewCssCal('cash_tanggal_berakhir','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue></font>
   	                       </td>
   	                    </tr>
						<tr>
							<td colspan="2"><strong>Keterangan</strong></td>
						</tr>
						<tr>
							<td colspan="2"><textarea id="cash_keterangan" name="cash_keterangan" style="width:700px;height:150px;background:#FF0" nai="Keterangan "><? echo $cash_keterangan; ?></textarea></td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						
						
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</div>