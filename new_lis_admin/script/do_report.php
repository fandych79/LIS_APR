<?  
require ("../lib/open_con.php");?>
<?
$cbx_branch=$_GET['Branch'];
$int_date= date("n")-1;
$tahun = date("Y");
$bulan = date("n");
$month_now=date("F");
$tgl=date("j");
$int_daily=date("N");
//$daily=date("D");

		
	for ($i = 1; $i <=$tgl; $i ++) {
	//echo $i."<br/>";
	}
	
?>
<html>
<head>
	<title>
		<?
			echo "Report ".$cbx_branch;
		?>
	</title>
<link rel="stylesheet" type="text/css" href="/lisbm/style/d.css" />
</head>
<body style="background:url(../images/Background%20Mega.png); background-position:bottom; background-repeat:no-repeat; " >
<form action="/lisbm/script/aa.php">
	<table style="background-color:#;"width="960"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
    <tr>
	<td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
	</tr>
    </table>
	<br/>
    <table style="background-color:#;"width="960"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
	<tr align="center" style="background-color:#4476b3; COLOR:WHITE; font-size:48px; font-style:arial;">
	<td><b><? echo $cbx_branch; ?></b></td>
	</tr>
	</table>
	
	<br/>
	<br/>
	<table width="960"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >

		<tr>
			<tH width="20%" align="center"><font face="arial" size="2" >Description</tH>
				<?			
					for ($i = 1; $i <$bulan; $i ++) {
					$date= date("M",mktime (0,0,0,$i,1));
				?>
					<tH align="center"><font face="arial" size="2" ><?echo $date?></tH>
				<?
					}
				?> 
		</tr>
		<tr>
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Total of Lending Branch</td>
				<!--btl fnom-->
				<?
					$sql_branch="Select * from tbl_branch";
					//$sql_branch="Select * from tbl_branch where branch_name='$cbx_branch'";
					$cursortype_branch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_branch = array(&$_POST['query']);
					$sqlConn_branch = sqlsrv_query($conn, $sql_branch, $params_branch, $cursortype_branch);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_branch))
					{
						$rowCount_branch = sqlsrv_num_rows($sqlConn_branch);
						//while($row_branch = sqlsrv_fetch_array( $sqlConn_branch, SQLSRV_FETCH_ASSOC))
						while($row_branch = sqlsrv_fetch_array( $sqlConn_branch, SQLSRV_FETCH_NUMERIC))
						{
						}
				?>
						<?
						for ($i = 1; $i <$bulan; $i ++) 
						{
						$date= date("M",mktime (0,0,0,$i,1));
						?>
						<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><?echo $rowCount_branch?></td>
						<?
						}
						?>
				<?
					}
					sqlsrv_free_stmt( $sqlConn_branch );
				?>
		</tr>
		<tr>
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Contributing Lending Branch</td>
				<!--btl fdrd-->
				<?
					$sql_fdrd="Select distinct txn_id from tbl_fdrd";
					$cursortype_fdrd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_fdrd = array(&$_POST['query']);
					$sqlConn_fdrd = sqlsrv_query($conn, $sql_fdrd, $params_fdrd, $cursortype_fdrd);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_fdrd))
					{
						$rowCount_fdrd = sqlsrv_num_rows($sqlConn_fdrd);
						//while($row_fdrd = sqlsrv_fetch_array( $sqlConn_fdrd, SQLSRV_FETCH_ASSOC))
						while($row_fdrd = sqlsrv_fetch_array( $sqlConn_fdrd, SQLSRV_FETCH_NUMERIC))
						{
						}
						
				?>
						<?
						for ($i = 1; $i <$bulan; $i ++) 
						{
						$date= date("M",mktime (0,0,0,$i,1));
						?>
						<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><?echo $rowCount_fdrd?></td>
						<?
						}
						?>
				<?
					}
					sqlsrv_free_stmt( $sqlConn_fdrd );
				?>
		</tr>
		<tr style="background-color:#4476b3;">
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >% Contributing Branch</td>
				<?
					if($rowCount_branch<>0)
						{
					$per_bran=round($rowCount_fdrd/$rowCount_branch*100);
						}	
				?>
				<?
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$date= date("M",mktime (0,0,0,$i,1));
					?>
					<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><?echo $per_bran."%"?></td>
					<?
					}
				?>
		</tr>
		<tr>
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Total AO SME</td>
				<!--tbl ao-->
				<?
					$sql_ao="Select * from tbl_ao";
					$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ao = array(&$_POST['query']);
					$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_ao))
					{
						$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
						//while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
						while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_NUMERIC))
						{
						}
				?>
						<?
						for ($i = 1; $i <$bulan; $i ++) 
						{
						$date= date("M",mktime (0,0,0,$i,1));
						?>
						<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><?echo $rowCount_ao?></td>
						<?
						}
						?>
				<?
					}
					sqlsrv_free_stmt( $sqlConn_ao );
				?>
		</tr>
		<tr>
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Contributing AO</td>
				<!--tbl ao-->
				<?	$cont_ao=0;
					$sql_fdrd_ao="Select distinct txn_id from tbl_fdrd";
					$cursortype_fdrd_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_fdrd_ao = array(&$_POST['query']);
					$sqlConn_fdrd_ao = sqlsrv_query($conn, $sql_fdrd_ao, $params_fdrd_ao, $cursortype_fdrd_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_fdrd_ao))
					{
						$rowCount_fdrd_ao = sqlsrv_num_rows($sqlConn_fdrd_ao);
						//while($row_fdrd_ao = sqlsrv_fetch_array( $sqlConn_fdrd_ao, SQLSRV_FETCH_ASSOC))
						while($row_fdrd_ao = sqlsrv_fetch_array( $sqlConn_fdrd_ao, SQLSRV_FETCH_NUMERIC))
						{
						$txnid_fdrd=$row_fdrd_ao[0];
						
						
						$sql_customer_master="Select * from tbl_customer_master where cust_txn_id='$txnid_fdrd'";
						$cursortype_customer_master = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params_customer_master = array(&$_POST['query']);
						$sqlConn_customer_master = sqlsrv_query($conn, $sql_customer_master, $params_customer_master, $cursortype_customer_master);
						if($conn==false){die(FormatErrors(sqlsrv_errors()));}
						if(sqlsrv_has_rows($sqlConn_customer_master))
						{
						$rowCount_customer_master = sqlsrv_num_rows($sqlConn_customer_master);
						//while($row_customer_master = sqlsrv_fetch_array( $sqlConn_customer_master, SQLSRV_FETCH_ASSOC))
						while($row_customer_master = sqlsrv_fetch_array( $sqlConn_customer_master, SQLSRV_FETCH_NUMERIC))
							{
							$region= $row_customer_master[2];
							//echo $row_customer_master[2];
							$cust_ao_code= $row_customer_master[3];
							//echo $row_customer_master[3]." ".$txnid_fdrd."<br/>";
							//echo $txnid_fdrd;

							
							
							$sql_ao1="Select * from tbl_ao where ao_code='$cust_ao_code'";
							$cursortype_ao1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
							$params_ao1 = array(&$_POST['query']);
							$sqlConn_ao1 = sqlsrv_query($conn, $sql_ao1, $params_ao1, $cursortype_ao1);
							if($conn==false){die(FormatErrors(sqlsrv_errors()));}
							if(sqlsrv_has_rows($sqlConn_ao1))
							{
							$rowCount_ao1 = sqlsrv_num_rows($sqlConn_ao1);
							//while($row_ao1 = sqlsrv_fetch_array( $sqlConn_ao1, SQLSRV_FETCH_ASSOC))
							while($row_ao1 = sqlsrv_fetch_array( $sqlConn_ao1, SQLSRV_FETCH_NUMERIC))
								{
								$ao_code=$row_ao1[0];
								//echo $ao_code." ".$txnid_fdrd."".$region."<br/>";
								//$cont_ao=count($ao_code);
								//echo $cont_ao;
								}
								$cont_ao += count($ao_code);
								
							}
							sqlsrv_free_stmt( $sqlConn_ao1 );
							
						
							
							
							
							
							
							}
						}
					sqlsrv_free_stmt( $sqlConn_customer_master );
					
					}
						}
					
					sqlsrv_free_stmt( $sqlConn_fdrd_ao );
					
				?>
					<?
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$date= date("M",mktime (0,0,0,$i,1));
					?>
					<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><?echo $cont_ao?></td>
					<?
					}
					?>
		</tr>
		<tr style="background-color:#4476b3;">
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >% Contributing AO</td>
				<?
					if($rowCount_ao<>0)
						{
					$per_ao=round($cont_ao/$rowCount_ao*100);
						}	
				?>
				<?
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$date= date("M",mktime (0,0,0,$i,1));
					?>
					<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><?echo $per_ao."%"?></td>
					<?
					}
				?>
		</tr>
		<tr>
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Actual Drowdown</td>
				<!--tbl ao-->
				<?
					$sql_ao="Select * from tbl_ao";
					$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ao = array(&$_POST['query']);
					$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_ao))
					{
						$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
						//while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
						while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_NUMERIC))
						{
						}
				?>
						<?
						for ($i = 1; $i <$bulan; $i ++) 
						{
						$date= date("M",mktime (0,0,0,$i,1));
						?>
						<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><? echo $i?></td>
						<?
						}
						?>
				<?
					}
					sqlsrv_free_stmt( $sqlConn_ao );
				?>
		</tr>
		<tr>
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Actual Growth</td>
				<!--tbl ao-->
				<?
					$sql_ao="Select * from tbl_ao";
					$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ao = array(&$_POST['query']);
					$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_ao))
					{
						$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
						//while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
						while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_NUMERIC))
						{
						}
				?>
						<?
						for ($i = 1; $i <$bulan; $i ++) 
						{
						$date= date("M",mktime (0,0,0,$i,1));
						?>
						<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><? echo $i?></td>
						<?
						}
						?>
				<?
					}
					sqlsrv_free_stmt( $sqlConn_ao );
				?>
		</tr>
		<tr style="background-color:#4476b3;">
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >% Achievement Growth</td>
				<?
					if($rowCount_branch<>0)
						{
					$per_bran=round($rowCount_fdrd/$rowCount_branch*100);
						}	
				?>
				<?
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$date= date("M",mktime (0,0,0,$i,1));
					?>
					<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><? echo $i?></td>
					<?
					}
				?>
		</tr>
		<tr style="background-color:#4476b3;">
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Produktivitas per Cabang</td>
				<?
					if($rowCount_branch<>0)
						{
					$per_bran=round($rowCount_fdrd/$rowCount_branch*100);
						}	
				?>
				<?
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$date= date("M",mktime (0,0,0,$i,1));
					?>
					<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><? echo $i?></td>
					<?
					}
				?>
		</tr>
		<tr style="background-color:#4476b3;">
			<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Produktivitas per AO(VOL)</td>
				<?
					if($rowCount_branch<>0)
						{
					$per_bran=round($rowCount_fdrd/$rowCount_branch*100);
						}	
				?>
				<?
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$date= date("M",mktime (0,0,0,$i,1));
					?>
					<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><? echo $i?></td>
					<?
					}
				?>
		</tr>
		<td style="padding-left:5px;" width="20%"><font face="arial" size="2" >Produktivitas per AO(NOA)</td>
				<!--tbl ao-->
				<?
					$sql_ao="Select * from tbl_ao";
					$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ao = array(&$_POST['query']);
					$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_ao))
					{
						$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
						//while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
						while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_NUMERIC))
						{
						}
				?>
						<?
						for ($i = 1; $i <$bulan; $i ++) 
						{
						$date= date("M",mktime (0,0,0,$i,1));
						?>
						<td style="padding-right:5px;" align="right"><font face="arial" size="2" ><? echo $i?></td>
						<?
						}
						?>
				<?
					}
					sqlsrv_free_stmt( $sqlConn_ao );
				?>
		</tr>
	</table>

