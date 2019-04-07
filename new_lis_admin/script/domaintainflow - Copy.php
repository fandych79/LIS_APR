<?php

  $act=$_POST['act'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramcode=$_POST['userprogramcode'];


   require ("../lib/open_con.php");
  include ("../lib/formatError.php");

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
      SAVETABLE();
   }
   if ($act == "otosave")
   {
      OTOSAVETABLE();
   }
   if ($act == "otodel")
   {
      OTODELTABLE();
   }

function OTODELTABLE()
{
   $newwfid=$_POST['newwfid'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_Workflow
   					WHERE wf_id='$newwfid'";
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
      $tsql = "DELETE FROM Tbl_Workflow
      				WHERE wf_id='$newwfid'";

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

      $tsql = "DELETE FROM Tbl_WorkflowDoc
      				WHERE wf_id='$newwfid'";

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

   $tsql = "SELECT COUNT(*) as b FROM Tbl_PrevFlow
   					WHERE flow='$newwfid'";
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
      $tsql = "DELETE FROM Tbl_PrevFlow
      				WHERE flow='$newwfid'";

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

   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Program
   					WHERE program_code='$newwfid'";
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
      $tsql = "DELETE FROM Tbl_SE_Program
   					   WHERE program_code='$newwfid'";

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
			$logprogramcode = "AD040";
			$logproductcode = "";
			$logdesc = "DEL $newwfid";
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
     	   	       <A HREF="javascript:changeMenu('../maintainflow.php')"><font face=Arial size=2>Back To Maintain Workflow</font></A>
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


function SAVETABLE()
{
   $actionhistory=$_POST['actionhistory'];
   $newwfdoc=$_POST['newwfdoc'];
   $newwfid=$_POST['newwfid'];
   $newwfname=$_POST['newwfname'];
   $newwfurut=$_POST['newwfurut'];
   $newwftime=$_POST['newwftime'];
   $newwfscore=$_POST['newwfscore'];
   $newwfflag1=$_POST['newwfflag1'];
   $newwfflag2=$_POST['newwfflag2'];
   $newwfflag3=$_POST['newwfflag3'];
   $newwfflag4=$_POST['newwfflag4'];
   $newwfflag5=$_POST['newwfflag5'];
   $newproccode=$_POST['newproccode'];
   $newprevflow=$_POST['newprevflow'];
   $newparamdoc=$_POST['newparamdoc'];
   $newnextflow=$_POST['newnextflow'];
   $desc=$_POST['desc_e'];
   $newrulesflow=$_POST['newrulesflow'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  global $act;
  global $userprogramcode;

   $wfactI = "";
   $wfactC = "";
   $wfactA = "";
   if (isset($_POST['wfactI']))
   {
      $wfactI=$_POST['wfactI'];
   }
   if (isset($_POST['wfactC']))
   {
      $wfactC=$_POST['wfactC'];
   }
   if (isset($_POST['wfactA']))
   {
      $wfactA=$_POST['wfactA'];
   }
   
   $newwfact = "";
   if ($wfactI == "Y")
   {
   	 $newwfact .= "I";
   }
   if ($wfactC == "Y")
   {
   	 $newwfact .= "C";
   }
   if ($wfactA == "Y")
   {
   	 $newwfact .= "A";
   }
   
   $newwfflag = $newwfflag1 . $newwfflag2 . $newwfflag3 . $newwfflag4 . $newwfflag5;

   require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_Workflow
   					WHERE wf_id='$newwfid'";
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
			$logdesc = "UPD $newwfid //" . $actionhistory;
   }
   else
   {
			$logdesc = "ADD $newwfid //" . $actionhistory;
   }
   if ($act == "del")
   {
			$logdesc = "DEL $newwfid";
   }

   $tsql = "SELECT COUNT(*) as b FROM OTO_Tbl_Workflow
   					WHERE wf_id='$newwfid'
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
      $tsql = "UPDATE OTO_Tbl_Workflow SET system_desc='$logdesc',
      				wf_name='$newwfname',
      				wf_urut='$newwfurut', wf_time='$newwftime',
      				wf_score='$newwfscore', wf_action='$newwfact',
      				wf_flag='$newwfflag', wf_proc_code='$newproccode',
      				wf_doc='$newwfdoc',
      				wf_prevflow='$newprevflow',
      				wf_nextflow='$newnextflow',
      				wf_rulesflow='$newrulesflow',
					wf_paramdoc='$newparamdoc',
					wf_desc='$desc'
      				WHERE wf_id='$newwfid'
      				AND system_userid='$userid'";
   }
   else
   {
      $tsql = "INSERT INTO OTO_Tbl_Workflow VALUES('$userid',convert(varchar,getdate(),121),'$logdesc','$newwfid','$newwfname','$newwfurut','$newwftime',
      				  '$newwfscore','$newwfact','$newproccode','$newwfflag','$newwfdoc','$newprevflow','$newnextflow','$newrulesflow','$newparamdoc','$desc')";
   }
//echo $tsql;
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
   	      			<font face=Arial size=2>Data sudah masuk, namun masih harus diotorisasi oleh yang berwenang</font><BR>
     	   	       <A HREF="javascript:changeMenu('../maintainflow.php')"><font face=Arial size=2>Back To Maintain Workflow</font></A>
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
   					 FROM OTO_Tbl_Workflow
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
   			$newwfid=$rowawal[3];
   			$newwfname=$rowawal[4];
   			$newwfurut=$rowawal[5];
   			$newwftime=$rowawal[6];
   			$newwfscore=$rowawal[7];
   			$newwfact=$rowawal[8];
   			$newproccode=$rowawal[9];
   			$newwfflag=$rowawal[10];
   			$newwfdoc=$rowawal[11];
   			$newprevflow=$rowawal[12];
   			$newnextflow=$rowawal[13];
   			$newrulesflow=$rowawal[14];
   			$wf_paramdoc=$rowawal[15];
   			$desc=$rowawal[16];
			
		
			
			
			$tsql = "UPDATE tbl_docparamworkflow
			SET  flag='0' where wf_id='$newwfid' and flag <> '3'
			delete from tbl_docparamworkflow where flag='3'
			";
			//echo $tsql;
			$params = array(&$_POST['query']);
			$stmt = sqlsrv_prepare( $conn, $tsql, $params);
			if( !$stmt )
			{
			echo "Error in preparing statement.\n";
			die( print_r( sqlsrv_errors(), true));
			}
			if( !sqlsrv_execute( $stmt))
			{
			echo "Error in executing statement.\n";
			die( print_r( sqlsrv_errors(), true));
			}
				
			
			
			
			
      	 $vartemp = "D" . $systemuserid . $newwfid;
      	 $varvalue = "";
      	 if (isset($_POST[$vartemp]))
      	 {
  			    $varvalue=$_POST[$vartemp];
  			 }
  			 if ($varvalue == "Y")
  			 {
  			 	  $thecount = 0;
   			  	$tsql2 = "SELECT COUNT(*)
						        FROM Tbl_Workflow
						        WHERE wf_id='$newwfid'";
          	$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  	$params2 = array(&$_POST['query']);

   		    	$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          	if ( $sqlConn2 === false)
      				die( FormatErrors( sqlsrv_errors() ) );

   			  	if(sqlsrv_has_rows($sqlConn2))
   			  	{
      		   	$rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 	while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   	{
      		   		$thecount = $row2[0];
      		   	}
   					}
   	      	sqlsrv_free_stmt( $sqlConn2 );

   					if ($thecount > 0)
   					{
      				$tsql = "UPDATE Tbl_Workflow SET wf_name='$newwfname',
      								wf_urut='$newwfurut', wf_time='$newwftime',
      								wf_score='$newwfscore', wf_action='$newwfact',
      								wf_flag='$newwfflag', wf_proc_code='$newproccode',wf_desc='$desc'
      								WHERE wf_id='$newwfid'";
   					}
   					else
   					{
      					$tsql = "INSERT INTO Tbl_Workflow VALUES('$newwfid','$newwfname','$newwfurut','$newwftime','$newwfscore','$newwfact','$newproccode','$newwfflag','$desc')";
   					}

      			$params = array(&$_POST['query']);
      			$stmt = sqlsrv_prepare( $conn, $tsql, $params);
      			if(!$stmt )
      			{
         			echo "Error in preparing statement.\n";
         			die( print_r( sqlsrv_errors(), true));
      			}
      			if( !sqlsrv_execute( $stmt))
      			{
        			echo "Error in executing statement.\n";
        			die( print_r( sqlsrv_errors(), true));
      			}
      			sqlsrv_free_stmt( $stmt);

   					$tsql = "SELECT COUNT(*) as b FROM Tbl_WorkflowDoc
   										WHERE wf_id='$newwfid'";
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
      					$tsql = "UPDATE Tbl_WorkflowDoc SET wf_doc='$newwfdoc'
      									WHERE wf_id='$newwfid'";
   					}
   					else
   					{
      					$tsql = "INSERT INTO Tbl_WorkflowDoc VALUES('$newwfid','$newwfdoc')";
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

   					$tsql = "SELECT COUNT(*) as b FROM Tbl_PrevFlow
   										WHERE flow='$newwfid'";
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
      					$tsql = "UPDATE Tbl_PrevFlow SET prev='$newprevflow',
      									Next='$newnextflow',Rules='$newrulesflow'
      								WHERE flow='$newwfid'";
   					}
	   				else
   					{
      					$tsql = "INSERT INTO Tbl_PrevFlow VALUES('$newwfid','$newprevflow','$newnextflow','$newrulesflow')";
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

   					$tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Program
   										WHERE program_code='$newwfid'";
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
      					$tsql = "UPDATE Tbl_SE_Program SET program_time='$newwftime',
      			  					program_score='$newwfscore', program_action='$newwfact',
      			  					program_flag='$newwfflag', program_name='$newwfname',
												program_urut='$newwfurut', program_group='$newproccode',
												program_helpdoc='WRK'
      									WHERE program_code='$newwfid'";
   					}
   					else
   					{
   	  					$newprogramdesc = "F" . $newwfid;
   	  					$newprogramdesc = "FLOW";
      					$tsql = "INSERT INTO Tbl_SE_Program VALUES('$newwfid','$newwfname','1.0.0','$newproccode',
      			             '$newwfurut','$newprogramdesc','WRK','$newwfflag','Y','admin','2011-09-09 12:00:00',
      			   						'$newwftime','$newwfscore','$newwfact')";
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
      			
      			if (substr($systemdesc,1-1,3) == "DEL")
      			{
      				$tsql = "DELETE FROM Tbl_WorkflowDoc
      							WHERE wf_id='$newwfid'";
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

      				$tsql = "DELETE FROM Tbl_PrevFLow
      							WHERE flow='$newwfid'";
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

      				$tsql = "DELETE FROM Tbl_SE_Program
      							WHERE program_code='$newwfid'";
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

      				$tsql = "DELETE FROM Tbl_Workflow
      							WHERE wf_id='$newwfid'";
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

      			$tsql = "DELETE FROM OTO_Tbl_Workflow
      							WHERE wf_id='$newwfid'
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
   $newwfid=$_POST['newwfid'];
   $newwfname=$_POST['newwfname'];
   $newwfurut=$_POST['newwfurut'];
   $newwftime=$_POST['newwftime'];
   $newwfscore=$_POST['newwfscore'];
   $newwfflag1=$_POST['newwfflag1'];
   $newwfflag2=$_POST['newwfflag2'];
   $newwfflag3=$_POST['newwfflag3'];
   $newwfflag4=$_POST['newwfflag4'];
   $newwfflag5=$_POST['newwfflag5'];
   $newproccode=$_POST['newproccode'];
   $newprevflow=$_POST['newprevflow'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   $wfactI = "";
   $wfactC = "";
   $wfactA = "";
   if (isset($_POST['wfactI']))
   {
      $wfactI=$_POST['wfactI'];
   }
   if (isset($_POST['wfactC']))
   {
      $wfactC=$_POST['wfactC'];
   }
   if (isset($_POST['wfactA']))
   {
      $wfactA=$_POST['wfactA'];
   }
   
   $newwfact = "";
   if ($wfactI == "Y")
   {
   	 $newwfact .= "I";
   }
   if ($wfactC == "Y")
   {
   	 $newwfact .= "C";
   }
   if ($wfactA == "Y")
   {
   	 $newwfact .= "A";
   }
   
   $newwfflag = $newwfflag1 . $newwfflag2 . $newwfflag3 . $newwfflag4 . $newwfflag5;

   require ("../lib/open_con.php");

   $tsql = "SELECT COUNT(*) as b FROM Tbl_Workflow
   					WHERE wf_id='$newwfid'";
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
      $tsql = "UPDATE Tbl_Workflow SET wf_name='$newwfname',
      				wf_urut='$newwfurut', wf_time='$newwftime',
      				wf_score='$newwfscore', wf_action='$newwfact',
      				wf_flag='$newwfflag', wf_proc_code='$newproccode'
      				WHERE wf_id='$newwfid'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_Workflow VALUES('$newwfid','$newwfname','$newwfurut','$newwftime',
      				  '$newwfscore','$newwfact','$newproccode','$newwfflag')";
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

   $tsql = "SELECT * FROM Tbl_DocPerson";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);

   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

   if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
  		$newwfdoc = "";
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      {
      	$vartemp = "DOC" . $row['doc_id'];
      	if (isset($_POST[$vartemp]))
      	{
  		     $varvalue=$_POST[$vartemp];
  		    if ($varvalue == "Y")
  		    {
  		  	  $newwfdoc .= $row['doc_id'] . "|";
  		    }      	
      	}
      	else
      	{
      	}
      }
   }
   sqlsrv_free_stmt( $sqlConn );

   $tsql = "SELECT COUNT(*) as b FROM Tbl_WorkflowDoc
   					WHERE wf_id='$newwfid'";
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
      $tsql = "UPDATE Tbl_WorkflowDoc SET wf_doc='$newwfdoc'
      				WHERE wf_id='$newwfid'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_WorkflowDoc VALUES('$newwfid','$newwfdoc')";
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

   $tsql = "SELECT COUNT(*) as b FROM Tbl_PrevFlow
   					WHERE flow='$newwfid'";
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
      $tsql = "UPDATE Tbl_PrevFlow SET prev='$newprevflow'
      				WHERE flow='$newwfid'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_PrevFlow VALUES('$newwfid','$newprevflow')";
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


   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Program
   					WHERE program_code='$newwfid'";
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
      $tsql = "UPDATE Tbl_SE_Program SET program_time='$newwftime',
      			  program_score='$newwfscore', program_action='$newwfact',
      			  program_flag='$newwfflag', program_name='$newwfname',
							program_urut='$newwfurut', program_group='$newproccode',
							program_helpdoc='WRK'
      				WHERE program_code='$newwfid'";
   }
   else
   {
   	  $newprogramdesc = "F" . $newwfid;
      $tsql = "INSERT INTO Tbl_SE_Program VALUES('$newwfid','$newwfname','1.0.0','$newproccode',
      			   '$newwfurut','$newprogramdesc','WRK','$newwfflag','Y','admin','2011-09-09 12:00:00',
      			   '$newwftime','$newwfscore','$newwfact')";
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
			$logprogramcode = "AD040";
			$logproductcode = "";
			$logdesc = "CHG $newwfid";
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
     	   	       <A HREF="javascript:changeMenu('../maintainflow.php')"><font face=Arial size=2>Back To Maintain Workflow</font></A>
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
