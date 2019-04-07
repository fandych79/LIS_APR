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
   if ($act == "del")
   {
      DELTABLE();
   }
   if ($act == "otosave")
   {
      OTOSAVETABLE();
   }

   if ($act == "reset")
   {
      RESETTABLE();
   }

   if ($act == "nyangkut")
   {
      SIGNINTABLE();
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

      //update table security
      	require ("../lib/open_con_security.php");

      	$tsql = "DELETE FROM se_user
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
      //end table security

	  //update table appraisal
	    require ("../lib/open_con_appraisal.php");

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
	  //end table appraisal

	  require ("../lib/open_con.php");

      $tsql = "DELETE FROM Tbl_SE_UserProgram
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
			$logprogramcode = "AD050";
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

function RESETTABLE()
{
   $newuserid=$_POST['newuserid'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   require ("../lib/open_con.php");

      $tsql = "UPDATE Tbl_SE_User set user_status = '0' WHERE user_id = '$newuserid'";

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

      //update table security
      	require ("../lib/open_con_security.php");

      	$tsql = "UPDATE se_user set user_status = '0' WHERE user_id = '$newuserid'";

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
      //end table security

	  //update table appraisal
	      require ("../lib/open_con_appraisal.php");

	      $tsql = "UPDATE Tbl_SE_User set user_status = '0' WHERE user_id = '$newuserid'";

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
	  //end appraisal

	    require ("../lib/open_con.php");

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD050";
			$logproductcode = "";
			$logdesc = "RST $newuserid";
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

function SIGNINTABLE()
{
   $newuserid=$_POST['newuserid'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   require ("../lib/open_con.php");

      $tsql = "UPDATE Tbl_SE_User set user_signin = '0' WHERE user_id = '$newuserid'";

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

      //update security
      	require ("../lib/open_con_security.php");

      	$tsql = "UPDATE se_user set user_signin = '0' WHERE user_id = '$newuserid'";

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
      //end security

      //update appraisal
	    require ("../lib/open_con_appraisal.php");

      	$tsql = "UPDATE Tbl_SE_User set user_signin = '0' WHERE user_id = '$newuserid'";

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
      //end appraisal

	      require ("../lib/open_con.php");

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD050";
			$logproductcode = "";
			$logdesc = "SGN $newuserid";
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

function SAVETABLE()
{
   $actionhistory=$_POST['actionhistory'];
   $newuserid=$_POST['newuserid'];
   $newuserpwd=$_POST['newuserpwd'];
   $newuserprofile=$_POST['newuserprofile'];
   $newusername=$_POST['newusername'];
   $newuseremail=$_POST['newuseremail'];
   $newuserhp=$_POST['newuserhp'];
   $newuserbranch=$_POST['newuserbranch'];
   $newuserproc=$_POST['newuserproc'];
   $value_proc_code=$_POST['check_proc_code'];
   $newuserlevel=$_POST['newuserlevel'];
   $newuserlimit=$_POST['newuserlimit'];
   $newuserpicture=$_POST['newuserpicture'];
   $newuseraocode=substr($_POST['newuseraocode'],0,3);
   $newuserchild=$_POST['newuserchild'];
   $newdownlinestatus=$_POST['newdownlinestatus'];
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newusertemp=$_POST['newusertemp'];
   $varreturn = $newusertrustee . "//" . $newuserother;
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  global $act;
  global $userprogramcode;
  $newflag = $newdownlinestatus . "bbbb";

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
			$logdesc = "UPD $newuserid //" . $actionhistory;
   }
   else
   {
			$logdesc = "ADD $newuserid //" . $actionhistory;
   }
   if ($act == "del")
   {
			$logdesc = "DEL $newuserid";
   }

   $tsql = "SELECT COUNT(*) as b FROM OTO_Tbl_SE_User
   					WHERE user_id='$newuserid'
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
      $tsql = "UPDATE OTO_Tbl_SE_User SET system_desc='$logdesc',
      				user_name='$newusername',
      				user_profile_code='$newuserprofile',
      				user_pwd='$newuserpwd', user_email='$newuseremail',
      				user_key_number='$newuserhp',user_branch_code='$newuserbranch',
      				user_level_code='$newuserlevel', user_proc_code='$value_proc_code',
      				user_limit_money='$newuserlimit', user_status='0',
      				user_picture='$newuserpicture',
      				user_ao_code='$newuseraocode', user_child='$newuserchild',
      				user_prog_code='$varreturn',
      				user_flag='$newflag'
      				WHERE user_id='$newuserid'";
			$logdesc = "UPD $newuserid //" . $actionhistory;
   }
   else
   {
      $tsql = "INSERT INTO OTO_Tbl_SE_User VALUES('$userid',convert(varchar,getdate(),121),'$logdesc',
      					'$newuserid','$newusername','0','$newuserlevel','$newuserhp',
      				  '$newuserprofile','$value_proc_code','$newuserbranch','$newuseremail','$newuserpwd','0','1','$newflag',
      				  '2011-09-09 12:00:00','$newusertemp','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild','$varreturn')";
			$logdesc = "ADD $newuserid //" . $actionhistory;
   }
   	//echo $tsql;exit;

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

    require ("../../sqlsrv.security.php");

    $db_security = new DB_SECURITY();
    $db_security->connect();
    
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
	global $userprogramcode;
  $thedata=$_POST['thedata'];
  $thedata = explode("|", $thedata);

   require ("../lib/open_con.php");

for($x=0;$x<count($thedata);$x++)
{
    $thedata[$x] = substr($thedata[$x], 5);

   $tsqlawal = "SELECT *
             FROM OTO_Tbl_SE_User
             WHERE SUBSTRING(user_id,1,5)<>'admin'
             AND user_id = '".$thedata[$x]."'
            ORDER BY system_time";
   $cursorTypeawal = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $paramsawal = array(&$_POST['query']);

   $sqlConnawal = sqlsrv_query($conn, $tsqlawal, $paramsawal, $cursorTypeawal);

   if ( $sqlConnawal === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConnawal))
   {
      $rowCountawal = sqlsrv_num_rows($sqlConnawal);
	  //echo $rowCountawal;
      while( $rowawal = sqlsrv_fetch_array( $sqlConnawal, SQLSRV_FETCH_NUMERIC))
      {
   			$systemuserid=$rowawal[0];
   			$systemdesc=$rowawal[2];
   			$newuserid=$rowawal[3];
   			$newuserpwd=$rowawal[12];
   			$newuserprofile=$rowawal[8];
   			$newusername=$rowawal[4];
   			$newuseremail=$rowawal[11];
   			$newuserhp=$rowawal[7];
   			$newuserbranch=$rowawal[10];
   			$newuserproc=$rowawal[9];
   			$newuserlevel=$rowawal[6];
   			$newuserlimit=$rowawal[18];
   			$newuserpicture=$rowawal[19];
   			$newuseraocode=$rowawal[20];
   			$newflag=$rowawal[15];
   			$newuserchild=$rowawal[21];
   			$varreturn=$rowawal[22];
  			$newusertemp=$rowawal[17];
  			$dataall=explode("//",$varreturn);
   			$newusertrustee=$dataall[0];
   			$newuserother=$dataall[1];

      	 $vartemp = "D" . $systemuserid . $newuserid;
      	 $varvalue = "";
      	 if (isset($_POST[$vartemp]))
      	 {
  			    $varvalue=$_POST[$vartemp];
  			 }
  			 if ($varvalue == "Y")
  			 {
            $rowCount = "";
            $rowCountSecurity = "";
   					$tsql = "SELECT user_id, user_pwd FROM Tbl_SE_User
					   					WHERE user_id='$newuserid'";
   					$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   					$params = array(&$_POST['query']);

   					$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   					if ( $sqlConn === false)
            {
      					die( FormatErrors( sqlsrv_errors() ) );
            }

   					if(sqlsrv_has_rows($sqlConn))
   					{
      					$rowCount = sqlsrv_num_rows($sqlConn);
      					while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      					{
      	 					$rowcount = $row['user_id'];
                  $oldpwd = $row['user_pwd'];
      					}
   					}
   					sqlsrv_free_stmt( $sqlConn );

            require ("../lib/open_con_security.php");

            $tsql = "SELECT user_id FROM se_user
                      WHERE user_id='$newuserid'";
            $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
            $params = array(&$_POST['query']);

            $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

            if ( $sqlConn === false)
            {
                die( FormatErrors( sqlsrv_errors() ) );
            }

            if(sqlsrv_has_rows($sqlConn))
            {
                $rowCountSecurity = sqlsrv_num_rows($sqlConn);
            }
            sqlsrv_free_stmt( $sqlConn );

            if ($rowcount != "")
            {
                  
                  if($oldpwd == $newuserpwd)
                  {
                    $hash_pwd = $newuserpwd;
                  }else{
                    $hash_pwd = md5($newuserpwd);
                  }

                  //update security

                	$tsql = "UPDATE se_user SET user_name='$newusername',
  					      				user_pwd='$hash_pwd', 
      										user_signin = '0',
      										user_active = '$newusertemp',
  					      				user_email='$newuseremail',
  					      				user_branch_code='$newuserbranch',
  					      				user_level_code='$newuserlevel', 
  					      				user_status='0'
  					      				WHERE user_id='$newuserid'";
                      //echo $tsql;exit;

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
                        //end security

			      		//update appraisal
			      		require ("../lib/open_con_appraisal.php");

                        	$tsql = "UPDATE Tbl_SE_User SET user_name='$newusername',
                									user_profile_code='$newuserprofile',
                									user_pwd='$hash_pwd', user_email='$newuseremail',
                									user_key_number='$newuserhp',user_branch_code='$newuserbranch',
                									user_level_code='$newuserlevel', user_proc_code='$newuserproc',
                									user_limit_money='$newuserlimit', user_status='0',
                									user_picture='$newuserpicture',
                									user_ao_code='$newuseraocode', user_child='$newuserchild',
                									user_flag='$newflag'
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
                        //end appraisal

      					$tsql = "UPDATE Tbl_SE_User SET user_name='$newusername',
      									user_profile_code='$newuserprofile',
      									user_pwd='$hash_pwd', user_email='$newuseremail',
      									user_key_number='$newuserhp',user_branch_code='$newuserbranch',
      									user_level_code='$newuserlevel', user_proc_code='$newuserproc',
      									user_limit_money='$newuserlimit', user_status='0',
      									user_picture='$newuserpicture',
      									user_ao_code='$newuseraocode', user_child='$newuserchild',
      									user_flag='$newflag'
      									WHERE user_id='$newuserid'";//echo $tsql;
            }
            else
            {
                        $hash_pwd = md5($newuserpwd);

                        //update appraisal
                require ("../lib/open_con_appraisal.php");

                  $tsql = "INSERT INTO Tbl_SE_User VALUES('$newuserid','$newusername','0','$newuserlevel','$newuserhp',
                  '$newuserprofile','$newuserproc','$newuserbranch','$newuseremail','$hash_pwd','0','0','$newflag',
                  getdate(),'Y','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild')";

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
                        //end appraisal

      					$tsql = "INSERT INTO Tbl_SE_User VALUES('$newuserid','$newusername','0','$newuserlevel','$newuserhp',
					      				  '$newuserprofile','$newuserproc','$newuserbranch','$newuseremail','$hash_pwd','0','0','$newflag',
      				  					getdate(),'Y','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild')";

                        //INSERT INTO SECURITY

                if($rowCountSecurity == "")
                {
                  $tsql_security = "
                                      INSERT INTO [dbo].[se_user]
                                      ([user_id]
                                      ,[user_pwd]
                                      ,[user_status]
                                      ,[user_active]
                                      ,[user_signin]
                                      ,[user_signin_time]
                                      ,[user_level_code]
                                      ,[user_name]
                                      ,[user_email]
                                      ,[user_branch_code])
                                      VALUES
                                      ('$newuserid'
                                      ,'$hash_pwd'
                                      ,'1'
                                      ,'$newusertemp'
                                      ,'0'
                                      ,'1'
                                      ,'1'
                                      ,'$newusername'
                                      ,'$newuseremail'
                                      ,'$newuserbranch')
                                      ";

                  $db_security->executeNonQuery($tsql_security);
                }

   					}

   				  require ("../lib/open_con.php");

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

      			$tsql = "DELETE FROM Tbl_SE_UserProgram
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
//         				$tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataperm[0]',
//         								'$dataperm[1]','$dataproc[0]','$dataproc[1]')";
         					$tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataperm[0]',
					         					'$dataperm[1]')";
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
//         				$tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$datatrus[$j]',
//         						'00','$dataproc[0]','$dataproc[1]')";
         					$tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$datatrus[$j]',
				         					'00')";
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

      			if (substr($systemdesc,1-1,3) == "DEL")
      			{
      				//delete security
      					require ("../lib/open_con_security.php");

      					$tsql = "DELETE FROM se_user
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
      				//end security

	      			//delete appraisal
	      				require ("../lib/open_con_appraisal.php");

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
      				//end appraisal

	      			require ("../lib/open_con.php");

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

      				$tsql = "DELETE FROM Tbl_SE_UserProgram
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
}



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
   $actionhistory=$_POST['actionhistory'];
   $newuserid=$_POST['newuserid'];
   $newuserpwd=$_POST['newuserpwd'];
   $newuserprofile=$_POST['newuserprofile'];
   $newusername=$_POST['newusername'];
   $newuseremail=$_POST['newuseremail'];
   $newuserhp=$_POST['newuserhp'];
   $newuserbranch=$_POST['newuserbranch'];
   $newuserproc=$_POST['newuserproc'];
   $newuserlevel=$_POST['newuserlevel'];
   $newuserlimit=$_POST['newuserlimit'];
   $newuserpicture=$_POST['newuserpicture'];
   $newuseraocode=substr($_POST['newuseraocode'],0,3);
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newuserchild=$_POST['newuserchild'];
   $newdownlinestatus=$_POST['newdownlinestatus'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $newflag = $newdownlinestatus . "bbbb";

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

   $hash_pwd = md5($newuserpwd);

   if ($rowcount > 0)
   {
   		//upadte security
   			require ("../lib/open_con_security.php");

	   		$tsql = "UPDATE se_user SET user_name='$newusername',
	      				user_pwd='$newuserpwd', 
	      				user_email='$newuseremail',
	      				user_branch_code='$newuserbranch',
	      				user_level_code='$newuserlevel', 
	      				user_status='0'
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
		//end security

		//upadte appraisal
			require ("../lib/open_con_appraisal.php");

	   		$tsql = "UPDATE Tbl_SE_User SET user_name='$newusername',
	      				user_profile_code='$newuserprofile',
	      				user_pwd='$newuserpwd', user_email='$newuseremail',
	      				user_key_number='$newuserhp',user_branch_code='$newuserbranch',
	      				user_level_code='$newuserlevel', user_proc_code='$newuserproc',
	      				user_limit_money='$newuserlimit', user_status='0',
	      				user_picture='$newuserpicture',
	      				user_ao_code='$newuseraocode', user_child='$newuserchild',
	      				user_flag='$newflag'
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
		//end appraisal


      $tsql = "UPDATE Tbl_SE_User SET user_name='$newusername',
      				user_profile_code='$newuserprofile',
      				user_pwd='$newuserpwd', user_email='$newuseremail',
      				user_key_number='$newuserhp',user_branch_code='$newuserbranch',
      				user_level_code='$newuserlevel', user_proc_code='$newuserproc',
      				user_limit_money='$newuserlimit', user_status='0',
      				user_picture='$newuserpicture',
      				user_ao_code='$newuseraocode', user_child='$newuserchild',
      				user_flag='$newflag'
      				WHERE user_id='$newuserid'";
			$logdesc = "UPD $newuserid //" . $actionhistory;
   }
   else
   {
   		//upadte security
   			require ("../lib/open_con_security.php");

	   		$tsql = "INSERT INTO se_user VALUES('$newuserid'
                        ,'$hash_pwd'
                        ,'1'
                        ,'1'
                        ,'1'
                        ,'1'
                        ,'1'
                        ,'$newusername'
                        ,'$newuseremail'
                        ,'$newuserbranch')";
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
		//end security

		//upadte appraisal
			require ("../lib/open_con_appraisal.php");

	   		$tsql = "INSERT INTO Tbl_SE_User VALUES('$newuserid','$newusername','0','$newuserlevel','$newuserhp',
      				  '$newuserprofile','$newuserproc','$newuserbranch','$newuseremail','$newuserpwd','0','0','$newflag',
      				  '2011-09-09 12:00:00','Y','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild')";
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
		//end appraisal

      $tsql = "INSERT INTO Tbl_SE_User VALUES('$newuserid','$newusername','0','$newuserlevel','$newuserhp',
      				  '$newuserprofile','$newuserproc','$newuserbranch','$newuseremail','$newuserpwd','0','0','$newflag',
      				  '2011-09-09 12:00:00','Y','$newuserlimit','$newuserpicture','$newuseraocode','$newuserchild')";
			$logdesc = "ADD $newuserid //" . $actionhistory;
   }

   	require ("../lib/open_con.php");

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

      $tsql = "DELETE FROM Tbl_SE_UserProgram
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
//         $tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataperm[0]',
//         					'$dataperm[1]','$dataproc[0]','$dataproc[1]')";
         $tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$dataperm[0]',
         					'$dataperm[1]')";
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
//         $tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$datatrus[$j]',
//         					'00','$dataproc[0]','$dataproc[1]')";
         $tsql = "INSERT INTO Tbl_SE_UserProgram values('$newuserid','$datatrus[$j]',
         					'00')";
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

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD050";
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
   	      			<font face=Arial size=2>Data sudah masuk, namun masih harus diotorisasi oleh yang berwenang</font><BR>
     	   	       <A HREF="javascript:changeMenu('../maintainuser.php')"><font face=Arial size=2>Back To Maintain User</font></A>
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
