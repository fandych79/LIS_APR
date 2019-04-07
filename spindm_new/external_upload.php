<?php
# Copyright 2012
# Written by : PPC Team
# Leader     : Budi Hartoyo

$programact = "external_upload.php";
include ("Source/lib/open_con.php");
OpenConn();

$dmuserid=$_REQUEST['dmuserid'];
$userpwd=$_REQUEST['userpwd'];
$username=$_REQUEST['username'];
$dmuserorganization=$_REQUEST['dmuserorganization'];
$act = "";
$msg = "";

//CheckUser($dmuserid,$userpwd,$dmuserorganization);

if (isset($_REQUEST['act']))
{
	$act = $_REQUEST['act'];
}

if ($act == "signout")
{
	$act = "";
}

if (substr($act,1-1,4) != "save")
{
	MAINPAGE();
}

if ($act == "save")
{
 $dmunitcode=$_POST['dmunitcode'];
 $dmbranchcode=$_POST['dmbranchcode'];
 $filefolder=$_POST['filefolder'];
 $filecabinet=$_POST['filecabinet'];
 $filedrawer=$_POST['filedrawer'];
 $filetype=$_POST['filetype'];
 $filemaxsize=$_POST['filemaxsize'];
// $fileext=$_POST['fileext'];
 $filepage=$_POST['filepage'];
 $fileindex1=$_POST['fileindex1'];
 $fileindex2=$_POST['fileindex2'];
 $filecif=$_POST['filecif'];
 $filedesc=$_POST['filedesc'];
 $filelink =$_POST['filelink'];
 
 if ($filelink == "http://")
 {
 	  $filelink = "";
 }

 $querytemp = "SELECT control_value
	   		                    FROM SE_UserControl
	        	                WHERE control_id='ctrlsavefolder'
	        	                AND control_organization='$dmuserorganization'";
 $resulttemp=mysql_query($querytemp);
 $rowtemp = mysql_fetch_row($resulttemp);
 $ctrlsavefolder = $rowtemp[0] . "/";

 $querytemp = "SELECT control_value
	   		                    FROM SE_UserControl
	        	                WHERE control_id='ctrldispfolder'
	        	                AND control_organization='$dmuserorganization'";
 $resulttemp=mysql_query($querytemp);
 $rowtemp = mysql_fetch_row($resulttemp);
 $ctrldispfolder = $rowtemp[0] . "/";

 $varyear = Date('Y');
 $target = $ctrlsavefolder; 
 if (!file_exists($target))
 {
   if (!mkdir($target, 0777, true))
   {
      MSG('(1) Failed to create folders...');
      exit;
   }
 }
 $target .= $varyear . "/";
 if (!file_exists($target))
 {
   if (!mkdir($target, 0777, true))
   {
      MSG('(2) Failed to create folders...');
      exit;
   }
 }

 $uploaded_size = basename( $_FILES['uploaded']['size']) ; 
// $uploaded_type = basename( $_FILES['uploaded']['type']) ; 
 $uploaded_name = basename( $_FILES['uploaded']['name']) ; 
 $uploaded_stored = basename( $_FILES['uploaded']['tmp_name']) ; 

 $hasilsplit = strtolower(end(explode(".", $uploaded_name)));
 $fileext = $hasilsplit;
 $uploaded_type = $fileext; 

 $filestorage = $ctrldispfolder . $varyear . "/";
// $filemasking = $filetype . $fileindex1 . "_" . $filepage . "." . $fileext;
 $filemasking = md5($uploaded_name . date('Y-m-d H:i:s')) . "." . $hasilsplit;
// $filemasking = md5($uploaded_name . date('Y-m-d H:i:s'));
 $target = $target . $filemasking ; 
 $uploaded_drawer = $hasilsplit . "," . $filecabinet . "," . $filedrawer . "," . $dmbranchcode . "," . $dmunitcode;

 $filepage = 1;
 $filecontentsearch = "N";
 $fileencrypt = "N";
 $fileprint = "Y";

 if ($dmuserorganization != "PRIVATE")
 {
	  $query = "SELECT doc_size FROM Tbl_DocSummary WHERE doc_organization='$dmuserorganization'";
	  $result=mysql_query($query);
	  $row = mysql_fetch_row($result);
	  if ($row[0] <= 0 or $row[0] == "")
	  {
   		$alldocsize = 0;
   		if ($row[0] < 0)
   		{
        $tsql="UPDATE Tbl_DocSummary SET doc_size='$alldocsize' 
               WHERE doc_organization='$dmuserorganization'";
   		  $tresult=mysql_query($tsql);
   		}

      $tsql="INSERT INTO Tbl_DocSummary VALUES('$dmuserorganization',0)";
   		$tresult=mysql_query($tsql);
	  }
	  else
	  {
   		$alldocsize = $row[0];
   		
	
	    $query = "SELECT user_id, user_refrence
	          from MEMBER_User
	          where subdomain='$dmuserorganization'";
	    $result=mysql_query($query);
	    $row = mysql_fetch_row($result);
	    $packetdmuserid = $row[0];
	    $tempuserrefrence = $row[1];

     $arrrefrence = explode(",",$tempuserrefrence);
     $packetcode = $arrrefrence[0];
     $packetstart = $arrrefrence[1];
     $packetend = $arrrefrence[2];

	    if ($packetcode == "")
	    {
	    	  $packetcode = 0;
	    }

     $query = "SELECT TO_DAYS(NOW()),
  					 TO_DAYS('$packetend')";
	   $result=mysql_query($query);
     $row = mysql_fetch_row($result);

     if ($row[0] > $row[1])
     {
        $msg = "<BR>Your Package has been ENDED at <b>$packetend</b>. <BR> Please pay your annual package.<BR>Click \"Info\" for more details.";
        GAGAL($msg);
     }

	    $query = "SELECT packet_fee_month, packet_name
	          FROM TblPacket
	          where packet_code='$packetcode'";
	    $result=mysql_query($query);
	    $row = mysql_fetch_row($result);
	    $maxstorage = $row[0];
	    $packetname = $row[1];
	    $mbmaxstorage = number_format($maxstorage / 1000000);
	    $mballdocsize = number_format($alldocsize / 1000000);

	    if($alldocsize > $maxstorage)
	    {
           $msg = "<b>WARNING !!</b><BR>Your package is <b>$packetname</b><BR>Maximum storage  for this packet are : " . number_format($maxstorage) . " bytes / $mbmaxstorage MB.<BR>Total storage for your organization are " . number_format($alldocsize) . " bytes / $mballdocsize MB.<BR>Please UPGRADE your Package.<BR>";
           GAGAL($msg);
	    }
	  }
 }

 $ok=1; 

 if ($uploaded_size > $filemaxsize) 
 { 
    $ok=0; 
    MSG ("Your file is too large (" . number_format($uploaded_size) . " bytes).<br> Maximum size is " . number_format($filemaxsize) . " bytes");
 } 
 
 if ($ok == 1)
 {
    if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
    {
	      $varip = $_SERVER['REMOTE_ADDR'];
	      $varip = str_replace(".","",$varip);
	      $vartstamp = date("Ymdhis");
	      $_rand_1 = rand();
	      $_rand_2 = rand();
	      $varid = ($vartstamp + $varip) + ($_rand_1 + $_rand_2);
        $varunique1 = funcCreateDocID($varid);

	      $vartstamp = date("Ymdhis");
	      $_rand_1 = rand();
	      $_rand_2 = rand();
	      $varid = ($vartstamp + $varip) + ($_rand_1 + $_rand_2);
        $varunique2 = funcCreateDocID($varid);

        $varuniqueid = $varunique1 . $varunique2;

      $tsql="INSERT INTO Tbl_Document VALUES('" . $varuniqueid . "',
  				       '" . $filetype . "',
  				       '" . $filepage . "',
  				       '" . $uploaded_type . "',
  				       '" . $uploaded_name . "',
  				       '" . $filemasking . "',
  				       '" . date('Y-m-d H:i:s') . "',
  				       '" . $uploaded_size . "',
  				       '" . $filestorage . "',
  				       '" . $dmuserid ."',
  				       '" . $uploaded_drawer ."',
  				       '" . $filecontentsearch . "',
  				       '" . $fileencrypt . "',
  				       '" . $fileprint . "',
  				       '" . $dmuserorganization ."',
  				       '" . $fileindex1 ."',
  				       '" . $fileindex2 ."',
  				       '" . $filefolder ."',
  				       '" . $filelink ."',
  				       '" . $filecif ."',
                 '" . $filedesc . "'
  				       )";
   		$tresult=mysql_query($tsql);

      $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Folder
	        	                WHERE folder_code='$filefolder'
	        	                AND folder_cif='$filecif'";
	    $resulttemp=mysql_query($querytemp);
	    $rowtemp = mysql_fetch_row($resulttemp);
	    if ($rowtemp[0] <= 0)
	    {
         $tsql="INSERT INTO Tbl_Folder VALUES('$filefolder','$filecif','$dmuserorganization','')";
   		   $tresult=mysql_query($tsql);
	    }

      $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_DocExtension
	        	                WHERE ext_name='$uploaded_type'";
	    $resulttemp=mysql_query($querytemp);
	    $rowtemp = mysql_fetch_row($resulttemp);
	    if ($rowtemp[0] <= 0)
	    {
         $tsql="INSERT INTO Tbl_DocExtension VALUES('$uploaded_type','N','')";
   		   $tresult=mysql_query($tsql);
	    }

      $tsql="UPDATE Tbl_Cabinet set cabinet_count=cabinet_count+1
             WHERE cabinet_code='$filecabinet'
             AND cabinet_organization='$dmuserorganization'";
   		$tresult=mysql_query($tsql);

      $tsql="UPDATE Tbl_Drawer set drawer_count=drawer_count+1
             WHERE drawer_code='$filedrawer'
             AND drawer_organization='$dmuserorganization'
             AND drawer_cabinet_code='$filecabinet'";
   		$tresult=mysql_query($tsql);

      if ($dmuserorganization != "PRIVATE")
      {
         $tsql="UPDATE Tbl_DocSummary SET doc_size=doc_size+'$uploaded_size'
             WHERE doc_organization='$dmuserorganization'";
   		  $tresult=mysql_query($tsql);
   	  }

      $act = "upload";
      $msg = "File <font color=red>'$uploaded_name'</font> UPLOADED successfuly";
    	MAINPAGE();
    } 
    else
    {
    	 $msg = "Sorry, there was a problem uploading your file.";
       MSG($msg);
    }
 }
}

