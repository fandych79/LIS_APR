<?php

  $act=$_POST['act'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

  include ("../lib/formatError.php");
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


  if ($act == "cekjob")
  {
  	CEKJOB();
  }

function CEKJOB()
{
   require ("../lib/open_con.php");

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $utilwindow=$_POST{'utilwindow'};
  $loguserid=$_POST{'loguserid'};
  $logbranch=$_POST{'logbranch'};
  $logoutput=$_POST{'logoutput'};

  $kondisiuserid = "";
  if ($loguserid != "")
  {
  	 $kondisiuserid = "AND (Tbl_SE_User.user_id like '%$loguserid%' or Tbl_SE_User.user_name like '%$loguserid%')";
  }
  
  $kondisibranch = "";
  if ($logbranch != "")
  {
  	 if (substr($logbranch,1-1,1) == "8")
  	 {
  	 	   if ($logbranch == "888")
  	 	   {
  	 	   	  $kondisibranch = "";
  	 	   }
  	 	   else
  	 	   {
  	 				$kondisibranch = "AND Tbl_Branch.branch_region_code = '$logbranch'";
  	 	   }
  	 }
  	 else
  	 {
  	    $kondisibranch = "AND Tbl_SE_User.user_branch_code = '$logbranch'";
  	 }
  }
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
				function cekthis()
				{
              document.formsubmit.target = "utama";
              document.formsubmit.act.value='cekjob';
              document.formsubmit.action = "./do_maintainlog.php";
		   				document.formsubmit.submit();
				}
      </Script>
   </head>
   <body>
<script language="JavaScript"><!--
name = '<? echo $utilwindow ?>';
//--></script>
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>

 
   	   <div align=center>
          <form name=formsubmit id=formsubmit method=post action=./do_repperformansikurir.cgi target='utama'>
   	      <table style="background-color:#FFF;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	  	      	 <font face=Arial size=3><b>REPORT USER ID</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
                 	<table width=100% cellpadding=0 cellspacing=0 border=0>
      	             	      <tr>
      	                	<td width=100% valign=top align=left>
      	                	   <table width=100% cellpadding=0 cellspacing=0 border=1 bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#FFFFFF">
<?
		if ($logoutput == "txt")
		{
   		$fileomr = "../temp/output" . $userid . ".txt";
   		$FILEOMR = fopen($fileomr, 'w') or die("can't open file");
      $line = "NO" . chr(9) . "USER ID" . chr(9) . "USER NAME" . chr(9) . "BRANCH" . chr(9) . "LEVEL" . chr(9) . "LIMIT"  . chr(9) . "\n";
	    fwrite($FILEOMR,$line);
		}
		else
		{
?>
      	                	      <tr>
      	                	         <td width=5% align=center valign=top>
      	                	            <font face=Arial size=2><b>NO</b></font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><b>USER ID</b></font>
      	                	         </td>
      	                	         <td width=30% align=center valign=top>
      	                	            <font face=Arial size=2><b>USER NAME</b></font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><b>BRACNH</b></font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><b>LEVEL</b></font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><b>LIMIT</b></font>
      	                	         </td>
      	                	      </tr>
<?
		}

	$tsql = "SELECT Tbl_SE_User.user_id, Tbl_SE_User.user_name,
			Tbl_SE_User.user_branch_code, Tbl_SE_User.user_level_code,
			Tbl_SE_User.user_limit_money
   		FROM Tbl_SE_User, Tbl_Branch
   		WHERE Tbl_SE_User.user_branch_code=Tbl_Branch.branch_code
   		$kondisiuserid
   		$kondisibranch
			ORDER BY Tbl_SE_User.user_branch_code,Tbl_SE_User.user_level_code,Tbl_SE_User.user_id";
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
      $urut = 0;
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
      	$urut++;
   			  $tsql2 = "SELECT branch_name
						        FROM Tbl_Branch
						        WHERE branch_code='$row[2]'";
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
      		   	  $branchname = $row2[0];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );

   			  $tsql2 = "SELECT level_name
						        FROM Tbl_SE_Level
						        WHERE level_code='$row[3]'";
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
      		   	  $levelname = $row2[0];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
   	      if ($row[4] <= 0 or $row[4] == "")
   	      {
   	      	$userlimit = "&nbsp";
   	      }
   	      else
   	      {
   	      	$userlimit = number_format($row[4]);
   	      }

					if ($logoutput == "txt")
					{
      					$line = $urut . chr(9) . $row[0] . chr(9) . $row[1] . chr(9) . $branchname . chr(9) . $levelname . chr(9) . $userlimit  . chr(9) . "\n";
	    					fwrite($FILEOMR,$line);
					}
					else
					{
?>
      	                	      <tr>
      	                	         <td width=5% align=right valign=top>
      	                	            <font face=Arial size=2><? echo $urut ?>.&nbsp</font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><? echo $row[0] ?></font>
      	                	         </td>
      	                	         <td width=30% align=left valign=top>
      	                	            <font face=Arial size=2><? echo $row[1] ?></font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><? echo $branchname ?></font>
      	                	         </td>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><? echo $levelname ?></font>
      	                	         </td>
      	                	         <td width=10% align=right valign=top>
      	                	            <font face=Arial size=2><? echo $userlimit ?></font>
      	                	         </td>
      	                	      </tr>
<?
					}
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      	                	   </table>
      	                	</td>
      	                      </tr>
                 	</table>
      					  <BR>
      					  <BR><BR>
      	       </td>
      	    </tr>
         </table>
   	  	      	</td>
   	  	      </tr>
   	      </table>
<?
		if ($logoutput == "txt")
		{
   			fclose($FILEOMR);
?>
      	  <A HREF=../temp/output<? echo $userid ?>.txt><font face=Arial size=3>Download Text File</font></A>
<?
		}
?>
        	<input type=hidden name=userid value='<? echo $userid; ?>'>
        	<input type=hidden name=userpwd value='<? echo $userpwd; ?>'>
        	<input type=hidden name=userprgcode>
        	<input type=hidden name=utilwindow value='<? echo $utilwindow ?>'>
        	<input type=hidden name=act>
        	<input type=hidden name=thejob>
      	 </form>
   	   </div>
   </body>
</html>
<?
   require("../lib/close_con.php");
exit;
}

