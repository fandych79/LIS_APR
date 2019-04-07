<?php
include ("../../lib/formatError.php");
	$userid=$_GET['userid'];
  	$userpwd=$_GET['userpwd'];
  	$userbranch=$_GET['userbranch'];
  	$userregion=$_GET['userregion'];
  	$userwfid=$_GET['userwfid'];
	
//echo $userwfid;
	
	if(isset($userid) && isset($userpwd) && isset($userbranch) && isset($userregion) && isset($userwfid) )
	{
	}
	else
	{
		header("location:restricted.php");
	}
	
  	require ("../../lib/open_con.php");
  
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
   else
   {  	 
   
   $tsql = "SELECT COUNT(*) FROM Tbl_SE_UserProgram
   					WHERE user_id='$userid'
   					AND program_code='$userwfid'";
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
   		   $thecount = $row[0];
      }
   }
sqlsrv_free_stmt( $sqlConn );
   
   if ($thecount == 0)
   {
   	   header("location:restricted.php");
   }
   else
   {
   }   
   
	$tsql = "SELECT * FROM Tbl_SE_UserProgram WHERE user_id='$userid' AND program_code='$userwfid'";
   	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   $userpinp = "";
   $userpchk = "";
   $userpapr = "";
   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
	    if (substr($row[2],1-1,1) == "I")
		{
		   $userpinp = substr($row[2],1-1,1);
		}
	    if (substr($row[2],1-1,1) == "C")
		{
		   $userpchk = substr($row[2],1-1,1);
		}
	    if (substr($row[2],1-1,1) == "A")
		{
		   $userpapr = substr($row[2],1-1,1);
		}
	    if (substr($row[2],2-1,1) == "I")
		{
		   $userpinp = substr($row[2],2-1,1);
		}
	    if (substr($row[2],2-1,1) == "C")
		{
		   $userpchk = substr($row[2],2-1,1);
		}
	    if (substr($row[2],2-1,1) == "A")
		{
		   $userpapr = substr($row[2],2-1,1);
		}
	    if (substr($row[2],3-1,1) == "I")
		{
		   $userpinp = substr($row[2],3-1,1);
		}
	    if (substr($row[2],3-1,1) == "C")
		{
		   $userpchk = substr($row[2],3-1,1);
		}
	    if (substr($row[2],3-1,1) == "A")
		{
		   $userpapr = substr($row[2],3-1,1);
		}
		
		//echo $userpinp;
		//echo $userpchk;
		//echo $userpapr;
      }
   }
   sqlsrv_free_stmt( $sqlConn );   
   
   
	$tsql = "SELECT * FROM Tbl_SE_Program WHERE program_code='$userwfid'";
   	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	if ( $sqlConn === false)
      die( FormatErrors( sqlsrv_errors() ) );

   $ButtonAction = "";
   if(sqlsrv_has_rows($sqlConn))
   {
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {		
	  	//echo $row[13];
		$ButtonAction = $row[13];
      }
   }
   sqlsrv_free_stmt( $sqlConn );  

//END SECURITY

// BRANCH DETAIL
   $tsql = "SELECT branch_flag_bi, branch_flag_apr, branch_flag_leg, branch_flag_dd, branch_flag_cap
   					FROM Tbl_Branch
   					WHERE branch_code='$userbranch'";
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
   		   $branchflagbi = $row[0];
   		   $branchflagapf = $row[1];
   		   $branchflagleg = $row[2];
   		   $branchflagdd = $row[3];
		   $branchflagcap = $row[4];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
// END BRANCH


// PROFILE USER ID (AO / TL / PINCA)
   $tsql = "SELECT user_ao_code, user_level_code, user_child FROM Tbl_SE_User
   					WHERE user_id='$userid'";
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
   		   $profileaocode = $row[0];
   		   $profilelevelcode = $row[1];
   		   $profileuserchild = $row[2];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
