	<div align=center>
		<TABLE cellPadding=5 width="700" border=0>
			<TR>
				<?php
								 $tsql = "SELECT count(*) as countbld FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' and cust_jeniscol='BA1'";

									$a = sqlsrv_query($conn, $tsql);

									  if ( $a === false)
									  die( FormatErrors( sqlsrv_errors() ) );

									if(sqlsrv_has_rows($a))
									{  
							
										if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
										{ 
											$countbld=$row['countbld'];
										}
									}
				?>
			
				<TD align=left valign=top>

				<?
				$i=0;
		$tsql2 = "SELECT * FROM tbl_COL_Building where ap_lisregno = '$Custnomid'";
		$a2 = sqlsrv_query($conn, $tsql2);

		if ( $a2 === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a2))
		{  
			while($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
			{ 
			$i++;
		$ysql2 = "SELECT cast(col_imbdate as varchar) as col_imbdate,  cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Building where ap_lisregno = '$Custnomid'";
		$b2 = sqlsrv_query($conn, $ysql2);

		if ( $b2 === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b2))
		{  
			if($rowcast2 = sqlsrv_fetch_array($b2, SQLSRV_FETCH_ASSOC))
			{ 

		?>
<?//----------------------------------------------------------------------------------------------------------------- Tanah dan Bangunan ?>
				
				<br>
					<TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
						<tr>
							<td width=100% align=left valign=top>
								<font face=Arial size=2><b>TANAH DAN BANGUNAN <? echo $i; ?>. &nbsp</b></font>
							</td>
						</tr>
					</TABLE>
					<TABLE WIDTH=100% cellpadding=0 cellspacing=0 border=1>
						<tr>
							<td width=100% align=left valign=top>
							
							
								<font face=Arial size=2>BANGUNAN</font>
								<TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Application Number &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $row2['ap_lisregno']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Collateral ID &nbsp</font>
										</td>
										<td width=80% align=left valign=top>

											<input type=text name=bldcol_id<? echo $i; ?> size=20 maxlength=20  value='<? echo $row2['col_id'];?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 1 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $row2['col_addr1']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 2 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $row2['col_addr2']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 3 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $row2['col_addr3']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Kodepos &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_kodepos<? echo $i; ?> size=5 maxlength=5 value='<? echo $row2['col_kodepos']; ?>'>
											<A HREF="http://192.168.1.101/lismega_devel/script/maintainzipcode.php" target=lainnya>View Zipcode</A>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Collateral Type &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<select name=bldcol_type<? echo $i; ?> value='<? echo $row['col_type']; ?>'>
												<option value="RMH">Tanah dan Bangunan</option>
											</select>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>IMB No &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_imbno<? echo $i; ?> size=50 maxlength=50 value='<? echo $row2['col_imbno']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>IMB Date &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_imbdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $rowcast2['col_imbdate']; ?>'>
		   		    						<a href="javascript:NewCssCal('bldcol_imbdate<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>IMB Luas &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_imbluas<? echo $i; ?> size=10 maxlength=8 value='<? echo $row2['col_imbluas']; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Year &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_njopyear<? echo $i; ?> size=4 maxlength=4 value='<? echo $row2['col_njopyear']; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Val &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_njopval<? echo $i; ?> size=8 maxlength=10 value='<? echo $row2['col_njopval']; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
											<?
			} //tutup cast
		}
			}
		}
			$i=0;
		$tsql = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$Custnomid' and col_id like '$Custnomid"."BLDLND%'";
		$a = sqlsrv_query($conn, $tsql);

		if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a))
		{  
			while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{ 
			$i++;
		$ysql = "SELECT cast(col_certdate as varchar) as col_certdate, cast(col_certdue as varchar) as col_certdue, cast(col_haktanggungantgl as varchar) as col_haktanggungantgl, cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Land where ap_lisregno = '$Custnomid' and col_id like '$Custnomid"."BLDLND%'";
		$b = sqlsrv_query($conn, $ysql);

		if ( $b === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b))
		{  
			if($rowcast = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
			{ 
	

		?>
	

								</table>
							</td>
						</tr>			
						<tr>
							<td align=left valign=top width=100%>
								
								<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0>
									<tr>
										<td width=100% align=left valign=top>
											<font face=Arial size=2>TANAH</font>
										</td>
									</tr>						
								</TABLE>
								
								<TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Application Number &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $row['ap_lisregno'];; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Collateral ID &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_id<? echo $i; ?> size=20 maxlength=20 value='<? echo $row['col_id'];; ?>'>
										</td>
									</tr>

									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Alamat Jaminan &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr1']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Alamat Calon Debitur &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr2']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 3 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr3']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Kodepos &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_kodepos<? echo $i; ?> size=20 maxlength=5 value='<? echo $row['col_kodepos']; ?>'>
										 <A HREF="http://192.168.1.101/lismega_devel/script/maintainzipcode.php" target=lainnya>View Zipcode</A>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Certificate Type &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certtype<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_certtype']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Certificate No &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certno<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_certno']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certatasnama<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_certatasnama']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Luas Tanah &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_luastanah<? echo $i; ?> size=20 maxlength=8 value='<? echo $row['col_certluas']; ?>'> m2
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certdate<? echo $i; ?> size=20 maxlength=10 value='<? echo $rowcast['col_certdate']; ?>'>
															  <a href="javascript:NewCssCal('lndbldcol_certdate<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
										  <font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certdue<? echo $i; ?> size=20 maxlength=10 value='<? echo $rowcast['col_certdue']; ?>'>
															  <a href="javascript:NewCssCal('lndbldcol_certdue<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Relcode &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_relcode<? echo $i; ?> size=20 maxlength=10 value='<? echo $row['col_relcode']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_haktanggungan<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_haktanggungan']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_haktanggungantgl<? echo $i; ?> size=20 maxlength=10 value='<? echo $rowcast['col_haktanggungantgl']; ?>'>
															  <a href="javascript:NewCssCal('lndbldcol_haktanggungantgl<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Identification &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_identification<? echo $i; ?> size=20 maxlength=10 value='<? echo $row['col_identification']; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Year &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_njopyear<? echo $i; ?> size=20 maxlength=4 value='<? echo $row['col_njopyear']; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Val &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_njopval<? echo $i; ?> size=20 maxlength=10 value='<? echo $row['col_njopval']; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Remark &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_remark<? echo $i; ?> size=50 maxlength=250 value='<? echo $row['col_remark']; ?>'>
										</td>
									</tr>
								</TABLE>
							</td>
						</tr>
						<br>	
							
							
			
					</TABLE>
				
					<!-- <input type=button value='SUBMIT' style='width: 270mm' onclick=cekthis() > 
          	     	<input type=hidden name=act value='simpandata'>
      		     	<input type=hidden name=custnomid value='<? //echo $Custnomid; ?>'>
					<input type=hidden name=custfullname value='<? //echo $custfullname; ?>'>
      		     	<input type=hidden name=countbld value='<? //echo $countbld; ?>'> !-->
		<?
				} //tutup cast
			}
				}
			}
		?>
		<?
					//}//tutup for countBLDLND
				?>
				
				</TD>
			</TR>
		</TABLE>
		
     </div>