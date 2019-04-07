<?php
error_reporting("E_ERROR");
class SQLSRV 
{
var $debug;
var $lastCounts;
var $lastQuery;
var $lastResults;
var $tempRow;
var $conn;
var $connectionOptions;

var $userID = "user";
var $userPWD = "user";
var $server = "127.0.0.1,1433";
var $dbName = "DB_APPRAISAL_PRODUKTIF";

	function connect()
	{
		$this->connectionOptions = array( "Database"=>$this->dbName, "UID"=>$this->userID, "PWD"=>$this->userPWD );
		
		$this->conn = sqlsrv_connect( $this->server, $this->connectionOptions);
		
		if( $this->conn === false )
		{
			echo "<font color=\"#FF0000\">Error Databases.</font><br />";
			die( $this->FormatErrors( sqlsrv_errors() ));
		}
	}
	
	function executeNonQuery($paramQuery)
	{
		$tsql = $paramQuery;
		$params = array(&$_POST['query']);
		$stmt = sqlsrv_prepare( $this->conn, $tsql, $params);
		if( $stmt )
		{
		} 
		else
		{
			echo "<font color=\"#FF0000\">Error statement.</font><br />";
			die( $this->FormatErrors( sqlsrv_errors() ));
		}
		
		if( sqlsrv_execute( $stmt))
		{
		}
		else
		{
			echo "<font color=\"#FF0000\"Error execute.</font><br />";
			die(  $this->FormatErrors( sqlsrv_errors() ));
		}
		sqlsrv_free_stmt( $stmt);
		
		$this->lastQuery = $paramQuery;
	}
	
	function executeQuery($paramSelect)
	{
		$tsql = $paramSelect;
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_POST['query']);
		
		$sqlConn = sqlsrv_query($this->conn, $tsql, $params, $cursorType);
		
		if ( $sqlConn === false)
		  die( $this->FormatErrors( sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn))
		{
			$rowCount = sqlsrv_num_rows($sqlConn);
			$this->lastCounts = $rowCount;
			
			$this->lastResults = array();
			while ($row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_BOTH))
			{
				$this->lastResults[] = $row;
			}
	
		}
		else
		{
			$this->lastCounts = 0;
		}
		sqlsrv_free_stmt( $sqlConn );
		
		$this->lastQuery = $paramSelect;
	}

			
	function FormatErrors( $errors )
	{
		echo "<font color=\"#FF0000\">";
		echo "<br /><br />Error information: <br/>";
	
		foreach ( $errors as $error )
		{
			echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
			echo "Code: ".$error['code']."<br/>";
			echo "Message: ".$error['message']."<br/>";
		}
		
		echo "</font>";
		echo "<br /><br />";
	}




}
?>