<table style="background-color:#;"width="960"  cellpadding="0" cellspacing="0" border="0" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
<tr>
<td align="right">
				<?
					$bulan = date("n");
					$ourFileName = "C:/xampp/htdocs/lismega_devel/report.csv";
					$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
					$line ="Description";				
					for ($i = 1; $i <$bulan; $i ++) {
					$date= date("M",mktime (0,0,0,$i,1));
					$line = $line . "," . $date;
					}
					//echo $line;
					$line=$line."\n";
					fwrite($ourFileHandle,$line);

					
					$sql_branch="Select * from tbl_branch";
					//$sql_branch="Select * from tbl_branch where branch_name='$cbx_branch'";
					$cursortype_branch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_branch = array(&$_POST['query']);
					$sqlConn_branch = sqlsrv_query($conn, $sql_branch, $params_branch, $cursortype_branch);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_branch))
					{
						$rowCount_branch = sqlsrv_num_rows($sqlConn_branch);
						//while($row_branch = sqlsrv_fetch_array( $sqlConn_branch, SQLSRV_FETCH_ASSOC))
						while($row_branch = sqlsrv_fetch_array( $sqlConn_branch, SQLSRV_FETCH_NUMERIC))
						{
						}
					$a=$rowCount_branch;
					$line ="Total of Lending Branch";
						for ($i = 1; $i <$bulan; $i ++) 
						{
							$a=$rowCount_branch;
							$line=$line.",".$a;
						}
						$line=$line."\n";
						fwrite($ourFileHandle,$line);
					}
					sqlsrv_free_stmt( $sqlConn_branch );
					
					

					$sql_fdrd="Select distinct txn_id from tbl_fdrd";
					$cursortype_fdrd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_fdrd = array(&$_POST['query']);
					$sqlConn_fdrd = sqlsrv_query($conn, $sql_fdrd, $params_fdrd, $cursortype_fdrd);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_fdrd))
					{
						$rowCount_fdrd = sqlsrv_num_rows($sqlConn_fdrd);
						//while($row_fdrd = sqlsrv_fetch_array( $sqlConn_fdrd, SQLSRV_FETCH_ASSOC))
						while($row_fdrd = sqlsrv_fetch_array( $sqlConn_fdrd, SQLSRV_FETCH_NUMERIC))
						{
						}
					$a=$rowCount_fdrd;
					$line ="Contributing Lending Branch";
						for ($i = 1; $i <$bulan; $i ++) 
						{
							$a=$rowCount_fdrd;
							$line=$line.",".$a;
						}
						$line=$line."\n";
						fwrite($ourFileHandle,$line);
					}
					sqlsrv_free_stmt( $sqlConn_fdrd );			
					
					
					
					
					if($rowCount_branch<>0)
						{
					$per_bran=round($rowCount_fdrd/$rowCount_branch*100)." %";
					
						}	
					$line ="% Contributing Branch";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$per_bran;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);

					
					
					$sql_ao="Select * from tbl_ao";
					$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ao = array(&$_POST['query']);
					$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_ao))
					{
						$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
						//while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
						while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_NUMERIC))
						{
						}
					$a=$rowCount_ao;
					$line ="Total AO SME";
						for ($i = 1; $i <$bulan; $i ++) 
						{
							$a=$rowCount_ao;
							$line=$line.",".$a;
						}
						$line=$line."\n";
						fwrite($ourFileHandle,$line);
					}
					sqlsrv_free_stmt( $sqlConn_ao );
					
					
					
					$cont_ao=0;
					$sql_fdrd_ao="Select distinct txn_id from tbl_fdrd";
					$cursortype_fdrd_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_fdrd_ao = array(&$_POST['query']);
					$sqlConn_fdrd_ao = sqlsrv_query($conn, $sql_fdrd_ao, $params_fdrd_ao, $cursortype_fdrd_ao);
					if($conn==false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_fdrd_ao))
					{
						$rowCount_fdrd_ao = sqlsrv_num_rows($sqlConn_fdrd_ao);
						//while($row_fdrd_ao = sqlsrv_fetch_array( $sqlConn_fdrd_ao, SQLSRV_FETCH_ASSOC))
						while($row_fdrd_ao = sqlsrv_fetch_array( $sqlConn_fdrd_ao, SQLSRV_FETCH_NUMERIC))
						{
						$txnid_fdrd=$row_fdrd_ao[0];
						
						
						$sql_customer_master="Select * from tbl_customer_master where cust_txn_id='$txnid_fdrd'";
						$cursortype_customer_master = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params_customer_master = array(&$_POST['query']);
						$sqlConn_customer_master = sqlsrv_query($conn, $sql_customer_master, $params_customer_master, $cursortype_customer_master);
						if($conn==false){die(FormatErrors(sqlsrv_errors()));}
						if(sqlsrv_has_rows($sqlConn_customer_master))
						{
						$rowCount_customer_master = sqlsrv_num_rows($sqlConn_customer_master);
						//while($row_customer_master = sqlsrv_fetch_array( $sqlConn_customer_master, SQLSRV_FETCH_ASSOC))
						while($row_customer_master = sqlsrv_fetch_array( $sqlConn_customer_master, SQLSRV_FETCH_NUMERIC))
							{
							$region= $row_customer_master[2];
							//echo $row_customer_master[2];
							$cust_ao_code= $row_customer_master[3];
							//echo $row_customer_master[3]." ".$txnid_fdrd."<br/>";
							//echo $txnid_fdrd;

							
							
							$sql_ao1="Select * from tbl_ao where ao_code='$cust_ao_code'";
							$cursortype_ao1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
							$params_ao1 = array(&$_POST['query']);
							$sqlConn_ao1 = sqlsrv_query($conn, $sql_ao1, $params_ao1, $cursortype_ao1);
							if($conn==false){die(FormatErrors(sqlsrv_errors()));}
							if(sqlsrv_has_rows($sqlConn_ao1))
							{
							$rowCount_ao1 = sqlsrv_num_rows($sqlConn_ao1);
							//while($row_ao1 = sqlsrv_fetch_array( $sqlConn_ao1, SQLSRV_FETCH_ASSOC))
							while($row_ao1 = sqlsrv_fetch_array( $sqlConn_ao1, SQLSRV_FETCH_NUMERIC))
								{
								$ao_code=$row_ao1[0];
								//echo $ao_code." ".$txnid_fdrd."".$region."<br/>";
								//$cont_ao=count($ao_code);
								//echo $cont_ao;
								}
								$cont_ao += count($ao_code);
								
							}
							sqlsrv_free_stmt( $sqlConn_ao1 );

							}
						}
					sqlsrv_free_stmt( $sqlConn_customer_master );
					
						}
					}
					
					sqlsrv_free_stmt( $sqlConn_fdrd_ao );
					
					$a=$cont_ao;
					$line ="Contributing AO";
						for ($i = 1; $i <$bulan; $i ++) 
						{
							$a=$cont_ao;
							$line=$line.",".$a;
						}
						$line=$line."\n";
						fwrite($ourFileHandle,$line);
						

					if($rowCount_ao<>0)
						{
					$per_ao=round($cont_ao/$rowCount_ao*100)." %";
						}	

					$line ="% Contributing AO";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$per_ao;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);

					
								
					$line ="Actual Drowdown";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$i;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);
					
					
					$line ="Actual Growth";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$i;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);
					
					
					
					
					$line ="% Achievement Growth";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$i;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);
					
					
					$line ="Produktivitas per Cabang";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$i;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);
					
					
					
					$line ="Produktivitas per AO(VOL)";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$i;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);
					
					
					$line ="Produktivitas per AO(NOA)";
					for ($i = 1; $i <$bulan; $i ++) 
					{
					$line=$line.",".$i;
					}
					$line=$line."\n";
					fwrite($ourFileHandle,$line);
					
					
					
					
					
					
					fclose($ourFileHandle);
					
					
					
					
					
					
					
					
					
					
					
					?>
<a href="/lismega_devel/report.csv">Export</a></td>
</tr>
</table>
</form>


<? require("../lib/close_con.php")?>
</body>
</html>