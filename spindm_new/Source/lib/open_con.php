<?php
//ini_set("display_errors", 0);

function OpenConn()
{
  $line = "db_filling,root,,localhost,,2,3,eschool,";
  $arrdatalines = explode(",",$line);
	$namadb = $arrdatalines[0];
	$userdb = $arrdatalines[1];
	$passdb = $arrdatalines[2];
	$ipdb = $arrdatalines[3];

  mysql_connect("$ipdb", "$userdb", "$passdb")or die("cannot connect"); 
  mysql_select_db("$namadb")or die("cannot select DB");
}

function CheckUser($theid,$thepwd,$theorg)
{
	$varpwd = myDec($thepwd);
/*	$query = "SELECT COUNT(*)
		   									FROM SE_User
		   									WHERE user_id='$theid'
		   									AND user_organization='$theorg'
		   									AND user_pwd=MD5('$thepwd')";*/
	$query = "SELECT COUNT(*)
		   									FROM SE_User
		   									WHERE user_id='$theid'
		   									AND user_organization='$theorg'
		   									AND user_pwd='$varpwd'";
	$result=mysql_query($query);
	$row = mysql_fetch_row($result);
	if ($row[0] <= 0)
	{
  	 $msg = "Invalid Access (1) for user <font color=red>$theid</font><BR>";
  	 $msg .= "<A HREF='/efilling/index.php'><font color=black><u>Click Here To LOGIN</u></font></A>";
	   GAGAL($msg);
	}

/*	$query = "SELECT user_signin
		   									FROM SE_User
		   									WHERE user_id='$theid'
		   									AND user_organization='$theorg'
		   									AND user_pwd=MD5('$thepwd')";*/
	$query = "SELECT user_signin
		   									FROM SE_User
		   									WHERE user_id='$theid'
		   									AND user_organization='$theorg'
		   									AND user_pwd='$varpwd'";
	$result=mysql_query($query);
	$row = mysql_fetch_row($result);
	if ($row[0] == "")
	{
  	 $msg = "Invalid Access (2) for user <font color=red>$theid</font><BR>";
  	 $msg .= "<A HREF='/efilling/index.php'><font color=black><u>Click Here To LOGIN</u></font></A>";
	   GAGAL($msg);
	}
}

function CheckControl($theorg)
{
  $query = "SELECT *
	   		                FROM SE_MasterControl
	   		                WHERE control_show='Y'";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result))
	{
     $querytemp = "SELECT control_value
	   		                    FROM SE_UserControl
	        	                WHERE control_id='$row[0]'
	        	                AND control_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] == "")
	   {
  	     $msg = "<BR>";
  	     $msg .= "<font size=3>Please configure your setting first. Go to Setting >> Control</font>";
  	     $msg .= "<BR><BR><BR><BR><BR><BR>";
  	     GAGAL2($msg);
	   }
	}
}

function CheckBranch($theorg)
{
     $querytemp = "SELECT COUNT(*)
	   		                    FROM TblBranch
	        	                WHERE branch_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg = "<BR>";
  	     $msg .= "<font size=3>(Branch) Please configure your branch first. Go to Setting >> Branch</font>";
  	     $msg .= "<BR><BR><BR><BR><BR><BR>";
  	     GAGAL2($msg);
	   }
}

function CheckCabinet($theorg)
{
	   $msg = "";
     $querytemp = "SELECT COUNT(*)
	   		                    FROM SE_UserControl
	        	                WHERE control_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg .= "<BR><BR>";
  	     $msg .= "<font size=3>(Control) Please configure your control first. Go to Setting >> Control</font>";
	   }

     $querytemp = "SELECT COUNT(*)
	   		                    FROM TblBranch
	        	                WHERE branch_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg .= "<BR><BR>";
  	     $msg .= "<font size=3>(Branch) Please configure your branch first. Go to Setting >> Branch</font>";
	   }

     $querytemp = "SELECT COUNT(*)
	   		                    FROM TblUnit
	        	                WHERE unit_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg .= "<BR><BR>";
  	     $msg .= "<font size=3>(Work Unit) Please configure your work unit first. Go to Setting >> Branch</font>";
	   }

     $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Cabinet
	        	                WHERE cabinet_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg .= "<BR><BR>";
  	     $msg .= "<font size=3>(Cabinet) Please configure your storage first. Go to Setting >> Storage</font>";
	   }

     $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Drawer
	        	                WHERE drawer_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg .= "<BR><BR>";
  	     $msg .= "<font size=3>(Drawer) Please configure your storage first. Go to Setting >> Storage</font>";
	   }

     $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_DocType
	        	                WHERE doc_organization='$theorg'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   if ($rowtemp[0] <= 0)
	   {
  	     $msg .= "<BR><BR>";
  	     $msg .= "<font size=3>(Document Type) Please configure your document type first. Go to Setting >> Doc. Type</font>";
	   }
	   
	   if ($msg != "")
	   {
  	     MSG($msg);
	   }
}

