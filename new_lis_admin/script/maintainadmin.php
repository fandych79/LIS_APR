<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramact="maintainadmin.php";

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

   $act = "";

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  global $userprogramcode;
   require ("../lib/open_con.php");

   $tempfield = "";
   $countfield = 0;
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = 'Tbl_ProgramAdmin'";
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

   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_User";
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
   					WHERE user_profile_code='ADM'
   					AND user_id<>'admin'";
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
						        FROM Tbl_SE_AdminProgram
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
      		   $vartemp3 = "\"'";
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
      		   {
      		   	  if ($row2['user_permissions'] == "00")
      		   	  {
							     $vartemp2 .= $row2['program_code'] . ",";
							  }
							  else
							  {
#							     $vartemp2 .= "\"'" . $row2['program_code'] . ":" . $row2['program_code'] . ":" . $row2['program_code'] . ":" . "~" . "'\",";
							     $vartemp3 .= $row2['program_code'] . ",";
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
	   		    eval("document.formsubmit.newuserid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.backuserid.value=" + selectedArray[0]);
	   		    eval("document.formsubmit.newusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.backusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.newuseremail.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.backuseremail.value=" + selectedArray[8]);
	   		    eval("document.formsubmit.newusername.value=" + selectedArray[1]);
	   		    eval("document.formsubmit.backusername.value=" + selectedArray[1]);
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
	   		    document.formsubmit.backusertrustee.value = "";
	   		    arrdata = selectedArray[19].substring(1,selectedArray[19].length-1).split(',');
				   for (vari=0;vari<arrdata.length-1;vari++)
				   {				   	  
				   	   eval("document.formsubmit.A" + arrdata[vari] + ".checked = true")
	   		       document.formsubmit.backusertrustee.value = document.formsubmit.backusertrustee.value + arrdata[vari] + "|";
				   }
        }
        function goNew()
        {
	   		    document.formsubmit.newuserid.value="";
	   		    document.formsubmit.newusername.value="";
	   		    document.formsubmit.newuserpwd.value="";
	   		    document.formsubmit.newuseremail.value="";
	   		    document.formsubmit.newuserhp.value="";
	   		    document.formsubmit.newuserproc.value="";
	   		    document.formsubmit.newuserbranch.value="";
           arrdata = document.formsubmit.thetrustee.value.split('|');
				   for (vari=0;vari<arrdata.length-1;vari++)
				   {
				   	   eval("document.formsubmit.A" + arrdata[vari] + ".checked = false")
				   }
        }
        function cekHistory(thefield,thebackup,thenew)
        {
				   	   if (thebackup != thenew)
				   	   {
				   	   	  document.formsubmit.actionhistory.value = document.formsubmit.actionhistory.value + thefield + thebackup + " >> " + thenew + "//";
				   	   }
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
        	 document.formsubmit.actionhistory.value = "";
           var Money ="0123456789.";
					 var iChars = "! @#$%^&*()+=-[]\\\';,./{}|\":<>?";
           for (var i = 0; i < document.formsubmit.newuserid.value.length; i++)
           {
								if (iChars.indexOf(document.formsubmit.newuserid.value.charAt(i)) != -1) 
								{
										alert ("User ID tidak boleh menggunakan spesial karakter / spasi");
										document.formsubmit.newuserid.focus();
										return false;
								}
           }
				   if (document.formsubmit.newuserid.value.substring(0,5) != "admin")
				   {
				   	   alert("5 huruf awal harus 'admin'");
				   	   document.formsubmit.newuserid.focus();
				   	   return false;
				   }
				   if (document.formsubmit.newuserid.value.length <= 5)
				   {
				   	   alert("User ID harus lebih dari 5 karakter");
				   	   document.formsubmit.newuserid.focus();
				   	   return false;
				   }
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
				   else
				   {
				   	   cekHistory("User Email : ",document.formsubmit.backuseremail.value,document.formsubmit.newuseremail.value);
				   }
				   if (document.formsubmit.newuserhp.value == "")
				   {
				   	   alert("Please fill User Mobile");
				   	   document.formsubmit.newuserhp.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Phone : ",document.formsubmit.backuserhp.value,document.formsubmit.newuserhp.value);
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
				   if (document.formsubmit.newuserlevel.options[document.formsubmit.newuserlevel.selectedIndex].value == "")
				   {
				   	   alert("Please fill Admin Level");
				   	   document.formsubmit.newuserlevel.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Level : ",document.formsubmit.backuserlevel.value,document.formsubmit.newuserlevel.value);
				   }
				   if (document.formsubmit.newuserbranch.options[document.formsubmit.newuserbranch.selectedIndex].value == "")
				   {
				   	   alert("Please fill User Branch");
				   	   document.formsubmit.newuserbranch.focus();
				   	   return false;
				   }
				   else
				   {
				   	   cekHistory("Branch : ",document.formsubmit.backuserbranch.value,document.formsubmit.newuserbranch.value);
				   }
				   varreturn = "";
           arrdata = document.formsubmit.thetrustee.value.split('|');
				   for (vari=0;vari<arrdata.length-1;vari++)
				   {
				   	   if (eval("document.formsubmit.A" + arrdata[vari] + ".checked == true"))
				   	   {
				   	   	   varreturn = varreturn + arrdata[vari] + "|";
				   	   }
				   }
				   if (varreturn == "")
				   {
				      alert ("Harap Pilih TRUSTEE");
				      return false;
				   }
				   else
				   {
				   	   cekHistory("Trustee : ",document.formsubmit.backusertrustee.value,varreturn);
				   }
           if (document.formsubmit.actionhistory.value == "")
           {
              alert("Anda Belum Melakukan Perubahan Apapun");
              return false;
           }
           else
           {
				   		document.formsubmit.varreturn.value = varreturn;
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "save";
           		document.formsubmit.action = "./domaintainadmin.php";
           		varmsg = "Are your sure to SAVE ? Perubahan Terhadap : " + "\n";
           		arrdata = document.formsubmit.actionhistory.value.split('//');
				   		for (vari=0;vari<arrdata.length-1;vari++)
				   		{
				   			varmsg = varmsg + arrdata[vari] + "\n";
				   		}

           		submitform = window.confirm(varmsg);
           		if (submitform == true)
           		{
              	document.formsubmit.submit();
           		}
           }
        }
        function goDel()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "del";
           document.formsubmit.action = "./domaintainadmin.php";
           submitform = window.confirm("Are your sure to DELETE User " + document.formsubmit.newuserid.value + " " + document.formsubmit.newusername.value + " ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
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
   <body>
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
   	      <table style="background-color:#FFF;"width="760"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
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
   	  	      	 <font face=Arial size=3><b>MANAGE USER ADMIN</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
                  	   <font face=Arial style="font-size: 10;">Search :</font> &nbsp
                  	   <input type=text name=updstring size=20 maxlength=60>
                  	   <input type=button value='Find (From Top)' style="width: 40mm;" onclick="javascript:findString(0);">
                  	   <input type=button value='Find Next (From Last Position)' style="width: 60mm;" onclick="javascript:findString(1);">
                 	   <hr size=2>
   	  	      		   <table width=100% border=0 cellpadding=0 cellspacing=0>
   	  	      			    <tr>
   	  	      			    	<td width=50% align=left valign=top>
   	  	      			    		<font face=Arial size=2>Daftar User Admin</font>
   	  	      			    		<BR>
   	  	      			    		<select name=updcode size=25 style='width: 80mm' onChange="javascript:viewDetail();">
<?
   $tsql = "SELECT user_id,user_name FROM Tbl_SE_User
   					WHERE user_profile_code='ADM'
   					AND user_id<>'admin'";
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
?>
   	  	      			         <option value='D<? echo $row[0]; ?>'><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      			    		</select>
   	  	      			    	</td>
   	  	      			    	<td width=50% align=center valign=top>
   	  	      			    		<font face=Arial size=2>Detail User Admin</font>
   	  	      			    		<BR><BR>
   	  	      		   	      <table width=100% border=0 cellpadding=2 cellspacing=2>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>User ID &nbsp</font>
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
   	  	      		   	      			<input type=text name=newuserid size=20 maxlength=20>
   	  	      		   	      			<input type=hidden name=backuserid>
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
   	  	      		   	      			<input type=text name=newuserhp size=20 maxlength=50>
   	  	      		   	      			<font face=Arial size=2 color=blue>Ex : +62811999888</font>
   	  	      		   	      			<input type=hidden name=backuserhp>
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
   	  	      		   	      			<input type=hidden name=backuserbranch>
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
   	  	      		   	      			<select name=newuserlevel style='width: 70mm'>
   	  	      		   	      				<option value=''>--Please Choose One--</option>
<?
	$tsql = "SELECT * FROM PARAM_TblMasterUser";
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
						echo "<option value='$row[0]'>$row[1]</option>";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
   	  	      		   	      		</td>
   	  	      		   	      	</tr>
   	  	      		   	      	<tr>
   	  	      		   	      		<td width=30% align=right valign=top>
   	  	      		   	      			<font face=Arial size=2>TRUSTEE</font> &nbsp
   	  	      		   	      		</td>
   	  	      		   	      		<td width=70% align=left valign=top>
<?
  $thetrustee = "";
	$tsql = "SELECT programcode,programname FROM Tbl_ProgramAdmin";
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
      	$thetrustee .= $row[0] . "|";
																		echo "<input type=checkbox name=A$row[0] value='Y'><font face=Arial size=2>$row[1]</font><BR>";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			<input type=hidden name=backusertrustee>
																	<input type=hidden name=thetrustee value='<? echo $thetrustee ?>'>
																	<input type=hidden name=varreturn>
   	  	      		   	      			<input type=hidden name=actionhistory>
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
   	  	      		   	      </table>
   	  	      			    	</td>
   	  	      			    </tr>
   	  	      		   </table>
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
