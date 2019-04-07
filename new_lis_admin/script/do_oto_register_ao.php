<?
session_start();
include ("../lib/formatError.php");
require ("../lib/open_con.php");


if(isset($_REQUEST['in_userid']) && isset($_REQUEST['in_userpwd']))
{
	$userid = $_REQUEST['in_userid'];
	$userpwd = $_REQUEST['in_userpwd'];
	
	$_SESSION['nai_userid'] = $userid;
	$_SESSION['nai_userpwd'] = $userpwd;
	
	//echo $_SESSION['nai_userid']."if";
}
else
{
	//echo $_SESSION['nai_userid']."else";
}

$reg_userID = $_SESSION['nai_userid'];
$reg_userPWD = $_SESSION['nai_userpwd'];


$maxcount = $_REQUEST['action_counter'];

for($x=0 ; $x < $maxcount ; $x++)
{
	if(isset($_REQUEST['approved_'.$x]))
	{
		$action_now = $_REQUEST['approved_'.$x];
		//echo $action_now."<br>";
		
		$arr_Action = explode("|",$action_now);
		//print_r($arr_Action);
		
		switch($arr_Action[0])
		{
			case "INPUT"	:
			
			$tsql = "select * from oto_ao where ao_code = '$arr_Action[1]' and ao_branch_code = '$arr_Action[2]' and ao_nik = '$arr_Action[3]' and system_flag = 'R'";
			
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
					$act_code = $row['ao_code'];
					$act_name = $row['ao_name'];
					$act_branch = $row['ao_branch_code'];
					$act_hp = $row['ao_hp_number'];
					$act_nik = $row['ao_nik'];
					$act_flag = $row['ao_flag'];
					$act_active = $row['ao_active'];
					$act_create = $row['ao_create_userid'];
					$act_time = $row['ao_create_time'];
					$act_tl = $row['ao_tl'];
				
				
					
				
				
					$strsql2 = "SELECT * FROM oto_ao_target WHERE ao_code='".$act_code."' and ao_branch='".$act_branch."'";
					$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params2 = array(&$_POST['query']);
					$sqlConn2 = sqlsrv_query($conn, $strsql2, $params2, $cursorType2);
					if ( $sqlConn2 === false)die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($sqlConn2))
					{
						$rows2 = sqlsrv_num_rows($sqlConn2);
						while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
						{
							$sektor=$row2['sektor'];
							$app_target=$row2['app_target'];
							$nominal_target=$row2['nominal_target'];
							$_desc=$row2['_desc'];
							$startdate=$row2['startdate']->format('Y-m-d');
							$enddate=$row2['enddate']->format('Y-m-d');
						}
					}
					sqlsrv_free_stmt( $sqlConn2 );
					
						$dateline=" from ".$startdate ." until ".$enddate;
					if ($startdate==$enddate)
					{
						$dateline="For 1 Year";
					}
					
					$message="	Target Sektor  ".$sektor."
								Target Location ".$_desc."
								Target Nominal ".$nominal_target."
								Target Applikasi ".$app_target."
								Target Dateline ".$dateline."
								
					";
					
					
				
					$tsql_action = "
						INSERT INTO [tbl_sms_payment](
								
							   [notelp]
							   ,[message])
						 VALUES
							   ('$act_hp','$message')
					";
					$params_action = array(&$_POST['query']);
					$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
					if(!$stmt_action )
					{
						echo "Error in preparing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					
					if(!sqlsrv_execute( $stmt_action))
					{
						echo "Error in executing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmt_action);
					
					
					
					
					
					$strsql2 = "SELECT COUNT(*) as b FROM tbl_ao_target WHERE ao_code='".$act_code."' and ao_branch='".$act_branch."'";
					$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params2 = array(&$_POST['query']);
					$sqlConn2 = sqlsrv_query($conn, $strsql2, $params2, $cursorType2);
					if ( $sqlConn2 === false)die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($sqlConn2))
					{
						$rows2 = sqlsrv_num_rows($sqlConn2);
						while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
						{
							$rowcount2 = $row2['b'];
						}
					}
					sqlsrv_free_stmt( $sqlConn2 );
				
					
					

					if($rowcount2>0)
					{
						
						$tsql_action="update tbl_ao_target set 
						sektor='".$sektor."', 
						app_target='".$app_target."',
						nominal_target='".$nominal_target."' ,
						_desc='".$_desc."' ,
						startdate='".$startdate."' ,
						enddate='".$enddate."' 
						where ao_code='".$act_code."' 
						and ao_branch='".$act_branch."'";
						
						
							
					}
					else
					{
						$tsql_action="insert into tbl_ao_target ([ao_code],[ao_branch],[sektor],[app_target],[nominal_target],[_desc],[startdate],[enddate])
						values('".$act_code."','".$act_branch."','".$sektor."','".$app_target."','".$nominal_target."','".$_desc."','".$startdate."','".$enddate."')";
					}
	
				
					$params_action = array(&$_POST['query']);
					$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
					if( !$stmt_action )
					{
						echo "Error in preparing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					
					if( !sqlsrv_execute( $stmt_action))
					{
						echo "Error in executing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmt_action);

				
				
				
					$tsql_action = "insert into tbl_ao (ao_code,ao_name,ao_branch_code,ao_hp_number,ao_nik,ao_flag,ao_active,ao_create_userid,ao_create_time,ao_tl) values ('$act_code','$act_name','$act_branch','$act_hp','$act_nik','$act_flag','$act_active','$act_create',getdate(),'$act_tl')";
					$params_action = array(&$_POST['query']);
					$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
					if( $stmt_action )
					{
					} 
					else
					{
						echo "Error in preparing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					
					if( sqlsrv_execute( $stmt_action))
					{
					}
					else
					{
						echo "Error in executing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmt_action);
						
				}
			}
			sqlsrv_free_stmt( $sqlConn );
			
			$tsql_action = "update oto_ao set system_flag = 'D' where ao_code = '$arr_Action[1]' and ao_branch_code = '$arr_Action[2]' and ao_nik = '$arr_Action[3]'";
			$params_action = array(&$_POST['query']);
			$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
			if( $stmt_action )
			{
			} 
			else
			{
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			
			if( sqlsrv_execute( $stmt_action))
			{
			}
			else
			{
				echo "Error in executing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			sqlsrv_free_stmt( $stmt_action);
			
			$naiMsg = "Transaksi Otoriasi AO untuk data $act_code | $act_name | $act_nik | $act_branch telah di INPUT";
			break;
			
			
			
			case "EDIT"		:
			
			$tsql = "select * from oto_ao where ao_code = '$arr_Action[1]' and ao_branch_code = '$arr_Action[2]' and ao_nik = '$arr_Action[3]' and system_flag = 'R'";
			echo $tsql;
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
					$act_code = $row['ao_code'];
					$act_name = $row['ao_name'];
					$act_branch = $row['ao_branch_code'];
					$act_hp = $row['ao_hp_number'];
					$act_nik = $row['ao_nik'];
					$act_flag = $row['ao_flag'];
					$act_active = $row['ao_active'];
					$act_create = $row['ao_create_userid'];
					$act_time = $row['ao_create_time'];
					$act_tl = $row['ao_tl'];
				
				
				
				
				
					$strsql2 = "SELECT * FROM oto_ao_target WHERE ao_code='".$act_code."' and ao_branch='".$act_branch."'";
					$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params2 = array(&$_POST['query']);
					$sqlConn2 = sqlsrv_query($conn, $strsql2, $params2, $cursorType2);
					if ( $sqlConn2 === false)die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($sqlConn2))
					{
						$rows2 = sqlsrv_num_rows($sqlConn2);
						while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
						{
							$sektor=$row2['sektor'];
							$app_target=$row2['app_target'];
							$nominal_target=$row2['nominal_target'];
							$_desc=$row2['_desc'];
							$startdate=$row2['startdate']->format('Y-m-d');
							$enddate=$row2['enddate']->format('Y-m-d');
						}
					}
					sqlsrv_free_stmt( $sqlConn2 );
					
					
					
						$dateline=" from ".$startdate ." until ".$enddate;
					if ($startdate==$enddate)
					{
						$dateline="For 1 Year";
					}
					
					$message="	Target Sektor  ".$sektor."
								Target Location ".$_desc."
								Target Nominal ".$nominal_target."
								Target Applikasi ".$app_target."
								Target Dateline ".$dateline."
								
					";
					
					
				
					$tsql_action = "
						INSERT INTO [tbl_sms_payment](
							   [notelp]
							   ,[message])
						 VALUES
							   ('$act_hp','$message')
					";
					$params_action = array(&$_POST['query']);
					$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
					if(!$stmt_action )
					{
						echo "Error in preparing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					
					if(!sqlsrv_execute( $stmt_action))
					{
						echo "Error in executing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmt_action);
					
					
					$strsql2 = "SELECT COUNT(*) as b FROM tbl_ao_target WHERE ao_code='".$act_code."' and ao_branch='".$act_branch."'";
					$cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$params2 = array(&$_POST['query']);
					$sqlConn2 = sqlsrv_query($conn, $strsql2, $params2, $cursorType2);
					if ( $sqlConn2 === false)die( FormatErrors( sqlsrv_errors() ) );
					if(sqlsrv_has_rows($sqlConn2))
					{
						$rows2 = sqlsrv_num_rows($sqlConn2);
						while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_ASSOC))
						{
							$rowcount2 = $row2['b'];
						}
					}
					sqlsrv_free_stmt( $sqlConn2 );
				
					
					

					if($rowcount2>0)
					{
						
						$tsql_action="update tbl_ao_target set 
						sektor='".$sektor."', 
						app_target='".$app_target."',
						nominal_target='".$nominal_target."' ,
						_desc='".$_desc."' ,
						startdate='".$startdate."' ,
						enddate='".$enddate."' 
						where ao_code='".$act_code."' 
						and ao_branch='".$act_branch."'";
						
						
							
					}
					else
					{
						$tsql_action="insert into tbl_ao_target ([ao_code],[ao_branch],[sektor],[app_target],[nominal_target],[_desc],[startdate],[enddate])
						values('".$act_code."','".$act_branch."','".$sektor."','".$app_target."','".$nominal_target."','".$_desc."','".$startdate."','".$enddate."')";
					}
	
echo $tsql_action;
						$params_action = array(&$_POST['query']);
						$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
						if( !$stmt_action )
						{
							echo "Error in preparing statement.\n";
							die( print_r( sqlsrv_errors(), true));
						}
						
						if( !sqlsrv_execute( $stmt_action))
						{
							echo "Error in executing statement.\n";
							die( print_r( sqlsrv_errors(), true));
						}
						sqlsrv_free_stmt( $stmt_action);

				
				
				
				
				
				
				
				
				
					$tsql_action = "update tbl_ao set ao_name = '$act_name', ao_hp_number = '$act_hp', ao_nik = '$act_nik', ao_tl = '$act_tl' where ao_code = '$act_code' and ao_branch_code = '$act_branch' ";
					$params_action = array(&$_POST['query']);
					$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
					if( $stmt_action )
					{
					} 
					else
					{
						echo "Error in preparing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					
					if( sqlsrv_execute( $stmt_action))
					{
					}
					else
					{
						echo "Error in executing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmt_action);
						
				}
			}
			sqlsrv_free_stmt( $sqlConn );
			
			$tsql_action = "update oto_ao set system_flag = 'D' where ao_code = '$arr_Action[1]' and ao_branch_code = '$arr_Action[2]' and ao_nik = '$arr_Action[3]'";
			$params_action = array(&$_POST['query']);
			$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
			if( $stmt_action )
			{
			} 
			else
			{
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			
			if( sqlsrv_execute( $stmt_action))
			{
			}
			else
			{
				echo "Error in executing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			sqlsrv_free_stmt( $stmt_action);
			
			$naiMsg = "Transaksi Otoriasi AO untuk data $act_code | $act_branch telah di EDIT";
			break;
			
			
			case "DELETE"	:
			
			$tsql = "select * from oto_ao where ao_code = '$arr_Action[1]' and ao_branch_code = '$arr_Action[2]' and ao_nik = '$arr_Action[3]' and system_flag = 'R'";
			echo $tsql;
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
					$act_code = $row['ao_code'];
					$act_name = $row['ao_name'];
					$act_branch = $row['ao_branch_code'];
					$act_hp = $row['ao_hp_number'];
					$act_nik = $row['ao_nik'];
					$act_flag = $row['ao_flag'];
					$act_active = $row['ao_active'];
					$act_create = $row['ao_create_userid'];
					$act_time = $row['ao_create_time'];
					$act_tl = $row['ao_tl'];
				
					$tsql_action = "delete from tbl_ao where ao_code = '$act_code' and ao_branch_code = '$act_branch'
									delete oto_ao_target where ao_code = '$act_code' and ao_branch = '$act_branch'
									delete tbl_ao_target where ao_code = '$act_code' and ao_branch = '$act_branch'
					
					";
					$params_action = array(&$_POST['query']);
					$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
					if( $stmt_action )
					{
					} 
					else
					{
						echo "Error in preparing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					
					if( sqlsrv_execute( $stmt_action))
					{
					}
					else
					{
						echo "Error in executing statement.\n";
						die( print_r( sqlsrv_errors(), true));
					}
					sqlsrv_free_stmt( $stmt_action);
						
				}
			}
			sqlsrv_free_stmt( $sqlConn );
			
			$tsql_action = "update oto_ao set system_flag = 'D' where ao_code = '$arr_Action[1]' and ao_branch_code = '$arr_Action[2]' and ao_nik = '$arr_Action[3]'";
			$params_action = array(&$_POST['query']);
			$stmt_action = sqlsrv_prepare( $conn, $tsql_action, $params_action);
			if( $stmt_action )
			{
			} 
			else
			{
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			
			if( sqlsrv_execute( $stmt_action))
			{
			}
			else
			{
				echo "Error in executing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			sqlsrv_free_stmt( $stmt_action);
			
			$naiMsg = "Transaksi Otoriasi AO untuk data $act_code | $act_branch telah di DELETE";
			break;
		}
	}
	
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>otorisasi</title>
</head>

<body>
</body>
</html>
<?
header("location:./oto_register_ao.php?msg=$naiMsg");
?>