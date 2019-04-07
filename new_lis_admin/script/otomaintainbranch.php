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

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $paramtitle="BRANCH";
  $paramaction="domaintainbranch.php";
  $paramtable="OTO_Tbl_Branch";
  $paramfield="branch_code";
   require ("../lib/open_con.php");

?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>LIS PARAM</title>
      <LINK media=screen href="../style/menu.css" rel=stylesheet>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
      	 function goSave()
      	 {
				   varreturn = "";
           arrdata = document.formsubmit.thedata.value.split('|');
				   for (vari=0;vari<arrdata.length-1;vari++)
				   {
				   	   if (eval("document.formsubmit.D" + arrdata[vari] + ".checked == true"))
				   	   {
				   	   	   varreturn = varreturn + arrdata[vari] + "|";
				   	   }
				   }
				   if (varreturn == "")
				   {
				      alert ("Berikan tanda centang");
				      return false;
				   }
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "otosave";
           		document.formsubmit.action = "./<? echo $paramaction ?>";
           		varmsg = "Otorisasi Data Yang Dicentang ?";
           		submitform = window.confirm(varmsg);
           		if (submitform == true)
           		{
              	document.formsubmit.submit();
           		}      	 	  
      	 }
      	 function deletedata(theid,thetime,thecode)
      	 {
           		document.formsubmit.target = "utama";
           		document.formsubmit.act.value = "otodel";
           		document.formsubmit.theid.value = theid;
           		document.formsubmit.thetime.value = thetime;
           		document.formsubmit.thecode.value = thecode;
           		document.formsubmit.action = "./dootodel.php";
           		varmsg = "Delete Data ?" + "\n" + "User : " + theid + "\n" + "Time : " + thetime + "\n" + "Code : " + thecode + "\n";
           		submitform = window.confirm(varmsg);
           		if (submitform == true)
           		{
              	document.formsubmit.submit();
           		}      	 	  
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
   	  	      	 <font face=Arial size=3><b>OTORISASI <? echo $paramtitle ?></b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <form name=formsubmit method=post>
   	        <table width="760" border=1 cellpadding=0 cellspacing=0>
   	        	<tr>
   	        		<td width=15% align=center valign=top>
   	        			<font face=Arial size=2><b>USER ID</b></font>
   	        		</td>
   	        		<td width=15% align=center valign=top>
   	        			<font face=Arial size=2><b>TIME</b></font>
   	        		</td>
   	        		<td width=50% align=center valign=top>
   	        			<font face=Arial size=2><b>DESCRIPTION</b></font>
   	        		</td>
   	        		<td width=15% align=center valign=top>
   	        			<font face=Arial size=2><b>APPROVE</b></font>
   	        		</td>
   	        		<td width=10% align=center valign=top>
   	        			<font face=Arial size=2><b>DELETE</b></font>
   	        		</td>
   	        	</tr>
<?
   $thedata = "";
   $tsql = "SELECT system_userid,system_time,system_desc, $paramfield
   					 FROM $paramtable
   					ORDER BY system_time";
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
      	$logdesc = "";
        $arrdesc=explode("//",$row[2]);
        for($zz=0;$zz<count($arrdesc);$zz++)
        {
        	$logdesc .= $arrdesc[$zz] . "<BR>";
        }
        $thedata .= $row[0] . $row[3] . "|";
?>
   	        	<tr>
   	        		<td width=15% align=center valign=top>
   	        			<font face=Arial size=2><? echo $row[0] ?></font>
   	        		</td>
   	        		<td width=15% align=left valign=top>
   	        			<font face=Arial size=2><? echo $row[1] ?></font>
   	        		</td>
   	        		<td width=50% align=left valign=top>
   	        			<font face=Arial size=2><? echo $logdesc ?></font>
   	        		</td>
   	        		<td width=15% align=center valign=top>
   	        			<input type=checkbox value='Y' name=D<? echo $row[0] ?><? echo $row[3] ?> checked>
   	        		</td>
   	        		<td width=10% align=center valign=top>
   	        			<A HREF="javascript:deletedata('<? echo $row[0] ?>','<? echo $row[1] ?>','<? echo $row[3] ?>')"><font face=Arial size=2><b>DEL</b></font></A>
   	        		</td>
   	        	</tr>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
    	      </table>
    	      <BR>
    				<input type=hidden name=thedata value='<? echo $thedata ?>'>
    	      <input type=button value='OTORISASI SEMUA YANG DICENTANG' onClick=goSave()>
    					<input type=hidden name=act>
    					<input type=hidden name=theid>
    					<input type=hidden name=thetime>
    					<input type=hidden name=thecode>
    					<input type=hidden name=paramtable value='<? echo $paramtable ?>'>
    					<input type=hidden name=paramfield value='<? echo $paramfield ?>'>
    					<input type=hidden name=utilwindow>
    					<input type=hidden name=utilformname>
    					<input type=hidden name=utilformfield>
    					<input type=hidden name=utilfieldvalue>
    					<input type=hidden name=utilfielddest>
    				  <input type=hidden name=utildetail>
							<input type=hidden name=userid value=<? echo $userid; ?>>
							<input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	  	   </form>
   	   </div>
   </body>
</html>
<?
   require("../lib/close_con.php");
exit;
}



?> 
