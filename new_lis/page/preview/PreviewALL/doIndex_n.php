<?
	require ("../../../lib/formatError.php");
	require ("../../../lib/open_con.php");
	
	$custnomid = $_POST['idx'];
	
	$userid = "";
	$userpwd = "";
	$userbranch = "";
	$userregion = "";
	$buttonaction = "";
	$userwfid = "";
	//echo $custnomid;
	
	$next = "0";

											$controltablecustomer = "";
											$controlfieldcif = "";
											$controlfieldnomid = "";
											$controlfieldtipedeb = "";
											$strsql2="  select CONTROL_CODE, CONTROL_VALUE FROM MS_WORKFLOW 
											            where CONTROL_CODE='MASTERCUSTOMER' 
											            or CONTROL_CODE='MASTERCIF' 
											            or CONTROL_CODE='MASTERNOMID'
											            or CONTROL_CODE='MASTERTIPEDEB'";
                      $sqlcon2 = sqlsrv_query($conn, $strsql2);
                      if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
                      if(sqlsrv_has_rows($sqlcon2))
                      {
                         while($rows2 = sqlsrv_fetch_array($sqlcon2, SQLSRV_FETCH_NUMERIC))
                         {	
                         	 if ($rows2[0] == "MASTERCUSTOMER")
                         	 {
											        $controltablecustomer = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERCIF")
                         	 {
											        $controlfieldcif = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERNOMID")
                         	 {
											        $controlfieldnomid = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERTIPEDEB")
                         	 {
											        $controlfieldtipedeb = $rows2[1];
											     }
                         }
                      }
	
//	$tsql = "SELECT * FROM Tbl_customermasterperson where custnomid = '$custnomid'";
	$tsql = "SELECT * FROM $controltablecustomer where $controlfieldnomid = '$custnomid'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$a = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $a === false)
	die( FormatErrors( sqlsrv_errors() ) );
	
	if(sqlsrv_has_rows($a))
	{  
		if($row = sqlsrv_fetch_array($a, SQLSRV_FETCH_ASSOC))
		{
			$next = "1";
		}
	}
	
	if($next == "0")
	{
		echo '<center>Nomor Aplikasi yang anda masukkan salah</center>';
	}
	else if ($next == "1")
	{
		header('location:PreviewALL_n.php?custnomid='.$custnomid.'&userid='.$userid.'&userpwd='.$userpwd.'&userbranch='.$userbranch.'&userregion='.$userregion.'&userwfid=PRO&userpermission=A&buttonaction='.$buttonaction.'');
	}
	

?>