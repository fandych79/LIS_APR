<?php
# Copyright 2012
# Written by : PPC Team
# Leader     : Budi Hartoyo

$programact = "external_view2.php";
include ("Source/lib/open_con.php");
OpenConn();

$dmuserid=$_REQUEST['dmuserid'];
$userpwd=$_REQUEST['userpwd'];
$username=$_REQUEST['username'];
$dmuserorganization=$_REQUEST['dmuserorganization'];
$dmstatusdoc=$_REQUEST['dmstatusdoc'];
$act = "";
$msg = "";
$togo = -1;

if (isset($_POST['togo']))
{
	$togo = $_POST['togo'];
	$togo--;
}

if (isset($_REQUEST['act']))
{
	$act = $_REQUEST['act'];
}

if ($act == "signout")
{
	$act = "";
}

if ($act == "" || $act == "cek" || $act == "view" || $act == "zip")
{
	MAINPAGE();
}

function MAINPAGE()
{
	global $dmuserid;
	global $userpwd;
	global $username;
	global $dmuserorganization;
	global $dmstatusdoc;
	global $programact;
	global $act;
	global $msg;
	global $togo;
  $key=$_REQUEST['key'];
  $hasilsplit = explode("_", $key);
  $custnomid = $hasilsplit[1];
  $custcif = $hasilsplit[0];
  $thestring = $custnomid;

  $arrfield = array("File Name","File Index","File Folder","File CIF","File Desc","Hyperlink","File Type");
	$query = "SELECT SE_Program.program_name, SE_GrpProgram.grp_program_name
            FROM SE_Program, SE_GrpProgram
            WHERE SE_Program.grp_program_code=SE_GrpProgram.grp_program_code
            AND SE_Program.program_act='$programact'";
	$result=mysql_query($query);
	$row = mysql_fetch_row($result);
	$programtitle = "$row[1] >> $row[0]";
	$programtitle = "";

	$theid = "";
  if (isset($_POST['theid']))
  {
	  $theid = $_POST['theid'];
  }  
	
  $kondisisearchby = "AND doc_index3='$custnomid'";
  $ketsearchby = "in All Field";

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
	        	                AND doc_user_upload='$dmuserid'
	        	                $kondisisearchby";
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
	        	                AND doc_user_upload='$dmuserid'
	        	                $kondisisearchby";
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
    <link rel="shortcut icon" href="Source/img/favicon.ico" type="image/x-icon">
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
  <body id="tuts">
    <div id="wrapper">
      <div id="maincontent">
      	  <BR>
          <font size=2><b><? echo $msg ?></b></font>
<?	
    if ($act == "cek")
    {
    	  $pagelimit = 10;
    	  $pagenumber = 1;
        if (isset($_POST['pagenumber']))
        {
    	     $pagenumber = $_POST['pagenumber'];
    	  }    	  
    	  $totalpage = ceil($thecount / $pagelimit);
    	  $startlimit = $pagelimit * ($pagenumber-1);
?>
      	<form name=formcek method=post>
      		<table width=100% cellpadding=0 cellspacing=0 border=0>
      			<tr>
      				<td width=90% align=left valign=top>
      		      <font size=2>PAGE :
<?
              for ($hitpage=1;$hitpage<=$totalpage;$hitpage++)
              {
          	    if ($hitpage == $pagenumber)
          	    {
          	        echo "<b>$hitpage</b> ";
          	    }
          	    else
          	    {
          	       echo "<A HREF=\"javascript:gotoPage('$hitpage')\">$hitpage</A> ";
          	    }
              }
?>
          </font>
      				</td>
      				<td width=10% align=right valign=top>
      					 <font size=2><b><? echo $pagenumber ?>/<? echo $totalpage ?></b></font>
      				</td>
      			</tr>
      		</table>
		      <table width=100% cellpadding=5 cellspacing=5 border=0>
<?
	        $query = "SELECT doc_ext,doc_file_original,doc_user_upload,
                      doc_desc,doc_file_masking, DATE_FORMAT(doc_uploaded,'%d %b %y %H:%i:%m'), 
                      doc_id, doc_size, doc_index4, doc_storage,
                      doc_view_web, doc_index3
	   		              FROM Tbl_Document
	        	          WHERE doc_sticky_notes='$dmuserorganization'
	        	          AND doc_user_upload='$dmuserid'
	        	          $kondisisearchby
	        	          ORDER BY doc_uploaded DESC
	        	          LIMIT $startlimit,$pagelimit";
	        $result=mysql_query($query);
	        while($row=mysql_fetch_array($result))
	        {
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
             $arrviewweb = explode(",",$row[10]);
             $drawername = "";
             $querytemp = "SELECT cabinet_name
	   		                    FROM Tbl_Cabinet
	        	                WHERE cabinet_code='$arrviewweb[1]'
	        	                AND cabinet_organization='$dmuserorganization'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           $drawername .= "/[<font color=red>$rowtemp[0]</font>]";
             $querytemp = "SELECT drawer_name
	   		                    FROM Tbl_Drawer
	        	                WHERE drawer_code='$arrviewweb[2]'
	        	                AND drawer_organization='$dmuserorganization'
	        	                AND drawer_cabinet_code='$arrviewweb[1]'";
	           $resulttemp=mysql_query($querytemp);
	           $rowtemp = mysql_fetch_row($resulttemp);
	           $drawername .= "/[<font color=blue>$rowtemp[0]</font>]/<font color=blue>$row[11]</font>";

?>
			      <tr>
			 	       <td width=10% align=center valign=top>
			 	       	  <img src='<? echo $varimg ?>' border="0" width="64" height="64">
			 	       </td> 
			 	       <td width=85% align=left valign=top>
			 	       	 <font size=2>
			 	       	 File Name : <A HREF="javascript:viewDetail('<? echo $row[6] ?>')"><? echo $row[1] ?></A> 
			 	       	 
                 <BR>
                 Description Key : <?=$row[3];?>
                 </font>
			 	       </td> 
			      </tr>
<?
	        }
?>
		      </table>
	        <input type=hidden name=userid value='<? echo $userid ?>'>
          <input type=hidden name=userpwd value='<? echo $userpwd ?>'>
          <input type=hidden name=username value='<? echo $username ?>'>
          <input type=hidden name=userorganization value='<? echo $dmuserorganization ?>'>
          <input type=hidden name=act>
          <input type=hidden name=theid>
          <input type=hidden name=pagenumber>
          <input type=hidden name=thecount value=<? echo $thecount ?>>
          <input type=hidden name=thestring value=<? echo $thestring ?>>
          <input type=hidden name=searchby value=<? echo $searchby ?>>
          <input type=hidden name=searchdrawer value=<? echo $searchdrawer ?>>
        </form>
<?
    }
    if ($act == "view")
    {
?>
      	<form name=formview method=post>
<?
          $kondisisearchby = "";
          if ($dmstatusdoc != "")
          {
              $hasilsplit = explode(",", $dmstatusdoc);
        	    for ($zz=0;$zz<count($hasilsplit)-1;$zz++)
        	    {
        	    	$kondisisearchby .= "Tbl_Document.doc_type='$hasilsplit[$zz]' OR ";
        	    }
        	}
        	if ($kondisisearchby != "")
        	{
        		  $kondisisearchby = "AND (" . substr($kondisisearchby,0,strlen($kondisisearchby)-3) . ")";
        	}

	        $querytemp = "SELECT Tbl_DocType.doc_name, Tbl_Document.doc_id, Tbl_Document.doc_index2
	   		                FROM Tbl_Document, Tbl_DocType
	        	            WHERE Tbl_DocType.doc_code=Tbl_Document.doc_index1
	        	            AND Tbl_Document.doc_sticky_notes='$dmuserorganization'
	        	            AND Tbl_Document.doc_index3='$custnomid'
	        	            $kondisisearchby
	        	            ORDER BY Tbl_Document.doc_index1";
							//echo $querytemp;
	        $resulttemp=mysql_query($querytemp);
	        while($rowtemp=mysql_fetch_array($resulttemp))
	        {
	                  if ($theid == "")
	                  {
	                  	 	  $theid = $rowtemp[1];
	                  }
	               	  if ($rowtemp[1] == $theid)
	               	  {
	                     echo "<font face=Verdana size=2><B>$rowtemp[0]</B></font> &nbsp";
	                  }
	                  else
	                  {
	                     echo "<A HREF=\"javascript:gotoDoc('$rowtemp[1]')\"><font face=Verdana size=2>$rowtemp[0]</font></A> &nbsp";
	                  }
	        }
	       echo "<A HREF=\"javascript:gotoDoc('')\"><font face=Verdana size=2>refresh</font></A>";

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
	        
			$bisalihat="";
	        if ($theid == "")
	        {
	        	 echo "<font face=Verdana size=2>Belum Ada Foto Yang Diupload</font>";
	        	 echo "&nbsp &nbsp";
	        	 echo "<A HREF=\"javascript:gotoDoc('')\"><font face=Verdana size=2>refresh</font></A>";
	        }
	        else
	        {
?>
		      <table width=100% cellpadding=5 cellspacing=0 border=0>
<?
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
			 	       	 <font face=Verdana size=3>
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
                 Doc # / Title : <?=$row[13];?>
                 </font>
			 	       </td> 
			      </tr>
		      </table>
<?
	        }
?>
	        <input type=hidden name=dmuserid value='<? echo $dmuserid ?>'>
          <input type=hidden name=userpwd value='<? echo $userpwd ?>'>
          <input type=hidden name=username value='<? echo $username ?>'>
          <input type=hidden name=dmuserorganization value='<? echo $dmuserorganization ?>'>
          <input type=hidden name=togo value='<? echo $togo ?>'>
          <input type=hidden name=key value='<? echo $key ?>'>
          <input type=hidden name=dmstatusdoc value=<? echo $dmstatusdoc ?>>
          <input type=hidden name=act>
          <input type=hidden name=theid>
        </form>
        <BR>
<?
         if ($bisalihat == "Y")
         {
            if ($extview != "")
            {
				echo "<img src='$fileshow' width='700px' height='500px'></img>";
         	     //echo "<IFRAME WIDTH=900 HEIGHT=600 MARGINWIDTH=0 MARGINHEIGHT=0 HSPACE=0 VSPACE=0 FRAMEBORDER=0 SCROLLING=yes SRC='$fileshow'></iframe>";
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
         echo "<BR><BR>";
    }
?>
      </div>
    </div>
  </body>
</html>
<?
exit;
}