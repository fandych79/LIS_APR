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
		//////echo $c_ao;
		$c_per=$row_cmp['custnomperkenalan'];
		$c_plafond=$row_cmp['custplafond'];
		$c_proc_code=$row_cmp['custproccode'];
		//////echo $c_proc_code;
		$custfullname=$row_cmp['custfullname'];
		//echo $custfullname;
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
		$cp1=round($row_cmp['custcreditplafond1']);
		$cl1=$row_cmp['custcreditlong1'];
		$cn2=$row_cmp['custcreditneed2'];
		$ct2=$row_cmp['custcredittype2'];
		$cp2=round($row_cmp['custcreditplafond2']);
		$cl2=$row_cmp['custcreditlong2'];
			
		$bus1=$row_cmp['custowner1jabatancode']; 
		$bus2=$row_cmp['custowner1name'];
		$bus3=$row_cmp['custowner1saham']; 
		$bus4=$row_cmp['custowner1lamagabung']; 
		$bus5=$row_cmp['custowner1ktp'];
		$bus6=$row_cmp['custowner1npwp'];
		$bus7=$row_cmp['custowner2jabatancode']; 
		$bus8=$row_cmp['custowner2name'];
		$bus9=$row_cmp['custowner2saham']; 
		$bus10=$row_cmp['custowner2lamagabung']; 
		$bus11=$row_cmp['custowner2ktp'];
		$bus12=$row_cmp['custowner2npwp'];
		$bus13=$row_cmp['custowner3jabatancode']; 
		$bus14=$row_cmp['custowner3name'];
		$bus15=$row_cmp['custowner3saham']; 
		$bus16=$row_cmp['custowner3lamagabung']; 
		$bus17=$row_cmp['custowner3ktp'];
		$bus18=$row_cmp['custowner3npwp'];	
		

			
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
			//////echo $sql_proc;
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

	$sql_colland="Select * from Tbl_Col_Building where ap_lisregno='$c_nomid'";
$cursortype_colland = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_colland = array(&$_POST['query']);
$sqlConn_colland = sqlsrv_query($conn, $sql_colland, $params_colland, $cursortype_colland);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_colland))
	{
	$rowCount_colland = sqlsrv_num_rows($sqlConn_colland);
	while($row_colland = sqlsrv_fetch_array( $sqlConn_colland, SQLSRV_FETCH_ASSOC))
		{
		$colland0=$row_colland['ap_lisregno'];
		$colland1=$row_colland['col_id'];
		$colland2=$row_colland['col_addr1'];
		$colland3=$row_colland['col_addr2'];
		$colland4=$row_colland['col_addr3'];
		$colland5=$row_colland['col_type'];
		$colland6=$row_colland['col_imbno'];
		$colland7=$row_colland['col_imbdate'];
		$colland8=$row_colland['col_imbluas'];
		$colland9=$row_colland['col_njopyear'];
		$colland10=$row_colland['col_njopval'];
		$colland11=$row_colland['col_rangka'];
		$colland12=$row_colland['col_lantai'];
		$colland13=$row_colland['col_dinding'];
		$colland14=$row_colland['col_langit'];
		$colland15=$row_colland['col_rangkaatap'];
		$colland16=$row_colland['col_jmllantai'];
		$colland17=$row_colland['col_pembagianruang'];
		$colland18=$row_colland['col_dihunioleh'];
		$colland19=$row_colland['col_fasilitasbld'];
		$colland20=$row_colland['col_desc'];
		$colland21=$row_colland['col_pencapaian'];
		$colland22=$row_colland['col_jalan'];
		$colland23=$row_colland['col_lebarjalan'];
		$colland24=$row_colland['col_kondisijalan'];
		$colland25=$row_colland['col_arahjalan'];
		$colland26=$row_colland['col_intensitasjalan'];
		$colland27=$row_colland['col_fasilitasumum'];
		$colland28=$row_colland['col_fasilitasangkutan'];
		$colland29=$row_colland['col_objekpenting'];
		$colland20=$row_colland['col_peruntukanlingkungan'];
		}
	}sqlsrv_free_stmt( $sqlConn_colland );
	

	
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

			

