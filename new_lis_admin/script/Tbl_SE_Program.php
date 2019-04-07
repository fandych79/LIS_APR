<?php

  $act=$_POST['act'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

require_once("../lib/formatError.php");    
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

   if ($act == "edittable")
   {
      EDITTABLE();
   }
   if ($act == "savetable")
   {
      SAVETABLE();
   }
   if ($act == "savetxt")
   {
      SAVETXT();
   }
   if ($act == "deltable")
   {
      DELTABLE();
   }
   if ($act == "editdb")
   {
      EDITTABLE();
   }

function DELTABLE()
{
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
   $thecode=$_POST['thecode'];

    
require ("../lib/open_con.php");


      $tsql = "DELETE FROM Tbl_SE_Program
   					WHERE program_code='$thecode'";

      $params = array(&$_POST['query']);

      $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      if( $stmt )
      {
      } 
      else
      {
         echo "Error in preparing statement.\n";
         die( print_r( sqlsrv_errors(), true));
      }

      if( sqlsrv_execute( $stmt))
      {
      }
      else
      {
        echo "Error in executing statement.\n";
        die( print_r( sqlsrv_errors(), true));
      }

      sqlsrv_free_stmt( $stmt);

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD070";
			$logproductcode = "";
			$logdesc = "DELTbl_SE_Program";
			$logaction = "";
      $tsql = "INSERT INTO Tbl_SE_UserLog VALUES('$loguserid',getdate(), '$logipaddr',
      			   '$logprogramcode','$logproductcode','$logdesc','$logaction')";
      $params = array(&$_POST['query']);
      $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      if( $stmt )
      {
      } 
      else
      {
         echo "Error in preparing statement.\n";
         die( print_r( sqlsrv_errors(), true));
      }
      if( sqlsrv_execute( $stmt))
      {
      }
      else
      {
        echo "Error in executing statement.\n";
        die( print_r( sqlsrv_errors(), true));
      }
      sqlsrv_free_stmt( $stmt);

   EDITTABLE();

exit;
}

function SAVETABLE()
{
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
   $ctext=$_POST['ctext'];
   $ntext=$_POST['ntext'];
   $vtext=$_POST['vtext'];
   $gtext=$_POST['gtext'];
   $utext=$_POST['utext'];
   $desctext=$_POST['desctext'];
   $hdtext=$_POST['hdtext'];
   $ftext=$_POST['ftext'];
   $atext=$_POST['atext'];
   $ttext=$_POST['ttext'];
   $stext=$_POST['stext'];
   $patext=$_POST['patext'];
   $dtext=Date('Y-m-d h:m:s');

    
require ("../lib/open_con.php");
   
   $tsql = "SELECT COUNT(*) as b FROM Tbl_SE_Program
   					WHERE program_code='$ctext'";
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
      	 $rowcount = $row['b'];
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   
   if ($rowcount > 0)
   {
      $tsql = "UPDATE Tbl_SE_Program SET program_name = '$ntext',
											program_version = '$vtext',
											program_group = '$gtext',
											program_urut = '$utext',
											program_desc = '$desctext',
											program_helpdoc = '$hdtext',
											program_flag = '$ftext',
											program_active = '$atext',
											program_create_userid = '$userid',
											program_create_time = '$dtext',
											program_time = '$ttext',
											program_score = '$stext',
											program_action = '$patext'
											where program_code = '$ctext'";
   }
   else
   {
      $tsql = "INSERT INTO Tbl_SE_Program VALUES('$ctext','$ntext','$vtext','$gtext','$utext','$desctext','$hdtext','$ftext','$atext','$userid','$dtext','$ttext','$stext','$patext')";
   }

      $params = array(&$_POST['query']);

      $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      if( $stmt )
      {
      } 
      else
      {
         echo "Error in preparing statement.\n";
         die( print_r( sqlsrv_errors(), true));
      }

      if( sqlsrv_execute( $stmt))
      {
      }
      else
      {
        echo "Error in executing statement.\n";
        die( print_r( sqlsrv_errors(), true));
      }

      sqlsrv_free_stmt( $stmt);

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = "AD070";
			$logproductcode = "";
			$logdesc = "CHGTbl_SE_Program";
			$logaction = "";
      $tsql = "INSERT INTO Tbl_SE_UserLog VALUES('$loguserid',getdate(), '$logipaddr',
      			   '$logprogramcode','$logproductcode','$logdesc','$logaction')";
      $params = array(&$_POST['query']);
      $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      if( $stmt )
      {
      } 
      else
      {
         echo "Error in preparing statement.\n";
         die( print_r( sqlsrv_errors(), true));
      }
      if( sqlsrv_execute( $stmt))
      {
      }
      else
      {
        echo "Error in executing statement.\n";
        die( print_r( sqlsrv_errors(), true));
      }
      sqlsrv_free_stmt( $stmt);

   EDITTABLE();

