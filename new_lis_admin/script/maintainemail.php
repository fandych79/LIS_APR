<?php

//  $userid=$_POST['userid'];
//  $userpwd=$_POST['userpwd'];
//  $act=$_POST['act'];

   $act = "";

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{
    
require ("../lib/open_con.php");
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
   </head>
   <body style="background:url(../images/Background%20Mega.png) no-repeat center;">
<script language="JavaScript"><!--
name = 'utama';
//--></script>
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>

 
   	   <div align=center>
   	      <table style="background-color:#FFF;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
   	      	<tr>
   	      		<td width=100% align=left valign=top>
     	   	       &nbsp
   	      		</td>
   	      	</tr>
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	  	      	 <font face=Arial size=3><b>SEND EMAIL</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post action=/cgi-bin/spin_sendmail.cgi>
   	  	      		<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      			<tr>
   	  	      				 <td width=20% align=left valign=top>
   	  	      				 	 <font face=Arial size=2>Your Email Address</font>
   	  	      				</td>
   	  	      				 <td width=80% align=left valign=top>
   	  	      				 	 <input type=text name=fromemailaddr size=50 maxlength=50>
   	  	      				</td>
   	  	      			</tr>
   	  	      			<tr>
   	  	      				 <td width=20% align=left valign=top>
   	  	      				 	 <font face=Arial size=2>Notary Email Address</font>
   	  	      				</td>
   	  	      				 <td width=80% align=left valign=top>
   	  	      				 	 <input type=text name=toemailaddr size=50 maxlength=50>
   	  	      				 	 <input type=submit value='SEND'>
   	  	      				</td>
   	  	      			</tr>
   	  	      			<tr>
   	  	      				 <td width=20% align=left valign=top>
   	  	      				 	 &nbsp
   	  	      				</td>
   	  	      				 <td width=80% align=left valign=top>
   	  	      				 	 &nbsp
   	  	      				</td>
   	  	      			</tr>
   	  	      		</table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=utilwindow>
    								 <input type=hidden name=utilformname>
    								 <input type=hidden name=utilformfield>
    							   <input type=hidden name=utilfieldvalue>
    						     <input type=hidden name=utilfielddest>
    				         <input type=hidden name=utildetail>
   	  	      		</form>
   	  	      	</td>
   	  	      </tr>
   	      </table>
   	   </div>
   </body>
</html>
<?
   require("../lib/close_con.php");
exit;
}




?> 
