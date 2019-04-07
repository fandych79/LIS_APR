<?php
$_collateral_id="";
$_type_jaminan="";
$_lokasi_rumah="";
$_jumlah_lantai="";
$_luas_bangunan="";
$_panjang_bangunan="";
$_lebar_bangunan="";
$_arah_bangunan="";
$_umur_bangunan="";
$_tahun_dibangun="";
$_tahun_renovasi="";
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

$tsql = "select * from appraisal_tnb where _collateral_id = '".$col_id."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
        $_collateral_id=str_replace("\\","'",$row['_collateral_id']);
        $_type_jaminan=str_replace("\\","'",$row['_type_jaminan']);
        $_lokasi_rumah=str_replace("\\","'",$row['_lokasi_rumah']);
        $_jumlah_lantai=str_replace("\\","'",$row['_jumlah_lantai']);
        $_luas_bangunan=str_replace("\\","'",$row['_luas_bangunan']);
        $_panjang_bangunan=str_replace("\\","'",$row['_panjang_bangunan']);
        $_lebar_bangunan=str_replace("\\","'",$row['_lebar_bangunan']);
        $_arah_bangunan=str_replace("\\","'",$row['_arah_bangunan']);
        $_umur_bangunan=str_replace("\\","'",$row['_umur_bangunan']);
        $_tahun_dibangun=str_replace("\\","'",$row['_tahun_dibangun']);
        $_tahun_renovasi=str_replace("\\","'",$row['_tahun_renovasi']);
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

if ($_tahun_renovasi == "")
{
	 $_tahun_renovasi = "Tidak Ada";
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
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Type Jaminan</td>
                    <td><?=$_type_jaminan;?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>    
<hr>
<table border="0" style="border:0px solid black;width:100%;">
    <tr>
        <td valign="top" style="width:50%">
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Lokasi Rumah</td>
                    <td><?=$_lokasi_rumah;?></td>
                </tr>
                <tr>
                    <td>Jumlah Lantai</td>
                    <td><?=$_jumlah_lantai;?></td>
                </tr>
                <tr>
                    <td>Luas Tanah</td>
                    <td><?=$_luas_tanah;?> m2</td>
                </tr>
                <tr>
                    <td>Luas Bangunan</td>
                    <td><?=$_luas_bangunan;?> m2</td>
                </tr>
                <tr>
                    <td>Arah Bangunan</td>
                    <td><?=$_arah_bangunan?></td>
                </tr>
                <tr>
                    <td>Umur Bangunan</td>
                    <td><?=$_umur_bangunan;?> tahun</td>
                </tr>
                <tr>
                    <td>Tahun Dibangun</td>
                    <td><?=$_tahun_dibangun;?></td>
                </tr>
                <tr>
                    <td>Tahun Renovasi</td>
                    <td><?=$_tahun_renovasi;?></td>
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
                <tr>
                    <td>Latitude Lokasi</td>
                    <td><?=$_latitude;?></td>
                </tr>
                <tr>
                    <td>Longitude Lokasi</td>
                    <td><?=$_longitude;?></td>
                </tr>
<?
				if($_latitude!="" && $_longitude!="")
				{
?>
                <tr>
                    <td colspan="2">
						<div id="map" style="height: 200px; width: 100%;"></div>
						<script>
						  function initMap() {
							var uluru = {lat: <?php echo $_latitude?>, lng: <?php echo $_longitude?>};
							var map = new google.maps.Map(document.getElementById('map'), {
							  zoom: 17,
							  center: uluru
							});
							var infoWindow = new google.maps.InfoWindow;
							
							var name = "Alamat :";
							var address = "<?php echo $_lokasi_rumah;?>";
							var infowincontent = document.createElement('div');
							var strong = document.createElement('strong');
							strong.textContent = name
							infowincontent.appendChild(strong);
							infowincontent.appendChild(document.createElement('br'));

							var text = document.createElement('text');
							text.textContent = address
							infowincontent.appendChild(text);
							var marker = new google.maps.Marker({
							map: map,
							position: uluru
							});
							marker.addListener('click', function() {
							infoWindow.setContent(infowincontent);
							infoWindow.open(map, marker);
							});
						  }
						</script>
						<script async defer
						src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAzHLoAPUJUo2BNcxYSej42cVLf3WA9bQ&callback=initMap">
						</script>
					</td>
                </tr>
<?
				}
?>
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
