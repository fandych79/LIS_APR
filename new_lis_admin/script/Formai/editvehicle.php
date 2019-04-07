<div align=center>
		<TABLE cellPadding=5 width="700" border=0>
			<TR>
				<TD align=left valign=top>
				
				<?php
								 $tsql = "SELECT count(*) as countvhc FROM Tbl_Cust_MasterCol where ap_lisregno = '$Custnomid' and cust_jeniscol='V01'";

									$a = sqlsrv_query($conn, $tsql);

									  if ( $a === false)
									  die( FormatErrors( sqlsrv_errors() ) );

									if(sqlsrv_has_rows($a))
									{  
							
										if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
										{ 
											$countvhc=$row['countvhc'];
										}
									}
				?>
				<?  $i=0;
					$tsql = "SELECT * FROM tbl_COL_Vehicle where ap_lisregno = '$Custnomid'";

					$a = sqlsrv_query($conn, $tsql);

					if ( $a === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($a))
					{  
						while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
						{ 
						$i++;
					$ysql = "SELECT cast(col_stnkexp as varchar) as col_stnkexp, cast(col_fakturtgl as varchar) as col_fakturtgl, cast(col_bpkbtgl as varchar) as col_bpkbtgl FROM tbl_COL_Vehicle where ap_lisregno = '$Custnomid'";

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
   	                          <font face=Arial size=2><b>KENDARAAN <? echo $i; ?>. &nbsp</b></font>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhcap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $row['ap_lisregno']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_id<? echo $i; ?> size=20 maxlength=20 value='<? echo $row['col_id']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Address 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr1']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Address 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr2']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Address 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_addr3']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_kodepos<? echo $i; ?> size=5 maxlength=5 value='<? echo $row['col_kodepos']; ?>'>
   	                          <A HREF="http://192.168.1.101/lismega_devel/script/maintainzipcode.php" target=lainnya>View Zipcode</A>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Nopol &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nopol<? echo $i; ?> size=10 maxlength=10 value='<? echo $row['col_nopol']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>STNK No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_stnk_no<? echo $i; ?> size=30 maxlength=30 value='<? echo $row['col_stnk_no']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>STNK Exp &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_stnkexp<? echo $i; ?> size=10 maxlength=10 value='<? echo $rowcast['col_stnkexp']; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_stnkexp<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Faktur No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_fakturno<? echo $i; ?> size=30 maxlength=30 value='<? echo $row['col_fakturno']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Faktur Tgl &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_fakturtgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $rowcast['col_fakturtgl']; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_fakturtgl<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbno<? echo $i; ?> size=30 maxlength=30 value='<? echo $row['col_bpkbno']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Tgl &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbtgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $rowcast['col_bpkbtgl']; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_bpkbtgl<? echo $i; ?>','yyyyMMdd')"><img src="../../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS yyyy/mm/dd</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Type &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_type<? echo $i; ?> size=10 maxlength=10 value='<? echo $row['col_type']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Model &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_model<? echo $i; ?> size=10 maxlength=10 value='<? echo $row['col_model']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Merk &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_merk<? echo $i; ?> size=10 maxlength=10 value='<? echo $row['col_merk']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Tahun Pembuatan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_tahunpembuatan<? echo $i; ?> size=4 maxlength=4 value='<? echo $row['col_tahunpembuatan']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Jenis Kendaraan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_jeniskendaran<? echo $i; ?> size=10 maxlength=10 value='<? echo $row['col_jeniskendaran']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Silinder &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_silinder<? echo $i; ?> size=4 maxlength=4 value='<? echo $row['col_silinder']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Warna &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_warna<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_warna']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>No Rangka &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_norangka<? echo $i; ?> size=30 maxlength=30 value='<? echo $row['col_norangka']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>No Mesin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nomesin<? echo $i; ?> size=30 maxlength=30 value='<? echo $row['col_nomesin']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Nama &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbnama<? echo $i; ?> size=30 maxlength=30 value='<? echo $row['col_bpkbnama']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Addr 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_bpkbaddr1']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Addr 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_bpkbaddr2']; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Addr 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $row['col_bpkbaddr3']; ?>'>
   	                       </td>
   	                    </tr>
   	                </TABLE>
                  	 <BR>

				<?
					//}//tutup for countVHC
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
      		     	<input type=hidden name=countbld value='<? //echo $countbld; ?>'>
      		     	<input type=hidden name=countvhc value='<? //echo $countvhc; ?>'> !-->
				
				</TD>
			</TR>
		</TABLE>
     </div>