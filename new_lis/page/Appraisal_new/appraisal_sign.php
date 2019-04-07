<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	
	$maxofficer = 5;
	$x = 1;

	$thesignstatus	 = $_POST['thesignstatus'];
	$theid = $_POST['thecolid'];
	//echo $custnomid;exit;

	if ($thesignstatus == "UNSIGN")
	{
	   $strsql = "UPDATE appraisal_officer SET flag = '' WHERE col_id = '$theid'";
	   //echo $strsql;exit;
	   $stmt = sqlsrv_prepare( $conn, $strsql);
	   if(!$stmt)
	   {
	      echo "Error in preparing statement.\n";
	      die( print_r( sqlsrv_errors(), true));
	   }
	   if(!sqlsrv_execute( $stmt))
	   {
	      echo "Cannot insert table ". $strsql;
	      die( print_r( sqlsrv_errors(), true));
	   }	
	   sqlsrv_free_stmt( $stmt);

      $officerid = "";
			$strsqlv01="SELECT * FROM appraisal_officer WHERE col_id = '$theid' AND seq = '1'";
			$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
			if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($sqlconv01))
			{
				while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
				{
					$officerid = $rowsv01['officer_id'];												
				}
			}
										
		  if ($officerid != "")
			{
	       $strsql = "UPDATE Tbl_FSTART set txn_user_id='$officerid' WHERE txn_id='$custnomid'";
	       //echo $strsql;exit;
	       $stmt = sqlsrv_prepare( $conn, $strsql);
	       if(!$stmt)
	       {
	          echo "Error in preparing statement.\n";
	          die( print_r( sqlsrv_errors(), true));
	       }
	       if(!sqlsrv_execute( $stmt))
	       {
	          echo "Cannot insert table ". $strsql;
	          die( print_r( sqlsrv_errors(), true));
	       }	
	       sqlsrv_free_stmt( $stmt);										
			}
/*
	   $strsql = "DELETE Tbl_FCOMPR WHERE txn_id='$custnomid'";
	   //echo $strsql;exit;
	   $stmt = sqlsrv_prepare( $conn, $strsql);
	   if(!$stmt)
	   {
	      echo "Error in preparing statement.\n";
	      die( print_r( sqlsrv_errors(), true));
	   }
	   if(!sqlsrv_execute( $stmt))
	   {
	      echo "Cannot insert table ". $strsql;
	      die( print_r( sqlsrv_errors(), true));
	   }	
	   sqlsrv_free_stmt( $stmt);
*/
	   $strsql = "DELETE Tbl_FNILAI WHERE txn_id='$custnomid'";
	   //echo $strsql;exit;
	   $stmt = sqlsrv_prepare( $conn, $strsql);
	   if(!$stmt)
	   {
	      echo "Error in preparing statement.\n";
	      die( print_r( sqlsrv_errors(), true));
	   }
	   if(!sqlsrv_execute( $stmt))
	   {
	      echo "Cannot insert table ". $strsql;
	      die( print_r( sqlsrv_errors(), true));
	   }	
	   sqlsrv_free_stmt( $stmt);

	   $strsql = "DELETE Tbl_FSIGN WHERE txn_id='$custnomid'";
	   //echo $strsql;exit;
	   $stmt = sqlsrv_prepare( $conn, $strsql);
	   if(!$stmt)
	   {
	      echo "Error in preparing statement.\n";
	      die( print_r( sqlsrv_errors(), true));
	   }
	   if(!sqlsrv_execute( $stmt))
	   {
	      echo "Cannot insert table ". $strsql;
	      die( print_r( sqlsrv_errors(), true));
	   }	
	   sqlsrv_free_stmt( $stmt);
   
	}
	
	if ($thesignstatus == "SIGN")
	{
	   $strsql = "UPDATE appraisal_officer SET flag = 'S' WHERE col_id = '$theid' AND officer_id = '$userid'";
	   //echo $strsql;exit;
	   $stmt = sqlsrv_prepare( $conn, $strsql);
	   if(!$stmt)
	   {
	      echo "Error in preparing statement.\n";
	      die( print_r( sqlsrv_errors(), true));
	   }
	   if(!sqlsrv_execute( $stmt))
	   {
	      echo "Cannot insert table ". $strsql;
	      die( print_r( sqlsrv_errors(), true));
	   }	
	   sqlsrv_free_stmt( $stmt);

      $officerid = "";
			$strsqlv01="SELECT * FROM appraisal_officer WHERE col_id = '$theid' AND officer_id <> '$userid'";
			$sqlconv01 = sqlsrv_query($conn, $strsqlv01);
			if ( $sqlconv01 === false)die( FormatErrors( sqlsrv_errors() ) );
			if(sqlsrv_has_rows($sqlconv01))
			{
				while($rowsv01 = sqlsrv_fetch_array($sqlconv01, SQLSRV_FETCH_ASSOC))
				{
					$officerid = $rowsv01['officer_id'];												
				}
			}
										
		  if ($officerid != "")
			{
	       $strsql = "UPDATE Tbl_FSTART set txn_user_id='$officerid' WHERE txn_id='$custnomid'";
	       //echo $strsql;exit;
	       $stmt = sqlsrv_prepare( $conn, $strsql);
	       if(!$stmt)
	       {
	          echo "Error in preparing statement.\n";
	          die( print_r( sqlsrv_errors(), true));
	       }
	       if(!sqlsrv_execute( $stmt))
	       {
	          echo "Cannot insert table ". $strsql;
	          die( print_r( sqlsrv_errors(), true));
	       }	
	       sqlsrv_free_stmt( $stmt);										
			}
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<script src="js/jquery-1.9.1.js"></script>
	<script>
		
		function iniload()
		{
			document.formappl.theid.value="<?php echo $theid?>";
			document.formappl.action = "../flow.php?userwfid=<?php echo $userwfid?>";
			document.formappl.submit();
		}
		
	</script>
</head>
	<body onload="iniload()">
		<form id="formappl" name="formappl" method="post">
			<input type="hidden" id="theid" name="theid" />
			<?
				require ("../../requirepage/hiddenfield.php");
			?>
		</form>
	</body>
</html>	