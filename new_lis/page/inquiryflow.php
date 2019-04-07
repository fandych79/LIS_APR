<?php
$userid=$_REQUEST['userid'];
$userpwd=$_REQUEST['userpwd'];
$userbranch=$_REQUEST['userbranch'];
$userregion=$_REQUEST['userregion'];
$userwfid=$_REQUEST['userwfid'];

include ("../lib/formatError.php");
require ("../lib/open_con.php");
require ("../lib/open_con_dm.php");
  	
$kondisibranch = "";
$kondisiregion = "";
$status_option_branch = "";
$status_ao_branch = "";
//echo substr($userbranch,0,1);
if(substr($userbranch,0,1) == "8")
{
	if($userbranch != "888")
	{
		//REGION
		$kondisibranch = "and branch_region_code = '$userbranch'";
		$status_option_branch = "<option value='$userbranch'>REGION $userbranch</option>";
	}
	else
	{
		$status_option_branch = "<option value='$userbranch'>KPNO $userbranch</option>";
		$kondisiregion = "AND region_code='$userregion'";
	}
	
}
else
{
	//BRANCH
	$kondisibranch = "and branch_code = '$userbranch'";
	$status_ao_branch = "WHERE ao_branch_code='$userbranch'";
		$kondisiregion = "AND region_code='$userregion'";
}
?>
<HTML>
   <HEAD>
      <META http-equiv=Content-Type content='text/html; charset=iso-8859-1'>
      <META http-equiv='Pragma' content='no-cache'>
      <META content='MSHTML 5.50.4134.100' name=GENERATOR>
      <TITLE>SPIN UPLOAD</TITLE><LINK href="/lismega_devel/style/style.html" rel=stylesheet type=text/css>
      <script type="text/javascript" src="/lismega_devel/lib/datetimepicker_css.js"></script>
      <Script Language="JavaScript">
<?
	$tsql = "select branch_code from tbl_branch 
						WHERE branch_code<>''
						$kondisibranch";
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
				echo "var D$row[0] =  new Array(";
      	echo "\"('--All AO--','')\"";
   			  $tsql2 = "SELECT ao_code,ao_code,ao_name
							 FROM Tbl_AO
							 WHERE ao_branch_code='$row[0]'";
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   {
      		   	  echo ",\"('[$row2[0]] $row2[1] - $row2[2]','$row2[1]')\"\n";
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );
   	      echo ");\n";
     }
  }
  sqlsrv_free_stmt( $sqlConn );

?>
	  function viewAO()
	  {
	  	 selected = document.formsubmit.repbranch.options[document.formsubmit.repbranch.selectedIndex].value;
	     var index = 0;
	     for (i = index; i < document.formsubmit.repao.options.length; i++)
	     {
    		document.formsubmit.repao.options.length = 0;
	     }
	     var selectedArray = eval("D" + selected);
	     for (var i=0; i < selectedArray.length; i++)
	     {	     	  
	        eval("document.formsubmit.repao.options[i]=" + "new Option" + selectedArray[i]);
	     }
	     document.formsubmit.repao.options[0].selected=true;
	  }
      </Script>
   </HEAD>
   <BODY onload=viewAO()>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
      <div align=center>
        <form name=formsubmit method=post action=./doinquiryflow.php>
      	  <table width="800" cellSpacing=0 cellPadding=13 border=0 style="border:1px solid #aaaaaa">
						<tr>
							<td class=backGr align=center>
							   <b>INQUIRY FLOW</b>
						  </td>
				    </tr> 
						<tr>
							<td class=form1>
								Menu ini berfungsi untuk menampilkan Data Nasabah berdasarkan kriteria tertentu
						  </td>
				   </tr>		
          </table>
          <BR><BR>
      	  <table width="800" cellSpacing=0 cellPadding=0 border=0>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
      	  			 &nbsp
      	  		</td>
      	  		<td width=28% align=left valign=top>
      	  			 <font face=Arial size=2>Jenis Fasilitas</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=repfacility style='width: 70mm'>
   	  	      		   	      				<option value=''>--Semua--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_KodeProduk
						ORDER BY produk_loan_type";
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
   	  	      			         <option value='<? echo $row[0]; ?>'><? echo $row[0]; ?> - <? echo $row[2]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
      	  			 <font face=Arial size=2 color=red>NOT ACTIVE NOW</font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
      	  			 &nbsp
      	  		</td>
      	  		<td width=28% align=left valign=top>
      	  			 <font face=Arial size=2>Region / Cabang</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=repbranch style='width: 70mm' onChange=viewAO()>
<?
echo $status_option_branch;
$sql_query = "select * from tbl_branch 
							WHERE branch_code<>''
							$kondisibranch";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $sql_query, $params, $cursorType);
