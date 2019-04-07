<?php

  $act=$_POST['act'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramcode=$_POST['userprogramcode'];

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
   if ($act == "otosave")
   {
      OTOSAVETABLE();
   }

function SAVETABLE()
{
   $actionhistory=$_POST['actionhistory'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  global $act;
  global $userprogramcode;

   require ("../lib/open_con.php");

			$logdesc = "UPD MS_CONTROLS //" . $actionhistory;

   $tsql = "SELECT COUNT(*) as b FROM OTO_MS_Control
   					WHERE control_code='$userid'
   					AND system_userid='$userid'";
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
      $tsql = "UPDATE OTO_MS_Control SET system_desc='$logdesc',
      				control_code='$userid'
      				WHERE control_code='$userid'
   					AND system_userid='$userid'";
   }
   else
   {
      $tsql = "INSERT INTO OTO_MS_Control VALUES('$userid',convert(varchar,getdate(),121),'$logdesc',
      					'$userid','','')";
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

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = $userprogramcode;
			$logproductcode = "";
			$logaction = "I";
      $tsql = "INSERT INTO Tbl_SE_UserLog VALUES('$loguserid',getdate(), '$logipaddr',
      			   '$logprogramcode','$logproductcode','$logdesc','$logaction')";
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

function OTOSAVETABLE()
{
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
	global $userprogramcode;
//  $thedata=$_POST['thedata'];

   require ("../lib/open_con.php");
   
   $tsqlawal = "SELECT *
   					 FROM OTO_MS_Control
   					ORDER BY system_time";
   $cursorTypeawal = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $paramsawal = array(&$_POST['query']);

   $sqlConnawal = sqlsrv_query($conn, $tsqlawal, $paramsawal, $cursorTypeawal);

   if ( $sqlConnawal === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConnawal))
   {
      $rowCountawal = sqlsrv_num_rows($sqlConnawal);
      while( $rowawal = sqlsrv_fetch_array( $sqlConnawal, SQLSRV_FETCH_NUMERIC))
      {
   			$systemuserid=$rowawal[0];
   			$systemdesc=$rowawal[2];
   			$newuserid=$rowawal[3];

      	 $vartemp = "D" . $systemuserid . $newuserid;
      	 $varvalue = "";
      	 if (isset($_POST[$vartemp]))
      	 {
  			    $varvalue=$_POST[$vartemp];
  			 }
  			 if ($varvalue == "Y")
  			 {
        		$arrdesc=explode("//",$systemdesc);

						$tsql_update = "";
						$tsql = "select * from ms_control";
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
        				for ($zz=1;$zz<count($arrdesc)-1;$zz++)
        				{
        			 		$arrket=explode(" : ",$arrdesc[$zz]);
        			 		$arrvalue=explode(" >> ",$arrket[1]);
									if ($row[1] == $arrket[0])
									{
										$tsql_update = "UPDATE MS_Control set control_value='$arrvalue[1]' where control_code = '$row[0]'";
										$params_update = array(&$_POST['query']);
										$stmt_update = sqlsrv_prepare( $conn, $tsql_update, $params_update);
										if( $stmt_update )
										{
										} 
										else
										{
											echo "Error in preparing statement.\n";
											die( print_r( sqlsrv_errors(), true));
										}
		
										if( sqlsrv_execute( $stmt_update ))
										{
										}
										else	
										{
											echo "Error in executing statement.\n";
											die( print_r( sqlsrv_errors(), true));
										}
										sqlsrv_free_stmt( $stmt_update);
									}
        				}
							}
						}
						sqlsrv_free_stmt( $sqlConn );

						$loguserid = $userid;
						$logipaddr = $_SERVER['REMOTE_ADDR'];
						$logprogramcode = $userprogramcode;
						$logproductcode = "";
						$logdesc = "OTO " .  $systemdesc;
						$logaction = "A";
      			$tsql = "INSERT INTO Tbl_SE_UserLog VALUES('$loguserid',getdate(), '$logipaddr',
      			   			'$logprogramcode','$logproductcode','$logdesc','$logaction')";
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

      			$tsql = "DELETE FROM OTO_MS_Control
      							WHERE control_code='$newuserid'
      							AND system_userid='$systemuserid'";
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
   }
   sqlsrv_free_stmt( $sqlConnawal );
   


   require ("../lib/open_con.php");

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
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
   	      			<font face=Arial size=2>Anda telah melakukan Otorisasi Parameter</font><BR>
     	   	       <A HREF="javascript:changeMenu('../../menu.php')"><font face=Arial size=2>Back To Main</font></A>
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
   	      			<font face=Arial size=2>Data sudah masuk, namun masih harus diotorisasi oleh yang berwenang</font><BR>
     	   	       <A HREF="javascript:changeMenu('../settingcontrols.php')"><font face=Arial size=2>Back To Setting Conttols</font></A>
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

