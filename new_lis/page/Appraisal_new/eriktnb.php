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

require ("../../lib/open_conLIS.php");

$tsql = "SELECT * FROM tbl_COL_Land WHERE ap_lisregno = '".$custnomid."' AND col_id = '".$col_id."'";
$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params = array(&$_POST['query']);
$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
$rowCount = sqlsrv_num_rows($sqlConn);
if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
if(sqlsrv_has_rows($sqlConn))
{
    while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
    {
		if($_lokasi_rumah=="")
		{
			$_lokasi_rumah = str_replace("\\","'",$row['col_addr1']);
		}
		
		if($_luas_tanah=="")
		{
			$_luas_tanah = str_replace("\\","'",$row['col_certluas']);
		}
    }
}

if($cust_jeniscol == "BA1")
{
	$tsql = "SELECT * FROM tbl_COL_Building WHERE ap_lisregno = '".$custnomid."' AND col_id = '".$col_id."'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	$rowCount = sqlsrv_num_rows($sqlConn);
	if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlConn))
	{
		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
		{
			if($_luas_bangunan=="")
			{
				$_luas_bangunan = str_replace("\\","'",$row['col_imbluas']);
			}
		}
	}
}else if($cust_jeniscol == "RUK")
{
	$tsql = "SELECT * FROM tbl_COL_Ruko WHERE ap_lisregno = '".$custnomid."' AND col_id = '".$col_id."'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	$rowCount = sqlsrv_num_rows($sqlConn);
	if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlConn))
	{
		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
		{
			if($_luas_bangunan=="")
			{
				$_luas_bangunan = str_replace("\\","'",$row['col_certluas']);
			}
		}
	}
}else if($cust_jeniscol == "KI2")
{
	$tsql = "SELECT * FROM tbl_COL_Kios WHERE ap_lisregno = '".$custnomid."' AND col_id = '".$col_id."'";
	$cursorType = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params = array(&$_POST['query']);
	$sqlConn = sqlsrv_query($conn, $tsql, $params, $cursorType);
	$rowCount = sqlsrv_num_rows($sqlConn);
	if ( $sqlConn === false)die( FormatErrors( sqlsrv_errors() ) );
	if(sqlsrv_has_rows($sqlConn))
	{
		while( $row = sqlsrv_fetch_array( $sqlConn, SQLSRV_FETCH_ASSOC))
		{
			if($_luas_bangunan=="")
			{
				$_luas_bangunan = str_replace("\\","'",$row['col_certluas']);
			}
		}
	}
}

