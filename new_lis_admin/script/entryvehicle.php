<?php
   $custnomid=$_GET['custnomid'];
   $custfullname = $_GET['custfullname'];
   //$countlnd=$_GET['txtjumlahland'];
   //$countbld=$_GET['txtjumlahbuilding'];
   $countvhc=$_GET['txtjumlahvehicle'];

    
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
					for($i=1;$i<=$countvhc;$i++) 
					{
						$col_addr1 = "";
						$col_addr2 = "";
						$col_addr3 = "";
						$col_kodepos = "";
						$col_nopol = "";
						$col_stnk_no = "";
						$col_stnkexp = "";
						$col_fakturno = "";
						$col_fakturtgl = "";
						$col_bpkbno = "";
						$col_bpkbtgl = "";
						$col_condition = "";
						$col_type = "";
						$col_model = "";
						$col_merk = "";
						$col_tahunpembuatan = "";
						$col_jeniskendaran = "";
						$col_silinder = "";
						$col_warna = "";
						$col_norangka = "";
						$col_nomesin = "";
						$col_bpkbnama = "";
						$col_bpkbaddr1 = "";
						$col_bpkbaddr2 = "";
						$col_bpkbaddr3 = "";
						$col_perlengkapan = "";
						$col_desc = "";
						$col_nilaiwajar = "";
						$col_nilailikuidasi = "";
						$col_safemargin = "";
						$col_appraiser = "";
						$col_appraisdate = "";
						$col_MK_CODE = "";
						
						$tsql = "SELECT * FROM Tbl_Col_Vehicle
   								WHERE ap_lisregno='$custnomid'
   								AND col_id='VHC$i'";
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
	                 			$col_nopol = $row[6];
						       	$col_stnk_no = $row[7];
								$col_stnkexp = $row[8];
								$col_fakturno = $row[9];
	                 			$col_fakturtgl = $row[10];
								$col_bpkbno = $row[11];
								$col_bpkbtgl = $row[12];
							    $col_condition = $row[13];
								$col_type = $row[14];
								$col_model = $row[15];
						       	$col_merk = $row[16];
								$col_tahunpembuatan = $row[17];
							    $col_jeniskendaran = $row[18];
								$col_silinder = $row[19];
						       	$col_warna = $row[20];
								$col_norangka = $row[21];
								$col_nomesin = $row[22];
								$col_bpkbnama = $row[23];
							    $col_bpkbaddr1 = $row[24];
								$col_bpkbaddr2 = $row[25];
								$col_bpkbaddr3 = $row[26];
								$col_perlengkapan = $row[27];
								$col_desc = $row[28];
								$col_nilaiwajar = $row[29];
								$col_nilailikuidasi = $row[30];
	                 			$col_safemargin = $row[31];
	                 			$col_appraiser = $row[32];
	                 			$col_appraisdate = $row[33];
								$col_MK_CODE = $row[34];
      						}
   						}
   						sqlsrv_free_stmt( $sqlConn );
?>
					<TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=100% align=left valign=top>
   	                          <font face=Arial size=2><b>KENDARAAN <? echo $i; ?>. &nbsp</b></font>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=90% CELLPADDING=1 CELLSPACING=1 border=0 align="center">                  	   	
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhcap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
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
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_id<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid."VHC".$j; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Address 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Address 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Address 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_kodepos<? echo $i; ?> size=5 maxlength=5 value=''>
   	                          <A HREF="http://192.168.1.101./maintainzipcode.php" target=lainnya>View Zipcode</A>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Nopol &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nopol<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>STNK No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_stnk_no<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_stnk_no; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>STNK Exp &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_stnkexp<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_stnkexp; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_stnkexp<? echo $i; ?>','yyyyMMdd')"><img src="../Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Faktur No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_fakturno<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_fakturno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Faktur Tgl &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_fakturtgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_fakturtgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_fakturtgl<? echo $i; ?>','yyyyMMdd')"><img src="../Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbno<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_bpkbno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Tgl &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbtgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bpkbtgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_bpkbtgl<? echo $i; ?>','yyyyMMdd')"><img src="../Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Condition &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_condition<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_condition; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Type &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_type<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_type; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Model &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_model<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_model; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Merk &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_merk<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_merk; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Tahun Pembuatan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_tahunpembuatan<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_tahunpembuatan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Jenis Kendaraan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_jeniskendaran<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_jeniskendaran; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Silinder &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_silinder<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_silinder; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Warna &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_warna<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_warna; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>No Rangka &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_norangka<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_norangka; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>No Mesin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nomesin<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_nomesin; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Nama &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbnama<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_bpkbnama; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Addr 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_bpkbaddr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Addr 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_bpkbaddr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>BPKB Addr 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_bpkbaddr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Perlengkapan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_perlengkapan<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_perlengkapan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top>
   	                          <font face=Arial size=2>Desc &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_desc<? echo $i; ?> size=10 maxlength=16 value='<? echo $col_desc; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Nilai Wajar &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nilaiwajar<? echo $i; ?> size=8 maxlength=8 value='0' readonly=readonly style="background-color:#CCCCFF">
   	                          <font size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Nilai Likuidasi &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nilailikuidasi<? echo $i; ?> size=8 maxlength=8 value='0' readonly=readonly style="background-color:#CCCCFF">
   	                          <font size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Safe Margin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_safemargin<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_safemargin; ?>' readonly=readonly style="background-color:#CCCCFF">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraiser &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_appraiser<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_appraiser; ?>' readonly=readonly style="background-color:#CCCCFF">
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=left valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraise Date &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_appraisdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_appraisdate; ?>' readonly=readonly style="background-color:#CCCCFF">
   	                       </td>
   	                    </tr>
						<tr>
   	                       <td width=20% align=left valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>MK CODE &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_MK_CODE<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_MK_CODE; ?>' readonly=readonly style="background-color:#CCCCFF">
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <BR>

				<?
					}//tutup for countVHC
				?>

					<input type=button value='SUBMIT' style='width: 225mm' onclick=cekthis()>
          	     	<input type=hidden name=act value='simpandata'>
      		     	<input type=hidden name=custnomid value='<? echo $custnomid; ?>'>
					<input type=hidden name=custfullname value='<? echo $custfullname; ?>'>
      		     	<input type=hidden name=countlnd value='<? echo $countlnd; ?>'>
      		     	<input type=hidden name=countbld value='<? echo $countbld; ?>'>
      		     	<input type=hidden name=countvhc value='<? echo $countvhc; ?>'>
				
				</form>
				</TD>
			</TR>
		</TABLE>
     </div>
   </BODY>
</HTML>