exit;
}

function SAVETXT()
{
   $tablename=$_POST['tablename'];
   $tabledesc=$_POST['tabledesc'];
   $tempfield=$_POST['tempfield'];
   $datafield=explode(",",$tempfield);
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

    $countfield = 0;
   	foreach ($datafield as $t)
		{
			 $countfield++;
    }
   $prikey=$_POST[$datafield[0]];

    
require ("../lib/open_con.php");


   $ourFileName = "../version/" . $tablename . ".bfn";
   $ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
   $line = "code|desc\n";
   fwrite($ourFileHandle,$line);

   $tsql = "SELECT * FROM $tablename";
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
      	 $line = "";
         for ($zz=0;$zz<$countfield-1;$zz++)
         {
         	  $vartemp = "chk" . $datafield[$zz];
            $varvalue=$_POST[$vartemp];
            if ($varvalue == "Y")
            {
   				     $line .= $row[$datafield[$zz]] . "|";
            }
         }
         if ($line != "")
         {
         	  $line = substr($line,0,strlen($line)-1) . "\n";
            fwrite($ourFileHandle,$line);
         }
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   fclose($ourFileHandle);
   
?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      	<title>TXT</title>
      <script src='./javabits.js' language='Javascript'></script>
      </head>
      <body>
   	   <div align=center>
   	      <table width="760" border=0 cellpadding=0 cellspacing=0>
   	      	<tr>
   	      		<td width=50% align=left valign=top>
   	      			<form name=formsec method=post>
  							   <input type=hidden name=userid value=<? echo $userid; ?>>
  					  	   <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
   	      			</form>
     	   	       <A HREF="javascript:changeMenu('../maintaintable.php')"><font face=Arial size=2>Back To Main</font></A>
   	      		</td>
   	      		<td width=50% align=left valign=top>
     	   	       <A HREF="../version/<? echo $tablename; ?>.bfn"><font face=Arial size=2>Click Here To Download <? echo $tablename; ?>.bfn</font></A>
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	   </div>      	
      </body>    
   </html>
<?
   require("../lib/close_con.php");

exit;
}

