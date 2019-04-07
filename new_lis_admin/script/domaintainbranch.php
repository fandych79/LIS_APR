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
   $newbranchid=$_POST['newbranchid'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   require ("../lib/open_con.php");
   require ("../lib/formatError.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_Branch
   					WHERE branch_code='$newbranchid'";
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
      $tsql = "DELETE FROM Tbl_Branch
      				WHERE branch_code='$newbranchid'
				DELETE FROM oto_branch_target
				WHERE branchid='$newbranchid'
				DELETE FROM tbl_branch_target
				WHERE branchid='$newbranchid'
				";

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
			$logprogramcode = "AD080";
			$logproductcode = "";
			$logdesc = "DEL $newbranchid";
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
   $newbranchid=$_POST['newbranchid'];
   $newbranchregion=$_POST['newbranchregion'];
   $newbranchname=$_POST['newbranchname'];
   $newbranchaddr=$_POST['newbranchaddr'];
   $newbranchnominal=$_POST['newbranchnominal'];
   $newbranchapp=$_POST['newbranchapp'];
   $newbranchcity=$_POST['newbranchcity'];
   $newbranchzip=$_POST['newbranchzip'];
   $newbranchorg=$_POST['newbranchorg'];
   $newbranchbudget=$_POST['newbranchbudget'];

   
   
	require ("../lib/open_con.php");
	require ("../lib/formatError.php");
   
   
	$rowcount=0;
   
	$tsql = "SELECT COUNT(*) as b FROM oto_branch_target WHERE branchid='$newbranchid'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlConn))
	{
		$rowCount = sqlsrv_num_rows($sqlConn);
		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
		{
			$rowcount = $row['b'];
		}
	}
	sqlsrv_free_stmt( $sqlConn );

   
	if($rowcount>0)
	{
		$tsql="update oto_branch_target set app_target='".$newbranchapp."', nominal_target='".$newbranchnominal."' where branchid='".$newbranchid."'";
	}
	else
	{
		$tsql="insert into oto_branch_target(branchid,nominal_target,app_target) values('".$newbranchid."','".$newbranchnominal."','".$newbranchapp."')";
	}
	$params = array(&$_POST['query']);
	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
	if(!$stmt )
	{
		echo "Error in preparing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	if(!sqlsrv_execute( $stmt))
	{
		echo "Error in executing statement.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	sqlsrv_free_stmt( $stmt);
	
   
   
   
   
   

   $tsql = "SELECT COUNT(*) as b FROM Tbl_Branch
   					WHERE branch_code='$newbranchid'";
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
			$logdesc = "UPD $newbranchid //" . $actionhistory;
   }
   else
   {
			$logdesc = "ADD $newbranchid //" . $actionhistory;
   }
   if ($act == "del")
   {
			$logdesc = "DEL $newbranchid";
   }

   $tsql = "SELECT COUNT(*) as b FROM OTO_Tbl_Branch
   					WHERE branch_code='$newbranchid'
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
	/*
      $tsql = "UPDATE OTO_Tbl_Branch SET system_desc='$logdesc',
      				branch_name='$newbranchname',
      				branch_region_code='$newbranchregion', branch_address='$newbranchaddr',
      				branch_city='$newbranchcity',branch_postal_code='$newbranchzip',
      				branch_chart='$newbranchorg', branch_budget='$newbranchbudget',
      				branch_flag_bi='$newbranchflagbi',branch_flag_apr='$newbranchflagapr',
      				branch_flag_leg='$newbranchflagleg',branch_flag_dd='$newbranchflagdd',
      				branch_flag_cap='$newbranchflagcap',branch_flag_c0='$newbranchflagco'
      				WHERE branch_code='$newbranchid'";
	*/
	
	 $tsql = "UPDATE OTO_Tbl_Branch SET system_desc='$logdesc',
      				branch_name='$newbranchname',
      				branch_region_code='$newbranchregion', branch_address='$newbranchaddr',
      				branch_city='$newbranchcity',branch_postal_code='$newbranchzip',
      				branch_chart='$newbranchorg', branch_budget='$newbranchbudget'
      				WHERE branch_code='$newbranchid'";
   }
   else
   {
      $tsql = "INSERT INTO OTO_Tbl_Branch VALUES('$userid',convert(varchar,getdate(),121),'$logdesc',
      					'$newbranchid','$newbranchname','$newbranchregion','$newbranchaddr',
      				 '$newbranchcity','$newbranchzip','$userid',getdate(),'bbbbb','Y',
      				 '$newbranchorg','$newbranchbudget')";
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
			$logprogramcode = "AD080";
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
   require ("../lib/formatError.php");
   
   
   //echo $_POST['paramfield'];
   

   
   
   
   
   
   
   
   
   
   $tsqlawal = "SELECT *
   					 FROM OTO_Tbl_Branch
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
   			$newbranchid=$rowawal[3];
   			$newbranchregion=$rowawal[5];
   			$newbranchname=$rowawal[4];
   			$newbranchaddr=$rowawal[6];
   			$newbranchcity=$rowawal[7];
   			$newbranchzip=$rowawal[8];
   			$newbranchuser=$rowawal[9];
   			$newbranchflags=$rowawal[11];
   			$newbranchactive=$rowawal[12];
   			$newbranchorg=$rowawal[13];
   			$newbranchbudget=$rowawal[14];
			/*
   			$newbranchflagbi=$rowawal[15];
   			$newbranchflagapr=$rowawal[16];
   			$newbranchflagleg=$rowawal[17];
   			$newbranchflagdd=$rowawal[18];
   			$newbranchflagcap=$rowawal[19];
   			$newbranchflagco=$rowawal[20];
			*/

			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
      	 $vartemp = "D" . $systemuserid . $newbranchid;
      	 $varvalue = "";
      	 if (isset($_POST[$vartemp]))
      	 {
  			    $varvalue=$_POST[$vartemp];
  			 }
  			 if ($varvalue == "Y")
  			 {
			 
				
				
				$newbranchnominal=0;	
				$newbranchapp=0;	
				$tsql = "SELECT * FROM oto_branch_target WHERE branchid='$newbranchid'";
				$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
				$params = array(&$_POST['query']);
				$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($sqlConn))
				{
				$rowCount = sqlsrv_num_rows($sqlConn);
				while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
					{
						$newbranchnominal=$row['nominal_target'];
						$newbranchapp=$row['app_target'];
					}
				}
				sqlsrv_free_stmt( $sqlConn );
			   
			   
			   
			   
			   
			   
			   
			   
				$tsql = "SELECT COUNT(*) as b FROM tbl_branch_target WHERE branchid='$newbranchid'";
				$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
				$params = array(&$_POST['query']);
				$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
				if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
				if(sqlsrv_has_rows($sqlConn))
				{
					$rowCount = sqlsrv_num_rows($sqlConn);
					while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
					{
						$rowcount = $row['b'];
					}
				}
				sqlsrv_free_stmt( $sqlConn );

			   
				if($rowcount>0)
				{
					$tsql="update tbl_branch_target set app_target='".$newbranchapp."', nominal_target='".$newbranchnominal."' where branchid='".$newbranchid."'";
				}
				else
				{
					$tsql="insert into tbl_branch_target(branchid,nominal_target,app_target) values('".$newbranchid."','".$newbranchnominal."','".$newbranchapp."')";
				}
				
				$params = array(&$_POST['query']);
				$stmt = sqlsrv_prepare( $conn, $tsql, $params);
				if(!$stmt )
				{
					echo "Error in preparing statement.\n";
					die( print_r( sqlsrv_errors(), true));
				}
				if(!sqlsrv_execute( $stmt))
				{
					echo "Error in executing statement.\n";
					die( print_r( sqlsrv_errors(), true));
				}
				sqlsrv_free_stmt( $stmt);
			 
			 
			 
			 
			 
			 
			 
			 
   					$tsql = "SELECT COUNT(*) as b FROM Tbl_Branch
   										WHERE branch_code='$newbranchid'";
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
						/*
      					$tsql = "UPDATE Tbl_Branch SET branch_name='$newbranchname',
      							branch_region_code='$newbranchregion', branch_address='$newbranchaddr',
      							branch_city='$newbranchcity',branch_postal_code='$newbranchzip',
      							branch_chart='$newbranchorg', branch_budget='$newbranchbudget',
      							branch_flag_bi='$newbranchflagbi',branch_flag_apr='$newbranchflagapr',
      							branch_flag_leg='$newbranchflagleg',branch_flag_dd='$newbranchflagdd',
      							branch_flag_cap='$newbranchflagcap',
								branch_flag_co='$newbranchflagco',
      							branch_flag='$newbranchflags',
      							branch_active='$newbranchactive'
      							WHERE branch_code='$newbranchid'";
								
								*/
								
								$tsql = "UPDATE Tbl_Branch SET branch_name='$newbranchname',
      							branch_region_code='$newbranchregion', branch_address='$newbranchaddr',
      							branch_city='$newbranchcity',branch_postal_code='$newbranchzip',
      							branch_chart='$newbranchorg', branch_budget='$newbranchbudget',
      							branch_flag='$newbranchflags',
      							branch_active='$newbranchactive'
      							WHERE branch_code='$newbranchid'";
   					}
   					else
   					{
						/*
      					$tsql = "INSERT INTO Tbl_Branch VALUES('$newbranchid','$newbranchname','$newbranchregion','$newbranchaddr',
      				 			'$newbranchcity','$newbranchzip','$newbranchuser',getdate(),'$newbranchflags','$newbranchactive',
      				 			'$newbranchorg','$newbranchbudget','$newbranchflagbi','$newbranchflagapr',
      				 			'$newbranchflagleg','$newbranchflagdd','$newbranchflagcap','$newbranchflagco')";
						*/
						$tsql = "INSERT INTO Tbl_Branch VALUES('$newbranchid','$newbranchname','$newbranchregion','$newbranchaddr',
      				 			'$newbranchcity','$newbranchzip','$newbranchuser',getdate(),'$newbranchflags','$newbranchactive',
      				 			'$newbranchorg','$newbranchbudget')";
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
      				$tsql = "DELETE FROM Tbl_Branch
      									WHERE branch_code='$newbranchid'";

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
						$logprogramcode = "AD085";
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

      			$tsql = "DELETE FROM OTO_Tbl_Branch
      							WHERE branch_code='$newbranchid'
      							AND system_userid='$systemuserid'
								
						delete from oto_branch_target where branchid='".$newbranchid."'
								";
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
				
				
				
				
				
				$strsql = "delete from tbl_branchcluster where branch='".$newbranchid."'
				INSERT INTO tbl_branchcluster
				(branch,flowcode,branchto,method,flag)
				SELECT branch,flowcode,branchto,method,flag
				FROM tbl_branchcluster_oto where branch='".$newbranchid."' and flag<> '3'
				
				update tbl_branchcluster set flag='0' where branch='".$newbranchid."'
				delete from tbl_branchcluster_oto where branch='".$newbranchid."'
				";
				//$strsql = "delete from tbl_branchcluster where flowcode='".$flowde."' and branch='".$newbranchid."'";

				
				
				$params = array(&$_POST['query']);
				$stmt = sqlsrv_prepare( $conn, $strsql, $params);
				if(!$stmt ){
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
				}
				if(!sqlsrv_execute( $stmt)){
				echo "Error in executing statement.\n";
				die( print_r( sqlsrv_errors(), true));
				}
				sqlsrv_free_stmt( $stmt);
				
				
  			 }
      }
   }
   sqlsrv_free_stmt( $sqlConnawal );
   
   

   
  
   

   

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
   $newbranchid=$_POST['newbranchid'];
   $newbranchregion=$_POST['newbranchregion'];
   $newbranchname=$_POST['newbranchname'];
   $newbranchaddr=$_POST['newbranchaddr'];
   $newbranchcity=$_POST['newbranchcity'];
   $newbranchzip=$_POST['newbranchzip'];
   $newbranchorg=$_POST['newbranchorg'];
   $newbranchbudget=$_POST['newbranchbudget'];
   $newbranchflagbi=$_POST['newbranchflagbi'];
   $newbranchflagapr=$_POST['newbranchflagapr'];
   $newbranchflagleg=$_POST['newbranchflagleg'];
   $newbranchflagdd=$_POST['newbranchflagdd'];
   $newbranchflagcap=$_POST['newbranchflagcap'];

   require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_Branch
   					WHERE branch_code='$newbranchid'";
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
      $tsql = "UPDATE Tbl_Branch SET branch_name='$newbranchname',
      				branch_region_code='$newbranchregion', branch_address='$newbranchaddr',
      				branch_city='$newbranchcity',branch_postal_code='$newbranchzip',
      				branch_chart='$newbranchorg', branch_budget='$newbranchbudget'
      				WHERE branch_code='$newbranchid'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_Branch VALUES('$newbranchid','$newbranchname','$newbranchregion','$newbranchaddr',
      				 '$newbranchcity','$newbranchzip','TONO','2011-09-09 12:00:00','bbbbb','Y',
      				 '$newbranchorg','$newbranchbudget')";
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
			$logprogramcode = "AD080";
			$logproductcode = "";
			$logdesc = "CHG $newbranchid";
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
     	   	       <A HREF="javascript:changeMenu('../maintainbranch.php')"><font face=Arial size=2>Back To Maintain Branch</font></A>
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
