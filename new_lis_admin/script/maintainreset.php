<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $act = "";
  if (isset($_POST['act']))
  {
  	$act = $_POST['act'];
  }
  $thestring = "";
  if (isset($_POST['thestring']))
  {
  	$thestring = strtolower($_POST['thestring']);
  }
  $userprogramact="maintainreset.php";

   require ("../lib/open_con.php");

  $userprogramcode = "";
	$tsql = "SELECT programcode,programact FROM Tbl_ProgramAdmin WHERE programact like '%$userprogramact%'";
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
   			$datafield=explode("<q>",$row[1]);
   			if ($datafield[1] == $userprogramact)
   			{
   		   $userprogramcode = $row[0];
   			}
      }
   }
   sqlsrv_free_stmt( $sqlConn );

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


   if ($act == "" || $act == "cek" || $act == "editdata")
   {
      MAIN();
   }


function MAIN()
{
   require ("../lib/open_con.php");
  global $userid;
  global $userpwd;
  global $act;
  global $thestring;
  global $userprogramcode;
  $theuserid = "";
  if (isset($_POST['theuserid']))
  {
  	$theuserid = $_POST['theuserid'];
  }
  $thestatusuid = "";
  if (isset($_POST['thestatusuid']))
  {
  	$thestatusuid = $_POST['thestatusuid'];
  }

// PROFILE
  $profilebranchcode = "";
	$tsql = "SELECT user_branch_code FROM Tbl_SE_User 
										WHERE user_id='$userid'";
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
   		$profilebranchcode = $row[0];
    }
  }
  sqlsrv_free_stmt( $sqlConn );

