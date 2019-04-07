<?php

  $act=$_POST['act'];

   if ($act == "saveform")
   {
      SAVETABLE();
   }
   if ($act == "del")
   {
      DELTABLE();
   }

function DELTABLE()
{
exit;
}

function SAVETABLE()
{
   $tarproccode=$_POST['tarproccode'];
   $taraocode=$_POST['taraocode'];
   $tarbranchcode=$_POST['tarbranchcode'];
   $tarbustype=$_POST['tarbustype'];
   $tarinitiator=$_POST['tarinitiator'];
   $tarzipcode=$_POST['tarzipcode'];
   $tarbranchcode=$_POST['tarbranchcode'];
   $tarlocation=$_POST['tarlocation'];
   $tarcount=$_POST['tarcount'];
   $tarcondition=$_POST['tarcondition'];
   $tarhp=$_POST['tarhp'];
   $tarflag=$_POST['tarflag'];
   
   $tarid = "budiha";

   require ("../../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_Targeting
   					WHERE tarid='$tarid'";
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
   
   if ($rowcount <= 0)
   {
      $tsql = "INSERT INTO Tbl_Targeting VALUES('$tarid','$tarproccode','$taraocode','$tarbranchcode',
      				 '$tarbustype','$tarinitiator',
      				 '$tarzipcode','$tarlocation','$tarcount','$tarcondition',
      				 '$tarhp','$tarflag')";
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
   require ("../../lib/open_con.php");

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
     	   	       <A HREF="/lismega_devel/script/formtar.php"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	   </div>
   </body>
</html>
<?
   require("../../lib/close_con.php");
exit;
}


?> 
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
