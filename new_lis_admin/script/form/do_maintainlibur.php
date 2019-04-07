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
   if ($act == "del")
   {
      SAVETABLE();
   }


function DELTABLE()
{
   $newuserid=$_POST['newuserid'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_User
   					WHERE user_id='$newuserid'";
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
      $tsql = "DELETE FROM Tbl_SE_User
      				WHERE user_id='$newuserid'";

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

      $tsql = "DELETE FROM Tbl_SE_AdminProgram
      				WHERE user_id='$newuserid'";

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
			$logprogramcode = "AD010";
			$logproductcode = "";
			$logdesc = "DEL $newuserid";
			$logaction = "";
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
   }

   EDITTABLE();

exit;
}

function SAVETABLE()
{
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
   $thn1=$_POST['thn1'];
   $actionhistory=$_POST['actionhistory'];
  global $act;
  global $userprogramcode;
  
   require ("../lib/open_con.php");

      								$tsql = "DELETE FROM TblHariLibur 
      												WHERE libur_year='$thn1'";
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
   
   for ($i=1;$i<=12;$i++)
   {
   	  for($k=1;$k<=31;$k++)
   	  {
			  					if ($i<10)
			  					{
			  						$vari = "0" . $i;
			  					}
			  					else
			  					{
			  						$vari = $i;
			  					}
			  					if ($k<10)
			  					{
			  						$vark = "0" . $k;
			  					}
			  					else
			  					{
			  						$vark = $k;
			  					}
   	  	
			  					$liburtanggal = $thn1 . "-" . $vari . "-" . $vark;
   	  						$vartemp = "D" . $thn1 . $vari . $vark;
   	  						if (isset($_POST[$vartemp]))
   	  						{
      	 						$rowcount = 0;
   									$tsql = "SELECT COUNT(*) as b FROM TblHariLibur
   														WHERE libur_year='$thn1'
   														AND libur_tanggal='$liburtanggal'";
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
      								$tsql = "INSERT INTO TblHariLibur VALUES('$thn1','$liburtanggal')";
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
   }

   
	 $logdesc = "UPD TblLibur //" . $actionhistory;

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
   	      			<font face=Arial size=2>Data sudah masuk</font><BR>
     	   	       <A HREF="javascript:changeMenu('../maintainlibur.php')"><font face=Arial size=2>Back To Maintain Libur</font></A>
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

function OTOSAVETABLE()
{
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
	global $userprogramcode;
//  $thedata=$_POST['thedata'];

   require ("../lib/open_con.php");
   
   $tsqlawal = "SELECT *
   					 FROM OTO_Tbl_SE_User
   					 WHERE SUBSTRING(user_id,1,5)='admin'
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
   			$newuserpwd=$rowawal[12];
   			$newusername=$rowawal[4];
   			$newuseremail=$rowawal[11];
   			$newuserhp=$rowawal[7];
   			$newuserbranch=$rowawal[10];
   			$newuserproc=$rowawal[9];
   			$newuserlevel=$rowawal[6];
   			$varreturn=$rowawal[22];
   			$newuserlimit=0;
   			$newuserprofile="ADM";
   			$newuserpicture="";
   			$newuseraocode="";
   			$newusertrustee="";
   			$newuserother="";
   			$newusertrustee="";
   			$newuserother="";
   			$newuserchild="";

      	 $vartemp = "D" . $systemuserid . $newuserid;
      	 $varvalue = "";
      	 if (isset($_POST[$vartemp]))
      	 {
  			    $varvalue=$_POST[$vartemp];
  			 }
  			 if ($varvalue == "Y")
  			 {
   					$tsql = "SELECT COUNT(*) as b FROM Tbl_SE_User
   										WHERE user_id='$newuserid'";
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
      					$tsql = "UPDATE Tbl_SE_User SET user_name='$newusername',
      									user_profile_code='$newuserprofile',
      									user_pwd='$newuserpwd', user_email='$newuseremail',
      									user_key_number='$newuserhp',user_branch_code='$newuserbranch',
      									user_level_code='$newuserlevel', user_proc_code='$newuserproc',
      									user_limit_money='$newuserlimit', user_status='0',
      									user_picture='$newuserpicture',
      									user_ao_code='$newuseraocode', user_child='$newuserchild'
      									WHERE user_id='$newuserid'";
   					}
   					else
   					{
      					$tsql = "INSERT INTO Tbl_SE_User VALUES('$newuserid','$newusername','0','$newuserlevel','$newuserhp',
					      				  '$newuserprofile','$newuserproc','$newuserbranch','$newuseremail','$newuserpwd','1','1','bbbbb',
      				  					'2011-09-09 12:00:00','Y','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild')";
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

      			$tsql = "DELETE FROM Tbl_SE_AdminProgram
      							WHERE user_id='$newuserid'";

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
    				$dataall=explode("|",$varreturn);
    				$countdataall = 0;
   					foreach ($dataall as $t)
						{
			 				$countdataall++;
    				}
    				for ($i=0;$i<$countdataall-1;$i++)
    				{
         			$tsql = "INSERT INTO Tbl_SE_AdminProgram values('$newuserid','$dataall[$i]',
         								'')";
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
      			
      			if (substr($systemdesc,1-1,3) == "DEL")
      			{
				      $tsql = "DELETE FROM Tbl_SE_User
      								WHERE user_id='$newuserid'";

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

      				$tsql = "DELETE FROM Tbl_SE_AdminProgram
				      				WHERE user_id='$newuserid'";

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

      			$tsql = "DELETE FROM OTO_Tbl_SE_User
      							WHERE user_id='$newuserid'
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

function TRUESAVETABLE()
{
   $newuserid=$_POST['newuserid'];
   $newuserpwd=$_POST['newuserpwd'];
   $newusername=$_POST['newusername'];
   $newuseremail=$_POST['newuseremail'];
   $newuserhp=$_POST['newuserhp'];
   $newuserbranch=$_POST['newuserbranch'];
   $newuserproc=$_POST['newuserproc'];
   $newuserlevel=$_POST['newuserlevel'];
   $varreturn=$_POST['varreturn'];
   $actionhistory=$_POST['actionhistory'];
   $newuserlimit=0;
   $newuserprofile="ADM";
   $newuserpicture="";
   $newuseraocode="";
   $newusertrustee="";
   $newuserother="";
   $newusertrustee="";
   $newuserother="";
   $newuserchild="";
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  
  if ($newuserlimit == "")
  {
  	$newuserlimit = 0;
  }

   require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_User
   					WHERE user_id='$newuserid'";
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
      $tsql = "UPDATE Tbl_SE_User SET user_name='$newusername',
      				user_profile_code='$newuserprofile',
      				user_pwd='$newuserpwd', user_email='$newuseremail',
      				user_key_number='$newuserhp',user_branch_code='$newuserbranch',
      				user_level_code='$newuserlevel', user_proc_code='$newuserproc',
      				user_limit_money='$newuserlimit', user_status='0',
      				user_picture='$newuserpicture',
      				user_ao_code='$newuseraocode', user_child='$newuserchild'
      				WHERE user_id='$newuserid'";
			$logdesc = "UPD $newuserid //" . $actionhistory;
   }
   else
   {
      $tsql = "INSERT INTO Tbl_SE_User VALUES('$newuserid','$newusername','0','$newuserlevel','$newuserhp',
      				  '$newuserprofile','$newuserproc','$newuserbranch','$newuseremail','$newuserpwd','1','1','bbbbb',
      				  '2011-09-09 12:00:00','Y','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild')";
			$logdesc = "ADD $newuserid //" . $actionhistory;
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

      $tsql = "DELETE FROM Tbl_SE_AdminProgram
      				WHERE user_id='$newuserid'";

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
    $dataall=explode("|",$varreturn);
    $countdataall = 0;
   	foreach ($dataall as $t)
		{
			 $countdataall++;
    }
    for ($i=0;$i<$countdataall-1;$i++)
    {
    	$vartemp = "A" . $dataall[$i];
      $vartemp=$_POST[$vartemp];
         $tsql = "INSERT INTO Tbl_SE_AdminProgram values('$newuserid','$dataall[$i]',
         					'')";
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

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD010";
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
     	   	       <A HREF="javascript:changeMenu('../maintainadmin.php')"><font face=Arial size=2>Back To Maintain User</font></A>
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

