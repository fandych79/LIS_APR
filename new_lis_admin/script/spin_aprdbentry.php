<?php
   $custnomid=$_GET['Texcustnomid'];
   $countlnd=$_GET['Texlnd'];
   $countbld=$_GET['Texbld'];
   $countvhc=$_GET['Texvhc'];

    
require ("../lib/open_con.php");

?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>APPRAISAL DATA ENTRY</TITLE>
      <script type="text/javascript" src="/lismega_devel/lib/datetimepicker_css.js"></script>
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
<script language="JavaScript"><!--
name = 'utama';
//--></script>
      <div align=center>
      <TABLE cellPadding=5 width="100%" border=0>
        <TR>
    	  <TD vAlign=top width=1>
            <TABLE cellSpacing=0 cellPadding=0 width="95%" border=0>
              <TR>
                <TD class=backW vAlign=center>
          	</TD>
              </TR>
            </TABLE>
          </TD>
          <TD align=left valign=top>
            <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
              <TR>
                <TD class=borderForm align=right bgColor=black>
                      <font style="font-size: 12;" color=#FFFFFF><B>Form type : Appraisal Data Entry &nbsp</B></font>
                </TD>
              </TR>
              <TR>
                <TD height=15></TD>
              </TR>
              <TR>
                <TD class=borderB>
                  <TABLE cellSpacing=1 cellPadding=13 width="100%" border=0>
                    <TR>
                      <TD class=backW>
                  	<form name=formsubmit method=post action=dosaveaprdbentry.php>
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
<?
      $tsql = "SELECT * FROM Tbl_CustomerMasterPerson
      				 WHERE custnomid='$custnomid'";
      $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
      $params = array(&$_POST['query']);

      $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
      if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

      if(sqlsrv_has_rows($sqlConn))
      {
         $rowCount = sqlsrv_num_rows($sqlConn);
         while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
         {
?>
							          <tr>
							          	 <td width=20% align=left valign=top>
							          	 	<font face=Arial size=2>Customer ID : <? echo $custnomid; ?></font>
							          	</td>
							          	 <td width=80% align=left valign=top>
							          	 	<font face=Arial size=2>Customer Name : <? echo $row['custfullname']; ?></font>
							          	</td>
							          </tr>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
?>
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
      								 }
   								 }
   								 sqlsrv_free_stmt( $sqlConn );
?> 
                  	 <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                    <tr>
   	                       <td width=100% align=left valign=top>
   	                          <font face=Arial size=2><b>TANAH <? echo $i; ?>. &nbsp</b></font>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_id<? echo $i; ?> size=20 maxlength=20 value='LND<? echo $i; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Alamat Jaminan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Alamat Calon Debitur &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_kodepos<? echo $i; ?> size=5 maxlength=5 value='<? echo $col_kodepos; ?>'>
   	                          <A HREF=./maintainzipcode.php target=lainnya>View Zipcode</A>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Certificate Type &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_certtype<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certtype; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Certificate No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_certno<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_certatasnama<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certatasnama; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Luas Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_certluas<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_certluas; ?>'> m2
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_certdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_certdate; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_certdate<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_certdue<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_certdue; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_certdue<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Relcode &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_relcode<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_relcode; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_haktanggungan<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_haktanggungan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_haktanggungantgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_haktanggungantgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndcol_haktanggungantgl<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Identification &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_identification<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_identification; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Topografi &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_topografi<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_topografi; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Bentuk Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_bentuktanah<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bentuktanah; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Panjang Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_panjangtnh<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_panjangtnh; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Lebar Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_lebartnh<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_lebartnh; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Depan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_arahdepan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahdepan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Belakang &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_arahbelakang<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahbelakang; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Kanan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_arahkanan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahkanan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Kiri &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_arahkiri<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahkiri; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Depan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_batasdepan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_batasdepan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Belakang &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_batasbelakang<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_batasbelakang; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Kanan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_bataskanan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bataskanan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Kiri &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_bataskiri<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bataskiri; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Banjir &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_banjir<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_banjir; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>NJOP Year &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_njopyear<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_njopyear; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>NJOP Val &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_njopval<? echo $i; ?> size=8 maxlength=10 value='<? echo $col_njopval; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Remark &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_remark<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_remark; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Safe Margin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_safemargin<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_safemargin; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraiser &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_appraiser<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_appraiser; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraise Date &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndcol_appraisdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_appraisdate; ?>'>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <BR>
<?
								}
								for($i=1;$i<=$countbld;$i++) 
								{
?>
                  <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                  <tr>
   	                     <td width=100% align=left valign=top>
   	                        <font face=Arial size=2><b>TANAH DAN BANGUNAN <? echo $i; ?>. &nbsp</b></font>
   	                     </td>
   	                  </tr>
                  </TABLE>
                  <TABLE WIDTH=100% cellpadding=0 cellspacing=0 border=1>
                  	<tr>
                  		<td width=50% align=left valign=top>
                  			<font face=Arial size=2><b>TANAH</b></font>
<?
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
								   $tsql = "SELECT * FROM Tbl_Col_Land
   													WHERE ap_lisregno='$custnomid'
   													AND col_id='LNDBLD$i'";
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
      								 }
   								 }
   								 sqlsrv_free_stmt( $sqlConn );
