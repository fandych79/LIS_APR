<?
	require ("../../lib/open_con_apr.php");
		$tsqlvehicle = "SELECT * FROM tbl_COL_Vehicle where ap_lisregno = '$custnomid' and col_id like '$colid'";
		$avehicle = sqlsrv_query($conn, $tsqlvehicle);

		if ( $avehicle === false)
			die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($avehicle))
		{  
			while($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
			{ 
		
				$liscolid1 = $rowvehicle['col_id'];
				$stnkexp = "";
				$fakturtgl = "";
				$bpkbtgl = "";
				$type = "";
				$model = "";
				$merk = "";
				$tahunpembuatan = "";
				$jeniskendaraan = "";
				$silinder = "";
				$warna = "";
				$nomorrangka = "";
				$nomormesin = "";
				$bpkbnama = "";
				$alamatbpkb1 = "";
				$alamatbpkb2 = "";
				$alamatbpkb3 = "";
				
				
				$tsql2 = "SELECT * FROM APPRAISAL_VHC WHERE COLMASTER_ID IN (SELECT COLMASTER_ID FROM COLLATERAL_VHC WHERE LISCOL_ID = '$liscolid1')";
				$a2 = sqlsrv_query($connapr, $tsql2);

				if ($a2 === false)
					die( FormatErrors( sqlsrv_errors() ) );

				if(sqlsrv_has_rows($a2))
				{  
					if($row2 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
					{ 
						$stnkexp = $row2["STNK_EXP"]->format('Y/m/d');
						$fakturtgl = $row2["FAKTUR_TGL"]->format('Y/m/d');
						$bpkbtgl = $row2["BPKB_TGL"]->format('Y/m/d');
						$type = $row2["TYPE"];
						$model = $row2["MODEL"];
						$merk = $row2["MERK"];
						$tahunpembuatan = $row2["THNPEMBUATAN"];
						$jeniskendaraan = $row2["JNS_KENDARAAN"];
						$silinder = $row2["SILINDER_ISI"];
						$warna = $row2["SILINDER_WRN"];
						$nomorrangka = $row2["NORANGKA"];
						$nomormesin = $row2["NOMESIN"];
						$bpkbnama = $row2["BPKB_NAMA"];
						$alamatbpkb1 = $row2["BPKB_ADDR1"];
						$alamatbpkb2 = $row2["BPKB_ADDR2"];
						$alamatbpkb3 = $row2["BPKB_ADDR3"];
					}
				}
				
?><div  style="padding-left : 10px;" style="padding-right : 10px;">
		<table width = "100%" align = "center" border = "0">
			<tr>
				<td width=100% colspan = "3" style="font-size:20;" align="center"><strong>Kendaraan Pribadi</strong></td>			
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
			<tr>
				<td width=40%>STNK Exp  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $stnkexp;?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Faktur</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_fakturno'];?></td>				
			</tr>
			<tr>
				<td width=40%>Faktur Tgl </td>
				<td width=10%>:</td>
				<td width=50%><? echo $fakturtgl;?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor BPKB</td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_bpkbno'];?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Tgl  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $bpkbtgl;?></td>				
			</tr>
			<tr>
				<td width=40%>Type </td>
				<td width=10%>:</td>
				<td width=50%><? echo $type;?></td>				
			</tr>
			<tr>
				<td width=40%>Model </td>
				<td width=10%>:</td>
				<td width=50%><? echo $model;?></td>				
			</tr>
			<tr>
				<td width=40%>Merk  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $merk;?></td>				
			</tr>
			<tr>
				<td width=40%>Tahun Pembuatan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $tahunpembuatan;?></td>				
			</tr>
			<tr>
				<td width=40%>Jenis Kendaraan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $jeniskendaraan;?></td>				
			</tr>
			<tr>
				<td width=40%>Silinder  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $silinder;?></td>				
			</tr>
			<tr>
				<td width=40%>Warna</td>
				<td width=10%>:</td>
				<td width=50%><? echo $warna;?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Rangka  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $nomorrangka;?></td>				
			</tr>
			<tr>
				<td width=40%>Nomor Mesin  </td>
				<td width=10%>:</td>
				<td width=50%><? echo $nomormesin;?></td>				
			</tr>
			<tr>
				<td width=40%>BPKB Nama</td>
				<td width=10%>:</td>
				<td width=50%><? echo $bpkbnama;?></td>				
			</tr>
			<tr>
				<td width=40%>Alamat BPKB   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $alamatbpkb1;?></td>				
			</tr>
			<tr>
				<td width=40%> </td>
				<td width=10%>:</td>
				<td width=50%><? echo $alamatbpkb2;?></td>				
			</tr>
			<tr>
				<td width=40%></td>
				<td width=10%>:</td>
				<td width=50%><? echo $alamatbpkb3;?></td>				
			</tr>
			<!--<tr>
				<td width=40%>Deskripsi </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_desc'];?></td>				
			</tr>-->
			
			<?
			//-----------------------------
			
			$liscolid = $rowvehicle['col_id'];
			$COL_ID = "";
			$COLMASTERID = "";
			
			$tsql2 = "SELECT * FROM COLLATERAL_VHC where LISCOL_ID = '$liscolid'";
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
			
			$tsql2 = "SELECT * FROM APPRAISAL_VHC where COL_ID = '$COL_ID'";
			$a2 = sqlsrv_query($connapr, $tsql2);

			if ($a2 === false)
				die( FormatErrors( sqlsrv_errors() ) );

			if(sqlsrv_has_rows($a2))
			{  
				if($row3 = sqlsrv_fetch_array($a2, SQLSRV_FETCH_ASSOC))
				{ 
			?>
			<tr>
				<td width=40%>Condition </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row2['COND_CODE'];?></td>				
			</tr>
			<tr>
				<td width=40%>Perlengkapan </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['PERLENGKAPAN'];?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Wajar </td>
				<td width=10%>:</td>
				<td width=50%><? numberFormat($row3['NILAIWAJAR']);?><? echo numberFormat($row3['NILAIWAJAR']);?></td>				
			</tr>
			<tr>
				<td width=40%>Nilai Likuidasi </td>
				<td width=10%>:</td>
				<td width=50%><? echo numberFormat($row3['NIL_LIKUIDASI']);?></td>				
			</tr>
			<tr>
				<td width=40%>Safe Margin </td>
				<td width=10%>:</td>
				<td width=50%><? echo $row3['SAFETYMARGIN'];?></td>				
			</tr>
			
			<tr>
				<td width=40%>Appraiser   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_appraiser'];?></td>				
			</tr>
			<tr>
				<td width=40%>Tanggal Appraise   </td>
				<td width=10%>:</td>
				<td width=50%><? echo $rowvehicle['col_appraisdate']->format('Y/m/d');?></td>				
			</tr>
			<?
				if ($rowvehicle['col_MK_CODE'] == "MK_M")
				{
					$mkcode = "Marketable";
				}
				else if ($rowvehicle['col_MK_CODE'] == "MK_T")
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
				}
			}	
			?>
			<?
				$colid = $rowvehicle['col_id'];
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
				
				$tsql2 = "SELECT * FROM APPRAISAL_OPINI WHERE COLMASTER_ID IN (SELECT COLMASTER_ID FROM COLLATERAL_VHC WHERE LISCOL_ID = '$colid')";
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