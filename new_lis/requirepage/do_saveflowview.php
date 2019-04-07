<?
	
	require ("../lib/open_con.php");
	require ("../lib/formatError.php");	
	require ("parameter.php");
	
	if(isset($_REQUEST['approvepermission']))
	{
		$approvepermission=$_REQUEST['approvepermission'];
	}
	else
	{
		$approvepermission="";
	}

	
//	echo $userwfid." kuda monyong".$userpwd."asjdhasjhda";
// GET ORIGINAL BRANCH
  $originalregion = $userregion;
  $originalbranch = $userbranch;
  $originalao = $userid;
  if ($userwfid != "START")
  {
		$tsql = "SELECT txn_branch_code,txn_region_code,txn_user_id FROM Tbl_FSTART
					 	WHERE txn_id='$custnomid'";
   	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   	$params = array(&$_POST['query']);
   	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	
		if($sqlConn === false)
		{
			die(FormatErrors(sqlsrv_errors()));
		}
	
		if(sqlsrv_has_rows($sqlConn))
		{
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
  			$originalbranch = $row[0];
  			$originalregion = $row[1];
        $originalao = $row[2];
      }
   	}
   	sqlsrv_free_stmt( $sqlConn );
  }

// SAVE FLOW

if ($userpermission == "I")
{
	$wfaction = "";
	$tsql = "SELECT wf_action as b FROM Tbl_Workflow WHERE wf_id='$userwfid'";
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
			$wfaction = $row['b'];
		}
	}
	
	sqlsrv_free_stmt( $sqlConn );

	if ($wfaction == "I")
	{
		$userpermission = "A";
	}
	if ($wfaction == "IA")
	{
		$userpermission = "C";
	}
	
	$tsql = "SELECT COUNT(*) as b FROM Tbl_F$userwfid WHERE txn_id='$custnomid' AND txn_action='$userpermission'";

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
			$rowcount = $row['b'];
		}
	}
	sqlsrv_free_stmt( $sqlConn );
   
	if ($rowcount <= 0)
	{
		$tsql = "INSERT INTO Tbl_F$userwfid ([txn_id],[txn_action],[txn_time],[txn_user_id],[txn_notes],[txn_branch_code],[txn_region_code])
		VALUES('$custnomid','$userpermission',getdate(),'$userid','', '$originalbranch','$originalregion')";
		$params = array(&$_POST['query']);
		$stmt = sqlsrv_prepare( $conn, $tsql, $params);
		if( $stmt )
		{
		} 
		else
		{
			echo "Error in preparing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
		
		if( sqlsrv_execute( $stmt))
		{
		}
		else
		{
			echo "Error in executing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
		sqlsrv_free_stmt( $stmt);
	
		$tsql = "INSERT INTO Tbl_Txn_History VALUES('$custnomid','$userpermission',getdate(),'$userid','','$userwfid', '$originalbranch','$originalregion')";
		$stmt = sqlsrv_prepare( $conn, $tsql, $params);
		if( $stmt )
		{
		} 
		else
		{
			echo "Error in preparing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
		
		if( sqlsrv_execute( $stmt))
		{
		}
		else
		{
			echo "Error in executing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
		sqlsrv_free_stmt( $stmt);
	}
	}
	else if ($userpermission == "C")
	{
	$wfaction = "";
	$tsql = "SELECT wf_action as b FROM Tbl_Workflow WHERE wf_id='$userwfid'";
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
			$wfaction = $row['b'];
		}
	}
	sqlsrv_free_stmt( $sqlConn );
	
	if ($wfaction == "IC")
	{
		$userpermission = "A";
	}
	
	$tsql = "SELECT COUNT(*) as b FROM Tbl_F$userwfid WHERE txn_id='$custnomid' AND txn_action='I'";
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
			$rowcount = $row['b'];
		}
	}
	sqlsrv_free_stmt( $sqlConn );
	
	if ($rowcount > 0)
	{
		$tsql = "UPDATE Tbl_F$userwfid set txn_action='$userpermission', txn_time=getdate() WHERE txn_id='$custnomid'";
		$params = array(&$_POST['query']);
		$stmt = sqlsrv_prepare( $conn, $tsql, $params);
		if( $stmt )
		{
		} 
		else
		{
			echo "Error in preparing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
	
		if( sqlsrv_execute( $stmt))
		{
		}
		else
		{
			echo "Error in executing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
		sqlsrv_free_stmt( $stmt);
	
		$tsql = "INSERT INTO Tbl_Txn_History VALUES('$custnomid','$userpermission',getdate(),'$userid','','$userwfid', '$originalbranch','$originalregion')";
		$params = array(&$_POST['query']);
		$stmt = sqlsrv_prepare( $conn, $tsql, $params);
		if( $stmt )
		{
		} 
		else
		{
			echo "Error in preparing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
	
		if( sqlsrv_execute( $stmt))
		{
		}
		else
		{
			echo "Error in executing statement.\n";
			die( print_r( sqlsrv_errors(), true));
		}
		sqlsrv_free_stmt( $stmt);
	}
	}
	else if ($userpermission == "A")
	{
		
	
  //APPROVE
	if($approvepermission == "A")
	{
		$Notes=$_REQUEST['note'];	

	  $tsql = "SELECT COUNT(*) as b FROM Tbl_F$userwfid WHERE txn_id='$custnomid' AND (txn_action='C' or txn_action='I')";
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
			  $rowcount = $row['b'];
		  }
	  }
	  sqlsrv_free_stmt( $sqlConn );
	
	  if ($rowcount > 0)
	  {
		  $tsql = "UPDATE Tbl_F$userwfid set txn_action='$userpermission', txn_notes='$Notes', txn_time=getdate() WHERE txn_id='$custnomid'";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
			  echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
			  echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

		  $tsql = "INSERT INTO Tbl_Txn_History VALUES('$custnomid','$userpermission',getdate(),'$userid','','$userwfid', '$originalbranch','$originalregion')";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

// CHECK RULES
	  	$wfnextflow = "";
			$tsql = "SELECT *
						 FROM Tbl_PrevFlow
					 	WHERE Flow='$userwfid'";
   		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   		$params = array(&$_POST['query']);
   		$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	
			if($sqlConn === false)
			{
				die(FormatErrors(sqlsrv_errors()));
			}
	
			if(sqlsrv_has_rows($sqlConn))
			{
      	$rowCount = sqlsrv_num_rows($sqlConn);
      	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      	{
   		   $wfprevflow = $row[1];
   		   $wfnextflow = $row[2];
   		   $wfrulesflow = $row[3];
      	}
   		}
   		sqlsrv_free_stmt( $sqlConn );
		  if ($wfnextflow != "")
		  {
      	$arrnextflow=explode("~",$wfnextflow);
							$rulesok = "N";
//							$wfrulesflow = "//Tbl_CustomerMasterPerson//custsex//custnomid//validnomid//EQ//0||AND//Tbl_CustomerFacility//SUM(custcreditplafond)//custnomid//validnomid//GE//200000000;
//								$wfrulesflow = "**Tbl_CustomerMasterPerson**custsex**custnomid**validnomid**EQ**0^^AND**Tbl_CustomerFacility**SUM(custcreditplafond)**custnomid**validnomid**GE**200000000;
							if ($wfrulesflow != "")
							{
      					$arrallrules=explode("^^",$wfrulesflow);
      					$hitrulesok = 0;
								$rulesok = "N";
      					for ($hitrule=0;$hitrule<count($arrallrules);$hitrule++)
      					{
      						$arrrules=explode("**",$arrallrules[$hitrule]);
      						$rulesvalue = "";
									$rulesid = $$arrrules[4];
     							$tsql = "SELECT $arrrules[2] FROM $arrrules[1] WHERE $arrrules[3]='$rulesid'";
     							$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
     							$params = array(&$_POST['query']);
     							$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
     							if ( $sqlConn === false)
	       						die( FormatErrors( sqlsrv_errors()));

  	   						if(sqlsrv_has_rows($sqlConn))
     							{
	     							$rowCount = sqlsrv_num_rows($sqlConn);
	     							while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
	     							{				
	      							$rulesvalue = $row[0];
			 							}
       							sqlsrv_free_stmt( $sqlConn );
	   							}
	   							if ($rulesvalue != "")
	   							{
      							if ($arrrules[5] == "NE")
      							{
      								if ($rulesvalue != $arrrules[6])
      								{
									     	$hitrulesok++;
      								}
      							}
      							if ($arrrules[5] == "EQ")
      							{
      								if ($rulesvalue == $arrrules[6])
      								{
									     	$hitrulesok++;
      								}
      							}
      							if ($arrrules[5] == "GE")
      							{
      								if ($rulesvalue >= $arrrules[6])
      								{
									     	$hitrulesok++;
      								}
      							}
      							if ($arrrules[5] == "LE")
      							{
      								if ($rulesvalue <= $arrrules[6])
      								{
									     	$hitrulesok++;
      								}
      							}
      							if ($arrrules[5] == "GT")
      							{
      								if ($rulesvalue > $arrrules[6])
      								{
									     	$hitrulesok++;
      								}
      							}
      							if ($arrrules[5] == "LT")
      							{
      								if ($rulesvalue < $arrrules[6])
      								{
									     	$hitrulesok++;
      								}
      							}
	   							}
      					}
      					if ($hitrulesok == count($arrallrules))
      					{
									$rulesok = "Y";
      					}
							}

				if ($rulesok == "Y")
				{
		  	   $tsql = "INSERT INTO Tbl_F$arrnextflow[0] VALUES('$custnomid','I',getdate(),'$userid','','', '$originalbranch','$originalregion')";
		  	}
		  	else
				{
		  	   $tsql = "INSERT INTO Tbl_F$arrnextflow[1] VALUES('$custnomid','I',getdate(),'$userid','','', '$originalbranch','$originalregion')";
		  	}
		  	$params = array(&$_POST['query']);
		  	$stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  	if( $stmt )
		  	{
		  	} 
		  	else
		  	{
  				echo "Error in preparing statement.\n";
			  	die( print_r( sqlsrv_errors(), true));
		  	}

		  	if( sqlsrv_execute( $stmt))
		  	{
		  	}
		  	else
		  	{
  				echo "Error in executing statement.\n";
			  	die( print_r( sqlsrv_errors(), true));
		  	}
		  	sqlsrv_free_stmt( $stmt);
		  }
// END CHECK RULE
		  
		  
  	}
	}
  // END APPROVE

  //REVISION
	if($approvepermission == "R")
	{
		$Notes=$_REQUEST['note'];

			if ($userwfid == "NOM")
			{
		     $tsql = "UPDATE Tbl_F$userwfid set txn_action='I' WHERE txn_id='$custnomid'";
			}
		  else
			{
		     $tsql = "DELETE FROM Tbl_F$userwfid WHERE txn_id='$custnomid'";
		  }
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

		  $tsql = "INSERT INTO Tbl_Notification VALUES('$custnomid','$userwfid','$originalao',getdate(),'Revision','$Notes', 'N')";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);
	}
  //END REVISION

  //REJECT
	if($approvepermission == "J")
	{
		$Notes=$_REQUEST['note'];
		  $tsql = "UPDATE Tbl_F$userwfid set txn_action='J', txn_notes='$Notes' WHERE txn_id='$custnomid'";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

		  $tsql = "INSERT INTO Tbl_Notification VALUES('$custnomid','$userwfid','$originalao',getdate(),'Reject','$Notes', 'N')";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

	}
  //END REJECT

  //FLOW STATUS
	  $tsql = "SELECT COUNT(*) as b FROM Tbl_Flow_Status WHERE txn_id='$custnomid'";
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
			  $rowcount = $row['b'];
		  }
	  }
	  sqlsrv_free_stmt( $sqlConn );
	
	  if ($rowcount > 0)
	  {
		  $tsql = "UPDATE Tbl_Flow_Status set txn_flow='$userwfid', txn_user_id='$userid',
		  				 txn_time=getdate(), txn_action='$approvepermission'
		  				 WHERE txn_id='$custnomid'";
		}
		else
		{
		  $tsql = "INSERT INTO Tbl_Flow_Status values('$custnomid','$userwfid','$approvepermission',
		  				 getdate(),'$userid','$originalbranch','$originalregion','$originalao')";
		}
		
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
			  echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
			  echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);
  //END FLOW STATUS

}
  //BTAO
	if($approvepermission == "B" or $userpermission == "B")
	{
		$STSBTAO=$_REQUEST['STSBTAO'];
		$KETBTAO=$_REQUEST['KETBTAO'];

		if ($STSBTAO != "001")
		{
		  $tsql = "DELETE FROM Tbl_F$userwfid WHERE txn_id='$custnomid'";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

		  if ($userwfid == "BCO")
		  {
		     $tsql = "UPDATE Tbl_CustomerFlag
		     					set custflagbi='N'
		     					 WHERE custnomid='$custnomid'";
		     $params = array(&$_POST['query']);
		     $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		     if( $stmt )
		     {
		     } 
		     else
		     {
  			   echo "Error in preparing statement.\n";
			     die( print_r( sqlsrv_errors(), true));
		     }

		     if( sqlsrv_execute( $stmt))
		     {
		     }
		     else
		     {
  			   echo "Error in executing statement.\n";
			     die( print_r( sqlsrv_errors(), true));
		     }
		     sqlsrv_free_stmt( $stmt);
		  }
		}

			if ($userwfid == "BCO")
			{
			 $tsql = "UPDATE Tbl_CustomerFlag
								set custflagbi='I'
								 WHERE custnomid='$custnomid'";
			 $params = array(&$_POST['query']);
			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
			   echo "Error in preparing statement.\n";
				 die( print_r( sqlsrv_errors(), true));
			 }
			
			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
				 die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);
			}

		  $tsql = "INSERT INTO Tbl_Notification VALUES('$custnomid','$userwfid','$originalao',getdate(),'$STSBTAO','$KETBTAO', 'N')";
		  $params = array(&$_POST['query']);
		  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
		  if( $stmt )
		  {
		  } 
		  else
		  {
  			echo "Error in preparing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }

		  if( sqlsrv_execute( $stmt))
		  {
		  }
		  else
		  {
  			echo "Error in executing statement.\n";
			  die( print_r( sqlsrv_errors(), true));
		  }
		  sqlsrv_free_stmt( $stmt);

		$tsql = "SELECT btao_action as b FROM Tbl_BackToAO WHERE btao_code='$STSBTAO'";

	  $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	  $params = array(&$_POST['query']);
	  $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

	  if ( $sqlConn === false)
		  die( FormatErrors( sqlsrv_errors() ) );

		$btaoact = "";
	  if(sqlsrv_has_rows($sqlConn))
	  {
		  $rowCount = sqlsrv_num_rows($sqlConn);
		  while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
		  {
			  $btaoact = $row['b'];
		  }
	  }
	  sqlsrv_free_stmt( $sqlConn );

	  if ($btaoact != "")
	  {
		  $dataall=explode("|",$btaoact);
		  $countdataall = 0;
		  foreach ($dataall as $t)
			{
    		$countdataall++;
  		}
  			for ($i=0;$i<$countdataall;$i++)
  			{
				  $tsql = "DELETE FROM Tbl_F$dataall[$i] WHERE txn_id='$custnomid'";
				  $params = array(&$_POST['query']);
				  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
				  if( $stmt )
				  {
				  } 
				  else
				  {
		  			echo "Error in preparing statement.\n";
					  die( print_r( sqlsrv_errors(), true));
				  }

				  if( sqlsrv_execute( $stmt))
				  {
		  		}
				  else
				  {
  					echo "Error in executing statement.\n";
					  die( print_r( sqlsrv_errors(), true));
				  }
				  sqlsrv_free_stmt( $stmt);
  			}
	  }

	}
  //END BTAO

