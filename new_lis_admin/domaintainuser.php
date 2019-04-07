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
   $newuserid=$_POST['newuserid'];

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

   EDITTABLE();

exit;
}

function SAVETABLE()
{
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
   $newuseraocode=$_POST['newuseraocode'];
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newusertrustee=$_POST['newusertrustee'];
   $newuserother=$_POST['newuserother'];
   $newuserchild=$_POST['newuserchild'];

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
echo "test";
   
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
				//echo $tsql;
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
     	   	       <A HREF="./maintainuser.php"><font face=Arial size=2>Back To Maintain User</font></A>
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
