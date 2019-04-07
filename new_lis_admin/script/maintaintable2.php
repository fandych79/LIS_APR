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
      <LINK media=screen href="/lismega_DEVEL/style/menu.css" rel=stylesheet>
      <Script language="Javascript">
        function EditTable(tablename,tabledesc)
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "edittable";
           document.formsubmit.tablename.value = tablename;
           document.formsubmit.tabledesc.value = tabledesc;
           document.formsubmit.action = "./domaintaintable2.php";
           document.formsubmit.submit();
        }
      </Script>
   </head>
   <body>
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



<table style="background-color:#;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >

   	      	<tr>
   	      		<td width=100% align=left valign=top>
     	   	       <A HREF="/lismega_DEVEL/index.php"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      	</tr>
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	  	      	 <font face=Arial size=3><b>MANAGE REPORT</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
   	  	      			 <font face=Arial size=2>SELECT TABLE</font><BR><BR>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
<?
   $tsql = "SELECT *
						FROM Tbl_ManageReport
						ORDER BY tbl_urut,tbl_name";
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
   	  	      			    	<td width=100% align=left valign=top>
   	  	      			         <A HREF="javascript:EditTable('<? echo $row['tbl_name']; ?>','<? echo $row['tbl_desc']; ?>')"><font face=Arial size=2><? echo $row['tbl_desc']; ?></font><BR></A>
   	  	      			    	</td>
   	  	      			    </tr>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   </table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=tablename>
    								 <input type=hidden name=tabledesc>
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
