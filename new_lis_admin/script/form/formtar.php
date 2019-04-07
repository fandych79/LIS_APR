<?php
  $userid=$_GET['userid'];
  $userpwd=$_GET['userpwd'];
  $userbranch=$_GET['userbranch'];

  require ("../../lib/open_con.php");

// SECURITY
   $tsql = "SELECT * FROM Tbl_SE_User
   					WHERE user_id='$userid'";
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
      }
   }
   sqlsrv_free_stmt( $sqlConn );

// END SECURITY
  

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FORMTAR</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>
<Script Language="JavaScript">
        function viewZip(theformname,theformfield,thefielddest,thewindow,thedetail)
        {
           document.formsubmit.target = thewindow;
           document.formsubmit.act.value = "viewzip";
           document.formsubmit.utilwindow.value = thewindow;
           document.formsubmit.utilformname.value = theformname;
           document.formsubmit.utilfielddest.value = thefielddest;
           document.formsubmit.utilformfield.value = theformfield;
           document.formsubmit.utilfieldvalue.value = eval("document.formsubmit." + theformfield + ".value");
           document.formsubmit.utildetail.value = thedetail;
           document.formsubmit.action = "/lismega_devel/script/utilviewzip.php";
           if (thewindow != "smallwindow")
           {
              window.open('/lismega_devel/script/utilviewzip.php',thewindow,'scrollbars=yes,width=600,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           else
           {
              window.open('/lismega_devel/script/utilviewzip.php',thewindow,'scrollbars=yes,width=300,height=450,screenX=0,screenY=0,top=0,left=0,status=yes');
           }
           document.formsubmit.submit();
        }
        function goSave()
        {
           var Money ="0123456789";
        	  if (document.formsubmit.tarproccode.options[document.formsubmit.tarproccode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Produk");
        	  	document.formsubmit.tarproccode.focus();
        	  	return false;
        	  }
        	  if (document.formsubmit.taraocode.options[document.formsubmit.taraocode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih AO");
        	  	document.formsubmit.taraocode.focus();
        	  	return false;
        	  }
        	  if (document.formsubmit.tarbranchcode.options[document.formsubmit.tarbranchcode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Cabang");
        	  	document.formsubmit.tarbranchcode.focus();
        	  	return false;
        	  }
        	  if (document.formsubmit.tarbustype.options[document.formsubmit.tarbustype.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Jenis Bisnis");
        	  	document.formsubmit.tarbustype.focus();
        	  	return false;
        	  }
        	  if (document.formsubmit.tarinitiator.options[document.formsubmit.tarinitiator.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Inisiator");
        	  	document.formsubmit.tarinitiator.focus();
        	  	return false;
        	  }
        	  if (document.formsubmit.tarzipcode.value == "")
        	  {
        	  	alert("Harap Isi Kodepos");
        	  	document.formsubmit.tarzipcode.focus();
        	  	return false;
        	  }
           else
           {
             if (document.formsubmit.tarzipcode.value.length < 5)
             {
                 alert("Koepos Harus Berupa 5 digit Angka");
                 document.formsubmit.tarzipcode.focus();
                 return false;
             }
             for (var i = 0; i < document.formsubmit.tarzipcode.value.length; i++)
             {
       	       if (Money.indexOf(document.formsubmit.tarzipcode.value.charAt(i)) == -1)
       	       {
                 alert("Koepos Harus Berupa Angka");
                 document.formsubmit.tarzipcode.focus();
                 return false;
               }
             }
           }
        	  document.formsubmit.tarlocation.value = document.formsubmit.tarlocation.value.toUpperCase();
        	  if (document.formsubmit.tarlocation.value == "")
        	  {
        	  	alert("Harap Isi Lokasi");
        	  	document.formsubmit.tarlocation.focus();
        	  	return false;
        	  }
        	  if (document.formsubmit.tarcount.value == "")
        	  {
        	  	alert("Harap Isi Jumlah Target");
        	  	document.formsubmit.tarcount.focus();
        	  	return false;
        	  }
           document.formsubmit.act.value = "saveform";
           document.formsubmit.action = "/lismega_devel/script/form/doformtar.php";
           submitform = window.confirm("Save Targeting ?")
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

<body bgcolor=#FFFF99 link=blue alink=blue vlink=blue>
<script language="JavaScript"><!--
name = 'utama';
//--></script>
<form name="formsubmit" method="post" action="lismega.php">
	<BR><BR>
  <table width="488" border="0" align="center">
    <tr>
      <td colspan="2"><font size=3><strong>Targeting</strong></font></td>
    </tr>
    <tr>
      <td width="145">Tar ID</td>
      <td width="327"><input id="tarid" name="tarid" type="text" value="" size="30" maxlength="20" />
      <font color="#FF0000">*)</font></td>
    </tr>
    <tr>
      <td>Produk</td>
      <td><select id="tarproccode" name="tarproccode">
        <option value=''>-- PRODUK --</option>
<?
   $tsql = "SELECT * FROM Tbl_Processing";
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
   	  	      			         <option value='<? echo $row[0]; ?>'><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      </select>
      <font color="#FF0000">*)</font></td>
      </td>
    </tr>
    <tr>
      <td>AO Code</td>
      <td><select id="taraocode" name="taraocode">
        <option value=''>-- AO CODE --</option>
<?
   $tsql = "SELECT * FROM Tbl_AO";
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
   	  	      			         <option value='<? echo $row[0]; ?>'><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      </select>
      <font color="#FF0000">*)</font></td>
      </td>
    </tr>
    <tr>
      <td>Kode Cabang</td>
      <td><select id="tarbranchcode;" name="tarbranchcode">
        <option value=''>-- BRANCH CODE --</option>
<?
   $tsql = "SELECT * FROM Tbl_Branch";
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
      	$varselected = "";
      	if ($row[0] == $userbranch)
      	{
      		$varselected = "selected";
        }
?>
   	  	      			         <option value='<? echo $row[0]; ?>' <? echo $varselected; ?>><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      </select>
      <font color="#FF0000">*)</font></td>
      </td>
    </tr>
    <tr>
      <td>Jenis Bisnis</td>
      <td><select id="tarbustype" name="tarbustype">
        <option value=''>-- BUSSINESS TYPE --</option>
<?
   $tsql = "SELECT * FROM Tbl_BusinessType";
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
   	  	      			         <option value='<? echo $row[0]; ?>'><? echo $row[0]; ?> - <? echo $row[1]; ?></option>
<?
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
      </select>
      <font color="#FF0000">*)</font></td>
      </td>
    </tr>
    <tr>
      <td>Inisiator</td>
      <td><select id="tarinitiator" name="tarinitiator">
        <option value="">-- INITIATOR --</option>
        <option value='1'>1 TL</option>
        <option value='2'>2 PINCA</option>
      </select>
      <font color="#FF0000">*)</font></td>
      </td>
    </tr>
    <tr>
      <td>
      	<A HREF="javascript:viewZip('formsubmit','tarzipcode','tarzipcode','mediumwindow','N')">Kodepos</A>
      </td>
      <td>
      	<input type=text id="tarzipcode" name=tarzipcode size=5 maxlength=5>
        <font color="#FF0000">*)</font></td>
      </td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td><input id="tarlocation" name="tarlocation" type="text" value="" size="30" maxlength="40" />
      <font color="#FF0000">*)</font></td>
    </tr>
    <tr>
      <td>Jumlah Target</td>
      <td><input id="tarcount" name="tarcount" type="text"  value="" size="30" maxlength="4" />
      <font color="#FF0000">*)</font></td>
    </tr>
    <tr>
      <td>Kondisi</td>
      <td><input id="tarcondition" name="tarcondition" type="text" value="" size="30" maxlength="30" /></td>
    </tr>
    <tr>
      <td>HP</td>
      <td><input id="tarhp" name="tarhp" type="text" value="" size="30" maxlength="40" /></td>
    </tr>
    <tr>
      <td>Flag</td>
      <td><select id="tarflag" name="tarflag">
        <option value=''>-- FLAG --</option>
        <option value='0'>0 - Kirim Sekarang</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp</td>
      <td>
         <input type="button" value="Save To Server" onClick=goSave()>
      </td>
    </tr>
    <tr>
    </tr>
  </table>
    								 <input type=hidden name=act>
    								 <input type=hidden name=userid value=<? echo $userid; ?>>
    								 <input type=hidden name=userpwd value=<? echo $userpwd; ?>>
    								 <input type=hidden name=userbranch value=<? echo $userbranch; ?>>
    								 <input type=hidden name=utilwindow>
    								 <input type=hidden name=utilformname>
    								 <input type=hidden name=utilformfield>
    							   <input type=hidden name=utilfieldvalue>
    						     <input type=hidden name=utilfielddest>
    				         <input type=hidden name=utildetail>
</form>
</body>
</html>

<?
   require("../../lib/close_con.php");
exit;
