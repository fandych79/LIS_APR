<?
		$tsqlvehicle = "SELECT * FROM tbl_COL_Vehicle where ap_lisregno = '$custnomid' and col_id like '$colid'";
		$avehicle = sqlsrv_query($conn, $tsqlvehicle);

		if ( $avehicle === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($avehicle))
		{  
			while($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
			{ 
		
?><div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" style="border:1px solid black;">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong><?=$type_name;?></strong></td>			
			</tr>
			</br>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=40%>Application Number</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_id'];?></td>				
			</tr>
			<!--<tr>
				<td width=40%>Alamat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%> </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%> </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_kodepos'];?></td>				
			</tr>-->
			<tr>
				<td width=40%>Nomor polisi </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_nopol'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor STNK</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_stnk_no'];?></td>				
			</tr>
			<!--<tr>
				<td width=40%>STNK Exp  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_stnkexp']->format('Y/m/d');?></td>				
			</tr>-->
			<tr>
				<td width=40%>Nomor Faktur</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_fakturno'];?></td>				
			</tr>
			<!--<tr>
				<td width=40%>Faktur Tgl </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_fakturtgl']->format('Y/m/d');?></td>				
			</tr>-->
			<tr>
				<td width=40%>Nomor BPKB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Tgl  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbtgl']->format('Y/m/d');?></td>				
			</tr>
			<tr>
				<td width=40%>Type </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_type'];?></td>				
			</tr>
			<tr>
				<td width=40%>Model </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_model'];?></td>				
			</tr>
			<tr>
				<td width=40%>Merk  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_merk'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jenis Kendaraan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_jeniskendaran'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tahun Pembuatan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_tahunpembuatan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Umur </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_condition'];?> tahun</td>
			</tr>
			<tr>
				<td width=40%>Silinder  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_silinder'];?> cc</td>				
			</tr>
			<tr>
				<td width=40%>Warna</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_warna'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Rangka  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_norangka'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Mesin  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_nomesin'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Pajak  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_MK_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Nama</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat BPKB   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbaddr1'];?></td>				
			</tr>
			<tr>
				<td width=40%> </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbaddr2'];?></td>				
			</tr>
			<tr>
				<td width=40%></td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbaddr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Deskripsi </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_desc'];?></td>				
			</tr>
			
		</table>
	</div>
				<?
			}
		}
		else
		{
			echo '<div align="center" style="padding-left : 10px;" style="padding-right : 10px;"><br><font size=4px; color="red" style="padding-left : 1px;"><strong>BELUM DIISI DETAILNYA</strong></font><br></div>';
		}
	?>