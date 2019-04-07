<?php

  $act=$_POST['act'];

if ($act == "viewzip")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $varzipcode=$_POST[$utilformfield];


    
require ("../lib/open_con.php");

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
      <Script language="Javascript">
	      function isiData(thezipcode,thekelurahan,thekecamatan,thecity,thekabupaten)
	      {
           eval("opener.document." + "<? echo $utilformname; ?>." + "<? echo $utilformfield; ?>" + ".value = '" + thezipcode + "'");
           self.close();
        }
        function goTrust(theid)
        {
           document.utilview.act.value = "viewtrustee" + theid ;
           document.utilview.theid.value = theid;
           document.utilview.action = "./utilview.php";
           document.utilview.submit();
        }
      </Script>
   </head>
   <body onload=self.focus() link=blue alink=blue vlink=blue>
   	   <div align=center>
   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=utilview method=post>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=100% align=center valign=top>
   	  	      			    		<font face=Arial size=2><b>DAFTAR KODEPOS</b></font>
   	  	      			    		<BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      						   <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      						   	   <TR>
   	  	      		   	      						   	   	 <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      						   	   	 	 <font face=Arial size=2 color=#FFFFFF><b>KODEPOS</b></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=center valign=top bgcolor=#006699>
   	  	      		   	      						   	   	 	 <font face=Arial size=2 color=#FFFFFF><b>KELURAHAN</b></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=center valign=top bgcolor=#006699>
   	  	      		   	      						   	   	 	 <font face=Arial size=2 color=#FFFFFF><b>KECAMATAN</b></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=center valign=top bgcolor=#006699>
   	  	      		   	      						   	   	 	 <font face=Arial size=2 color=#FFFFFF><b>KOTA</b></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=center valign=top bgcolor=#006699>
   	  	      		   	      						   	   	 	 <font face=Arial size=2 color=#FFFFFF><b>KABUPATEN</b></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	  </TR>
<?
         if (isset($varzipcde))
         {
         	   $kondisizip = "WHERE kode_pos='$varzipcode'";
         }
         else
         {
         	   $kondisizip = "";
         }
   			  $tsql2 = "SELECT *
   			  						        FROM Tbl_ZipCodeNew
   			  						        $kondisizip
   			  						        ORDER BY kode_pos";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   {
?>
   	  	      		   	      						   	   <TR>
   	  	      		   	      						   	   	 <td width=10% align=center valign=top>
   	  	      		   	      						   	   	 	 <A HREF="javascript:isiData('<? echo $row2[0]; ?>','<? echo $row2[1]; ?>','<? echo $row2[2]; ?>','<? echo $row2[3]; ?>','<? echo $row2[4]; ?>')"><font face=Arial size=2><? echo $row2[0]; ?></font></A>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=left valign=top>
   	  	      		   	      						   	   	 	 <font face=Arial size=2><? echo $row2[1]; ?></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=left valign=top>
   	  	      		   	      						   	   	 	 <font face=Arial size=2><? echo $row2[2]; ?></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=left valign=top>
   	  	      		   	      						   	   	 	 <font face=Arial size=2><? echo $row2[3]; ?></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	   	 <td width=20% align=left valign=top>
   	  	      		   	      						   	   	 	 <font face=Arial size=2><? echo $row2[4]; ?></font>
   	  	      		   	      						   	   	</td>
   	  	      		   	      						   	  </TR>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
   	  	      		   	      			        </table>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			</table>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      </table>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      </table>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=theid>
    								 <input type=hidden name=utilformname value='<? echo $utilformname; ?>'>
    								 <input type=hidden name=utilformfield value='<? echo $utilformfield; ?>'>
    								 <input type=hidden name=newusertrustee value='<? echo $newusertrustee; ?>'>
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

