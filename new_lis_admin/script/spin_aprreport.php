<?php
   $custnomid=$_GET['Texcustnomid'];
   $act=$_GET['Texact'];
   $wfid=$_GET['Texwfid'];

$serverName = "(local)\MEGASQLSERVER";
$connectionOptions = array("Database"=>"db_appr_mega");

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));

?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>SPIN REPORT GENERATOR</TITLE>
      <Script Language="JavaScript">
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
                      <font style="font-size: 12;" color=#FFFFFF><B>Form type : Report Generator &nbsp</B></font>
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
                  	<form name=formsubmit method=post action=spin_aprreport.php target='lainnya'>
                  	   <TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>                  	   	
   	                      <tr>
<?
   $file = "aprspinparam.ini";
   $f = fopen($file, "r");
   $urut = 0;
   $thisshow = "";
   $arrdata = "";
   if ($act != "new")
   {
   	  $thisshow = $act;
   }
   while ( $line = fgets($f, 1000) )
   {
   	 $urut++;
     $datafield=explode("|",$line);
     if ($act == "new" && $urut == 1)
     {     	
     	   $thisshow = $datafield[0];
     }
     if ($thisshow == $datafield[0])
     {
        $arrdata=explode("|",$line);
?>
												  <td width=10% align=left valign=top>
												  	<font face=Arial size=2 color=blue><b><? echo $datafield[0]; ?></b></font>
												  </td>
<?
     }
     else
     {
     	 $varlink = "spin_aprreport.php?Texcustnomid=" . $custnomid . "&Texact=" . $datafield[0] . "&Texwfid=" . $wfid;
?>
												  <td width=10% align=left valign=top>
												  	<A HREF=<? echo $varlink; ?>><font face=Arial size=2 color=blue><b><? echo $datafield[0]; ?></b></font></A>
												  </td>
<?
     }
   }
   fclose($f);
?>
   	                    </tr>
                  	   </TABLE>
                  	   <BR>
<?
   $arrdb=explode(",",$arrdata[1]);
    $countdb = 0;
   	foreach ($arrdb as $t)
		{
			 $countdb++;
    }
   for ($i=0;$i<$countdb-1;$i++)
   {
       $arrfield=explode(":",$arrdb[$i]);
          $tempfield = "";
          $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = '$arrfield[0]'";
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
      	          $tempfield .= $row['COLUMN_NAME'] . ",";
             }
           }
           sqlsrv_free_stmt( $sqlConn );
           $datascheme=explode(",",$tempfield);

           $countfield = 0;
   	       foreach ($datascheme as $t)
		       {
			        $countfield++;
           }
   	   if ($arrdata[2] == "colmode")
   	   {
           echo "<TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=1 bordercolor=#FFFFFF bordercolorlight=#000000 bordercolordark=#ffffff>";
           echo "<tr>";
           for ($j=0;$j<$countfield-1;$j++)
           {
               	   	  $repdesc = $datascheme[$j];
              			  $tsql2 = "SELECT *
						                    FROM Tbl_ReportMaster
						                    WHERE rep_table='$arrfield[0]'
						                    AND rep_field='$datascheme[$j]'";
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
      		               	   $repdesc = $row2['rep_desc'];
      		               }
   				             }
   	                   sqlsrv_free_stmt( $sqlConn2 );

?>
												  <td width=10% align=center valign=top>
												  	<font face=Arial size=2 color=black><b><? echo $repdesc; ?></b></font>
												  </td>