function MAINPAGE()
{
	global $dmuserid;
	global $userpwd;
	global $username;
	global $dmuserorganization;
	global $programact;
	global $act;
	global $msg;

	$query = "SELECT SE_Program.program_name, SE_GrpProgram.grp_program_name
            FROM SE_Program, SE_GrpProgram
            WHERE SE_Program.grp_program_code=SE_GrpProgram.grp_program_code
            AND SE_Program.program_act='$programact'";
	$result=mysql_query($query);
	$row = mysql_fetch_row($result);
	$programtitle = "$row[1] >> $row[0]";

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Electronic Filling</title>
<script language="JavaScript"><!--
name = 'lainnya';
//--></script>
    <link rel="shortcut icon" href="Source/img/favicon.ico" type="image/x-icon">
    <link href="Source/css/main.css" rel="stylesheet" type="text/css" media="screen">
    <link href="Source/css/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
    <script src="Source/css/SpryMenuBar.js" type="text/javascript"></script>
    <Script Language="JavaScript">
        function toggleExpCol(idGrp, idContainer) {
            idContainer = idContainer ? idContainer + '_' : '';
            var div = document.getElementById(idContainer + 'divGrp' + idGrp);
            var vis = div.style.display = (div.style.display == 'none') ? 'block' : 'none';
            document.images[idContainer + 'imgGrp' + idGrp].src = (vis == 'none') ? 'Source/img/plus.jpg' : 'Source/img/minus.jpg';
        }
    	function viewDetail(theid)
    	{
    		document.formsubmit.theid.value = theid;
    		document.formsubmit.act.value = "view";
        document.formsubmit.action = "./external_query.php";
    		document.formsubmit.submit();
    	}
  	   function cek()
  	   {
	   			if (document.formsubmit.uploaded.value == "")
	   			{
	   				alert("Harap Pilih File Yang Hendak Diupload. Gunakan tombol Browse... untuk memudahkan");
	   				document.formsubmit.uploaded.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].value == "")
	   			{
	   				alert("Harap Pilih Document Type");
	   				document.formsubmit.filetype.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.filecabinet.options[document.formsubmit.filecabinet.selectedIndex].value == "")
	   			{
	   				alert("Harap Pilih Cabinet");
	   				document.formsubmit.filecabinet.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.filedrawer.options[document.formsubmit.filedrawer.selectedIndex].value == "")
	   			{
	   				alert("Harap Pilih Drawer");
	   				document.formsubmit.filedrawer.focus();
	   				return false;
	   			}
	   			if (document.formsubmit.fileindex1.value != "")
	   			{
	   				if (document.formsubmit.fileindex1.value.indexOf(" ") != -1)
	   				{
	   					alert("File Index tidak boleh ada spasi");
	   					document.formsubmit.fileindex1.focus();
	   					return false;
	   				}
	   			}
	   			if (document.formsubmit.fileindex2.value == "")
	   			{
	   				alert("Harap Ketikan Nama Dokumen / Nomor Dokumen");
	   				document.formsubmit.fileindex2.focus();
	   				return false;
	   			}
           		document.formsubmit.act.value = "save";
           		document.formsubmit.action = "./<? echo $programact ?>";
           		varmsg = "Are your sure to SAVE ?";
           		submitform = window.confirm(varmsg)           
           		if (submitform == true)
           		{
		              document.formsubmit.submit();
           		}
  	   }
  	   function isiIndex()
  	   {
  	   	  if (document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].value != "")
  	   	  {
  	   	  	document.formsubmit.fileindex1.value = document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].value;
  	   	  	document.formsubmit.filedesc.value = document.formsubmit.filetype.options[document.formsubmit.filetype.selectedIndex].text;
  	   	  }
  	   }
    </Script>
  </head>
  <body id="tuts" link=blue vlink=blue alink=blue onload=self.focus()>
    <div id="wrapper">