function aaCEKJOB()
{
   require ("../lib/open_con.php");

  $loguserid=$_POST{'loguserid'};
  $logprogramcode=$_POST{'logprogramcode'};
  $logmonth=$_POST{'logmonth'};
  $logyear=$_POST{'logyear'};

  $kondisiuserid = "";
  if ($loguserid != "")
  {
  	$kondisiuserid = " AND Tbl_SE_UserLog.log_user_id='$loguserid'";
  }

  $kondisiprogramcode = "";
  if ($logprogramcode != "")
  {
  	$kondisiprogramcode = " AND Tbl_SE_UserLog.log_workstation='$logprogramcode'";
  }

  $kondisimonth = "";
  if ($logmonth != "")
  {
  	$kondisimonth = " AND month(Tbl_SE_UserLog.log_datetime)='$logmonth'";
  }

  $kondisiyear = "";
  if ($logyear != "")
  {
  	$kondisiyear = " AND year(Tbl_SE_UserLog.log_datetime)='$logyear'";
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
<meta http-==uiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-==uiv="Expired" CONTENT="0">
<meta http-==uiv="Cache-Control" CONTENT="no-Cache">
<meta http-==uiv="Pragma" CONTENT="no-Cache">
<title>CTS BII</title>
<script type="text/javascript" src="bin/style2/datetimepicker_css.js"></script>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
    <style type="text/css">
        body
        {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
            padding-left: 0;
            padding-right: 0;
        }
        #left
        {
            position: absolute;
            left: 5px;
            padding: 0px;
            top: 0px;
            width: 25%;
        }
        #center
        {
            margin-left: 25%;
            padding: 0px;
            margin-right: 200px;
            top: 0px;
            width: 50%;
        }
        #right
        {
            position: absolute;
            right: 5px;
            padding: 0px;
            top: 0px;
            width: 25%;
        }
    </style>
    <Script type="text/javascript">
	function viewLog(thejob)
	{
	      document.formsubmit.thejob.value = thejob;
              document.formsubmit.target = "lainnya";
              document.formsubmit.act.value='viewjob';
              document.formsubmit.action = "./do_maintainlog.php";
              window.open('./do_maintainlog.php','lainnya','scrollbars=yes,width=653,height=400,screenX=0,screenY=0,top=0,left=0,status=yes');
	      document.formsubmit.submit();
	}
	function killJob(thejob)
	{
           submitform = window.confirm("Kill This Job ?");
           if (submitform == true)
           {
	      document.formsubmit.thejob.value = thejob;
              document.formsubmit.target = "utama";
              document.formsubmit.act.value='deljob';
              document.formsubmit.action = "./do_maintainlog.php";
	      document.formsubmit.submit();
	   }
	   else
	   {
	   }
	}

    </script> 
</head>
<body link="blue" alink="blue" vlink="blue">
    <div align=center>
         <TABLE WIDTH="740" BORDER=0 CELLPADDING=0 CELLSPACING=0>
      	    <tr>
      	       <td width=100% valign=top align=left>
                 <form name=formsubmit id=formsubmit method=post action=./do_repperformansikurir.cgi target='utama'>
                 	<table width=100% cellpadding=0 cellspacing=0 border=0>
      	             	      <tr>
      	                	<td width=100% valign=top align=left>
      	                	   <table width=100% cellpadding=0 cellspacing=0 border=1 bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#FFFFFF">
      	                	      <tr>
      	                	         <td width=10% align=center valign=top>
      	                	            <font face=Arial size=2><b>NO</b></font>
      	                	         </td>
      	                	         <td width=20% align=center valign=top>
      	                	            <font face=Arial size=2><b>TANGGAL</b></font>
      	                	         </td>
      	                	         <td width=20% align=center valign=top>
      	                	            <font face=Arial size=2><b>USER ID</b></font>
      	                	         </td>
      	                	         <td width=30% align=center valign=top>
      	                	            <font face=Arial size=2><b>JENIS</b></font>
      	                	         </td>
      	                	         <td width=20% align=center valign=top>
      	                	            <font face=Arial size=2><b>PRODUK</b></font>
      	                	         </td>
      	                	      </tr>
<?
	$tsql = "SELECT cast(Tbl_SE_UserLog.log_datetime as varchar),
  		Tbl_SE_UserLog.log_user_id, Tbl_SE_UserLog.log_workstation,
  		Tbl_SE_Program.program_name, Tbl_SE_userLog.log_program_code
   		FROM Tbl_SE_UserLog, Tbl_SE_Program
   		WHERE Tbl_SE_UserLog.log_workstation=Tbl_SE_Program.program_code
   		$kondisiuserid
	 		$kondisiprogramcode
			$kondisimonth
			$kondisiyear
			ORDER BY Tbl_SE_UserLog.log_datetime";
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
      $urut = 0;
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
      	$urut++;
?>
      	                	      <tr>
      	                	         <td width=10% align=right valign=top>
      	                	            <font face=Arial size=2><? echo $urut ?>.&nbsp</font>
      	                	         </td>
      	                	         <td width=20% align=center valign=top>
      	                	            <font face=Arial size=2><? echo $row[0] ?></font>
      	                	         </td>
      	                	         <td width=20% align=center valign=top>
      	                	            <font face=Arial size=2><? echo $row[1] ?></font>
      	                	         </td>
      	                	         <td width=30% align=left valign=top>
      	                	            <font face=Arial size=2><? echo $row[2] ?> - <? echo $row[3] ?></font>
      	                	         </td>
      	                	         <td width=20% align=center valign=top>
      	                	            <font face=Arial size=2><? echo $row[4] ?></font>
      	                	         </td>
      	                	      </tr>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      	                	   </table>
      	                	</td>
      	                      </tr>
                 	</table>
        						<input type=hidden name=userid value='<? echo $userid; ?>'>
        						<input type=hidden name=userpwd value='<? echo $userpwd; ?>'>
        						<input type=hidden name=userprgcode>
        						<input type=hidden name=targetprgcode value='<? echo $targetprgcode; ?>'>
        						<input type=hidden name=targetprgact value='<? echo $targetprgact; ?>'>
        						<input type=hidden name=targetgrpcode value='<? echo $targetgrpcode; ?>'>
        						<input type=hidden name=act>
        						<input type=hidden name=thejob>
      					 </form>
      					 <BR>
      	       </td>
      	    </tr>
         </table>
    </div>
</body>
</html>

<?
   require("../lib/close_con.php");
exit;
}

