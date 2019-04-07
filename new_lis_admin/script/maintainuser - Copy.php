<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramact="maintainuser.php";
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
  $userprogramact="maintainuser.php";

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
   require ("../lib/formatError.php");
  global $userid;
  global $userpwd;
  global $act;
  global $thestring;
  global $userprogramcode;
  global $userprogramact;
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
  $searchby="";
  if (isset($_POST['searchby']))
  {
  	$searchby = $_POST['searchby'];
  }

// PROFILE
  $profilebranchcode = "";
  $profilelevelcode = "";
	$tsql = "SELECT user_branch_code, user_level_code
										FROM Tbl_SE_User 
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
  		$profilelevelcode = $row[1];
    }
  }
  sqlsrv_free_stmt( $sqlConn );

  $profileregioncode = "";
	$tsql = "SELECT branch_region_code
										FROM Tbl_Branch
										WHERE branch_code='$profilebranchcode'";
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
   		$profileregioncode = $row[0];
    }
  }
  sqlsrv_free_stmt( $sqlConn );

// END PROFILE
  
  $kondisistring = "";
	   if ($searchby == ""){
		    $kondisistring = "AND (Tbl_SE_User.user_id like '%$thestring%' or Tbl_SE_User.user_name like '%$thestring%' or Tbl_SE_User.user_branch_code like '%$thestring%' or tb.branch_name like '%$thestring%')";
	   } else {
		   if($searchby == "Userid"){
			   $kondisistring = "AND Tbl_SE_User.user_id like '%$thestring%'" ;
		   } else if($searchby == "Username"){
			   $kondisistring = "AND Tbl_SE_User.user_name like '%$thestring%'" ;
		   } else if ($searchby == "Cabang"){
			   if(is_numeric(substr($thestring,0,1))){
				   $kondisistring = "AND Tbl_SE_User.user_branch_code like '%$thestring%'";
			   } else {
				   $kondisistring = "AND tb.branch_name like '%$thestring%'" ;
			   }
		   } else if ($searchby == "Level"){
			   $kondisistring = "AND Tbl_SE_User.user_level_code like '%$thestring%'" ;
		   }
	   }

