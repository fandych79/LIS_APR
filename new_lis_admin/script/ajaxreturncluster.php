	
<?php

$tmpbranchto='';
$strsql="
select ROW_NUMBER () OVER(ORDER BY b.wf_urut) as 'seq',
b.wf_name,b.wf_id,a.branchto from tbl_branchcluster a
join Tbl_Workflow b on a.flowcode = b.wf_id
where a.branch='".$newbranchid."'
and a.flag <>'2'
order by b.wf_urut";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_REQUEST['query']);
$sqlcon = sqlsrv_query($conn, $strsql, $params, $cursorType);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
//$rowCounter = sqlsrv_num_rows($sqlConn);
if(sqlsrv_has_rows($sqlcon))
{
	echo '<table align="center" border="0" style="width:900px;border:1px solid black;border-collapse:collapse;text-align:center;">';
	echo '<tr>';
		echo '<td style="width:50px;">No</td>';
		echo '<td style="width:350px;">Flow</td>';
		echo '<td style="width:350px;">Ke Cabang</td>';
		echo '<td style="width:150px;">Action</td>';
	echo '</tr>';
	while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		
		$tmpbranchto .=$rows['branchto'].',';
		echo '
			<tr>
				<td>'.$rows['seq'].'</td>
				<td>'.$rows['wf_id'].' - '.$rows['wf_name'].'</td>';
				echo '<td>';
					echo '<select id="branch'.$rows['wf_id'].'" name="branch'.$rows['wf_id'].'">';
					$strsqlbranch="select * from tbl_branch ";
					$cursorTypebranch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
					$paramsbranch = array(&$_REQUEST['query']);
					$sqlconbranch = sqlsrv_query($conn, $strsqlbranch, $paramsbranch, $cursorTypebranch);
					if ( $sqlconbranch === false)die( FormatErrors( sqlsrv_errors() ) );
					//$rowCounter = sqlsrv_num_rowsbranch($sqlconbranchn);
					if(sqlsrv_has_rows($sqlconbranch))
					{
						while($rowsbranch = sqlsrv_fetch_array($sqlconbranch, SQLSRV_FETCH_ASSOC))
						{
							
							if($rowsbranch['branch_code']==$rows['branchto'])
							{
								echo '<option selected="selected" value="'.$rowsbranch['branch_code'].'">'.$rowsbranch['branch_code'].' - '.$rowsbranch['branch_name'].'</option>';
							}
							else
							{
								echo '<option value="'.$rowsbranch['branch_code'].'">'.$rowsbranch['branch_code'].' - '.$rowsbranch['branch_name'].'</option>';
							}
						}
					}
				echo '</td>';
				echo '<td><input type="button" value="edit" onclick="edit(\''.$rows['wf_id'].'\');"/><input type="button" value="delete" onclick="del(\''.$rows['wf_id'].'\');"/></td>
			</tr>	
		';
	}
	
		echo '<tr>';
			echo '<td colspan="4" align="center">';
			echo '	<input type="text" id="tomaster" name="tomaster" value="'.substr($tmpbranchto,0,-1).'" />

					<input type="button" value="SUBMIT" onclick="submitdata();"/>';
			echo '</td>';
		echo '</tr>';
	echo '</table>';
}
?>