$sql_anakeu="select * from Tbl_CustomerMasterAnalisaKeu where analisanomid='$c_nomid'";
$cursortype_anakeu = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_anakeu = array(&$_POST['query']);
$sqlConn_anakeu = sqlsrv_query($conn, $sql_anakeu, $params_anakeu, $cursortype_anakeu);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_anakeu))
	{
	$rowCount_anakeu = sqlsrv_num_rows($sqlConn_anakeu);
	while($row_anakeu = sqlsrv_fetch_array( $sqlConn_anakeu, SQLSRV_FETCH_ASSOC))
	{
	
		$ak0=$row_anakeu['analisanomid'];
		$ak1=$row_anakeu['analisadate'];
		$ak2=$row_anakeu['analisamutasidebet1'];
		$ak3=$row_anakeu['analisamutasikredit1'];
		$ak4=$row_anakeu['analisapenjualan1'];
		$ak5=$row_anakeu['analisamutasidebet2'];
		$ak6=$row_anakeu['analisamutasikredit2'];
		$ak7=$row_anakeu['analisapenjualan2'];
		$ak8=$row_anakeu['analisamutasidebet3'];
		$ak9=$row_anakeu['analisamutasikredit3'];
		$ak10=$row_anakeu['analisapenjualan3'];
		$ak11=$row_anakeu['analisaprofitabilitynotes1'];
		$ak12=$row_anakeu['analisaprofitabilitynotes2'];
		$ak13=$row_anakeu['analisaprofitabilitynotes3'];
		$ak14=$row_anakeu['analisaprofitabilitynotes4'];
		$ak15=$row_anakeu['analisaprofitabilitynotes5'];
		$ak16=$row_anakeu['analisaprofitabilitynotes6'];
		$ak17=$row_anakeu['analisaefficiencynotes1'];
		$ak18=$row_anakeu['analisaefficiencynotes2'];
		$ak19=$row_anakeu['analisaefficiencynotes3'];
		$ak20=$row_anakeu['analisaefficiencynotes4'];
		$ak21=$row_anakeu['analisaefficiencynotes5'];
		$ak22=$row_anakeu['analisaefficiencynotes6'];
		$ak23=$row_anakeu['analisalikuiditasnotes1'];
		$ak24=$row_anakeu['analisalikuiditasnotes2'];
		$ak25=$row_anakeu['analisalikuiditasnotes3'];
		$ak26=$row_anakeu['analisalikuiditasnotes4'];
		$ak27=$row_anakeu['analisalikuiditasnotes5'];
		$ak28=$row_anakeu['analisalikuiditasnotes6'];
	}	
	}
