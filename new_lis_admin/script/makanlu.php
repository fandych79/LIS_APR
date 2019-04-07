<?
$sql_cmp="select * from Tbl_CustomerMasterPerson where custnomid='$txtid' ";
	$cursortype_cmp = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params_cmp = array(&$_POST['query']);
	$sqlConn_cmp = sqlsrv_query($conn, $sql_cmp, $params_cmp, $cursortype_cmp);
	if($conn==false){die(FormatErrors(sqlsrv_errors()));}
	if(sqlsrv_has_rows($sqlConn_cmp))
	{
		$rowCount_cmp = sqlsrv_num_rows($sqlConn_cmp);
		while($row_cmp = sqlsrv_fetch_array( $sqlConn_cmp, SQLSRV_FETCH_ASSOC))
		{
		$custnomperkenalan=$row_cmp['custnomperkenalan'];
		$c_nomid=$row_cmp['custnomid'];
		$c_branch=$row_cmp['custbranchcode'];
		$c_ao=$row_cmp['custaocode'];
		//echo $c_ao;
		$c_per=$row_cmp['custnomperkenalan'];
		$c_plafond=$row_cmp['custplafond'];
		$c_proc_code=$row_cmp['custproccode'];
		//ECHO $c_proc_code;
		$custfullname=$row_cmp['custfullname'];
		$nickname=$row_cmp['custshortname'];
		$gender=$row_cmp['custsex'];
		$ktpno=$row_cmp['custktpno'];
		$expktp=$row_cmp['custktpexp'];
		$bdate=$row_cmp['custboddate'];
		$bplace=$row_cmp['custbodplace'];
		$mothername=$row_cmp['custmothername'];
		$edu=$row_cmp['custeducode'];
		$marry=$row_cmp['custmarcode'];
		$marname=$row_cmp['custmarname'];
		$anak=$row_cmp['custjmltanggungan'];
		$add1=$row_cmp['custaddr'];
		$rt1=$row_cmp['custrt'];
		$rw1=$row_cmp['custrw'];
		$kel1=$row_cmp['custkel'];
		$kec1=$row_cmp['custkec'];
		$city1=$row_cmp['custcity'];
		$pro1=$row_cmp['custprop'];
		$zipcode1=$row_cmp['custzipcode'];
		$telp1=$row_cmp['custtelp'];
		$hp1=$row_cmp['custhp'];
		$hs=$row_cmp['custhomestatus'];
		$lv=$row_cmp['custhomeyearlong'];
		$add2=$row_cmp['custaddrktp'];
		$rt2=$row_cmp['custrtktp'];
		$rw2=$row_cmp['custrwktp'];
		$kel2=$row_cmp['custkelktp'];
		$kec2=$row_cmp['custkecktp'];
		$city2=$row_cmp['custcityktp'];
		$pro2=$row_cmp['custpropktp'];
		$zipcode2=$row_cmp['custzipcodektp'];
		$bt=$row_cmp['custbustype'];
		$bn=$row_cmp['custbusname'];
		$badd=$row_cmp['custbusaddr'];
		$btelp=$row_cmp['custbustelp'];
		$bnpwp=$row_cmp['custbusnpwp'];
		$bsiup=$row_cmp['custbussiup'];
		$btdp=$row_cmp['custbustdp'];
		$blong=$row_cmp['custbusyearlong'];
		$cs=$row_cmp['custcreditstatus'];
		$cn1=$row_cmp['custcreditneed1'];
		$ct1=$row_cmp['custcredittype1'];
		$cp1=$row_cmp['custcreditplafond1'];
		$cl1=$row_cmp['custcreditlong1'];
		$cn2=$row_cmp['custcreditneed2'];
		$ct2=$row_cmp['custcredittype2'];
		$cp2=$row_cmp['custcreditplafond2'];
		$cl2=$row_cmp['custcreditlong2'];
			
			$sql_ao="Select * from tbl_ao where ao_code='$c_ao'";
			$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_ao = array(&$_POST['query']);
			$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
			if($conn==false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_ao))
			{
				$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
				while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
				{
				$ao_name=$row_ao['ao_name'];
				}
			}
			sqlsrv_free_stmt( $sqlConn_ao );

			$sql_lkcd="select * from Tbl_CustomerMasterLKCD where lkcdnomid='$c_nomid'";
			$cursortype_lkcd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_lkcd = array(&$_POST['query']);
			$sqlConn_lkcd = sqlsrv_query($conn, $sql_lkcd, $params_lkcd, $cursortype_lkcd);
			if($conn==false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_lkcd))
			{
				$rowCount_lkcd = sqlsrv_num_rows($sqlConn_lkcd);
				while($row_lkcd = sqlsrv_fetch_array( $sqlConn_lkcd, SQLSRV_FETCH_ASSOC))
				{
				$lkcd_name=$row_lkcd['lkcddate'];
				}
			}
			sqlsrv_free_stmt( $sqlConn_lkcd );
		
		
			$sql_branch="Select * from tbl_branch where branch_code='$c_branch'";
			$cursortype_branch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_branch = array(&$_POST['query']);
			$sqlConn_branch = sqlsrv_query($conn, $sql_branch, $params_branch, $cursortype_branch);
			if($conn==false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_branch))
			{
				$rowCount_branch = sqlsrv_num_rows($sqlConn_branch);
				while($row_branch = sqlsrv_fetch_array( $sqlConn_branch, SQLSRV_FETCH_ASSOC))
				{
				$branch_name=$row_branch['branch_name'];
				}
			}
			sqlsrv_free_stmt( $sqlConn_branch );
		
		
			$sql_proc="select * from Tbl_Processing where proc_code='$c_proc_code'";
			//echo $sql_proc;
			$cursortype_proc = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_proc = array(&$_POST['query']);
			$sqlConn_proc = sqlsrv_query($conn, $sql_proc, $params_proc, $cursortype_proc);
			if($conn==false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_proc))
			{
				$rowCount_proc = sqlsrv_num_rows($sqlConn_proc);
				while($row_proc = sqlsrv_fetch_array( $sqlConn_proc, SQLSRV_FETCH_ASSOC))
				{
				$proc_name=$row_proc['proc_name'];
				}
			}
			sqlsrv_free_stmt( $sqlConn_proc );
		}						
	}
	sqlsrv_free_stmt( $sqlConn_cmp );

