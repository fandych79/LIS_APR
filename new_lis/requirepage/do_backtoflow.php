<?php

require_once ("../lib/formatError.php");
require_once ("../lib/open_con.php");
//require_once ("../../requirepage/parameter.php");

  $userwfid=$_POST['userwfid'];
  $userbranch=$_POST['userbranch'];
  $userregion=$_POST['userregion'];
  $userid=$_POST['userid'];
  $userpwd=$_POST['userpwd'];
  $backtoflow=$_POST['backtoflow'];
  $backtostatus=$_POST['backtostatus'];
  $backtonotes=$_POST['backtonotes'];
  $custnomid=$_POST['custnomid'];
  $arrbackto=explode("|",$backtoflow);
  $backtoflow = $arrbackto[0];
  $backtowfurut = $arrbackto[1];

     $proccode = "";
	   $tsql = "SELECT custproccode FROM Tbl_CustomerMasterPerson2 WHERE custnomid='$custnomid'";
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
			   $proccode = $row[0];
		   }
	   }
	   sqlsrv_free_stmt( $sqlConn );

  if ($backtostatus == "SEQ")
  {
	   $tsql = "SELECT wf_id FROM Tbl_Workflow WHERE wf_urut>'$backtowfurut'";
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

   			  $tsql2 = "SELECT COUNT(*)
						        FROM tbl_processing_auto
						        WHERE proc_code='$proccode'
						        AND proc_flow_auto='$row[0]'";
								//echo $tsql2;exit;
          $cursorType2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   			  $params2 = array(&$_POST['query']);

   		    $sqlConn2 = sqlsrv_query($conn, $tsql2, $params2, $cursorType2);

          if ( $sqlConn2 === false)
      			die( FormatErrors( sqlsrv_errors() ) );

   			  if(sqlsrv_has_rows($sqlConn2))
   			  {
      		   $rowCount2 = sqlsrv_num_rows($sqlConn2);
      			 while( $row2 = sqlsrv_fetch_array( $sqlConn2, SQLSRV_FETCH_NUMERIC))
      		   {
      		   	   if ($row2[0] <= 0)
      		   	   {
			               $backtoflow .= "|" . $row[0];
      		   	   }
      		   }
   				}
   	      sqlsrv_free_stmt( $sqlConn2 );

//			   $backtoflow .= "|" . $row[0];
		   }
	   }
	   sqlsrv_free_stmt( $sqlConn );
  }

  $arrbackto=explode("|",$backtoflow);
  for ($hitbackto=0;$hitbackto<count($arrbackto);$hitbackto++)  
  {
      if ($hitbackto <= 0)
      {
              $tsql = "UPDATE Tbl_F$arrbackto[$hitbackto]
                       set txn_action='I', txn_time=getdate(), txn_notes='Back By $userwfid Flow - $userid<BR>$backtonotes'
      				         WHERE txn_id='$custnomid'";
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
      else
      {
      	  if ($backtostatus == "SEQ")
      	  {
                $tsql = "DELETE FROM Tbl_F$arrbackto[$hitbackto]
      				           WHERE txn_id='$custnomid'";
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

      $tsql = "DELETE FROM Tbl_F$userwfid
      				 WHERE txn_id='$custnomid'";
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

      include("cr_approval_sign_reset.php");

header("location:../page/flow.php?userwfid=$userwfid&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd");

echo "FINISH";exit;

