<?php
function FormatErrors( $errors )
{
    /* Display errors. */
    echo "Error information: <br/>";
	
    foreach ( $errors as $error )
    {
        echo "SQLSTATE: ".$error['SQLSTATE']."<br/>";
        echo "Code: ".$error['code']."<br/>";
        echo "Message: ".$error['message']."<br/>";
		//echo sqlsrv_query();
    }
}

function numberFormat($num)
{ 
	return preg_replace("/(?<=\d)(?=(\d{3})+(?!\d))/",",",$num); 
}

?>