?>
                  	 <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_id<? echo $i; ?> size=20 maxlength=20 value='LNDBLD<? echo $i; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Alamat Jaminan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Alamat Calon Debitur &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_kodepos<? echo $i; ?> size=5 maxlength=5 value='<? echo $col_kodepos; ?>'>
   	                          <A HREF=./maintainzipcode.php target=lainnya>View Zipcode</A>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Certificate Type &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_certtype<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certtype; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Certificate No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_certno<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Pemegang Hak Atas Sertifikat &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_certatasnama<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_certatasnama; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Luas Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_certluas<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_certluas; ?>'> m2
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tanggal Terbit Sertifikat &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_certdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_certdate; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndbldcol_certdate<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tanggal Jatuh Tempo Sertifikat &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_certdue<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_certdue; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndbldcol_certdue<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Relcode &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_relcode<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_relcode; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Nomor Hak Tanggungan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_haktanggungan<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_haktanggungan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tanggal Hak Tanggungan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_haktanggungantgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_haktanggungantgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('lndbldcol_haktanggungantgl<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Identification &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_identification<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_identification; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Topografi &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_topografi<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_topografi; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Bentuk Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_bentuktanah<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bentuktanah; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Panjang Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_panjangtnh<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_panjangtnh; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Lebar Tanah &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_lebartnh<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_lebartnh; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Depan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_arahdepan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahdepan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Belakang &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_arahbelakang<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahbelakang; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Kanan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_arahkanan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahkanan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Kiri &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_arahkiri<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahkiri; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Depan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_batasdepan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_batasdepan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Belakang &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_batasbelakang<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_batasbelakang; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Kanan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_bataskanan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bataskanan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Batas Kiri &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_bataskiri<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bataskiri; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Banjir &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_banjir<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_banjir; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>NJOP Year &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_njopyear<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_njopyear; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>NJOP Val &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_njopval<? echo $i; ?> size=8 maxlength=10 value='<? echo $col_njopval; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Remark &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_remark<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_remark; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Safe Margin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_safemargin<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_safemargin; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraiser &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_appraiser<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_appraiser; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraise Date &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=lndbldcol_appraisdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_appraisdate; ?>'>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  		</td>
                  		<td width=50% align=left valign=top>
                  			<font face=Arial size=2>BANGUNAN</font>
<?
								   $col_addr1 = "";
						   	   $col_addr2 = "";
								   $col_addr3 = "";
								   $col_kodepos = "";
	                 $col_type = "";
									 $col_imbno = "";
									 $col_imbdate = "";
									 $col_imbluas = "";
	                 $col_njopyear = "";
								   $col_njopval = "";
								   $col_rangka = "";
								   $col_lantai = "";
								   $col_dinding = "";
									 $col_langit = "";
									 $col_rangkaatap = "";
									 $col_jmllantai = "";
									 $col_pembagianruang = "";
								   $col_dihunioleh = "";
								   $col_fasilitasbld = "";
								   $col_desc = "";
								   $col_pencapaian = "";
									 $col_jalan = "";
									 $col_lebarjalan = "";
								   $col_kondisijalan = "";
								   $col_arahjalan = "";
									 $col_intensitasjalan = "";
								   $col_fasilitasumum = "";
									 $col_fasilitasangkutan = "";
									 $col_objekpenting = "";
									 $col_peruntukanlingkungan = "";
	                 $col_safemargin = "";
	                 $col_appraiser = "";
	                 $col_appraisdate = "";
								   $tsql = "SELECT * FROM Tbl_Col_Building
   													WHERE ap_lisregno='$custnomid'
   													AND col_id='LNDBLD$i'";
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
	                 		  $col_type = $row[6];
									 		  $col_imbno = $row[7];
									 		  $col_imbdate = $row[8];
									 			$col_imbluas = $row[9];
	                 			$col_njopyear = $row[10];
								   			$col_njopval = $row[11];
								   			$col_rangka = $row[12];
								   			$col_lantai = $row[13];
								   			$col_dinding = $row[14];
									 			$col_langit = $row[15];
									 			$col_rangkaatap = $row[16];
									 			$col_jmllantai = $row[17];
									 			$col_pembagianruang = $row[18];
								   			$col_dihunioleh = $row[19];
								   			$col_fasilitasbld = $row[20];
								   			$col_desc = $row[21];
								   			$col_pencapaian = $row[22];
									 			$col_jalan = $row[23];
									 			$col_lebarjalan = $row[24];
								   			$col_kondisijalan = $row[25];
								   			$col_arahjalan = $row[26];
									 			$col_intensitasjalan = $row[27];
								   			$col_fasilitasumum = $row[28];
									 			$col_fasilitasangkutan = $row[29];
									 			$col_objekpenting = $row[30];
									 			$col_peruntukanlingkungan = $row[31];
	                 			$col_safemargin = $row[32];
	                 			$col_appraiser = $row[33];
	                 			$col_appraisdate = $row[34];
      								 }
   								 }
   								 sqlsrv_free_stmt( $sqlConn );