$sql_lkcd="select * from Tbl_CustomerMasterLKCD where lkcdnomid='$txtid'";
$cursortype_lkcd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_lkcd = array(&$_POST['query']);
$sqlConn_lkcd = sqlsrv_query($conn, $sql_lkcd, $params_lkcd, $cursortype_lkcd);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_lkcd))
	{
	$rowCount_lkcd = sqlsrv_num_rows($sqlConn_lkcd);
	while($row_lkcd = sqlsrv_fetch_array( $sqlConn_lkcd, SQLSRV_FETCH_ASSOC))
		{
			$lkcd0=$row_lkcd['lkcdnomid'];
			$lkcd1=$row_lkcd['lkcddate'];
			$lkcd2=$row_lkcd['lkcdskalapemasaran'];
			$lkcd3=$row_lkcd['lkcdbuyername'];
			$lkcd4=$row_lkcd['lkcdbuyerpaytermcode'];
			$lkcd5=$row_lkcd['lkcdbuyerpaydaylong']; 
			$lkcd6=$row_lkcd['lkcdsuppliername'];
			$lkcd7=$row_lkcd['lkcdsupplierpaytermcode'];
			$lkcd8=$row_lkcd['lkcdsupplierpaydaylong']; 
			$lkcd9=$row_lkcd['lkcdpendapatanusaha']; 
			$lkcd10=$row_lkcd['lkcdhpp']; 
			$lkcd11=$row_lkcd['lkcdbiayaadm']; 
			$lkcd12=$row_lkcd['lkcdpengeluaranlain']; 
			$lkcd13=$row_lkcd['lkcdpendapatanlain']; 
			$lkcd14=$row_lkcd['lkcdangsuranfasilitas']; 
			$lkcd15=$row_lkcd['lkcdfixedaset']; 
			$lkcd16=$row_lkcd['lkcdpersediaan']; 
			$lkcd17=$row_lkcd['lkcdpiutangusaha']; 
			$lkcd18=$row_lkcd['lkcdhutangusaha']; 
			$lkcd19=$row_lkcd['lkcdperpersediaandaylong']; 
			$lkcd20=$row_lkcd['lkcdinterview1'];
			$lkcd21=$row_lkcd['lkcdinterview2'];
			$lkcd22=$row_lkcd['lkcdinterview3'];
			$lkcd23=$row_lkcd['lkcdinterview4'];
			$lkcd24=$row_lkcd['lkcdinterview5'];
			$lkcd25=$row_lkcd['lkcdinterview6'];
			$lkcd26=$row_lkcd['lkcdinterview7'];
			$lkcd27=$row_lkcd['lkcdinterview8'];
			$lkcd28=$row_lkcd['lkcdinterview9'];
			$lkcd29=$row_lkcd['lkcdproduk'];
			$lkcd30=$row_lkcd['lkcdtempatusaha'];
		}
	}
sqlsrv_free_stmt( $sqlConn_lkcd );	

			


