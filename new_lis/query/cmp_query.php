<?
$cmpnomerid="";
$cmptarid="";
$cmpalikasinumber=""; 
$cmpaplikasidate="";
$cmpaocode="";
$cmpbranchcode="";
$cmplkcdnumber="";
$cmpprocessingcode="";
$cmpcurrencycode="";
$cmpplafond="";

///field dari data perorangan
//datapemohon
$cmpfullname="";
$cmpnickname="";
$cmpsex="";
$cmpKTPno="";
$cmpKTPexp="";
$cmpbdaydate="";
$cmpbdayplace="";
$cmpmothername="";
$cmpeducode="";
$cmpmarcode="";
$cmpsoulmate="";
$cmpjumlahanak="";





//filed perusahaan
//data pemohon
$cmpjabatan="";
$cmpNPWPno="";
$cmpnoakta="";
$cmptanggalakta="";


//KETERANGAN TEMPAT TINGGAL PEORANGAN
$cmptempattinggalsaatini="";
$cmprt="";
$cmprw="";
$cmpkelurahan="";
$cmpkecamatan="";
$cmpkota="";
$cmppropinsi="";
$cmptelepon="";
$cmphp="";
$cmpstatuskepemilikan="";
$cmplamamenenpati="";



//KETERANGAN TEMPAT TINGGAL BADAN USAHA
$cmpzipcode="";
$cmpn34="";


//KETERANGAN TEMPAT TINGGAL PERORANGAN SESUAI KTP 
$cmpalamatsesuaiktp="";
$cmprtktp="";
$cmprwktp="";
$cmpkelurahanktp="";
$cmpkecamatanktp="";
$cmpkotaktp="";
$cmppropinsiktp="";
$cmppropinsiktp="";


//INFORMASI USAHA
$cmpnamausaha="";
$cmpbidangusaha="";
$cmpalamatusaha="";
$cmpteleponusaha="";

$cmpfaxusaha="";
$cmphpusaha="";

$cmpnpwpusaha="";
$cmpsiupusaha="";
$cmptdpusaha="";
$cmplamausaha="";
$cmpn58="";

$cmpthn = 0;
$cmpbln = 0;
$cmptemp = 0;
///DATA MANAGEMEN & PEMEGANG SAHAM

$cmpjabatan1="";
$cmpnama1="";
$cmpsaham1="";
$cmplababergabung1="";
$cmpktp1="";
$cmpnpwp1="";
$cmpjabatan2="";
$cmpnama2="";
$cmpsaham2="";
$cmplamagabung2="";
$cmpktp2="";
$cmpnpwp2="";
$cmpjabatan3="";
$cmpname3="";
$cmpsaham3="";
$cmplamagabung3="";
$cmpktp3="";
$cmpnpwp3="";

$cmpn87="";
$cmpn88="";
$cmpn89="";
$cmpn90="";
$cmpn91="";
$cmpn92="";
$cmpn93="";
$cmpn94="";
$cmpn95="";
$cmpn96="";
$cmpn97="";
$cmpn98="";
$cmpkunjungan="";

///bisa di gunakan oleh badan usaha dan peorangan
$cmpstatuskredit="";
$cmptujuankredit1="";
$cmpjeniskredit1="";
$cmpplafond1="";
$cmpjangkawaktu1="";
$cmptujuankredit2="";
$cmpjeniskredit2="";
$cmpplafond2="";
$cmpjangkawaktu2="";


$cmpn68="";
				
