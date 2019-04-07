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
      $tsql = "SELECT * FROM Tbl_CustomerMasterPerson
      				 WHERE custnomid='$wfid'";
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
							          	 	<font face=Arial size=2>Customer ID : <? echo $wfid; ?></font>
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
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>
      	             	      <tr>
      	                	<td width=100% valign=top align=left>
      	                	   <table width=100% cellpadding=0 cellspacing=0 border=0>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>File Name</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
               		   		    <INPUT TYPE='FILE' NAME='file01' SIZE='40'>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Product</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
               		   		    <select name=fileproductid>
				              <option value=''>-- Silahkan Pilih --</option>
				              <option value='002' selected>SME</option>
               		   		    </select>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Format</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <select name=fileformat>
      	                	   	       <option value='PRN'>SPIN Image File (.prn)</option>
      	                	   	       <option value='JPG'>JPEG (.jpg)</option>
      	                	   	    </select>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>WF ID</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <input type=text name=wfid size=40 maxlength=100 value='<? echo $wfid; ?>'>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Destination</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <input type=text name=where size=40 maxlength=100 value='c:/xampp/htdocs/DM'>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    <font face=Arial size=2>Document</font>
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	       <select name=filedoc>
      	                	   	       	 <option value=''>--Pilih Satu--</option>
<?
   $tsql = "SELECT * FROM Tbl_WorkFlowDoc
   					WHERE wf_id='$wfid'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $datadoc = "";
   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      {
      	$datadoc = $row['wf_doc'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   if ($datadoc != "")
   {
      $arrdoc=explode("|",$datadoc);
      $countdatadoc = 0;
   	  foreach ($arrdoc as $t)
		  {
			   $countdatadoc++;
      }
      for ($i=0;$i<$countdatadoc-1;$i++)
      {
?>
																		   <option value='<? echo $arrdoc[$i]; ?>'><? echo $arrdoc[$i]; ?></option>
<?
      }
   }
   else
   {
      $tsql = "SELECT * FROM Tbl_DocPerson";
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
																		   <option value='<? echo $row['doc_id']; ?>'><? echo $row['doc_id']; ?> - <? echo $row['doc_name']; ?></option>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
   }
?>
      	                	   	      </select>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	      <tr>
      	                	         <td width=35% align=left valign=top>
      	                	   	    &nbsp
      	                	         </td>
      	                	         <td width=65% align=left valign=top>
      	                	   	    <input type=button value='U P L O A D' style="width: 200;" onclick=cekthis()>
      	                	         </td>
      	                	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                      	      <tr>
      	                	 	 <td width=35% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                	 	 <td width=65% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	                	 	 </td>
      	                      	      </tr>
      	                	   </table>
      	                	</td>
      	                      </tr>
                            </TABLE>
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
