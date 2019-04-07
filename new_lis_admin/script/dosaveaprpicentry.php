<?php
   $custnomid=$_POST['custnomid'];
   $jmlpic=$_POST['jmlpic'];

    
require ("../lib/open_con.php");
   
      $tempfield = "";
      $countfield = 0;
      $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_Col_Picture'";
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
      	   $countfield++;
      	    $tempfield .= $row['COLUMN_NAME'] . ",";
         }
      }
      sqlsrv_free_stmt( $sqlConn );
      $datafield=explode(",",$tempfield);
      $countfield = 0;
   	  foreach ($datafield as $t)
		  {
			   $countfield++;
      }
      for ($i=1;$i<=$jmlpic;$i++)
      {
      	 $vartemp = "col_id" . $i; 
         $colid=$_POST[$vartemp];
   		   $tsql = "SELECT COUNT(*) as b FROM Tbl_Col_Picture
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
      	   		$sudahada = $row['b'];
      			}
   			 }
   		   sqlsrv_free_stmt( $sqlConn );
   		   if ($sudahada == 0)
   		   {
            $tsql = "INSERT INTO Tbl_Col_Picture VALUES('$custnomid',";
            for ($zz=1;$zz<$countfield-1;$zz++)
            {
      	        $vartemp = $datafield[$zz] . $i; 
                $varvalue=$_POST[$vartemp];
            	  if ($countfield - $zz > 2)
            	  {
            	     $tsql .= "'" . $varvalue . "'" . ',';
            	  }
            	  else
            	  {
            	     $tsql .= "'" . $varvalue . "'";
            	  } 
            }
            $tsql .= ")";
   		   }
   		   else
   		   {
            $tsql = "UPDATE Tbl_Col_Picture set ";
            for ($zz=1;$zz<$countfield-1;$zz++)
            {
      	        $vartemp = $datafield[$zz] . $i; 
                $varvalue=$_POST[$vartemp];
            	  if ($countfield - $zz > 2)
            	  {
            	     $tsql .= $datafield[$zz] .  "='" . $varvalue . "'" . ',';
            	  }
            	  else
            	  {
            	     $tsql .= $datafield[$zz] .  "='" . $varvalue . "'";
            	  } 
            }
            $tsql .= " WHERE ap_lisregno='$custnomid' AND pic_counter='PIC$i'";
   		   }
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
