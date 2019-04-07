<?php

  $act=$_POST['act'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

    
require ("../lib/open_con.php");

	$tsql = "SELECT COUNT(*) FROM Tbl_SE_User WHERE user_id='$userid' AND user_pwd='$userpwd'";
   	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   	$params = array(&$_POST['query']);
   	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	
	if($sqlConn === false)
	{
		die(FormatErrors(sqlsrv_errors()));
	}
	
	if(sqlsrv_has_rows($sqlConn))
	{
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
   		   $thecount = $row[0];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if($thecount == "0")
   {
	   header("location:restricted.php");
   }

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
   $newrssid=$_POST['newrssid'];

    
require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_RSSFeeds
   					WHERE rss_id='$newrssid'";
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
      $tsql = "DELETE FROM Tbl_RSSFeeds
      				WHERE rss_id='$newrssid'";

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
   $newrssid=$_POST['newrssid'];
   $newrssurut=$_POST['newrssurut'];
   $newrsstitle=$_POST['newrsstitle'];
   $newrsspubdate=$_POST['newrsspubdate'];
   $newrssdesc=$_POST['newrssdesc'];
   $newrsslink=$_POST['newrsslink'];
   
    
require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_RSSFeeds
   					WHERE RSS_ID='$newrssid'";
	
					
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
      $tsql = "UPDATE Tbl_RSSFeeds SET rss_seq='$newrssurut',
      				rss_title='$newrsstitle', rss_datetime = getdate(),
      				rss_description='$newrssdesc', rss_link='$newrsslink'
      				WHERE rss_id='$newrssid'";
					
					//echo $tsql."<br>";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_RSSFeeds VALUES('$newrssid','$newrssurut','$newrsstitle',getdate(),
      				  '$newrssdesc','$newrsslink')";
					  
					 //echo $tsql."<br>";
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

   $ourFileName = "c:/xampp/htdocs/naikorasu/webRSSFeedsNai/xml/megaFeedsDevelopment.xml";
   $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
   $line = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
   fwrite($ourFileHandle,$line);
   $line = "<rss version=\"2.0\">\n";
   fwrite($ourFileHandle,$line);
   $line = "<channel>\n";
   fwrite($ourFileHandle,$line);
   $line = "\n";
   fwrite($ourFileHandle,$line);
   $line = "<title>RSSFeeds Mega</title>\n";
   fwrite($ourFileHandle,$line);
   $line = "<pubDate>06/10/2011</pubDate>\n";
   fwrite($ourFileHandle,$line);
   $line = "<description>Mega RSS Feeds Test</description>\n";
   fwrite($ourFileHandle,$line);
   $line = "<link>http://www.naikorasu.com</link>\n";
   fwrite($ourFileHandle,$line);
   $line = "\n";
   fwrite($ourFileHandle,$line);

   $tsql = "SELECT * FROM Tbl_RSSFeeds
   					ORDER BY rss_Seq";
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
   			$line = "<item>\n";
   			fwrite($ourFileHandle,$line);

   			$line = "<title>" . $row['RSS_TITLE'] . "</title>\n";
   			fwrite($ourFileHandle,$line);
   			$line = "<pubDate>" . $row['RSS_DATETIME']->format('d/m/Y') . "</pubDate>\n";
   			fwrite($ourFileHandle,$line);
   			$line = "<description>" . $row['RSS_DESCRIPTION'] . "</description>\n";
   			fwrite($ourFileHandle,$line);
   			$line = "<link>" . $row['RSS_LINK'] . "</link>\n";
   			fwrite($ourFileHandle,$line);

   			$line = "</item>\n";
   			fwrite($ourFileHandle,$line);
      }
   }
   sqlsrv_free_stmt( $sqlConn );

   $line = "\n";
   fwrite($ourFileHandle,$line);
   $line = "</channel>\n";
   fwrite($ourFileHandle,$line);
   $line = "</rss>\n";
   fwrite($ourFileHandle,$line);

   fclose($ourFileHandle);

   EDITTABLE();

exit;
}


function EDITTABLE()
{
    
require ("../lib/open_con.php");
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
   </head>
   <body>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
   	   <div align=center>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	      	<tr>
   	      		<td width=100% align=left valign=top>
   	      			<form name=formsec method=post>
  							   <input type=hidden name=userid value=<? echo $userid; ?>>
  					  	   <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	      			</form>
     	   	       <A HREF="javascript:changeMenu('../maintainrssfeeds.php')"><font face=Arial size=2>Back To Maintain RSS Feeds</font></A>
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

?> 
