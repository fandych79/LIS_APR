<?php

  $act=$_POST['act'];

if ($act == "viewbranch")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newuserbranch=$_POST['newuserbranch'];
   $datatemp=explode(",",$newuserbranch);

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
           varreturn = "";
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch";
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
      		   	  print "if (document.utilview.T$row2[branch_code].checked == true)\n";
      		   	  print "{\n";
      		   	  print "varreturn = varreturn + '$row2[branch_code],';\n";
      		   	  print "}\n";
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
           if (varreturn == "")
           {
           	   alert("Please select one");
           	   return false;
           }
           opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=varreturn;
           self.close();
        }
      </Script>
   </head>
   <body bgcolor=#FFFFCC onload=self.focus()>
   	   <div align=center>
   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=utilview method=post>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=100% align=center valign=top>
   	  	      			    		<font face=Arial size=2><b>Daftar Region - Branch</b></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
<?
   $tsql = "SELECT *
						FROM Tbl_Region
						ORDER BY region_code";
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
          print "<BR><input type=checkbox name='$row[region_code]' value='Y'><font face=Arial size=2>$row[region_code] - $row[region_name]</fomt><BR>";
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
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
?>
   	  	      		   	      			<table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=5% align=left valign=top>
   	  	      		   	      						&nbsp
   	  	      		   	      					</td>
   	  	      		   	      					<td width=95% align=left valign=top>
<?
   	  	      		   	      						$aa = $row2['branch_code'];
   	  	      		   	      						$statuschecked = "";
   																		  foreach ($datatemp as $t)
																		    {
   	  	      		   	      						   if ($aa == $t)
   	  	      		   	      						   {
   	  	      		   	      						   	   $statuschecked = "checked";
   	  	      		   	      						   }
																		    }
   	  	      		   	      						print "<input type=checkbox name='T$row2[branch_code]' value='Y' $statuschecked><font face=Arial size=2>$row2[branch_code] - $row2[branch_name]</font>";
?>
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      			</table>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
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

if (substr($act,0,11) == "viewtrustee")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newusertrustee=$_POST['newusertrustee'];
   $dataall=explode("~",$newusertrustee);
    $countdataall = 0;
   	foreach ($dataall as $t)
		{
			 $countdataall++;
    }

   $act = $act . "1";
   $countdataall = 1;
   $countdataproc = 0;
   $countdatatrus = 0;
   if (strlen($act) > 11)
   {
   	   $theid = substr($act,11);
      $dataproc=explode(":",$dataall[0]);
      $datatrus=explode(",",$dataproc[2]);
   	  foreach ($dataproc as $t)
		  {
			   $countdataproc++;
      }
   	  foreach ($datatrus as $t)
		  {
			   $countdatatrus++;
      }
   }
   else
   {
   	   $theid = $countdataall;
   }

//echo "$theid - $dataall[0]";
//   $dataproc=explode(":",$newusertrustee);
//   $datatrus=explode(",",$dataproc[1]);


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
           varreturn = "";
<?
   			  $tsql2 = "SELECT program_code, program_group, program_helpdoc
   			  						        FROM Tbl_SE_Program
   			  						        WHERE program_helpdoc='WRK'";
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
?>
      		   	  if (document.utilview.T<? echo $row2['program_code']; ?>.checked == true)
      		   	  {
      		   	     varreturn = varreturn + '<? echo $row2['program_code']; ?>';
<?
      		   	     if ($row2['program_helpdoc'] == "WRK")
      		   	     {
?>
      		   	     	   adaact = 0;
      		   	     	   varact = "";
      		   	     	   if (document.utilview.I<? echo $row2['program_code']; ?>.checked == true)
      		   	     	   {
      		   	     	   	   adaact = 1;
      		   	     	   	   varact = varact + "I";
      		   	     	   }
      		   	     	   if (document.utilview.C<? echo $row2['program_code']; ?>.checked == true)
      		   	     	   {
      		   	     	   	   adaact = 1;
      		   	     	   	   varact = varact + "C";
      		   	     	   }
      		   	     	   if (document.utilview.A<? echo $row2['program_code']; ?>.checked == true)
      		   	     	   {
      		   	     	   	   adaact = 1;
      		   	     	   	   varact = varact + "A";
      		   	     	   }
      		   	     	   if (adaact <= 0)
      		   	     	   {
           	   			       alert("<? echo $row2['program_code']; ?> : Please select ACTION");
           	   			       document.utilview.I<? echo $row2['program_code']; ?>.focus;
           	   			       return false;
      		   	     	   }
      		   	     	   else
      		   	     	   {
      		   	     	   	   varreturn = varreturn + "/" + varact;
      		   	     	   }
<?
      		   	     }
?>
      		   	     varreturn = varreturn + ',';
      		   	  }
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
           if (varreturn == "")
           {
           	   alert("Please select  WORKFLOW");
           	   return false;
           }
           if (document.utilview.trusteeproc.options[document.utilview.trusteeproc.selectedIndex].value == "")
           {
           	   alert("Please select one Proc Code");
           	   document.utilview.trusteeproc.focus();
           	   return false;
           }
           if (document.utilview.trusteebranch.options[document.utilview.trusteebranch.selectedIndex].value == "")
           {
           	   alert("Please select one Branch Code");
           	   document.utilview.trusteebranch.focus();
           	   return false;
           }
           varreturn = document.utilview.trusteeproc.options[document.utilview.trusteeproc.selectedIndex].value + ":" + document.utilview.trusteebranch.options[document.utilview.trusteebranch.selectedIndex].value + ":" + varreturn + "~";
