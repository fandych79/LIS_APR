<?php

$_luas_tanah="";
$_panjang_tanah="";
$_lebar_tanah="";
$_sisi_utara="";
$_sisi_timur="";
$_sisi_selatan="";
$_sisi_barat="";
$_latitude="";
$_longitude="";
$_notes="";
$_opini="";
$_officer_code="";
$_tanggal_kunjungan="";

$tsql = "select * from appraisal_lnd where _collateral_id = '".$col_id."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
        $_luas_tanah=str_replace("\\","'",$row['_luas_tanah']);
        $_panjang_tanah=str_replace("\\","'",$row['_panjang_tanah']);
        $_lebar_tanah=str_replace("\\","'",$row['_lebar_tanah']);
        $_sisi_utara=str_replace("\\","'",$row['_sisi_utara']);
        $_sisi_timur=str_replace("\\","'",$row['_sisi_timur']);
        $_sisi_selatan=str_replace("\\","'",$row['_sisi_selatan']);
        $_sisi_barat=str_replace("\\","'",$row['_sisi_barat']);
        $_latitude=str_replace("\\","'",$row['_latitude']);
        $_longitude=str_replace("\\","'",$row['_longitude']);
        $_notes=str_replace("\\","'",$row['_notes']);
        $_opini=str_replace("\\","'",$row['_opini']);
        $_officer_code=str_replace("\\","'",$row['_officer_code']);
        $_tanggal_kunjungan=str_replace("\\","'",$row['_tanggal_kunjungan']);
    }
}

if ($_officer_code == "")
{
   $tsql = "select _cust_appraiser_id from appraisal_custmaster where _custnomid = '".$custnomid."'";
   $cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
   $params = array(&$_POST['query']);
   $sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
   $rowCount = sqlsrv_num_rows($sqlConn);
   if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
   if(sqlsrv_has_rows($sqlConn))
   {
      while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
      {
      	$_officer_code = str_replace("\\","'",$row['_cust_appraiser_id']);
      }
  }
}

//echo $_type_jaminan;

//appraisal_tnb
?>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                <td style="width:150px">Kode officer</td>
                <td><input  eriktype="text" class="erikrequire" type="text" name="_officer_code" id="_officer_code" maxlength="50" readonly=readonly value="<?=$_officer_code;?>"   erikmsg="Kode Officer"/>    </td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">
            &nbsp;
        </td>
    </tr>
</table>    
<hr>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Panjang Tanah</td>
                    <td><input type="text" name="_panjang_tanah" id="_panjang_tanah" maxlength="10" style="width:30%" value="<?=$_panjang_tanah;?>"  erikmsg="Panjang Tanah" /> m2</td>
                </tr>
                <tr>
                    <td>Lebar Tanah</td>
                    <td><input onkeypress="return isNumberKey(event);" type="text" name="_lebar_tanah" id="_lebar_tanah" maxlength="10" style="width:30%" value="<?=$_lebar_tanah;?>" erikmsg="Lebar Tanah"  /> m2</td>
                </tr>
                <tr>
                    <td>Latitude Lokasi</td>
                    <td><input type="text" name="_latitude" id="_latitude" maxlength="50" value="<?=$_latitude;?>"  erikmsg="Latitude" /></td>
                </tr>
                <tr>
                    <td>Longitude Lokasi</td>
                    <td><input type="text" name="_longitude" id="_longitude" maxlength="50" value="<?=$_longitude;?>"  erikmsg="Longitude" /></td>
                </tr>
				<tr>
                    <td>Tanggal Kunjungan</td>
                    <td><input class="erikrequire" readonly="readonly" onFocus="NewCssCal(this.id,'YYYYMMDD');" type="text" name="_tanggal_kunjungan" id="_tanggal_kunjungan" maxlength="50" value="<?=$_tanggal_kunjungan;?>"  erikmsg="Tanggal Kunjungan" /></td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Sisi Utara</td>
                    <td><input type="text" name="_sisi_utara" id="_sisi_utara" maxlength="50" value="<?=$_sisi_utara;?>"  erikmsg="Sisi Utara" /></td>
                </tr>
                <tr>
                    <td>Sisi Timur</td>
                    <td><input type="text" name="_sisi_timur" id="_sisi_timur" maxlength="50" value="<?=$_sisi_timur;?>"  erikmsg="Sisi Timur" /></td>
                </tr>
                <tr>
                    <td>Sisi Selatan</td>
                    <td><input type="text" name="_sisi_selatan" id="_sisi_selatan" maxlength="50" value="<?=$_sisi_selatan;?>"  erikmsg="Sisi Selatan" /></td>
                </tr>
                <tr>
                    <td>Sisi Barat</td>
                    <td><input type="text" name="_sisi_barat" id="_sisi_barat" maxlength="50" value="<?=$_sisi_barat;?>"  erikmsg="Sisi Barat" /></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td>
            <table style="width:100%;">
                <tr>
                    <td valign="top" style="width:150px">Notes</td>
                    <td><textarea type="text" name="_notes" id="_notes" maxlength="2147483647" rows="" cols="" erikmsg="Notes"><?=$_notes?></textarea></td>
                </tr>
                <tr>
                    <td valign="top" style="width:150px">Opini</td>
                    <td><textarea eriktype="textarea" class="erikrequire" type="text" name="_opini" id="_opini" maxlength="2147483647" rows="" cols="" erikmsg="Opini"><?=$_opini?></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
