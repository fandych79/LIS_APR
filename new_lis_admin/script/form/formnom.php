<?php
  $userid=$_GET['userid'];
  $userpwd=$_GET['userpwd'];
  $userbranch=$_GET['userbranch'];
  require ("../../lib/open_con.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FORMNOM</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>
<Script Language="JavaScript">

function goSave()
        {
        	  document.formsubmit.custfullname.value = document.formsubmit.custfullname.value.toUpperCase();
        	  document.formsubmit.custbusname.value = document.formsubmit.custbusname.value.toUpperCase();
        	  document.formsubmit.custbusaddr.value = document.formsubmit.custbusaddr.value.toUpperCase();
        	  document.formsubmit.custbustelp.value = document.formsubmit.custbustelp.value.toUpperCase();
        	  document.formsubmit.custnomnotes.value = document.formsubmit.custnomnotes.value.toUpperCase();
			      if (document.formsubmit.custaocode.options[document.formsubmit.custaocode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Kode AO");
        	  	document.formsubmit.custaocode.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custproccode.options[document.formsubmit.custproccode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Produk");
        	  	document.formsubmit.custproccode.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custbranchcode.options[document.formsubmit.custbranchcode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Kode Cabang");
        	  	document.formsubmit.custbranchcode.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custsex.options[document.formsubmit.custsex.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Jenis Kelamin");
        	  	document.formsubmit.custsex.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custcreditneed.options[document.formsubmit.custcreditneed.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Kebutuhan Kredit");
        	  	document.formsubmit.custcreditneed.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custnomobfacility.options[document.formsubmit.custnomobfacility.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Fasilitas");
        	  	document.formsubmit.custnomobfacility.focus();
        	  	return false;
        	  }
			   if (document.formsubmit.custfullname.value == "")
        	  {
        	  	alert("Harap Isi Nama Calon Debitur");
        	  	document.formsubmit.custfullname.focus();
        	  	return false;
        	  }
			  if (document.formsubmit.custbusname.value == "")
        	  {
        	  	alert("Harap Isi Nama Usaha");
        	  	document.formsubmit.custbusname.focus();
        	  	return false;
        	  }
			   if (document.formsubmit.custbusaddr.value == "")
        	  {
        	  	alert("Harap Isi Alamat Usaha");
        	  	document.formsubmit.custbusaddr.focus();
        	  	return false;
        	  }
			    if (document.formsubmit.custbustelp.value == "")
        	  {
        	  	alert("Harap Isi No Telepon");
        	  	document.formsubmit.custbustelp.focus();
        	  	return false;
        	  }			  
			      if (document.formsubmit.custnomomsetcode.options[document.formsubmit.custnomomsetcode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Omset");
        	  	document.formsubmit.custnomomsetcode.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custnomlamausahacode.options[document.formsubmit.custnomlamausahacode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Lama Usaha");
        	  	document.formsubmit.custnomlamausahacode.focus();
        	  	return false;
        	  }
			      if (document.formsubmit.custnomplafondcode.options[document.formsubmit.custnomplafondcode.selectedIndex].value == "")
        	  {
        	  	alert("Harap Pilih Plafond");
        	  	document.formsubmit.custnomplafondcode.focus();
        	  	return false;
        	  }
           document.formsubmit.act.value = "saveform";
           document.formsubmit.action = "/lismega_devel/script/form/doformnom.php";
           submitform = window.confirm("Save Nominating ?")
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
<form id="formsubmit" name="formsubmit" method="post" action="lismega.php">
	<BR><BR>
  <table width="488" border="0" align="center">
    <tr>
      <td colspan="2"><font size=3><strong>Nominating</strong></font></td>
    </tr>
    <tr>
      <td>Kode AO</td>
      <td><label for="custaocode"></label>
        <select name="custaocode" id="custaocode">
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
    </tr>
    <tr>
      <td>Produk</td>
      <td><select name="custproccode" id="custproccode">
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
    </tr>
    <tr>
      <td>Kode Cabang</td>
      <td><select name="custbranchcode" id="custbranchcode">
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
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td><select name="custsex" id="custsex">
        <option value=''>-- JENIS KELAMIN --</option>
        <option value='0'>0-Badan Usaha</option>
        <option value='1'>1-Pria</option>
        <option value='2'>2-Wanita</option>
      </select>
      <font color="#FF0000">*)</font></td>
    </tr>
    <tr>
      <td>Kebutuhan Kredit</td>
      <td><select name="custcreditneed" id="custcreditneed">
        <option value=''>-- KEBUTUHAN KREDIT --</option>
<?
   $tsql = "SELECT * FROM Tbl_CreditNeed";
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
    </tr>
    <tr>
      <td>Fasilitas Bank Lain</td>
      <td><select name="custnomobfacility" id="custnomobfacility">
        <option value=''>-- Fasilitas Bank Lain --</option>
        <option value='0'>ADA</option>
        <option value='1'>TIDAK ADA</option>
      </select></td>
    </tr>
    <tr>
      <td>Nama Calon Debitur</td>
      <td><input name="custfullname" type="text" id="custfullname" size="30" maxlength="40" />
        <font color="#FF0000"> *)</font></td>
    </tr>
    <tr>
      <td>Nama Usaha</td>
      <td><input name="custbusname" type="text" id="custbusname" size="30" maxlength="40" />
        <font color="#FF0000"> *)</font></td>
    </tr>
    <tr>
      <td>Alamat Usaha</td>
      <td><input name="custbusaddr" type="text" id="custbusaddr" size="30" maxlength="100" />
        <font color="#FF0000"> *)</font></td>
    </tr>
    <tr>
      <td>Telepon Hp</td>
      <td><input name="custbustelp" type="text" id="custbustelp" size="30" maxlength="20" />
        <font color="#FF0000"> *)</font></td>
    </tr>
    <tr>
      <td>Omset Perhari</td>
      <td><select name="custnomomsetcode" id="custnomomsetcode">
        <option value=''>-- Omset Perhari --</option>
<?
   $tsql = "SELECT * FROM Tbl_Omset";
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
    </tr>
    <tr>
      <td>Lama Usaha</td>
      <td><select name="custnomlamausahacode" id="custnomlamausahacode">
        <option value=''>-- Lama Usaha --</option>
<?
   $tsql = "SELECT * FROM Tbl_BusinessTerm";
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
    </tr>
    <tr>
      <td>Plafond Kredit</td>
      <td><select name="custnomplafondcode" id="custnomplafondcode">
        <option value=''>-- Plafond Kredit --</option>
<?
   $tsql = "SELECT * FROM Tbl_Plafond";
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
    </tr>
    <tr>
      <td>Info Pendukung</td>
      <td><input name="custnomnotes" type="text" id="custnomnotes" size="30" maxlength="30" />
    </tr>
    <tr>
      <td>&nbsp</td>
      <td><input type="button" onClick=goSave() value="Save To Server"/>
      </td>
    </tr>
  </table>
    								 <input type=hidden name=act>
</form>
</body>
</html>

<?
   require("../../lib/close_con.php");
exit;
