<div align=center>
<script type="text/javascript">	

function HitungTotalTanah() {
	var angka = document.getElementById('harga_permeter_tanah').value.replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "");
	if (angka >= 1) {
	var sf = document.getElementById('luas_tanah').value;
	var vsf = parseInt(angka)*parseInt(sf);
	document.getElementById('harga_total_tanah').value = tandaPemisahTitik(vsf);
	return false;
	}
	else
	{
		document.getElementById('harga_total_tanah').value = 0;
	}
}
function HitungTotalBangunan() {
	var angka = document.getElementById('harga_permeter_bangunan').value.replace(",", "").replace(",", "").replace(",", "").replace(",", "").replace(",", "");
	if (angka >= 1) {
	var sf = document.getElementById('luas_bangunan').value;
	var vsf = parseInt(angka)*parseInt(sf);
	document.getElementById('harga_total_bangunan').value = tandaPemisahTitik(vsf);
	return false;
	}
	else
	{
		document.getElementById('harga_total_bangunan').value = 0;
	}
}

function HitungTotalNJOP()
{
	var htanah = parseInt(document.getElementById('harga_total_tanah').value.replaceAll(',',''));
	var hbang = parseInt(document.getElementById('harga_total_bangunan').value.replaceAll(',',''));
	var total = htanah + hbang;
	
	document.getElementById('bldcol_njopval').value = tandaPemisahTitik(total);
}

function format_currency(n, currency) {
          return currency + " " + n.toFixed(0).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
      }

String.prototype.replaceAll = function(search, replacement) {
   var target = this;
   return target.replace(new RegExp(search, 'g'), replacement);
};
</script>
<?
	  $custjeniscol = "";
		$tsqlvehicle = "SELECT cust_jeniscol FROM Tbl_Cust_MasterCol where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
		$avehicle = sqlsrv_query($conn, $tsqlvehicle);
		if ( $avehicle === false)
						die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($avehicle))
		{  
				if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
				{ 
							$custjeniscol = $rowvehicle['cust_jeniscol'];
				}
		}

		$custnamacol = "";
		$tsqlvehicle = "SELECT col_name FROM TblCollateralType where col_code = '$custjeniscol'";
		$avehicle = sqlsrv_query($conn, $tsqlvehicle);
		if ( $avehicle === false)
						die( FormatErrors( sqlsrv_errors() ) );

		if(sqlsrv_has_rows($avehicle))
		{  
				if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
				{ 
							$custnamacol = $rowvehicle['col_name'];
				}
		}
