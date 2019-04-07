<?
 
require ("../lib/open_con.php");
$datenow=date("Y-m-d");
$txtid=$_GET["txtid"];
$ao_name="";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<table width="400" align="center">
<tr>
<?
$sql_CustomerMasterPerson="Select * from tbl_CustomerMasterPerson";
$cursortype_CustomerMasterPerson = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_CustomerMasterPerson = array(&$_POST['query']);
$sqlConn_CustomerMasterPerson = sqlsrv_query($conn, $sql_CustomerMasterPerson, $params_CustomerMasterPerson, $cursortype_CustomerMasterPerson);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_CustomerMasterPerson))
{
	$rowCount_CustomerMasterPerson = sqlsrv_num_rows($sqlConn_CustomerMasterPerson);
	while($row_CustomerMasterPerson = sqlsrv_fetch_array( $sqlConn_CustomerMasterPerson, SQLSRV_FETCH_ASSOC))
	{
		$nom=$row_CustomerMasterPerson['custnomid'];
		$varcheck="";
		$varfak="";
		if($txtid==$nom)
		{
		$varcheck="DataAda";
			$sql_CustomerMasterPerson2="Select * from tbl_CustomerMasterPerson where custnomid='$txtid'";
			$cursortype_CustomerMasterPerson2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_CustomerMasterPerson2 = array(&$_POST['query']);
			$sqlConn_CustomerMasterPerson2 = sqlsrv_query($conn, $sql_CustomerMasterPerson2, $params_CustomerMasterPerson2, $cursortype_CustomerMasterPerson2);
			if($conn==false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_CustomerMasterPerson2))
			{
				$rowCount_CustomerMasterPerson2 = sqlsrv_num_rows($sqlConn_CustomerMasterPerson2);
				while($row_CustomerMasterPerson2 = sqlsrv_fetch_array( $sqlConn_CustomerMasterPerson2, SQLSRV_FETCH_ASSOC))
				{
					$nom2=$row_CustomerMasterPerson2['custnomid'];
					$custsex2=$row_CustomerMasterPerson2['custsex'];
					if($custsex2!="0")
						{
							//echo "masuk ke perorangan";
							require("query.php");
							require("tmp_erik.php");
							echo exec('fak');
							$varfak="ada";
							$nom2="";
						}
					else 
						{
							//echo "masuk ke perusahaan";
							require("query.php");
							require("tmp_erikp.php");
							echo exec('fakp');
							$varfak="tidakada";
						}
				}
			}sqlsrv_free_stmt( $sqlConn_CustomerMasterPerson2 );
			

			break;
		}
		else
		{
			$varcheck="TidakAda";
		}
	}
}
sqlsrv_free_stmt( $sqlConn_CustomerMasterPerson );

	if($varcheck=="DataAda" && $varfak=="ada")
	{
		?><td><a style="text-decoration:none;" href="/lismega_DEVEL/PostScript/fak_perorangan.pdf">FORMULIR APLIKASI KREDIT PERORANGAN<a/></td><?
	}
	else if($varcheck=="DataAda" && $varfak="tidakada")
	{
	?><td><a style="text-decoration:none;" href="/lismega_DEVEL/PostScript/fak_perusahaan.pdf">FORMULIR APLIKASI KREDIT PERUSAHAAN<a/></td><?
	}
	else
	{
		?><tr><td align="center">Nom Yang anda input tidak di temukan<a/></td></tr><?
		?><tr><td align="center"><a style="text-decoration:none;" href="../script/ps2pdf.php">Back to main menu<a/></td></tr><?
	}
	?>
</tr>
</table>
</body>
</html>
<? require ("../lib/close_con.php"); ?>