function EDITTABLE()
{
   $tablename=$_POST['tablename'];
   $tabledesc=$_POST['tabledesc'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];

    
require ("../lib/open_con.php");

   $tempfield = "";
   $tsql = "SELECT * FROM INFORMATION_SCHEMA.Columns WHERE TABLE_NAME = '$tablename'";
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
      	 $tempfield .= $row['COLUMN_NAME'] . ",";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
   $datafield=explode(",",$tempfield);

    $countfield = 0;
   	foreach ($datafield as $t)
		{
			 $countfield++;
    }

   $tsql = "SELECT COUNT(*) as b FROM $tablename";
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
	  <link href="../js/d.css" rel="stylesheet" type="text/css" />
      <script src='./javabits.js' language='Javascript'></script>
      <script src='./javabits.js' language='Javascript'></script>
      <Script language="Javascript">
<?
   $tsql = "SELECT * FROM $tablename
   					ORDER BY $datafield[0]";
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
         $vartemp = "var D" . $row[$datafield[0]] . "=  new Array(";
        for ($zz=0;$zz<$countfield-1;$zz++)
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
<?
         for ($zz=0;$zz<$countfield-1;$zz++)
         {
						$aa = $datafield[$zz];
?>
	   		    eval("document.formsubmit.<? echo $aa; ?>.value=" + selectedArray[<? echo $zz; ?>]);
<?
         }
?>
        }
        function goNew()
        {        	
<?
         for ($zz=0;$zz<$countfield-1;$zz++)
         {
						$aa = $datafield[$zz];
						$varvalue = "";
									if (substr($datafield[$zz],strlen($datafield[$zz])-11) == "create_time")
									{										
										$varvalue = date('Y-m-d h:m:s');
								  }
									if (substr($datafield[$zz],strlen($datafield[$zz])-13) == "create_userid")
									{										
										$varvalue = "admin";
								  }
?>
	   		    document.formsubmit.<? echo $aa; ?>.value='<? echo $varvalue; ?>';
<?
         }
?>
        }
        function cekDel(thecode)
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "deltable";
           document.formsubmit.thecode.value = thecode;
           document.formsubmit.action = "./Tbl_SE_Program.php";
           submitform = window.confirm("Are your sure to DELETE ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function cekTXT()
        {
           document.formsubmit.target = "utama";
           document.formsubmit.act.value = "savetxt";
           document.formsubmit.action = "./domaintaintable.php";
           submitform = window.confirm("Are your sure to CREATE TXT ?")
           if (submitform == true)
           {
              document.formsubmit.submit();
           }
        }
        function cekSave()
        {
			var vcode = document.formsubmit.ctext;
			var vname = document.formsubmit.ntext;
			
			if(vcode.value.trim().length == 0){
				 alert("Code harus diisi ");
				 vcode.focus();
				 return false;
			}
			else if(vname.value.trim().length == 0){
				 alert("Name harus diisi ");
				 vname.focus();
				 return false;
			}
			else{
				document.formsubmit.target = "utama";
				document.formsubmit.act.value = "savetable";
				document.formsubmit.action = "./Tbl_SE_Program.php";
				submitform = window.confirm("Are your sure to SAVE ?")
				if (submitform == true)
				{
				  document.formsubmit.submit();
				}
			}
        }
		function cekEdit(thekey)
        {
           document.formsubmit.target = "utama";
		   document.formsubmit.act.value = "editdb";
           document.formsubmit.thekey.value = thekey;
           document.formsubmit.action = "./Tbl_SE_Program.php";
		   document.formsubmit.submit();
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
<?
	$thekey = $_POST['thekey'];
	//echo $thekey;
	
	$tsql = "SELECT * FROM Tbl_SE_Program
					WHERE program_code='$thekey'";
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
			$tcode = $row['program_code'];
			$tname = $row['program_name'];
			$tversion = $row['program_version'];
			$tgroup = $row['program_group'];
			$turut = $row['program_urut'];
			$tdesc = $row['program_desc'];
			$thelp = $row['program_helpdoc'];
			$tflag = $row['program_flag'];
			$tactive = $row['program_active'];
			$ttime = $row['program_time'];
			$tscore = $row['program_score'];
			$taction = $row['program_action'];
		}
	}
	//echo $tcode;

	if($thekey=="")
	{
		$bse = 'Save';
	}else{
		$bse = 'Update';
	}
