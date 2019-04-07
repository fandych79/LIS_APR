<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $act=$_POST['act'];
echo "Upload in progress....Please wait....";
if ($act == "upload")
{
   $uploaded_type = basename( $_FILES['uploaded']['type']) ; 
   if ($uploaded_type != "plain")
   {
   	 echo "<font face=Arial size=4>Harap mengupload <b>TEXT FILE</b></font>";
   	 exit;
   }

   GOUPLOAD();
}


function GOUPLOAD()
{
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload</title>
<link href="bin/styleupload/scripts/Panel.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="bin/styleupload/source/79.ico" type="image/x-icon">
<script>
function close_window()
{
close();
}
</script>
</head>
<body onload=self.focus() bgcolor=#CFF8EE>
<script language="JavaScript"><!--
name = 'lainnya';
//--></script>
<table width="508" border="3" cellspacing="0" cellpadding="10px" align="center" background="bin/styleupload/source/73.png">
	<font face=Verdana color=black>
	<H2>SUBMIT JOB FINISH</H2>
	<P>
	<BR><BR>
	Thank you for using SPIN Submit Job Utility for Background Processing.
	<BR>
	Your job(s) will be finish to 15 - 30 minutes.
	<BR><BR>
	Copyright SPIN Technology, 2004 - 2011. All right reserved.
	</font>
	<P>
<tr>
<td width="500" height="200" valign="top">
<?
   require ("../lib/open_con.php");

 $where=$_POST['where'];
  $userid=$_POST['userid'];

    $target = $where; 
 $filestorage = $target;
 $filemasking = "/Blast_LIS.txt"; 
 $target = $target . $filemasking ; 
 $ok=1; 
 $uploaded_size = basename( $_FILES['uploaded']['size']) ; 
 $uploaded_type = basename( $_FILES['uploaded']['type']) ; 
 $uploaded_name = basename( $_FILES['uploaded']['name']) ; 
 $uploaded_stored = basename( $_FILES['uploaded']['tmp_name']) ; 

	if (file_exists($target))
	{
   			echo "<font face=Arial size=4><b>FILE Blast_LIS.txt SUDAH ADA, TUNGGU BEBERAPA SAAT LAGI HINGGA JOB SELESAI</b></font>";
   			exit;
	} 
 
 
 if ($ok == 1)
 {
    if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
    {
       echo "<font face=Arial size=3>The file <b>$uploaded_name</b><BR> Type : ". $uploaded_type . "<BR> has been uploaded $uploaded_size bytes <BR> temporari file $uploaded_stored <BR>stored in $target"  . "</font>";
    } 
    else {
       echo "Sorry, there was a problem uploading your file.";
    }
 }

?>

<br>
<br>
<br>
<a><input type="button" value="Close Tab" onClick="close_window();return false;" style="width:100px;height:25px"></a>


</td>
</tr>
</table>
<?
   require("../lib/close_con.php");
   exit;
}