// END PROFILE
   
   if ($profileaocode != "")
   {
   	   $kondisiexistingflow = "AND txn_user_id='$userid'";
   	   $kondisinextflow = "AND txn_user_id='$userid'";
   }
   else
   {
   	   $kondisinextflow = "AND txn_user_id='$userid'";
      if ($profileuserchild != "")
      {
      	$dataall=explode("|",$profileuserchild);
      	$countdataall = 0;
   	  	foreach ($dataall as $t)
		  	{
         	$countdataall++;
      	}
      	$kondisiexistingflow = "AND (txn_user_id='$userid' OR ";
   	  	for ($zz=0;$zz<$countdataall-1;$zz++)
		  	{
   			 	$kondisiexistingflow .= "txn_user_id='$dataall[$zz]' OR ";
      	}
      	if ($countdataall > 1)
      	{
	      	$kondisiexistingflow = substr($kondisiexistingflow,0,strlen($kondisiexistingflow)-4) . ")";
      	}
      }
      else
      {
   	      $kondisiexistingflow = "";
      }
   }

   //SELECT From Tbl_Workflow & PrevFlow
    $tsql = "select * from Tbl_Workflow where wf_id='$userwfid'";
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
   		   $wfname = $row[1];
   		   $wftime = $row[3];
   		   $wfscore = $row[4];
   		   $wfaction = $row[5];
   		   $wfflag = $row[7];
      }
   }
   sqlsrv_free_stmt( $sqlConn );


   // FLAG BI CHECK / APR / LEG / DD
   $kondisibranch = "";
   $kondisiflag5 = "";
   $aksesflag5 = "";
   $selectflag5 = "";
   /*
   switch (substr($wfflag,5-1,1))
   {
      // 0 = BI Check
   	  case "0" : 
   	  	$kondisiflag5  = "0"; 
   			$aksesflag5 = $branchflagbi;
   			$selectflag5 = "branch_flag_bi";
   	  	break;
      // 1 = APRAISAL Check
   	  case "1" : 
   	  	$kondisiflag5  = "1"; 
   			$aksesflag5 = $branchflagapr;
   			$selectflag5 = "branch_flag_apr";
   	  	break;
      // 2 = LEGAL
   	  case "2" : 
   	  	$kondisiflag5  = "2"; 
   			$aksesflag5 = $branchflagleg;
   			$selectflag5 = "branch_flag_leg";
   	  	break;
      // 3 = DRAWDAWN
   	  case "3" : 
   	  	$kondisiflag5  = "3"; 
   			$aksesflag5 = $branchflagdd;
   			$selectflag5 = "branch_flag_dd";
   	  	break;
   }

   if ($kondisibranch == "")
   {
   	  if ($userregion != $userbranch)
   	  {
   	  	if ($kondisiflag5 != "")
   	  	{
   	     $kondisibranch = "AND (txn_branch_code='$userbranch' or txn_region_code='$userregion' or txn_branch_code='888')";
   	     $kondisibranch = "AND (txn_branch_code='$userbranch' or txn_region_code='$userregion' or txn_branch_code='888'";

   	  	if ($kondisiflag5 != "")
   	  	{
//   			 $selectflag5 = "branch_flag_bi";
    		 $tsql = "select brancH_code from Tbl_Branch where $selectflag5='".$userbranch."'";
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
   		   		 $kondisibranch .= " or txn_branch_code='$row[0]' ";
      		 }
   			 }
   			 sqlsrv_free_stmt( $sqlConn );
   	  	}
   		   $kondisibranch .= ")";

   	    }
   	    else
   	    {
   	     $kondisibranch = "AND (txn_branch_code='$userbranch' or txn_region_code='$userregion' or txn_branch_code='888'";

//   			 $selectflag5 = "branch_flag_bi";
				  if ($selectflag5 != "")
				  {
    		 $tsql = "select branch_code from Tbl_Branch where $selecflag5='".$userbranch."'";
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
   		   		 $kondisibranch .= " or txn_branch_code='$row[0]' ";
      		 }
   			 }
   			 sqlsrv_free_stmt( $sqlConn );
				  }
   		   $kondisibranch .= ")";
   	    }

   	  }
   	  else
   	  {
   	     $kondisibranch = "AND (txn_branch_code='$userbranch' or txn_region_code='$userregion' or txn_branch_code='888' ";
//    		 $tsql = "select branch_code from Tbl_Branch where branch_region_code='".$userregion."'";
   	  	if ($kondisiflag5 != "")
   	  	{
    		 $tsql = "select branch_code from Tbl_Branch where $selectflag5='".$userregion."'";
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
   		   		 $kondisibranch .= " or txn_branch_code='$row[0]' ";
      		 }
   			 }
   			 sqlsrv_free_stmt( $sqlConn );
   	  	}
   		   $kondisibranch .= ")";

   	  }
   }
   // END FLAG BI CHECK / APR / LEG / DD
   */

    $tsql = "select * from Tbl_PrevFlow where flow='".$userwfid."'";
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
   		   $wfprevflow = $row[1];
      }
   }
   sqlsrv_free_stmt( $sqlConn );

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Expired" CONTENT="0">
<meta http-equiv="Cache-Control" CONTENT="no-Cache">
<meta http-equiv="Pragma" CONTENT="no-Cache">
<title>Flow</title>
<style type="text/css">
td,th 
{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
body
{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	background-repeat:repeat;
}
</style>
<Script Language="JavaScript">
        function newID()
        {
        	document.formsubmit.custnomid.value = "";
        	document.formsubmit.userpermission.value = "I";
        	document.formsubmit.action = "./form<? echo $userwfid; ?>.php";
        	document.formsubmit.submit();
        }
        function goFlow(theid,theact)
        {
        	document.formsubmit.custnomid.value = theid;
        	document.formsubmit.userpermission.value = theact;
        	document.formsubmit.action = "./form<? echo $userwfid; ?>.php";
        	document.formsubmit.submit();
        }
        function goApprove(theid,theact)
        {
					submitform = window.confirm("APPROVE ?")
					if (submitform == true)
					{
        		document.formsubmit.custnomid.value = theid;
        		document.formsubmit.userpermission.value = theact;
        		document.formsubmit.action = "./do_saveflowcsg.php";
        		document.formsubmit.submit();
						return true;
					}
        }
</Script>
</head>
<body link=blue vlink=blue alink=blue>
<div align="center">
<table width="800" border="1" cellpadding="10" cellspacing="0">
<tr>
  <td width=100% align=left valign=top>
  	<A HREF=./inquiryflow.php?userid=<? echo $userid; ?>&userpwd=<? echo $userpwd; ?>&userbranch=<? echo $userbranch; ?>&userregion=<? echo $userregion; ?>&userwfid=<? echo $userwfid; ?>>
  	  <center><? echo $wfname; ?></center>
  	</A>
	</td>
</tr>
<?
// Check First Flow
if ($wfprevflow == "000" && $profileaocode != "")
{
?>
<tr>
<td width=100% align=left valign=top><? echo $wfname; ?> is The First Flow, <A HREF="javascript:newID()">Click Here</A> if you want to Submit New Data</td>
</tr>
<?
}
?>
</table>
<form id="formsubmit" name="formsubmit" method="post" action="">
<table width="800" border="1" cellpadding="10" cellspacing="0">
  <tr bgcolor="#00B3FF"><font color="#FF0000">
    <th bordercolordark="#000000" bordercolorlight="#CCCCCC" width="10%"><center>ID</center></th>
    <th bordercolordark="#000000" bordercolorlight="#CCCCCC" width="20%"><center>CUSTOMER NAME</center></th>
    <th bordercolordark="#000000" bordercolorlight="#CCCCCC" width="10%"><center>DATE</center></th>
    <th bordercolordark="#000000" bordercolorlight="#CCCCCC" width="10%"><center>LAST ACT</center></th>
    <th bordercolordark="#000000" bordercolorlight="#CCCCCC" width="30%"><center>STATUS</center></th>
    <th bordercolordark="#000000" bordercolorlight="#CCCCCC" width="20%"><center>NEXT</center></th>
  </tr>
<?

//GET BRANCH CLUSTER TRIGGER ON or OFF ???
$theBranchCluster = "";
$tsql = "select * from tbl_branch where branch_flag_cap='$userbranch'";
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
		$theBranchCluster = $theBranchCluster." or txn_branch_code = '".$row['branch_code']."'";
	}
}
sqlsrv_free_stmt( $sqlConn );

