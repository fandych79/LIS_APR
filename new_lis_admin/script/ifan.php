<html>
<head>
</head>
<body>
<?
	require ("../lib/open_con.php");
	
	$strSQL = "select txn_id,txn_action,txn_time,txn_flow from tbl_txn_history
				where txn_action like 'I'";
	$objQuery = sqlsrv_query($conn,$strSQL);

	echo $objQuery;
?>
<table border="4">
	<tr>
		<th width="100" align="center">Proses</th>
		<?
		while($result = sqlsrv_fetch_array($objQuery, SQLSRV_FETCH_ASSOC))
		{
		?>
		<td align="center"><?=$result['txn_flow'];?></td>
		<?
		}
		?>
	</tr>
	<tr>
		<th align="center">Input</th>
<?
		
		while($result = sqlsrv_fetch_array($objQuery, SQLSRV_FETCH_ASSOC))
		{
?>
		<td align="center"><?=$result['txn_action'];?></td>
<?
		}
?>
	</tr>
	<tr>
		<th align="center">Approve</th>
	</tr>
	<tr>
		<th align="center">Duration</th>
	</tr>
	<tr>
		<th align="center">SLA</th>
	</tr>
	<tr>
		<th align="center">Notes</th>
	</tr>
</table>
</body>
</html>