<?
		$tsqllainnya = "SELECT * FROM tbl_COL_Lainnya where ap_lisregno = '$custnomid' and col_id like '$colid'";
		$alainnya = sqlsrv_query($conn, $tsqllainnya);

		if ( $alainnya === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($alainnya))
		{  
			while($rowlainnya = sqlsrv_fetch_array($alainnya, SQLSRV_FETCH_ASSOC))
			{ 
		

?>		<div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" border = "0" >
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong>Lainnya</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowlainnya['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowlainnya['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jenis Jaminan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowlainnya['col_code'];?></td>				
			</tr>
			<tr>
				<td width=40% valign="top">Nomor Dokumen Jaminan </td>
				<td width=10% valign="top">:</td>
				<td width=50%><? echo nl2br($rowlainnya['col_nomordokumen']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Jaminan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowlainnya['col_nilaijaminan'];?></td>				
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