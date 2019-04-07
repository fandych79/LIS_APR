<?php
//error_reporting("E_ERROR");
class DB_LIS
{
var $debug = true;
var $lastQuery;
var $lastResults;
var $tempRow;
var $conn;
var $connectionOptions;

var $userID = "user";
var $userPWD = "user";
var $server = "127.0.0.1";
var $dbName = "DB_APPRAISAL_PRODUKTIF";

	function connect()
	{
		$this->connectionOptions = array( "Database"=>$this->dbName, "UID"=>$this->userID, "PWD"=>$this->userPWD );
		
		$this->conn = sqlsrv_connect( $this->server, $this->connectionOptions);
		
		if( $this->conn === false )
		{
			echo "<font color=\"#FF0000\">Error Databases.</font><br />";
			die( $this->FormatErrors("Information", sqlsrv_errors() ));
		}
	}
	
	function executeNonQuery($paramQuery)
	{
		$this->lastQuery = $paramQuery;
		
		$tsql = $paramQuery;
		$params = array(&$_POST['query']);
		$stmt = sqlsrv_prepare( $this->conn, $tsql, $params);
		if( $stmt )
		{
		} 
		else
		{
			echo "<font color=\"#FF0000\">Error statement.</font><br />";
			die( $this->FormatErrors("Information", sqlsrv_errors() ));
		}
		
		if( sqlsrv_execute( $stmt))
		{
		}
		else
		{
			echo "<font color=\"#FF0000\"Error execute.</font><br />";
			die(  $this->FormatErrors("Information", sqlsrv_errors() ));
		}
		sqlsrv_free_stmt( $stmt);
	}
	
	function executeQuery($paramSelect)
	{
		$this->lastQuery = $paramSelect;
		
		$tsql = $paramSelect;
		$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
		$params = array(&$_POST['query']);
		
		$sqlConn = sqlsrv_query($this->conn, $tsql, $params, $cursorType);
		
		if ( $sqlConn === false)
		  die( $this->FormatErrors("Information", sqlsrv_errors() ) );
		
		if(sqlsrv_has_rows($sqlConn))
		{
			$rowCount = sqlsrv_num_rows($sqlConn);
			
			$this->lastResults = array();
			while ($row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
			{
				$this->lastResults[] = $row;
			}
	
		}
		sqlsrv_free_stmt( $sqlConn );
	}

			
	function FormatErrors($cap = "Information" ,$msg)
	{
		echo "<style>";
		echo "body";
		echo "{";
		echo "padding:0px;";
		echo "margin:0px;";
		echo "}";
		echo "</style>";
		echo "<div style=\"width:100%;background-color:#0099FF\"><h3><font style=\"color:#FFFFFF\">$cap</h3></font></div>";
		echo "<div><pre>";
		echo "QUERY: ".$this->lastQuery."<br/>";
		foreach ( $msg as $error )
		{
			echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
			echo "CODE: ".$error['code']."<br/>";
			echo "MESSAGE: ".$error['message']."<br/><br/>";
		}
		echo "</pre></div>";
	}




}
?>