$sql_cmtc="Select * from Tbl_CustomerMasterTradeCheck";
$cursortype_cmtc = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_cmtc = array(&$_POST['query']);
$sqlConn_cmtc = sqlsrv_query($conn, $sql_cmtc, $params_cmtc, $cursortype_cmtc);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_cmtc))
	{
	$rowCount_cmtc = sqlsrv_num_rows($sqlConn_cmtc);
	while($row_cmtc = sqlsrv_fetch_array( $sqlConn_cmtc, SQLSRV_FETCH_ASSOC))
		{
			$cmtc0=$row_cmtc['tcnomid'];
			$cmtc1=$row_cmtc['tcdate'];
			$cmtc2=$row_cmtc['tcsupp1date'];
			$cmtc3=$row_cmtc['tcsupp1position'];
			$cmtc4=$row_cmtc['tcsupp1name'];
			$cmtc5=$row_cmtc['tcsupp1telp'];
			$cmtc6=$row_cmtc['tcsupp1addr'];
			$cmtc7=$row_cmtc['tcsupp1relationmonthlong'];
			$cmtc8=$row_cmtc['tcsupp1jenisbarang'];
			$cmtc9=$row_cmtc['tcsupp1penjualanpermonth'];
			$cmtc10=$row_cmtc['tcsupp1longpaycode'];
			$cmtc11=$row_cmtc['tcsupp1payhabbit'];
			$cmtc12=$row_cmtc['tcsupp1info'];
			$cmtc13=$row_cmtc['tcsupp1notes'];
			$cmtc14=$row_cmtc['tcsupp2date'];
			$cmtc15=$row_cmtc['tcsupp2position'];
			$cmtc16=$row_cmtc['tcsupp2name'];
			$cmtc17=$row_cmtc['tcsupp2telp'];
			$cmtc18=$row_cmtc['tcsupp2addr'];
			$cmtc19=$row_cmtc['tcsupp2relationmonthlong'];
			$cmtc20=$row_cmtc['tcsupp2jenisbarang'];
			$cmtc21=$row_cmtc['tcsupp2penjualanpermonth'];
			$cmtc22=$row_cmtc['tcsupp2longpaycode'];
			$cmtc23=$row_cmtc['tcsupp2payhabbit'];
			$cmtc24=$row_cmtc['tcsupp2info'];
			$cmtc25=$row_cmtc['tcsupp2notes'];
			$cmtc26=$row_cmtc['tcbuyer1date'];
			$cmtc27=$row_cmtc['tcbuyer1position'];
			$cmtc28=$row_cmtc['tcbuyer1name'];
			$cmtc29=$row_cmtc['tcbuyer1telp'];
			$cmtc30=$row_cmtc['tcbuyer1addr'];
			$cmtc31=$row_cmtc['tcbuyer1relationmonthlong'];
			$cmtc32=$row_cmtc['tcbuyer1jenisbarang'];
			$cmtc33=$row_cmtc['tcbuyer1pembelianpermonth'];
			$cmtc34=$row_cmtc['tcbuyer1longpaycode'];
			$cmtc35=$row_cmtc['tcbuyer1character'];
			$cmtc36=$row_cmtc['tcbuyer1info'];
			$cmtc37=$row_cmtc['tcbuyer1notes'];
			$cmtc38=$row_cmtc['tcbuyer2date'];
			$cmtc39=$row_cmtc['tcbuyer2position'];
			$cmtc40=$row_cmtc['tcbuyer2name'];
			$cmtc41=$row_cmtc['tcbuyer2telp'];
			$cmtc42=$row_cmtc['tcbuyer2addr'];
			$cmtc43=$row_cmtc['tcbuyer2relationmonthlong'];
			$cmtc44=$row_cmtc['tcbuyer2jenisbarang'];
			$cmtc45=$row_cmtc['tcbuyer2pembelianpermonth'];
			$cmtc46=$row_cmtc['tcbuyer2longpaycode'];
			$cmtc47=$row_cmtc['tcbuyer2character'];
			$cmtc48=$row_cmtc['tcbuyer2info'];
			$cmtc49=$row_cmtc['tcbuyer2notes'];
			$cmtc50=$row_cmtc['tcother1date'];
			$cmtc51=$row_cmtc['tcother1name'];
			$cmtc52=$row_cmtc['tcother1relationship'];
			$cmtc53=$row_cmtc['tcother1telp'];
			$cmtc54=$row_cmtc['tcother1addr'];
			$cmtc55=$row_cmtc['tcother1relationmonthlong'];
			$cmtc56=$row_cmtc['tcother1character'];
			$cmtc57=$row_cmtc['tcother1info'];
			$cmtc58=$row_cmtc['tcother1notes'];
			$cmtc59=$row_cmtc['tcother2date'];
			$cmtc60=$row_cmtc['tcother2name'];
			$cmtc61=$row_cmtc['tcother2relationship'];
			$cmtc62=$row_cmtc['tcother2telp'];
			$cmtc63=$row_cmtc['tcother2addr'];
			$cmtc64=$row_cmtc['tcother2relationmonthlong'];
			$cmtc65=$row_cmtc['tcother2character'];
			$cmtc66=$row_cmtc['tcother2info'];
			$cmtc67=$row_cmtc['tcother2notes'];
			$cmtc68=$row_cmtc['tcnotes'];
			$cmtc69=$row_cmtc['tcresume'];
		}
	}