<?
						for($zz=1;$zz<=$countdataall;$zz++)
						{
							if ($zz != $theid)
							{
								if ($zz < $theid)
								{
?>
					  varreturn = "<? echo $dataall[$zz-1]; ?>~" + varreturn;
<?
							  }
								else
								{
?>
					  varreturn = varreturn + "<? echo $dataall[$zz-1]; ?>~";
<?
							  }
						  }
					  }
?>
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
   	  	      			    		<font face=Arial size=2><b>Daftar Trustee</b></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=2% align=left valign=top>
   	  	      		   	      			   &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=98% align=left valign=top>
<?
												 for ($i=1;$i<=$countdataall;$i++)
												 {
												 	  if ($i == $theid)
												 	  {
												 	      print "$i &nbsp";
												 	  }
												 	  else
												 	  {
												 	      print "<A HREF=\"javascript:goTrust('$i')\"><font face=Arial size=2>$i</font></A> &nbsp";
												 	  }
												 }
?>															   
   	  	      		   	      	</td>
   	  	      		   	      </tr>
   	  	      		   	    </table>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=30% align=left valign=top>
   	  	      		   	      						<font face=Arial size=2 color=black> &nbsp &nbsp Proc. Code</font>
   	  	      		   	      					</td>
   	  	      		   	      					<td width=70% align=left valign=top>
   	  	      		   	      						<select name=trusteeproc>
   	  	      		   	      							<option value=''>-Please Choose One-</option>
<?
   $tsql = "SELECT * FROM Tbl_Processing";
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
      	   $varselected = "";
      	   if ($countdataproc > 0)
      	   {
      	   	   if ($row['proc_code'] == $dataproc[0])
      	   	   {
      	          $varselected = "selected";
      	   	   }
      	   }