?>
		<TABLE cellPadding=5 <?if($view=="entry"){?>width="700"<?}else{?> width="700" <?}?>border=1 cellspacing=0 >
			<TR>
				<?
					   $lndcol_njopyear = "";
					   $lndcol_njopval = "";
					   $bldcol_njopyear = "";
					   $bldcol_njopval = "";

          if ($custjeniscol == "BA1")
          {
					   $tsqlvehicle = "SELECT col_njopyear, col_njopval FROM tbl_COL_Building where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					   $avehicle = sqlsrv_query($conn, $tsqlvehicle);
					   if ( $avehicle === false)
						   die( FormatErrors( sqlsrv_errors() ) );

					   if(sqlsrv_has_rows($avehicle))
					   {  
						   if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						   { 
							   $bldcol_njopyear = $rowvehicle['col_njopyear'];
							   $bldcol_njopval = $rowvehicle['col_njopval'];
						   }
					   }

					   $tsqlvehicle = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					   $avehicle = sqlsrv_query($conn, $tsqlvehicle);
					   if ( $avehicle === false)
						   die( FormatErrors( sqlsrv_errors() ) );

					   if(sqlsrv_has_rows($avehicle))
					   {
						   if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						   { 
							   $lndcol_njopyear = $rowvehicle['col_njopyear'];
							   $lndcol_njopval = $rowvehicle['col_njopval'];
						   }
					   }
					}

          if ($custjeniscol == "TAN")
          {
					   $tsqlvehicle = "SELECT * FROM tbl_COL_Land where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					   $avehicle = sqlsrv_query($conn, $tsqlvehicle);
					   if ( $avehicle === false)
						   die( FormatErrors( sqlsrv_errors() ) );

					   if(sqlsrv_has_rows($avehicle))
					   {
						   if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						   { 
							   $lndcol_njopyear = $rowvehicle['col_njopyear'];
							   $lndcol_njopval = $rowvehicle['col_njopval'];
						   }
					   }
					}

          if ($custjeniscol == "RUK")
          {
					   $tsqlvehicle = "SELECT col_njopyearlnd, col_njopvallnd, col_njopyearbld, col_njopvalbld FROM tbl_COL_Ruko where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					   $avehicle = sqlsrv_query($conn, $tsqlvehicle);
					   if ( $avehicle === false)
						   die( FormatErrors( sqlsrv_errors() ) );

					   if(sqlsrv_has_rows($avehicle))
					   {  
						   if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						   { 
							   $bldcol_njopyear = $rowvehicle['col_njopyearbld'];
							   $bldcol_njopval = $rowvehicle['col_njopvalbld'];
							   $lndcol_njopyear = $rowvehicle['col_njopyearlnd'];
							   $lndcol_njopval = $rowvehicle['col_njopvallnd'];
						   }
					   }
					}

          if ($custjeniscol == "KI2")
          {
					   $tsqlvehicle = "SELECT col_njopyearlnd, col_njopvallnd, col_njopyearbld, col_njopvalbld FROM tbl_COL_Kios where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";
					   $avehicle = sqlsrv_query($conn, $tsqlvehicle);
					   if ( $avehicle === false)
						   die( FormatErrors( sqlsrv_errors() ) );

					   if(sqlsrv_has_rows($avehicle))
					   {  
						   if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						   { 
							   $bldcol_njopyear = $rowvehicle['col_njopyearbld'];
							   $bldcol_njopval = $rowvehicle['col_njopvalbld'];
							   $lndcol_njopyear = $rowvehicle['col_njopyearlnd'];
							   $lndcol_njopval = $rowvehicle['col_njopvallnd'];
						   }
					   }
					}


					$luas_tanah = "";
					$harga_permeter_tanah = "";
					$luas_bangunan = "";
					$harga_permeter_bangunan = "";"";
					$vhccol_desc = "";
					
					$tsqlvehicle = "select luas_tanah*harga_permeter_tanah as harga_total_tanah, luas_bangunan*harga_permeter_bangunan as harga_total_bangunan, * from tbl_col_nilaipbb where ap_lisregno = '$ap_lisregno' AND col_id = '$col_id'";

					$avehicle = sqlsrv_query($conn, $tsqlvehicle);

					if ( $avehicle === false)
						die( FormatErrors( sqlsrv_errors() ) );

					if(sqlsrv_has_rows($avehicle))
					{  
						if($rowvehicle = sqlsrv_fetch_array($avehicle, SQLSRV_FETCH_ASSOC))
						{ 
							$luas_tanah = $rowvehicle['luas_tanah'];
							$harga_permeter_tanah = $rowvehicle['harga_permeter_tanah'];
							$harga_total_tanah = $rowvehicle['harga_total_tanah'];
							$luas_bangunan = $rowvehicle['luas_bangunan'];
							$harga_permeter_bangunan = $rowvehicle['harga_permeter_bangunan'];
							$harga_total_bangunan = $rowvehicle['harga_total_bangunan'];
						}
					}
				?>
				<TD align=left valign=top>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=100% align=center valign=top>
   	                          <font face=Arial size=2><b>Nilai PBB (<? echo $custnamacol ?>)</b></font>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=100% align=center valign=top>
   	                         &nbsp;
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
   	                          <?if($view=="entry"){?>
							  <input type=text id=ap_lisregno name=ap_lisregno size=30 maxlength=20 value='<? echo $ap_lisregno; ?>' readonly=readonly style="background:#FF0">
							  <?}else{
								  echo ": ".$ap_lisregno;
							  }?>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=col_id name=col_id size=30 maxlength=20 value=<? echo $col_id; ?> readonly=readonly style="background:#FF0">
								<?}else{
								  echo ": ".$col_id;
							  }?>
   	                       </td>
   	                    </tr>
						
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Tahun NJOP &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=lndcol_njopyear name=lndcol_njopyear size=30 maxlength=4 value='<? echo $lndcol_njopyear; ?>' nai="NJOP Year (Tanah) " style="background:#FF0">
								<?}else{
								  echo ": ".$lndcol_njopyear;
							  }?>
   	                       </td>
   	                    </tr>
						
						<tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Luas Tanah (m2) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=luas_tanah name=luas_tanah size=30 maxlength=8 value='<? echo $luas_tanah; ?>' nai="Luas Tanah " onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".$luas_tanah;
							  }?>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>NJOP Tanah (m2) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=harga_permeter_tanah name=harga_permeter_tanah size=30 maxlength=15 value='<? echo numberFormat($harga_permeter_tanah); ?>' nai="Luas Tanah " onKeyUp="outputMoney('harga_permeter_tanah');javascript:HitungTotalTanah();javascript:HitungTotalNJOP();" onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".numberFormat($harga_permeter_tanah);
							  }?>
						   </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Total NJOP Tanah &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=harga_total_tanah name=harga_total_tanah size=30 maxlength=15 value='<? echo numberFormat($harga_total_tanah); ?>' nai="Luas Tanah " onKeyUp="outputMoney('harga_total_tanah')" onKeyPress="return isNumberKey(event)"  style="background:cyan" readonly>
								<?}else{
								  echo ": ".numberFormat($harga_total_tanah);
							  }?>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Luas Bangunan (m2) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=luas_bangunan name=luas_bangunan size=30 maxlength=8 value='<? echo $luas_bangunan; ?>' nai="Luas Bangunan " onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".$luas_bangunan;
							  }?>
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>NJOP Bangunan (m2)&nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=harga_permeter_bangunan name=harga_permeter_bangunan size=30 maxlength=15 value='<? echo numberFormat($harga_permeter_bangunan); ?>' nai="Luas Bangunan " onKeyUp="outputMoney('harga_permeter_bangunan');javascript:HitungTotalBangunan();javascript:HitungTotalNJOP();" onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".numberFormat($harga_permeter_bangunan);
							  }?>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Total NJOP Bangunan &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=harga_total_bangunan name=harga_total_bangunan size=30 maxlength=15 value='<? echo numberFormat($harga_total_bangunan); ?>' nai="Luas Bangunan " onKeyUp="outputMoney('harga_total_bangunan')" onKeyPress="return isNumberKey(event)"  style="background:cyan" readonly>
								<?}else{
								  echo ": ".numberFormat($harga_total_bangunan);
							  }?>
   	                       </td>
   	                    </tr>
						<!--
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>NJOP Value (Tanah) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=lndcol_njopval name=lndcol_njopval size=30 maxlength=15 value='<? echo numberFormat($lndcol_njopval); ?>' nai="NJOP Value (Tanah) " onKeyUp="outputMoney('lndcol_njopval')" onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".numberFormat($lndcol_njopval);
							  }?>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>NJOP Year (Bangunan) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=bldcol_njopyear name=bldcol_njopyear size=30 maxlength=4 value='<? echo $bldcol_njopyear; ?>' nai="NJOP Year (Bangunan) " style="background:#FF0">
								<?}else{
								  echo ": ".$bldcol_njopyear;
							  }?>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>NJOP Value (Bangunan) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=bldcol_njopval name=bldcol_njopval size=30 maxlength=15 value='<? echo numberFormat($bldcol_njopval); ?>' nai="NJOP Value (Bangunan) " onKeyUp="outputMoney('bldcol_njopval')" onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".numberFormat($bldcol_njopval);
							  }?>
   	                       </td>
   	                    </tr>
						-->
						<tr>
   	                       <td width=40% align=left valign=top>
   	                          <font face=Arial size=2>Total NJOP (Tanah & Bangunan) &nbsp;</font>
   	                       </td>
   	                       <td width=70% align=left valign=top>
								<?if($view=="entry"){?>
   	                          <input type=text id=bldcol_njopval name=bldcol_njopval readonly style="background-color:cyan;" size=30 maxlength=15 value='<? echo numberFormat($bldcol_njopval); ?>' nai="NJOP Value (Bangunan) " onKeyUp="outputMoney('bldcol_njopval')" onKeyPress="return isNumberKey(event)"  style="background:#FF0">
								<?}else{
								  echo ": ".numberFormat($bldcol_njopval);
							  }?>
   	                       </td>
   	                    </tr>
   	                </TABLE>
                  	 <BR>
				
				</TD>
			</TR>
		</TABLE>
     </div>