<?
   include("menu.php");
?>
      <div id="maincontent">
		    <h3><? echo $programtitle ?></h3>
<?
      if ($act == "upload")
      {
        $key=$_REQUEST['key'];
        $hasilsplit = explode("_", $key);
        $custnomid = $hasilsplit[1];
        $custcif = $hasilsplit[0];
        $dmstatusdoc=$_REQUEST['dmstatusdoc'];
        $hasilsplit = explode(",", $dmstatusdoc);
        $kondisistatusdoc = "";
        $kondisialldoc = "";
        if ($dmstatusdoc != "")
        {
        	for ($zz=0;$zz<count($hasilsplit);$zz++)
        	{
            $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Document
	        	                WHERE doc_index3='$custnomid'
	        	                AND doc_type='$hasilsplit[$zz]'";
	          $resulttemp=mysql_query($querytemp);
	          $rowtemp = mysql_fetch_row($resulttemp);
	          if ($rowtemp[0] <= 0)
	          {
        	     $kondisistatusdoc .= "doc_code='$hasilsplit[$zz]' or ";
        	  }
        	  $kondisialldoc .= "doc_code='$hasilsplit[$zz]' or ";
        	}
        	$kondisistatusdoc = "AND (" . substr($kondisistatusdoc,0,strlen($kondisistatusdoc)-3) . ")";
        	$kondisialldoc = "AND (" . substr($kondisialldoc,0,strlen($kondisialldoc)-3) . ")";
        }

//        $thecabinet=$_POST['thecabinet'];
//        $thedrawer=$_POST['thedrawer'];
//        $dmbranchcode=$_REQUEST['dmbranchcode'];
//        $unitcode=$_POST['unitcode'];

        $querytemp = "SELECT drawer_code
	   		                    FROM SE_UserStorage
	        	                WHERE user_id='$dmuserid'
	        	                AND drawer_access='W'
	        	                AND user_organization='$dmuserorganization'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $thedrawer = $rowtemp[0];

        $querytemp = "SELECT drawer_name, drawer_cabinet_code
                      FROM Tbl_Drawer
	        	          WHERE drawer_organization='$dmuserorganization'
	        	          AND drawer_code='$thedrawer'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $drawername = $rowtemp[0];
	      $thecabinet = $rowtemp[1];

        $querytemp = "SELECT cabinet_name, cabinet_unit_code
                      FROM Tbl_Cabinet
	        	          WHERE cabinet_organization='$dmuserorganization'
	        	          AND cabinet_code='$thecabinet'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $cabinetname = $rowtemp[0];
	      $dmunitcode = $rowtemp[1];

        $querytemp = "SELECT unit_name, unit_branch_code
	   		                    FROM TblUnit
	        	                WHERE unit_code='$dmunitcode'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $unitname = $rowtemp[0];
	      $dmbranchcode = $rowtemp[1];

        $querytemp = "SELECT branch_name
	   		                    FROM TblBranch
	        	                WHERE branch_code='$dmbranchcode'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $branchname = $rowtemp[0];

?>
      	<form name=formsubmit method=post ENCTYPE='multipart/form-data'>
<?
     CheckControl($dmuserorganization);

?>
		      <table width=100% cellpadding=3 cellspacing=0 border=0>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>ID</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <font size=2><? echo $key ?></font>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>File Name</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <input type=file name=uploaded size=25 style='background-color:#FF0;'>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>Document Type</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <select name=filetype style='background-color:#FF0;width:90mm' onChange=isiIndex()>
			 	   	      	<option value=''>-- Choose One --</option>
<?
	                $query = "SELECT *
	   		                FROM Tbl_DocType
	        	            WHERE doc_organization='$dmuserorganization'
	        	            $kondisistatusdoc
	        	            ORDER BY doc_code";
	                $result=mysql_query($query);
	                while($row=mysql_fetch_array($result))
	                {
	                	echo "<option value='$row[0]'>$row[0] - $row[2]</option>";
	                }
?>
			 	   	      </select>
			 	       </td> 
			      </tr>
<?
        $querytemp = "SELECT control_value, format(control_value/1000000,0),
                            format(control_value,0)
	   		                    FROM SE_UserControl
	        	                WHERE control_id='ctrlmaxsize'
	        	                AND control_organization='$dmuserorganization'";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
?>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>Maximum Size</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <select name=filemaxsize style='width:90mm;'>
			 	   	      	<option value='<? echo $rowtemp[0] ?>'><? echo $rowtemp[1] ?> MB / <? echo $rowtemp[2] ?> bytes</option>
			 	   	      </select>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	       	  <img src=Source/img/Storage.png width=20>
			 	   	      <font size=2>Location</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	     <font size=2><b>{<? echo $branchname ?>}\{<? echo $unitname ?>}</b></font>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	       	  <img src=Source/img/Cabinet.png width=20>
			 	   	      <font size=2>Cabinet</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
        			 	 <select name=filecabinet style='width:90mm;background-color:#FF0;'>
        			 	 	  <option value='<? echo $thecabinet ?>'><? echo $cabinetname ?></option>
        			 	</select>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	       	  <img src=Source/img/Drawer.png width=20>
			 	   	      <font size=2>Drawer</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
        			 	 <select name=filedrawer style='width:90mm;background-color:#FF0;'>
        			 	 	  <option value='<? echo $thedrawer ?>'><? echo $drawername ?></option>
        			 	</select>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	       	  <img src=Source/img/Folder.png width=20>
			 	   	      <font size=2>Folder / Uniq ID</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	       	 <input type=text name=filefolder size=28 maxlength=30 value='<? echo $custnomid ?>' style='background-color:cyan;' readonly=readonly>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	       	  <img src=Source/img/Boxes.png width=20>
			 	   	      <font size=2>Boxes / CIF</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <input type=text name=filecif size=28 maxlength=30 value='<? echo $custcif ?>' style='background-color:cyan;' readonly=readonly>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>Document # / Title</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <input type=text name=fileindex2 size=45 maxlength=50 style='background-color:#FF0;'>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>Hyperlink</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	       	 <input type=text name=filelink size=45 maxlength=200 value='http://'>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>Index</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <input type=text name=fileindex1 size=45 maxlength=50 style='background-color:#FF0;' readonly=readonly>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      <font size=2>Description</font> &nbsp &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
			 	   	      <textarea name=filedesc rows=4 cols=47 style='resize:none;'></textarea>
			 	       </td> 
			      </tr>
			      <tr>
			 	       <td width=5% align=left valign=top>
			 	       	  &nbsp
			 	       </td> 
			 	       <td width=25% align=right valign=top>
			 	   	      &nbsp
			 	       </td> 
			 	       <td width=70% align=left valign=top>
		 	   	      <input type=button value='SUBMIT' style='width:90mm;' class=blue onclick="javascript:cek()">
			 	       </td> 
			      </tr>
		      </table>
      </div>
      <div id="rightcol">
        <h3>Help</h3>
        <p>
<?
         	   echo "Silahkan upload file yang anda inginkan dan isi Nomor Dokumen (jika ada).";
         	   echo "<BR><BR>";
         	   echo "Klik tombol 'SUBMIT'";
         	   echo "<BR><BR>";
             echo "<b>STATUS UPLOAD :</b>";
             echo "<BR>";
	           $query = "SELECT doc_code, doc_name
	   		                FROM Tbl_DocType
	        	            WHERE doc_organization='$dmuserorganization'
	        	            $kondisialldoc
	        	            ORDER BY doc_code";
	           $result=mysql_query($query);
	           while($row=mysql_fetch_array($result))
	           {
                $querytemp = "SELECT COUNT(*), doc_id
	   		                    FROM Tbl_Document
	        	                WHERE doc_index3='$custnomid'
	        	                AND doc_type='$row[0]'";
	              $resulttemp=mysql_query($querytemp);
	              $rowtemp = mysql_fetch_row($resulttemp);
	              if ($rowtemp[0] <= 0)
	              {
	           	     echo "$row[1] ($rowtemp[0])";
	           	  }
	           	  else
	           	  {
	           	     echo "<A HREF=\"javascript:viewDetail('$rowtemp[1]')\">$row[1] ($rowtemp[0])</A>";
	           	  }
	           	  echo "<BR>";
	           }
	           echo "<BR>";
 		         echo "$msg";
?>
        </p>
      </div>
	        <input type=hidden name=dmuserid value='<? echo $dmuserid ?>'>
          <input type=hidden name=userpwd value='<? echo $userpwd ?>'>
          <input type=hidden name=username value='<? echo $username ?>'>
          <input type=hidden name=dmuserorganization value='<? echo $dmuserorganization ?>'>
          <input type=hidden name=act>
          <input type=hidden name=theid>
          <input type=hidden name=key value='<? echo $key ?>'>
          <input type=hidden name=dmbranchcode value='<? echo $dmbranchcode ?>'>
          <input type=hidden name=dmunitcode value='<? echo $dmunitcode ?>'>
          <input type=hidden name=dmstatusdoc value='<? echo $dmstatusdoc ?>'>
        </form>

<?
      }
    include("bottom.php");
?>
    </div>
  </body>
</html>
<?
exit;
}

function funcCreateDocID($thenumber){
		 $ascTable = "POIUYTREWQLKJHGFDSAMNBVCXZ1234567890qwertyuiopasdfghjklzxcvbnm";
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