// END GET CLUSTER TRIGGER

$kondisibranch = "AND (txn_branch_code='$userbranch' or txn_region_code='$userregion' or txn_branch_code='888' $theBranchCluster)";

//SELECT dari Tbl_ExistingFlow
$tsqlawal = "select txn_id, cast(txn_time as varchar), txn_action, txn_user_id,
     					datediff(minute,txn_time,getdate()), 
     					CONVERT(varchar,txn_time,121), CONVERT(varchar,getdate(),121),
     					datediff(day,txn_time,getdate())
				 from Tbl_F$userwfid 
				 where txn_action<>'A'
				 AND txn_action<>'J'
				 $kondisibranch
				 $kondisiexistingflow
				 ORDER BY txn_time DESC";				 
$cursorTypeawal = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$paramsawal = array(&$_POST['query']);
$sqlConnawal = sqlsrv_query($conn, $tsqlawal, $paramsawal, $cursorTypeawal);
if ( $sqlConnawal === false)
die( FormatErrors( sqlsrv_errors()));

if(sqlsrv_has_rows($sqlConnawal))
{
	$rowCountawal = sqlsrv_num_rows($sqlConnawal);
	$NaiRowColor="bgcolor=#FFFFCC";
	while( $rowawal = sqlsrv_fetch_array( $sqlConnawal, SQLSRV_FETCH_NUMERIC))
	{				
//        $hitmenit = $row[4];
// SLA
					$hitlibur = 9;
     			$tsqlsla = "select COUNT(*)
				 					from TblHariLibur
				 					where libur_tanggal>=SUBSTRING('$rowawal[5]',1,10) 
				 					and libur_tanggal <=SUBSTRING('$rowawal[6]',1,10)";
     			$cursorTypesla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     			$paramssla = array(&$_POST['query']);
     			$sqlConnsla = sqlsrv_query($conn, $tsqlsla, $paramssla, $cursorTypesla);
     			if ( $sqlConnsla === false)
       			die( FormatErrors( sqlsrv_errors()));

     			if(sqlsrv_has_rows($sqlConnsla))
     			{
	     			$rowCountsla = sqlsrv_num_rows($sqlConnsla);
	     			while( $rowsla = sqlsrv_fetch_array( $sqlConnsla, SQLSRV_FETCH_NUMERIC))
	     			{				
								$hitlibur = $rowsla[0];
			 			}
       			sqlsrv_free_stmt( $sqlConnsla );
	   			}

	   			$cekjamkerja = ($rowawal[7] - $hitlibur);

					$hitharipertama = 0;
					if (substr($rowawal[5],12-1,2) < 22)
					{
						$vartempjam = substr($rowawal[5],1-1,11) . "22:00:00";
     				$tsqlsla = "select datediff(minute,'$rowawal[5]','$vartempjam')";
     				$cursorTypesla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     				$paramssla = array(&$_POST['query']);
     				$sqlConnsla = sqlsrv_query($conn, $tsqlsla, $paramssla, $cursorTypesla);
     				if ( $sqlConnsla === false)
       				die( FormatErrors( sqlsrv_errors()));

     				if(sqlsrv_has_rows($sqlConnsla))
     				{
	     				$rowCountsla = sqlsrv_num_rows($sqlConnsla);
	     				while( $rowsla = sqlsrv_fetch_array( $sqlConnsla, SQLSRV_FETCH_NUMERIC))
	     				{				
								$hitharipertama = $rowsla[0];
			 				}
       				sqlsrv_free_stmt( $sqlConnsla );
	   				}
				  }

					$hithariakhir = 0;
					if (substr($rowawal[6],12-1,2) > 8)
					{
						$vartempjam = substr($rowawal[6],1-1,11) . "08:00:00";
     				$tsqlsla = "select datediff(minute,'$rowawal[6]','$vartempjam')";
     				$cursorTypesla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     				$paramssla = array(&$_POST['query']);
     				$sqlConnsla = sqlsrv_query($conn, $tsqlsla, $paramssla, $cursorTypesla);
     				if ( $sqlConnsla === false)
       				die( FormatErrors( sqlsrv_errors()));

     				if(sqlsrv_has_rows($sqlConnsla))
     				{
	     				$rowCountsla = sqlsrv_num_rows($sqlConnsla);
	     				while( $rowsla = sqlsrv_fetch_array( $sqlConnsla, SQLSRV_FETCH_NUMERIC))
	     				{				
								$hithariakhir = $rowsla[0];
			 				}
       				sqlsrv_free_stmt( $sqlConnsla );
	   				}
				  }
					
					$officehour = 60 * (22 - 8);
          $hitmenit = $rowawal[4] - ($hitlibur * $officehour) - ($cekjamkerja * $officehour) + $hitharipertama + $hithariakhir;
// END SLA
  			if ($hitmenit > $wftime)
  			{
  				$varwarning = "<img src=../../images/alert.black.gif> $hitmenit menit, time $wftime";
  		  }
  		  else
  			{
  				$varwarning = "$hitmenit menit";
  		  }



				//SELECT tbl Customer Master Person where id looping
				$tsqlCustName = "select custfullname,custbusname,custsex,
												 custaocode, custbranchcode
												 from Tbl_CustomerMasterPerson where custnomid = '".$rowawal[0]."'";
				//echo $tsqlCustName;
				$cursorTypeCustName = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
				$paramsCustName = array(&$_POST['query']);
				$sqlConnCustName = sqlsrv_query($conn, $tsqlCustName, $paramsCustName, $cursorTypeCustName);
				if ( $sqlConnCustName === false)
				die( FormatErrors( sqlsrv_errors()));
				if(sqlsrv_has_rows($sqlConnCustName))
				{
					$rowCountCustName = sqlsrv_num_rows($sqlConnCustName);
					while( $rowCustName = sqlsrv_fetch_array( $sqlConnCustName, SQLSRV_FETCH_NUMERIC))
					{
						if ($rowCustName[2] == "0")
						{
							$rowCustName[0] = $rowCustName[1];
						}
						//echo $rowCustName[0];						
						$TempStatusFlow=$rowawal[2];
						if($TempStatusFlow == "I")
						{
							$StatusFlow="Input by ".$rowawal[3];
							$LastAction="C";
						}
						else if($TempStatusFlow == "C")
						{
							$StatusFlow="Waiting for Approve. Last Input by ".$rowawal[3];
							$LastAction="A";
						}
						else if($TempStatusFlow == "A")
						{
							$StatusFlow="Has been Approved by ".$rowawal[3];
						}
						else
						{
						}

      	// Check Paralel and Non Paralel
  			$StatusFlow = "";
  			$hitparalel = 0;
  			$dataall=explode("|",$wfprevflow);
  			$countdataall = 0;
  			foreach ($dataall as $t)
				{
    			$countdataall++;
  			}
  			for ($i=0;$i<$countdataall;$i++)
  			{
  				$saklarcek = "";
     			$tsql = "select txn_id, txn_user_id
				 					from Tbl_F$dataall[$i] 
				 					where txn_action='A'
				 					and txn_id='$rowawal[0]'";
     			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     			$params = array(&$_POST['query']);
     			$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
     			if ( $sqlConn === false)
       			die( FormatErrors( sqlsrv_errors()));

     			if(sqlsrv_has_rows($sqlConn))
     			{
	     			$rowCount = sqlsrv_num_rows($sqlConn);
	     			while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	     			{				
		          $hitparalel++;
		          $saklarcek = $dataall[$i] . " Has been Approved by ".$row[1] . "<BR>";
			 			}
       			sqlsrv_free_stmt( $sqlConn );
	   			}
	   			if ($saklarcek == "")
	   			{
	   				$saklarcek = "$dataall[$i] <font color=red>NOT FINISH YET</font> <br>";
	   			}
				  $StatusFlow .= $saklarcek;
  			}
      	// End Check Paralel and Non Paralel
?>
  <tr>
    <td width="10%" <? echo $NaiRowColor; ?>><center><? echo $rowawal[0]; ?><BR>Branch : <? echo $rowCustName[4]; ?><BR>AO : <? echo $rowCustName[3]; ?></center></td>
    <td width="20%" <? echo $NaiRowColor; ?>><center><? echo $rowCustName[0]; ?></center><BR><? echo $varwarning; ?></td>
    <td width="10%" <? echo $NaiRowColor; ?>><center><? echo $rowawal[1]; ?></center></td>
    <td width="10%" <? echo $NaiRowColor; ?>><center><? echo $rowawal[2]; ?></center></td>
    <td width="30%" <? echo $NaiRowColor; ?>><? echo $StatusFlow; ?></td>
    <td width="20%" <? echo $NaiRowColor; ?>><center>
<?
    $readyA = "<center>-<center>";
    $readyI = "<center>-<center>";
    $readyC = "<center>-<center>";

	for($zz=0;$zz<strlen($wfaction);$zz++)
		{
			 $varsplit = substr($wfaction,$zz,1);
			 if ($varsplit == "I")
			 {
			 	   $varname = "Input / Update";
			 }
			 if ($varsplit == "C")
			 {
			 	   $varname = "Submit";
			 }
			 if ($varsplit == "A")
			 {
			 	   $varname = "Approve";
			 }
			 if ($aksesflag5 == "" || $aksesflag5 == $userbranch)
			 {
			 		if ($varsplit == $userpinp)
			 		{
          	$readyI = "<A HREF=\"javascript:goFlow('$rowawal[0]','$varsplit')\">" . $varname . "</A><BR>";
       		}
			 		if ($varsplit == $userpchk)
			 		{
          	$readyC = "<A HREF=\"javascript:goFlow('$rowawal[0]','$varsplit')\">" . $varname . "</A><BR>";
       		}
			 		if ($varsplit == $userpapr)
			 		{
          	$readyA = "<A HREF=\"javascript:goFlow('$rowawal[0]','$varsplit')\">" . $varname . "</A><BR>";
       		}
			 }
			 else
			 {
          	$readyI = "Owner : $aksesflag5";
          	$readyC = "Owner : $aksesflag5";
          	$readyA = "Owner : $aksesflag5";
			 }
	  }

  	   if ($hitparalel >= $countdataall)
  		 {  
	  		if ($LastAction == "A")
	  		{
	  	  	echo $readyA;
	  		}
	  		if ($LastAction == "C")
	  		{
	  	  		echo $readyI;
	  	  		echo $readyC;
	  		}
	     }
	     else
	     {
	     	   echo "Belum semua FLOW selesai";
	     }

?>
    </center></td>
  </tr>
<?
		if ($NaiRowColor == "bgcolor=#FFFFFF")
           {
             $NaiRowColor = "bgcolor=#FFFFFF";
           }
           else
           {
              $NaiRowColor = "bgcolor=#FFFFCC";
           }
					}
				}
				sqlsrv_free_stmt( $sqlConnCustName );	
	}
}
sqlsrv_free_stmt( $sqlConnawal );
//END SELECT dari Tbl_ExistingFlow


