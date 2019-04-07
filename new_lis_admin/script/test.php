<?php

    
require ("../lib/open_con.php");


   $ourFileName = "c:/xampp/htdocs/lismega_devel/version/" . "TblZip.bfn";
   $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
   $line = "code|desc\n";
   fwrite($ourFileHandle,$line);

   $tsql = "SELECT * FROM Tbl_ZipcodeNew where SUBSTRING(kode_pos,1,1)='1'
   					ORDER BY kode_pos";
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
      	 $line = $row['kode_pos'] . "|" . $row['kelurahan'] . "\n";
         if ($line != "")
         {
            fwrite($ourFileHandle,$line);
         }
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   fclose($ourFileHandle);
   
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      	<title>lismega_devel</title>
      </head>
      <body>
   	   <div align=center>
FINISH
   	      <BR><BR>
   	   </div>      	
      </body>    
   </html>
<?
   require("../lib/close_con.php");

exit;
?> 
