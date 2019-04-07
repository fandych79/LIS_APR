<?  
require ("../lib/open_con.php");?>

<?

$cusid=$_GET['customerid'];
$cbxfilter=$_GET['filter'];

?>
<html>
<head>
<title>Persentase</title>
<link rel="stylesheet" type="text/css" href="style/d.css" />
</head>
<body>

	<table width="960"  cellpadding="0" cellspacing="0" border="1" align="center" bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#ffffff" >
		<tr>
			<td width="15%" align="center"><font face="arial" size="2" ><b>Customer Id</td>
			<td width="15%" align="center"><font face="arial" size="2" /><b/>Progress Bar</td>
			<td width="15%" align="center"><font face="arial" size="2" /><b/>Persentase</td>
			<td width="55%" align="center"><font face="arial" size="2" /><b/>Description</td>
		</tr>
		<?
		//connect to tbl_fnom//
		if($cusid=="")
			{
			$sql_query_nom = "SELECT distinct(txn_id)  FROM Tbl_fnom where txn_user_id <> 'SPINMASTER'  ";
			}
		else
			{
			$sql_query_nom = "SELECT distinct(txn_id) FROM Tbl_fnom where txn_id=$cusid and txn_user_id <> 'SPINMASTER' ";
			}
		$nacust = "";

			$sqlConn_nom = sqlsrv_query($conn, $sql_query_nom);
			$cursorType_nom = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_nom = array(&$_POST['query']);
			$sqlConn_nom = sqlsrv_query($conn, $sql_query_nom, $params_nom, $cursorType_nom);
			if($sqlConn_nom === false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_nom))
				{
				$rowCount_nom = sqlsrv_num_rows($sqlConn_nom);
				$background_row=1;
				while( $row_nom = sqlsrv_fetch_array( $sqlConn_nom, SQLSRV_FETCH_ASSOC))
					{
					$field_txnid_nom=$row_nom['txn_id'];
					$total="";
					$ket="";
					$ket2="";
					//echo $rowCount_nom;
					
					
					
					$sql_query_wf = "SELECT * FROM Tbl_workflow ";
					$cursorType_wf = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_wf = array(&$_POST['query']);
					$sqlConn_wf = sqlsrv_query($conn, $sql_query_wf, $params_wf, $cursorType_wf);
					if	($sqlConn_wf === false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_wf))
						{
						$hasil=0;	
						$penyebut=0;
						$noflow="";
						$lastflow="";
						$rowCount_wf = sqlsrv_num_rows($sqlConn_wf);
						while( $row_wf = sqlsrv_fetch_array( $sqlConn_wf, SQLSRV_FETCH_ASSOC))
							{	
							$per_row_wf=$row_wf['wf_score'];
							$tmpact = "";
							for ($zz=0;$zz<strlen($row_wf['wf_action']);$zz++)
								{
								if (substr($row_wf['wf_action'],$zz,1) <> " ")
									{
									$tmpact = $tmpact . substr($row_wf['wf_action'],$zz,1);
									}
								}	
								
								$txnact=substr($tmpact,strlen($tmpact)-1);
								$hasil=$hasil+$per_row_wf;
								$wfid=$row_wf['wf_id'];
								//echo $wfid."</br>";
								//echo $field_txnid_nom."==".$wfid."--".$txnact."<br/>";
								
			
			
								$sql_query_fd = "SELECT COUNT(*) as total FROM Tbl_F$wfid WHERE txn_id='$field_txnid_nom' and txn_action='$txnact' and txn_user_id <> 'SPINMASTER'";
								$cursorType_fd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
								$params_fd = array(&$_POST['query']);
								$sqlConn_fd = sqlsrv_query($conn, $sql_query_fd, $params_fd,$cursorType_fd);
								if( $sqlConn_fd === false){die( FormatErrors( sqlsrv_errors() ) );}
								if(sqlsrv_has_rows($sqlConn_fd))
									{
									$rowCount_fd = sqlsrv_num_rows($sqlConn_fd);
									while( $row_fd = sqlsrv_fetch_array( $sqlConn_fd, SQLSRV_FETCH_ASSOC))
										{
										if($row_fd['total'] > 0)
											{	
											$penyebut += $row_wf['wf_score'];
											$lastflow = $wfid;
											
											//$ket=$ket.$row_wf['wf_name'].',';
											$ket=$row_wf['wf_name'];
											//echo $field_txnid_nom.$row_wf['wf_action'].$wfid."<br>";
											//echo $row_wf['wf_action']."<br>";
											//echo $wfid;
											//echo $field_txnid_nom."==".$wfid."--".$txnact."<br/>";
											$ket2=$row_wf['wf_id'];
											}
											
										
														
											$sql_query_pf = "SELECT * FROM Tbl_prevflow where Prev='$ket2'";
											$cursorType_pf = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
											$params_pf = array(&$_POST['query']);
											$sqlConn_pf = sqlsrv_query($conn, $sql_query_pf, $params_pf, $cursorType_pf);
											if($sqlConn_pf === false){die(FormatErrors(sqlsrv_errors()));}
											if(sqlsrv_has_rows($sqlConn_wf))
												{
												$rowCount_pf = sqlsrv_num_rows($sqlConn_pf);
												while( $row_pf = sqlsrv_fetch_array( $sqlConn_pf, SQLSRV_FETCH_ASSOC))
													{	
													//$next=$row_pf['Prev'];
													$noflow=$row_pf['Flow'];
													//	echo $noflow."<br/>";
													//echo "<br/>";
													//echo $field_txnid_nom."<<>>".$row_wf['wf_action']."==".$wfid."----".$noflow."<br>";
													}
													//echo $field_txnid_nom."<<>>".$row_wf['wf_action']."==".$wfid."----".$noflow."<br>";
												}
											sqlsrv_free_stmt( $sqlConn_pf );
										}									
									}
   								sqlsrv_free_stmt( $sqlConn_fd );

		

								
	
									
									
							}
							$persen=round($penyebut/$hasil*100,2);
							$imgwidth = $persen * 1;

							//txn_nom//
							if ($cbxfilter=="A")
								{
								$nacust = $field_txnid_nom;	
								}
							else if ($cbxfilter=="F")	
								{
								if ($penyebut==$hasil)
									{
									$nacust = $field_txnid_nom;	
									}
								}
							elseif ($cbxfilter=="N")
								{
								if($penyebut<>$hasil)
									{
									$nacust = $field_txnid_nom;	
									}
								}
							//bar//								
							if ($cbxfilter=="A")
								{
								if ($persen < 50)
									{
									$progbar = " <img src=/lismega_devel/images/bar_red.gif width=$imgwidth height=20>";
									}
								else
									{
									$progbar = " <img src=/lismega_devel/images/bar_blue.gif width=$imgwidth height=20>";
								 	}	
								}
							else if ($cbxfilter=="F")	
								{
								if ($penyebut==$hasil)
								{
									if ($persen < 50)
										{
										$progbar = " <img src=/lismega_devel/images/bar_red.gif width=$imgwidth height=20>";
										}
									else
										{
										$progbar = " <img src=/lismega_devel/images/bar_blue.gif width=$imgwidth height=20>";
										}	
									}
								}
							elseif ($cbxfilter=="N")
								{
								if($penyebut<>$hasil)
									{
									if ($persen < 50)
										{
										$progbar = " <img src=/lismega_devel/images/bar_red.gif width=$imgwidth height=20>";
										}
									else
										{
										$progbar = " <img src=/lismega_devel/images/bar_blue.gif width=$imgwidth height=20>";
										}							
									}
								}
							//persen//	
							if ($cbxfilter=="A")
								{
								$naper = $persen.' %';	
								}
							else if ($cbxfilter=="F")	
								{
								if ($penyebut==$hasil)
									{
									$naper = $persen.' %';	
									}
								}
							elseif ($cbxfilter=="N")
								{
								if($penyebut<>$hasil)
									{
									$naper = $persen.' %';	
									}
								}
							//keterangan//
							if ($cbxfilter=="A")
								{
								$naket = $ket;	
								}
							else if ($cbxfilter=="F")	
								{
								if ($penyebut==$hasil)
									{
									$naket = $ket;	
									}							
								}
							elseif ($cbxfilter=="N")
								{
									if($penyebut<>$hasil)
									{
									$naket = $ket;	
									}
								}
						sqlsrv_free_stmt( $sqlConn_wf );
							
							//echo $field_txnid_nom."<br/>";
							if($background_row % 2)
								{
								$background = "#BDEDFF";
								}
							else
								{ 
								$background =  "white";
								}
								
						if($nacust != "")
							{	
					?>
					
		<tr style=" background:<? echo $background;?>;">
			<td align="center"><? echo $nacust?>&nbsp </td>
			<td style="padding:4px 0 0 5px;"><? echo $progbar ;?> &nbsp </td>
			<td align="center"><? echo $naper ?>&nbsp </td>
			<td style="padding-left:5px;">
					<?
					$sql_query_wf = "SELECT * FROM Tbl_workflow where wf_id ='$lastflow' ";
					$cursorType_wf = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_wf = array(&$_POST['query']);
					$sqlConn_wf = sqlsrv_query($conn, $sql_query_wf, $params_wf, $cursorType_wf);
					if	($sqlConn_wf === false){die(FormatErrors(sqlsrv_errors()));}
					if(sqlsrv_has_rows($sqlConn_wf))
						{
						$hasil=0;	
						$penyebut=0;
						$noflow="";
						$tmp_aa="";
						$tmp_bb="";
						$tmp_cc="";
						$rowCount_wf = sqlsrv_num_rows($sqlConn_wf);
						while( $row_wf = sqlsrv_fetch_array( $sqlConn_wf, SQLSRV_FETCH_ASSOC))
							{	
							$per_row_wf=$row_wf['wf_score'];
							$tmpact = "";
							for ($zz=0;$zz<strlen($row_wf['wf_action']);$zz++)
								{
								if (substr($row_wf['wf_action'],$zz,1) <> " ")
									{
									$tmpact = $tmpact . substr($row_wf['wf_action'],$zz,1);
									}
								}	
								
								$txnact=substr($tmpact,strlen($tmpact)-1);
								$hasil=$hasil+$per_row_wf;
								$wfid=$row_wf['wf_id'];
								//echo $wfid."</br>";
								//echo $field_txnid_nom."==".$wfid."--".$txnact."<br/>";
								
			
			
								$sql_query_fd = "SELECT COUNT(*) as total FROM Tbl_F$wfid WHERE txn_id='$field_txnid_nom' and txn_action='$txnact' and txn_user_id <> 'SPINMASTER'";
								$cursorType_fd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
								$params_fd = array(&$_POST['query']);
								$sqlConn_fd = sqlsrv_query($conn, $sql_query_fd, $params_fd,$cursorType_fd);
								if( $sqlConn_fd === false){die( FormatErrors( sqlsrv_errors() ) );}
								if(sqlsrv_has_rows($sqlConn_fd))
									{
									$rowCount_fd = sqlsrv_num_rows($sqlConn_fd);
									while( $row_fd = sqlsrv_fetch_array( $sqlConn_fd, SQLSRV_FETCH_ASSOC))
										{
										if($row_fd['total'] > 0)
											{	
											$penyebut += $row_wf['wf_score'];
											//$ket=$ket.$row_wf['wf_name'].',';
											$ket=$row_wf['wf_name'];
											//echo $field_txnid_nom.$row_wf['wf_action'].$wfid."<br>";
											//echo $row_wf['wf_action']."<br>";
											//echo $wfid;
											
											
											$ket2=$row_wf['wf_id'];
											}
											
										
											//echo $tmp_cc;
										}									
									}
   								sqlsrv_free_stmt( $sqlConn_fd );

							}
						}
					sqlsrv_free_stmt( $sqlConn_wf );			

					if ($persen==100)
					{
					$tmp_aa="Finish";
					}					
					else if ($persen==0)
					{
					$tmp_aa="Nominating belom di approve";
					}
					else if($persen<100 && $persen>0)
					{
					$tmp_aa=$naket;
					}
					echo $tmp_aa;

					?> 
			&nbsp 
			</td>
		</tr>
					<?
							$nacust = "";
							}
						}
					$background_row=$background_row+1;	
					}
				}
				sqlsrv_free_stmt( $sqlConn_nom );
					?>
	</table>

	
<? require("../lib/close_con.php")?>
</body>
</html>