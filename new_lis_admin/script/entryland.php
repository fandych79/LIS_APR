<?php
   $custnomid=$_GET['custnomid'];
   $custfullname = $_GET['custfullname'];
   $countlnd=$_GET['txtjumlahland'];
   //$countbld=$_GET['txtjumlahbuilding'];
   //$countvhc=$_GET['txtjumlahvehicle'];

    
require ("../lib/open_con.php");
?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>APPRAISAL DATA ENTRY</TITLE>
      <script type="text/javascript" src="../lib/datetimepicker_css.js"></script>
      <Script Language="JavaScript">
	function cekthis()
	{
           submitform = window.confirm("Submit Data ?")
           if (submitform == true)
           {
	            document.formsubmit.submit();
              return true;
           }
           else
           {
              return false;
           }
	}
      </Script>
   </HEAD>
   <BODY bgcolor=#FFFFCC>
	<div align=center>
		<TABLE cellPadding=5 width="800" border=1>
			<TR>
				<TD align=left valign=top>
				<form name=formsubmit method=post action=dosaveentryall.php>
				<TABLE WIDTH="90%" CELLPADDING=1 CELLSPACING=1 border=0 align="center">
					<tr>
					   	<td width=30% align=left valign=top>
							<font face=Arial size=2>Customer ID : <? echo $custnomid; ?></font>
						</td>
						<td width=70% align=left valign=top>
						    <font face=Arial size=2>Customer Name : <? echo $custfullname; ?></font>
						</td>
					</tr>
				</TABLE>
				<?
					for($i=1;$i<=$countlnd;$i++) 
					{
						$col_addr1 = "";
						$col_addr2 = "";
						$col_addr3 = "";
						$col_kodepos = "";
						$col_certtype = "";
						$col_certno = "";
						$col_certatasnama = "";
						$col_certluas = "";
						$col_certdate = "";
						$col_certdue = "";
						$col_relcode = "";
						$col_haktanggungan = "";
						$col_haktanggungantgl = "";
						$col_identification = "";
						$col_topografi = "";
						$col_bentuktanah = "";
						$col_panjangtnh = "";
						$col_lebartnh = "";
						$col_arahdepan = "";
						$col_arahbelakang = "";
						$col_arahkanan = "";
						$col_arahkiri = "";
						$col_batasdepan = "";
						$col_batasbelakang = "";
						$col_bataskanan = "";
						$col_bataskiri = "";
						$col_banjir = "";
						$col_njopyear = "";
						$col_njopval = "";
						$col_remark = "";
						$col_safemargin = "";
						$col_appraiser = "";
						$col_appraisdate = "";
						$COL_NILAIWAJAR = "";
						$COL_NILAILIKUIDASI = "";
						$COL_MK_CODE = "";
						
						$tsql = "SELECT * FROM Tbl_Col_Land
   									WHERE ap_lisregno='$custnomid'
   									AND col_id='LND$i'";
   						$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   						$params = array(&$_POST['query']);
	
   						$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   						if ( $sqlConn === false)
      					die( FormatErrors( sqlsrv_errors() ) );

   						if(sqlsrv_has_rows($sqlConn))
   						{
      						$rowCount = sqlsrv_num_rows($sqlConn);
      						while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      						{
									$col_addr1 = $row[2];
									$col_addr2 = $row[3];
								   	$col_addr3 = $row[4];
								   	$col_kodepos = $row[5];
									$col_certtype = $row[6];
									$col_certno = $row[7];
							     	$col_certatasnama = $row[8];
									$col_certluas = $row[9];
									$col_certdate = $row[10];
									$col_certdue = $row[11];
									$col_relcode = $row[12];
									$col_haktanggungan = $row[13];
									$col_haktanggungantgl = $row[14];
									$col_identification = $row[15];
							     	$col_topografi = $row[16];
									$col_bentuktanah = $row[17];
									$col_panjangtnh = $row[18];
									$col_lebartnh = $row[19];
									$col_arahdepan = $row[20];
									$col_arahbelakang = $row[21];
									$col_arahkanan = $row[22];
									$col_arahkiri = $row[23];
									$col_batasdepan = $row[24];
									$col_batasbelakang = $row[25];
									$col_bataskanan = $row[26];
									$col_bataskiri = $row[27];
									$col_banjir = $row[28];
									$col_njopyear = $row[29];
									$col_njopval = $row[30];
									$col_remark = $row[31];
									$col_safemargin = $row[32];
									$col_appraiser = $row[33];
									$col_appraisdate = $row[34];
									$COL_NILAIWAJAR = $row[35];
									$COL_NILAILIKUIDASI = $row[36];
									$COL_MK_CODE = $row[37];
      						}
   						}
   						sqlsrv_free_stmt( $sqlConn );					
				?>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=100% align=left valign=top>
								<font face=Arial size=2><b>TANAH <? echo $i; ?>. &nbsp</b></font>
							</td>
   	                    </tr>						
					</TABLE>
					
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Application Number &nbsp</font>
							</td>
							<td width=70% align=left valign=top>
								<input type=text name=lndap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid; ?>'>
							</td>
   	                    </tr>
						<tr>
							<td width=30% align=left valign=top>
								<font face=Arial size=2>Collateral ID &nbsp</font>
							</td>
							<?
								if($i<10)
								{
									$j="0".$i;
								}
								else
								{
									$j=$i;
								}
							?>
							<td width=70% align=left valign=top>
								<input type=text name=lndcol_id<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid."LND".$j; ?>'>
							</td>
   	                    </tr>

						<tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Alamat Jaminan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Alamat Calon Debitur &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Address 3 &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Kodepos &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_kodepos<? echo $i; ?> size=20 maxlength=5 value='<? echo $col_kodepos; ?>'>
   	                         <A HREF="http://192.168.1.101./maintainzipcode.php" target=lainnya>View Zipcode</A>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Certificate Type &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certtype<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certtype; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Certificate No &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certno<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certno; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certatasnama<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certatasnama; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Luas Tanah &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certluas<? echo $i; ?> size=20 maxlength=8 value='<? echo $col_certluas; ?>'> m2
								<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certdate<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_certdate; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_certdate<? echo $i; ?>','yyyyMMdd')"><img src="../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_certdue<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_certdue; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_certdue<? echo $i; ?>','yyyyMMdd')"><img src="../images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Relcode &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_relcode<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_relcode; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_haktanggungan<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_haktanggungan; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_haktanggungantgl<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_haktanggungantgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_haktanggungantgl<? echo $i; ?>','yyyyMMdd')"><img src="../Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
								<font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Identification &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_identification<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_identification; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Topografi &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_topografi<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_topografi; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Bentuk Tanah &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_bentuktanah<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_bentuktanah; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Panjang Tanah &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_panjangtnh<? echo $i; ?> size=20 maxlength=8 value='<? echo $col_panjangtnh; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Lebar Tanah &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_lebartnh<? echo $i; ?> size=20 maxlength=8 value='<? echo $col_lebartnh; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Arah Depan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>								
								<select name=lndcol_arahdepan<? echo $i; ?> value='<? echo $col_arahdepan; ?>'>
								  <option value="Timur">Timur</option>
								  <option value="Tenggara">Tenggara</option>
								  <option value="Selatan">Selatan</option>
								  <option value="Barat Daya">Barat Daya</option>
								  <option value="Barat">Barat</option>
								  <option value="Barat Laut">Barat Laut</option>
								  <option value="Utara">Utara</option>
								  <option value="Timur Laut">Timur Laut</option>
                                </select>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Arah Belakang &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<select name=lndcol_arahbelakang<? echo $i; ?> value='<? echo $col_arahbelakang; ?>'>
								  <option value="Timur">Timur</option>
								  <option value="Tenggara">Tenggara</option>
								  <option value="Selatan">Selatan</option>
								  <option value="Barat Daya">Barat Daya</option>
								  <option value="Barat">Barat</option>
								  <option value="Barat Laut">Barat Laut</option>
								  <option value="Utara">Utara</option>
								  <option value="Timur Laut">Timur Laut</option>
                                </select>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Arah Kanan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<select name=lndcol_arahkanan<? echo $i; ?> value='<? echo $col_arahkanan; ?>'>
								  <option value="Timur">Timur</option>
								  <option value="Tenggara">Tenggara</option>
								  <option value="Selatan">Selatan</option>
								  <option value="Barat Daya">Barat Daya</option>
								  <option value="Barat">Barat</option>
								  <option value="Barat Laut">Barat Laut</option>
								  <option value="Utara">Utara</option>
								  <option value="Timur Laut">Timur Laut</option>
                                </select>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Arah Kiri &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<select name=lndcol_arahkiri<? echo $i; ?> value='<? echo $col_arahkiri; ?>'>
								  <option value="Timur">Timur</option>
								  <option value="Tenggara">Tenggara</option>
								  <option value="Selatan">Selatan</option>
								  <option value="Barat Daya">Barat Daya</option>
								  <option value="Barat">Barat</option>
								  <option value="Barat Laut">Barat Laut</option>
								  <option value="Utara">Utara</option>
								  <option value="Timur Laut">Timur Laut</option>
                                </select>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Batas Depan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_batasdepan<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_batasdepan; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Batas Belakang &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_batasbelakang<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_batasbelakang; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Batas Kanan &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_bataskanan<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_bataskanan; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Batas Kiri &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_bataskiri<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_bataskiri; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Banjir &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_banjir<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_banjir; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>NJOP Year &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_njopyear<? echo $i; ?> size=20 maxlength=4 value='<? echo $col_njopyear; ?>'>
								<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>NJOP Val &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_njopval<? echo $i; ?> size=20 maxlength=10 value='<? echo $col_njopval; ?>'>
								<font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top>
								<font face=Arial size=2>Remark &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_remark<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_remark; ?>'>
							</td>
   	                    </tr>
   	                    <tr>
						<tr>
							<td width=20% align=left valign=top  bgcolor=#CCCCFF>
								<font face=Arial size=2>Safe Margin &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_safemargin<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_safemargin; ?>' readonly=readonly style="background-color:#CCCCFF">
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top  bgcolor=#CCCCFF>
								<font face=Arial size=2>Appraiser &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_appraiser<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_appraiser; ?>' readonly=readonly style="background-color:#CCCCFF">
							</td>
   	                    </tr>
   	                    <tr>
							<td width=20% align=left valign=top  bgcolor=#CCCCFF>
								<font face=Arial size=2>Appraise Date &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndcol_appraisdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_appraisdate; ?>' readonly=readonly style="background-color:#CCCCFF">
							</td>
   	                    </tr>
						<tr>
							<td width=20% align=left valign=top  bgcolor=#CCCCFF>
								<font face=Arial size=2>NILAIWAJAR &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndCOL_NILAIWAJAR<? echo $i; ?> size=10 maxlength=10 value='0' readonly=readonly style="background-color:#CCCCFF">
							</td>
   	                    </tr>
						<tr>
							<td width=20% align=left valign=top  bgcolor=#CCCCFF>
								<font face=Arial size=2>NILAILIKUIDASI &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndCOL_NILAILIKUIDASI<? echo $i; ?> size=10 maxlength=10 value='0' readonly=readonly style="background-color:#CCCCFF">
							</td>
   	                    </tr>
						<tr>
							<td width=20% align=left valign=top  bgcolor=#CCCCFF>
								<font face=Arial size=2>MK_CODE &nbsp</font>
							</td>
							<td width=80% align=left valign=top>
								<input type=text name=lndCOL_MK_CODE<? echo $i; ?> size=10 maxlength=10 value='<? echo $COL_MK_CODE; ?>' readonly=readonly style="background-color:#CCCCFF">
							</td>
   	                    </tr>

					</TABLE>
					<BR>
				<?
					}//tutup for countLND
				?>

					<input type=button value='SUBMIT' style='width: 225mm' onclick=cekthis()>
          	     	<input type=hidden name=act value='simpandata'>
      		     	<input type=hidden name=custnomid value='<? echo $custnomid; ?>'>
					<input type=hidden name=custfullname value='<? echo $custfullname; ?>'>
      		     	<input type=hidden name=countlnd value='<? echo $countlnd; ?>'>
      		     	<input type=hidden name=countbld value='<? echo $countbld; ?>'>
      		     	<input type=hidden name=countvhc value='<? echo $countvhc; ?>'>
					<input type=hidden name=lndCOL_NILAIWAJAR<? echo $i; ?>>
					<input type=hidden name=lndCOL_NILAILIKUIDASI<? echo $i; ?>>
					<input type=hidden name=lndCOl_MK_CODE<? echo $i; ?>>
				
				</form>
				</TD>
			</TR>
		</TABLE>
     </div>
   </BODY>
</HTML>