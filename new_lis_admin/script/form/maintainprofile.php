<?php

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

   $act = "";

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{
   require ("../lib/open_con.php");
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   $tempfield = "";
   $countfield = 0;
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_SE_Profile'";
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

   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Profile";
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
      	   $hituser = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
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
   $tsql = "SELECT * FROM Tbl_SE_Profile";
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
         $vartemp = "var D" . $row['profile_code'] . "=  new Array(";
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
        $vartemp .= "'');";
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
	   		    eval("document.formsubmit.newprofileid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newprofilename.value=" + selectedArray[1]);
            vardata = selectedArray[2].split('|');
	   		    document.formsubmit.newusertrustee.value = vardata[0].substring(1);
	   		    document.formsubmit.newuserother.value = vardata[1].substring(0,vardata[1].length-1);
        }
        function goNew()
        {
	   		    document.formsubmit.newprofileid.value="";
	   		    document.formsubmit.newprofilename.value="";
	   		    document.formsubmit.newusertrustee.value="";
	   		    document.formsubmit.newuserother.value="";
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
        function goSave()
        {
				   if (document.formsubmit.newprofileid.value == "")
				   {
				   	   alert("Please fill User ID");
				   	   document.formsubmit.newprofileid.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newprofilename.value == "")
				   {
				   	   alert("Please fill User Name");
				   	   document.formsubmit.newprofilename.focus();
				   	   return false;
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
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "save";
           document.formsubmit.action = "./domaintainprofile.php";
           submitform = window.confirm("Are your sure to SAVE ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainprofile.php";
           submitform = window.confirm("Are your sure to DELETE User " + document.formsubmit.newprofileid.value + " " + document.formsubmit.newprofilename.value + " ?")
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
	   for (vari=varstart;vari<<? echo $hituser; ?>;vari++)
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
  <body style="background:url(../images/Background%20Mega.png) no-repeat center;">
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
   	  	      	 <font face=Arial size=3><b>MANAGE PROFILE</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=50% align=left valign=top>
   	  	      			    		<font face=Arial size=2>Daftar Profile</font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT * FROM Tbl_SE_Profile
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
   	  	      			         <option value='D<? echo $row['profile_code']; ?>'><? echo $row['profile_code']; ?> - <? echo $row['profile_name']; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2>Detail Profile</font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Profile ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newprofileid size=20 maxlength=20>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>Profile Name &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newprofilename size=30 maxlength=50>
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
   	  	      		   	      			<A HREF="javascript:viewTrustee('formsubmit','newusertrustee','newusertrustee','mediumwindow','N')"><font face=Arial size=2>Trustee Entry</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<textarea name=newusertrustee rows=3 cols=40></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<A HREF="javascript:viewOther('formsubmit','newuserother','newuserother','mediumwindow','N')"><font face=Arial size=2>Trustee Other</font></A> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<textarea name=newuserother rows=3 cols=40></textarea>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			&nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
    				         						   <input type=button value='Save' onClick=goSave()>
    				         					     <input type=button value='Delete' onClick=goDel()>
    				         					     <input type=button value='NEW' onClick=goNew()>
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
