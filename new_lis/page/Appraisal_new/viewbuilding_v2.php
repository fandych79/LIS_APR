<?		
		$tsqlbuilding = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$custnomid' and col_id like '$colid'";
		$abuilding = sqlsrv_query($conn, $tsqlbuilding);
		
		if ( $abuilding === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($abuilding))
		{  
			if($rowbuilding = sqlsrv_fetch_array($abuilding, SQLSRV_FETCH_ASSOC))
			{ 
			
		$tsqlbuilding2 = "SELECT * FROM tbl_COL_Building where ap_lisregno = '$custnomid'  and col_id like '$colid'";
		$abuilding2 = sqlsrv_query($conn, $tsqlbuilding2);

		if ( $abuilding2 === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($abuilding2))
		{  
			while($rowbuilding2 = sqlsrv_fetch_array($abuilding2, SQLSRV_FETCH_ASSOC))
			{
		
?>
	<div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" border = "0" valign="top" style="border:1px solid black;">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong>Tanah dan Bangunan </strong></td>			
			</tr>
			</br>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_id'];?></td>				
			</tr>
			
<!--
			<tr>
				<td width=40%>NJOP Year   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Value  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowbuilding2['col_njopval']);?></td>				
			</tr>
-->
			<tr>
				<td width=100% colspan = "3" style="font-size:20;">&nbsp </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:15;"><strong>TANAH</strong></td>			
			</tr>
			<tr>
				<td width=40%>Alamat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kelurahan / Kecamatan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kota / Kabupaten  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tipe Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certtype'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Sertifikat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Terbit Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certdate']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Jatuh Tempo Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%>
				<? 
				if($rowbuilding['col_certdue']->format('Y') == 1900)
				{
					echo "-";
				}
				else{
					echo $rowbuilding['col_certdue']->format('d/m/Y');
				}
				?>
				</td>				
			</tr>
			<tr>
				<td width=40%>No GS/SU   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_gssuno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal GS/SU  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_gssutgl']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Pemegang Hak Atas Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certluas'];?></td>				
			</tr>
			<?php
				$relcode = $rowbuilding['col_relcode'];
				$relcodecode = $rowbuilding['col_relcode'];
				$tsql2 = "SELECT * FROM RFRELATION WHERE ACTIVE = 'True' AND REL_CODE = '$relcode'";
				$a2 = sqlsrv_query($conn, $tsql2);

					if ( $a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($a2))
					{ 
						if($rowbuildingType = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
						{
							$relcode = $rowbuildingType["REL_DESC"];
						}
					}
				   
			?>
			<tr>
				<td width=40%>Kode Relasi  </td>
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
				<td width=50%><? echo $rowbuilding2['col_devname'];?></td>				
			</tr>
<?
		}
?>
			<tr>
				<td width=40%>Nomor Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%>
				<? 
				if($rowbuilding['col_haktanggungantgl']->format('Y') == 1900)
				{
					echo "-";
				}
				else{
					echo $rowbuilding['col_haktanggungantgl']->format('d/m/Y');
				}
				?>
				</td>				
			</tr>
<!--
			<tr>
				<td width=40%>NJOP Year   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_njopyear'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP Value   </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowbuilding['col_njopval']);?></td>				
			</tr>
-->
			<tr>
				<td width=40%>Keterangan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_remark'];?></td>				
			</tr>
			
			<tr>
				<td width=100% colspan = "3" style="font-size:20;">&nbsp </td>			
			</tr>
			
			<tr>
				<td width=100% colspan = "3" style="font-size:15;"><strong>BANGUNAN</strong></td>			
			</tr>
			<!--
			<tr>
				<td width=40%>Alamat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kelurahan / Kecamatan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kota / Kabupaten  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_kodepos'];?></td>				
			</tr>
			-->
			<tr>
				<td width=40%>Tipe Collateral</td>
				<td width=10%>:</td>
				<td width=50%><? //echo $rowbuilding2['col_type'];?> Tanah dan Bangunan</td>				
			</tr>
			<?php
				$identification = $rowbuilding['col_identification'];
				$tsql2 = "SELECT * FROM RFIDENTIFICATION WHERE ACTIVE = 'True' AND IDTF_CODE = '$identification'";
				$a2 = sqlsrv_query($conn, $tsql2);

					if ( $a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($a2))
					{ 
						if($rowbuildingType = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
						{
							$identification = $rowbuildingType["IDTF_DESC"];
						}
					}
				   
			?>
			<tr>
				<td width=40%>Identifikasi   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $identification;?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor IMB  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_imbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal IMB  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_imbdate']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Luas IMB    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_imbluas'];?></td>				
			</tr>
	</table>
	</div>
<?
			}
		}
			}
		}
		else
		{
			echo '<div align="center" style="padding-left : 10px;" style="padding-right : 10px;"><br><font size=4px; color="red" style="padding-left : 1px;"><strong>BELUM DIISI DETAILNYA</strong></font><br></div>';
		}
?>
	