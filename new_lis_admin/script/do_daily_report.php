<?  
require ("../lib/open_con.php");
$cbxpro=$_GET['progress'];
$bg_row=0;
?>
<html>
<head>
<title>Persentase</title>

<link rel="stylesheet" type="text/css" href="/BM/style/d.css" />
</head>
  <body style="background:url(../images/Background%20Mega.png) no-repeat center;">
<table align="center" width="960" border="0" style="">
  <tr style="margin-bottom:px;">
    <td align="center"><img src="../images/Header Mega (L).png" width=100%></td>
  </tr>
  </table>
  <br/>
<table style="background-color:#FFF;"width="960"  cellpadding="0" cellspacing="0" border="1px" align="center" bordercolor="#4476b3" bordercolorlight="#000000" bordercolordark="#ffffff" >
  <tr>
    <td>Proses</td>
    <td>Quantity</td>
    <td>Input</td>
    <td>Checker</td>
    <td>Approve</td>
  </tr>

		<?
			if ($cbxpro=='A')
			{
				$sql_workflow = "SELECT * FROM tbl_workflow  order by wf_urut";
			}
			else
			{
				$sql_workflow = "SELECT * FROM tbl_workflow where wf_id='$cbxpro' order by wf_urut";
			}
	
			$cursor_type_workflow = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_workflow = array(&$_POST['query']);
			$sql_con_workflow = sqlsrv_query($conn, $sql_workflow, $params_workflow, $cursor_type_workflow);
	
			if 	($sql_con_workflow === false){die(FormatErrors(sqlsrv_errors()));}
			if	(sqlsrv_has_rows($sql_con_workflow))
				{
				$row_count_workflow = sqlsrv_num_rows($sql_con_workflow);
				while( $row_workflow = sqlsrv_fetch_array( $sql_con_workflow, SQLSRV_FETCH_ASSOC))
					{
					$field_wf_name_workflow = $row_workflow['wf_name'];
					$ftbl=$row_workflow['wf_id'];
					$bg_row=$bg_row+1;
					$tmpact = "";
					for ($zz=0;$zz<strlen($row_workflow['wf_action']);$zz++)
						{
							if (substr($row_workflow['wf_action'],$zz,1) <> " ")
								{
									$tmpact = $tmpact . substr($row_workflow['wf_action'],$zz,1);
								}
						}
					$txnact=substr($tmpact,strlen($tmpact)-1);
					$sql_ftbl="select count(*) as total from tbl_F$ftbl where txn_action='I' and txn_user_id <> 'SPINMASTER'";
					$cursor_type_ftbl = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ftbl= array(&$_POST['query']);
					$sql_con_ftbl = sqlsrv_query($conn, $sql_ftbl, $params_ftbl, $cursor_type_ftbl);
					if 	($sql_con_workflow === false)
						{
						die(FormatErrors(sqlsrv_errors()));
						}
							if	(sqlsrv_has_rows($sql_con_ftbl))
								{
								$row_count_ftbl= sqlsrv_num_rows($sql_con_ftbl);
								while( $row_ftbl = sqlsrv_fetch_array( $sql_con_ftbl, SQLSRV_FETCH_ASSOC))
									{
										$total_ftbl=$row_ftbl['total'];		
										
							if($bg_row % 2)
								{
								$background = "#BDEDFF";
								}
							else
								{ 
								$background =  "white";
								}										
?>												
  <tr style="background:<? echo $background ?>;">
    <td><? echo $field_wf_name_workflow;?></td>
    <td><? echo $total_ftbl;?></td>
    


<?
									}
								}
							sqlsrv_free_stmt( $sql_con_ftbl );

							
					///check txn_action =i
					$sql_ftbli="select count(*) as total from tbl_F$ftbl where txn_action='i' and txn_user_id <> 'SPINMASTER'";
					$cursor_type_ftbl1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ftbl1= array(&$_POST['query']);
					$sql_con_ftbl1 = sqlsrv_query($conn, $sql_ftbli, $params_ftbl1, $cursor_type_ftbl1);
						
					if 	($sql_con_ftbl1 === false){die(FormatErrors(sqlsrv_errors()));}
					if	(sqlsrv_has_rows($sql_con_ftbl1))
						{
						$row_count_ftbl1= sqlsrv_num_rows($sql_con_ftbl1);
						while( $row_ftbl1 = sqlsrv_fetch_array( $sql_con_ftbl1, SQLSRV_FETCH_ASSOC))
							{
							$total_ftbl1=$row_ftbl1['total'];
							?>
                            <td><? echo $total_ftbl1;?></td>
							<?
							}
						}
					sqlsrv_free_stmt( $sql_con_ftbl1 );
							
							
							
							
					$sql_ftbl2="select count(*) as total from tbl_F$ftbl where txn_action='c' and txn_user_id <> 'SPINMASTER' ";
					$cursor_type_ftbl2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ftbl2= array(&$_POST['query']);
					$sql_con_ftbl2 = sqlsrv_query($conn, $sql_ftbl2, $params_ftbl2, $cursor_type_ftbl2);
						
					if 	($sql_con_ftbl2 === false){die(FormatErrors(sqlsrv_errors()));}
					if	(sqlsrv_has_rows($sql_con_ftbl2))
						{
						$row_count_ftbl2= sqlsrv_num_rows($sql_con_ftbl2);
						while( $row_ftbl2 = sqlsrv_fetch_array( $sql_con_ftbl2, SQLSRV_FETCH_ASSOC))
							{
							$total_ftbl2=$row_ftbl2['total'];
							?>
                            <td><? echo $total_ftbl2;?></td>

							<?
							}
						}
					sqlsrv_free_stmt( $sql_con_ftbl2 );
							
							

					///check txn_action =i
					$sql_ftbla="select count(*) as total from tbl_F$ftbl where txn_action='a' and txn_user_id <> 'SPINMASTER' ";
					$cursor_type_ftbla = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params_ftbla= array(&$_POST['query']);
					$sql_con_ftbla = sqlsrv_query($conn, $sql_ftbla, $params_ftbla, $cursor_type_ftbla);
						
					if 	($sql_con_ftbla === false){die(FormatErrors(sqlsrv_errors()));}
					if	(sqlsrv_has_rows($sql_con_ftbla))
						{
						$row_count_ftbla= sqlsrv_num_rows($sql_con_ftbla);
						while( $row_ftbla = sqlsrv_fetch_array( $sql_con_ftbla, SQLSRV_FETCH_ASSOC))
							{
							$total_ftbla=$row_ftbla['total'];
							?>
                                <td><? echo $total_ftbla;?></td>
							<?
							}
						}
					sqlsrv_free_stmt( $sql_con_ftbla );
					}
				}
				sqlsrv_free_stmt( $sql_con_workflow );


?>
  	 

  </tr>
		
		</table>



<? include ("../lib/close_con.php")?>
</body>
</html>