?>
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
   	      		</td>
   	      	</tr>
   	      </table>
   	      <BR><BR>
   	      <table width="1000" border=0 cellpadding=0 cellspacing=0>
   	  	      <tr>
   	  	      	<td class="classsubtitle">
   	  	      		<form name=formsubmit method=post>
					<?=strtoupper($tabledesc)?>
					<div style="float:right;margin-bottom:10px;"><A HREF="javascript:changeMenu('../maintaintable.php')">Back To Main</A></div>
				</td>
			  </tr>
			  <tr>
				<td width="100%" style="padding-bottom:10px;padding-top:10px;">
					<table border="0">
						<tr>
							<td>
								Code 
							</td>
							<td>
								: <input type="text" name="ctext" id="ctext" value="<?=$tcode?>" style="width:50px;margin-right:10px;">
							</td>
							<td>
								Name 
							</td>
							<td>
							: <input type="text" name="ntext" id="ntext" value="<?=$tname?>" style="width:100px;margin-right:10px;">
							</td>
							<td>
								Version
							</td>
							<td>
								: <input type="text" name="vtext" id="vtext"  value="<?=$tversion?>"style="width:50px;margin-right:10px;">
							</td>
							<td>
								Group 
							</td>
							<td>
								: <input type="text" name="gtext" id="gtext"  value="<?=$tgroup?>"style="width:50px;margin-right:10px;">
							</td>
						</tr>
						<tr>
							<td>
								Urut
							</td>
							<td>
								: <input type="text" name="utext" id="utext" value="<?=$turut?>" style="width:50px;margin-right:10px;">
							</td>
							<td>
								Description 
							</td>
							<td>
								: <input type="text" name="desctext" id="desctext" value="<?=$tdesc?>" style="width:100px;margin-right:10px;">
							</td>
							<td>
								Help Doc
							</td>
							<td>
								: <input type="text" name="hdtext" id="hdtext" value="<?=$thelp?>" style="width:50px;margin-right:10px;">
							</td>
							<td>
								Flag 
							</td>
							<td>
								: <input type="text" name="ftext" id="ftext" value="<?=$tflag?>" style="width:50px;margin-right:10px;">
							</td>
						</tr>
						<tr>
							<td>
								Active 
							</td>
							<td>
								: <input type="text" name="atext" id="atext" value="<?=$tactive?>" style="width:50px;margin-right:10px;">
							</td>
							<td>
								Program Time
							</td>
							<td>
								: <input type="text" name="ttext" id="ttext" value="<?=$ttime?>" style="width:100px;margin-right:10px;">
							</td>
							<td>
								Program Score 
							</td>
							<td>
								: <input type="text" name="stext" id="stext" value="<?=$tscore?>" style="width:100px;margin-right:10px;">
							</td>
							<td>
								Program Action
							</td>
							<td>
								: <input type="text" name="patext" id="patext" value="<?=$taction?>" style="width:50px;margin-right:10px;">
							</td>
							<td rowspan="3">
								<input type="button" name="btnsave" id="btnsave" value="<?=$bse?>" onclick="cekSave()">
							</td>
						</tr>
					</table>
				</td>
			  </tr>
			  <tr>
				<td width=100% align=left valign=top>
							<center>
								<div style="overflow-y:scroll; height:350px;">
								<div style="position:fixed;border:0px solid red;">
								<table class="tablein" border="1">
									<tr align="center" height="20px">
										<th width="49px">Code</th>
										<th width="199px">Name</th>
										<th width="50px">Version</th>
										<th width="50px">Group</th>
										<th width="50px">Urut</th>
										<th width="139px">Description</th>
										<th width="50px">Help Doc</th>
										<th width="56px">Flag</th>
										<th width="50px">Active</th>
										<th width="50px">Time</th>
										<th width="50px">Score</th>
										<th width="50px">Action</th>
										<th width="100px"></th>
									</tr>
								</table>
								</div>
								<table class="tablein" border="1" style="margin-top:30px;">
									<tr align="center">
										<th width="50px"></th>
										<th width="200px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="50px"></th>
										<th width="100px"></th>
									</tr>
<?
									$strsql="select * from Tbl_SE_Program";
									$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
									$params = array(&$_REQUEST['query']);
									$sqlConn = sqlsrv_query($conn, $strsql, $params, $cursorType);
									if ( $sqlConn === false){die( FormatErrors( sqlsrv_errors()));}
									$rowCounter = sqlsrv_num_rows($sqlConn);
									if(sqlsrv_has_rows($sqlConn))
									{      
										while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_BOTH))
										{
?>
									<tr align="center" style="line-height:20px">
										<td><?=$row[0]?></td>
										<td><?=$row[1]?></td>
										<td><?=$row[2]?></td>
										<td><?=$row[3]?></td>
										<td><?=$row[4]?></td>
										<td><?=$row[5]?></td>
										<td><?=$row[6]?></td>
										<td><?=$row[7]?></td>
										<td><?=$row[8]?></td>
										<td><?=$row[11]?></td>
										<td><?=$row[12]?></td>
										<td><?=$row[13]?></td>
										<td>
											<a href="javascript:cekEdit('<?=$row[0]?>');"><img src="../images/icon/edit.png" width="20px" style="border-color:#FFFFFF;" height="20px"></a>
											<a href="javascript:cekDel('<? echo $row[0]?>');"><img src="../images/icon/delete.png" style="border-color:#FFFFFF;margin-top:5px;margin-left:10px;" width="20px" height="20px"></a>
										</td>
									</tr>
<?
										}
									}
?>
								</table>
								</div>
							</center>
    								 <input type=hidden name=act>
    								 <input type=hidden name=tablename value='<? echo $tablename; ?>'>
    								 <input type=hidden name=tabledesc value='<? echo $tabledesc; ?>'>
    								 <input type=hidden name=tempfield value='<? echo $tempfield; ?>'>
    								 <input type=hidden name=thekey>
    								 <input type=hidden name=thecode>
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
