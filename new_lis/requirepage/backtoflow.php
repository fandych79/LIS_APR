<?php

  $varBackTo = "";
	$tsql = "SELECT BackTo FROM Tbl_PrevFlow WHERE Flow='$userwfid'";
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
			$varBackTo = $row[0];
		}
	}
	sqlsrv_free_stmt( $sqlConn );

?>
<Script Language="JavaScript">
	function cekBackToFlow()
	{
		if (document.spinbacktoflow.backtoflow.options[document.spinbacktoflow.backtoflow.selectedIndex].value == "")
		{
			 document.spinbacktoflow.backtoflow.focus();
		   alert("Harap Pilih Back To");
		   return false;
		}
		if (document.spinbacktoflow.backtostatus.options[document.spinbacktoflow.backtostatus.selectedIndex].value == "")
		{
			 document.spinbacktoflow.backtostatus.focus();
		   alert("Harap Pilih Status");
		   return false;
		}
		if (document.spinbacktoflow.backtonotes.value == "")
		{
			 document.spinbacktoflow.backtonotes.focus();
		   alert("Harap Isi Notes");		   
		   return false;
		}
		varmsg = "Yakin ?\nFlow Akan Dikembalikan Kepada : " + document.spinbacktoflow.backtoflow.options[document.spinbacktoflow.backtoflow.selectedIndex].text + "\n" + document.spinbacktoflow.backtostatus.options[document.spinbacktoflow.backtostatus.selectedIndex].text;
    submitform = window.confirm(varmsg)           
    if (submitform == true)
    {
       document.spinbacktoflow.submit();
    }
	}
</Script>
<form name=spinbacktoflow method=post action="../../requirepage/do_backtoflow.php">
	<select name=backtoflow style="width:200px;background-color:cyan;">
		<option value=''>-- Back To : --</ooption>
<?
   if ($varBackTo != "")
   {
   	  $arrbackto=explode("|",$varBackTo);
   	  for ($hitbackto=0;$hitbackto<count($arrbackto);$hitbackto++)
   	  {
   	  	 $backtoname = $arrbackto[$hitbackto];
   	  	 $backtowfurut = "";
	       $tsql = "SELECT wf_name,wf_urut FROM Tbl_Workflow WHERE wf_id='$arrbackto[$hitbackto]'";
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
			           $backtoname = $row[0];
   	  	         $backtowfurut = $row[1];
		        }
	       }
	       sqlsrv_free_stmt( $sqlConn );

			   echo "<option value='$arrbackto[$hitbackto]|$backtowfurut'>$backtoname</option>";
		  }
   }
?>
	</select>
	<select name=backtostatus style="width:250px;background-color:white;">
		<option value=''>-- Choose One --</option>
		<option value='ME'>Setelah Itu, Langsung Kembali Ke Saya</option>
		<option value='SEQ'>Periksa Kembali, Urutkan Sesuai Flow</option>
	</select>
	<input type=text name=backtonotes maxlength=50 style="width:150px">
	<input type="button" class="buttonsaveflow" value="SUBMIT" style="width:200px;background-color:red;" onclick="cekBackToFlow()">
	<?
    require("../../requirepage/hiddenfield.php");
	?>
</form>
<BR>