// SAVE SLA
if ($userpermission != "")
{
	$wftime = 0;
	$wfscore = 0;
	$tsql = "SELECT wf_time,wf_score FROM Tbl_Workflow WHERE wf_id='$userwfid'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($sqlConn))
	{
		$rowCount = sqlsrv_num_rows($sqlConn);
		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
		{
			$wftime = $row[0];
			$wfscore = $row[1];
		}
	}	
	sqlsrv_free_stmt( $sqlConn );

  $slacount = 0;
	$tsql = "select sum(Tbl_Workflow.wf_score)
   					from Tbl_SE_UserProgram, Tbl_Workflow
   					where Tbl_SE_UserProgram.program_code=Tbl_Workflow.wf_id
   					AND Tbl_SE_userProgram.user_id='$userid'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);

	if ( $sqlConn === false)
		die( FormatErrors( sqlsrv_errors() ) );

	if(sqlsrv_has_rows($sqlConn))
	{
		$rowCount = sqlsrv_num_rows($sqlConn);
		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
		{
			$slacount = $row[0];
		}
	}	
	sqlsrv_free_stmt( $sqlConn );

	  $thecount = "";
		$tsql = "SELECT COUNT(*) FROM Tbl_SLADetail
						WHERE sla_userid='$userid'
						AND sla_nomid='$custnomid'
						AND sla_wfid='$userwfid'";
   	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   	$params = array(&$_POST['query']);
   	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	
		if($sqlConn === false)
		{
			die(FormatErrors(sqlsrv_errors()));
		}
	
		if(sqlsrv_has_rows($sqlConn))
		{
      $rowCount = sqlsrv_num_rows($sqlConn);
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      {
  			$thecount = $row[0];
      }
   	}
   	sqlsrv_free_stmt( $sqlConn );
   	
    if ($userpermission == "I" || $userpermission == "C" || $userpermission == "A")
    {
   	   if ($thecount <= 0)
   	   {
   	   	 if ($userpermission == "I")
   	   	 {
				    $tsql = "INSERT INTO Tbl_SLADetail VALUES('$userid','$custnomid','$userwfid',
				    			'$wftime','$wfscore',getdate(),'','')";
				 }
   	   	 if ($userpermission == "C")
   	   	 {
				    $tsql = "INSERT INTO Tbl_SLADetail VALUES('$userid','$custnomid','$userwfid',
				    			'$wftime','$wfscore',getdate(),getdate(),'')";
				 }
   	   	 if ($userpermission == "A")
   	   	 {
				    $tsql = "INSERT INTO Tbl_SLADetail VALUES('$userid','$custnomid','$userwfid',
				    			'$wftime','$wfscore',getdate(),getdate(),getdate())";
				 }
   	   }
   	   else
   	   {
   	   	 $slacount = 0;
   	   	 if ($userpermission == "I")
   	   	 {
				   $tsql = "UPDATE Tbl_SLADetail
				 					set sla_time_i=getdate()
				 					WHERE sla_userid='$userid'
				 					AND sla_nomid='$custnomid'
				 					AND sla_wfid='$userwfid'";
   	   	 }
   	   	 if ($userpermission == "C")
   	   	 {
				   $tsql = "UPDATE Tbl_SLADetail
				 					set sla_time_c=getdate()
				 					WHERE sla_userid='$userid'
				 					AND sla_nomid='$custnomid'
				 					AND sla_wfid='$userwfid'";
   	   	 }
   	   	 if ($userpermission == "A")
   	   	 {
				   $tsql = "UPDATE Tbl_SLADetail
				 					set sla_time_a=getdate()
				 					WHERE sla_userid='$userid'
				 					AND sla_nomid='$custnomid'
				 					AND sla_wfid='$userwfid'";
   	   	 }
   	   }
				  $params = array(&$_POST['query']);
				  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
				  if( $stmt )
				  {
				  } 
				  else
				  {
		  			echo "Error in preparing statement.\n";
					  die( print_r( sqlsrv_errors(), true));
				  }

				  if( sqlsrv_execute( $stmt))
				  {
		  		}
				  else
				  {
  					echo "Error in executing statement.\n";
					  die( print_r( sqlsrv_errors(), true));
				  }
				  sqlsrv_free_stmt( $stmt);
    }
   	if ($userpermission == "A")
   	{
	  	$thecount = "";
  		$yearmonth = Date('Ym');
			$tsql = "SELECT COUNT(*) FROM Tbl_SLAHead
						WHERE sla_userid='$userid'
						AND sla_year_month='$yearmonth'";
   		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   		$params = array(&$_POST['query']);
   		$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	
			if($sqlConn === false)
			{
				die(FormatErrors(sqlsrv_errors()));
			}
	
			if(sqlsrv_has_rows($sqlConn))
			{
      	$rowCount = sqlsrv_num_rows($sqlConn);
      	while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_NUMERIC))
      	{
  				$thecount = $row[0];
      	}
   		}
   		sqlsrv_free_stmt( $sqlConn );
   		
			if ($thecount <= 0)
			{
				  $tsql = "INSERT INTO Tbl_SLAHead VALUES('$yearmonth','$userid',
				  					'$wfscore','$slacount')";
			}
			else
			{
				  $tsql = "UPDATE Tbl_SLAHead
				  					set sla_sum=sla_sum+'$wfscore', sla_count=sla_count+'$slacount'
				  					WHERE sla_userid='$userid'
						AND sla_year_month='$yearmonth'";
			}
				  $params = array(&$_POST['query']);
				  $stmt = sqlsrv_prepare( $conn, $tsql, $params);
				  if( $stmt )
				  {
				  } 
				  else
				  {
		  			echo "Error in preparing statement.\n";
					  die( print_r( sqlsrv_errors(), true));
				  }

				  if( sqlsrv_execute( $stmt))
				  {
		  		}
				  else
				  {
  					echo "Error in executing statement.\n";
					  die( print_r( sqlsrv_errors(), true));
				  }
				  sqlsrv_free_stmt( $stmt);
		}

			$loguserid = $userid;
			$logipaddr = $_SERVER['REMOTE_ADDR'];
			$logprogramcode = $userwfid;
			$logproductcode = "";
			$logdesc = $custnomid;
			$logaction = $userpermission;
      $tsql = "INSERT INTO Tbl_SE_UserLog VALUES('$loguserid',getdate(), '$logipaddr',
      			   '$logprogramcode','$logproductcode','$logdesc','$logaction')";
      $params = array(&$_POST['query']);
      $stmt = sqlsrv_prepare( $conn, $tsql, $params);
      if( $stmt )
      {
      } 
      else
      {
         echo "Error in preparing statement.\n";
         die( print_r( sqlsrv_errors(), true));
      }
      if( sqlsrv_execute( $stmt))
      {
      }
      else
      {
        echo "Error in executing statement.\n";
        die( print_r( sqlsrv_errors(), true));
      }
      sqlsrv_free_stmt( $stmt);
   	
}
// END SAVE SLA

// CLEAR Temporari User Akses
						$tsql = "DELETE FROM Tbl_TemporariUserAkses
											where tua_wfid='$userwfid'
    							AND tua_nomid='$custnomid'";
						$params = array(&$_POST['query']);
						$stmt = sqlsrv_prepare( $conn, $tsql, $params);
						if( $stmt )
						{
						} 
						else
						{
							echo "Error in preparing statement.\n";
							die( print_r( sqlsrv_errors(), true));
						}
	
						if( sqlsrv_execute( $stmt))
						{
						}
						else
						{
							echo "Error in executing statement.\n";
							die( print_r( sqlsrv_errors(), true));
						}
						sqlsrv_free_stmt( $stmt);
// END CLEAR Temporari User Akses

header("location:../page/flow.php?userwfid=$userwfid&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");

?>