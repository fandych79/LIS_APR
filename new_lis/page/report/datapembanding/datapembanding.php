<?
	require ("../../../lib/open_con.php");
	require ("../../../lib/formatError.php");
	require ("../../../requirepage/parameter.php");
	
	$col_id="";
    $tsql = "select top 1 *
            from Tbl_Cust_MasterCol 
            where ap_lisregno = '".$custnomid."' 
            and group_col = 'N' 
            and flaginsert = '1' 
            and flagdelete = '0'
            order by inserttime asc;
            
            ";
    $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $params = array(&$_POST['query']);
    $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
    $rowCount = sqlsrv_num_rows($sqlConn);
    
    if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
    if(sqlsrv_has_rows($sqlConn))
    {
        while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
        {
            
            $col_id=$row['col_id'];
        }
    }
    
    
    
    
    if(isset($_GET['col_id']))
    {
        $col_id=$_GET['col_id'];
    }
	
?>
<html>
	<head>
		<title>Appraisal</title>
		<link rel="stylesheet" href="../../../bin/css/css-bj.css" type="text/css" />
		<link rel="shortcut icon" href="../../../bin/img/favicon.png" type="image/x-icon">
		<link href="../../../bin/css/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
		<script src="../../../bin/css/SpryMenuBar.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../../bin/bootstrap/dist/js/jquery-1.11.3.js" ></script>
		<script type="text/javascript" src="../../../bin/bootstrap/dist/js/bootstrap.min.js" ></script>
		
		<script type="text/javascript" src="../../../bin/js/datatable.js"></script>
		<script type="text/javascript" src="../../../bin/js/bootstraptable.js"></script>
		<script type="text/javascript" src="../../../bin/js/bootstrap-datepicker.min.js"></script>
		
		<link href="../../../bin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../../../bin/bootstrap/dist/css/bootstrap-datepicker.min.css"></link>
		<link rel="stylesheet" href="../../../bin/bootstrap/dist/css/bootstrap-datepicker3.min.css"></link>
		
		<script language="javascript" type="text/javascript" src="../../../bin/javascript/niceforms.js"></script>
		<link href="../../../bin/css/table.css" rel="stylesheet" type="text/css" />
		<link href="../../../css/crw.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
			$(document).ready(function() {
				$('#example').DataTable();
			} );
		</script>
		
		<script>
			function funcDelete(id) {
				var r = confirm("Are you sure want to delete?");
				if (r == true) {
					window.location = "datapembanding_do.php?act=del&id=" +id + "&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>";
				}
			}
			function save()
			{
				document.frm.action = "./datapembanding_do.php?act=saveflow&custnomid=<?=$custnomid?>&userwfid=<?=$userwfid?>&userpermission=<?=$userpermission?>&buttonaction=<?=$buttonaction?>&userbranch=<?=$userbranch?>&userregion=<?=$userregion?>&userid=<?=$userid?>&userpwd=<?=$userpwd?>";
				document.frm.submit();
			}
		</script>
		<script type="text/javascript" src="../../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../../js/accounting.js" ></script>
		<script type="text/javascript" src="../../../js/my.js" ></script>
		<link href="../../../css/d.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
               #centeredmenu {
                   width:100%;
                   margin-top:10px;
                   border-bottom:4px solid #000;
                   display:inline-block;
                   position:relative;
                }
                #centeredmenu ul {
                   
                   float:left;
                   list-style:none;
                   margin:0;
                   padding:0;
                   text-align:left;
                }
                #centeredmenu ul li {
                   display:inline;
                   float:left;
                   list-style:none;
                   margin:0;
                   padding:0;
                   position:relative;
                }
                /*active inactive*/
                #centeredmenu ul li a {
                   display:inline-block;
                   margin:0 0 0 1px;
                   padding:3px 10px;
                   background:#ddd;
                   color:#000;
                   text-decoration:none;
                   line-height:1.3em;
                }
                /*active hover*/
                #centeredmenu ul li a:hover {
                   background:#31B0D5;
                   color:#fff;
                }
                /*active color*/
                #centeredmenu ul li a.active,
                #centeredmenu ul li a.active:hover {
                   color:#fff;
                   background:#369;/*active color*/
                   font-weight:bold;
                   
                }
                
                table tr td
                {
                    padding:3px;
                }
                
                table tr td input
                {
                    border:none;border-bottom:0px solid black;
                }
                
                table tr td textarea
                {
                    border:none;
                    border-bottom:0px solid black;
                    resize:none;
                    width:100%;
                    height:100px;
                }
                
                .erikbtnsubmit,.erikbtnsubmit a
                {
                   position:relative;
                   width:100px;
                   text-align:center;
                   line-height:30px;
                   background:#31B0D5;
                   text-decoration:none;
                   color:#fff;
                }
                
                .erikbtnsubmit a:hover
                {
                   background:#2F6FA7;
                   color:#fff;
                }
                /*
                .erikbtnsubmit a:active
                {
                   background:#204D74;
                   color:#fff;
                }
                */
                input,textarea,select,radio
                {
                    background:#fff;
                }
                .erikrequire
                {
                    background:#FF0;
                }
                .iconsave1
                { 
                   background:url(save1.png) bottom no-repeat; 
                   width:16px; 
                   height:16px;
                   display:inline-block;
                }
                .iconsave2
                { 
                   background:url(save2.png) bottom no-repeat; 
                   width:16px; 
                   height:16px;
                   display:inline-block;
                }
            </style>
	</head>
	<body style="margin:0;" class="preview2">
		<form id="frm" name="frm" method="post" >
			<div class="divcenter">
			
				<h2>DATA PEMBANDING</h2>
				<?php
						$cust_jeniscol="";
						$url = "./datapembanding.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd";
						$tsql = "select *,
								case when cust_jeniscol='BA1' then 'Tanah dan Bangunan'
								when cust_jeniscol='RUK' then 'Ruko'
								when cust_jeniscol='KI2' then 'Kios'
								when cust_jeniscol='TAN' then 'Tanah'
								when cust_jeniscol='V01' then 'Kendaraan' else 'Lainnya' end 'jenis_col' from Tbl_Cust_MasterCol 
								where ap_lisregno = '".$custnomid."' 
								and group_col = 'N' 
								and flaginsert = '1' 
								and flagdelete = '0'
								order by inserttime asc;
								
								";
						$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
						$params = array(&$_POST['query']);
						$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
						$rowCount = sqlsrv_num_rows($sqlConn);
						
						if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
						if(sqlsrv_has_rows($sqlConn))
						{
							?>
							<div id="centeredmenu">
							<ul>
							<?
							
							while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
							{
								
								$active='';
								$strsql="";
								$spaniconsave="";
								$cust_jeniscol1 = $row['cust_jeniscol'];
								
								if($col_id==$row['col_id'])
								{
									$active='class="active"';
									$cust_jeniscol = $row['cust_jeniscol'];
								}
								
								if($cust_jeniscol1=="BA1" || $cust_jeniscol1=="RUK" || $cust_jeniscol1=="KI2" )
								{
									$strsql="select  * from appraisal_tnb where _collateral_id='".$row['col_id']."'";
								}
								elseif($cust_jeniscol1=="TAN")
								{
									$strsql="select  * from appraisal_lnd where _collateral_id='".$row['col_id']."'";
								}
								elseif($cust_jeniscol1=="V01")
								{
									$strsql="select  * from appraisal_vhc where _collateral_id='".$row['col_id']."'";
								}
								   
								
								if($strsql!="")
								{
									$tsql1 = $strsql;
									$cursorType1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
									$params1 = array(&$_POST['query']);
									$sqlConn1 = sqlsrv_query($conn, $tsql1, $params1, $cursorType1);
									$rowCount1 = sqlsrv_num_rows($sqlConn1);
								
									if($rowCount1>0)
									{
										$spaniconsave="&nbsp;&nbsp;<span class=\"iconsave2\"></span>";
									}
								}
								
								if($col_id==$row['col_id'])
								{
									$active='class="active"';
									$cust_jeniscol = $row['cust_jeniscol'];
									if($rowCount1>0)
									{
										$spaniconsave="&nbsp;&nbsp;<span class=\"iconsave1\"></span>";
									}
								}
								?>
								<li><a <?=$active;?> href="<?=$url."&col_id=".$row['col_id'];?>"><?=$row['jenis_col'].$spaniconsave?></a></li>
								<?
							}
							?>
							</ul>
							</div>
					<?
						}
					?>
					<div>
						<hr>
						 <? require("detail.php");?>
					</div>
			</div>
				<?
					require ("../../../requirepage/hiddenfield.php");
				?>
		</form>
	</body>
</html>