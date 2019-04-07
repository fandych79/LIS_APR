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
   $newprofileid=$_POST['newprofileid'];   
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Profile
   					WHERE profile_code='$newprofileid'";
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
      $tsql = "DELETE FROM Tbl_SE_Profile
      				WHERE profile_code='$newprofileid'";

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
			$logprogramcode = "AD060";
			$logproductcode = "";
			$logdesc = "DEL $newprofileid";
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
  global $act;
   $actionhistory=$_POST['actionhistory'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
   $newprofileid=$_POST['newprofileid'];
   $newprofilename=$_POST['newprofilename'];
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newprofiledesc = $newusertrustee . "|" . $newuserother;

   require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Profile
   					WHERE profile_code='$newprofileid'";
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
			$logdesc = "UPD $newprofileid //" . $actionhistory;
   }
   else
   {
			$logdesc = "ADD $newprofileid //" . $actionhistory;
   }
   if ($act == "del")
   {
			$logdesc = "DEL $newprofileid";
   }

   $tsql = "SELECT COUNT(*) as b FROM OTO_Tbl_SE_Profile
   					WHERE profile_code='$newprofileid'
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
      $tsql = "UPDATE OTO_Tbl_SE_Profile SET system_desc='$logdesc',
      				profile_name='$newprofilename',
      				profile_program_code='$newprofiledesc'
      				WHERE profile_code='$newprofileid'
      				AND system_userid='$userid'";
   }
   else
   {
      $tsql = "INSERT INTO OTO_Tbl_SE_Profile VALUES('$userid',convert(varchar,getdate(),121),'$logdesc',
      					'$newprofileid','$newprofilename','$newprofiledesc')";
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
			$logprogramcode = "AD060";
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
//  $thedata=$_POST['thedata'];

   require ("../lib/open_con.php");
   
   $tsqlawal = "SELECT *
   					 FROM OTO_Tbl_SE_Profile
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
   			$newprofileid=$rowawal[3];
   			$newprofilename=$rowawal[4];
   			$newprofiledesc = $rowawal[5];
       	$arrtemp=explode("|",$newprofiledesc);
   			$newusertrustee=$arrtemp[0];
   			$newuserother=$arrtemp[1];

      	 $vartemp = "D" . $systemuserid . $newprofileid;
      	 $varvalue = "";
      	 if (isset($_POST[$vartemp]))
      	 {
  			    $varvalue=$_POST[$vartemp];
  			 }
  			 if ($varvalue == "Y")
  			 {
   					$tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Profile
   								WHERE profile_code='$newprofileid'";

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
      					$tsql = "UPDATE Tbl_SE_Profile SET profile_name='$newprofilename',
      							profile_program_code='$newprofiledesc'
      							WHERE profile_code='$newprofileid'";
   					}
   					else
   					{
      					$tsql = "INSERT INTO Tbl_SE_Profile VALUES('$newprofileid','$newprofilename','$newprofiledesc')";
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

   					$tsql = "SELECT user_id as b FROM Tbl_SE_User
   										WHERE user_profile_code='$newprofileid'";
   					$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   					$params = array(&$_POST['query']);

   					$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   					if ( $sqlConn === false)
      					die( FormatErrors( sqlsrv_errors() ) );

   					$newuserid = "";
   					if(sqlsrv_has_rows($sqlConn))
   					{
      					$rowCount = sqlsrv_num_rows($sqlConn);
      					while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      					{
      	 					$newuserid = $row['b'];
         					$tsqlstmt = "DELETE FROM Tbl_SE_UserProgram
      				   					WHERE user_id='$newuserid'";
         					$params = array(&$_POST['query']);

         					$stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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

       						$dataall=explode("~",$newusertrustee);
       						$countdataall = 0;
   	   						foreach ($dataall as $t)
		   						{
			    						$countdataall++;
       						}
       						for ($i=0;$i<$countdataall-1;$i++)
       						{
         						$dataproc=explode(":",$dataall[$i]);
         						$datatrus=explode(",",$dataproc[2]);

         						$counttrus = 0;
   	     						foreach ($datatrus as $t)
		     						{
			      					$counttrus++;
         						}

         						for ($j=0;$j<$counttrus-1;$j++)
         						{
            					$dataperm=explode("/",$datatrus[$j]);
            					$tsqlstmt = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataperm[0]',
         										'$dataperm[1]')";
            					$params = array(&$_POST['query']);

		            			$stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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

       					$dataall=explode("~",$newuserother);
       					$countdataall = 0;
   	   					foreach ($dataall as $t)
		   					{
			    				$countdataall++;
       					}
       					for ($i=0;$i<$countdataall-1;$i++)
       					{
         					$dataproc=explode(":",$dataall[$i]);
         					$datatrus=explode(",",$dataproc[2]);

         					$counttrus = 0;
   	     					foreach ($datatrus as $t)
		     					{
			      					$counttrus++;
         					}

         					for ($j=0;$j<$counttrus-1;$j++)
         					{
            				$tsqlstmt = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$datatrus[$j]',
         												'00')";
            				$params = array(&$_POST['query']);

            				$stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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
   					sqlsrv_free_stmt( $sqlConn );

      			
      			if (substr($systemdesc,1-1,3) == "DEL")
      			{
      				$tsql = "DELETE FROM Tbl_SE_Profile
      									WHERE profile_code='$newprofileid'";

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
						$logprogramcode = "AD065";
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

      			$tsql = "DELETE FROM OTO_Tbl_SE_Profile
      							WHERE profile_code='$newprofileid'
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
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
   $newprofileid=$_POST['newprofileid'];
   $newprofilename=$_POST['newprofilename'];
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newprofiledesc = $newusertrustee . "|" . $newuserother;

   require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Profile
   					WHERE profile_code='$newprofileid'";
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
      $tsql = "UPDATE Tbl_SE_Profile SET profile_name='$newprofilename',
      				profile_program_code='$newprofiledesc'
      				WHERE profile_code='$newprofileid'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_SE_Profile VALUES('$newprofileid','$newprofilename','$newprofiledesc')";
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

   $tsql = "SELECT user_id as b FROM Tbl_SE_User
   					WHERE user_profile_code='$newprofileid'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   $newuserid = "";
   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      {
      	 $newuserid = $row['b'];
         $tsqlstmt = "DELETE FROM Tbl_SE_UserProgram
      				   WHERE user_id='$newuserid'";
         $params = array(&$_POST['query']);

         $stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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

       $dataall=explode("~",$newusertrustee);
       $countdataall = 0;
   	   foreach ($dataall as $t)
		   {
			    $countdataall++;
       }
       for ($i=0;$i<$countdataall-1;$i++)
       {
         $dataproc=explode(":",$dataall[$i]);
         $datatrus=explode(",",$dataproc[2]);

         $counttrus = 0;
   	     foreach ($datatrus as $t)
		     {
			      $counttrus++;
         }

         for ($j=0;$j<$counttrus-1;$j++)
         {
            $dataperm=explode("/",$datatrus[$j]);
            $tsqlstmt = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataperm[0]',
         					'$dataperm[1]')";
            $params = array(&$_POST['query']);

            $stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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

       $dataall=explode("~",$newuserother);
       $countdataall = 0;
   	   foreach ($dataall as $t)
		   {
			    $countdataall++;
       }
       for ($i=0;$i<$countdataall-1;$i++)
       {
         $dataproc=explode(":",$dataall[$i]);
         $datatrus=explode(",",$dataproc[2]);

         $counttrus = 0;
   	     foreach ($datatrus as $t)
		     {
			      $counttrus++;
         }

         for ($j=0;$j<$counttrus-1;$j++)
         {
/*         	  if ($datatrus[$j] == "TCE")
         	  {
  						$arrflow = "LKC,ITC,ASP,COL,NPF,AKU,MKK,DOS";
      				$dataflow=explode(",",$arrflow);
      				$countdataflow = 0;
   	  				foreach ($dataflow as $t)
		  				{
         				$countdataflow++;
      				}
      				for ($ki=0;$ki<$countdataflow;$ki++)
      				{
            	   $tsqlstmt = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataflow[$ki]',
         									'00')";
            	   $params = array(&$_POST['query']);

            		$stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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
         	  }*/

            $tsqlstmt = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$datatrus[$j]',
         					'00')";
            $params = array(&$_POST['query']);

            $stmt = sqlsrv_prepare( $conn, $tsqlstmt, $params);
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
   sqlsrv_free_stmt( $sqlConn );

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD060";
			$logproductcode = "";
			$logdesc = "CHG $newprofileid";
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
   	      			<font face=Arial size=2>Data sudah masuk, namun masih harus diotorisasi oleh yang berwenang</font><BR>
     	   	       <A HREF="javascript:changeMenu('../maintainprofile.php')"><font face=Arial size=2>Back To Maintain Profile</font></A>
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
