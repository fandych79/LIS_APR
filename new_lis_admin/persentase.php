
<?php

 
//  $userpwd=$_POST['userpwd'];
//  $act=$_POST['act'];
   $act = "";

   if ($act == "")
   {
      MAIN();
   }

$serverName = "(local)\SQLEXPRESS";
$connectionOptions = array("Database"=>"db_lis_mega");

/* Connect using Windows Authentication. */
$conn = sqlsrv_connect( $serverName, $connectionOptions);
if( $conn === false )
die( FormatErrors( sqlsrv_errors() ));




function MAIN()
{
	  	
   //$serverName = "(local)\SQLEXPRESS";
$serverName = "(local)\SQLEXPRESS";
   $connectionOptions = array("Database"=>"db_lis_mega");

   $conn = sqlsrv_connect( $serverName, $connectionOptions);
   if( $conn === false )
   die( FormatErrors( sqlsrv_errors() ));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http:zz//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="/lismega/script/do_persentase.php" method="post">
<table width="457" border="0">
  <tr>
    <td width="84">ID</td>
    <td width="357">
    	<label for="customerid"></label>
      <input type="text" name="customerid" id="customerid" /></td>
  </tr>	
    <tr>
      <td>filter</td>
      <td>
      <select name="filter">
      <option value="A">--ALL--</option>
      <option value="F">Finish</option>
      <option value="N">Not Finish Yet</option>
      </select></td>
    </tr>
    <tr>
    <td width="84">Branch</td>
    <td width="357">
	<select name="Branch">
        <option>--ALL--</option>
 		<?
  		$tsql = "SELECT * FROM Tbl_Branch ORDER BY branch_code";
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
         	print "<option value='$row[branch_code]'>$row[branch_code] - $row[branch_name]</option>";
      		}
   		}
   		sqlsrv_free_stmt( $sqlConn );
		?>
     	</select>
    </td>
  </tr>	
    <tr>
    <td width="84">AO</td>
    <td width="357">
    <select name="AO">
    <option>--ALL--</option>
	<?
   $tsql = "SELECT *FROM Tbl_Ao ORDER BY Ao_code";
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
          print "<option value='$row[ao_code]'>$row[ao_code] - $row[ao_name]</option>";
      }
   }
   sqlsrv_free_stmt( $sqlConn );
?>
    </select>
    
    
    </td>
<td width="2"></td>
  </tr>	
  <tr>
    <td>Date</td>
    <td>
    
    <select name="tgl">
        <option>---</option>
    <?
    	for($zz=1; $zz<=31;$zz++)
		{
			print "<option value='$zz'>$zz</option>";	
		}
	?>
    </select>
    <label for="bulan"></label>
    <select name="bulan" id="bulan">
     <option>---</option>
	<?
    	for($zz=1; $zz<=12;$zz++)
		{
			print "<option value='$zz'>$zz</option>";	
		}
	?>
    </select>
    <label for="tahun"></label>
    <select name="tahun" id="tahun">
     <option>---</option>
	<?
		$year=date('Y');
		for($zz=$year-5; $zz<=$year; $zz++)
		{
		print "<option value='$zz'>$zz</option>";	
		}
	?>
    </select>
    Until
    <select name="tgl1">
     <option>---</option>
	<?
    	for($zz=1; $zz<=31;$zz++)
		{
			print "<option value='$zz'>$zz</option>";	
		}
	?>
     </select>
    <label for="bulan1"></label>
    <select name="bulan1" id="bulan1">
    <option>---</option>
	<?
    	for($zz=1; $zz<=12;$zz++)
		{
			print "<option value='$zz'>$zz</option>";	
		}
	?>
    </select>
    <label for="tahun1"></label>
    <select name="tahun1" id="tahun1">
    <option>---</option>
        <?
		$year=date('Y');
		for($zz=$year-5; $zz<=$year; $zz++)
		{
		print "<option value='$zz'>$zz</option>";	
		}
	?>
    </select>
    
    </td>
  </tr>	
     <tr>
    <td colspan="2" style="padding-top:3px;">
    <input style="margin-left:85px;" type="submit" name="submit" id="submit" value="Submit" /></td>
    </tr>

</table>
</form>

<?
   sqlsrv_close( $conn );
exit;
}

function FormatErrors( $errors )
{
    /* Display errors. */
    echo "Error information: <br/>";

    foreach ( $errors as $error )
    {
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
        echo "Code: ".$error['code']."<br/>";
        echo "Message: ".$error['message']."<br/>";
    }
}
?></body>
</html>