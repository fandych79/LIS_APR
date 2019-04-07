<?php
   $custnomid=$_GET['Texcustnomid'];
   $jmlpic=$_GET['Texjmlpic'];

    
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
                  	<form name=formsubmit method=post action=dosaveaprpicentry.php>
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

											for ($i=1;$i<=$jmlpic;$i++)
											{
      $colid = "";
      $piclink = "";
      $picdesc = "";
      $tsql = "SELECT * FROM Tbl_Col_Picture
      				 WHERE ap_lisregno='$custnomid'
      				 AND pic_counter='PIC$i'";
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
      $colid = $row['col_id'];
      $piclink = $row['pic_link'];
      $picdesc = $row['pic_desc'];
         }
      }
      sqlsrv_free_stmt( $sqlConn );
?>
                  	   	<font face=Arial size=2><b>PICTURE <? echo $i; ?></b></font>
                  	    <TABLE width=100% cellpadding=0 cellspacing=0>
                  	   	   <tr>
                  	   	   	  <td width=5% align=left valign=top>
                  	   	   	  	  &nbsp
                  	   	   	  </td>
                  	   	   	  <td width=15% align=left valign=top>
                  	   	   	  	  <font face=Arial size=2>COL ID</font>
                  	   	   	  </td>
                  	   	   	  <td width=80% align=left valign=top>
                  	   	   	  	  <input type=text name=col_id<? echo $i; ?> size=30 maxlength=30 value=<? echo $colid; ?>>
                  	   	   	  </td>
                  	   	  </tr>
                  	   	   <tr>
                  	   	   	  <td width=5% align=left valign=top>
                  	   	   	  	  &nbsp
                  	   	   	  </td>
                  	   	   	  <td width=15% align=left valign=top>
                  	   	   	  	  <font face=Arial size=2>PIC Counter</font>
                  	   	   	  </td>
                  	   	   	  <td width=80% align=left valign=top>
                  	   	   	  	  <input type=text name=pic_counter<? echo $i; ?> size=30 maxlength=250 value=PIC<? echo $i; ?>>
                  	   	   	  </td>
                  	   	  </tr>
                  	   	   <tr>
                  	   	   	  <td width=5% align=left valign=top>
                  	   	   	  	  &nbsp
                  	   	   	  </td>
                  	   	   	  <td width=15% align=left valign=top>
                  	   	   	  	  <font face=Arial size=2>PIC Link</font>
                  	   	   	  </td>
                  	   	   	  <td width=80% align=left valign=top>
                  	   	   	  	  <input type=text name=pic_link<? echo $i; ?> size=30 maxlength=250 value=<? echo $piclink; ?>>
                  	   	   	  </td>
                  	   	  </tr>
                  	   	   <tr>
                  	   	   	  <td width=5% align=left valign=top>
                  	   	   	  	  &nbsp
                  	   	   	  </td>
                  	   	   	  <td width=15% align=left valign=top>
                  	   	   	  	  <font face=Arial size=2>PIC Desc</font>
                  	   	   	  </td>
                  	   	   	  <td width=80% align=left valign=top>
                  	   	   	  	  <input type=text name=pic_desc<? echo $i; ?> size=30 maxlength=250 value=<? echo $picdesc; ?>>
                  	   	   	  </td>
                  	   	  </tr>
                  	   </table>
<?
										  }
?>
      		     	     <BR>
      		     	     <input type=button value='SUBMIT' style='width: 225mm' onclick=cekthis()>
      		     	     <input type=hidden name=userid value='bhartoyo'>
          	     	   <input type=hidden name=userpwd value='1245'>
          	     	   <input type=hidden name=act value='simpandata'>
      		     	     <input type=hidden name=custnomid value='<? echo $custnomid; ?>'>
      		     	     <input type=hidden name=jmlpic value='<? echo $jmlpic; ?>'>
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
