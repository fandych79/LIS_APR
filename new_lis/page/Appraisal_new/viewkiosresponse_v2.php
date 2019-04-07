<?
		require ("../../lib/open_con_apr.php");
		
		$tsqlkios = "SELECT * FROM tbl_COL_Kios where ap_lisregno = '$custnomid' and col_id like '$colid'";
		$akios = sqlsrv_query($conn, $tsqlkios);

		if ( $akios === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($akios))
		{  
			while($rowkios = sqlsrv_fetch_array($akios, SQLSRV_FETCH_ASSOC))
			{ 
		

?>		<div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" border = "0" >
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong>Kios</strong></td>			
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
				<td width=40%>Hak Tanggungan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_haktanggungan'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Hak Tanggungan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_haktanggungantgl']->format('Y/m/d');?></td>				
			</tr>
			<?php
				$relcode = $rowkios['col_relcode'];
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
				<td width=50%><? echo $rowkios['col_certdate']->format('Y/m/d');?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Berakhir Hak</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_certdue']->format('Y/m/d');?></td>				
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
				<td width=50%><? echo $rowkios['col_gssutgl']->format('Y/m/d');?></td>				
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
				<td width=50%><? echo $rowkios['col_imbdate']->format('Y/m/d');?></td>				
			</tr>
			<tr>
				<td width=40%>Luas IMB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_imbluas'];?></td>				
			</tr>
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
			
			<?	
			//-----------------------------

				$liscolid = $rowkios['col_id'];
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
				<td width=40%>Safe Margin   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_safemargin'];?></td>				
			</tr>
			<tr>
				<td width=40%>Appraiser   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Appraise  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowkios['col_appraisdate']->format('Y/m/d');?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Wajar  </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowkios['col_nilaiwajar']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Likuidasi   </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($rowkios['col_nilailikuidasi']);?></td>				
			</tr>
			<?
				if ($rowkios['col_mk_code'] == "MK_M")
				{
					$mkcode = "Marketable";
				}
				else if ($rowkios['col_mk_code'] == "MK_T")
				{
					$mkcode = "Tidak Marketable";				
				}
				else
				{
					$mkcode = "";
				}
			?>
			<tr>
				<td width=40%>Marketable/Tidak Marketable   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $mkcode;?></td>				
			</tr>
			<?
				$colid = $rowkios['col_id'];
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
				
				$tsql2 = "SELECT * FROM APPRAISAL_OPINI WHERE COLMASTER_ID IN (SELECT COLMASTER_ID FROM COLLATERAL_LND WHERE LISCOL_ID = '$colid')";
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
		else
		{
			echo '<div align="center" style="padding-left : 10px;" style="padding-right : 10px;"><br><font size=4px; color="red" style="padding-left : 1px;"><strong>BELUM DIISI DETAILNYA</strong></font><br></div>';
		}
	?>