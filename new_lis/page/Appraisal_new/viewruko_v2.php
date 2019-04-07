<?

		$lndcol_addr1 = "";
		$lndcol_addr2 = "";
		$lndcol_addr3 = "";
		$lndcol_kodepos = "";
		
		$tsqlland = "SELECT * FROM appraisal_land where _collateral_id = '$colid'";

		$aland= sqlsrv_query($conn, $tsqlland);

		if ( $aland === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($aland))
		{  
			if($rowland = sqlsrv_fetch_array($aland, SQLSRV_FETCH_ASSOC))
			{ 
				$lndcol_addr1 = $rowland['col_addr1'];
				$lndcol_addr2 = $rowland['col_addr2'];
				$lndcol_addr3 = $rowland['col_addr3'];
				$lndcol_kodepos = $rowland['col_kodepos'];
			}
		}
		
		$tsqlkios = "SELECT * FROM appraisal_ruko where _collateral_id like '$colid'";
		$akios = sqlsrv_query($conn, $tsqlkios);

		if ( $akios === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($akios))
		{  
			while($rowkios = sqlsrv_fetch_array($akios, SQLSRV_FETCH_ASSOC))
			{ 
		

?>		<div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" border = "0" style="border:1px solid black;">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong>Ruko</strong></td>			
			</tr>
			</br>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;"><hr width="100%" align="center"> </td>			
			</tr>
			<tr>
				<td width=40%>Application Number   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['ap_lisregno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Collateral ID  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_id'];?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $lndcol_addr1;?></td>				
			</tr>
			<tr>
				<td width=40%>Kelurahan / Kecamatan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $lndcol_addr2;?></td>				
			</tr>
			<tr>
				<td width=40%>Kota / Kabupaten  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $lndcol_addr3;?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $lndcol_kodepos;?></td>				
			</tr>
			<tr>
				<td width=40%>Hak Tanggungan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_haktanggungantgl']->format('d/m/Y');?></td>				
			</tr>
			<?php
				$relcode = $rowkios['col_relcode'];
				$relcodecode = $rowkios['col_relcode'];
				$tsql2 = "SELECT * FROM RFRELATION WHERE ACTIVE = 'True' AND REL_CODE = '$relcode'";
				$a2 = sqlsrv_query($conn, $tsql2);

					if ( $a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($a2))
					{ 
						if($rowkiosType = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
						{
							$relcode = $rowkiosType["REL_DESC"];
						}
					}
				   
			?>
			<tr>
				<td width=40%>Hubungan Pemegang Hak Calon Debitur</td>
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
				<td width=50%><? echo $rowkios['col_devname'];?></td>				
			</tr>
<?
		}
?>
<!--
			<tr>
				<td width=40%>NJOP YEAR Tanah</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_njopyearlnd'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP VAL Tanah</td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowkios['col_njopvallnd']);?></td>				
			</tr>
-->
			<tr>
				<td width=40%>Keterangan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_keteranganlnd'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Sertifikat</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tipe Sertifikat</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certtype'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certluas'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Terbit Sertifikat</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certdate']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Berakhir Hak</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certdue']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Nama Pemegang Hak</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor GS/SU</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_gssuno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal GS/SU</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_gssutgl']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td colspan=3>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=3><b>Bangunan</b></td>
			</tr>
			<tr>
				<td width=40%>Nomor IMB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_imbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal IMB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_imbdate']->format('d/m/Y');?></td>				
			</tr>
			<tr>
				<td width=40%>Luas IMB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_imbluas'];?></td>				
			</tr>
<!--
			<tr>
				<td width=40%>NJOP YEAR</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_njopyearbld'];?></td>				
			</tr>
			<tr>
				<td width=40%>NJOP VAL</td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowkios['col_njopvalbld']);?></td>				
			</tr>
-->
			<tr>
				<td width=40%>Keterangan</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_keteranganbld'];?></td>				
			</tr>
			<tr>
				<td width=40%>PPJB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_ppjb'];?></td>				
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