?>
                  	 <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_id<? echo $i; ?> size=20 maxlength=20 value='LNDBLD<? echo $i; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_kodepos<? echo $i; ?> size=5 maxlength=5 value='<? echo $col_kodepos; ?>'>
   	                          <A HREF=./maintainzipcode.php target=lainnya>View Zipcode</A>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Collateral Type &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_type<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_type; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>IMB No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_imbno<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_imbno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>IMB Date &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_imbdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_imbdate; ?>'>
		   		    							  <a href="javascript:NewCssCal('bldcol_imbdate<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>IMB Luas &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_imbluas<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_imbluas; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>NJOP Year &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_njopyear<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_njopyear; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>NJOP Val &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_njopval<? echo $i; ?> size=8 maxlength=10 value='<? echo $col_njopval; ?>'>
   	                          <font face=Arial size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Rangka &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_rangka<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_rangka; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Lantai &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_lantai<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_lantai; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Dinding &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_dinding<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_dinding; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Langit &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_langit<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_langit; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Rangka Atap &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_rangkaatap<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_rangkaatap; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Jumlah Lantai &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_jmllantai<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_jmllantai; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Pembagian Ruang &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_pembagianruang<? echo $i; ?> size=50 maxlength=100 value='<? echo $col_pembagianruang; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Dihuni Oleh &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_dihunioleh<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_dihunioleh; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Fasilitas Building &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_fasilitasbld<? echo $i; ?> size=50 maxlength=100 value='<? echo $col_fasilitasbld; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Description &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_desc<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_desc; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Pencapaian &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_pencapaian<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_pencapaian; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Jalan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_jalan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_jalan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Lebar Jalan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_lebarjalan<? echo $i; ?> size=10 maxlength=4 value='<? echo $col_lebarjalan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Kondisi Jalan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_kondisijalan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_kondisijalan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Arah Jalan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_arahjalan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_arahjalan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Intensitas Jalan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_intensitasjalan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_intensitasjalan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Fasilitas Umum &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_fasilitasumum<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_fasilitasumum; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Fasilitas Angkutan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_fasilitasangkutan<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_fasilitasangkutan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Object Penting &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_objekpenting<? echo $i; ?> size=50 maxlength=250 value='<? echo $col_objekpenting; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Peruntukan Lingkungan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_peruntukanlingkungan<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_peruntukanlingkungan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Safe Margin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_safemargin<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_safemargin; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraiser &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_appraiser<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_appraiser; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraise Date &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=bldcol_appraisdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_appraisdate; ?>'>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  		</td>
                  	</tr>
                  </table>
                  	 <BR>
<? 
							  }
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
      								 }
   								 }
   								 sqlsrv_free_stmt( $sqlConn );
