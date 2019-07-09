<?
		

		$tsqlland = "SELECT * FROM appraisal_land where _collateral_id = '$colid'";
		$aland = sqlsrv_query($conn, $tsqlland);

		if ( $aland === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($aland))
		{  
			while($rowland = sqlsrv_fetch_array($aland, SQLSRV_FETCH_ASSOC))
			{ 
		

?>		<div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" border = "0" style="border:1px solid black;">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong><?=$type_name;?></strong></td>			
			</tr>
			</br>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $custnomid;?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $colid;?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kecamatan / Kelurahan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kota / Kabupaten </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_kodepos'];?></td>				
			</tr>
			<!--<tr>
				<td width=40%>Tipe Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_certtype'];?></td>				
			</tr>-->
			<tr>
				<td width=40%>Nomor Sertifikat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_certno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pemegang Hak Atas Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_certluas'];?> m2</td>				
			</tr>
			<!--<tr>
				<td width=40%>Tanggal Terbit Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_certdate']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Jatuh Tempo Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_certdue']->format('d/m/Y');?></td>				
			</tr>
			<?php
				$relcode = $rowland['col_relcode'];
				$relcodecode = $rowland['col_relcode'];
				$tsql2 = "SELECT * FROM RFRELATION WHERE ACTIVE = 'True' AND REL_CODE = '$relcode'";
				$a2 = sqlsrv_query($conn, $tsql2);

					if ( $a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($a2))
					{ 
						if($rowlandType = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
						{
							$relcode = $rowlandType["REL_DESC"];
						}
					}
				   
			?>
			<tr>
				<td width=40%>Kode Relasi   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $relcode;?></td>				
			</tr>
<?
		if($relcodecode=="DVL")
		{
?>
			<tr>
				<td width=40%>Nama Developer</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_devname'];?></td>				
			</tr>
<?
		}
?>
			<tr>
				<td width=40%>Nomor Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_haktanggungantgl']->format('d/m/Y');?></td>				
			</tr>
			<?php
				$identification = $rowland['col_identification'];
				$tsql2 = "SELECT * FROM RFIDENTIFICATION WHERE ACTIVE = 'True' AND IDTF_CODE = '$identification'";
				$a2 = sqlsrv_query($conn, $tsql2);

					if ( $a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($a2))
					{ 
						if($rowlandType = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
						{
							$identification = $rowlandType["IDTF_DESC"];
						}
					}
				   
			?>
			<tr>
				<td width=40%>Identifikasi   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $identification;?></td>				
			</tr>
<!--
			<tr>
				<td width=40%>NJOP Year   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Value   </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowland['col_njopval']);?></td>				
			</tr>
-->
			<!--<tr>
				<td width=40%>Remark  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowland['col_remark'];?></td>				
			</tr>-->
			
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