// SELECT dari Tbl_PrevFlow (Hanya berlaku jika bukan First Flow dan bukan flow bercabang)
if ($wfprevflow != "000" and substr($wfflag,4-1,1) != "I")
{
  $dataall=explode("|",$wfprevflow);
  $countdataall = 0;
  foreach ($dataall as $t)
	{
    $countdataall++;
  }
//				 			$kondisinextflow
//				 			$kondisiexistingflow
  $tsqlawal = "select txn_id, cast(txn_time as varchar), txn_action, txn_user_id,
     					datediff(minute,txn_time,getdate()), 
     					CONVERT(varchar,txn_time,121), CONVERT(varchar,getdate(),121),
     					datediff(day,txn_time,getdate())
				 			from Tbl_F$dataall[0] 
				 			where txn_action='A'
				 			$kondisibranch
				 			$kondisiexistingflow
				 			ORDER BY txn_time desc";
  $cursorTypeawal = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
  $paramsawal = array(&$_POST['query']);
  $sqlConnawal = sqlsrv_query($conn, $tsqlawal, $paramsawal, $cursorTypeawal);
  if ( $sqlConnawal === false)
       die( FormatErrors( sqlsrv_errors()));

  if(sqlsrv_has_rows($sqlConnawal))
  {
	  $rowCountawal = sqlsrv_num_rows($sqlConnawal);
	  while( $rowawal = sqlsrv_fetch_array( $sqlConnawal, SQLSRV_FETCH_NUMERIC))
	  {
	  	$sudahada	= "";
			$tsql = "select txn_id
				 			from Tbl_F$userwfid 
				 			where txn_id='$rowawal[0]'";
			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params = array(&$_POST['query']);
			$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
			if ( $sqlConn === false)
				die( FormatErrors( sqlsrv_errors()));

			if(sqlsrv_has_rows($sqlConn))
			{
				$rowCount = sqlsrv_num_rows($sqlConn);
				$NaiRowColor="bgcolor=#FFFC01";
				while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
				{
					$sudahada = $row[0];
				}
			}
			sqlsrv_free_stmt( $sqlConn );

		  if ($sudahada == "")
		  {
	    	$NaiRowColor="bgcolor=#FFFFFF";
  			$hitparalel = 0;
  			$validnomid = "";
  			$StatusFlow = "";
  			$varrow0 = "";
  			$varrow1 = "";
  			$varrow2 = "";
  			$hitmenit = "";
          		$validnomid = $rowawal[0];
//							$StatusFlow= $dataall[0] . " Has been Approved by ".$rowawal[3] . "<BR>";
          		$varrow0 = $rowawal[0];
          		$varrow1 = $rowawal[1];
          		$varrow2 = $rowawal[2];
//          		$hitmenit = $rowawal[4];
// SLA
					$hitlibur = 9;
     			$tsqlsla = "select COUNT(*)
				 					from TblHariLibur
				 					where libur_tanggal>=SUBSTRING('$rowawal[5]',1,10) 
				 					and libur_tanggal <=SUBSTRING('$rowawal[6]',1,10)";
     			$cursorTypesla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     			$paramssla = array(&$_POST['query']);
     			$sqlConnsla = sqlsrv_query($conn, $tsqlsla, $paramssla, $cursorTypesla);
     			if ( $sqlConnsla === false)
       			die( FormatErrors( sqlsrv_errors()));

     			if(sqlsrv_has_rows($sqlConnsla))
     			{
	     			$rowCountsla = sqlsrv_num_rows($sqlConnsla);
	     			while( $rowsla = sqlsrv_fetch_array( $sqlConnsla, SQLSRV_FETCH_NUMERIC))
	     			{				
								$hitlibur = $rowsla[0];
			 			}
       			sqlsrv_free_stmt( $sqlConnsla );
	   			}

	   			$cekjamkerja = ($rowawal[7] - $hitlibur);

					$hitharipertama = 0;
					if (substr($rowawal[5],12-1,2) < 22)
					{
						$vartempjam = substr($rowawal[5],1-1,11) . "22:00:00";
     				$tsqlsla = "select datediff(minute,'$rowawal[5]','$vartempjam')";
     				$cursorTypesla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     				$paramssla = array(&$_POST['query']);
     				$sqlConnsla = sqlsrv_query($conn, $tsqlsla, $paramssla, $cursorTypesla);
     				if ( $sqlConnsla === false)
       				die( FormatErrors( sqlsrv_errors()));

     				if(sqlsrv_has_rows($sqlConnsla))
     				{
	     				$rowCountsla = sqlsrv_num_rows($sqlConnsla);
	     				while( $rowsla = sqlsrv_fetch_array( $sqlConnsla, SQLSRV_FETCH_NUMERIC))
	     				{				
								$hitharipertama = $rowsla[0];
			 				}
       				sqlsrv_free_stmt( $sqlConnsla );
	   				}
				  }

					$hithariakhir = 0;
					if (substr($rowawal[6],12-1,2) > 8)
					{
						$vartempjam = substr($rowawal[6],1-1,11) . "08:00:00";
     				$tsqlsla = "select datediff(minute,'$rowawal[6]','$vartempjam')";
     				$cursorTypesla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     				$paramssla = array(&$_POST['query']);
     				$sqlConnsla = sqlsrv_query($conn, $tsqlsla, $paramssla, $cursorTypesla);
     				if ( $sqlConnsla === false)
       				die( FormatErrors( sqlsrv_errors()));

     				if(sqlsrv_has_rows($sqlConnsla))
     				{
	     				$rowCountsla = sqlsrv_num_rows($sqlConnsla);
	     				while( $rowsla = sqlsrv_fetch_array( $sqlConnsla, SQLSRV_FETCH_NUMERIC))
	     				{				
								$hithariakhir = $rowsla[0];
			 				}
       				sqlsrv_free_stmt( $sqlConnsla );
	   				}
				  }
					
					$officehour = 60 * (22 - 8);
          $hitmenit = $rowawal[4] - ($hitlibur * $officehour) - ($cekjamkerja * $officehour) + $hitharipertama + $hithariakhir;
// END SLA
      	// Check Paralel and Non Paralel
  			for ($i=0;$i<$countdataall;$i++)
  			{
  				$saklarcek = "";
     			$tsql = "select txn_id
				 					from Tbl_F$dataall[$i] 
				 					where txn_action='A'
				 					and txn_id='$rowawal[0]'";
     			$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     			$params = array(&$_POST['query']);
     			$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
     			if ( $sqlConn === false)
       			die( FormatErrors( sqlsrv_errors()));

     			if(sqlsrv_has_rows($sqlConn))
     			{
	     			$rowCount = sqlsrv_num_rows($sqlConn);
	     			while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	     			{				
		          $hitparalel++;
		          $saklarcek = $dataall[0] . " Has been Approved by ".$rowawal[3] . "<BR>";
			 			}
       			sqlsrv_free_stmt( $sqlConn );
	   			}
	   			if ($saklarcek == "")
	   			{
	   				$saklarcek = "$dataall[$i] <font color=red>NOT FINISH YET</font> <br>";
	   			}
				  $StatusFlow .= $saklarcek;
  			}
      	// End Check Paralel and Non Paralel

  				if ($hitmenit > $wftime)
  				{
  					$varwarning = "<img src=../../images/alert.black.gif> $hitmenit menit, time $wftime";
  		  	}
  		  	else
  				{
  				$varwarning = "$hitmenit menit";
  		  	}
					//SELECT tbl Customer Master Person where id looping
					$tsqlCustName = "select custfullname,custbusname,custsex,
													 custaocode, custbranchcode
													 from Tbl_CustomerMasterPerson where custnomid = '".$validnomid."'";
					//echo $tsqlCustName;
					$cursorTypeCustName = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$paramsCustName = array(&$_POST['query']);
					$sqlConnCustName = sqlsrv_query($conn, $tsqlCustName, $paramsCustName, $cursorTypeCustName);
					if ( $sqlConnCustName === false)
						die( FormatErrors( sqlsrv_errors()));
					if(sqlsrv_has_rows($sqlConnCustName))
					{
						$rowCountCustName = sqlsrv_num_rows($sqlConnCustName);
						while( $rowCustName = sqlsrv_fetch_array( $sqlConnCustName, SQLSRV_FETCH_NUMERIC))
						{
						  if ($rowCustName[2] == "0")
						  {
							  $rowCustName[0] = $rowCustName[1];
						  }
							//echo $rowCustName[0];						
							$TempStatusFlow=$row[2];
							if($TempStatusFlow == "A")
							{
								$LastAction="I";
							}
						  if ($userpinp == "I")
						  {
?>
  <tr>
    <td width="10%" <? echo $NaiRowColor; ?>><center><? echo $varrow0; ?><BR>Branch : <? echo $rowCustName[4]; ?><BR>AO : <? echo $rowCustName[3]; ?></center></td>
    <td width="20%" <? echo $NaiRowColor; ?>><center><? echo $rowCustName[0]; ?></center><BR><? echo $varwarning; ?></td>
    <td width="10%" <? echo $NaiRowColor; ?>><center><? echo $varrow1; ?></center></td>
    <td width="10%" <? echo $NaiRowColor; ?>><center><? echo $varrow2; ?></center></td>
<?
		if ($userwfid == "CSG")
		{
?>
    	<td width="30%" <? echo $NaiRowColor; ?>><? echo $StatusFlow; ?><BR><A HREF="javascript:goApprove('<? echo $varrow0; ?>','I')">Approve Flow</A> (lakukan ini jika sudah PRINT)</td>
<?
		}
		else
		{
?>
    	<td width="30%" <? echo $NaiRowColor; ?>><? echo $StatusFlow; ?></td>
<?
		}
?>
    <td width="20%" <? echo $NaiRowColor; ?>> &nbsp; <center>
<?

			 if ($aksesflag5 == "" || $aksesflag5 == $userbranch)
			 {
    			$readyI = "<A HREF=\"javascript:goFlow('$varrow0','I')\">Start Flow</A><BR>";
			 }
			 else
			 {
          	$readyI = "Owner : $aksesflag5";
			 }
  	   if ($hitparalel >= $countdataall)
  		 {  
	          echo $readyI;
	     }
	     else
	     {
	     	   echo "Belum semua FLOW selesai";
	     }
?>
    </center></td>
  </tr>
<?
						}
		       		if ($NaiRowColor == "bgcolor=#FFFFFF")
           		{
            		$NaiRowColor = "bgcolor=#FFFFFF";
           		}
           		else
           		{
              	$NaiRowColor = "bgcolor=#FFFFFF";
           		}
						}
				  	sqlsrv_free_stmt( $sqlConnCustName );	
        	}
		  }
		}
    sqlsrv_free_stmt( $sqlConnawal );
	}

}
//END SELECT dari Tbl_PrevFlow
?>
</table>
<input type=hidden name=act>
<input type=hidden name=userid  value='<? echo $userid; ?>'>
<input type=hidden name=userpwd value='<? echo $userpwd; ?>'>
<input type=hidden name=userbranch value='<? echo $userbranch; ?>'>
<input type=hidden name=userregion value='<? echo $userregion; ?>'>
<input type=hidden name=userwfid  value='<? echo $userwfid; ?>'>
<input type=hidden name=userpermission  value='<? echo $userpinp; ?>'>
<input type=hidden name=LastAction  value='<? echo $LastAction; ?>'>
<input type=hidden name=ButtonAction  value='<? echo $ButtonAction; ?>'>
<input type=hidden name=custnomid>
</form>
</div>
</body>
</html>
<?
   require("../../lib/close_con.php");
	}