<?php
   $wfid=$_GET['Texcustnomid'];

    
require ("../lib/open_con.php");
?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>SPIN UPLOAD</TITLE>
      <Script Language="JavaScript">
	function cekthis()
	{
	   if (document.formsubmit.file01.value == "")
	   {
	   	alert("Harap Pilih File Yang Hendak Diupload. Gunakan tombol Browse... untuk memudahkan");
	   	document.formsubmit.file01.focus();
	   	return false;
	   }
	   if (document.formsubmit.where.value == "")
	   {
	   	alert("Harap tentukan lokasi upload");
	   	document.formsubmit.where.focus();
	   	return false;
	   }
	   if (document.formsubmit.fileproductid.options[document.formsubmit.fileproductid.selectedIndex].value == "")
	   {
	   	alert("Harap Pilih Product");
	   	document.formsubmit.fileproductid.focus();
	   	return false;
	   }
	   if (document.formsubmit.filedoc.options[document.formsubmit.filedoc.selectedIndex].value == "")
	   {
	   	alert("Harap Pilih Document");
	   	document.formsubmit.filedoc.focus();
	   	return false;
	   }
	   document.formsubmit.submit();
	}
      </Script>
   </HEAD>
   <BODY>
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
                      <font style="font-size: 12;" color=#FFFFFF><B>Form type : Upload &nbsp</B></font>
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
                  	<form name=formsubmit ENCTYPE='multipart/form-data' method=post action=/cgi-bin/spin_upload.cgi target='lainnya'>
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>
<?
      $tsql = "SELECT * FROM Tbl_DocPerson";
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
         	  $varimg = "/DM/" . $wfid . "/" . $row[0] . ".jpg";
?>
                    <tr>
                    	<td width=20% align=left valign=top>
                    		 <font face=Arial size=2><? echo $row[0]; ?></font>
                    	</td>
                    	<td width=80% align=left valign=top>
                    		 <img src=<? echo $varimg; ?> width=30%>
                    	</td>
                    </tr>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
?>
      		     	   <input type=hidden name=userid value='bhartoyo'>
          	     	   <input type=hidden name=userpwd value='1245'>
          	     	   <input type=hidden name=act value='simpandata'>
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
