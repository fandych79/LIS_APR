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

//echo $_type_jaminan;

//appraisal_tnb

?>

<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Kode officer</td>
                    <td><?=$_officer_code;?></td>
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
                    <td><?=$_panjang_tanah;?> m2</td>
                </tr>
                <tr>
                    <td>Lebar Tanah</td>
                    <td><?=$_lebar_tanah;?> m2</td>
                </tr>
                <tr>
                    <td>Latitude Lokasi</td>
                    <td><?=$_latitude;?></td>
                </tr>
                <tr>
                    <td>Longitude Lokasi</td>
                    <td><?=$_longitude;?></td>
                </tr>
				<tr>
                    <td>Tanggal Kunjungan</td>
                    <td><?=$_tanggal_kunjungan;?></td>
                </tr>
            </table>
        </td>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Sisi Utara</td>
                    <td><?=$_sisi_utara;?></td>
                </tr>
                <tr>
                    <td>Sisi Timur</td>
                    <td><?=$_sisi_timur;?></td>
                </tr>
                <tr>
                    <td>Sisi Selatan</td>
                    <td><?=$_sisi_selatan;?></td>
                </tr>
                <tr>
                    <td>Sisi Barat</td>
                    <td><?=$_sisi_barat;?></td>
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
                    <td><?=nl2br($_notes);?></td>
                </tr>
                <tr>
                    <td valign="top" style="width:150px">Opini</td>
                    <td><?=nl2br($_opini);?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