// END PROFILE
  
  $kondisistring = "";
  if ($thestring != "0")
  {
  	$kondisistring = "AND Tbl_SE_User.user_id like '%$thestring%' or Tbl_SE_User.user_name like '%$thestring%'";
  }

	$thecount = 0;
	$tsql = "SELECT COUNT(*) FROM Tbl_SE_User 
						WHERE user_id<>''
										$kondisistring";
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
 
  if ($thecount == 1)
  {
//  	$act = "editdata";
		$tsql = "SELECT user_id FROM Tbl_SE_User 
							WHERE user_id<>''
										$kondisistring";
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
   					$theuserid = $row[0];
    	}
  	}
  	sqlsrv_free_stmt( $sqlConn );
  					$thestatusuid = "upd";
  }

  if ($act == "editdata")
  {
    $varbutton = "";
  	$varfocus = "document.formsubmit.newuserpwd.focus()";
  	if ($thestatusuid == "upd")
  	{
  		$varfocus .= ";viewDetail()";
  		$varbutton = "<input type=button value='Edit' onClick=goSave('U')>&nbsp &nbsp &nbsp <input type=button value='Reset Login Nyangkut' onClick=goNyangkut()><BR><BR><input type=button value='Reset Login Attempt / Maksimum Login' onClick=goReset()>";
  	}
  	else
  	{
  		$varbutton = "<input type=button value='Create' onClick=goSave('N')>&nbsp &nbsp<input type=button value='Clear Field' onClick=goNew()>";
  	}
  }
  else
  {
  	$varfocus = "document.formsubmit.thestring.focus()";
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
      	function editData(theuserid,thestatusuid)
      	{
      		document.formcari.theuserid.value = theuserid;
      		document.formcari.thestatusuid.value = thestatusuid;
           document.formcari.target = "utama";
           document.formcari.submit();
      	}
<?
	if ($act == "editdata")
	{
   $tempfield = "";
   $countfield = 0;
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_SE_User'";
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
      	$countfield++;
      	 $tempfield .= $row['COLUMN_NAME'] . ",";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   $datafield=explode(",",$tempfield);

   $tsql = "SELECT * FROM Tbl_SE_User
   					WHERE user_id='$theuserid'";
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
         $vartemp = "var D" . $row['user_id'] . "=  new Array(";
        for ($zz=0;$zz<$countfield;$zz++)
        {
				  $aa = substr($datafield[$zz],strlen($datafield[$zz])-11);
        	if ($aa <> "create_time")
        	{
				    $aa = $row[$datafield[$zz]];
						$vartemp .= "\"'" . $aa . "'\",";
        	}
        	else
        	{
        		$aa = date('Y-m-d H:m:s');
						$vartemp .= "\"'" . $aa . "'\",";
          }
        }
   			  $tsql2 = "SELECT *
						        FROM Tbl_SE_UserProgram
						        WHERE user_id='$row[user_id]'
						        ORDER BY user_permissions,program_code";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      		   $vartemp2 = "\"'" . "002:005:";
      		   $vartemp3 = "\"'" . "002:005:";
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
      		   	  if ($row2['user_permissions'] == "00")
      		   	  {
							     $vartemp2 .= $row2['program_code'] . ",";
							  }
							  else
							  {
#							     $vartemp2 .= "\"'" . $row2['program_code'] . ":" . $row2['program_code'] . ":" . $row2['program_code'] . ":" . "~" . "'\",";
							     $vartemp3 .= $row2['program_code'] . "/" . $row2['user_permissions'] . ",";
							  }
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
				$vartemp2 .= "~'\",";
				$vartemp3 .= "~'\",";
        $vartemp .= $vartemp3 . $vartemp2 . "'');";
?>
				    <? echo $vartemp; ?>

<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
        function viewDetail()
        {
        	  goNew();
	   	      var selectedArray = eval("D" + document.formsubmit.newuserid.value);
	   		    eval("document.formsubmit.newuserid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newuserpwd.value=" + selectedArray[9]);
	   		    eval("document.formsubmit.backuserpwd.value=" + selectedArray[9]);
        }
        function goNew()
        {
	   		    document.formsubmit.newuserpwd.value="";
        }
        function viewOther(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewother";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
        function viewTrustee(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewtrustee";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
        function viewChild(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewchild";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
        function viewHirarki(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewhirarki";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "./utilview.php";
           if (thewindow != "smallwindow")
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('./utilview.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
        function cekHistory(thefield,thebackup,thenew)
        {
				   	   if (thebackup != thenew)
				   	   {
				   	   	  document.formsubmit.actionhistory.value = document.formsubmit.actionhistory.value + thefield + thebackup + " >> " + thenew + "//";
				   	   }
        }
        function cekSpecialChar(thetitle,thefield)
        {
					 var iChars = "! @#$%^&*()+=-[]\\\';,./{}|\":<>?";
           for (var i = 0; i < eval(thefield + ".value.length"); i++)
           {
								if (iChars.indexOf(eval(thefield + ".value.charAt(i)")) != -1) 
								{
										alert (thetitle + " tidak boleh menggunakan spesial karakter / spasi");
										eval(thefield + ".focus()");
										return false;
								}
           }
           return true;
        }
        function goSave(theid)
        {
        	 document.formsubmit.actionhistory.value = "";
           var Money ="0123456789.";
				   if (document.formsubmit.newuserpwd.value == "")
				   {
				   	   alert("Please fill User Password");
				   	   document.formsubmit.newuserpwd.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserpwd.value.length < 8)
				   {
				   	   alert("User Password less than 8 digit");
				   	   document.formsubmit.newuserpwd.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("User Password : ",document.formsubmit.backuserpwd.value,document.formsubmit.newuserpwd.value);
				   }
           if (document.formsubmit.actionhistory.value == "")
           {
              alert("Anda Belum Melakukan Perubahan Apapun");
              return false;
           }
           else
           {
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "save";
           		document.formsubmit.action = "./domaintainreset.php";
           		varmsg = "Are your sure to SAVE ? Perubahan Terhadap Password : " + "\n" + document.formsubmit.newuserpwd.value + "\n";
           		submitform = window.confirm(varmsg)           
           		if (submitform == true)
           		{
		              document.formsubmit.submit();
           		}
           }
        }
        function goReset()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "reset";
           document.formsubmit.action = "./domaintainreset.php";
           submitform = window.confirm("Are your sure to RESET Login Attempt User " + document.formsubmit.newuserid.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goNyangkut()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "nyangkut";
           document.formsubmit.action = "./domaintainreset.php";
           submitform = window.confirm("Are your sure to RESET Login Nyangkut User " + document.formsubmit.newuserid.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainreset.php";
           submitform = window.confirm("Are your sure to DELETE User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
           	  document.formsubmit.newusertrustee.disabled = false;
           	  document.formsubmit.newuserother.disabled = false;
              document.formsubmit.submit();
           }
        }
        function chgProfile()
        {
        	if (document.formsubmit.newuserprofile.options[document.formsubmit.newuserprofile.selectedIndex].value == "cLr")
        	{
               document.formsubmit.newusertrustee.value = "";
               document.formsubmit.newuserother.value = "";
          }
		      else
		      {
            vardata = document.formsubmit.newuserprofile.options[document.formsubmit.newuserprofile.selectedIndex].text.split('~~');
            if(vardata.length > 1)
            {
               vartemp = vardata[1].split('|');
               document.formsubmit.newusertrustee.value = vartemp[0];
               document.formsubmit.newuserother.value = vartemp[1];
            }
		      }
        }
<?
  }
?>
      </Script>
   </head>
    <body style="background:url(../images/Background%20Mega.png) no-repeat center;" link=blue alink=blue vlink=blue onload=<? echo $varfocus ?>>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>
   	   <div align=center>



<table style="background-color:#;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
   	      	<tr>
   	      		<td width=100% align=left valign=top>
   	      			<form name=formsec method=post>
  							   <input type=hidden name=userid value=<? echo $userid; ?>>
  					  	   <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	      			</form>
     	   	       <A HREF="javascript:changeMenu('../../menu.php')"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      	</tr>
   	      	<tr>
   	      		<td width=100% align=center valign=top>
   	      			<font face=Arial size=3><b>RESET PASSWORD - AKSES ANDA : <? echo $profilebranchcode ?></b></font>
<?
					if ($act == "editdata")
					{
						if (strtolower(substr($theuserid,1-1,5)) == "admin")
						{
							echo "<BR>";
							echo "<b><font face=Arial size=3 color=red>Tidak Boleh MENDAFTARKAN / MENGEDIT User ID dengan 5 huruf pertama '<font color=blue size=4>admin</font>'</font></font>";
							exit;
						}
						if ($thestatusuid == "new")
						{
							echo "<b><font face=Arial size=2 color=red>[PENDAFTARAN USER ID BARU : <font color=blue>$theuserid</B>]</font></font>";
						}
						else
						{
							echo "<b><font face=Arial size=2 color=red>[EDIT USER ID : <font color=blue>$theuserid</B>]</font></font>";
						}
					}
?>   	  	      	 
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
<?
// SEARCH
				if ($act != "editdata")
				{
?>
   	  	      		<form name=formsubmit method=post action=./maintainreset.php>
                  	   <font face=Arial style="font-size: 10;">Search UID / UName :</font> &nbsp
                  	   <input type=text name=thestring size=50 maxlength=60 style="background-color:#FF0">
                  	   <input type=submit value='Search' style="width: 40mm;" onclick="javascript:findString(0);">
                  	   <font face=Arial style="font-size: 10;">0 = search all</font> &nbsp
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   </table>
    								 <input type=hidden name=act value='cek'>
										  <input type=hidden name=userid value=<? echo $userid; ?>>
										  <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	  	      		</form>
<?
			  }
// END SEARCH
// CHECK
				if ($act == "cek")
				{
					echo "<hr size=2 color=blue>";
					echo "<form name=formcari method=post action=./maintainreset.php>";

   				if ($thecount <= 0)
   				{
//   					  echo "<BR><font face=Arial size=3>Tidak ditemukan user id  <b>%$thestring%</b></font>";
   				}
   				else
   				{
   			  			$tsql2 = "SELECT COUNT(*)
						    		    FROM Tbl_SE_User
						        		WHERE user_id='$thestring'";
          			$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  			$params2 = array(&$_POST['query']);
   		    			$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
								$custname = "&nbsp";
          			if ( $sqlConn2 === false)
      						die( FormatErrors( sqlsrv_errors() ) );

								$adakahuserini = 0;
   			  			if(sqlsrv_has_rows($sqlConn2))
   			  			{
      		   			$rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 			while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   			{
      		   				$adakahuserini = $row2[0];
      		   			}
   							}
   	      			sqlsrv_free_stmt( $sqlConn2 );
   	      			
   	      			if ($adakahuserini <= 0)
   	      			{
//   					  			echo "<BR><font face=Arial size=3>Tidak ditemukan user id  <b>%$thestring%</b></font>";
   	      			}

?>
   									<BR><font face=Arial size=3>User id  <b>%<? echo $thestring ?>%</b> ditemukan sebanyak <? echo $thecount ?> :</font>
   									<BR>;
   									<table width=100% cellpadding=0 cellspacing=0 border=1 bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#FFFFFF">
   								 		<tr>
   								 	  		<td width=20% align=center valign=top>
   								 	  			<font face=Arial size=2><b>USER ID</b></font>
   								 	  		</td>
   								 	  		<td width=30% align=center valign=top>
   								 	  			<font face=Arial size=2><b>USER NAME</b></font>
   								 	  		</td>
   								 	  		<td width=30% align=center valign=top>
   								 	  			<font face=Arial size=2><b>CABANG</b></font>
   								 	  		</td>
   								 	  		<td width=20% align=center valign=top>
   								 	  			<font face=Arial size=2><b>LEVEL</b></font>
   								 	  		</td>
   								 		</tr>
   					
<?
					  $tsql = "SELECT Tbl_SE_User.user_id, Tbl_SE_User.user_name, 
					  			Tbl_SE_User.user_branch_code, Tbl_SE_User.user_level_code
									FROM Tbl_SE_User
									WHERE user_id<>''
									$kondisistring
									ORDER BY Tbl_SE_User.user_branch_code";
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
      					$branchname = "";
      					$branchregioncode = "";
   			  			$tsql2 = "SELECT branch_name, branch_region_code
						    		    FROM Tbl_Branch
						        		WHERE branch_code='$row[2]'";
          			$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  			$params2 = array(&$_POST['query']);
   		    			$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
								$custname = "&nbsp";
          			if ( $sqlConn2 === false)
      						die( FormatErrors( sqlsrv_errors() ) );

   			  			if(sqlsrv_has_rows($sqlConn2))
   			  			{
      		   			$rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 			while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   			{
      		   				$branchname = $row2[0];
      							$branchregioncode = $row2[1];
      		   			}
   							}
   	      			sqlsrv_free_stmt( $sqlConn2 );

								$levelname = "";
   			  			$tsql2 = "SELECT level_name
						    		    FROM Tbl_SE_Level
						        		WHERE level_code='$row[3]'";
          			$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  			$params2 = array(&$_POST['query']);
   		    			$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
								$custname = "&nbsp";
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
   	      			$bisaakses = 0;
  	 						if (substr($profilebranchcode,1-1,1) == "8")
  	 						{
  	 	   					if ($profilebranchcode == "888")
  	 	   					{
  	 	   						$bisaakses = 1;
  	 	   					}
  	 	   					else
  	 	   					{
  	 	   						if ($branchregioncode == $profilebranchcode)
  	 	   						{
  	 	   						   $bisaakses = 1;
  	 	   						}
  	 	   					}
  	 						}
  	 						else
  	 						{
  	 							if ($profilebranchcode == $row[2])
  	 							{
  	 	   						$bisaakses = 1;
  	 							}
  	 						}

?>
   								 		<tr>
   								 	  		<td width=20% align=center valign=top>
<?
  	 						if ($bisaakses > 0)
  	 						{
?>
   								 	  			<A HREF="javascript:editData('<? echo $row[0] ?>','upd')"><font face=Arial size=2><? echo $row[0] ?></font><A>
<?
  	 						}
  	 						else
  	 						{
?>
   								 	  			<font face=Arial size=2><? echo $row[0] ?> - N/A</font>
<?
  	 						}
?>
   								 	  		</td>
   								 	  		<td width=30% align=left valign=top>
   								 	  			<font face=Arial size=2><? echo $row[1] ?></font>
   								 	  		</td>
   								 	  		<td width=30% align=left valign=top>
   								 	  			<font face=Arial size=2><? echo $row[2] ?> - <? echo $branchname ?></font>
   								 	  		</td>
   								 	  		<td width=20% align=left valign=top>
   								 	  			<font face=Arial size=2><? echo $row[3] ?> - <? echo $levelname ?></font>
   								 	  		</td>
   								 		</tr>
<?
      				}
   				  }
   				  sqlsrv_free_stmt( $sqlConn );
   			  }
   				
?>
   									</table>
    								<input type=hidden name=theuserid>
    								<input type=hidden name=thestatusuid>
    								 <input type=hidden name=userprogramcode value='<? echo $userprogramcode ?>'>
    								<input type=hidden name=act value='editdata'>
										<input type=hidden name=userid value=<? echo $userid; ?>>
										<input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	  	      		</form>
									
<?
				}
// END CHECK

// EDIT DATA
				if ($act == "editdata")
				{
					echo "<form name=formsubmit method=post action=./maintainreset.php>";
?>  	  	      			    		
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<font face=Arial size=2><b><? echo $theuserid ?></b></font>
   	  	      		   	      			<input type=hidden name=newuserid value='<? echo $theuserid ?>'>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Password &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=password name=newuserpwd size=20 maxlength=20>
   	  	      		   	      			<input type=hidden name=backuserpwd>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<? echo $varbutton ?>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      </table>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      </table>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
   	  	      		   <input type=hidden name=actionhistory>
    								 <input type=hidden name=act>
    								 <input type=hidden name=userprogramcode value='<? echo $userprogramcode ?>'>
    								 <input type=hidden name=utilwindow>
    								 <input type=hidden name=utilformname>
    								 <input type=hidden name=utilformfield>
    							   <input type=hidden name=utilfieldvalue>
    						     <input type=hidden name=utilfielddest>
    				         <input type=hidden name=utildetail>
										  <input type=hidden name=userid value=<? echo $userid; ?>>
										  <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	  	      		</form>
<?
				}
?>
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

?> 