require ("../../lib/close_con.php");
require ("../../lib/open_conAPPR.php");

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
            <table style="width:100%;">
                <tr>
                    <td style="width:150px">Type Jaminan</td>
                    <td>
                        <input class="text" type="text" name="_type_jaminan" id="_type_jaminan" maxlength="50" value="<?=$_type_jaminan;?>" erikmsg="Type Jaminan"/>
                    </td>
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
                    <td style="width:150px" valign=top>Lokasi Rumah</td>
                    <td>
                    <textarea class="erikrequire" style="border:none;boorder-bottom:1px solid black;" type="text" name="_lokasi_rumah" id="_lokasi_rumah" rows="4" cols="30" erikmsg="Lokasi Rumah"><?=$_lokasi_rumah;?></textarea></td>
                </tr>
                <tr>
                    <td>Jumlah Lantai</td>
                    <td>
                    <input class="erikrequire" onkeypress="return isNumberKey(event);" type="text" name="_jumlah_lantai" id="_jumlah_lantai" maxlength="50" value="<?=$_jumlah_lantai;?>" erikmsg="Jumlah Lantai"  />
                    </td>
                </tr>
                <tr>
                    <td>Luas Tanah</td>
                    <td><input onkeypress="return isNumberKey(event);" class="erikrequire" type="text" name="_luas_tanah" id="_luas_tanah" maxlength="10" style="width:30%" value="<?=$_luas_tanah;?>" erikmsg="Luas Tanah"  /> m2</td>
                </tr>
                <tr>
                    <td>Luas Bangunan</td>
                    <td><input class="erikrequire" onkeypress="return isNumberKey(event);" type="text" name="_luas_bangunan" id="_luas_bangunan" maxlength="10" style="width:30%" value="<?=$_luas_bangunan;?>" erikmsg="Luas Bangunan"  /> m2</td>
                </tr>
                <tr>
                    <td>Arah Bangunan</td>
                    <td>
                        <input class="erikrequire" name="_arah_bangunan" id="_arah_bangunan" erikmsg="Arah Bangunan" value="<?=$_arah_bangunan?>">
                           
                    <!--<input type="text" name="_arah_bangunan" id="_arah_bangunan" maxlength="50" value="<?=$_arah_bangunan;?>" erikmsg="Arah Bangunan"  />-->
                    </td>
                </tr>
                <tr>
                    <td>Tahun Dibangun</td>
                    <td>
                    <select class="erikrequire" name="_tahun_dibangun" id="_tahun_dibangun" onchange="javascript:HitungUmurBangunan();" erikmsg="Tahun Dibangun">
                            <option value="">-- Pilih Tahun Dibangun --</option>
                            <?
                                for($x=$yearcurrent;$x>1960;$x--)
                                {
                                    $selected="";
                                    if($_tahun_dibangun==$x)
                                    {
                                        $selected = "selected=\"selected\"";
                                    }
                                    echo "<option ".$selected." value=\"".$x."\">".$x."</option>";
                                }

                            ?>
                        </select>
                    <!--<input onkeypress="return isNumberKey(event);" type="text" name="_tahun_dibangun" id="_tahun_dibangun" maxlength="50" value="<?=$_tahun_dibangun;?>"  erikmsg="Tahun Dibangun" />-->
                    </td>
                </tr>
				<?
				$def_year = date('Y');
				?>
				<script>
				function HitungUmurBangunan()
				{
					var def_year = <?=$def_year;?>;
					var tahun_dibangun = parseInt(document.getElementById('_tahun_dibangun').value);
					
					var umur_bangunan = def_year - tahun_dibangun;
					
					document.getElementById('_umur_bangunan').value = umur_bangunan;
				}
				</script>
                <tr>
                    <td>Umur Bangunan</td>
                    <td><input onkeypress="return isNumberKey(event);" class="erikrequire" type="text" name="_umur_bangunan" id="_umur_bangunan" maxlength="4" style="width:30%" value="<?=$_umur_bangunan;?>" erikmsg="Umur Bangunan"  /> tahun </td>
                </tr>
                <tr>
                    <td>Tahun Renovasi</td>
                    <td>
                    <select class="" name="_tahun_renovasi" id="_tahun_renovasi" erikmsg="Tahun Renovasi">
                        <option value="">-- Tidak ada --</option>
                        <?
                            for($x=$yearcurrent;$x>1960;$x--)
                            {
                                $selected="";
                                if($_tahun_renovasi==$x)
                                {
                                    $selected = "selected=\"selected\"";
                                }
                                echo "<option ".$selected." value=\"".$x."\">".$x."</option>";
                            }

                        ?>
                    </select>
                    
                    <!--<input onkeypress="return isNumberKey(event);" type="text" name="_tahun_renovasi" id="_tahun_renovasi" maxlength="50" value="<?=$_tahun_renovasi;?>"  erikmsg="Tahun Renovasi" />-->
                    </td>
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
                    <td>Sisi Utara</td>
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
                <tr>
                    <td>Latitude Lokasi</td>
                    <td><input type="text" name="_latitude" id="_latitude" maxlength="50" value="<?=$_latitude;?>"  erikmsg="Latitude" /></td>
                </tr>
                <tr>
                    <td>Longitude Lokasi</td>
                    <td><input type="text" name="_longitude" id="_longitude" maxlength="50" value="<?=$_longitude;?>"  erikmsg="Longitude" /></td>
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

