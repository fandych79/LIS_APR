<?php

  $act=$_POST['act'];

   $serverName = "(local)\SQLEXPRESS";
   $connectionOptions = array("Database"=>"db_lis_mega");

   $conn = sqlsrv_connect( $serverName, $connectionOptions);
   if( $conn === false )
   die( FormatErrors( sqlsrv_errors() ));

   $tsql = "INSERT INTO Tbl_AO values('A05','Budi Hartoyo',
   				  '074','08181111111','bhartoyo','2011-08-11 15:03:52.000',
   				  'FFFFF','Y')";

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

   sqlsrv_close( $conn);




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



?> 