/*
  if ($thestring != "0")
  {
  	$kondisistring = "AND Tbl_SE_User.user_id like '%$thestring%' or Tbl_SE_User.user_name like '%$thestring%'";
  }
 */

	$thecount = 0;
	/*
	$tsql = "SELECT COUNT(*) FROM Tbl_SE_User 
						WHERE user_id<>''
										$kondisistring";
										*/
  if ($act != "editdata")
  {
	   $tsql = "SELECT COUNT(*) FROM Tbl_SE_User,Tbl_Branch tb where tbl_se_user.user_branch_code=tb.branch_code and user_id<>''
		   $kondisistring";
		//echo $tsql;
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
  }

  if ($thecount == 1)
  {
//  	$act = "editdata";
/*
		$tsql = "SELECT user_id FROM Tbl_SE_User 
							WHERE user_id<>''
										$kondisistring";
*/
	$tsql = "SELECT COUNT(*) FROM Tbl_SE_User,Tbl_Branch tb where tbl_se_user.user_branch_code=tb.branch_code and user_id<>''
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
  	$varfocus = "document.formsubmit.newusername.focus()";
  	if ($thestatusuid == "upd")
  	{
  		$varfocus .= ";viewDetail()";
//  		$varbutton = "<input type=button value='Edit' onClick=goSave('U')>&nbsp &nbsp<input type=button value='Delete' onClick=goDel()>&nbsp <input type=button value='Reset Login Nyangkut' onClick=goNyangkut()><BR><BR><input type=button value='Reset Login Attempt / Maksimum Login' onClick=goReset()>";
  		$varbutton = "<input type=button value='Edit' onClick=goSave('U')>&nbsp &nbsp<input type=button value='Delete' onClick=goDel()>";
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
	   	      if (selectedArray[17].length > 3)
	   	      {
	   	         var tempbranchao = selectedArray[17] + selectedArray[7];
	   	         branchao = "'";
	   	         for (varj=0;varj<tempbranchao.length;varj++)
	   	         {
	   	         	  if (tempbranchao.substring(varj,varj+1) != "'")
	   	         	  {
	   	         	  	branchao = branchao + tempbranchao.substring(varj,varj+1);
	   	         	  }
	   	         }
	   	         branchao = branchao + "'";
	   		       eval("document.formsubmit.newuseraocode.value=" + branchao);
	   		       eval("document.formsubmit.backuseraocode.value=" + branchao);
	   		    }
	   		    if(document.formsubmit.newuseraocode.selectedIndex < 0)
	   		    {
	   		       document.formsubmit.newuseraocode.options[0].selected = true;
	   		    }
	   		    eval("document.formsubmit.newuserid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.backusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newuserprofile.value=" + selectedArray[5]);
	   		    eval("document.formsubmit.backuserprofile.value=" + selectedArray[5]);
	   		    eval("document.formsubmit.newuseremail.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.backuseremail.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.newuserhp.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.backuserhp.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.newuserproc.value=" + selectedArray[6]);
	   		    eval("document.formsubmit.backuserproc.value=" + selectedArray[6]);
	   		    eval("document.formsubmit.newuserpwd.value=" + selectedArray[9]);
	   		    eval("document.formsubmit.backuserpwd.value=" + selectedArray[9]);
	   		    eval("document.formsubmit.newuserbranch.value=" + selectedArray[7]);
	   		    eval("document.formsubmit.backuserbranch.value=" + selectedArray[7]);
	   		    eval("document.formsubmit.newuserlevel.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.backuserlevel.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.newuserlimit.value=" + selectedArray[15]);
	   		    eval("document.formsubmit.backuserlimit.value=" + selectedArray[15]);
	   		    eval("document.formsubmit.newuserpicture.value=" + selectedArray[16]);
	   		    eval("document.formsubmit.backuserpicture.value=" + selectedArray[16]);
	   		    eval("document.formsubmit.newuserchild.value=" + selectedArray[18]);
	   		    eval("document.formsubmit.backuserchild.value=" + selectedArray[18]);
	   		    eval("document.formsubmit.newusertrustee.value=" + selectedArray[19]);
	   		    eval("document.formsubmit.backusertrustee.value=" + selectedArray[19]);
	   		    eval("document.formsubmit.newuserother.value=" + selectedArray[20]);
	   		    eval("document.formsubmit.backuserother.value=" + selectedArray[20]);
	   		    eval("document.formsubmit.newdownlinestatus.value=" + selectedArray[12].substring(0,2) + "'");
	   		    eval("document.formsubmit.backdownlinestatus.value=" + selectedArray[12].substring(0,2) + "'");
        }
        function goNew()
        {
	   		    document.formsubmit.newuserprofile.value="";
	   		    document.formsubmit.newusername.value="";
	   		    document.formsubmit.newuserpwd.value="";
	   		    document.formsubmit.newuseremail.value="";
	   		    document.formsubmit.newuserhp.value="";
	   		    document.formsubmit.newuserproc.value="";
	   		    document.formsubmit.newuserbranch.value="";
	   		    document.formsubmit.newuserlevel.value="";
	   		    document.formsubmit.newuserlimit.value="0";
	   		    document.formsubmit.newuserpicture.value="";
	   		    document.formsubmit.newuseraocode.value="";
	   		    document.formsubmit.newuserchild.value="";
           	  document.formsubmit.newusertrustee.disabled = false;
           	  document.formsubmit.newuserother.disabled = false;
	   		    document.formsubmit.newusertrustee.value="";
	   		    document.formsubmit.newuserother.value="";
           	  document.formsubmit.newusertrustee.disabled = true;
           	  document.formsubmit.newuserother.disabled = true;
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
				   if (document.formsubmit.newusername.value == "")
				   {
				   	   alert("Please fill User Name");
				   	   document.formsubmit.newusername.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("User Name : ",document.formsubmit.backusername.value,document.formsubmit.newusername.value);
				   }
				   if (document.formsubmit.newuseremail.value == "")
				   {
				   	   alert("Please fill User Email");
				   	   document.formsubmit.newuseremail.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserhp.value == "")
				   {
				   	   alert("Please fill User Mobile");
				   	   document.formsubmit.newuserhp.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("HP : ",document.formsubmit.backuserhp.value,document.formsubmit.newuserhp.value);
				   }
				   if (document.formsubmit.newuserproc.options[document.formsubmit.newuserproc.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Processing Code");
				   	   document.formsubmit.newuserproc.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Proc Code : ",document.formsubmit.backuserproc.value,document.formsubmit.newuserproc.value);
				   }
				   if (document.formsubmit.newuserbranch.options[document.formsubmit.newuserbranch.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Branch");
				   	   document.formsubmit.newuserbranch.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("User Branch : ",document.formsubmit.backuserbranch.value,document.formsubmit.newuserbranch.value);
				   }
				   if (document.formsubmit.newuserlevel.options[document.formsubmit.newuserlevel.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Level");
				   	   document.formsubmit.newuserlevel.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("User Level : ",document.formsubmit.backuserlevel.value,document.formsubmit.newuserlevel.value);
				   }
				   if (document.formsubmit.newuserlimit.value != "")
				   {
              for (var i = 0; i < document.formsubmit.newuserlimit.value.length; i++)
              {
       	         if (Money.indexOf(document.formsubmit.newuserlimit.value.charAt(i)) == -1)
       	         {
                    alert("Limit harus berupa angka");
                    document.formsubmit.newwfurut.focus();
                    return false;
                 }
              }
				   	   cekHistory("User Limit : ",document.formsubmit.backuserlimit.value,document.formsubmit.newuserlimit.value);
				   }
				   if (document.formsubmit.newuserprofile.options[document.formsubmit.newuserprofile.selectedIndex].value == "")
				   {
				   	   alert("Please fill Profile");
				   	   document.formsubmit.newuserprofile.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Profile : ",document.formsubmit.backuserprofile.value,document.formsubmit.newuserprofile.value);
				   }
				   if (document.formsubmit.newusertrustee.value.length < 5)
				   {
				   	   alert("Please fill User Trustee (Entry)");
				   	   document.formsubmit.newusertrustee.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserother.value.length < 5)
				   {
				   	   alert("Please fill User Trustee (Other)");
				   	   document.formsubmit.newuserother.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuseraocode.options[document.formsubmit.newuseraocode.selectedIndex].value != "")
				   {
				   	   vartempao = document.formsubmit.newuseraocode.options[document.formsubmit.newuseraocode.selectedIndex].text.substring(1,4);
				   	   vartempbranch = document.formsubmit.newuserbranch.options[document.formsubmit.newuserbranch.selectedIndex].value;
				   	   if (vartempao != vartempbranch)
				   	   {
				   	   	  alert("Cabang Yang Dipilih : " + vartempbranch + "\n AO Anda : " + vartempao + "\n Harap Perbaiki");
				   	   	  return false;
				   	   }
				   	   cekHistory("AO Code : ",document.formsubmit.backuseraocode.value,document.formsubmit.newuseraocode.value);
				   }
				   if (document.formsubmit.newuserchild.value.length > 3)
				   {
				   	   if (document.formsubmit.newdownlinestatus.options[document.formsubmit.newdownlinestatus.selectedIndex].value == "b")
				   	   {
				   	   	  alert("Anda Mempunyai Downline " + "\n Harap Pilih Status Anda ");
				   	   	  document.formsubmit.newdownlinestatus.focus();
				   	   	  return false;
				   	   }
				   	   cekHistory("Status Downline : ",document.formsubmit.backdownlinestatus.value,document.formsubmit.newdownlinestatus.value);
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
           		document.formsubmit.action = "./domaintainuser.php";
           		varmsg = "Are your sure to SAVE ? Perubahan Terhadap : " + "\n";
           		arrdata = document.formsubmit.actionhistory.value.split('//');
				   		for (vari=0;vari<arrdata.length-1;vari++)
				   		{
				   			varmsg = varmsg + arrdata[vari] + "\n";
				   		}
           		submitform = window.confirm(varmsg)           
           		if (submitform == true)
           		{
           	  		document.formsubmit.newusertrustee.disabled = false;
           	  		document.formsubmit.newuserother.disabled = false;
		              document.formsubmit.submit();
           		}
           }
        }
        function goReset()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "reset";
           document.formsubmit.action = "./domaintainuser.php";
           submitform = window.confirm("Are your sure to RESET Login Attempt User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goNyangkut()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "nyangkut";
           document.formsubmit.action = "./domaintainuser.php";
           submitform = window.confirm("Are your sure to RESET Login Nyangkut User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainuser.php";
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
   	      			<font face=Arial size=3><b>MANAGE USER - AKSES ANDA : <? echo $profilebranchcode ?></b></font>
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
   	  	      		<form name=formsubmit method=post action=./maintainuser.php>
                  	   <font face=Arial style="font-size: 10;">Search UID / UName :</font> &nbsp
                  	   <input type=text name=thestring size=30 maxlength=60 style="background-color:#FF0">
                  	   <input type=submit value='Search' style="width: 40mm;" onclick="javascript:findString(0);">
						<select name="searchby" id="searchby" nai="Kurir" style="background-color:#FF0">
							<option value=''>--ALL--</option>
							<option value='Userid'>Userid</option>
							<option value='Username'>Username</option>
							<option value='Cabang'>Cabang</option>
							<option value='Level'>Level</option>
						</select>
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
					echo "<form name=formcari method=post action=./maintainuser.php>";

   				if ($thecount <= 0)
   				{
   					  echo "<BR><font face=Arial size=3>Tidak ditemukan $searchby  <b>%$thestring%</b></font>";
   					  echo "<br><A HREF=\"javascript:editData('$thestring','new')\">Klik disini</A> untuk mendaftarkan User ID Baru : <b>$thestring</b>";
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
   	      			/*
   	      			if ($adakahuserini <= 0)
   	      			{
   					  			echo "<br><A HREF=\"javascript:editData('$thestring','new')\">Klik disini</A> untuk mendaftarkan User ID Baru : <b>$thestring</b>";
   	      			}
					*/
					if ($searchby =="Userid" || $searchby =="Userid"){
						if ($adakahuserini <= 0){
							echo "<br><A HREF=\"javascript:editData('$thestring','new')\">Klik disini</A> untuk mendaftarkan User ID Baru : <b>$thestring</b>";
						}
   	      			} else {
					echo "<br><A HREF=\"javascript:editData('$thestring','new')\">Klik disini</A> untuk mendaftarkan User ID Baru : <b>$thestring</b>";
					}

?>
   									<BR><font face=Arial size=3><? echo $searchby; ?> <b>%<? echo $thestring ?>%</b> ditemukan sebanyak <? echo $thecount ?> :</font>
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
					  			Tbl_SE_User.user_branch_code, Tbl_SE_User.user_level_code,tb.branch_name
									FROM Tbl_SE_User,Tbl_Branch tb where tbl_se_user.user_branch_code=tb.branch_code
									and user_id<>''
									$kondisistring
									ORDER BY Tbl_SE_User.user_branch_code";
									//echo $tsql;exit;
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
						$branchname=$row[4];
						/*
      					$branchname = "";
      					$branchregioncode = "";
   			  			$tsql2 = "SELECT branch_name, branch_region_code
						    		    FROM Tbl_Branch
						        		WHERE branch_code='$row[2]'";
						$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  			$params2 = array(&$_POST['query']);
   		    			$sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);
								$custname = "&nbsp";
						if ( $sqlConn2 === false){
								die( FormatErrors( sqlsrv_errors() ) );
						}

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
						*/

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
					echo "<form name=formsubmit method=post action=./maintainuser.php>";
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
   	  	      		   	      			<font face=Arial size=2>User Name &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newusername size=30 maxlength=50>
   	  	      		   	      			<input type=hidden name=backusername>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User Email &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuseremail size=30 maxlength=100>
   	  	      		   	      			<input type=hidden name=backuseremail>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User Mobile &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserhp>
   	  	      		   	      			<input type=text name=newuserhp size=20 maxlength=50>
   	  	      		   	      			<font face=Arial size=2 color=blue>Ex : +62811999888</font>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserbranch>
   	  	      		   	      			<select name=newuserbranch style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
  	$kondisibranch = "";
  	if ($profilebranchcode != "")
  	{
  	 	if (substr($profilebranchcode,1-1,1) == "8")
  	 	{
  	 	   if ($profilebranchcode == "888")
  	 	   {
  	 	   	  $kondisibranch = "";
  	 	   	  $kondisiregion = "";
  	 	   	  $kondisiao = "";
  	 	   }
  	 	   else
  	 	   {
  	 				$kondisibranch = "";
  	 				$kondisiregion = "AND Tbl_Region.region_code = '$profileregioncode'";
  	 				$kondisiao = "AND Tbl_Branch.branch_region_code = '$profileregioncode'";
  	 	   }
  	 	}
  	 	else
  	 	{
  	 				$kondisibranch = "AND Tbl_Branch.branch_code = '$profilebranchcode'";
  	 				$kondisiregion = "AND Tbl_Region.region_code = '$profileregioncode'";
  	 				$kondisiao = "AND Tbl_AO.ao_branch_code = '$profilebranchcode'";
  	 	}
  	}

   $tsql = "SELECT *
						FROM Tbl_Region
						WHERE region_code<>''
						$kondisiregion
						ORDER BY region_code";
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
?>
   	  	      			         <option value='<? echo $row['region_code']; ?>'><? echo $row['region_code']; ?> - <? echo $row['region_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        $kondisibranch
						        ORDER BY branch_code";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
?>
   	  	      			         <option value='<? echo $row2['branch_code']; ?>'>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Proc Code</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserproc>
   	  	      		   	      			<select name=newuserproc style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Processing
						ORDER BY proc_code";
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
?>
   	  	      			         <option value='<? echo $row['proc_code']; ?>'><? echo $row['proc_code']; ?> - <? echo $row['proc_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
?>
   	  	      			         <option value='<? echo $row2['branch_code']; ?>'>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Level</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserlevel>
   	  	      		   	      			<select name=newuserlevel>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_SE_Level
						ORDER BY level_code";
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
?>
   	  	      			         <option value='<? echo $row['level_code']; ?>'><? echo $row['level_code']; ?> - <? echo $row['level_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Limit</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserlimit>
   	  	      		   	      			<input type=text name=newuserlimit size=30 maxlength=30 value=0>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Picture</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserpicture>
   	  	      		   	      			<input type=text name=newuserpicture size=30 maxlength=30>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>AO Code</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuseraocode>
   	  	      		   	      			<select name=newuseraocode>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT Tbl_AO.ao_code,Tbl_AO.ao_branch_code,Tbl_AO.ao_name, Tbl_Branch.branch_region_code
						FROM Tbl_AO, Tbl_Branch
						WHERE Tbl_Branch.branch_code=Tbl_AO.ao_branch_code
						$kondisiao
						ORDER BY Tbl_AO.ao_branch_code, Tbl_AO.ao_code";
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
?>
   	  	      			         <option value='<? echo $row['ao_code']; ?><? echo $row['ao_branch_code']; ?>'>[<? echo $row['ao_branch_code']; ?>] <? echo $row['ao_code']; ?> - <? echo $row['ao_name']; ?> - <? echo $row['branch_region_code']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewChild('formsubmit','newuserchild','newuserchild','mediumwindow','N')"><font face=Arial size=2>Downline</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserchild>
   	  	      		   	      			<textarea name=newuserchild rows=3 cols=40></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Status Upline</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backdownlinestatus>
   	  	      		   	      			<select name=newdownlinestatus>
   	  	      		   	      				  <option value='b'>Tidak Perlu</option>
   	  	      		   	      				  <option value='L'>Team Leader</option>
   	  	      		   	      				  <option value='O'>AO Officer</option>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Function</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserprofile>
   	  	      		   	      			<select name=newuserprofile onChange=chgProfile() style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
   	  	      		   	      				<option value='cLr'>--Clear All Function--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_SE_Profile
						ORDER BY profile_code";
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
?>
   	  	      			         <option value='<? echo $row['profile_code']; ?>'><? echo $row['profile_code']; ?> - <? echo $row['profile_name']; ?> ~~ <? echo $row['profile_program_code']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Workflow</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backusertrustee>
   	  	      		   	      			<textarea name=newusertrustee rows=3 cols=40 disabled></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Non Workflow</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=hidden name=backuserother>
   	  	      		   	      			<textarea name=newuserother rows=3 cols=40 disabled></textarea>
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

function OLDMAIN()
{
   require ("../lib/open_con.php");
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

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

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
<?
   $tsql = "SELECT * FROM Tbl_SE_User
   					WHERE user_id<>'admin'";
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
	   	      var selectedArray = eval(document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].value);
	   	      if (selectedArray[17].length > 3)
	   	      {
	   	         var branchao = selectedArray[17].substring(0,4) + selectedArray[7].substring(1);
	   		       eval("document.formsubmit.newuseraocode.value=" + branchao);
	   		    }
	   		    eval("document.formsubmit.newuserid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newuserprofile.value=" + selectedArray[5]);
	   		    eval("document.formsubmit.newuseremail.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.newusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newuserhp.value=" + selectedArray[4]);
	   		    eval("document.formsubmit.newuserproc.value=" + selectedArray[6]);
	   		    eval("document.formsubmit.newuserpwd.value=" + selectedArray[9]);
	   		    eval("document.formsubmit.newuserbranch.value=" + selectedArray[7]);
	   		    eval("document.formsubmit.newuserlevel.value=" + selectedArray[3]);
	   		    eval("document.formsubmit.newuserlimit.value=" + selectedArray[15]);
	   		    eval("document.formsubmit.newuserpicture.value=" + selectedArray[16]);
	   		    eval("document.formsubmit.newuserchild.value=" + selectedArray[18]);
	   		    eval("document.formsubmit.newusertrustee.value=" + selectedArray[19]);
	   		    eval("document.formsubmit.newuserother.value=" + selectedArray[20]);
	   		    document.formsubmit.newuseraocode.options[0].selected = true;
        }
        function goNew()
        {
	   		    document.formsubmit.newuserid.value="";
	   		    document.formsubmit.newuserprofile.value="";
	   		    document.formsubmit.newusername.value="";
	   		    document.formsubmit.newuserpwd.value="";
	   		    document.formsubmit.newuseremail.value="";
	   		    document.formsubmit.newuserhp.value="";
	   		    document.formsubmit.newuserproc.value="";
	   		    document.formsubmit.newuserbranch.value="";
	   		    document.formsubmit.newuserlevel.value="";
	   		    document.formsubmit.newuserlimit.value="0";
	   		    document.formsubmit.newuserpicture.value="";
	   		    document.formsubmit.newuseraocode.value="";
	   		    document.formsubmit.newuserchild.value="";
           	  document.formsubmit.newusertrustee.disabled = false;
           	  document.formsubmit.newuserother.disabled = false;
	   		    document.formsubmit.newusertrustee.value="";
	   		    document.formsubmit.newuserother.value="";
           	  document.formsubmit.newusertrustee.disabled = true;
           	  document.formsubmit.newuserother.disabled = true;
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
        function goSave(theid)
        {
        	 if (theid == "N")
        	 {
        	 	 for(vari=0;vari<document.formsubmit.updcode.length;vari++)
        	 	 {
        	 	 	 if (document.formsubmit.updcode.options[vari].value.substring(1) == document.formsubmit.newuserid.value)
        	 	 	 {
				   	      alert("User ID sudah ada");
				   	      document.formsubmit.newuserid.focus();
				   	      return false;
        	 	 	 }
        	 	 }
        	 }
           var Money ="0123456789.";
				   if (document.formsubmit.newuserid.value == "")
				   {
				   	   alert("Please fill User ID");
				   	   document.formsubmit.newuserid.focus();
				   	   return false;
				   }
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
				   if (document.formsubmit.newusername.value == "")
				   {
				   	   alert("Please fill User Name");
				   	   document.formsubmit.newusername.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuseremail.value == "")
				   {
				   	   alert("Please fill User Email");
				   	   document.formsubmit.newuseremail.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserhp.value == "")
				   {
				   	   alert("Please fill User Mobile");
				   	   document.formsubmit.newuserhp.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserproc.options[document.formsubmit.newuserproc.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Processing Code");
				   	   document.formsubmit.newuserproc.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserbranch.options[document.formsubmit.newuserbranch.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Branch");
				   	   document.formsubmit.newuserbranch.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserlevel.options[document.formsubmit.newuserlevel.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Level");
				   	   document.formsubmit.newuserlevel.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserlimit.value != "")
				   {
              for (var i = 0; i < document.formsubmit.newuserlimit.value.length; i++)
              {
       	         if (Money.indexOf(document.formsubmit.newuserlimit.value.charAt(i)) == -1)
       	         {
                    alert("Limit harus berupa angka");
                    document.formsubmit.newwfurut.focus();
                    return false;
                 }
              }
				   }
				   if (document.formsubmit.newusertrustee.value.length < 5)
				   {
				   	   alert("Please fill User Trustee (Entry)");
				   	   document.formsubmit.newusertrustee.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserother.value.length < 5)
				   {
				   	   alert("Please fill User Trustee (Other)");
				   	   document.formsubmit.newuserother.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuseraocode.options[document.formsubmit.newuseraocode.selectedIndex].value != "")
				   {
				   	   vartempao = document.formsubmit.newuseraocode.options[document.formsubmit.newuseraocode.selectedIndex].value.substring(3);
				   	   vartempbranch = document.formsubmit.newuserbranch.options[document.formsubmit.newuserbranch.selectedIndex].value;
				   	   if (vartempao != vartempbranch)
				   	   {
				   	   	  alert("Cabang Yang Dipilih : " + vartempbranch + "\n AO Anda : " + vartempao + "\n Harap Perbaiki");
				   	   	  return false;
				   	   }
				   }
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "save";
           document.formsubmit.action = "./domaintainuser.php";
           submitform = window.confirm("Are your sure to SAVE ?")
           if (submitform == true)
           {
           	  document.formsubmit.newusertrustee.disabled = false;
           	  document.formsubmit.newuserother.disabled = false;
              document.formsubmit.submit();
           }
        }
        function goReset()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "reset";
           document.formsubmit.action = "./domaintainuser.php";
           submitform = window.confirm("Are your sure to RESET Login Attempt User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goNyangkut()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "nyangkut";
           document.formsubmit.action = "./domaintainuser.php";
           submitform = window.confirm("Are your sure to RESET Login Nyangkut User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainuser.php";
           submitform = window.confirm("Are your sure to DELETE User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
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
	function findString(themethod)
	{
     varhitdata = document.formsubmit.updcode.length;
	   varstart = -1;
	   varketemu = 0;
	   varstring = document.formsubmit.updstring.value.toUpperCase();
	   if (themethod == 1)
	   {
	      if (document.formsubmit.updcode.selectedIndex >= 0)
	      {
	   	varstart = document.formsubmit.updcode.options[document.formsubmit.updcode.selectedIndex].index;
	      }
	   }
	   varstart = varstart + 1;
	   for (vari=varstart;vari<varhitdata;vari++)
	   {
	   	varsource = document.formsubmit.updcode.options[vari].text.toUpperCase();
	   	for (varj=0;varj<varsource.length;varj++)
	   	{
	   	   if (varsource.substring(varj,varj+varstring.length) == varstring)
	   	   {
	   		document.formsubmit.updcode.selectedIndex = vari;
	   		viewDetail();
	   		return false;
	   	   }
	   	}
	   }
	   alert ("String '" + document.formsubmit.updstring.value + "' Not Found");
	   return false;
	}
      </Script>
   </head>
    <body style="background:url(../images/Background%20Mega.png) no-repeat center;">
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
   	      			<font face=Arial size=3><b>MANAGE USER - AKSES ANDA : <? echo $profilebranchcode ?></b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
                  	   <font face=Arial style="font-size: 10;">Search UID / UName :</font> &nbsp
                  	   <input type=text name=updstring size=20 maxlength=60>
                  	   <input type=button value='Find (From Top)' style="width: 40mm;" onclick="javascript:findString(0);">
                  	   <input type=button value='Find Next (From Last Position)' style="width: 60mm;" onclick="javascript:findString(1);">
                 	   <hr size=2>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=50% align=left valign=top>
   	  	      			    		<font face=Arial size=2>Daftar User ID</font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT * FROM Tbl_SE_User
   					WHERE user_id<>'admin'
   					ORDER BY user_branch_code,user_id";
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
?>
   	  	      			         <option value='D<? echo $row['user_id']; ?>'><? echo $row['user_branch_code']; ?> - <? echo $row['user_id']; ?> - <? echo $row['user_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2><A HREF="javascript:viewHirarki('formsubmit','newusertrustee','newusertrustee','mediumwindow','N')">Detail User ID</A></font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuserid size=20 maxlength=20>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Password &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=password name=newuserpwd size=20 maxlength=20>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User Name &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newusername size=30 maxlength=50>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User Email &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuseremail size=30 maxlength=100>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User Mobile &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuserhp size=20 maxlength=50>
   	  	      		   	      			<font face=Arial size=2 color=blue>Ex : +62811999888</font>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Branch</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=newuserbranch style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Region
						ORDER BY region_code";
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
?>
   	  	      			         <option value='<? echo $row['region_code']; ?>'><? echo $row['region_code']; ?> - <? echo $row['region_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
?>
   	  	      			         <option value='<? echo $row2['branch_code']; ?>'>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Proc Code</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=newuserproc style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Processing
						ORDER BY proc_code";
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
?>
   	  	      			         <option value='<? echo $row['proc_code']; ?>'><? echo $row['proc_code']; ?> - <? echo $row['proc_name']; ?></option>
<?
   			  $tsql2 = "SELECT *
						        FROM Tbl_Branch
						        WHERE branch_region_code='$row[region_code]'
						        ORDER BY branch_code";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
?>
   	  	      			         <option value='<? echo $row2['branch_code']; ?>'>&nbsp &nbsp <? echo $row2['branch_code']; ?> - <? echo $row2['branch_name']; ?></option>
<?
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Level</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=newuserlevel>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_SE_Level
						ORDER BY level_code";
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
?>
   	  	      			         <option value='<? echo $row['level_code']; ?>'><? echo $row['level_code']; ?> - <? echo $row['level_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Limit</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuserlimit size=30 maxlength=30 value=0>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Picture</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuserpicture size=30 maxlength=30>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>AO Code</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=newuseraocode>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_AO
						ORDER BY ao_branch_code, ao_code";
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
?>
   	  	      			         <option value='<? echo $row['ao_code']; ?><? echo $row['ao_branch_code']; ?>'>[<? echo $row['ao_branch_code']; ?>] <? echo $row['ao_code']; ?> - <? echo $row['ao_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewChild('formsubmit','newuserchild','newuserchild','mediumwindow','N')"><font face=Arial size=2>Downline</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<textarea name=newuserchild rows=3 cols=40></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Function</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=newuserprofile onChange=chgProfile() style='width: 50mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
   	  	      		   	      				<option value='cLr'>--Clear All Function--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_SE_Profile
						ORDER BY profile_code";
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
?>
   	  	      			         <option value='<? echo $row['profile_code']; ?>'><? echo $row['profile_code']; ?> - <? echo $row['profile_name']; ?> ~~ <? echo $row['profile_program_code']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Workflow</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<textarea name=newusertrustee rows=3 cols=40 disabled></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Non Workflow</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<textarea name=newuserother rows=3 cols=40 disabled></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
    				         						   <input type=button value='Create' onClick=goSave('N')>
    				         						   <input type=button value='Edit' onClick=goSave('U')>
    				         					     <input type=button value='Delete' onClick=goDel()>
    				         					     <input type=button value='Clear Field' onClick=goNew()>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      		   <input type=button value='Reset Login Attempt / Maksimum Login' onClick=goReset()>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      		   <input type=button value='Reset Login Nyangkut' onClick=goNyangkut()>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      </table>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      		   	      </table>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=utilwindow>
    								 <input type=hidden name=utilformname>
    								 <input type=hidden name=utilformfield>
    							   <input type=hidden name=utilfieldvalue>
    						     <input type=hidden name=utilfielddest>
    				         <input type=hidden name=utildetail>
										  <input type=hidden name=userid value=<? echo $userid; ?>>
										  <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	  	      		</form>
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