?>
   	  	      			         <option value='<? echo $row['proc_code']; ?>' <? echo $varselected; ?>><? echo $row['proc_code']; ?> - <? echo $row['proc_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      					  </select>
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=30% align=left valign=top>
   	  	      		   	      						<font face=Arial size=2 color=black>&nbsp</font>
   	  	      		   	      					</td>
   	  	      		   	      					<td width=70% align=left valign=top>
   	  	      		   	      					   &nbsp
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=30% align=left valign=top>
   	  	      		   	      						<font face=Arial size=2 color=black> &nbsp &nbsp Branch Code</font>
   	  	      		   	      					</td>
   	  	      		   	      					<td width=70% align=left valign=top>
   	  	      		   	      						<select name=trusteebranch>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Region
						ORDER BY region_code";
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
   	  	      			         <option value='<? echo $row['region_code']; ?>'><? echo $row['region_code']; ?> - <? echo $row['region_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
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
      	   			if ($countdataproc > 0)
      	   			{
      	   	   		if ($row2['branch_code'] == $dataproc[1])
      	   	   		{
		      	          $varselected = "selected";
      	   	   		}
      	   			}
?>
   	  	      			         <option value='<? echo $row2['branch_code']; ?>' <? echo $varselected; ?>>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      					  </select>
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      			</table>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
<?
   $tsql = "SELECT *
						FROM Tbl_SE_GrpProgram
						WHERE grp_code='WRK'
						ORDER BY grp_urut";
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
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp <? echo $row['grp_name']; ?></b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_SE_Program
						        WHERE program_helpdoc='$row[grp_code]'
						        ORDER BY program_urut";
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
      	   			$varica = "";
      	   			if ($countdatatrus > 0)
      	   			{
      	   				for ($zz=0;$zz<$countdatatrus-1;$zz++)
      	   				{
   								   $datatemp=explode("/",$datatrus[$zz]);
      	   	   		   if ($row2['program_code'] == $datatemp[0])
      	   	   		   {
      	          		   $varselected = "checked";
      	          		   $varica = $datatemp[1];
      	   	   		   }
      	   			  }
      	   			}
?>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      						   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      							    <tr>
   	  	      		   	      								     <td width=5% align=left valign=top>
   	  	      		   	      										    &nbsp
   	  	      		   	      									   </td>
   	  	      		   	      								     <td width=45% align=left valign=top>
<?
   	  	      		   	      						print "<input type=checkbox name='T$row2[program_code]' value='Y' $varselected><font face=Arial size=2>$row2[program_code] - $row2[program_name]</font>";
?>
   	  	      		   	      					           </td>
   	  	      		   	      								     <td width=50% align=left valign=top>
<?
      		   																       $Ivarselected = "";
      		   																       $Cvarselected = "";
      		   																       $Avarselected = "";
   																		  if ($row2['program_helpdoc'] == "WRK")
																		    {
      		   																       $Ivarselected = "";
      		   																       $Cvarselected = "";
      		   																       $Avarselected = "";
   			  															   $tsql3 = "SELECT wf_action
						        																	FROM Tbl_Workflow
						        																	WHERE wf_id='$row2[program_code]'";
          																 $cursorType3 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  																 $params3 = array(&$_POST['query']);

   		    																 $sqlConn3 = sqlsrv_query($conn, $tsql3, $params3, $cursorType3);

          																 if ( $sqlConn3 === false)
      																					die( FormatErrors( sqlsrv_errors() ) );

   			  																 if(sqlsrv_has_rows($sqlConn3))
   			  																 {
      		   																   $rowCount3 = sqlsrv_num_rows($sqlConn3);
      		   																   $stsinp = "disabled";
      		   																   $stschk = "disabled";
      		   																   $stsapr = "disabled";
      		   																   $clrinp = "#CCCCFF";
      		   																   $clrchk = "#CCCCFF";
      		   																   $clrapr = "#CCCCFF";
      		   																       $Ivarselected = "";
      		   																       $Cvarselected = "";
      		   																       $Avarselected = "";
      			 																	 while( $row3 = sqlsrv_fetch_array( $sqlConn3, SQLSRV_FETCH_ASSOC))
      		   																	 {
      		   																       $Ivarselected = "";
      		   																       $Cvarselected = "";
      		   																       $Avarselected = "";
      		   																	 	   for ($zz=0;$zz<strlen($row3['wf_action']);$zz++)
      		   																	 	   {
      		   																	 	   	   if (substr($row3['wf_action'],$zz,1) == "I")
      		   																	 	   	   {
      		   																	 	   	   	   $stsinp = "";
      		   																               $clrinp = "black";
      		   																	 	   	       $Ivarselected = "";
      	   																								 if ($countdatatrus > 0)
      	   																								 {
      		   																                  for ($kk=0;$kk<strlen($varica);$kk++)
      		   																                  {
      		   																               	     if (substr($varica,$kk,1) == substr($row3['wf_action'],$zz,1))
      		   																               	     {
      		   																               	  	    $Ivarselected = "checked";
      		   																               	     }
      		   																               	  }
      		   																               }
      		   																	 	   	   }
      		   																	 	   	   if (substr($row3['wf_action'],$zz,1) == "C")
      		   																	 	   	   {
      		   																	 	   	   	   $stschk = "";
      		   																               $clrchk = "black";
      		   																	 	   	       $Cvarselected = "";
      	   																								 if ($countdatatrus > 0)
      	   																								 {
      		   																                  for ($kk=0;$kk<strlen($varica);$kk++)
      		   																                  {
      		   																               	     if (substr($varica,$kk,1) == substr($row3['wf_action'],$zz,1))
      		   																               	     {
      		   																               	  	    $Cvarselected = "checked";
      		   																               	     }
      		   																               	  }
      		   																               }
      		   																	 	   	   }
      		   																	 	   	   if (substr($row3['wf_action'],$zz,1) == "A")
      		   																	 	   	   {
      		   																	 	   	   	   $stsapr = "";
      		   																               $clrapr = "black";
      		   																	 	   	       $Avarselected = "";
      	   																								 if ($countdatatrus > 0)
      	   																								 {
      		   																                  for ($kk=0;$kk<strlen($varica);$kk++)
      		   																                  {
      		   																               	     if (substr($varica,$kk,1) == substr($row3['wf_action'],$zz,1))
      		   																               	     {
      		   																               	  	    $Avarselected = "checked";
      		   																               	     }
      		   																               	  }
      		   																               }
      		   																	 	   	   }
      		   																	 	   }
      		   																	 }
   																				 }
   	      																 sqlsrv_free_stmt( $sqlConn3 );
?>
																		    	           <table width=100% border=0 cellpadding=0 cellspacing=0>
																		    	           	  <tr>
																		    	           	  	<td width=32% align=left valign=top>
																		    	           	  		<input type=checkbox name=I<? echo $row2['program_code']; ?> value='Y' <? echo $stsinp; ?> <? echo $Ivarselected; ?>>
																		    	           	  		<font face=Arial size=2 color=<? echo $clrinp; ?>>Input</font>
																		    	           	  	</td>
																		    	           	  	<td width=2% align=left valign=top>
																		    	           	  		&nbsp
																		    	           	  	</td>
																		    	           	  	<td width=32% align=left valign=top>
																		    	           	  		<input type=checkbox name=C<? echo $row2['program_code']; ?> value='Y' <? echo $stschk; ?> <? echo $Cvarselected; ?>>
																		    	           	  		<font face=Arial size=2 color=<? echo $clrchk; ?>>Checker</font>
																		    	           	  	</td>
																		    	           	  	<td width=2% align=left valign=top>
																		    	           	  		&nbsp
																		    	           	  	</td>
																		    	           	  	<td width=32% align=left valign=top>
																		    	           	  		<input type=checkbox name=A<? echo $row2['program_code']; ?> value='Y' <? echo $stsapr; ?> <? echo $Avarselected; ?>>
																		    	           	  		<font face=Arial size=2 color=<? echo $clrapr; ?>>Approve</font>
																		    	           	  	</td>
																		    	           	  </tr>
																		    	          </table>
<?
																		    }
																		    else
																		    {
																		    	print "&nbsp";
																		    }
?>
   	  	      		   	      					           </td>
   	  	      		   	      				          </tr>
   	  	      		   	      			        </table>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
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

if (substr($act,0,11) == "viewhirarki")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newuserbranch=$_POST['newuserbranch'];
   $newuserlevel=$_POST['newuserlevel'];
   $newuserlimit=$_POST['newuserlimit'];


   require ("../lib/open_con.php");

   			  $tsql2 = "SELECT branch_chart, branch_budget
   			  						        FROM Tbl_Branch
   			  						        WHERE branch_code='$newuserbranch'";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
   			  	     $branchbudget=$row2['branch_budget'];
   			  	     $branchchart=$row2['branch_chart'];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );

   $datachart=explode(",",$branchchart);
    $countdataall = 0;
   	foreach ($datachart as $t)
		{
			 $countdataall++;
    }

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
																	for ($i=1;$i<$countdataall;$i++)
																	{
?>
																					    <tr>
																					    	<td width=20% align=left valign=top>
																					    		<font face=Arial size=2>&nbsp &nbsp Position <? echo $i; ?> :</font>
																					    	</td>
																					    	<td width=40% align=center valign=top>
<?
          $zz = $i - 1;
      		$varposition = "";
   			  $tsql2 = "SELECT *
   			  						        FROM Tbl_SE_Level
   			  						        WHERE level_code='$datachart[$zz]'";
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
      		   	   if ($row2['level_code'] == $newuserlevel)
      		   	   {
      		          $varposition = "<img src=/lismega_devel/images/Arrow.gif> Your Position Here Limit $newuserlimit";
      		   	   }
?>
   	  	      			         								         <input type=button value='<? echo $row2['level_name']; ?>'>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
																					    	</td>
																					    	<td width=40% align=center valign=top>
																					    		  <font face=Arial size=2 color=black><? echo $varposition; ?></font>
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

if (substr($act,0,11) == "viewchild")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newuserchild=$_POST['newuserchild'];
   $newuserlevel=$_POST['newuserlevel'];
   $newuserbranch=$_POST['newuserbranch'];
   $dataall=explode("|",$newuserchild);

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
           varreturn = "";
<?
   			  $tsql2 = "SELECT user_id,user_name,user_level_code
   			  						        FROM Tbl_SE_User
   			  						        WHERE user_level_code>'$newuserlevel'
   			  						        AND user_branch_code='$newuserbranch'
   			  						        AND SUBSTRING(user_id,1,5)<>'admin'
   			  						        ORDER BY user_level_code,user_name";
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
?>
								if (document.utilview.B<? echo $row2['user_id']; ?>.checked == true)
								{
						        varreturn = varreturn + '<? echo $row2['user_id']; ?>' + "|";
						     }
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
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
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      						   <table width=100% border=0 cellpadding=2 cellspacing=2>
<?
   			  $tsql2 = "SELECT user_id,user_name,user_level_code
   			  						        FROM Tbl_SE_User
   			  						        WHERE user_level_code>'$newuserlevel'
   			  						        AND user_branch_code='$newuserbranch'
   			  						        AND SUBSTRING(user_id,1,5)<>'admin'
   			  						        ORDER BY user_level_code,user_name";
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
   			  		   $tsql3 = "SELECT level_name
   			  						        FROM Tbl_SE_Level
   			  						        WHERE level_code='$row2[user_level_code]'";
          			 $cursorType3 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  			 $params3 = array(&$_POST['query']);

   		    			 $sqlConn3 = sqlsrv_query($conn, $tsql3, $params3, $cursorType3);

          			 if ( $sqlConn3 === false)
      						 die( FormatErrors( sqlsrv_errors() ) );

   			  			 if(sqlsrv_has_rows($sqlConn3))
   			  			 {
      		   			  $rowCount3 = sqlsrv_num_rows($sqlConn3);
      			 			  while( $row3 = sqlsrv_fetch_array( $sqlConn3, SQLSRV_FETCH_ASSOC))
      		   			  {
      		   			  	   $varlevelname = $row3['level_name'];
      		   				}
   							 }
   	             sqlsrv_free_stmt( $sqlConn3 );
   	             
   	             $statuschecked = "";
   	             for ($i=0;$i<$countdataall;$i++)
   	             {
   	             	  if ($dataall[$i] == $row2['user_id'])
   	             	  {
   	             	  	$statuschecked = "checked";
   	             	  }
   	             }
?>
																					    <tr>
																					    	<td width=80% align=left valign=top>
																					    		<input type=checkbox name=B<? echo $row2['user_id']; ?> value='Y' <? echo $statuschecked; ?>><font face=Arial size=2><? echo $row2['user_id']; ?> - <? echo $row2['user_name']; ?> [<? echo $varlevelname; ?>]</font>
																					    	</td>
																					    </tr>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
   	  	      		   	      			        </table>
   	  	      		   	      			        <BR>
   	  	      		   	      			        <input type=button value='SUBMIT' onclick=backtomaster()>
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

if (substr($act,0,11) == "viewflow")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newprevflow=$_POST['newprevflow'];
   $newwfid=$_POST['newwfid'];
   $dataall=explode("|",$newprevflow);
   $statuswfid = 0;


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
           varreturn = "";
<?
   			  $tsql2 = "SELECT wf_id,wf_name,wf_urut
   			  						        FROM Tbl_Workflow
   			  						        ORDER BY wf_urut";
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
?>
								if (document.utilview.B<? echo $row2['wf_id']; ?>.checked == true)
								{
						        varreturn = varreturn + '<? echo $row2['wf_id']; ?>' + "|";
						     }
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
           opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=varreturn.substring(0,varreturn.length-1);
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
   	  	      			    		<font face=Arial size=2><b>Struktur Workflow <? echo $newwfid; ?></b></font>
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
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      						   <table width=100% border=0 cellpadding=2 cellspacing=2>
<?
   			  $tsql2 = "SELECT wf_id,wf_name,wf_urut
   			  						        FROM Tbl_Workflow
   			  						        ORDER BY wf_urut";
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
   	             if ($row2[0] == $newwfid)
   	             {
   	             	   $statuswfid = 1;
   	             }
   	             $statuschecked = "";
   	             for ($i=0;$i<$countdataall;$i++)
   	             {
   	             	  if ($dataall[$i] == $row2[0])
   	             	  {
   	             	  	$statuschecked = "checked";
   	             	  }
   	             }
   	             if ($statuswfid > 0)
   	             {
?>
																					    <tr>
																					    	<td width=80% align=left valign=top>
																					    		<input type=checkbox name=B<? echo $row2[0]; ?> value='Y' <? echo $statuschecked; ?> disabled><font face=Arial size=2><? echo $row2[2]; ?> - <? echo $row2[0]; ?> / <? echo $row2[1]; ?></font>
																					    	</td>
																					    </tr>
<?
   	             }
   	             else
   	             {
?>
																					    <tr>
																					    	<td width=80% align=left valign=top>
																					    		<input type=checkbox name=B<? echo $row2[0]; ?> value='Y' <? echo $statuschecked; ?>><font face=Arial size=2><? echo $row2[2]; ?> - <? echo $row2[0]; ?> / <? echo $row2[1]; ?></font>
																					    	</td>
																					    </tr>
<?
   	             }
   	             if ($row2[0] == $newwfid)
   	             {
?>
																					    <tr>
																					    	<td width=80% align=left valign=top>
																					    		<hr size=2 color=blue>
																					    	</td>
																					    </tr>
<?
   	             }
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
   	  	      		   	      			        </table>
   	  	      		   	      			        <BR>
   	  	      		   	      			        <input type=button value='SUBMIT' onclick=backtomaster()>
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

if (substr($act,0,11) == "rulesflow")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newrulesflow=$_POST['newrulesflow'];
   $newwfid=$_POST['newwfid'];
   $statuswfid = 0;
   $maxrow = 10;


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
           varreturn = "";
           for(vari=1;vari<=document.utilview.maxrow.value;vari++)
           {
           	  varbool = eval("document.utilview.boolname" + vari + ".value");
           	  vartable = eval("document.utilview.tablename" + vari + ".value");
           	  varsql = eval("document.utilview.sqlname" + vari + ".value");
           	  varfield = eval("document.utilview.fieldname" + vari + ".value");
           	  varkey = eval("document.utilview.keyname" + vari + ".value");
           	  varopr = eval("document.utilview.oprname" + vari + ".value");
           	  varvalue = eval("document.utilview.valuename" + vari + ".value");
           	  if (vartable != "" && varsql != "" && varfield != "" && varkey != "" && varopr != "" && varvalue != "")
           	  {
           	  	 if (vari > 1)           	  	
           	  	 {
           	  	 	   varreturn = varreturn + "^^";
           	  	 }
           	     varreturn = varreturn + varbool + "**" + vartable + "**" + varsql + "**" + varfield + "**" + varkey + "**" + varopr + "**" + varvalue;
           	  }
           }
           varreturn = varreturn + "/";
           opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=varreturn.substring(0,varreturn.length-1);
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
   	  	      			    		<font face=Arial size=2><b>Setting Rules <? echo $newwfid; ?></b></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp BOOL</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp TABLE</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp FIELD</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp PKEY</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp VARKEY</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp OPR</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp VALUE</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
<?
   														$dataall=explode("^^",$newrulesflow);
   														$arropr = array("EQ","NE","GT","LT","GE","LE");
   														$arroprname = array("EQ (=)","NE (!=)","GT (>)","LT (<)","GE (>=)","LE (<=)");
															for($ki=1;$ki<=$maxrow;$ki++)
															{
																$varj = $ki - 1;
																	$varbool = "";
																	$vartable = "";
																	$varsql = "";
																	$varfield = "";
																	$varkey = "";
																	$varopr = "";
																	$varvalue = "";
															  if ($newrulesflow != "")
															  {
																  if ($varj < count($dataall))																
																  {
																   	$arrdata = explode("**",$dataall[$varj]);
																		$varbool = $arrdata[0];
																		$vartable = $arrdata[1];
																		$varsql = $arrdata[2];
																		$varfield = $arrdata[3];
																		$varkey = $arrdata[4];
																		$varopr = $arrdata[5];
																		$varvalue = $arrdata[6];
																  }
																}
																if ($ki == 1)
																{
																	$valuebool = "";
																}
																else
																{
																	$valuebool = "AND";
																}
?>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<select name=boolname<? echo $ki ?>>
   	  	      		   	      			   	  		<option value='<? echo $valuebool ?>'><? echo $valuebool ?></option>
   	  	      		   	      			   	  	</select>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<input type=text name=tablename<? echo $ki ?> size=10 maxlength=50 value='<? echo $vartable ?>' style="background-color:#FF0;">
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<input type=text name=sqlname<? echo $ki ?> size=10 maxlength=50 value='<? echo $varsql ?>' style="background-color:#FF0;">
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<input type=text name=fieldname<? echo $ki ?> size=10 maxlength=50 value='<? echo $varfield ?>' style="background-color:#FF0;">
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<input type=text name=keyname<? echo $ki ?> size=10 maxlength=50 value='<? echo $varkey ?>' style="background-color:#FF0;">
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<select name=oprname<? echo $ki ?>>
   	  	      		   	      			   	  		<option value=''></option>
<?
																					for ($zz=0;$zz<count($arropr);$zz++)
																					{
																						if ($varopr == $arropr[$zz])
																						{
																						   echo "<option value='$arropr[$zz]' selected>$arroprname[$zz]</option>";
																						}
																						else
																						{
																						   echo "<option value='$arropr[$zz]'>$arroprname[$zz]</option>";
																						}
																					}
?>
   	  	      		   	      			   	  	</select>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<input type=text name=valuename<? echo $ki ?> size=10 maxlength=50 value='<? echo $varvalue ?>' style="background-color:#FF0;">
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
<?
															}
?>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=10% align=center valign=top bgcolor=#006699>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			</table>
   	  	      		   	      			<BR>
   	  	      		   	      			<center><input type=button value='SUBMIT' onclick=backtomaster()></center>
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
    								 <input type=hidden name=maxrow value='<? echo $maxrow; ?>'>
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

if (substr($act,0,11) == "nextflow")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newnextflow=$_POST['newnextflow'];
   $newwfid=$_POST['newwfid'];
   $statuswfid = 0;
   if($newnextflow == "")
   {
   	  $newnextflow = "~";
   }
   $dataall=explode("~",$newnextflow);

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
           varreturn = "";
           	  varnext1 = document.utilview.next1.options[document.utilview.next1.selectedIndex].value;
           	  varnext2 = document.utilview.next2.options[document.utilview.next2.selectedIndex].value;
           	  if (varnext1 == "" || varnext2 == "")
           	  {
           	  	 alert("Harap Pilih Flow");
           	  	 return false;
           	  }
           varreturn = varnext1 + "~" + varnext2 + "~";
           opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=varreturn.substring(0,varreturn.length-1);
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
   	  	      			    		<font face=Arial size=2><b>Setting Next Flow <? echo $newwfid; ?></b></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=60% align=left valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp Jika Rule Terpenuhi, lanjutkan ke Flow :</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=2% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=37% align=left valign=top>
   	  	      		   	      			   	  	<select name=next1>
   	  	      		   	      			   	  		 <option value=''>-- Silahkan Pilih --</option>
<?
   			  $tsql2 = "SELECT wf_id,wf_name
   			  						        FROM Tbl_Workflow
   			  						        ORDER BY wf_urut";
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
      		   			if ($dataall[0] == $row2[0])
      		   			{
   	  	      			         								         echo "<option value='$row2[0]' selected>$row2[0] - $row2[1]</option>";
									}
      		   			else
      		   			{
   	  	      			         								         echo "<option value='$row2[0]'>$row2[0] - $row2[1]</option>";
									}
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
   	  	      		   	      			   	  	</select>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=60% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=2% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=37% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=60% align=left valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp Namun Jika Tidak Terpenuhi, lanjutkan ke Flow :</b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=2% align=left valign=top>
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   	  <td width=37% align=left valign=top>
   	  	      		   	      			   	  	<select name=next2>
   	  	      		   	      			   	  		 <option value=''>-- Silahkan Pilih --</option>
<?
   			  $tsql2 = "SELECT wf_id,wf_name
   			  						        FROM Tbl_Workflow
   			  						        ORDER BY wf_urut";
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
      		   			if ($dataall[1] == $row2[0])
      		   			{
   	  	      			         								         echo "<option value='$row2[0]' selected>$row2[0] - $row2[1]</option>";
									}
      		   			else
      		   			{
   	  	      			         								         echo "<option value='$row2[0]'>$row2[0] - $row2[1]</option>";
									}
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
   	  	      		   	      			   	  	</select>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			</table>
   	  	      		   	      			<BR>
   	  	      		   	      			<center><input type=button value='SUBMIT' onclick=backtomaster()></center>
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
    								 <input type=hidden name=maxrow value='<? echo $maxrow; ?>'>
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

if (substr($act,0,9) == "viewother")
{
   $utilformname=$_POST['utilformname'];
   $utilformfield=$_POST['utilformfield'];
   $newuserother=$_POST['newuserother'];
   $dataall=explode("~",$newuserother);
    $countdataall = 0;
   	foreach ($dataall as $t)
		{
			 $countdataall++;
    }

   $act = $act . "1";
   $countdataall = 1;
   $countdataproc = 0;
   $countdatatrus = 0;
   if (strlen($act) > 9)
   {
   	   $theid = substr($act,9);
      $dataproc=explode(":",$dataall[0]);
      $datatrus=explode(",",$dataproc[2]);
   	  foreach ($dataproc as $t)
		  {
			   $countdataproc++;
      }
   	  foreach ($datatrus as $t)
		  {
			   $countdatatrus++;
      }
   }
   else
   {
   	   $theid = $countdataall;
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
           varreturn = "";
<?
   			  $tsql2 = "SELECT program_code, program_group
   			  						        FROM Tbl_SE_Program
   			  						        WHERE program_helpdoc<>'WRK'";
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
?>
      		   	  if (document.utilview.T<? echo $row2['program_code']; ?>.checked == true)
      		   	  {
      		   	     varreturn = varreturn + '<? echo $row2['program_code']; ?>';
      		   	     varreturn = varreturn + ',';
      		   	  }
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
?>
           if (varreturn == "")
           {
           	   alert("Please select TRUSTEE");
           	   return false;
           }
           if (document.utilview.trusteeproc.options[document.utilview.trusteeproc.selectedIndex].value == "")
           {
           	   alert("Please select one Proc Code");
           	   document.utilview.trusteeproc.focus();
           	   return false;
           }
           if (document.utilview.trusteebranch.options[document.utilview.trusteebranch.selectedIndex].value == "")
           {
           	   alert("Please select one Branch Code");
           	   document.utilview.trusteebranch.focus();
           	   return false;
           }
           varreturn = document.utilview.trusteeproc.options[document.utilview.trusteeproc.selectedIndex].value + ":" + document.utilview.trusteebranch.options[document.utilview.trusteebranch.selectedIndex].value + ":" + varreturn + "~";
<?
						for($zz=1;$zz<=$countdataall;$zz++)
						{
							if ($zz != $theid)
							{
								if ($zz < $theid)
								{
?>
					  varreturn = "<? echo $dataall[$zz-1]; ?>~" + varreturn;
<?
							  }
								else
								{
?>
					  varreturn = varreturn + "<? echo $dataall[$zz-1]; ?>~";
<?
							  }
						  }
					  }
?>
           opener.document.<? echo $utilformname; ?>.<? echo $utilformfield; ?>.value=varreturn;
           self.close();
        }
        function goOther(theid)
        {
           document.utilview.act.value = "viewother" + theid ;
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
   	  	      			    		<font face=Arial size=2><b>Daftar Trustee</b></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=2% align=left valign=top>
   	  	      		   	      			   &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=98% align=left valign=top>
<?
												 for ($i=1;$i<=$countdataall;$i++)
												 {
												 	  if ($i == $theid)
												 	  {
												 	      print "$i &nbsp";
												 	  }
												 	  else
												 	  {
												 	      print "<A HREF=\"javascript:goOther('$i')\"><font face=Arial size=2>$i</font></A> &nbsp";
												 	  }
												 }
?>															   
   	  	      		   	      	</td>
   	  	      		   	      </tr>
   	  	      		   	    </table>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=100% align=left valign=top>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=30% align=left valign=top>
   	  	      		   	      						<font face=Arial size=2 color=black> &nbsp &nbsp Proc. Code</font>
   	  	      		   	      					</td>
   	  	      		   	      					<td width=70% align=left valign=top>
   	  	      		   	      						<select name=trusteeproc>
   	  	      		   	      							<option value=''>-Please Choose One-</option>
<?
   $tsql = "SELECT * FROM Tbl_Processing";
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
      	   $varselected = "";
      	   if ($countdataproc > 0)
      	   {
      	   	   if ($row['proc_code'] == $dataproc[0])
      	   	   {
      	          $varselected = "selected";
      	   	   }
      	   }
?>
   	  	      			         <option value='<? echo $row['proc_code']; ?>' <? echo $varselected; ?>><? echo $row['proc_code']; ?> - <? echo $row['proc_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      					  </select>
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=30% align=left valign=top>
   	  	      		   	      						<font face=Arial size=2 color=black>&nbsp</font>
   	  	      		   	      					</td>
   	  	      		   	      					<td width=70% align=left valign=top>
   	  	      		   	      					   &nbsp
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      				<tr>
   	  	      		   	      					<td width=30% align=left valign=top>
   	  	      		   	      						<font face=Arial size=2 color=black> &nbsp &nbsp Branch Code</font>
   	  	      		   	      					</td>
   	  	      		   	      					<td width=70% align=left valign=top>
   	  	      		   	      						<select name=trusteebranch>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Region
						ORDER BY region_code";
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
   	  	      			         <option value='<? echo $row['region_code']; ?>'><? echo $row['region_code']; ?> - <? echo $row['region_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
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
      	   			if ($countdataproc > 0)
      	   			{
      	   	   		if ($row2['branch_code'] == $dataproc[1])
      	   	   		{
      	          		$varselected = "selected";
      	   	   		}
      	   			}
?>
   	  	      			         <option value='<? echo $row2['branch_code']; ?>' <? echo $varselected; ?>>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      					  </select>
   	  	      		   	      					</td>
   	  	      		   	      				</tr>
   	  	      		   	      			</table>
   	  	      		   	      			<table width=100% cellpadding=0 cellspacing=0 border=0>
<?
   $tsql = "SELECT *
						FROM Tbl_SE_GrpProgram
						WHERE grp_code<>'WRK'
						ORDER BY grp_urut";
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
   	  	      		   	      			   	  	&nbsp
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top bgcolor=#006699>
   	  	      		   	      			   	  	<font face=Arial size=2 color=#FFFFFF><b>&nbsp <? echo $row['grp_name']; ?></b></fomt>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_SE_Program
						        WHERE program_group='$row[grp_code]'
						        AND program_helpdoc<>'WRK'
						        ORDER BY program_urut";
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
      	   			if ($countdatatrus > 0)
      	   			{
      	   				for ($zz=0;$zz<$countdatatrus-1;$zz++)
      	   				{
      	   	   		   if ($row2['program_code'] == $datatrus[$zz])
      	   	   		   {
      	          		   $varselected = "checked";
      	   	   		   }
      	   			  }
      	   			}
?>
   	  	      		   	      			   <tr>
   	  	      		   	      			   	  <td width=100% align=left valign=top>
   	  	      		   	      						   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      							    <tr>
   	  	      		   	      								     <td width=5% align=left valign=top>
   	  	      		   	      										    &nbsp
   	  	      		   	      									   </td>
   	  	      		   	      								     <td width=45% align=left valign=top>
<?
   	  	      		   	      						print "<input type=checkbox name='T$row2[program_code]' value='Y' $varselected><font face=Arial size=2>$row2[program_code] - $row2[program_name]</font>";
?>
   	  	      		   	      					           </td>
   	  	      		   	      								     <td width=50% align=left valign=top>
<?
   																		  if ($row2['program_helpdoc'] == "WRK")
																		    {
   			  															   $tsql3 = "SELECT wf_action
						        																	FROM Tbl_Workflow
						        																	WHERE wf_id='$row2[program_code]'";
          																 $cursorType3 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  																 $params3 = array(&$_POST['query']);

   		    																 $sqlConn3 = sqlsrv_query($conn, $tsql3, $params3, $cursorType3);

          																 if ( $sqlConn3 === false)
      																					die( FormatErrors( sqlsrv_errors() ) );

   			  																 if(sqlsrv_has_rows($sqlConn3))
   			  																 {
      		   																   $rowCount3 = sqlsrv_num_rows($sqlConn3);
      		   																   $stsinp = "disabled";
      		   																   $stschk = "disabled";
      		   																   $stsapr = "disabled";
      		   																   $clrinp = "#CCCCFF";
      		   																   $clrchk = "#CCCCFF";
      		   																   $clrapr = "#CCCCFF";
      			 																	 while( $row3 = sqlsrv_fetch_array( $sqlConn3, SQLSRV_FETCH_ASSOC))
      		   																	 {
      		   																	 	   for ($zz=0;$zz<strlen($row3['wf_action']);$zz++)
      		   																	 	   {
      		   																	 	   	   if (substr($row3['wf_action'],$zz,1) == "I")
      		   																	 	   	   {
      		   																	 	   	   	   $stsinp = "";
      		   																               $clrinp = "black";
      		   																	 	   	   }
      		   																	 	   	   if (substr($row3['wf_action'],$zz,1) == "C")
      		   																	 	   	   {
      		   																	 	   	   	   $stschk = "";
      		   																               $clrchk = "black";
      		   																	 	   	   }
      		   																	 	   	   if (substr($row3['wf_action'],$zz,1) == "A")
      		   																	 	   	   {
      		   																	 	   	   	   $stsapr = "";
      		   																               $clrapr = "black";
      		   																	 	   	   }
      		   																	 	   }
      		   																	 }
   																				 }
   	      																 sqlsrv_free_stmt( $sqlConn3 );
?>
																		    	           <table width=100% border=0 cellpadding=0 cellspacing=0>
																		    	           	  <tr>
																		    	           	  	<td width=32% align=left valign=top>
																		    	           	  		<input type=checkbox name=I<? echo $row2['program_code']; ?> value='Y' <? echo $stsinp; ?>>
																		    	           	  		<font face=Arial size=2 color=<? echo $clrinp; ?>>Input</font>
																		    	           	  	</td>
																		    	           	  	<td width=2% align=left valign=top>
																		    	           	  		&nbsp
																		    	           	  	</td>
																		    	           	  	<td width=32% align=left valign=top>
																		    	           	  		<input type=checkbox name=C<? echo $row2['program_code']; ?> value='Y' <? echo $stschk; ?>>
																		    	           	  		<font face=Arial size=2 color=<? echo $clrchk; ?>>Checker</font>
																		    	           	  	</td>
																		    	           	  	<td width=2% align=left valign=top>
																		    	           	  		&nbsp
																		    	           	  	</td>
																		    	           	  	<td width=32% align=left valign=top>
																		    	           	  		<input type=checkbox name=A<? echo $row2['program_code']; ?> value='Y' <? echo $stsapr; ?>>
																		    	           	  		<font face=Arial size=2 color=<? echo $clrapr; ?>>Approve</font>
																		    	           	  	</td>
																		    	           	  </tr>
																		    	          </table>
<?
																		    }
																		    else
																		    {
																		    	print "&nbsp";
																		    }
?>
   	  	      		   	      					           </td>
   	  	      		   	      				          </tr>
   	  	      		   	      			        </table>
   	  	      		   	      			   	  </td>
   	  	      		   	      			   </tr>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
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
    								 <input type=hidden name=newuserother value='<? echo $newuserother; ?>'>
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
