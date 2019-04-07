<?php

  $wfid=$_POST['wfid'];
    
require ("../lib/open_con.php");

      	  $tsql = "DELETE FROM Tbl_CKPKAdmin
   								WHERE docnomid='$wfid'";

      	  $params = array(&$_POST['query']);

      	  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      		if( $stmt )
      	  {
      	  } 
      	  else
      	  {
         		echo "Error in preparing statement.\n";
         		die( print_r( sqlsrv_errors(), true));
      	  }

      		if( sqlsrv_execute( $stmt))
      		{
      		}
      		else
      		{
        		echo "Error in executing statement.\n";
        		die( print_r( sqlsrv_errors(), true));
      		}
      		sqlsrv_free_stmt( $stmt);
   
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
      	 $vartemp = "STS" . $row[0];
         $docsts=$_POST[$vartemp];
      	 $vartemp = "NOTE" . $row[0];
         $docnote=$_POST[$vartemp];

      	  $tsql = "INSERT INTO Tbl_CKPKAdmin VALUES('$wfid','$row[0]',
      	  				 '$docsts','$docnote','')";

      	  $params = array(&$_POST['query']);

      	  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      		if( $stmt )
      	  {
      	  } 
      	  else
      	  {
         		echo "Error in preparing statement.\n";
         		die( print_r( sqlsrv_errors(), true));
      	  }

      		if( sqlsrv_execute( $stmt))
      		{
      		}
      		else
      		{
        		echo "Error in executing statement.\n";
        		die( print_r( sqlsrv_errors(), true));
      		}
      		sqlsrv_free_stmt( $stmt);
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?> 

   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
   </head>
   <body>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	      	<tr>
   	      		<td width=100% align=left valign=top>
     	   	     <A HREF="javascript:history.back();"><font face=Arial size=2>Please Back To Workspace</font></A>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	   </div>
   </body>
</html>
<? 
   
   require("../lib/close_con.php");
exit;

?> 