sqlsrv_free_stmt( $sqlConn_anakeu );	
	$totalmutasi=0;
	$totalmutasi=$ak2+$ak5+$ak8;
	$totalmutasiavg=0;
	$totalmutasiavg=round($totalmutasi/3);


	$totalkredit=0;
	$totalkredit=$ak3+$ak6+$ak9;
	$totalkreditavg=0;
	$totalkreditavg=round($totalkredit/3);
	
	$totalpenjualan=0;
	$totalpenjualan=$ak4+$ak7+$ak10;
	$totalpenjualanavg=0;
	$totalpenjualanavg=round($totalpenjualan/3);
	
	
	
	
	$sql_admin="Select * from Tbl_CustomerAdmin where adm_nom_id='$c_nomid'";
	$cursortype_admin = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params_admin = array(&$_POST['query']);
	$sqlConn_admin = sqlsrv_query($conn, $sql_admin, $params_admin, $cursortype_admin);
	if($conn==false){die(FormatErrors(sqlsrv_errors()));}
	if(sqlsrv_has_rows($sqlConn_admin))
		{
			$rowCount_admin = sqlsrv_num_rows($sqlConn_admin);
			while($row_admin = sqlsrv_fetch_array( $sqlConn_admin, SQLSRV_FETCH_ASSOC))
			
				{	$admin0=$row_admin['adm_nom_id'];
					$admin1=$row_admin['adm_no_pk'];
					$admin2=$row_admin['adm_tgl_pk'];
					$admin3=$row_admin['adm_tgl_approve'];
					$admin4=$row_admin['adm_angsuran'];
					$admin5=$row_admin['adm_jk_waktu'];
					$admin6=$row_admin['adm_account_saving'];
					$admin7=$row_admin['adm_owner_account_saving'];
					$admin8=$row_admin['adm_account_loan'];
					$admin9=$row_admin['adm_CIF'];
				}
		}sqlsrv_free_stmt( $sqlConn_admin );
	
	
	
	$sql_mkk="Select * from Tbl_CustomerMKK where mkknomid='$c_nomid'";
	$cursortype_mkk = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params_mkk = array(&$_POST['query']);
	$sqlConn_mkk = sqlsrv_query($conn, $sql_mkk, $params_mkk, $cursortype_mkk);
	if($conn==false){die(FormatErrors(sqlsrv_errors()));}
	if(sqlsrv_has_rows($sqlConn_mkk))
	{
	$rowCount_mkk = sqlsrv_num_rows($sqlConn_mkk);
	while($row_mkk = sqlsrv_fetch_array( $sqlConn_mkk, SQLSRV_FETCH_ASSOC))
		{
		$mkk1=$row_mkk['mkkdate'];
		$mkk2=$row_mkk['mkkexistingoutstanding1'];
		$mkk3=$row_mkk['mkkexistingbungaflag1'];
		$mkk4=$row_mkk['mkkexistingprovisi1'];
		$mkk5=$row_mkk['mkkexistingkewajibanbank1'];
		$mkk6=$row_mkk['mkkexistingangsuran1'];
		$mkk7=$row_mkk['mkkexistinglnparn1'];
		$mkk8=$row_mkk['mkkexistingjhrate1'];
		$mkk9=$row_mkk['mkkexistingvariancecode1'];
		$mkk10=$row_mkk['mkkexistingvariancerate1'];
		$mkk11=$row_mkk['mkkexistingoutstanding2'];
		$mkk12=$row_mkk['mkkexistingbungaflag2'];
		$mkk13=$row_mkk['mkkexistingprovisi2'];
		$mkk14=$row_mkk['mkkexistingkewajibanbank2'];
		$mkk15=$row_mkk['mkkexistingangsuran2'];
		$mkk16=$row_mkk['mkkexistinglnparn2'];
		$mkk17=$row_mkk['mkkexistingjhrate2'];
		$mkk18=$row_mkk['mkkexistingvariancecode2'];
		$mkk19=$row_mkk['mkkexistingvariancerate2'];
		$mkk20=$row_mkk['mkknewbungaflag1'];
		$mkk21=$row_mkk['mkknewadm1'];
		$mkk22=$row_mkk['mkknewprovisi1'];
		$mkk23=$row_mkk['mkknewkewajibanbank1'];
		$mkk24=$row_mkk['mkknewangsuran1'];
		$mkk25=$row_mkk['mkknewlnparn1'];
		$mkk26=$row_mkk['mkknewjhrate1'];
		$mkk27=$row_mkk['mkknewvariancecode1'];
		$mkk28=$row_mkk['mkknewvariancerate1'];
		$mkk29=$row_mkk['mkknewbungaflag2'];
		$mkk30=$row_mkk['mkknewadm2'];
		$mkk31=$row_mkk['mkknewprovisi2'];
		$mkk32=$row_mkk['mkknewkewajibanbank2'];
		$mkk33=$row_mkk['mkknewangsuran2'];
		$mkk34=$row_mkk['mkknewlnparn2'];
		$mkk35=$row_mkk['mkknewjhrate2'];
		$mkk36=$row_mkk['mkknewvariancecode2'];
		$mkk37=$row_mkk['mkknewvariancerate2'];
		}
	}sqlsrv_free_stmt( $sqlConn_mkk );
	
	$totalkewajibanbank=$mkk23+$mkk32;
	$totalcp=$cp1+$cp2;
	
	
	
$sql_cmtc="Select * from Tbl_CustomerMasterTradeCheck where tcnomid='$c_nomid'";
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

if($cmtc69=='0')
{
$flagcmtc69="BAIK";
$flagcmtc69;
}
else
{
$flagcmtc69="TIDAK";
$flagcmtc69;
}
		}
	}
