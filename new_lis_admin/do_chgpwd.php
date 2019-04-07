<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $oldpassword=$_POST['oldpassword'];
  $newpassword=$_POST['newpassword'];

   require ("lib/open_con.php");

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
	   exit;
   }

	$tsql = "SELECT user_pwd FROM Tbl_SE_User WHERE user_id='$userid'";
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
   		   $theoldpwd = $row[0];
      }
   }
   sqlsrv_free_stmt( $sqlConn );

   if($theoldpwd != $oldpassword)
   {
	   header("location:restricted.php");
	   exit;
   }

      $tsql = "UPDATE Tbl_SE_User
      				 set user_pwd='$newpassword'
      				 WHERE user_id='$userid'";
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


?>
<html>
  <head>
  </head>
  <body>
  	<div align=center>
  	 <form name=formsubmit method=post action=./do_chgpwd.php>
  	 	  <font face=Arial size=3 color=black><b>CHANGE PASSWORD SUKSES</b></font>
  	 	  <BR><BR>
  	 	  <A HREF=./index.php><font face=Arial size=3 color=black>Klik disini untuk coba LOGIN</font></A>
        <input type=hidden name=userid value=<? echo $userid; ?>>
        <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
     </form>
  	</div>
  </body>
</html>
<?
   require ("lib/close_con.php");
exit;
