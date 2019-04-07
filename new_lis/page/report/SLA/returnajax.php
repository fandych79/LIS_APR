<?
require_once ("../../../lib/open_con.php");
require_once ("../../../lib/formatError.php");


$userid=$_REQUEST['userid'];
$userbranch=$_REQUEST['userbranch'];
$userregion=$_REQUEST['userregion'];

require("../../../requirepage/level.php");

//echo $querylevelcode;

$querylevelcode = str_replace("TXN_ID","b.TXN_ID",$querylevelcode);
$querylevelcode = str_replace("TXN_REGION_CODE","b.TXN_REGION_CODE",$querylevelcode);
$querylevelcode = str_replace("TXN_BRANCH_CODE","b.TXN_BRANCH_CODE",$querylevelcode);

$contentperpage=10;

$clickpage=1;
if(isset($_REQUEST['page']))
{
$clickpage=$_REQUEST['page'];
}


											$controltablecustomer = "";
											$controlfieldcif = "";
											$controlfieldnomid = "";
											$controlfieldtipedeb = "";
											$controlfieldnamatipedeb0 = "";
											$controlfieldnamatipedeb1 = "";
											$strsql2="  select CONTROL_CODE, CONTROL_VALUE FROM MS_WORKFLOW 
											            where SUBSTRING(CONTROL_CODE,1,6)='MASTER'";
                      $sqlcon2 = sqlsrv_query($conn, $strsql2);
                      if ( $sqlcon2 === false)die( FormatErrors( sqlsrv_errors() ) );
                      if(sqlsrv_has_rows($sqlcon2))
                      {
                         while($rows2 = sqlsrv_fetch_array($sqlcon2, SQLSRV_FETCH_NUMERIC))
                         {	
                         	 if ($rows2[0] == "MASTERCUSTOMER")
                         	 {
											        $controltablecustomer = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERCIF")
                         	 {
											        $controlfieldcif = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERNOMID")
                         	 {
											        $controlfieldnomid = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERTIPEDEB")
                         	 {
											        $controlfieldtipedeb = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERCUSTNAME0")
                         	 {
											        $controlfieldnamatipedeb0 = $rows2[1];
											     }
                         	 if ($rows2[0] == "MASTERCUSTNAME1")
                         	 {
											        $controlfieldnamatipedeb1 = $rows2[1];
											     }
                         }
                      }

$totalpage=0;
$strsql="
select  cast((COUNT(*)/".$contentperpage.") as int)+ (case when (COUNT(*)%".$contentperpage.")<>0 then 1 else 0 end) as 'totalpage', count(*) as 'ttlapp'
from $controltablecustomer a
join Tbl_FSTART b on a.$controlfieldnomid = b.txn_id
left join tbl_flow_status fs on a.$controlfieldnomid = fs.txn_id";
//where ".substr($querylevelcode,0,-4)."";
//echo $strsql;exit;
$sqlcon = sqlsrv_query($conn, $strsql);
if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlcon))
{
	if($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_ASSOC))
	{
		$totalpage=$rows['totalpage'];
		$ttlapp=$rows['ttlapp'];
	}
}

$startrow=($clickpage-1)*10;
if ($clickpage!="1")
{
$startrow+=1;
}
$endrow=$clickpage*10;




?>
<div style="text-align:center;">
	<div style="width:600px;border:0px solid black">
		<div>
			<div style="border:0px solid black; text-align:left; font-weight:bold;">Total Aplikasi adalah <?=$ttlapp?></div>
		</div>
	</div>
</div>
<div>&nbsp;</div>
<table align="center" border="1" style="width:600px; font-family:Tahoma, Arial, Verdana, sans-serif;" cellpadding="0">
	<tr  style="width:30%; background-color:#CCCCCC;">
		<td style="width:50px;">No.</td>
		<td style="width:100px;">Aplicatin ID</td>
		<td>Flow</td>
		<td style="width:30%">Nama Debitur</td>
		<td style="width:5%;">View</td>
	</tr>
	<?	

		$strsql="select * from (
				select ROW_NUMBER() OVER(ORDER BY $controlfieldnomid) 'idx',$controlfieldnomid,isnull(fs.txn_flow,'&nbsp;') as 'status',
				'name'= case when $controlfieldtipedeb='0' then $controlfieldnamatipedeb0 else $controlfieldnamatipedeb1 end,
				'link'= '<A style=\"text-decoration:none;\" target=\"baru\" HREF=\"reportsla_detail.php?custnomid='+custnomid+'\">View</a>'
				from $controltablecustomer a
				join Tbl_FSTART b on a.$controlfieldnomid = b.txn_id
				left join tbl_flow_status fs on a.$controlfieldnomid = fs.txn_id
				where ".substr($querylevelcode,0,-4)."
				)tblx WHERE idx >=".$startrow." AND idx <=".$endrow."
				";
		$strsql="select * from (
				select ROW_NUMBER() OVER(ORDER BY $controlfieldnomid) 'idx',$controlfieldnomid,isnull(fs.txn_flow,'&nbsp;') as 'status',
				'name'= case when $controlfieldtipedeb='0' then $controlfieldnamatipedeb0 else $controlfieldnamatipedeb1 end,
				'link'= '<A style=\"text-decoration:none;\" target=\"baru\" HREF=\"reportsla_detail.php?custnomid='+$controlfieldnomid+'\">View</a>'
				from $controltablecustomer a
				join Tbl_FSTART b on a.$controlfieldnomid = b.txn_id
				left join tbl_flow_status fs on a.$controlfieldnomid = fs.txn_id
				)tblx WHERE idx >=".$startrow." AND idx <=".$endrow."
				";
				//echo $strsql;exit;
		$sqlcon = sqlsrv_query($conn, $strsql);
		if ( $sqlcon === false)die( FormatErrors( sqlsrv_errors() ) );
		if(sqlsrv_has_rows($sqlcon))
		{
			while($rows = sqlsrv_fetch_array($sqlcon, SQLSRV_FETCH_NUMERIC))
			{
				echo "
				<tr>
					<td>".$rows[0]."</td>
					<td>".$rows[1]."</td>
					<td>".$rows[2]."</td>
					<td>".$rows[3]."</td>
					<td>".$rows[4]."</td>
				</tr>
				";
			}
		}
	?>
</table>
<div style="text-align:center;">
	<div style="width:100%;border:0px solid black">
		<div>&nbsp;</div>
		<div>
		<?
			for($i=0; $i<$totalpage; $i++)
			{
				$pagebutton =$i+1;
				echo ' <input class="button" id="'.$pagebutton.'" name="'.$pagebutton.'" type="button" value="'.$pagebutton.'" onclick="btnpage(this.id)">';
			}
		?>
		</div>
	</div>
</div>
