<?
//--------------------------------------------------------------------
	$querylevelcode = "";
	$user_level_code = 0;
		
	$tsql = "SELECT * FROM Tbl_SE_User WHERE user_id = '$userid'";		
	$ase = sqlsrv_query($conn, $tsql);
	if ($ase === false)
		die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($ase))
	{  
		while($rowse = sqlsrv_fetch_array($ase, SQLSRV_FETCH_ASSOC))
		{ 
			$user_level_code = $rowse['user_level_code'];
			$user_ao_code = $rowse['user_ao_code'];
			$user_child = $rowse['user_child'];
		}
	}
	
	if($user_level_code == 160 || $user_level_code == 150)
	{
		$querylevelcode = "TXN_ID IN (SELECT CUSTNOMID FROM tbl_customerMasterPerson2 WHERE CUSTAOCODE = '$user_ao_code' AND CUSTBRANCHCODE = '$userbranch') AND ";
	}
	else if($user_level_code == 140 || $user_level_code == 145)
	{
		$tempcustaocode = "";
		$array_user_child = explode("|", $user_child);
		for($i=0; $i < count($array_user_child)-1; $i++)
		{
			$tsql = "SELECT * FROM Tbl_SE_User WHERE user_id = '$array_user_child[$i]'";
			$ase = sqlsrv_query($conn, $tsql);
			if ($ase === false)
				die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($ase))
			{  
				while($rowmp = sqlsrv_fetch_array($ase, SQLSRV_FETCH_ASSOC))
				{ 
					$tempcustaocode = $rowmp['user_ao_code'];
				}
			}

			if($querylevelcode == "")
			{
				$querylevelcode = "TXN_ID IN (SELECT CUSTNOMID FROM tbl_customerMasterPerson2 WHERE CUSTAOCODE = '$tempcustaocode'  AND CUSTBRANCHCODE = '$userbranch') AND ";
			}
			else
			{
				$querylevelcode = "TXN_ID IN (SELECT CUSTNOMID FROM tbl_customerMasterPerson2 WHERE CUSTAOCODE = '$tempcustaocode'  AND CUSTBRANCHCODE = '$userbranch')"." OR "."$querylevelcode";
			}
		}
	}
	else if($user_level_code == 120 || $user_level_code == 122 || $user_level_code == 125 || $user_level_code == 130 || $user_level_code == 132 || $user_level_code == 135)
	{
		$querylevelcode = "TXN_BRANCH_CODE = '$userbranch' AND ";
	}
	else if($user_level_code == 100 || $user_level_code == 105 || $user_level_code == 106)
	{
		$querylevelcode = "TXN_REGION_CODE = '$userregion' AND ";
	}
	else
	{
	}
	
//--------------------------------------------------------------------
?>