?>
                  	 <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                    <tr>
   	                       <td width=100% align=left valign=top>
   	                          <font face=Arial size=2><b>KENDARAAN <? echo $i; ?>. &nbsp</b></font>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Application Number &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhcap_lisregno<? echo $i; ?> size=20 maxlength=20 value='<? echo $custnomid; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Collateral ID &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_id<? echo $i; ?> size=20 maxlength=20 value='VHC<? echo $i; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Address 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_addr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_addr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Kodepos &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_kodepos<? echo $i; ?> size=5 maxlength=5 value=''>
   	                          <A HREF=./maintainzipcode.php target=lainnya>View Zipcode</A>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Nopol &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nopol<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_addr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>STNK No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_stnk_no<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_stnk_no; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>STNK Exp &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_stnkexp<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_stnkexp; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_stnkexp<? echo $i; ?>','mmddyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Faktur No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_fakturno<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_fakturno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Faktur Tgl &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_fakturtgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_fakturtgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_fakturtgl<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>BPKB No &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbno<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_bpkbno; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>BPKB Tgl &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbtgl<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_bpkbtgl; ?>'>
		   		    							  <a href="javascript:NewCssCal('vhccol_bpkbtgl<? echo $i; ?>','ddmmyyyy')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
   	                          <font face=Arial size=2 color=blue>HARUS dd/mm/yyyy</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Condition &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_condition<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_condition; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Type &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_type<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_type; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Model &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_model<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_model; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Merk &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_merk<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_merk; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Tahun Pembuatan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_tahunpembuatan<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_tahunpembuatan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Jenis Kendaraan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_jeniskendaran<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_jeniskendaran; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Silinder &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_silinder<? echo $i; ?> size=4 maxlength=4 value='<? echo $col_silinder; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Warna &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_warna<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_warna; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>No Rangka &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_norangka<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_norangka; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>No Mesin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nomesin<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_nomesin; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>BPKB Nama &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbnama<? echo $i; ?> size=30 maxlength=30 value='<? echo $col_bpkbnama; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>BPKB Addr 1 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr1<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_bpkbaddr1; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>BPKB Addr 2 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr2<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_bpkbaddr2; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>BPKB Addr 3 &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_bpkbaddr3<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_bpkbaddr3; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Perlengkapan &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_perlengkapan<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_perlengkapan; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Desc &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_desc<? echo $i; ?> size=10 maxlength=16 value='<? echo $col_desc; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Nilai Wajar &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nilaiwajar<? echo $i; ?> size=8 maxlength=8 value='<? echo $col_nilaiwajar; ?>'>
   	                          <font size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top>
   	                          <font face=Arial size=2>Nilai Likuidasi &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_nilailikuidasi<? echo $i; ?> size=8 maxlength=8 value='<? echo $col_nilailikuidasi; ?>'>
   	                          <font size=2 color=blue>HARUS BERUPA ANGKA</font>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Safe Margin &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_safemargin<? echo $i; ?> size=10 maxlength=8 value='<? echo $col_stnkexp; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraiser &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_appraiser<? echo $i; ?> size=50 maxlength=50 value='<? echo $col_appraiser; ?>'>
   	                       </td>
   	                    </tr>
   	                    <tr>
   	                       <td width=20% align=right valign=top  bgcolor=#CCCCFF>
   	                          <font face=Arial size=2>Appraise Date &nbsp</font>
   	                       </td>
   	                       <td width=80% align=left valign=top>
   	                          <input type=text name=vhccol_appraisdate<? echo $i; ?> size=10 maxlength=10 value='<? echo $col_appraisdate; ?>'>
   	                       </td>
   	                    </tr>
                  	 </TABLE>
                  	 <BR>
<? 
							  }
?>
      		     	     <BR>
      		     	     <input type=button value='SUBMIT' style='width: 225mm' onclick=cekthis()>
      		     	     <input type=hidden name=userid value='bhartoyo'>
          	     	   <input type=hidden name=userpwd value='1245'>
          	     	   <input type=hidden name=act value='simpandata'>
      		     	     <input type=hidden name=custnomid value='<? echo $custnomid; ?>'>
      		     	     <input type=hidden name=countlnd value='<? echo $countlnd; ?>'>
      		     	     <input type=hidden name=countbld value='<? echo $countbld; ?>'>
      		     	     <input type=hidden name=countvhc value='<? echo $countvhc; ?>'>
                  	</form>
                      </TD>
                    </TR>
                    <TR>
                      <TD class=backW></TD>
                    </TR>
                  </TABLE>
                </TD>
              </TR>
              <TR>
                <TD height=15></TD>
              </TR>
              <TR>
                <TD class=borderB>
                </TD>
              </TR>
              <TR>
                <TD height=15>
                   <table width=100% cellpadding=0 cellspacing=0 border=0>
                      <tr>
                         &nbsp
                      <tr>
                      <tr>
                      </tr>
                   </table>
                </TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE>
     </div>
   </BODY>
</HTML>
<?
   require("../lib/close_con.php");
exit;

?> 