sqlsrv_free_stmt( $sqlConn_cmtc );	

			
$sql_lmau="Select * from Tbl_CustomerMasterAspekUsaha where aspeknomid='$c_nomid'";
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
	if($lmau20=='0')
{
$flaglmau20="BAIK";
$flaglmau20;
}
else
{
$flaglmau20="TIDAK";
$flaglmau20;
}
if($lmau21=='0')
{
$flaglmau21="BAIK";
$flaglmau21;
}
else
{
$flaglmau21="TIDAK";
$flaglmau21;
}
if($lmau22=='0')
{
$flaglmau22="BAIK";
$flaglmau22;
}
else
{
$flaglmau22="TIDAK";
$flaglmau22;
}
$flaglmau23="";
if($lmau23=='0')
{
$flaglmau23="BAIK";
$flaglmau23;
}
else
{
$flaglmau23="TIDAK";
$flaglmau23;
}	
$sql_asd="Select * from tbl_CustomerMasterKeu where custnomid='$c_nomid'";
$cursortype_asd = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_asd = array(&$_POST['query']);
$sqlConn_asd = sqlsrv_query($conn, $sql_asd, $params_asd, $cursortype_asd);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_asd))
{
	$rowCount_asd = sqlsrv_num_rows($sqlConn_asd);
	while($row_asd = sqlsrv_fetch_array( $sqlConn_asd, SQLSRV_FETCH_ASSOC))
	{
	//$ushio0=$row_asd['customerid'];
	//neraca performa
	$ushio1=$row_asd['npkasbank'];//kas n bank 
	$ushio2=$row_asd['nppiutang'];//piutang usaha
	$ushio3=$row_asd['nppersediaan'];//persediaan
	$ushio4=$row_asd['nppiutanglain'];//hutang lain
	$ushio5=$row_asd['totaktivalancar'];//total aktiva lancar
	$ushio6=$row_asd['npaktivatetap'];//aktiva tetap
	$ushio7=$row_asd['npaktivalain'];//aktiva lain
	$ushio8=$row_asd['totaktivatetap'];//total aktiva tetap
	$ushio9=$row_asd['totalaktiva'];//total aktiva
	
	
	
	
	$ushio10=$row_asd['nphutangbank'];//s/t bank
	$ushio11=$row_asd['nphutangusaha'];//hutanhg usaha
	$ushio12=$row_asd['nphutangbiaya'];//hutang biaya
	$ushio13=$row_asd['nphutanglain'];//hutang lain
	$ushio14=$row_asd['totalhutanglancar'];//total kewajiban lancar
	$ushio15=$row_asd['nphutangjkpj'];// hutang jangka panjang
	$ushio16=$row_asd['totalhutang'];//total kewajiban
	$ushio17=$row_asd['npmodal'];// laba di tahan modal
	$ushio18=$row_asd['totalpasiva'];// total pasiva
	
	//rugi laba performa
	$ushio19=$row_asd['nppenjualan'];// penjualan
	$ushio20=$row_asd['nphpp'];//harga pokok penjualan
	$ushio21=$row_asd['totlabakotor'];//total laba kotor
	$ushio22=$row_asd['npbiaya'];//penjualan, administrasi dan umum
	$ushio23=$row_asd['npbiayalain'];//pendapatan / pengeluaran lain - lain
	$ushio24=$row_asd['totlababeforebunga'];//laba usaha seblum bunga dan pajak
	$ushio25=$row_asd['npbunga'];// bunga dan angsuran
	$ushio26=$row_asd['totlababeforetax']; //laba usaha sebelum pajak
	
	
	//$ushio27=$row_asd['asumsi_pembiayaan_modalkerja'];//plafon 1
	//$ushio28=$row_asd['asumsi_pembiayaan_investasi'];//plafon 2
	
	
	
	
	
	//asumsi proyek 
	$ushio29=$row_asd['asumsi_proyeksi_saleschange'];//sales change
	$ushio30=$row_asd['asumsi_proyeksi_cogs'];//cogs
	$ushio31=$row_asd['asumsi_proyeksi_sga'];//sga
	$ushio32=$row_asd['asumsi_proyeksi_bunga'];//bunga dan angsuran
	$ushio33=$row_asd['asumsi_proyeksi_cashsales'];//cash and saless
	$ushio34=$row_asd['asumsi_proyeksi_aktivatetap'];//aktiva tetap
	$ushio35=$row_asd['asumsi_proyeksi_aktivalain'];//aktiva lain2
	$ushio36=$row_asd['asumsi_proyeksi_ardoh'];//ar doh
	$ushio37=$row_asd['asumsi_proyeksi_invdoh'];//inv doh
	$ushio38=$row_asd['asumsi_proyeksi_apdoh'];//ap doh
	$ushio39=$row_asd['asumsi_proyeksi_aedoh'];//ae doh
	}
}
sqlsrv_free_stmt( $sqlConn_asd );



	//asumsi proyeksi pembiayaan
	$PMK_APP=round($cp1/1000000);
	$PI_APP=round($cp2/1000000);

	
	//kondisi historical
	$COGS_KH=round($ushio20/$ushio19*100);
	$SGA_KH=round($ushio22/$ushio19*100);
	$BNA_KH=$ushio25;
	$CorS_KH=round($ushio1/$ushio19*100);
	$ARDOH_KH=round($ushio2/$ushio19*365);
	$INVDOH_KH=round($ushio3/$ushio20*365);
	$APDOH_KH=round($ushio11/$ushio20*365);
	$AEDOH_KH=round($ushio13/$ushio20*365);

	
	///asumsi proyeksi
	$SC_AP=$ushio29;
	$COGS_AP=$ushio30;
	$SGA_AP=$ushio31;
	$BNA_AP=$ushio32;
	$CorS_AP=$ushio33;
	$AT_AP=$ushio34;
	$ALL_AP=$ushio35;
	$ARDOH_AP=$ushio36;
	$INVDOH_AP=$ushio37;
	$APDOH_AP=$ushio38;
	$AEDOH_AP=$ushio39;
	$SorT_AP=$ushio10;
	$LorT_AP=$ushio15+$PI_APP+$PMK_APP;
	if($SC_AP<51){ $SC_AP;}else{$SC_AP=0;  $SC_AP;}
	if($COGS_AP<100){ $COGS_AP;}else{$COGS_AP=0;  $COGS_AP;}
	if($SGA_AP<51){ $SGA_AP;}else{$SGA_AP=0;  $SGA_AP;}//
	if($ARDOH_AP<51){ $ARDOH_AP;}else{$ARDOH_AP=0;  $ARDOH_AP;}//
	if($INVDOH_AP<51){$INVDOH_AP;}else{$INVDOH_AP=0;  $INVDOH_AP;}//

	//Proyeksi - Rugi laba performa
	$PENJUALAN_PRLP=round((100+$SC_AP)/100*$ushio19);
	$HPP_PRLP=round($COGS_AP/100*$PENJUALAN_PRLP);
	$LK_PRLP=$PENJUALAN_PRLP-$HPP_PRLP;
	$PAnU_PRLP=round($SGA_AP/100*$PENJUALAN_PRLP);
	$LUSBP_PRLP=$LK_PRLP-$PAnU_PRLP;
	$BnA_PRLP=$BNA_AP;
	$LUSP_PRLP=$LUSBP_PRLP-$BnA_PRLP;
	//echo $PENJUALAN_PRLP."</br>";
	//echo $HPP_PRLP."</br>";
	//echo $LK_PRLP."</br>";
	//echo $PAnU_PRLP."</br>";
	//echo $LUSBP_PRLP."</br>";
	//echo $BnA_PRLP."</br>";
	//echo $LUSP_PRLP."</br>";
	
	
	
	//proyeksi - neraca proforma
	$KnB_PNP=round($CorS_AP/100*$PENJUALAN_PRLP);
	$PU_PNP=round($PENJUALAN_PRLP/365*$ARDOH_AP);
	$PERSEDIAN_PNP=round($HPP_PRLP/365*$INVDOH_AP);
	$PIUTANG_PNP=0;
	$TAL_PNP=$KnB_PNP+$PU_PNP+$PERSEDIAN_PNP;
	$AT_PNP=$AT_AP;
	$ALL_PNP=$ALL_AP;
	$TAT_PNP=$AT_PNP+$ALL_PNP;
	$TA_PNP=$TAL_PNP+$TAT_PNP;
	
	$SorT_PNP=$ushio10;
	$HT_PNP=round($HPP_PRLP/365*$APDOH_AP);
	$HLL_PNP=round($HPP_PRLP/365*$AEDOH_AP);
	$TKL_PNP=$SorT_PNP+$HT_PNP+$HLL_PNP;
	$HJP_PNP=$LorT_AP;
	$TK_PNP=$TKL_PNP+$HJP_PNP;
	$LDM_PNP=$TA_PNP-$TK_PNP;
	$TP_PNP=$TK_PNP+$LDM_PNP;
	
	
	//echo$KnB_PNP."</br>";
	//echo$PU_PNP."</br>";
	//echo$PERSEDIAN_PNP."</br>";
	//echo$PIUTANG_PNP."</br>";
	//echo$TAL_PNP."</br>";
	//echo$AT_PNP."</br>";
	//echo$ALL_PNP."</br>";
	//echo$TAT_PNP."</br>";
	//echo$TA_PNP."</br>";
	//echo$SorT_PNP."</br>";
	//echo$HT_PNP."</br>";
	//echo$HLL_PNP."</br>";
	//echo$TKL_PNP."</br>";
	//echo$HJP_PNP."</br>";
	//echo$TK_PNP."</br>";
	//echo$LDM_PNP."</br>";
	//echo$TP_PNP."</br>";
	
	///H PROFITABILITY
	$ROS_HP=round($ushio26/$ushio19*100);
	$NETSALES_HP=$ushio19;
	$COGS_HP=$COGS_KH;
	$SGA_HP=$SGA_KH;
	$EBITDA_HP=$ushio24;
	$NAPUI_HP=$ushio26;
	$NOPAT_HP=round($ushio34/$ushio24,1);
	
	//echo  $ROS_HP."</br>";
	//echo  $NETSALES_HP."</br>";
	//echo  $COGS_HP."</br>";
	//echo  $SGA_HP."</br>";
	//echo  $EBITDA_HP."</br>";
	//echo  $NAPUI_HP."</br>";
	//echo  $NOPAT_HP."</br>";

	//H EFFICIENCY
	$WI_HE=round(($ushio2+$ushio3)-($ushio11+$ushio12))-round(($ushio21/$ushio19)*$ushio2);
	$ARDOH_HE=$ARDOH_KH;
	$INVDOH_HE=$INVDOH_KH;
	$AEDOH_HE=$AEDOH_KH;
	
	//echo $WI_HE."</br>";
	//echo $ARDOH_HE."</br>";
	//echo $INVDOH_KH."</br>";
	//echo $AEDOH_HE."</br>";
	

	
	//H leverage
	$CR_HL=round($ushio5/$ushio14,2);
	$QR_HL=round(($ushio5-$ushio3)/$ushio14,2);
	$LEV_HL=round($ushio16/$ushio17,2);
	
	//echo $CR_HL."</br>";
	//echo $QR_HL."</br>";
	//echo $LEV_HL."</br>";
	

	//P PROFITABILITY
	$ROS_PP=round($LUSP_PRLP/$PENJUALAN_PRLP*100);
	$NET_SALES_PP=$PENJUALAN_PRLP;
	$SALES_CHG_PP=round(($PENJUALAN_PRLP/$ushio19*100)-100);
	$COGS_PP=round($HPP_PRLP/$PENJUALAN_PRLP*100);
	$SGA_PP=round($PAnU_PRLP/$PENJUALAN_PRLP*100);
	$EBITA_PP=$LUSBP_PRLP;
	$NPAUI_PP=$LUSP_PRLP;
	$NOPAT_PP=round($LUSBP_PRLP/$BnA_PRLP,1);
	
	//echo $ROS_PP."</br>";
	//echo $NET_SALES_PP."</br>";
	//echo $SALES_CHG_PP."</br>";
	//echo $COGS_PP."</br>";
	//echo $SGA_PP."</br>";
	//echo $EBITA_PP."</br>";
	//echo $NPAUI_PP."</br>";
	//echo $NOPAT_PP."</br>";
	
	//P EFFICIENCY
	$WI_PE=round(($PU_PNP+$PERSEDIAN_PNP-$HT_PNP-$HLL_PNP)-($LK_PRLP/$PENJUALAN_PRLP*$PU_PNP));
	$ARDOH_PE=round($PU_PNP/$PENJUALAN_PRLP*365);
	$INVDOH_PE=round($PERSEDIAN_PNP/$HPP_PRLP*365);
	$AEDOH_PE=round($HT_PNP/$HPP_PRLP*365);
	
	//echo $WI_PE."</br>";
	//echo $ARDOH_PE."</br>";
	//echo $INVDOH_PE."</br>";
	//echo $AEDOH_PE."</br>";
	
	
	
	//P LEVERAGE
	$CR_PL=round($TAL_PNP/$TKL_PNP,2);
	$QR_PL=round(($TAL_PNP-$PERSEDIAN_PNP)/$TKL_PNP,2);
	$LEV_PL=round($TK_PNP/$LDM_PNP,2);
	$dWI_PL=round($WI_PE-$WI_HE);
	$BANKFIN_PL=round($ushio10/$WI_HE*100);
	$TBF_PL=round(($PMK_APP+$ushio10)/$WI_PE*100);
	
	//echo $CR_PL."</br>";
	//echo $QR_PL."</br>";
	//echo $LEV_PL."</br>";
	//echo $dWI_PL."</br>";
	//echo $BANKFIN_PL."</br>";
	//echo $TBF_PL."</br>";
	
		?>