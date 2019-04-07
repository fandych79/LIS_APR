<?
		$tsql = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$Custnomid' and col_id like '$Custnomid"."LND%'";
		$a = sqlsrv_query($conn, $tsql);

		if ( $a === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($a))
		{  
			while($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
			{ 

		$ysql = "SELECT cast(col_certdate as varchar) as col_certdate, cast(col_certdue as varchar) as col_certdue, cast(col_haktanggungantgl as varchar) as col_haktanggungantgl, cast(col_appraisdate as varchar) as col_appraisdate FROM tbl_COL_Land where ap_lisregno = '$Custnomid' and col_id like '$Custnomid"."LND%'";
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
				<td width=100% colspan = "3" style="font-size:20;"><strong>Collateral Land</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat Jaminan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat Calon Debitur  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Address 3  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Certificate Type   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certtype'];?></td>				
			</tr>
			<tr>
				<td width=40%>Certificate No  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pemegang Hak Atas Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_certluas'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Terbit Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_certdate'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Jatuh Tempo Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_certdue'];?></td>				
			</tr>
			<tr>
				<td width=40%>Relcode   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_relcode'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowcast['col_haktanggungantgl'];?></td>				
			</tr>
			<tr>
				<td width=40%>Identification   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_identification'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Year   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Val   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_njopval'];?></td>				
			</tr>
			<tr>
				<td width=40%>Remark  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row['col_remark'];?></td>				
			</tr>
			
		</table>
				<?
			} //tutup cast
		}
			}
		}
	?>