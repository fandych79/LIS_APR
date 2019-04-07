<?
		$tsql = "SELECT * FROM tbl_COL_Vehicle where ap_lisregno = '$Custnomid'";

		$a = sqlsrv_query($conn, $tsql);

		if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a))
		{  
			while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{ 
			
		$ysql = "SELECT cast(col_stnkexp as varchar) as col_stnkexp, cast(col_fakturtgl as varchar) as col_fakturtgl, cast(col_bpkbtgl as varchar) as col_bpkbtgl FROM tbl_COL_Vehicle where ap_lisregno = '$Custnomid'";

		$b = sqlsrv_query($conn, $ysql);

		if ( $b === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($b))
		{  
			if($rowcast = sqlsrv_fetch_array($b, SQLSRV_FETCH_ASSOC))
			{ 
	?>
		<table width = "700" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><strong>Collateral Vehicle</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=40%>Application Number</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 1  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 2  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 3  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nopol </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_nopol'];?></td>				
			</tr>
			<tr>
				<td width=40%>STNK No </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_stnk_no'];?></td>				
			</tr>
			<tr>
				<td width=40%>STNK Exp  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_stnkexp'];?></td>				
			</tr>
			<tr>
				<td width=40%>Faktur No </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_fakturno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Faktur Tgl </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_fakturtgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB No</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Tgl  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_bpkbtgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>Type </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_type'];?></td>				
			</tr>
			<tr>
				<td width=40%>Model </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_model'];?></td>				
			</tr>
			<tr>
				<td width=40%>Merk  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_merk'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tahun Pembuatan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_tahunpembuatan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jenis Kendaraan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_jeniskendaran'];?></td>				
			</tr>
			<tr>
				<td width=40%>Silinder  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_silinder'];?></td>				
			</tr>
			<tr>
				<td width=40%>Warna</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_warna'];?></td>				
			</tr>
			<tr>
				<td width=40%>No Rangka  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_norangka'];?></td>				
			</tr>
			<tr>
				<td width=40%>No Mesin  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_nomesin'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Nama</td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Addr 1   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbaddr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Addr 2 </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbaddr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Addr 3 </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_bpkbaddr3'];?></td>				
			</tr>
		
			
		</table>
				<?
			} //tutup cast
		}
			}
		}
	?>