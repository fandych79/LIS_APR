	<div align=center>
		<TABLE cellPadding=5 width="700" border=0>
			<TR>
				<TD align=left valign=top>
<?
								 $csql = "SELECT count(*) as countcol FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' and cust_jeniscol='BA1'";

									$c = sqlsrv_query($conn, $csql);

									  if ( $c === false)
									  die( FormatErrors( sqlsrv_errors() ) );

									if(sqlsrv_has_rows($c))
									{  
							
										if($rowcn = sqlsrv_fetch_array($c, SQLSRV_FETCH_ASSOC))
										{ 
											$count=$rowcn['countcol'];
										}
									}
			?>
<?//----------------------------------------------------------------------------------------------------------------- Tanah dan Bangunan ?>
				<?	for($i=1;$i<=$countbld;$i++) 
					{ 
				?>
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
							<?
								$col_addr1 = "";
								$col_addr2 = "";
								$col_addr3 = "";
								$col_kodepos = "";
								$col_type = "";
								$col_imbno = "";
								$col_imbdate = "";
								$col_imbluas = "";
								$col_njopyear = "";
								$col_njopval = "";
								$tsql = "SELECT * FROM Tbl_Col_Building
   										WHERE ap_lisregno='$Custnomid'
   										AND col_id='BLDLND$i'";
   								$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   								$params = array(&$_POST['query']);
	
   								$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   								if ( $sqlConn === false)
									die( FormatErrors( sqlsrv_errors() ) );

   								if(sqlsrv_has_rows($sqlConn))
   								{
      								$rowCount = sqlsrv_num_rows($sqlConn);
      								while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      								{
								   		$col_addr1 = $row[2];
						   	   			$col_addr2 = $row[3];
								   		$col_addr3 = $row[4];
								   		$col_kodepos = $row[5];
										$col_type = $row[6];
									 	$col_imbno = $row[7];
									 	$col_imbdate = $row[8];
									 	$col_imbluas = $row[9];
										$col_njopyear = $row[10];
								   		$col_njopval = $row[11];
								   	}
   								}
   								sqlsrv_free_stmt( $sqlConn );
							?>
							
								<font face=Arial size=2>BANGUNAN</font>
								<TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Application Number &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $Custnomid; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Collateral ID &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
								<?php
									if($count > 0)
									{
										//echo $count;
										$count=$count+1;
										//echo $count;
										if($count<10)
										{
											$j="0".$count;
										}
										else
										{
											$j=$count;
										}
								
									}
									else
									{
										if($i<10)
										{
											$j="0".$i;
										}
										else
										{
											$j=$i;
										}
									}
								?>
											<input type=text name=bldcol_id<? echo $i; ?> size=20 maxlength=20  value='<? echo $Custnomid."BLDLND".$j; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 1 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 2 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 3 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Kodepos &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_kodepos<? echo $i; ?> size=5 maxlength=5 value='<? echo $col_kodepos; ?>'>
											<A HREF="http://192.168.1.101/lismega_devel/script/maintainzipcode.php" target=lainnya>View Zipcode</A>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Collateral Type &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<select name=bldcol_type<? echo $i; ?> value='<? echo $col_type; ?>'>
												<option value="RMH">Tanah dan Bangunan</option>
											</select>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>IMB No &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_imbno<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_imbno; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>IMB Date &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_imbdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_imbdate; ?>'>
		   		    						<a href="javascript:NewCssCal('bldcol_imbdate<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>IMB Luas &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_imbluas<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_imbluas; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Year &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_njopyear<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_njopyear; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Val &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=bldcol_njopval<? echo $i; ?> size=8 maxlength=10 value='<? echo $col_njopval; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									

								</table>
							</td>
						</tr>			
						<tr>
							<td align=left valign=top width=100%>
								<?
									$col_addr1 = "";
									$col_addr2 = "";
									$col_addr3 = "";
									$col_kodepos = "";
									$col_certtype = "";
									$col_certno = "";
									$col_certatasnama = "";
									$col_certluas = "";
									$col_certdate = "";
									$col_certdue = "";
									$col_relcode = "";
									$col_haktanggungan = "";
									$col_haktanggungantgl = "";
									$col_identification = "";
									$col_njopyear = "";
									$col_njopval = "";
									$col_remark = "";
									$tsql = "SELECT * FROM Tbl_Col_Land
   													WHERE ap_lisregno='$Custnomid'
   													AND col_id='LNDBLD$i'";
									$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
									$params = array(&$_POST['query']);
	
									$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

									if ( $sqlConn === false)
										die( FormatErrors( sqlsrv_errors() ) );

									if(sqlsrv_has_rows($sqlConn))
									{
										$rowCount = sqlsrv_num_rows($sqlConn);
										while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
										{
											$col_addr1 = $row[2];
											$col_addr2 = $row[3];
											$col_addr3 = $row[4];
											$col_kodepos = $row[5];
											$col_certtype = $row[6];
											$col_certno = $row[7];
											$col_certatasnama = $row[8];
											$col_certluas = $row[9];
											$col_certdate = $row[10];
											$col_certdue = $row[11];
											$col_relcode = $row[12];
											$col_haktanggungan = $row[13];
											$col_haktanggungantgl = $row[14];
											$col_identification = $row[15];
											$col_njopyear = $row[29];
											$col_njopval = $row[30];
											$col_remark = $row[31];
										}
									}
									sqlsrv_free_stmt( $sqlConn );
?>
							
							
							
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
											<input type=text name=lndbldap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $Custnomid; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Collateral ID &nbsp</font>
										</td>
										<?php
									if($count > 0)
									{
										//echo $count;
										//$count=$count+1;
										//echo $count;
										if($count<10)
										{
											$j="0".$count;
										}
										else
										{
											$j=$count;
										}
								
									}
									else
									{
										if($i<10)
										{
											$j="0".$i;
										}
										else
										{
											$j=$i;
										}
									}
								?>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_id<? echo $i; ?> size=20 maxlength=20 value='<? echo $Custnomid."BLDLND".$j; ?>'>
										</td>
									</tr>

									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Alamat Jaminan &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Alamat Calon Debitur &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Address 3 &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Kodepos &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_kodepos<? echo $i; ?> size=20 maxlength=5 value='<? echo $col_kodepos; ?>'>
										 <A HREF="http://192.168.1.101/lismega_devel/script/maintainzipcode.php" target=lainnya>View Zipcode</A>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Certificate Type &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certtype<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certtype; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Certificate No &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certno<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certno; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certatasnama<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certatasnama; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Luas Tanah &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_luastanah<? echo $i; ?> size=20 maxlength=8 value='<? echo $col_certluas; ?>'> m2
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certdate<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_certdate; ?>'>
															  <a href="javascript:NewCssCal('lndbldcol_certdate<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
										  <font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_certdue<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_certdue; ?>'>
															  <a href="javascript:NewCssCal('lndbldcol_certdue<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Relcode &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_relcode<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_relcode; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_haktanggungan<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_haktanggungan; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_haktanggungantgl<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_haktanggungantgl; ?>'>
															  <a href="javascript:NewCssCal('lndbldcol_haktanggungantgl<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
											<font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Identification &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_identification<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_identification; ?>'>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Year &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_njopyear<? echo $i; ?> size=20 maxlength=4 value='<? echo $col_njopyear; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>NJOP Val &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_njopval<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_njopval; ?>'>
											<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
										</td>
									</tr>
									<tr>
										<td width=20% align=left valign=top>
											<font face=Arial size=2>Remark &nbsp</font>
										</td>
										<td width=80% align=left valign=top>
											<input type=text name=lndbldcol_remark<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_remark; ?>'>
										</td>
									</tr>
								</TABLE>
							</td>
						</tr>
						<br>	
							
							
			
					</TABLE>
				<?
					}//tutup for countBLDLND
				?>
					<!-- <input type=button value='SUBMIT' style='width: 270mm' onclick=cekthis() > 
          	     	<input type=hidden name=act value='simpandata'>
      		     	<input type=hidden name=custnomid value='<? //echo $Custnomid; ?>'>
					<input type=hidden name=custfullname value='<? //echo $custfullname; ?>'>
      		     	<input type=hidden name=countbld value='<? //echo $countbld; ?>'> !-->

				
				</TD>
			</TR>
		</TABLE>
     </div>