<?
           }
           echo "</tr>";

           $tsql = "SELECT * FROM $arrfield[0]
   					         WHERE $arrfield[1]='$custnomid'";
           $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
           $params = array(&$_POST['query']);

           $datadoc = "";
           $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
           if ( $sqlConn === false)
                  die( FormatErrors( sqlsrv_errors() ) );

           if(sqlsrv_has_rows($sqlConn))
           {
               $rowCount = sqlsrv_num_rows($sqlConn);
               while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
               {
                   echo "<tr>";
               	   for ($j=0;$j<$countfield-1;$j++)
               	   {
   	                  $outdesc = $row[$j];
              			  $tsql2 = "SELECT *
						                    FROM Tbl_ReportMaster
						                    WHERE rep_table='$arrfield[0]'
						                    AND rep_field='$datascheme[$j]'";
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
      		               	   if ($row2['rep_linktable'] != "")
      		               	   {
     													   $arrlinktable=explode(":",$row2['rep_linktable']);
              			             $tsql3 = "SELECT *
						                               FROM $arrlinktable[0]
						                               WHERE $arrlinktable[1]='$row[$j]'";
                                 $cursorType3 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			                         $params3 = array(&$_POST['query']);
  
   		                           $sqlConn3 = sqlsrv_query($conn, $tsql3, $params3, $cursorType3);

                                 if ( $sqlConn3 === false)
      			                        die( FormatErrors( sqlsrv_errors() ) );

   			                         if(sqlsrv_has_rows($sqlConn3))
   			                         {
      		                          $rowCount3 = sqlsrv_num_rows($sqlConn3);
      			                        while( $row3 = sqlsrv_fetch_array( $sqlConn3, SQLSRV_FETCH_NUMERIC))
      		                          {
      		               	   	         $outdesc .= " - " . $row3[$arrlinktable[2]];
      		                          }
   				                        }
   	                              sqlsrv_free_stmt( $sqlConn3 );
      		               	   }
      		               }
   				             }
   	                   sqlsrv_free_stmt( $sqlConn2 );   	                   
?>
												     <td width=10% align=left valign=top>
												  	   <font face=Arial size=2 color=black>&nbsp<? echo $outdesc; ?>&nbsp</font>
												     </td>
<?
               	  }
                   echo "</tr>";
               }
           }
   	                   

           echo "</TABLE>";
   	   }
   	   else
   	   {

           echo "<TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0>";

           $tsql = "SELECT ap_lisregno, cu_ref, cast(ap_recvdate as varchar), cast(ap_signdate as varchar), taxatype_id, fac_id, branchid, lasttaxa_date1, lasttaxa_date2, cast(taxa_date as varchar), contact, userid, ap_oldregno, ap_dup, active, ap_lisregno, flag, ap_status, ap_description FROM $arrfield[0]
   					         WHERE $arrfield[1]='$custnomid'";
//echo "$tsql";
           $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
           $params = array(&$_POST['query']);

           $datadoc = "";
           $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
           if ( $sqlConn === false)
                  die( FormatErrors( sqlsrv_errors() ) );

           if(sqlsrv_has_rows($sqlConn))
           {
               $rowCount = sqlsrv_num_rows($sqlConn);
               while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
               {
               	   for ($j=0;$j<$countfield-1;$j++)
               	   {
               	   	  $repdesc = $datascheme[$j];
   	                  $outdesc = $row[$j];
              			  $tsql2 = "SELECT *
						                    FROM Tbl_ReportMaster
						                    WHERE rep_table='$arrfield[0]'
						                    AND rep_field='$datascheme[$j]'";
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
      		               	   $repdesc = $row2['rep_desc'];
      		               	   if ($row2['rep_linktable'] != "")
      		               	   {
     													   $arrlinktable=explode(":",$row2['rep_linktable']);
              			             $tsql3 = "SELECT *
						                               FROM $arrlinktable[0]
						                               WHERE $arrlinktable[1]='$row[$j]'";
                                 $cursorType3 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			                         $params3 = array(&$_POST['query']);
  
   		                           $sqlConn3 = sqlsrv_query($conn, $tsql3, $params3, $cursorType3);

                                 if ( $sqlConn3 === false)
      			                        die( FormatErrors( sqlsrv_errors() ) );

   			                         if(sqlsrv_has_rows($sqlConn3))
   			                         {
      		                          $rowCount3 = sqlsrv_num_rows($sqlConn3);
      			                        while( $row3 = sqlsrv_fetch_array( $sqlConn3, SQLSRV_FETCH_NUMERIC))
      		                          {
      		               	   	         $outdesc .= " - " . $row3[$arrlinktable[2]];
      		                          }
   				                        }
   	                              sqlsrv_free_stmt( $sqlConn3 );
      		               	   }
      		               }
   				             }
   	                   sqlsrv_free_stmt( $sqlConn2 );
   	                   
?>
												  <tr>
												     <td width=30% align=left valign=top>
												  	   <font face=Arial size=2 color=black>&nbsp<? echo $repdesc; ?>&nbsp</font>
												     </td>
												     <td width=70% align=left valign=top>
												  	   <font face=Arial size=2 color=black>&nbsp<b><? echo $outdesc; ?></b>&nbsp</font>
												     </td>
												  </tr>
<?
               	 }
               }
            }
            sqlsrv_free_stmt( $sqlConn );

           echo "</TABLE>";
   	   }
   }
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