$sql_cmp="select * from Tbl_CustomerMasterPerson2 where custnomid='$custnomid' ";
$cursortype_cmp = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_cmp = array(&$_POST['query']);
$sqlConn_cmp = sqlsrv_query($conn, $sql_cmp, $params_cmp, $cursortype_cmp);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_cmp))
	{
		$rowCount_cmp = sqlsrv_num_rows($sqlConn_cmp);
		while($row_cmp = sqlsrv_fetch_array( $sqlConn_cmp, SQLSRV_FETCH_ASSOC))
			{
				$cmpnomerid=$row_cmp['custnomid'];
				$cmptarid=$row_cmp['custtarid']; 
				$cmpalikasinumber=$row_cmp['custaplno']; 
				$cmpaplikasidate=$row_cmp['custapldate'];
				$cmpaocode=$row_cmp['custaocode']; //link ke tbl_ao
				$cmpbranchcode=$row_cmp['custbranchcode'];//link ke tbl_branch
				$cmplkcdnumber=$row_cmp['custlkcdno']; 
				$cmpprocessingcode=$row_cmp['custproccode'];//link ke tbl_processing
				$cmpcurrencycode=$row_cmp['custcurcode'];//link ke tbl_currency
				$cmpplafond=$row_cmp['custplafond'];//tidak di gunakan
				
				///field dari data perorangan
				//datapemohon
				$cmpfullname=$row_cmp['custfullname'];
				$cmpnickname=$row_cmp['custshortname']; 
				$cmpsex=$row_cmp['custsex'];//0 buat badan usaha, 1 dan 2 untuk perorangan 
				$cmpKTPno=$row_cmp['custktpno']; 
				$cmpKTPexp=$row_cmp['custktpexp'];
				$cmpbdaydate=$row_cmp['custboddate'];
				$cmpbdayplace=$row_cmp['custbodplace']; 
				$cmpmothername=$row_cmp['custmothername'];
				$cmpeducode=$row_cmp['custeducode'];
				$cmpmarcode=$row_cmp['custmarcode'];
				$cmpsoulmate=$row_cmp['custmarname'];
				$cmpjumlahanak=$row_cmp['custjmltanggungan'];
				
				
				
				
				
				//filed perusahaan
				//data pemohon
				$cmpjabatan=$row_cmp['custjabatancode'];
				$cmpNPWPno=$row_cmp['custnpwpno']; 
				$cmpnoakta=$row_cmp['custbusaktano']; 
				$cmptanggalakta=$row_cmp['custbusaktadate'];

				
				//KETERANGAN TEMPAT TINGGAL PEORANGAN
				$cmptempattinggalsaatini=$row_cmp['custaddr'];
				$cmprt=$row_cmp['custrt'];
				$cmprw=$row_cmp['custrw'];
				$cmpkelurahan=$row_cmp['custkel'];
				$cmpkecamatan=$row_cmp['custkec'];
				$cmpkota=$row_cmp['custcity'];
				$cmppropinsi=$row_cmp['custprop'];
				$cmptelepon=$row_cmp['custtelp'];
				$cmphp=$row_cmp['custhp'];
				$cmpstatuskepemilikan=$row_cmp['custhomestatus'];
				$cmplamamenenpati=$row_cmp['custhomeyearlong'];

				
				
				//KETERANGAN TEMPAT TINGGAL BADAN USAHA
				$cmpzipcode=$row_cmp['custzipcode'];
				$cmpn34=$row_cmp['custfax']; 
				
				
				//KETERANGAN TEMPAT TINGGAL PERORANGAN SESUAI KTP 
				$cmpalamatsesuaiktp=$row_cmp['custaddrktp'];
				$cmprtktp=$row_cmp['custrtktp'];
				$cmprwktp=$row_cmp['custrwktp'];
				$cmpkelurahanktp=$row_cmp['custkelktp'];
				$cmpkecamatanktp=$row_cmp['custkecktp'];
				$cmpkotaktp=$row_cmp['custcityktp'];//masi belom di gunakan
				$cmppropinsiktp=$row_cmp['custpropktp'];//masi belom di gunakan
				$cmppropinsiktp=$row_cmp['custzipcodektp'];//masi belom di gunakan
				
				
				//INFORMASI USAHA
				$cmpnamausaha=$row_cmp['custbusname'];
				$cmpbidangusaha=$row_cmp['custbustype'];
				$cmpalamatusaha=$row_cmp['custbusaddr'];
				$cmpteleponusaha=$row_cmp['custbustelp'];
				
				$cmpfaxusaha=$row_cmp['custbusfax']; 
				$cmphpusaha=$row_cmp['custbushp']; 
			
				$cmpnpwpusaha=$row_cmp['custbusnpwp']; 
				$cmpsiupusaha=$row_cmp['custbussiup']; 
				$cmptdpusaha=$row_cmp['custbustdp']; 
				$cmplamausaha=$row_cmp['custbusyearlong'];
				$cmpn58=$row_cmp['custbusmonthlong'];//belom digunakan
				
				$cmpthn = intval($cmplamausaha);
				$cmpbln = intval($cmpn58);
				$cmptemp = (($cmpthn*12) + $cmpbln);
				///DATA MANAGEMEN & PEMEGANG SAHAM
				
				$cmpjabatan1=$row_cmp['custowner1jabatancode'];
				$cmpnama1=$row_cmp['custowner1name'];
				$cmpsaham1=$row_cmp['custowner1saham'];
				$cmplababergabung1=$row_cmp['custowner1lamagabung'];
				$cmpktp1=$row_cmp['custowner1ktp']; 
				$cmpnpwp1=$row_cmp['custowner1npwp']; 
				$cmpjabatan2=$row_cmp['custowner2jabatancode'];
				$cmpnama2=$row_cmp['custowner2name'];
				$cmpsaham2=$row_cmp['custowner2saham'];
				$cmplamagabung2=$row_cmp['custowner2lamagabung'];
				$cmpktp2=$row_cmp['custowner2ktp']; 
				$cmpnpwp2=$row_cmp['custowner2npwp']; 
				$cmpjabatan3=$row_cmp['custowner3jabatancode'];
				$cmpname3=$row_cmp['custowner3name'];
				$cmpsaham3=$row_cmp['custowner3saham'];
				$cmplamagabung3=$row_cmp['custowner3lamagabung'];
				$cmpktp3=$row_cmp['custowner3ktp']; 
				$cmpnpwp3=$row_cmp['custowner3npwp']; 
				
				$cmpn87=$row_cmp['custnomobfacility'];//belom digunakan
				$cmpn88=$row_cmp['custnomomsetcode'];//belom digunakan
				$cmpn89=$row_cmp['custnomlamausahacode'];//belom di gunakan
				$cmpn90=$row_cmp['custnomplafondcode'];//belom di gunakan
				$cmpn91=$row_cmp['custnomcreditfu'];//belom digunakan
				$cmpn92=$row_cmp['custnomnotes'];//belom di gunakan
				$cmpn93=$row_cmp['custnomfrom'];//belom di gunakan
				$cmpn94=$row_cmp['custnomperkenalan'];
				$cmpn95=$row_cmp['custprostsusahacode'];//belom digunakan
				$cmpn96=$row_cmp['custprostskredit'];
				$cmpn97=$row_cmp['custprointerview'];
				$cmpn98=$row_cmp['custpropendapatan'];
				$cmpkunjungan=$row_cmp['custprodate'];
				
				///bisa di gunakan oleh badan usaha dan peorangan
				$cmpstatuskredit=$row_cmp['custcreditstatus'];
				$cmptujuankredit1=$row_cmp['custcreditneed1'];
				$cmpjeniskredit1=$row_cmp['custcredittype1'];
				$cmpplafond1=$row_cmp['custcreditplafond1'];
				$cmpjangkawaktu1=$row_cmp['custcreditlong1'];
				$cmptujuankredit2=$row_cmp['custcreditneed2'];
				$cmpjeniskredit2=$row_cmp['custcredittype2'];
				$cmpplafond2=$row_cmp['custcreditplafond2'];
				$cmpjangkawaktu2=$row_cmp['custcreditlong2'];
				
				
				$cmpn68=$row_cmp['custprointerviewnotes']; //masi belom di gunakan
				
				//$cmpn0=$row_cmp['custnomid'];
				//$cmpn1=$row_cmp['custtarid']; 
				//$cmpn2=$row_cmp['custaplno']; 
				//$cmpn3=$row_cmp['custapldate'];
				//$cmpn4=$row_cmp['custaocode']; 
				//$cmpn5=$row_cmp['custbranchcode'];
				//$cmpn6=$row_cmp['custlkcdno']; 
				//$cmpn7=$row_cmp['custproccode'];
				//$cmpn8=$row_cmp['custcurcode'];
				//$cmpn9=$row_cmp['custplafond'];
				//$cmpn10=$row_cmp['custfullname'];
				//$cmpn11=$row_cmp['custshortname']; 
				//$cmpn12=$row_cmp['custsex'];
				//$cmpn13=$row_cmp['custjabatancode'];
				//$cmpn14=$row_cmp['custktpno']; 
				//$cmpn15=$row_cmp['custktpexp'];
				//$cmpn16=$row_cmp['custboddate'];
				//$cmpn17=$row_cmp['custbodplace']; 
				//$cmpn18=$row_cmp['custnpwpno']; 
				//$cmpn19=$row_cmp['custmothername'];
				//$cmpn20=$row_cmp['custeducode'];
				//$cmpn21=$row_cmp['custmarcode'];
				//$cmpn22=$row_cmp['custmarname'];
				//$cmpn23=$row_cmp['custjmltanggungan'];
				//$cmpn24=$row_cmp['custaddr'];
				//$cmpn25=$row_cmp['custrt'];
				//$cmpn26=$row_cmp['custrw'];
				//$cmpn27=$row_cmp['custkel'];
				//$cmpn28=$row_cmp['custkec'];
				//$cmpn29=$row_cmp['custcity'];
				//$cmpn30=$row_cmp['custprop'];
				//$cmpn31=$row_cmp['custzipcode'];
				//$cmpn32=$row_cmp['custtelp'];
				//$cmpn33=$row_cmp['custhp'];
				//$cmpn34=$row_cmp['custfax']; 
				//$cmpn35=$row_cmp['custhomestatus'];
				//$cmpn36=$row_cmp['custhomeyearlong'];
				//$cmpn37=$row_cmp['custhomemonthlong'];
				//$cmpn38=$row_cmp['custaddrktp'];
				//$cmpn39=$row_cmp['custrtktp'];
				//$cmpn40=$row_cmp['custrwktp'];
				//$cmpn41=$row_cmp['custkelktp'];
				//$cmpn42=$row_cmp['custkecktp'];
				//$cmpn43=$row_cmp['custcityktp'];
				//$cmpn44=$row_cmp['custpropktp'];
				//$cmpn45=$row_cmp['custzipcodektp'];
				//$cmpn46=$row_cmp['custbustype'];
				//$cmpn47=$row_cmp['custbusname'];
				//$cmpn48=$row_cmp['custbusaddr'];
				//$cmpn49=$row_cmp['custbustelp'];
				//$cmpn50=$row_cmp['custbusfax']; 
				//$cmpn51=$row_cmp['custbushp']; 
				//$cmpn52=$row_cmp['custbusaktano']; 
				//$cmpn53=$row_cmp['custbusaktadate'];
				//$cmpn54=$row_cmp['custbusnpwp']; 
				//$cmpn55=$row_cmp['custbussiup']; 
				//$cmpn56=$row_cmp['custbustdp']; 
				//$cmpn57=$row_cmp['custbusyearlong'];
				//$cmpn58=$row_cmp['custbusmonthlong'];
				//$cmpn59=$row_cmp['custcreditstatus'];
				//$cmpn60=$row_cmp['custcreditneed1'];
				//$cmpn61=$row_cmp['custcredittype1'];
				//$cmpn62=$row_cmp['custcreditplafond1'];
				//$cmpn63=$row_cmp['custcreditlong1'];
				//$cmpn64=$row_cmp['custcreditneed2'];
				//$cmpn65=$row_cmp['custcredittype2'];
				//$cmpn66=$row_cmp['custcreditplafond2'];
				//$cmpn67=$row_cmp['custcreditlong2'];
				//$cmpn68=$row_cmp['custprointerviewnotes']; 
				//$cmpn69=$row_cmp['custowner1jabatancode'];
				//$cmpn70=$row_cmp['custowner1name'];
				//$cmpn71=$row_cmp['custowner1saham'];
				//$cmpn72=$row_cmp['custowner1lamagabung'];
				//$cmpn73=$row_cmp['custowner1ktp']; 
				//$cmpn74=$row_cmp['custowner1npwp']; 
				//$cmpn75=$row_cmp['custowner2jabatancode'];
				//$cmpn76=$row_cmp['custowner2name'];
				//$cmpn77=$row_cmp['custowner2saham'];
				//$cmpn78=$row_cmp['custowner2lamagabung'];
				//$cmpn79=$row_cmp['custowner2ktp']; 
				//$cmpn80=$row_cmp['custowner2npwp']; 
				//$cmpn81=$row_cmp['custowner3jabatancode'];
				//$cmpn82=$row_cmp['custowner3name'];
				//$cmpn83=$row_cmp['custowner3saham'];
				//$cmpn84=$row_cmp['custowner3lamagabung'];
				//$cmpn85=$row_cmp['custowner3ktp']; 
				//$cmpn86=$row_cmp['custowner3npwp']; 
				//$cmpn87=$row_cmp['custnomobfacility'];
				//$cmpn88=$row_cmp['custnomomsetcode'];
				//$cmpn89=$row_cmp['custnomlamausahacode'];
				//$cmpn90=$row_cmp['custnomplafondcode'];
				//$cmpn91=$row_cmp['custnomcreditfu'];
				//$cmpn92=$row_cmp['custnomnotes'];
				//$cmpn93=$row_cmp['custnomfrom'];
				//$cmpn94=$row_cmp['custnomperkenalan'];
				//$cmpn95=$row_cmp['custprostsusahacode'];
				//$cmpn96=$row_cmp['custprostskredit'];
				//$cmpn97=$row_cmp['custprointerview'];
				//$cmpn98=$row_cmp['custpropendapatan'];
				//$cmpn99=$row_cmp['custprodate'];
				
				
				
				
				
				
			}						
	}