if ( $sqlConn === false)
{
die( FormatErrors( sqlsrv_errors() ) );
}
if(sqlsrv_has_rows($sqlConn))
{
$rowCount = sqlsrv_num_rows($sqlConn);
while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
{
print "<option value='$row[branch_code]'>$row[branch_code] - $row[branch_name]</option>";
}
}
sqlsrv_free_stmt( $sqlConn);
?>
   	  	      		   	      			</select>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    &nbsp
      	  		</td>
      	  		<td width=28% align=left valign=top>
      	  			 <font face=Arial size=2>AO</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <select name=repao style='width: 70mm'>
				    	    	<option value=''>--Semua--</option>
				    	    </select>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
      	  			 &nbsp
      	  		</td>
      	  		<td width=28% align=left valign=top>
      	  			 <font face=Arial size=2>Progress</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
   	  	      		   	      			<select name=repstatus style='width: 70mm'>
   	  	      		   	      				<option value=''>--Semua--</option>
<?
   $tsql = "SELECT *
						FROM Tbl_Workflow
						WHERE wf_proc_code <> 'HID'
						ORDER BY wf_urut";
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
					print "<option value='$row[wf_id]'>$row[wf_id] - $row[wf_name]</option>";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
   	  	      		   	      			</select>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    &nbsp
      	  		</td>
      	  		<td width=28% align=left valign=top>
      	  			 <font face=Arial size=2>Customer ID</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <input type=text name=repnomid size=20 maxlength=20>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font face=Arial size=2>&nbsp</font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font face=Arial size=2>Create Col(s)</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
<?
	$tsql = "select COUNT(*)
						FROM Tbl_ReportMaster
						WHERE rep_table='Tbl_CustomerMasterPerson'
						AND rep_hidden<>'Y'";
  $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
  $params = array(&$_POST['query']);
  $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

  $hitreport = 0;	
	if($sqlConn === false)
	{
				die(FormatErrors(sqlsrv_errors()));
	}
	
	if(sqlsrv_has_rows($sqlConn))
	{
     $rowCount = sqlsrv_num_rows($sqlConn);
     while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
     {
  			$hitreport = $row[0];	
     }
  }
  sqlsrv_free_stmt( $sqlConn );
  print "<input type=hidden name=hitreport value='$hitreport'>";


  $hittd = 0;	
  $hitcol = 0;
  for ($i=0;$i<$hitreport;$i++)
  {
     	   $hittd++;
     	   $hitcol++;
     	   if ($hittd > 3)
     	   {
     	   	   print "<br>";
     	   }
					print "<select name=col$hitcol style=\"background-color:#FF0\">";
     			print "<option value=''></option>";
			$tsql = "select *
						FROM Tbl_ReportMaster
						WHERE rep_table='Tbl_CustomerMasterPerson'
						AND rep_hidden<>'Y'";
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
     			print "<option value='$row[1]'>$row[2]</option>";
     		}
  		}
  		sqlsrv_free_stmt( $sqlConn );

				  print "</select>\n";
  }
?>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font face=Arial size=2>&nbsp</font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font face=Arial size=2>Sort By</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
<?
  $hittd = 0;	
  $hitcol = 0;
  for ($i=0;$i<2;$i++)
  {
     	   $hittd++;
     	   $hitcol++;
					print "<select name=sort$hitcol style=\"background-color:#FF0\">";
     			print "<option value=''></option>";
			$tsql = "select *
						FROM Tbl_ReportMaster
						WHERE rep_table='Tbl_CustomerMasterPerson'
						AND rep_hidden<>'Y'";
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
     			print "<option value='$row[1]'>$row[2]</option>";
     		}
  		}
  		sqlsrv_free_stmt( $sqlConn );

				  print "</select>\n";
					print "<select name=asc$hitcol style=\"background-color:#FF0\">";
     			print "<option value=''>Ascending</option>";
     			print "<option value='DESC'>Descending</option>";
				  print "</select>\n";
     	   	   print "<br>";
  }
?>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=28% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
				    	    <font style="font-size: 6;" color=white>SPINInfo </font>
      	  		</td>
      	  	</tr>
      	  	<tr>
      	  		<td width=2% align=left valign=top>
				    	    &nbsp
      	  		</td>
      	  		<td width=28% align=left valign=top>
      	  			 <font face=Arial size=2>Output</font>
      	  		</td>
      	  		<td width=70% align=left valign=top>
      	  			  <select name=theoutput style="background-color:#FF0">
      	  			  	 <option value='screen'>Screen</option>
      	  			  	 <option value='text'>Text</option>
      	  			  	 <option value='all'>Screen & Text</option>
      	  			  </select>
				    	    <input type=submit value='SUBMIT'>
      	  		</td>
      	  	</tr>
          </table>
          	<input type=hidden name=act value='simpandata'>
    				<input type=hidden name=userid  value='<? echo $userid; ?>'>
    				<input type=hidden name=userpwd value='<? echo $userpwd; ?>'>
    				<input type=hidden name=userbranch value='<? echo $userbranch; ?>'>
    				<input type=hidden name=userregion value='<? echo $userregion; ?>'>
    				<input type=hidden name=userwfid  value='<? echo $userwfid; ?>'>
    				<input type=hidden name=approvepermission>
        </form>
     </div>
   </BODY>
</HTML>
 
