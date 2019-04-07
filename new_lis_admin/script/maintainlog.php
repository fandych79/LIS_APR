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

   $act = "";

   if ($act == "")
   {
      MAIN();
   }


function MAIN()
{

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
    
require ("../lib/open_con.php");

	$tsql = "SELECT convert(varchar,getdate(),120)";
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
   		   $signintime = $row[0];
   		   $datenow = substr($row[0],1-1,4)  . "/" . substr($row[0],6-1,2) . "/" . substr($row[0],9-1,2);
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
				function cekthis()
				{
              document.formsubmit.target = "utama";
              document.formsubmit.act.value='cekjob';
              document.formsubmit.action = "./do_maintainlog.php";
		   				document.formsubmit.submit();
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
   	  	      	 <font face=Arial size=3><b>AUDIT TRAIL</b></font>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td width=100% align=left valign=top>
   	  	      		<form name=formsubmit method=post>
      	            <table width=100% cellpadding=2 cellspacing=2 border=0>
      	               <tr>
      	                	<td width=5% align=left valign=top>
      	                	   	        &nbsp
      	                	</td>
      	                	<td width=30% align=left valign=top>
      	                	   	    <font face=Arial size=2>User ID</font>
      	                	</td>
      	                	<td width=65% align=left valign=top>
      	                		   <input type=text name=loguserid size=30 maxlength=30 style="background-color:#FF0">
      	                	</td>
      	               </tr>
      	               <tr>
      	                	<td width=5% align=left valign=top>
      	                	   	        &nbsp
      	                	</td>
      	                	<td width=30% align=left valign=top>
      	                	   	    <font face=Arial size=2>Workstation</font>
      	                	</td>
      	                	<td width=65% align=left valign=top>
      	                		   <input type=text name=logworkstation size=30 maxlength=30 style="background-color:#FF0">
      	                	</td>
      	               </tr>
      	               <tr>
      	                	<td width=5% align=left valign=top>
      	                	   	        &nbsp
      	                	</td>
      	                	<td width=30% align=left valign=top>
      	                	   	    <font face=Arial size=2>Program Code</font>
      	                	</td>
      	                	<td width=65% align=left valign=top>
      	                	   	    <select name=logprogramcode style="background-color:#FF0">
      	                	   	       <option value='' selected>-- Semua --</option>
<?
	$tsql = "SELECT program_code, program_name FROM Tbl_SE_Program
					ORDER BY program_code";
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
   		   echo "<option value='$row[0]'>$row[0] - $row[1]</option>";
      }
   }
   sqlsrv_free_stmt( $sqlConn );

	$tsql = "SELECT programcode, programname FROM Tbl_ProgramAdmin
					ORDER BY programcode";
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
   		   echo "<option value='$row[0]'>$row[0] - $row[1]</option>";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      	                	   	    </select>
      	                	</td>
      	               </tr>
      	               <tr>
      	                	<td width=5% align=left valign=top>
      	                	   	        &nbsp
      	                	</td>
      	                	<td width=30% align=left valign=top>
      	                	   	    <font face=Arial size=2>Periode</font>
      	                	</td>
      	                	<td width=65% align=left valign=top>
      	                	   	    <select name=logmonth>
      	                	   	    	<option value=''>-- Semua --</option>
<?
		$varyear = substr($signintime,0,4);
		for($i=1;$i<=12;$i++)
		{
			if ($i < 10)
			{
				$vari = "0" . $i;
			}
			else
			{
				$vari = $i;
			}
			$vartime = substr($signintime,1-1,5) . $vari  . "-01";
			$tsql = "SELECT DATENAME(month, CAST('$vartime' AS datetime))";
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
		   			if ($i == substr($signintime,5,2))
		   			{
		   				echo "<option value='$vari' selected>$row[0]</option>";
		   			}
		   			else
		   			{
		   				echo "<option value='$vari'>$row[0]</option>";
		   			}
      		}
   		}
   		sqlsrv_free_stmt( $sqlConn );
		}
?>
      	                	   	    </select>
      	                	   	    <select name=logyear>
      	                	   	    	<option value=''>-- Semua --</option>
<?
		for($i=$varyear-5;$i<=$varyear;$i++)
		{
		   if ($i == $varyear)
		   {
		   	print "<option value='$i' selected>$i</option>";
		   }
		   else
		   {
		   	print "<option value='$i'>$i</option>";
		   }
		}
?>
      	                	   	    </select>
      	                	</td>
      	               </tr>
      	               <tr>
      	                	<td width=5% align=left valign=top>
      	                	   	        &nbsp
      	                	</td>
      	                	<td width=30% align=left valign=top>
      	                	   	    &nbsp
      	                	</td>
      	                	<td width=65% align=left valign=top>
      	            			   <input type=button value='Search' style="width: 55mm;" onclick=cekthis()>
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
      					  <BR>
      					  <BR><BR>
      	       </td>
      	    </tr>
         </table>
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

