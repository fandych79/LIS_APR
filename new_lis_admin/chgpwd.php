<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

   if(substr($userid,1-1,5) != "admin")
   {
	   header("location:restricted.php");
   }

   require ("lib/open_con.php");

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


?>
<html>
  <head>
      <Script Language="JavaScript">
	function cekthis()
	{
           var cekoldpassword=document.formsubmit.oldpassword.value;
           var ceknewpassword=document.formsubmit.newpassword.value;
           var ceknewpassword1=document.formsubmit.newpassword1.value;
           if (cekoldpassword == "")
           {
              alert("Password Lama Harus Diisi");
              document.formsubmit.oldpassword.focus();
              return false;
           }
	   if (document.formsubmit.oldpassword.value.indexOf(" ") != -1)
           {
              alert("Password Tidak Boleh Pakai Spasi");
              document.formsubmit.oldpassword.focus();
              return false;
           }
           if (ceknewpassword == "")
           {
              alert("Password Baru & Konfirmasi Password Harus Diisi");
              document.formsubmit.newpassword.focus();
              return false;
           }
	   if (document.formsubmit.newpassword.value.indexOf(" ") != -1)
           {
              alert("Password Baru & Konfirmasi Password Tidak Boleh Pakai Spasi");
              document.formsubmit.newpassword.focus();
              return false;
           }
	   if (ceknewpassword != ceknewpassword1) 
           {
              alert("Password Baru & Konfirmasi Password Harus Sama");
              document.formsubmit.newpassword.focus();
              return false;
           }
           submitform = window.confirm("Rubah Password ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
              return true;
           }
           else
           {
              return false;
           } 
	}
      </Script>
  </head>
  <body>
  	<div align=center>
  	 <form name=formsubmit method=post action=./do_chgpwd.php>
  	 	  <font face=Arial size=3><b>CHANGE PASSWORD</b></font>
  	 	  <BR><BR>
  	 	  <table width=100% cellpadding=2 cellspacing=2 border=0>
  	 	     <tr>
  	 	     	  <td width=30% align=right valign=top>
  	 	     	  	<font face=Arial size=2>User ID &nbsp</font>
  	 	     	  </td>
  	 	     	  <td width=70% align=left valign=top>
  	 	     	  	<font face=Arial size=2><? echo $userid; ?></font>
  	 	     	  </td>
  	 	     </tr>
  	 	     <tr>
  	 	     	  <td width=30% align=right valign=top>
  	 	     	  	<font face=Arial size=2>Old Password &nbsp</font>
  	 	     	  </td>
  	 	     	  <td width=70% align=left valign=top>
  	 	     	  	<input type=password name=oldpassword size=20 maxlength=20>
  	 	     	  </td>
  	 	     </tr>
  	 	     <tr>
  	 	     	  <td width=30% align=right valign=top>
  	 	     	  	<font face=Arial size=2>New Password &nbsp</font>
  	 	     	  </td>
  	 	     	  <td width=70% align=left valign=top>
  	 	     	  	<input type=password name=newpassword size=20 maxlength=20>
  	 	     	  </td>
  	 	     </tr>
  	 	     <tr>
  	 	     	  <td width=30% align=right valign=top>
  	 	     	  	<font face=Arial size=2>New Password (Confirmation) &nbsp</font>
  	 	     	  </td>
  	 	     	  <td width=70% align=left valign=top>
  	 	     	  	<input type=password name=newpassword1 size=20 maxlength=20>
  	 	     	  </td>
  	 	     </tr>
  	 	     <tr>
  	 	     	  <td width=30% align=right valign=top>
  	 	     	  	&nbsp
  	 	     	  </td>
  	 	     	  <td width=70% align=left valign=top>
  	 	     	  	<input type=button value='Change Password' onclick=cekthis()>
  	 	     	  </td>
  	 	     </tr>
  	 	  </table>
        <input type=hidden name=userid value=<? echo $userid; ?>>
        <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
     </form>
  	</div>
  </body>
</html>
<?
   require ("lib/close_con.php");
exit;
