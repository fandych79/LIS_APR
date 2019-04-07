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
                      <font style="font-size: 12;" color=#FFFFFF><B>Form type : Document Management &nbsp</B></font>
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
                  	<form name=formsubmit method=post action=./dospin_legal.php>
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
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=1 bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff">
												   <tr>
												   	<td width=30% align=center valign=top>
												   		<font face=Arial size=2><b>DOCUMENT</b></font>
												   	</td>
												   	<td width=15% align=center valign=top>
												   		<font face=Arial size=2><b>NOMOR</b></font>
												   	</td>
												   	<td width=15% align=center valign=top>
												   		<font face=Arial size=2><b>EXPIRED</b></font>
												   	</td>
												   	<td width=40% align=center valign=top>
												   		<font face=Arial size=2><b>DOCUMENT MANAGEMENT</b></font>
												   	</td>
												  </tr>
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
      		 $vardocno = "";
      		 $vardocdate = "";
         	  $varimg = "/DM/" . $wfid . "/" . $row[0] . ".jpg";
   			  $tsql2 = "SELECT *
						        FROM Tbl_CKPKLegal
						        WHERE docnomid='$wfid'
						        AND doccode='$row[0]'";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
      		   	$vardocno = $row2['docno'];
      		   	$vardocdate = $row2['docdate'];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
												   <tr>
												   	<td width=30% align=left valign=top>
												   		<font face=Arial size=2><? echo $row[1]; ?></font>
												   	</td>
												   	<td width=15% align=center valign=top>
												   		<input type=text name=NO<? echo $row[0]; ?> size=20 maxlength=30 value=<? echo $vardocno; ?>>
												   	</td>
												   	<td width=15% align=center valign=top>
												   		<input type=text name=DATE<? echo $row[0]; ?> size=15 maxlength=10 value=<? echo $vardocdate; ?>>
		   		    							  <a href="javascript:NewCssCal('DATE<? echo $row[0]; ?>','yyyymmdd')"><img src="/lismega_devel/Images/calendar.gif" border="0" height=16 alt="Pick a date" id="img2"/></A>
												   	</td>
												   	<td width=40% align=center valign=top>
                    		      <A HREF=<? echo $varimg; ?> target=lainnya><font face=Arial size=2 color=blue>View</font></A>
												   	</td>
												  </tr>
<?
         }
      }
      sqlsrv_free_stmt( $sqlConn );
?>
                       </TABLE>
                       <center><input type=button value='SUBMIT' style='width: 225mm' onclick=cekthis()></center>
      		     	   <input type=hidden name=wfid value=<? echo $wfid; ?>>
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
