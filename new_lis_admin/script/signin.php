<?php

  $switchact=$_POST['switchact'];
  $serverName = "(local)\SQLEXPRESS";
  $connectionOptions = array("Database"=>"db_lis_mega");

  $conn = sqlsrv_connect( $serverName, $connectionOptions);
  if( $conn === false )
       die( FormatErrors( sqlsrv_errors() ));


   if ($switchact == "Y")
   {
     $userid=$_POST['userid'];
     $userpwd=$_POST['userpwd'];
     $userprgcode=$_POST['userprgcode'];
     $act=$_POST['act'];


   			  $tsql2 = "SELECT COUNT(*) as b
             				FROM Tbl_SE_User
	     							WHERE user_id='$userid'";
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
      		   	   $countuser = $row2['b'];
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
   	      echo "$countuser";
   }
   else
   {
      SIGNIN();
   }


function SIGNIN()
{
?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>$compname</TITLE>
      <LINK media=screen href="/lismega_devel/style/menu.css" rel=stylesheet>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
<Script language="JavaScript">
	<!--
		if (top == self) 
		self.location.href = "/lismega_devel/index.html";
	// -->
	</script>
      <SCRIPT LANGUAGE="JavaScript">
	document.onkeypress = mykeyhandler;

	function mykeyhandler()
	{
    	   if (window.event && window.event.keyCode == 39)
    	   {
        	window.event.cancelBubble = true;
        	window.event.returnValue = false;
        	return false;
    	   }
    	   if (window.event && window.event.keyCode == 34)
    	   {
        	window.event.cancelBubble = true;
        	window.event.returnValue = false;
        	return false;
    	   }
    	   if (window.event.ctrlKey && window.event.keyCode == 17)
    	   {
              	   cek();
    	   }
	}

         function cek()
         {
           var cekuserid=document.login.userid.value;
           if (cekuserid == "")
           {
              alert("Masukkan User ID");
              document.login.userid.focus();
              return false;
           }
	   if (document.login.userid.value.indexOf(" ") != -1)
           {
              alert("Masukkan User ID Tanpa Spasi");
              document.login.userid.focus();
              return false;
           }
           var cekuserpwd=document.login.userpwd.value;
           if (cekuserpwd == "")
           {
              alert("Masukkan Password");
              document.login.userpwd.focus();
              return false;
           }
	   if (document.login.userpwd.value.indexOf(" ") != -1)
           {
              alert("Masukkan Password Tanpa Spasi");
              document.login.userpwd.focus();
              return false;
           }
           else
           {
              document.login.submit();
              return true;
           }
         }
      </SCRIPT>
   </HEAD>
   <BODY bgColor="#FFFFFF" leftMargin=5 topMargin=2 onload=self.focus();document.login.userid.focus()>
      <div align=center>
         <form name=login action=./signin.php method=post onSubmit="return cek()">
          <BR><BR><BR><BR><BR><BR><BR>
          <table width=500 cellpadding=0 cellspacing=0 border=1 bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#FFFFFF">
            <tr>
               <td width=100% align=center valign=top>
            	 <BR>
            	 <font face=Arial style="font-size: 18;" color=black><b>Collaboration Suite</b></font>
            	 <BR>
            	 <IMG SRC=/lismega_devel/images/colaboration.jpg>
            	 <BR><BR>
            	 <table width=100% cellpadding=0 cellspacing=0 border=0>
            	    <tr>
            	       <td width=5% align=left valign=top>
            	          &nbsp
            	       </td>
            	       <td width=25% align=right valign=top>
	            	 <font face=Arial style="font-size: 12;">User ID</font>
            	       </td>
            	       <td width=5% align=left valign=top>
            	          &nbsp
            	       </td>
            	       <td width=65% align=left valign=top>
	            	 <input type=text name=userid size=20 maxlength=20>
            	       </td>
            	    </tr>
            	    <tr>
            	       <td width=5% align=left valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	       <td width=25% align=right valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	       <td width=5% align=left valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	       <td width=65% align=left valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	    </tr>
            	    <tr>
            	       <td width=5% align=left valign=top>
            	          &nbsp
            	       </td>
            	       <td width=25% align=right valign=top>
	            	 <font face=Arial style="font-size: 12;">Password</font>
            	       </td>
            	       <td width=5% align=left valign=top>
            	          &nbsp
            	       </td>
            	       <td width=65% align=left valign=top>
	            	 <input type=password name=userpwd size=20 maxlength=20>
		         <input type=submit name=btnsimpan style='height: 5.8mm;width: 25mm' value='LOGIN' onClick="javascript:cek();">
            	       </td>
            	    </tr>
            	    <tr>
            	       <td width=5% align=left valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	       <td width=25% align=right valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	       <td width=5% align=left valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	       <td width=65% align=left valign=top>
			<font style="font-size: 6;" color=white>BITSLab </font>
            	       </td>
            	    </tr>
            	    <tr>
            	       <td width=5% align=left valign=top>
            	          &nbsp
            	       </td>
            	       <td width=25% align=right valign=top>
	            	 <font face=Arial style="font-size: 12;">&nbsp</font>
            	       </td>
            	       <td width=5% align=left valign=top>
            	          &nbsp
            	       </td>
            	       <td width=65% align=left valign=top>
	            	 <font face=Arial style="font-size: 10;" color=red><b>$msg</b></font>
            	       </td>
            	    </tr>
            	 </table>
            	 <BR>
               </td>
            </tr>
          </table>
          <input type=hidden name=loginattempt value='$loginattempt'>
          <input type=hidden name=switchact value='Y'>
         </form>
      </div>
   </BODY>
</HTML>
<?
  if( $conn === true )
sqlsrv_close( $conn );
exit;
}

function FormatErrors( $errors )
{
    /* Display errors. */
    echo "Error information: <br/>";

    foreach ( $errors as $error )
    {
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
        echo "Code: ".$error['code']."<br/>";
        echo "Message: ".$error['message']."<br/>";
    }
}



?> 
