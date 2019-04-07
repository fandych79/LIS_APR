<?php
   $wfid=$_GET['Texcustnomid'];

    
require ("../lib/open_con.php");
   $varsystem = "c:/xampp/htdocs/lismega_devel/bichecking/fix_ai.exe";
   echo exec($varsystem);
?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>SPIN UPLOAD</TITLE>
      <script type="text/javascript" src="/lismega_devel/lib/datetimepicker_css.js"></script>
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
                      <font style="font-size: 12;" color=#FFFFFF><B>Form type : BI Request &nbsp</B></font>
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
                  	   	ALREADY CREATED : <BR><BR>
<?
   $file = "c:/xampp/htdocs/lismega_devel/bichecking/recon.txt";
   $f = fopen($file, "r");
   $urut = 0;
   while ( $line = fgets($f, 1000) )
   {
   	print "<A HREF=/lismega_devel/bichecking/$line>$line</A> <BR><BR>";
   }
?>
                       </TABLE>
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