if (substr($act,0,11) == "vieworg")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newbranchorg=$_POST['newbranchorg'];
   $dataall=explode(",",$newbranchorg);
    $countdataall = 0;
   	foreach ($dataall as $t)
		{
			 $countdataall++;
    }


    
require ("../lib/open_con.php");

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
      <Script language="Javascript">
        function backtomaster()
        {
           if (document.utilview.pos1.options[document.utilview.pos1.selectedIndex].value == "")
           {
           	   alert("Please select TOP Position");
           	   document.utilview.pos1.focus();
           	   return false;
           }
           varreturn = document.utilview.pos1.options[document.utilview.pos1.selectedIndex].value + ",";
           for (vari=2;vari<10;vari++)
           {
           	  varj = vari - 1;
           	  if (eval("document.utilview.pos" + vari + ".options[document.utilview.pos" + vari + ".selectedIndex].value") != "")
           	  {
           	        if (eval("document.utilview.pos" + varj + ".options[document.utilview.pos" + varj + ".selectedIndex].value") >= eval("document.utilview.pos" + vari + ".options[document.utilview.pos" + vari + ".selectedIndex].value"))
           	        {
           	     	     alert("Position " + vari + " Higher / Equal Than " + varj);
           	     	     eval("document.utilview.pos" + varj + ".options[document.utilview.pos" + varj + ".selectedIndex].focus")
           	     	     return false;
           	        }
           	        else
           	        {
           	        	   varreturn += eval("document.utilview.pos" + vari + ".options[document.utilview.pos" + vari + ".selectedIndex].value") + ",";
           	        }	
           	  }
           }
           if (varreturn.length <= 1)
           {
           	   alert("Please select ONE");
           	   document.utilview.pos1.focus();
           	   return false;
           }
           opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=varreturn;
           self.close();
        }
        function goTrust(theid)
        {
           document.utilview.act.value = "viewtrustee" + theid ;
           document.utilview.theid.value = theid;
           document.utilview.action = "./utilview.php";
           document.utilview.submit();
        }
      </Script>
   </head>
   <body onload=self.focus()>
   	   <div align=center>
   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=utilview method=post>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=100% align=center valign=top>
   	  	      			    		<font face=Arial size=2><b>Struktur Organisasi</b></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp SETTING</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=50% align=left valign=top>
   	  	      		   	      						   <table width=100% border=0 cellpadding=2 cellspacing=2>
<?
																	for ($i=1;$i<10;$i++)
																	{
?>
																					    <tr>
																					    	<td width=20% align=left valign=top>
																					    		<font face=Arial size=2>&nbsp &nbsp Position <? echo $i; ?> :</font>
																					    	</td>
																					    	<td width=80% align=left valign=top>
																					    		<select name=pos<? echo $i; ?>>
   	  	      			         								         <option value=''>-- Choose One --</option>
<?
   			  $tsql2 = "SELECT *
   			  						        FROM Tbl_SE_Level
   			  						        ORDER BY level_code";
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
										$varselected = "";
										$zz = $i - 1;
										   if ($row2[level_code] == $dataall[$zz])
										   {
										      $varselected = "selected";
										   }
?>
   	  	      			         								         <option value='<? echo $row2['level_code']; ?>' <? echo $varselected; ?>><? echo $row2['level_code']; ?> - <? echo $row2['level_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
																					    	</select>
																					    	</td>
																					    </tr>
<?
																  }
?>
   	  	      		   	      			        </table>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=50% align=left valign=top>
<?
																if ($countdataall > 1)
																{
																}
																else
																{
																	echo "&nbsp";
															  }
?>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			</table>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      </table>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      </table>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=theid>
    								 <input type=hidden name=utilformname value='<? echo $utilformname; ?>'>
    								 <input type=hidden name=utilformfield value='<? echo $utilformfield; ?>'>
    								 <input type=hidden name=newusertrustee value='<? echo $newusertrustee; ?>'>
                     <input type=button value='SUBMIT' onClick="javascript:backtomaster()">
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
