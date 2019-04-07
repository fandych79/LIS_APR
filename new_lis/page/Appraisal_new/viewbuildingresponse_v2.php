<?		
		require ("../../lib/open_con_apr.php");

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
		<table width = "100%" align = "center" border = "0" valign="top">
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
			<tr>
				<td width=40%>Alamat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%> </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_addr3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kodepos </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_kodepos'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tipe Collateral</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_type'];?></td>				
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
				<td width=50%><? echo $rowbuilding2['col_imbdate']->format('Y/m/d');?></td>				
			</tr>
			<tr>
				<td width=40%>Luas IMB    </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding2['col_imbluas'];?></td>				
			</tr>
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
			<?
				//-----------------------------
				$liscolid = $rowbuilding['col_id'];
				
				$tsql2 = "SELECT * FROM COLLATERAL_BLD where LISCOL_ID = '$liscolid'";
				
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
						$COL_ID = $row2['COL_ID'];
						$COLMASTERID = $row2['COLMASTER_ID'];
					}
				}
				
				$tsql2 = "SELECT * FROM APPRAISAL_BLD where COL_ID = '$COL_ID'";

				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row3 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
					
			?>
			<tr>
				<td width=40%>Rangka   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['RGKUT_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lantai   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['LNTAI_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Dinding   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['DDING_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Langit  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['LNGIT_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Rangka Atap  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['ATAP_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jumlah Lantai  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['JMLLT_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Pembagian Ruang  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['PEMBAGIAN_RUANG'];?></td>				
			</tr>
			<tr>
				<td width=40%>Dihuni Oleh  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['HUNI_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Fasilitas Building </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['FASILITAS_BANGUNAN'];?></td>				
			</tr>
			<tr>
				<td width=40%>Description </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['NOTE'];?></td>				
			</tr>
			
			<?

			
			$tsql2 = "SELECT * FROM APPRAISAL_TYPE1_ANALISA_LINGKUNGAN where COLMASTER_ID = '$COLMASTERID'";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row3 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
			
			?>
			
			<tr>
				<td width=40%>Pencapaian  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['JALAN_PENCAPAIAN'];?></td>				
			</tr>
			<tr>
				<td width=40%>Jalan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['PMKJLN_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lebar Jalan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['LEBAR_JLNDPNLOK'];?></td>				
			</tr>
			<tr>
				<td width=40%>Kondisi Jalan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['CNDJLN_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah Jalan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['LLARAH_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Intensitas Jalan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['LLINTN_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Fasilitas Umum  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['FASILITAS_UMUM'];?></td>				
			</tr>
			<tr>
				<td width=40%>Fasilitas Angkutan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['FASILITAS_ANGKUTAN'];?></td>				
			</tr>
			<tr>
				<td width=40%>Object Penting </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['OBJEK_PENTING_DEKAT_LOKASI'];?></td>				
			</tr>
			<tr>
				<td width=40%>Peruntukan Lingkungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['PRNTK_CODE'];?></td>				
			</tr>
					
			<?
					}
				}
					}
				}
			?>
			<tr>
				<td width=100% colspan = "3" style="font-size:20;">&nbsp </td>			
			</tr>
			<tr>
				<td width=100% colspan = "3" style="font-size:15;"><strong>Tanah</strong></td>			
			</tr>
			<tr>
				<td width=40%>Alamat </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_addr1'];?></td>				
			</tr>
			<tr>
				<td width=40%> </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_addr2'];?></td>				
			</tr>
			<tr>
				<td width=40%>  </td>
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
				<td width=40%>Pemegang Hak Atas Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certatasnama'];?></td>				
			</tr>
			<tr>
				<td width=40%>Luas Tanah   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certluas'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Terbit Sertifikat   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certdate']->format('Y/m/d');?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Jatuh Tempo Sertifikat  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_certdue']->format('Y/m/d');?></td>				
			</tr>
			<?php
				$relcode = $rowbuilding['col_relcode'];
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
			<tr>
				<td width=40%>Nomor Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_haktanggungantgl']->format('Y/m/d');?></td>				
			</tr>
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
			<tr>
				<td width=40%>Remark  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_remark'];?></td>				
			</tr>
			
			<?
				//-----------------------------
				
				$liscolid = $rowbuilding['col_id'];
				$COL_ID = "";
				$COLMASTERID = "";
				
				$tsql2 = "SELECT * FROM COLLATERAL_LND where LISCOL_ID = '$liscolid'";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
						$COL_ID = $row2['COL_ID'];
						$COLMASTERID = $row2['COLMASTER_ID'];
					}
				}
				
				$tsql2 = "SELECT * FROM APPRAISAL_LND where COL_ID = '$COL_ID'";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
			?>

			<?
				$TPGF = $row2['TPGF_CODE'];
				$tsqlside = "SELECT * FROM RFTOPOGRAPHY where TPGF_CODE = '$TPGF'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$TPGF = $rowside['TPGF_DESC'];
					}
				}
				
			?>
			<tr>
				<td width=40%>Topografi </td>
				<td width=10%>:</td>
				<td width=50%><? echo $TPGF;?></td>				
			</tr>
			
			<?
				$BNTK = $row2['BTKTNH_CODE'];
				$tsqlside = "SELECT * FROM RFBENTUKTANAH where BTKTNH_CODE = '$BNTK'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$BNTK = $rowside['BTKTNH_DESC'];
					}
				}
				
			?>			
			
			<tr>
				<td width=40%>Bentuk Tanah </td>
				<td width=10%>:</td>
				<td width=50%><? echo $BNTK; ?></td>				
			</tr>
			<tr>
				<td width=40%>Panjang Tanah </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['LND_LENM2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Lebar Tanah </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['LND_WIDM2'];?></td>				
			</tr>
			<?
				$side1 = $row2['BDRY_SIDE1'];
				$side2 = $row2['BDRY_SIDE2'];
				$side3 = $row2['BDRY_SIDE3'];
				$side4 = $row2['BDRY_SIDE4'];
				
				$tsqlside = "SELECT * FROM ENUMSIDE where SIDE_CODE = '$side1'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$side1 = $rowside['SIDE_DESC'];
					}
				}
			
				$tsqlside = "SELECT * FROM ENUMSIDE where SIDE_CODE = '$side2'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$side2 = $rowside['SIDE_DESC'];
					}
				}

				$tsqlside = "SELECT * FROM ENUMSIDE where SIDE_CODE = '$side3'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$side3 = $rowside['SIDE_DESC'];
					}
				}

				$tsqlside = "SELECT * FROM ENUMSIDE where SIDE_CODE = '$side4'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$side4 = $rowside['SIDE_DESC'];
					}
				}
			
			
				$arah1 = $row2['BDRY_CDNDIR1'];
				$arah2 = $row2['BDRY_CDNDIR2'];
				$arah3 = $row2['BDRY_CDNDIR3'];
				$arah4 = $row2['BDRY_CDNDIR4'];
			
				$tsqlside = "SELECT * FROM ENUMCARDINALDIR where CDNDIR_CODE = '$arah1'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$arah1 = $rowside['CDNDIR_DESC'];
					}
				}
				
								$tsqlside = "SELECT * FROM ENUMCARDINALDIR where CDNDIR_CODE = '$arah2'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$arah2 = $rowside['CDNDIR_DESC'];
					}
				}
				
								$tsqlside = "SELECT * FROM ENUMCARDINALDIR where CDNDIR_CODE = '$arah3'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$arah3 = $rowside['CDNDIR_DESC'];
					}
				}
				
				$tsqlside = "SELECT * FROM ENUMCARDINALDIR where CDNDIR_CODE = '$arah4'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$arah4 = $rowside['CDNDIR_DESC'];
					}
				}
			
			?>
			<tr>
				<td width=40%>Arah / Batas I (<? echo $side1; ?>) </td>
				<td width=10%>:</td>
				<td width=50%><? echo $arah1; ?> / <?echo $row2['BDRY_DATA1'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah / Batas II (<? echo $side2; ?>) </td>
				<td width=10%>:</td>
				<td width=50%><? echo $arah2; ?> / <?echo $row2['BDRY_DATA2'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah / Batas III (<? echo $side3; ?>) </td>
				<td width=10%>:</td>
				<td width=50%><? echo $arah3; ?> / <?echo $row2['BDRY_DATA3'];?></td>				
			</tr>
			<tr>
				<td width=40%>Arah / Batas IV (<? echo $side4; ?>) </td>
				<td width=10%>:</td>
				<td width=50%><? echo $arah4; ?> / <?echo $row2['BDRY_DATA4'];?></td>				
			</tr>
			<?
				$Banjir = $row2['CNDDRH_CODE'];
				$tsqlside = "SELECT * FROM RFKONDISIDAERAH where CNDDRH_CODE = '$Banjir'";
				$aside = sqlsrv_query($conn, $tsqlside);

				if ($aside === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($aside))
				{  
					if($rowside = sqlsrv_fetch_array($aside, SQLSRV_FETCH_ASSOC))
					{ 
						$Banjir = $rowside['CNDDRH_DESC'];
					}
				}
				
			?>				
			<tr>
				<td width=40%>Banjir  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $Banjir;?></td>				
			</tr>
					
			<?			
				
					}
				}	

			?>
			<tr>
				<td width=100% colspan="2">&nbsp;</td>				
			</tr>
			<tr>
				<td width=100% colspan="2"><b>NILAI - NILAI</b></td>				
			</tr>
			<?

			$tsql2 = "SELECT * FROM APPRAISAL_TYPE1_PENILAIAN where COLMASTER_ID = '$COLMASTERID'";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row3 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
			
			?>	
					
			<tr>
				<td width=40%>Nilai Tanah Total  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_TANAH_TOTAL']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Bangunan Fisik Total  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_BANG_FISIK_TOTAL']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Bangunan IMB Total  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_BANG_IMB_TOTAL']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Total Fisik  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_TOTAL_FISIK']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Total IMB  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_TOTAL_IMB']);?></td>				
			</tr>
			<tr>
				<td width=40%>Safety Margin  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['SAFETY_MARGIN'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Likuidasi Fisik  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_LIKUIDASI_FISIK']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Likuidasi IMB </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NILAI_LIKUIDASI_IMB']);?></td>				
			</tr>
			<tr>
				<td width=40%>Safety Margin Fisik </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['SAFETY_MARGIN_FISIK'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraiser   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Appraise   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowbuilding['col_appraisdate']->format('Y/m/d');?></td>				
			</tr>
			<?
				if ($rowbuilding['COL_MK_CODE'] == "MK_M")
				{
					$mkcode = "Marketable";
				}
				else if ($rowbuilding['COL_MK_CODE'] == "MK_T")
				{
					$mkcode = "Tidak Marketable";				
				}
				else
				{
					$mkcode = "";
				}
			?>
			<tr>
				<td width=40%>Marketable/Tidak Marketable  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $mkcode;?></td>				
			</tr>
		<?
					}
				}
		?>
			<?
				$colid = $rowbuilding['col_id'];
				$memo = "";
				$info = "";
				$positif = "";
				$negatif = "";
				$note = "";
				
				$tsql2 = "SELECT * FROM MEMO where MM_ID = '$colid'";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					while($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
						if($memo == "")
						{
							$memo = "- ".$row2['MM_MESSAGE'];
						}
						else
						{
							$memo = $memo."<br>- ".$row2['MM_MESSAGE'];
						}
					}
				}
				
				$tsql2 = "SELECT * FROM APPRAISAL_OPINI WHERE COLMASTER_ID IN (SELECT COLMASTER_ID FROM COLLATERAL_BLD WHERE LISCOL_ID = '$colid')";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					while($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
						$info = $row2['INFO'];
						$positif = $row2['EVALPOS'];
						$negatif = $row2['EVALNEG'];
						$note = $row2['EVALNOTE'];
					}
				}
			?>
			<tr>
				<td width=40% valign=top>Memo   </td>
				<td width=10% valign=top>:</td>
				<td width=50%><? echo $memo;?></td>				
			</tr>
			<tr>
				<td width=40% valign=top>Info   </td>
				<td width=10% valign=top>:</td>
				<td width=50%><? echo $info;?></td>				
			</tr>
			<tr>
				<td width=40% valign=top>Positif   </td>
				<td width=10% valign=top>:</td>
				<td width=50%><? echo $positif;?></td>				
			</tr>
			<tr>
				<td width=40% valign=top>Negatif   </td>
				<td width=10% valign=top>:</td>
				<td width=50%><? echo $negatif;?></td>				
			</tr>
			<tr>
				<td width=40% valign=top>Catatan   </td>
				<td width=10% valign=top>:</td>
				<td width=50%><? echo $note;?></td>				
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
	