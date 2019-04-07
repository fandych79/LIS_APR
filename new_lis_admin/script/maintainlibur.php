<?php

  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $userprogramact="maintainlibur.php";

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
  global $userprogramact;
  $thn1 = "";
  if (isset($_POST['thn1']))
  {
  	$thn1 = $_POST['thn1'];
  }


	$varyear = Date('Y');

   if ($thn1 == "")
   {
   	$thn1 = $varyear;
   }

   $vartemp = floor($thn1/4);
   $kabisat = ($thn1 / 4) - $vartemp;

   if ($kabisat <= 0)
   {
   	$arrjumlahhari = array(0,31,29,31,30,31,30,31,31,30,31,30,31);
   }
   else
   {
   	$arrjumlahhari = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
   }
   $arrnamahari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
   $arrnamabulan = array('','JANUARI','FEBRUARI','MARET','APRIL','MEI','JUNI','JULI','AGUSTUS','SEPTEMBER','OKTOBER','NOVEMBER','DESEMBER');

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
              document.formsubmit.act.value='save';
              document.formsubmit.action = "./do_maintainlibur.php";
           		varmsg = "Are your sure to SAVE ? ";
           		submitform = window.confirm(varmsg);
           		if (submitform == true)
           		{
              	document.formsubmit.submit();
           		}
           		else
           		{
           			return false;
           		}
				}
				function gantitahun()
				{
           document.formsubmit.act.value = "";
              document.formsubmit.target = "utama";
              document.formsubmit.action = "./maintainlibur.php";
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
   	  	      	 <font face=Arial size=3><b>MAINTAIN HARI LIBUR</b></font>
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
      	                	<td width=95% align=left valign=top>
      	                	   	    <font face=Arial size=2>Isi Tabel Hari Libur Tahun</font>
      	                	   	    <select name=thn1 onChange=gantitahun()>
<?
			for($i=$varyear-1;$i<$varyear+20;$i++)
			{
			   if ($i == $thn1)
			   {
				echo "<option value='$i' selected>$i</option>";
			   }
			   else
			   {
				echo "<option value='$i'>$i</option>";
			   }
			}
?>
      	                	   	    </select>
      	                	</td>
      	               </tr>
      	            </table>
      	                  <BR>
<?
			for ($i=1;$i<count($arrnamabulan);$i++)
			{
			  echo "<BR><font face=Verdana size=2 color=blue><B>$arrnamabulan[$i]</b><TABLE WIDTH=100% CELLPADDING=1 CELLSPACING=1 border=0><tr>";
			  for($j=0;$j<count($arrnamahari);$j++)
			  {
				echo "<td width=14% align=left valign=top>$arrnamahari[$j]</td>";
			  }
                  	     echo "</tr><tr>";
			  $saklar = 0;
			  for($k=1;$k<=$arrjumlahhari[$i];$k++)
			  {
//			  					$weekday = Date('w');

			  					if ($i<10)
			  					{
			  						$vari = "0" . $i;
			  					}
			  					else
			  					{
			  						$vari = $i;
			  					}
			  					if ($k<10)
			  					{
			  						$vark = "0" . $k;
			  					}
			  					else
			  					{
			  						$vark = $k;
			  					}
			  					$liburtanggal = $thn1 . "-" . $vari . "-" . $vark;
			  					$vartanggal = $thn1 . $vari . $vark;

							$tsql = "SELECT DATEPART(dw,'$liburtanggal')";
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
											$weekday = $row[0] - 1;
   									}
      				}
   						sqlsrv_free_stmt( $sqlConn );

		      	      if ($saklar <= 0)
		      	      {
		      	      	$saklar = 1;
		      	         for ($l=0;$l<$weekday;$l++)
		      	         {
		      	      	    echo "<td width=15% align=left valign=top>&nbsp</td>\n";
		      	         }
		      	      }

									$countadalibur = 0;
									$tsql = "SELECT COUNT(*)
			      		    				FROM TblHariLibur
			      		    				WHERE libur_year='$thn1'
			      		    				AND libur_tanggal='$liburtanggal'";
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
											$countadalibur = $row[0];
   									}
      						}
   								sqlsrv_free_stmt( $sqlConn );

		      	      if ($countadalibur > 0)
		      	      {
		      	      	$statuschecked = "checked";
		      	      }
		      	      else
		      	      {
		      	      	if ($weekday == 6 || $weekday == 0)
		      	      	{
		      	      	   $statuschecked = "checked";
		      	      	}
		      	      	else
		      	      	{
		      	      	   $statuschecked = "";
		      	      	}
		      	      }
		      	      echo "<td width=15% align=left valign=top><input type=checkbox name=D$vartanggal value='Y' $statuschecked>$k</td>\n";
		      	      if ($weekday == 6)
		      	      {
		      	      	print "</tr><tr>\n";
		      	      }
			  }
                          echo "</table>";
			}
?>
                          <BR>
    								 <input type=hidden name=actionhistory value=''>
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
    								 <center><input type=button value='SIMPAN DATA' onclick=cekthis() style="width:100mm"></center>
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

