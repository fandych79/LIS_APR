<?php

  $act=$_POST['act'];

   if ($act == "save")
   {
      SAVETABLE();
   }
   if ($act == "del")
   {
      DELTABLE();
   }

function DELTABLE()
{
   $newdocid=$_POST['newdocid'];

    
require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_DocPerson
   					WHERE doc_id='$newdocid'";
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
      	 $rowcount = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if ($rowcount > 0)
   {
      $tsql = "DELETE FROM Tbl_DocPerson
      				WHERE doc_id='$newdocid'";

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

   EDITTABLE();

exit;
}

function SAVETABLE()
{
   $newdocid=$_POST['newdocid'];
   $newdocname=$_POST['newdocname'];
   $newdocflag=$_POST['newdocflag'];
   
    
require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_DocPerson
   					WHERE doc_id='$newdocid'";
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
      	 $rowcount = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if ($rowcount > 0)
   {
      $tsql = "UPDATE Tbl_DocPerson SET doc_name='$newdocname', 
      			  doc_flag='$newdocflag'
      				WHERE doc_id='$newdocid'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_DocPerson VALUES('$newdocid','$newdocname',
      					'admin','2011-10-10 12:00:00','$newdocflag','Y')";
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

   EDITTABLE();

exit;
}


function EDITTABLE()
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
   <body>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
   	   <div align=center>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	      	<tr>
   	      		<td width=100% align=left valign=top>
     	   	       <A HREF="./maintaindocperson.php"><font face=Arial size=2>Back To Maintain Doc Person</font></A>
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
}

function FormatErrors( $errors )
{
    /* Display errors. */
    echo "Error information: <br/>";

    foreach ( $errors as $error )
    {
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
        echo "Code: ".$error['code']."<br/>";
        echo "Message: ".$error['message']."<br/>";
    }
}



?> 