sqlsrv_free_stmt( $sqlConn_cmtc );	
			
$sql_lmau="Select * from Tbl_CustomerMasterAspekUsaha";
$cursortype_lmau = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_lmau = array(&$_POST['query']);
$sqlConn_lmau = sqlsrv_query($conn, $sql_lmau, $params_lmau, $cursortype_lmau);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_lmau))
{
	$rowCount_lmau = sqlsrv_num_rows($sqlConn_lmau);
	while($row_lmau = sqlsrv_fetch_array( $sqlConn_lmau, SQLSRV_FETCH_ASSOC))
	{
		$lmau0=$row_lmau['aspeknomid'];
		$lmau1=$row_lmau['aspecdate'];
		$lmau2=$row_lmau['aspekmanajemennotes1'];
		$lmau3=$row_lmau['aspekmanajemennotes2'];
		$lmau4=$row_lmau['aspekmanajemennotes3'];
		$lmau5=$row_lmau['aspekmanajemennotes4'];
		$lmau6=$row_lmau['aspekmanajemennotes5'];
		$lmau7=$row_lmau['aspekmanajemennotes6'];
		$lmau8=$row_lmau['aspekproduksinotes1'];
		$lmau9=$row_lmau['aspekproduksinotes2'];
		$lmau10=$row_lmau['aspekproduksinotes3'];
		$lmau11=$row_lmau['aspekproduksinotes4'];
		$lmau12=$row_lmau['aspekproduksinotes5'];
		$lmau13=$row_lmau['aspekproduksinotes6'];
		$lmau14=$row_lmau['aspekperbankannotes1'];
		$lmau15=$row_lmau['aspekperbankannotes2'];
		$lmau16=$row_lmau['aspekperbankannotes3'];
		$lmau17=$row_lmau['aspekperbankannotes4'];
		$lmau18=$row_lmau['aspekperbankannotes5'];
		$lmau19=$row_lmau['aspekperbankannotes6'];
		$lmau20=$row_lmau['aspekresikosupplyrisk'];
		$lmau21=$row_lmau['aspekresikodemandrisk'];
		$lmau22=$row_lmau['aspekresikocompetitorrisk'];
		$lmau23=$row_lmau['aspekresikoother'];
		$lmau24=$row_lmau['aspekresikonotes'];
	}
}
sqlsrv_free_stmt( $sqlConn_lmau );
	
	
$sql_asd="Select * from tbl_CustomerMasterKeu where custnomid='$txtid'";
$cursortype_asd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_asd = array(&$_POST['query']);
$sqlConn_asd = sqlsrv_query($conn, $sql_asd, $params_asd, $cursortype_asd);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_asd))
{
	$rowCount_asd = sqlsrv_num_rows($sqlConn_asd);
	while($row_asd = sqlsrv_fetch_array( $sqlConn_asd, SQLSRV_FETCH_ASSOC))
	{
		$gl0=$row_asd['custnomid'];
		$gl1=$row_asd['npkasbank'];
		$gl2=$row_asd['nppiutang'];
		$gl3=$row_asd['nppersediaan'];
		$gl4=$row_asd['totaktivalancar'];
		$gl5=$row_asd['npaktivatetap'];
		$gl6=$row_asd['npaktivalain'];
		$gl7=$row_asd['totaktivatetap'];
		$gl8=$row_asd['totalaktiva'];
		$gl9=$row_asd['nphutangbank'];
		$gl10=$row_asd['nphutangusaha'];
		$gl11=$row_asd['nphutanglain'];
		$gl12=$row_asd['nphutangjkpj'];
		$gl13=$row_asd['totalhutang'];
		$gl14=$row_asd['npmodal'];
		$gl15=$row_asd['totalpasiva'];
		$gl16=$row_asd['nppenjualan'];
		$gl17=$row_asd['nphpp'];
		$gl18=$row_asd['totlabakotor'];
		$gl19=$row_asd['npbiaya'];
		$gl20=$row_asd['npbiayalain'];
		$gl21=$row_asd['totlababeforebunga'];
		$gl22=$row_asd['npbunga'];
		$gl23=$row_asd['totlababeforetax'];
	}
}
sqlsrv_free_stmt( $sqlConn_asd );
		
		
		
		
		
		
		
		
?>