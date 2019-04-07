<?php
# Copyright 2012
# Written by : PPC Team
# Leader     : Budi Hartoyo

$programact = "external_query.php";
include ("Source/lib/open_con.php");
OpenConn();

$dmuserid=$_POST['dmuserid'];
$userpwd=$_POST['userpwd'];
$username=$_POST['username'];
$dmuserorganization=$_POST['dmuserorganization'];
$dmstatusdoc=$_POST['dmstatusdoc'];
$act = "";
$msg = "";
$togo = -1;

if (isset($_POST['togo']))
{
	$togo = $_POST['togo'];
	$togo--;
}

if (isset($_POST['act']))
{
	$act = $_POST['act'];
}

if ($act == "signout")
{
	$act = "";
}

if ($act == "" || $act == "cek" || $act == "view" || $act == "zip")
{
	MAINPAGE();
}

if ($act == "deldoc")
{
	$theid = $_POST['theid'];
  $arrtheid = explode("~",$theid);
  $subfolder = end(explode("/",substr($arrtheid[2],0,strlen($arrtheid[2])-1)));
  $arrdrawer = explode(",",$arrtheid[3]);

  if ($subfolder != "" && $arrtheid[0] != "" && $arrtheid[1] != "" && $arrtheid[3] != "")
  {
     $querytemp = "SELECT control_value
	   		                    FROM SE_UserControl
	        	                WHERE control_id='ctrlsavefolder'
	        	                AND control_organization='$dmuserorganization'";
	   $resulttemp=mysql_query($querytemp);
	   $rowtemp = mysql_fetch_row($resulttemp);
	   $mainstorage = $rowtemp[0] . "/" . $subfolder . "/" . $arrtheid[1];
	   unlink($mainstorage);

     $tsql="DELETE FROM Tbl_Document
            WHERE doc_id='$arrtheid[0]'
            AND doc_sticky_notes='$dmuserorganization'
            AND doc_file_masking='$arrtheid[1]'";
   	 $tresult=mysql_query($tsql);

     $tsql="UPDATE Tbl_Cabinet set cabinet_count=cabinet_count-1
             WHERE cabinet_code='$arrdrawer[1]'
             AND cabinet_organization='$dmuserorganization'";
   	 $tresult=mysql_query($tsql);

     $tsql="UPDATE Tbl_Drawer set drawer_count=drawer_count-1
             WHERE drawer_code='$arrdrawer[2]'
             AND drawer_organization='$dmuserorganization'
             AND drawer_cabinet_code='$arrdrawer[1]'";
   	 $tresult=mysql_query($tsql);
  }

  $msg = "Document has been <font color=red>DELETED</font>.<BR>Please CLOSE this WINDOW";
	$act = "";
	MAINPAGE();
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
	global $dmstatusdoc;
	global $togo;

  $arrfield = array("File Name","File Index","File Folder","File CIF","File Desc","Hyperlink","File Type");
	$query = "SELECT SE_Program.program_name, SE_GrpProgram.grp_program_name
            FROM SE_Program, SE_GrpProgram
            WHERE SE_Program.grp_program_code=SE_GrpProgram.grp_program_code
            AND SE_Program.program_act='$programact'";
	$result=mysql_query($query);
	$row = mysql_fetch_row($result);
	$programtitle = "$row[1] >> $row[0]";
	
	$thestring = "";
	$searchby = "";
	$searchdrawer = "";
	$theid = "";
	$drawerid = "";
	$drawername = "";

  if (isset($_POST['thestring']))
  {
	  $thestring = $_POST['thestring'];
  }
  if (isset($_POST['searchby']))
  {
	  $searchby = $_POST['searchby'];
  }
  if (isset($_POST['searchdrawer']))
  {
	  $searchdrawer = $_POST['searchdrawer'];
    $arrdrawer = explode(",",$searchdrawer);
    $drawerid = $arrdrawer[0];
    $drawername = $arrdrawer[1];
  }
  if (isset($_POST['theid']))
  {
	  $theid = $_POST['theid'];
  }
  
  $kondisidrawer = "";
  $ketdrawer = "at All Drawer";
  if ($drawerid != "")
  {
  	$kondisidrawer = "AND doc_view_web like '%$drawerid%'";
  	$ketdrawer = "at $drawername";
  }
  
  $kondisisearchby = "";
  $ketsearchby = "in All Field";
  if ($searchby == "")
  {
  	$kondisisearchby = "AND (Tbl_Document.doc_file_original like '%$thestring%'";
  	$kondisisearchby .= "OR Tbl_Document.doc_index1 like '%$thestring%' or Tbl_Document.doc_index2 like '%$thestring%'  or Tbl_Document.doc_index3 like '%$thestring%' or Tbl_Document.doc_index4 like '%$thestring%' or Tbl_Document.doc_index5 like '%$thestring%'";
  	$kondisisearchby .= "OR Tbl_Document.doc_desc like '%$thestring%')";
  }
  if ($searchby == "filename")
  {
  	$kondisisearchby = "AND Tbl_Document.doc_file_original like '%$thestring%'";
    $ketsearchby = "in Filename";
  }
  if ($searchby == "fileindex")
  {
  	$kondisisearchby = "AND (Tbl_Document.doc_index1 like '%$thestring%' or Tbl_Document.doc_index2 like '%$thestring%')";
    $ketsearchby = "in Fileindex";
  }
  if ($searchby == "filefolder")
  {
  	$kondisisearchby = "AND (Tbl_Document.doc_index3 like '%$thestring%')";
    $ketsearchby = "in File Folder";
  }
  if ($searchby == "filecif")
  {
  	$kondisisearchby = "AND (Tbl_Document.doc_index5 like '%$thestring%')";
    $ketsearchby = "in File CIF";
  }
  if ($searchby == "filedesc")
  {
  	$kondisisearchby = "AND Tbl_Document.doc_desc like '%$thestring%'";
    $ketsearchby = "in File Description";
  }
  if ($searchby == "hyperlink")
  {
  	$kondisisearchby = "AND (Tbl_Document.doc_index4 like '%$thestring%')";
    $ketsearchby = "in Hyperlink";
  }
  if ($searchby == "filetype")
  {
  	$kondisisearchby = "AND (Tbl_Document.doc_view_web like '%$thestring%')";
    $ketsearchby = "in File Type";
  }

  $statustoggle = "block";
  $statusexpand = "xpcollapse2.gif";
  $thecount = 0;
	if ($act == "cek")
	{
     if (isset($_POST['thecount']))
     {
	     $thecount = $_POST['thecount'];
     }
     
     if ($thecount <= 0)
     {
        $querytemp = "SELECT COUNT(*)
	   		                    FROM Tbl_Document
	        	                WHERE doc_sticky_notes='$dmuserorganization'
	        	                $kondisisearchby
	        	                $kondisidrawer";
	      $resulttemp=mysql_query($querytemp);
	      $rowtemp = mysql_fetch_row($resulttemp);
	      $thecount = $rowtemp[0];
	      if ($thecount <= 0)
	      {
		      $act = "";
		      $msg = "String <font color=red>'$thestring'</font> not found <font color=blue>$ketsearchby</font> <font color=red>$ketdrawer</font>";
	      }
	      if ($thecount == 1)
	      {
           $querytemp = "SELECT doc_id
	   		                    FROM Tbl_Document
	        	                WHERE doc_sticky_notes='$dmuserorganization'
	        	                $kondisisearchby
	        	                $kondisidrawer";
	         $resulttemp=mysql_query($querytemp);
	         $rowtemp = mysql_fetch_row($resulttemp);
	         $theid = $rowtemp[0];

		       $act = "view";
           $statustoggle = "none";
           $statusexpand = "xpexpand2.gif";
	      }
	      if ($thecount > 1)
	      {
		      $msg = "String <font color=red>'$thestring'</font> found <font color=red>$thecount</font> item(s) <font color=blue>$ketsearchby</font> <font color=red>$ketdrawer</font>";
	      }
     }
     else
     {
		      $msg = "String <font color=red>'$thestring'</font> found <font color=red>$thecount</font> item(s) <font color=blue>$ketsearchby</font> <font color=red>$ketdrawer</font>";
     }
	}
	
	if ($act == "view")
	{
        $statustoggle = "none";
        $statusexpand = "xpexpand2.gif";
	}
	

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
            document.images[idContainer + 'imgGrp' + idGrp].src = (vis == 'none') ? 'Source/img/xpexpand2.gif' : 'Source/img/xpcollapse2.gif';
        }
    	function viewDetail(theid)
    	{
    		document.formcek.theid.value = theid;
    		document.formcek.act.value = "view";
    		document.formcek.submit();
    	}
    	function cekdel(theid)
    	{
    		document.formview.theid.value = theid;
    		document.formview.act.value = "deldoc";
        document.formview.action = "./<? echo $programact ?>";
        varmsg = "WARNING !!\nAre your sure to DELETE this document ?";
        submitform = window.confirm(varmsg)           
        if (submitform == true)
        {
		       document.formview.submit();
        }
    	}
    	function gotoDoc(theid)
    	{
    		document.formview.theid.value = theid;
    		document.formview.act.value = "view";
        document.formview.action = "./<? echo $programact ?>";
		       document.formview.submit();
    	}
    	function gotoPage(theid)
    	{
    		document.formcek.pagenumber.value = theid;
    		document.formcek.act.value = "cek";
    		document.formcek.submit();
    	}
    </Script>
  </head>
  <body id="tuts" onload=document.formsubmit.thestring.focus()>
    <div id="wrapper">