sqlsrv_free_stmt( $sqlConn_cmp );

$totalplafon=0;
$totalplafon=$cmpplafond1+$cmpplafond2;
$namasex="";
if($cmpsex==1)
{
$namasex="Laki-Laki";
}
else if($cmpsex==2)
{
$namasex="Perempuan";
}

$statusperkawinan="";
if($cmpmarcode==0)
{
		$statusperkawinan="Belum Menikah";
		$cmpsoulmate="";
		$cmpjumlahanak="";	
}
else if($cmpmarcode==1)
{
		$statusperkawinan="Menikah";
		$cmpsoulmate;
		$cmpjumlahanak;	
}

				


$sql_Processing="select * from Tbl_Processing where proc_code='$cmpprocessingcode' ";
$cursortype_Processing = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_Processing = array(&$_POST['query']);
$sqlConn_Processing = sqlsrv_query($conn, $sql_Processing, $params_Processing, $cursortype_Processing);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_Processing))
	{
		$rowCount_Processing = sqlsrv_num_rows($sqlConn_Processing);
		while($row_Processing = sqlsrv_fetch_array( $sqlConn_Processing, SQLSRV_FETCH_ASSOC))
			{
			$processingname=$row_Processing['proc_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_Processing );



$sql_pendidikan="select * from TblPendidikan where edu_code='$cmpeducode' ";
$cursortype_pendidikan = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_pendidikan = array(&$_POST['query']);
$sqlConn_pendidikan = sqlsrv_query($conn, $sql_pendidikan, $params_pendidikan, $cursortype_pendidikan);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_pendidikan))
	{
		$rowCount_pendidikan = sqlsrv_num_rows($sqlConn_pendidikan);
		while($row_pendidikan = sqlsrv_fetch_array( $sqlConn_pendidikan, SQLSRV_FETCH_ASSOC))
			{
			$pendidikanname=$row_pendidikan['edu_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_pendidikan );


$sql_statusrumah="select * from TblStatusRumah where status_code='$cmpstatuskepemilikan' ";
$cursortype_statusrumah = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_statusrumah = array(&$_POST['query']);
$sqlConn_statusrumah = sqlsrv_query($conn, $sql_statusrumah, $params_statusrumah, $cursortype_statusrumah);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_statusrumah))
	{
		$rowCount_statusrumah = sqlsrv_num_rows($sqlConn_statusrumah);
		while($row_statusrumah = sqlsrv_fetch_array( $sqlConn_statusrumah, SQLSRV_FETCH_ASSOC))
			{
			$statusname=$row_statusrumah['status_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_statusrumah );


$sql_branch="select * from Tbl_Branch where branch_code='$cmpbranchcode' ";
$cursortype_branch = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_branch = array(&$_POST['query']);
$sqlConn_branch = sqlsrv_query($conn, $sql_branch, $params_branch, $cursortype_branch);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_branch))
	{
		$rowCount_branch = sqlsrv_num_rows($sqlConn_branch);
		while($row_branch = sqlsrv_fetch_array( $sqlConn_branch, SQLSRV_FETCH_ASSOC))
			{
			$branchname=$row_branch['branch_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_branch );

$sql_ao="select * from Tbl_AO where ao_code='$cmpaocode' ";
$cursortype_ao = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_ao = array(&$_POST['query']);
$sqlConn_ao = sqlsrv_query($conn, $sql_ao, $params_ao, $cursortype_ao);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_ao))
	{
		$rowCount_ao = sqlsrv_num_rows($sqlConn_ao);
		while($row_ao = sqlsrv_fetch_array( $sqlConn_ao, SQLSRV_FETCH_ASSOC))
			{
			$aoname=$row_ao['ao_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_ao );



$btname="";
$sql_ao1="select * from Tbl_BusinessType where btype_code='$cmpbidangusaha' ";
$cursortype_ao1 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_ao1= array(&$_POST['query']);
$sqlConn_ao1 = sqlsrv_query($conn, $sql_ao1, $params_ao1, $cursortype_ao1);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_ao1))
	{
		$rowCount_ao1 = sqlsrv_num_rows($sqlConn_ao1);
		while($row_ao1 = sqlsrv_fetch_array( $sqlConn_ao1, SQLSRV_FETCH_ASSOC))
			{
			$btname=$row_ao1['btype_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_ao1 );


$sql_ao2="select * from Tbl_CreditNeed where credit_need_code='$cmptujuankredit1' ";
$cursortype_ao2 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_ao2 = array(&$_POST['query']);
$sqlConn_ao2 = sqlsrv_query($conn, $sql_ao2, $params_ao2, $cursortype_ao2);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_ao2))
	{
		$rowCount_ao2 = sqlsrv_num_rows($sqlConn_ao2);
		while($row_ao2 = sqlsrv_fetch_array( $sqlConn_ao2, SQLSRV_FETCH_ASSOC))
			{
			$cnname1=$row_ao2['credit_need_name'];
			}						
	}
sqlsrv_free_stmt( $sqlConn_ao2 );


$onclik="return isNumberKey(event)";
$sql_ao3="select count(*) as b from Tbl_CreditNeed where credit_need_code='$cmptujuankredit2' ";
$cursortype_ao3 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$params_ao3 = array(&$_POST['query']);
$sqlConn_ao3 = sqlsrv_query($conn, $sql_ao3, $params_ao3, $cursortype_ao3);
if($conn==false){die(FormatErrors(sqlsrv_errors()));}
if(sqlsrv_has_rows($sqlConn_ao3))
	{
		$rowCount_ao3 = sqlsrv_num_rows($sqlConn_ao3);
		while($row_ao3 = sqlsrv_fetch_array( $sqlConn_ao3, SQLSRV_FETCH_ASSOC))
			{
			$row_ao3['b'];
			if($row_ao3['b']==0)
			{
			$cnname2="";
			$sukubunga="<input readonly='readonly' maxlength='3' onkeypress=".$onclik." value='0' style='text-align:right' type='text' name='bungan2' id='bungan2' />";
			$biayadmin="<input  readonly='readonly' maxlength='15' onkeypress=".$onclik." value='0' style=' text-align:right' type='text' name='adminn2' id='adminn2' />";
			$provisi="<input readonly='readonly' maxlength='3' onkeypress=".$onclik." value='0' style=' text-align:right' type='text' name='provisin2' id='provisin2' />";
			$kb="<input readonly='readonly' maxlength='15' onkeypress=".$onclik." value='0' style=' text-align:right' type='text' name='kbn2' id='kbn2' />";

			}
			else
			{
			$sql_ao4="select *  from Tbl_CreditNeed where credit_need_code='$cmptujuankredit2' ";
			$cursortype_ao4 = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
			$params_ao4 = array(&$_POST['query']);
			$sqlConn_ao4 = sqlsrv_query($conn, $sql_ao4, $params_ao4, $cursortype_ao4);
			if($conn==false){die(FormatErrors(sqlsrv_errors()));}
			if(sqlsrv_has_rows($sqlConn_ao4))
				{
					$rowCount_ao = sqlsrv_num_rows($sqlConn_ao4);
					while($row_ao4 = sqlsrv_fetch_array( $sqlConn_ao4, SQLSRV_FETCH_ASSOC))
						{
						
						$cnname2=$row_ao4['credit_need_name'];
						//$sbks="background-color:#FF0";
						$onbunga="outputMoney('bungan2')";
						$onbiayaadmin="outputMoney('adminn2')";
						$onpro="outputMoney('provisin2')";
						$onkb="outputMoney('kbn2')";
						
						$sukubunga="<input onkeyup=".$onbunga." maxlength='3' onkeypress=".$onclik." value='0' style='background-color:#FF0; text-align:right' type='text' name='bungan2' id='bungan2' />";
						$biayadmin="<input onkeyup=".$onbiayaadmin." maxlength='15' onkeypress=".$onclik." value='0' style='background-color:#FF0; text-align:right' type='text' name='adminn2' id='adminn2' />";
						$provisi="<input onkeyup=".$onpro." maxlength='3' onkeypress=".$onclik." value='0' style='background-color:#FF0; text-align:right' type='text' name='provisin2' id='provisin2' />";
						$kb="<input onkeyup=".$onkb." maxlength='15' onkeypress=".$onclik." value='0' style='background-color:#FF0; text-align:right' type='text' name='kbn2' id='kbn2' />";
						}						
				}
			sqlsrv_free_stmt( $sqlConn_ao4 );
			}
			}						
	}
sqlsrv_free_stmt( $sqlConn_ao3 );













?>