function funcCreateID($thenumber){
	   $ascTable = "9abcdefghijklmnopqrstuvwxyz012345678ABCDEFGHIJKLMNOPQRSTUVWXYZ";
//		 $ascTable = "qwertyuiopasdfghjklzxcvbnm1234567890POIUYTREWQLKJHGFDSAMNBVCXZ";
		 $thebase = strlen($ascTable);
		 $varreturn = "";
		 $varhitung = "";
		
		
		 while($thenumber >= $thebase) {
			  $tempmodulus = abs($thenumber % $thebase);
			  $varhitung = $ascTable[$tempmodulus] . $varhitung;
			//echo $tempmodulus."<br/>";
			//echo $thenumber."<br/>";
			  $thenumber = $thenumber/$thebase;

		 }
		 $varreturn = $ascTable[$thenumber] . $varhitung;
		 return $varreturn;
	}

function myEnc($thenumber){
	   $ascTable = "0123456789abcdef";
	   
	   $tempnumber1 = substr($thenumber,1-1,8);
	   $tempnumber2 = substr($thenumber,9-1,8);
	   $tempnumber3 = substr($thenumber,17-1,8);
	   $tempnumber4 = substr($thenumber,25-1);
	   $newnumber = "";
	   for ($ki=1;$ki<=4;$ki++)
	   {
	   	  $varmakro = "tempnumber" . $ki;
	   	  $newnumber .= strrev($$varmakro);
	   }
		 return $newnumber;
	}

function myDec($thenumber){
	   $ascTable = "0123456789abcdef";
	   
	   $tempnumber1 = substr($thenumber,1-1,8);
	   $tempnumber2 = substr($thenumber,9-1,8);
	   $tempnumber3 = substr($thenumber,17-1,8);
	   $tempnumber4 = substr($thenumber,25-1);
	   $newnumber = "";
	   for ($ki=1;$ki<=4;$ki++)
	   {
	   	  $varmakro = "tempnumber" . $ki;
	   	  $newnumber .= strrev($$varmakro);
	   }
		 return $newnumber;
	}

function GAGAL($themsg)
{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Electronic Filling</title>
    <link rel="shortcut icon" href="Source/img/favicon.ico" type="image/x-icon">
    <link href="Source/css/main.css" rel="stylesheet" type="text/css" media="screen">
  </head>
  <body id="tuts" onload=self.focus()>
    <div id="wrapper">
      <div id="header">
        <div id="masthead">
        	 <img src="Source/img/header.jpg" width="960" height="77" alt="E-Filling System">
        </div>
      </div>
      <div id="maincontent">
      	<form name=frmerr method=post>
		      <h2>ERROR</h2>
			 	  <p><font face=Arial size=3><b><? echo $themsg ?></b></font></p>
		      <BR><BR>
		      <input type=hidden name=act value=''>
        </form>
      </div>
    </div>
  </body>
</html>
<?
exit;
}

function GAGAL2($themsg)
{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Electronic Filling</title>
    <link rel="shortcut icon" href="Source/img/favicon.ico" type="image/x-icon">
    <link href="Source/css/main.css" rel="stylesheet" type="text/css" media="screen">
  </head>
  <body id="tuts" onload=self.focus()>
    <div id="wrapper">
      <div id="header">
        <div id="masthead">
        	 &nbsp
        </div>
      </div>
      <div id="maincontent">
      	<form name=frmerr method=post>
			 	  <p><font face=Arial size=3><b><? echo $themsg ?></b></font></p>
		      <BR><BR>
		      <input type=hidden name=act value=''>
        </form>
      </div>
    </div>
  </body>
</html>
<?
exit;
}

function MSG($themsg)
{
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Electronic Filling</title>
    <link rel="shortcut icon" href="Source/img/favicon.ico" type="image/x-icon">
    <link href="Source/css/main.css" rel="stylesheet" type="text/css" media="screen">
  </head>
  <body id="tuts" onload=self.focus()>
    <div id="wrapper">
      <div id="header">
        <div id="masthead">
        	 <img src="Source/img/header.jpg" width="960" height="77" alt="E-Filling System">
        </div>
      </div>
      <div id="maincontent">
      	<form name=frmerr method=post>
		      <h2>ERROR</h2>
			 	  <p><font face=Arial size=3><? echo $themsg ?></font></p>
			 	  <A HREF="javascript:history.back();"><img src=Source/img/back.jpg></A>
		      <BR><BR>
		      <input type=hidden name=act value=''>
        </form>
      </div>
    </div>
  </body>
</html>
<?
exit;
}
