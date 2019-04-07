<div align=center>
		<TABLE cellPadding=5 width="700" border=0>
			<TR>
				<TD align=left valign=top>
				<?php
								 $tsql = "SELECT count(*) as countlnd FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' and cust_jeniscol='TAN'";

									$a = sqlsrv_query($conn, $tsql);

									  if ( $a === false)
									  die( FormatErrors( sqlsrv_errors() ) );

									if(sqlsrv_has_rows($a))
									{  
							
										if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
										{ 
											$countlnd=$row['countlnd'];
										}
									}
				?>
				
				<?
							$i=0;
							$tsql = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$Custnomid' and col_id like '$Custnomid"."LND%'";
							$a = sqlsrv_query($conn, $tsql);

							if ( $a === false)
								die( FormatErrors( sqlsrv_errors() ) );

							if(sqlsrv_has_rows($a))
							{  
								while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
								{ 
								$i++;
							$ysql = "SELECT cast(col_certdate as varchar) as col_certdate, cast(col_certdue as varchar) as col_certdue, cast(col_haktanggungantgl as varchar) as col_haktanggungantgl, cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Land where ap_lisregno = '$Custnomid' and col_id like '$Custnomid"."LND%'";
							$b = sqlsrv_query($conn, $ysql);

							if ( $b === false)
								die( FormatErrors( sqlsrv_errors() ) );

							if(sqlsrv_has_rows($b))
							{  
								if($rowcast = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
								{ 			

							
				?>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=100% align=left valign=top>
								<font face=Arial size=2><b>TANAH <? echo $i; ?>. &nbsp</b></font>
							</td>
   	                    </tr>						
					</TABLE>
					
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Application Number &nbsp</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text name=lndap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $row["ap_lisregno"]; ?>'>
							</td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Collateral ID &nbsp</font>
							</td>
							
							<td width=70% align=left valign=top>
								<input type=text name=lndcol_id<? echo $i; ?> size=20 maxlength=20 value='<? echo $row["col_id"]; ?>'>
							</td>
   	                    </tr>
						<tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Alamat Jaminan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $row["col_addr1"]; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Alamat Calon Debitur &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr2']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Address 3 &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr3']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Kodepos &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_kodepos<? echo $i; ?> size=20 maxlength=5 value='<? echo $row['col_kodepos']; ?>'>
   	                         <A HREF="http://192.168.1.101/lismega_devel/script/maintainzipcode.php" target=lainnya>View Zipcode</A>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Certificate Type &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certtype<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_certtype']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Certificate No &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certno<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_certno']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certatasnama<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_certatasnama']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Luas Tanah &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_luastanah<? echo $i; ?> size=20 maxlength=8 value='<? echo $row['col_certluas']; ?>' onChange=goVal2()> m2
								<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certdate<? echo $i; ?> size=20 maxlength=10 value='<? echo $rowcast['col_certdate']; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_certdate<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certdue<? echo $i; ?> size=20 maxlength=10 value='<? echo $rowcast['col_certdue']; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_certdue<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Relcode &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_relcode<? echo $i; ?> size=20 maxlength=10 value='<? echo $row['col_relcode']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_haktanggungan<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_haktanggungan']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_haktanggungantgl<? echo $i; ?> size=20 maxlength=10 value='<? echo $rowcast['col_haktanggungantgl']; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_haktanggungantgl<? echo $i; ?>','yyyyMMdd')"><img src="../../Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Identification &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_identification<? echo $i; ?> size=20 maxlength=10 value='<? echo $row['col_identification']; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>NJOP Year &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_njopyear<? echo $i; ?> size=20 maxlength=4 value='<? echo $row['col_njopyear']; ?>'>
								<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>NJOP Val &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_njopval<? echo $i; ?> size=20 maxlength=10 value='<? echo $row['col_njopval']; ?>'>
								<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Remark &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_remark<? echo $i; ?> size=50 maxlength=250 value='<? echo $row['col_remark']; ?>'>
							</td>
   	                    </tr>
   	                    
					</TABLE>
					<BR>
				<?
					//}//tutup for countLND
				?>
				<?
			} //tutup cast
		}
			}
		}
	?>
					<!-- <input type=button value='SUBMIT' style='width: 225mm' onclick=cekthis()> 
          	     	<input type=hidden name=act value='simpandata'>
      		     	<input type=hidden name=custnomid value='<? //echo $Custnomid; ?>'>
					<input type=hidden name=custfullname value='<? //echo $custfullname; ?>'>
      		     	<input type=hidden name=countlnd value='<? //echo $countlnd; ?>'>
					<input type=hidden name=lndCOL_NILAIWAJAR<? //echo $i; ?>>
					<input type=hidden name=lndCOL_NILAILIKUIDASI<? //echo $i; ?>>
					<input type=hidden name=lndCOl_MK_CODE<? //echo $i; ?>> !-->
				
				</TD>
			</TR>
		</TABLE>
     </div>