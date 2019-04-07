<?php

$newSQLSRV = new SQLSRV();
$newSQLSRV->connect();


$tsql = "select * from tbl_back_to";
$newSQLSRV->executeQuery($tsql);
$arrBackto = $newSQLSRV->lastResults;

echo "<pre>";
//print_r($arrBackto);
echo "</pre>";

require_once("parameter.php");
?>
<link href="../css/d.css" rel="stylesheet" type="text/css" />
<div class="unprint">
<form id="formback" name="formback" method="post" action="../../requirepage/do_back_to.php">
<select id="in_back" name="in_back" style="background-color:#FFFFFF;width:300px;">
<option value="">Back to...</option>
<?php
for($i=0;$i<count($arrBackto);$i++)
{
	$val = $arrBackto[$i]['back_code'];
	$show = $arrBackto[$i]['back_name'];
	echo "<option value=\"$val\">$show</option>";
}
?>
</select>
<br />
<textarea id="in_reason" name="in_reason" cols="50" rows="5" style="background-color:#FFFFFF;width:300px;"></textarea>
<br />
<input type="button" onclick="confirmBackto();" value="Back" style="width:300px;" class="buttonneg">
<?php
require("hiddenfield.php");
?>
</form>
<script>
function confirmBackto()
{
	var checkConfirm = window.confirm("Are you sure ?");
	
	if(checkConfirm == true)
	{
		document.formback.submit();
	}
}
</script>
</div>

