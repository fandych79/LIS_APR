<?
	require ("../../lib/open_conAPPR.php");
	require ("../../lib/formatError.php");
	require ("../../requirepage/parameter.php");
	require ("../../requirepage/security.php");
    
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
    //echo $c;
    
    
$yearcurrent = date("Y");
//echo $yearcurrent;
?>
<html>
	<head>
		<title>APPRAISAL</title>
		<script type="text/javascript" src="../../js/datetimepicker_css.js"></script>
		<script type="text/javascript" src="../../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript" src="../../js/full_function.js" ></script>
		<script type="text/javascript" src="../../js/accounting.js" ></script>
		<link href="../../css/d.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
            $(document).ready(function() {
                $("ul.tabs a").click(function() {
                    $(".pane div").hide();
                    $($(this).attr("href")).show();
                });
                /*
                $("#frm input").each(function(){
                    alert($(this).attr("id")+  "  ====  " +$(this).attr("value"))
                })  
                $("#frm textarea").each(function(){
                    alert($(this).attr("id")+  "  ====  " +$(this).attr("value"))
                })
                */                
            })
            
            
            
            function check()
            {
                var myobj = {};
                nyangkut = "";
                $(".erikrequire").each(function(){
                    var name = $(this).attr('name');
                    var id = $(this).attr('id');
                    
                    grp="";
                    getlength="erikkosong";
                    if(name.slice(-2)=="[]")
                    {
                        grp = 'input[name="'+name+'"]:checked';                            
                        if(grp!=nyangkut)
                        {
                            getlength = grp;
                        }
                    }
                    else
                    {
                        getlength = id ;
                        grp = id ;
                    }
                    if(getlength!="erikkosong")
                    {
                        myobj[id] = getlength;
                    }
                    nyangkut = grp;
                });
                
                total =0;
                $.each(myobj, function(focussid, id) {
                    myval=0;
                    if(id.indexOf("input")==-1)
                    {
                        myval=$("#"+id).val().length;
                        idvalue=$("#"+id).val();
                        if(myval==0)
                        {
                            setTimeout(function() { $("#"+focussid).focus(); }, 10);
                            alert($("#"+focussid).attr("erikmsg")+ " harus di isi");
                            return false;
                        }
                        
                        if($("#"+id).attr("photoed")=="photoed")
                        {
                            //alert("ada photo");
                            
                            var ext = idvalue.substring(idvalue.lastIndexOf('.') + 1);
                            if(ext =="png" || ext=="jpg"){}
                            else
                            {
                                //alert("Extensi Upload Photo 1 salah");
                                setTimeout(function() { $("#"+focussid).focus(); }, 10);
                                alert("Extensi Upload " +$("#"+focussid).attr("erikmsg")+ " salah");
                                myval=0;
                                return false;
                            }
                        }
                        myval=$("#"+id).val().length;
                    }
                    else
                    {
                        myval=$(id).length;
                        if(myval==0)
                        {
                        setTimeout(function() { $("#"+focussid).focus(); }, 10);
                        alert($("#"+focussid).attr("erikmsg")+ " harus di isi");
                        return false;
                        }
                    }
                });
                
                
                $("[photoed]").each(function() {
                    var ext = $(this).val().substring($(this).val().lastIndexOf('.') + 1).toLowerCase();
                    if($(this).val().length>0)
                    {
                        //alert($(this).attr("erikmsg")+ "ada isi");
                        if(ext =="png" || ext=="jpg"){}
                        else
                        {
                            //alert("Extensi Upload Photo 1 salah");
                            setTimeout(function() { $(this).focus(); }, 10);
                            alert("Extensi Upload " +$(this).attr("erikmsg")+ " salah");
                            myval=0;
                            return false;
                        }
                    }
                  
                });
                
                
                if(myval!=0)
                {
                    submitform = window.confirm("Are you sure?")
                    if(submitform==true)
                    {
                        $("#frm").submit();
                    }
                }
            }
        </script>
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
                aaaaaaa
                {
                    background:FF00FF;
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
	<body>
        <form id="frm" method="post" action="eriksave.php" enctype="multipart/form-data">
            <table align="center" id="tblform" border="1" style ="width:1000px; border-color:black;border-collapse:collapse;">
                <tr>
                    <td style="padding:20px 15 20 15px">
                    <!---->
                        <h2>APPRAISAL</h2>
                        <hr>
                        
                            <?php
                                $cust_jeniscol="";
                                $url = "./apperik.php?custnomid=$custnomid&userwfid=$userwfid&userpermission=$userpermission&buttonaction=$buttonaction&userbranch=$userbranch&userregion=$userregion&userid=$userid&userpwd=$userpwd";
                                $tsql = "select *,
                                        case when cust_jeniscol='BA1' then 'Tanah dan Bangunan'
                                        when cust_jeniscol='RUK' then 'Ruko'
                                        when cust_jeniscol='KI2' then 'Kios'
                                        when cust_jeniscol='TAN' then 'Tanah'
                                        when cust_jeniscol='V01' then 'Kendaraan' else '' end 'jenis_col' from Tbl_Cust_MasterCol 
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
                            <?php
                            
                            
                            if($cust_jeniscol=="BA1" || $cust_jeniscol=="RUK" || $cust_jeniscol=="KI2")
                            {
                               require("eriktnb.php");
                            }
                             elseif($cust_jeniscol=="TAN")
                            {
                                require("eriklnd.php");
                            }
                            elseif($cust_jeniscol=="V01")
                            {
                                require("erikvhc.php");
                            }
                            else
                            {
                                echo "TIDAK ADA YANG DIAPPRASIAL";
                            }
                            if($cust_jeniscol=="BA1" || $cust_jeniscol=="RUK" || $cust_jeniscol=="KI2" || $cust_jeniscol=="TAN" || $cust_jeniscol=="V01" )
                            {
                               
                                            echo '<table border="1" style="border:0px solid black;width:100%;">
                                                        <tr>
                                                            <td colspan="2">
                                                                <table border="0" style="border:0px solid black;width:100%;">';
                                                                
                                            for($i=1;$i<=5;$i++)
                                            {            
                                                if($i==1)
                                                {
                                                    echo "<tr>";

                                                }
                                                
                                                $tsql = "select * from appraisal_photo where _collateral_id = '".$col_id."' and _id='".$i."'";
                                                //echo $tsql;
                                                $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                                $params = array(&$_POST['query']);
                                                $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
                                                $rowimage = sqlsrv_num_rows($sqlConn);
                                                
                                                if($rowimage!=0)
                                                {
                                                    echo "<td style=\"width:20%;text-align:center;\"><a href=\"download.php?col_id=".$col_id."&flag=".$i."\">Photo ".$i."</a></td>";
                                                }
                                                else
                                                {
                                                    echo "<td style=\"width:20%;text-align:center;\">Photo ".$i."</td>";
                                                }
                                                if($i==5)
                                                {

                                                    echo "</tr>";
                                                }
                                            }
                                              
                                            for($i=1;$i<=5;$i++)
                                            {
                                                if($i==1)
                                                {
                                                    echo "<tr>";

                                                }
                                                   
                                                
                                                $tdphoto="<td>&nbsp;</td>";
                                                $tsql = "select * from appraisal_photo where _collateral_id = '".$col_id."' and _id='".$i."'";
                                                
                                                $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                                $params = array(&$_POST['query']);
                                                $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
                                                $rowimage = sqlsrv_num_rows($sqlConn);
                                                
                                                if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
                                                if(sqlsrv_has_rows($sqlConn))
                                                {
                                                    
                                                    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
                                                    {
                                                        $_photo = $row['_collateral_photo'];
                                                        
                                                        
                                                        //echo $tdphoto;
                                                        if($_photo!="")
                                                        {
                                                            $src = 'data:image/png;base64,'.$_photo;
                                                            $photo="<img src=\"".$src."\" width=\"150px\" style=\"margin:10px;\"/>";
                                                            
                                                            $tdphoto="<td>".$photo."</td>";
                                                        }
                                                        
                                                        
                                                    }
                                                }
                                                echo $tdphoto;
                                                if($i==5)
                                                {

                                                    echo "</tr>";
                                                }
                                            }
                                            
                                            
                                            echo '
                                                             
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>';
											
											echo '<table border="1" style="border:0px solid black;width:100%;">
                                                        <tr>
                                                            <td colspan="2">
                                                                <table border="0" style="border:0px solid black;width:100%;">';
                                                                
                                            for($i=6;$i<=10;$i++)
                                            {            
                                                if($i==6)
                                                {
                                                    echo "<tr>";

                                                }
                                                
                                                $tsql = "select * from appraisal_photo where _collateral_id = '".$col_id."' and _id='".$i."'";
                                                //echo $tsql;
                                                $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                                $params = array(&$_POST['query']);
                                                $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
                                                $rowimage = sqlsrv_num_rows($sqlConn);
                                                
                                                if($rowimage!=0)
                                                {
                                                    echo "<td style=\"width:20%;text-align:center;\"><a href=\"download.php?col_id=".$col_id."&flag=".$i."\">Photo ".$i."</a></td>";
                                                }
                                                else
                                                {
                                                    echo "<td style=\"width:20%;text-align:center;\">Photo ".$i."</td>";
                                                }
                                                if($i==10)
                                                {

                                                    echo "</tr>";
                                                }
                                            }
                                              
                                            for($i=6;$i<=10;$i++)
                                            {
                                                if($i==6)
                                                {
                                                    echo "<tr>";

                                                }
                                                   
                                                
                                                $tdphoto="<td>&nbsp;</td>";
                                                $tsql = "select * from appraisal_photo where _collateral_id = '".$col_id."' and _id='".$i."'";
                                                
                                                $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
                                                $params = array(&$_POST['query']);
                                                $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
                                                $rowimage = sqlsrv_num_rows($sqlConn);
                                                
                                                if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
                                                if(sqlsrv_has_rows($sqlConn))
                                                {
                                                    
                                                    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
                                                    {
                                                        $_photo = $row['_collateral_photo'];
                                                        
                                                        
                                                        //echo $tdphoto;
                                                        if($_photo!="")
                                                        {
                                                            $src = 'data:image/png;base64,'.$_photo;
                                                            $photo="<img src=\"".$src."\" width=\"150px\" style=\"margin:10px;\"/>";
                                                            
                                                            $tdphoto="<td>".$photo."</td>";
                                                        }
                                                        
                                                        
                                                    }
                                                }
                                                echo $tdphoto;
                                                if($i==10)
                                                {

                                                    echo "</tr>";
                                                }
                                            }
                                            
                                            
                                            echo '
                                                             
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>';
                               
                            ?>
                            <hr>
                            
                            
                            <table border="0" style="border:0px solid black;width:100%;">
                                <tr>
                                    <td style="width:50%">
                                        <table style="width:100%;">
                                            <?
                                            for($i=1;$i<=5;$i++)
                                            {
                                                
                                                ?>
                                                <tr>
                                                    <td valign="ceter" style="width:150px">photo <?=$i?></td>
                                                    <td><input photoed="photoed" type="file" name="_photobefore<?=$i?>" id="_photobefore<?=$i?>" erikmsg ="photo <?=$i?>"></td>
                                                </tr>
                                                <?
                                            }
                                            
                                            ?>
                                        </table>
                                    </td>
                                    <td style="width:50%">
                                        <table border="0" style="width:100%;">
                                            <?
                                            for($i=6;$i<=10;$i++)
                                            {
                                                
                                                ?>
                                                <tr>
                                                    <td valign="ceter" style="width:150px">photo <?=$i?></td>
                                                    <td><input photoed="photoed" type="file" name="_photobefore<?=$i?>" id="_photobefore<?=$i?>" erikmsg ="photo <?=$i?>"></td>
                                                </tr>
                                                <?
                                            }
                                            
                                            ?>
                                            <tr>
                                                <td colspan="2">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">
                                        <Input style="width:125px;color:fff;background:#31B0D5;line-height:30px; text-align:center;cursor:pointer;" type="button" onclick="check();" value="Save Data"></div>
                                    </td>
                                </tr>
                            </table>
                            <?
                            }
                            ?>
                            
                        </div>
                    <!---->
                    </td>
                </tr>
            </table>
            <div align="center">
            
            <?
//                require ("../../requirepage/hiddenfield.php");
						if($userid != "")
						{
						require ("../../requirepage/btnview.php");
						require ("../../requirepage/hiddenfield.php");
						}
						require("../../requirepage/btnprint.php");
            ?>
            <input type="hidden" name="_collateral_id" id="_collateral_id" maxlength="50" value="<?=$col_id;?>"   />
            </div>
            
        </form>
	</body>
</html>