<?
   include("menu.php");
?>
      <div id="maincontent">
      	  <table width=100% cellpadding=0 cellspacing=0 border=0>
      	  	<tr>
      	  		<td width=80% align=left valign=top>
      	  			<h3><? echo $programtitle ?></h3>
      	  		</td>
      	  		<td width=20% align=right valign=top>
      	  			<A HREF="javascript:history.go(<? echo $togo ?>);"><font face=Verdana size=2>Back</font></A>
      	  		</td>
      	  	</tr>
      	  </table>
          <font size=2><b><? echo $msg ?></b></font>
<?	
    if ($act == "view")
    {
?>
      	<form name=formview method=post>
<?
	        $query = "SELECT doc_ext,doc_file_original,doc_user_upload,
                      doc_desc,doc_file_masking, DATE_FORMAT(doc_uploaded,'%d %b %y %H:%i:%m'), 
                      doc_id, doc_size, doc_index4, doc_storage,
                      doc_view_web, doc_index3, doc_index1, doc_index2,
                      doc_index5
	   		              FROM Tbl_Document
	        	          WHERE doc_sticky_notes='$dmuserorganization'
	        	          AND doc_id='$theid'";
	        $result=mysql_query($query);
	        $row = mysql_fetch_row($result);
          $arrviewweb = explode(",",$row[10]);
          $fileshow = $row[9] . $row[4] . "." . $arrviewweb[0];
          $fileshow = $row[9] . $row[4];
          $custnomid = $row[11];

          if ($dmstatusdoc != "")
          {
              $hasilsplit = explode(",", $dmstatusdoc);
        	    for ($zz=0;$zz<count($hasilsplit)-1;$zz++)
        	    {
                 $querytemp = "SELECT Tbl_DocType.doc_name, Tbl_Document.doc_id, Tbl_Document.doc_index2
	   		                    FROM Tbl_Document, Tbl_DocType
	        	                WHERE Tbl_DocType.doc_code=Tbl_Document.doc_index1
	        	                AND Tbl_Document.doc_index3='$custnomid'
	        	                AND Tbl_Document.doc_type='$hasilsplit[$zz]'";
	               $resulttemp=mysql_query($querytemp);
	               $rowtemp = mysql_fetch_row($resulttemp);
	               if ($rowtemp[0] != "")
	               {
	               	  if ($rowtemp[1] == $theid)
	               	  {
	                     echo "<font face=Verdana size=2><b>$rowtemp[0]</b></font> &nbsp";
	                  }
	                  else
	                  {
	                     echo "<A HREF=\"javascript:gotoDoc('$rowtemp[1]')\"><font face=Verdana size=2>$rowtemp[0]</font></A> &nbsp";
	                  }
	               }
        	    }
          }

             $drawername = "";
             $querytemp = "SELECT cabinet_name
	   		                    FROM Tbl_Cabinet
	        	                WHERE cabinet_code='$arrviewweb[1]'
	        	                AND cabinet_organization='$dmuserorganization'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           $drawername .= "/[<font color=red>$rowtemp[0]</font>]";
             $querytemp = "SELECT drawer_name, drawer_code
	   		                    FROM Tbl_Drawer
	        	                WHERE drawer_code='$arrviewweb[2]'
	        	                AND drawer_organization='$dmuserorganization'
	        	                AND drawer_cabinet_code='$arrviewweb[1]'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           $cekdrawer = $rowtemp[1];
	           $drawername .= "/[<font color=blue>$rowtemp[0]</font>]/<font color=blue>$row[11]</font>";

             $querytemp = "SELECT COUNT(*)
	   		                    FROM SE_UserStorage
	        	                WHERE user_id='$dmuserid'
	        	                AND drawer_code='$cekdrawer'
	        	                AND drawer_access='R'
	        	                AND user_organization='$dmuserorganization'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           if ($rowtemp[0] <= 0)
	           {
	           	  $bisalihat = "N";
	           	  $drawername .= "<b> <font color=red>Access Denied</font></b>";
	           }
	           else
	           {
	           	  $bisalihat = "Y";
	           }      

             $extview = "";
             $querytemp = "SELECT ext_view
	   		                    FROM Tbl_DocExtension
	        	                WHERE ext_name='$row[0]'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           $extview = $rowtemp[0];

	           $varimg = "Source/img/template/" . str_replace("/","",$row[0]) . ".jpg";
	           if (!file_exists($varimg))
	           {
	              $varimg = "Source/img/template/" . "undefined_category" . ".jpg";
	           }

             $docuseruplod = "";
             $querytemp = "SELECT user_name
	   		                    FROM SE_User
	        	                WHERE user_id='$row[2]'
	        	                AND user_organization='$dmuserorganization'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           if ($rowtemp[0] != "")
	           {
	   	          $docuserupload = $rowtemp[0];
	           }
?>
		      <br><br>
		      <table width=100% cellpadding=5 cellspacing=0 border=0>
			      <tr>
			 	       <td width=10% align=center valign=top>
<?
                if ($extview == "")
                {
                	 echo "<img src='$varimg' border='0' width='64' height='64'>";
                }
                else
                {
                	 echo "&nbsp";
                }
?>			 	       	  
			 	       </td> 
			 	       <td width=85% align=left valign=top>
			 	       	 <font size=2>
<?
               if ($bisalihat == "Y")
               {
			 	       	  echo "File Name : <A HREF='$fileshow'>$row[1]</A> [" . number_format($row[7]) . " bytes] - $row[0]";
               }
               else
               {
			 	       	  echo "File Name : $row[1] [" . number_format($row[7]) . " bytes] - $row[0]";
               }
?>
			 	       	 <BR>
                 Uploader : <?=$docuserupload;?> @ <? echo $row[5] ?>&nbsp;
			 	       	 <BR>
                 Cabinet : <?=$drawername;?>&nbsp;
                 <BR>
                 CIF : <?=$row[14];?>
                 <BR>
                 Hyperlink : <A HREF='<? echo $row[8] ?>' target=new><?=$row[8];?></A>
                 <BR>
                 Document Type : <?=$row[12];?>
                 <BR>
                 Doc # / Title : <?=$row[13];?>
                 <BR>
                 Description Key : <?=$row[3];?>
                 </font>
<?
         if ($bisalihat == "Y")
         {
            if ($dmuserid == $row[2])
            {
            	 echo "<BR><BR>";
               echo "<input type=button value='DELETE' style='width:35mm;' class=red onclick=\"javascript:cekdel('$row[6]~$row[4]~$row[9]~$row[10]')\">";
            }
         }
?>
			 	       </td> 
			      </tr>
		      </table>
	        <input type=hidden name=dmuserid value='<? echo $dmuserid ?>'>
          <input type=hidden name=userpwd value='<? echo $userpwd ?>'>
          <input type=hidden name=username value='<? echo $username ?>'>
          <input type=hidden name=dmuserorganization value='<? echo $dmuserorganization ?>'>
          <input type=hidden name=dmstatusdoc value='<? echo $dmstatusdoc ?>'>
          <input type=hidden name=togo value='<? echo $togo ?>'>
          <input type=hidden name=act>
          <input type=hidden name=theid>
        </form>
        <BR>
<?
         if ($bisalihat == "Y")
         {
            if ($extview != "")
            {
         	     echo "<IFRAME WIDTH=870 HEIGHT=600 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=1 SCROLLING=yes SRC='$fileshow'></iframe>";
/*         	   if ($extview == "PDF")
         	     {
         	        echo "<IFRAME WIDTH=870 HEIGHT=600 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=1 SCROLLING=yes SRC='$fileshow'></iframe>";
         	     }
         	     else
         	     {
         	        echo "<IFRAME WIDTH=870 HEIGHT=600 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=1 SCROLLING=yes SRC='$fileshow'></iframe>";
 //         	     echo "<IFRAME WIDTH=870 HEIGHT=600 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=1 SCROLLING=yes SRC=./utildisplay.php?dmuserid=$dmuserid&userpwd=$userpwd&dmuserorganization=$dmuserorganization&extview=$extview&fileshow=$fileshow></iframe>";
         	     }*/
               echo "<BR><BR>";
            }
            else
            {
         	     echo "The browser cannot display this file inline. You must download to view in your computer.";
         	     echo "<BR><BR>";
         	     echo "Click link to Download : <A HREF='$fileshow'>$row[1]</A>";
               echo "<BR><BR>";
            }            
         }
         else
         {
         	     echo "You dont have privilege to access this drawer :";
         	     echo "<BR>";
         	     echo "$drawername";
         }
         echo "<BR><BR>";
    }
?>
      </div>
<?
    include("bottom.php");
?>
    </div>
  </body>
</html>
<?
exit;
}