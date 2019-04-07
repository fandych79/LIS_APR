<?
$tab = $_POST['tab'];


if($tab == "tab")
{
	$custnomid = $_POST['txtcustnomid'];
	$fullname = $_POST['txtcustfullname'];
	$jmllnd = $_POST['jmllnd'];
	$jmlbld = $_POST['jmlbld'];
	$jmlvhc = $_POST['jmlvhc'];

	Header("Location:aprdbentry.php?Texcustnomid=$custnomid&lnd=$jmllnd&bld=$jmlbld&vhc=$jmlvhc&tab=$tab");
}
else if($tab == "approve")
{	
	require ("../../lib/open_con.php");
	$custnomid = $_POST['custnomid'];
	//update flag dari R ke D
	$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'D' WHERE custnomid = '$custnomid' and custflagapr = 'R'";
	$a = sqlsrv_query($conn, $tsql);
	
	require ("../../lib/close_con.php");

}
else if($tab == "insert")
{
	$custnomid=$_POST['custnomid'];
	$countlnd=$_POST['countlnd'];
	$countbld=$_POST['countbld'];
	$countvhc=$_POST['countvhc'];	
	
	require ("../../lib/open_con.php");
	
	if ($countlnd > 0)
	{
		for ($i=1;$i<=$countlnd;$i++)
		{
			$lndap_lisregno = $_POST["lndap_lisregno$i"];
			$lndcol_id = $_POST["lndcol_id$i"];
			$lndcol_addr1 = $_POST["lndcol_addr1$i"];
			$lndcol_addr2 = $_POST["lndcol_addr2$i"];
			$lndcol_addr3 = $_POST["lndcol_addr3$i"];
			$lndcol_kodepos = $_POST["lndcol_kodepos$i"];
			$lndcol_certtype = $_POST["lndcol_certtype$i"];
			$lndcol_certno = $_POST["lndcol_certno$i"];
			$lndcol_certatasnama = $_POST["lndcol_certatasnama$i"];
			$lndcol_luastanah = $_POST["lndcol_luastanah$i"];
			$lndcol_certdate = $_POST["lndcol_certdate$i"];
			$lndcol_certdue = $_POST["lndcol_certdue$i"];
			$lndcol_relcode = $_POST["lndcol_relcode$i"];
			$lndcol_haktanggungan = $_POST["lndcol_haktanggungan$i"];
			$lndcol_haktanggungantgl = $_POST["lndcol_haktanggungantgl$i"];
			$lndcol_identification = $_POST["lndcol_identification$i"];
			$lndcol_njopyear = $_POST["lndcol_njopyear$i"];
			$lndcol_njopval = $_POST["lndcol_njopval$i"];
			$lndcol_remark = $_POST["lndcol_remark$i"];
		
			$tsql = "INSERT INTO tbl_COL_Land (ap_lisregno, col_id, col_addr1, col_addr2, col_addr3, 
					col_kodepos, col_certtype, col_certno, col_certatasnama, col_certluas, col_certdate, col_certdue, col_relcode, col_haktanggungan, 
					col_haktanggungantgl, col_identification, col_njopyear, col_njopval, col_remark)
					VALUES('$lndap_lisregno','$lndcol_id','$lndcol_addr1','$lndcol_addr2','$lndcol_addr3',
					'$lndcol_kodepos','$lndcol_certtype','$lndcol_certno','$lndcol_certatasnama','$lndcol_luastanah','$lndcol_certdate','$lndcol_certdue','$lndcol_relcode','$lndcol_haktanggungan',
					'$lndcol_haktanggungantgl','$lndcol_identification','$lndcol_njopyear','$lndcol_njopval','$lndcol_remark')";
			         $params = array(&$_POST['query']);

			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			 }

			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
			   die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);
			 
			$ysql = "INSERT INTO Tbl_Cust_MasterCol VALUES('$custnomid','TAN')";
			$y = sqlsrv_query($conn, $ysql);
			
			//update flag dari N ke R
			$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'R' WHERE custnomid = '$custnomid' and custflagapr = 'N'";
			$a = sqlsrv_query($conn, $tsql);
			
		}
	}
	
	if ($countbld > 0)
	{
		for ($i=1;$i<=$countbld;$i++)
		{
			$lndap_lisregno = $_POST["lndbldap_lisregno$i"];
			$lndcol_id = $_POST["lndbldcol_id$i"];
			$lndcol_addr1 = $_POST["lndbldcol_addr1$i"];
			$lndcol_addr2 = $_POST["lndbldcol_addr2$i"];
			$lndcol_addr3 = $_POST["lndbldcol_addr3$i"];
			$lndcol_kodepos = $_POST["lndbldcol_kodepos$i"];
			$lndcol_certtype = $_POST["lndbldcol_certtype$i"];
			$lndcol_certno = $_POST["lndbldcol_certno$i"];
			$lndcol_certatasnama = $_POST["lndbldcol_certatasnama$i"];
			$lndcol_luastanah = $_POST["lndbldcol_luastanah$i"];
			$lndcol_certdate = $_POST["lndbldcol_certdate$i"];
			$lndcol_certdue = $_POST["lndbldcol_certdue$i"];
			$lndcol_relcode = $_POST["lndbldcol_relcode$i"];
			$lndcol_haktanggungan = $_POST["lndbldcol_haktanggungan$i"];
			$lndcol_haktanggungantgl = $_POST["lndbldcol_haktanggungantgl$i"];
			$lndcol_identification = $_POST["lndbldcol_identification$i"];
			$lndcol_njopyear = $_POST["lndbldcol_njopyear$i"];
			$lndcol_njopval = $_POST["lndbldcol_njopval$i"];
			$lndcol_remark = $_POST["lndbldcol_remark$i"];
			
			$bldap_lisregno = $_POST["bldap_lisregno$i"];
			$bldcol_id = $_POST["bldcol_id$i"];
			$bldcol_addr1 = $_POST["bldcol_addr1$i"];
			$bldcol_addr2 = $_POST["bldcol_addr2$i"];
			$bldcol_addr3 = $_POST["bldcol_addr3$i"];
			$bldcol_kodepos = $_POST["bldcol_kodepos$i"];
			$bldcol_type = $_POST["bldcol_type$i"];
			$bldcol_imbno = $_POST["bldcol_imbno$i"];
			$bldcol_imbdate = $_POST["bldcol_imbdate$i"];
			$bldcol_imbluas = $_POST["bldcol_imbluas$i"];
			$bldcol_njopyear = $_POST["bldcol_njopyear$i"];
			$bldcol_njopval = $_POST["bldcol_njopval$i"];
			
			$tsql = "INSERT INTO tbl_COL_Land (ap_lisregno, col_id, col_addr1, col_addr2, col_addr3, 
					col_kodepos, col_certtype, col_certno, col_certatasnama, col_certluas, col_certdate, col_certdue, col_relcode, col_haktanggungan, 
					col_haktanggungantgl, col_identification, col_njopyear, col_njopval, col_remark)
					VALUES('$lndap_lisregno','$lndcol_id','$lndcol_addr1','$lndcol_addr2','$lndcol_addr3',
					'$lndcol_kodepos','$lndcol_certtype','$lndcol_certno','$lndcol_certatasnama','$lndcol_luastanah','$lndcol_certdate','$lndcol_certdue','$lndcol_relcode','$lndcol_haktanggungan',
					'$lndcol_haktanggungantgl','$lndcol_identification','$lndcol_njopyear','$lndcol_njopval','$lndcol_remark')
					
					INSERT INTO tbl_COL_Building (ap_lisregno, col_id, col_addr1, col_addr2, col_addr3, col_kodepos, 
					col_type, col_imbno, col_imbdate, col_imbluas, col_njopyear, col_njopval)
					VALUES ('$bldap_lisregno', '$bldcol_id', '$bldcol_addr1', '$bldcol_addr2', '$bldcol_addr3', '$bldcol_kodepos', 
					'$bldcol_type', '$bldcol_imbno', '$bldcol_imbdate', '$bldcol_imbluas', '$bldcol_njopyear', '$bldcol_njopval')";
			 
			 $params = array(&$_POST['query']);

			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			 }

			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
			   die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);

			$ysql = "INSERT INTO Tbl_Cust_MasterCol VALUES('$custnomid','BA1')";
			$y = sqlsrv_query($conn, $ysql);
			
			//update flag dari N ke R
			$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'R' WHERE custnomid = '$custnomid' and custflagapr = 'N'";
			$a = sqlsrv_query($conn, $tsql);
		}
	}
	
	if ($countvhc > 0)
	{
		for ($i=1;$i<=$countvhc;$i++)
		{
			$vhcap_lisregno = $_POST["vhcap_lisregno$i"];
			$vhccol_id = $_POST["vhccol_id$i"];
			$vhccol_addr1 = $_POST["vhccol_addr1$i"];
			$vhccol_addr2 = $_POST["vhccol_addr2$i"];
			$vhccol_addr3 = $_POST["vhccol_addr3$i"];
			$vhccol_kodepos = $_POST["vhccol_kodepos$i"];
			$vhccol_nopol = $_POST["vhccol_nopol$i"];
			$vhccol_stnk_no = $_POST["vhccol_stnk_no$i"];
			$vhccol_stnkexp = $_POST["vhccol_stnkexp$i"];
			$vhccol_fakturno = $_POST["vhccol_fakturno$i"];
			$vhccol_fakturtgl = $_POST["vhccol_fakturtgl$i"];
			$vhccol_bpkbno = $_POST["vhccol_bpkbno$i"];
			$vhccol_bpkbtgl = $_POST["vhccol_bpkbtgl$i"];
			$vhccol_type = $_POST["vhccol_type$i"];
			$vhccol_model = $_POST["vhccol_model$i"];
			$vhccol_merk = $_POST["vhccol_merk$i"];
			$vhccol_tahunpembuatan = $_POST["vhccol_tahunpembuatan$i"];
			$vhccol_jeniskendaran = $_POST["vhccol_jeniskendaran$i"];
			$vhccol_silinder = $_POST["vhccol_silinder$i"];
			$vhccol_warna = $_POST["vhccol_warna$i"];
			$vhccol_norangka = $_POST["vhccol_norangka$i"];
			$vhccol_nomesin = $_POST["vhccol_nomesin$i"];
			$vhccol_bpkbnama = $_POST["vhccol_bpkbnama$i"];
			$vhccol_bpkbaddr1 = $_POST["vhccol_bpkbaddr1$i"];
			$vhccol_bpkbaddr2 = $_POST["vhccol_bpkbaddr2$i"];
			$vhccol_bpkbaddr3 = $_POST["vhccol_bpkbaddr3$i"];
			
			$tsql = "INSERT INTO tbl_COL_Vehicle (ap_lisregno, col_id, col_addr1, col_addr2, col_addr3, 
					col_kodepos, col_nopol, col_stnk_no, col_stnkexp, col_fakturno, col_fakturtgl, col_bpkbno, col_bpkbtgl, col_type, 
					col_model, col_merk, col_tahunpembuatan, col_jeniskendaran, col_silinder,
					col_warna, col_norangka,col_nomesin,col_bpkbnama,col_bpkbaddr1, col_bpkbaddr2, col_bpkbaddr3)
					VALUES('$vhcap_lisregno','$vhccol_id','$vhccol_addr1','$vhccol_addr2','$vhccol_addr3',
					'$vhccol_kodepos','$vhccol_nopol','$vhccol_stnk_no','$vhccol_stnkexp','$vhccol_fakturno','$vhccol_fakturtgl','$vhccol_bpkbno','$vhccol_bpkbtgl','$vhccol_type',
					'$vhccol_model','$vhccol_merk','$vhccol_tahunpembuatan','$vhccol_jeniskendaran','$vhccol_silinder',
					'$vhccol_warna', '$vhccol_norangka', '$vhccol_nomesin', '$vhccol_bpkbnama', '$vhccol_bpkbaddr1', '$vhccol_bpkbaddr2', '$vhccol_bpkbaddr3')";
			         $params = array(&$_POST['query']);

			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			 }

			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
			   die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);
			 
			$ysql = "INSERT INTO Tbl_Cust_MasterCol VALUES('$custnomid','V01')";
			$y = sqlsrv_query($conn, $ysql);
			
			//update flag dari N ke R
			$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'R' WHERE custnomid = '$custnomid' and custflagapr = 'N'";
			$a = sqlsrv_query($conn, $tsql);
		}
	}
	
	require("../../lib/close_con.php");
}

else if($tab == "update")
{ 
	$custnomid=$_POST['custnomid'];
	$countlnd=$_POST['countlnd'];
	$countbld=$_POST['countbld'];
	$countvhc=$_POST['countvhc'];	
	
	require ("../../lib/open_con.php");
	if ($countlnd > 0)
	{
		for ($i=1;$i<=$countlnd;$i++)
		{
			$lndap_lisregno = $_POST["lndap_lisregno$i"];
			$lndcol_id = $_POST["lndcol_id$i"];
			$lndcol_addr1 = $_POST["lndcol_addr1$i"];
			$lndcol_addr2 = $_POST["lndcol_addr2$i"];
			$lndcol_addr3 = $_POST["lndcol_addr3$i"];
			$lndcol_kodepos = $_POST["lndcol_kodepos$i"];
			$lndcol_certtype = $_POST["lndcol_certtype$i"];
			$lndcol_certno = $_POST["lndcol_certno$i"];
			$lndcol_certatasnama = $_POST["lndcol_certatasnama$i"];
			$lndcol_luastanah = $_POST["lndcol_luastanah$i"];
			$lndcol_certdate = $_POST["lndcol_certdate$i"];
			$lndcol_certdue = $_POST["lndcol_certdue$i"];
			$lndcol_relcode = $_POST["lndcol_relcode$i"];
			$lndcol_haktanggungan = $_POST["lndcol_haktanggungan$i"];
			$lndcol_haktanggungantgl = $_POST["lndcol_haktanggungantgl$i"];
			$lndcol_identification = $_POST["lndcol_identification$i"];
			$lndcol_njopyear = $_POST["lndcol_njopyear$i"];
			$lndcol_njopval = $_POST["lndcol_njopval$i"];
			$lndcol_remark = $_POST["lndcol_remark$i"];
		
			$tsql = "UPDATE tbl_COL_Land SET col_addr1 = '$lndcol_addr1', col_addr2 = '$lndcol_addr2', col_addr3 = '$lndcol_addr3', 
					col_kodepos = '$lndcol_kodepos', col_certtype = '$lndcol_certtype', col_certno = '$lndcol_certno', col_certatasnama = '$lndcol_certatasnama', 
					col_certluas = '$lndcol_luastanah', col_certdate = '$lndcol_certdate', col_certdue = '$lndcol_certdue', col_relcode = '$lndcol_relcode', col_haktanggungan = '$lndcol_haktanggungan', 
					col_haktanggungantgl = '$lndcol_haktanggungantgl', col_identification = '$lndcol_identification', col_njopyear = '$lndcol_njopyear', col_njopval = '$lndcol_njopval', col_remark = '$lndcol_remark'
					WHERE ap_lisregno = '$lndap_lisregno' AND col_id = '$lndcol_id'";

			$params = array(&$_POST['query']);

			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			 }

			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
			   die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);
			 

			
			//update flag dari N ke R
			$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'R' WHERE custnomid = '$custnomid' and custflagapr = 'N'";
			$a = sqlsrv_query($conn, $tsql);
			
		}
	}
	
	if ($countbld > 0)
	{
		for ($i=1;$i<=$countbld;$i++)
		{
			$lndap_lisregno = $_POST["lndbldap_lisregno$i"];
			$lndcol_id = $_POST["lndbldcol_id$i"];
			$lndcol_addr1 = $_POST["lndbldcol_addr1$i"];
			$lndcol_addr2 = $_POST["lndbldcol_addr2$i"];
			$lndcol_addr3 = $_POST["lndbldcol_addr3$i"];
			$lndcol_kodepos = $_POST["lndbldcol_kodepos$i"];
			$lndcol_certtype = $_POST["lndbldcol_certtype$i"];
			$lndcol_certno = $_POST["lndbldcol_certno$i"];
			$lndcol_certatasnama = $_POST["lndbldcol_certatasnama$i"];
			$lndcol_luastanah = $_POST["lndbldcol_luastanah$i"];
			$lndcol_certdate = $_POST["lndbldcol_certdate$i"];
			$lndcol_certdue = $_POST["lndbldcol_certdue$i"];
			$lndcol_relcode = $_POST["lndbldcol_relcode$i"];
			$lndcol_haktanggungan = $_POST["lndbldcol_haktanggungan$i"];
			$lndcol_haktanggungantgl = $_POST["lndbldcol_haktanggungantgl$i"];
			$lndcol_identification = $_POST["lndbldcol_identification$i"];
			$lndcol_njopyear = $_POST["lndbldcol_njopyear$i"];
			$lndcol_njopval = $_POST["lndbldcol_njopval$i"];
			$lndcol_remark = $_POST["lndbldcol_remark$i"];
			
			$bldap_lisregno = $_POST["bldap_lisregno$i"];
			$bldcol_id = $_POST["bldcol_id$i"];
			$bldcol_addr1 = $_POST["bldcol_addr1$i"];
			$bldcol_addr2 = $_POST["bldcol_addr2$i"];
			$bldcol_addr3 = $_POST["bldcol_addr3$i"];
			$bldcol_kodepos = $_POST["bldcol_kodepos$i"];
			$bldcol_type = $_POST["bldcol_type$i"];
			$bldcol_imbno = $_POST["bldcol_imbno$i"];
			$bldcol_imbdate = $_POST["bldcol_imbdate$i"];
			$bldcol_imbluas = $_POST["bldcol_imbluas$i"];
			$bldcol_njopyear = $_POST["bldcol_njopyear$i"];
			$bldcol_njopval = $_POST["bldcol_njopval$i"];
			
			$tsql = "UPDATE tbl_COL_Land SET col_addr1 = '$lndcol_addr1', col_addr2 = '$lndcol_addr2', col_addr3 = '$lndcol_addr3', 
					col_kodepos = '$lndcol_kodepos', col_certtype = '$lndcol_certtype', col_certno = '$lndcol_certno', col_certatasnama = '$lndcol_certatasnama', 
					col_certluas = '$lndcol_luastanah', col_certdate = '$lndcol_certdate', col_certdue = '$lndcol_certdue', col_relcode = '$lndcol_relcode', col_haktanggungan = '$lndcol_haktanggungan', 
					col_haktanggungantgl = '$lndcol_haktanggungantgl', col_identification = '$lndcol_identification', col_njopyear = '$lndcol_njopyear', col_njopval = '$lndcol_njopval', col_remark = '$lndcol_remark'
					WHERE ap_lisregno = '$lndap_lisregno' AND col_id = '$lndcol_id'
					
					UPDATE tbl_COL_Building SET  col_addr1 = '$bldcol_addr1', col_addr2 = '$bldcol_addr2', col_addr3 = '$bldcol_addr3', col_kodepos = '$bldcol_kodepos', 
					col_type = '$bldcol_type', col_imbno = '$bldcol_imbno', col_imbdate = '$bldcol_imbdate', col_imbluas = '$bldcol_imbluas', col_njopyear = '$bldcol_njopyear', col_njopval = '$bldcol_njopval'
					WHERE ap_lisregno = '$bldap_lisregno' AND col_id = '$bldcol_id'";
			 
			 $params = array(&$_POST['query']);

			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			 }

			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
			   die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);

			
			//update flag dari N ke R
			$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'R' WHERE custnomid = '$custnomid' and custflagapr = 'N'";
			$a = sqlsrv_query($conn, $tsql);
		}
	}
	
	if ($countvhc > 0)
	{
		for ($i=1;$i<=$countvhc;$i++)
		{
			$vhcap_lisregno = $_POST["vhcap_lisregno$i"];
			$vhccol_id = $_POST["vhccol_id$i"];
			$vhccol_addr1 = $_POST["vhccol_addr1$i"];
			$vhccol_addr2 = $_POST["vhccol_addr2$i"];
			$vhccol_addr3 = $_POST["vhccol_addr3$i"];
			$vhccol_kodepos = $_POST["vhccol_kodepos$i"];
			$vhccol_nopol = $_POST["vhccol_nopol$i"];
			$vhccol_stnk_no = $_POST["vhccol_stnk_no$i"];
			$vhccol_stnkexp = $_POST["vhccol_stnkexp$i"];
			$vhccol_fakturno = $_POST["vhccol_fakturno$i"];
			$vhccol_fakturtgl = $_POST["vhccol_fakturtgl$i"];
			$vhccol_bpkbno = $_POST["vhccol_bpkbno$i"];
			$vhccol_bpkbtgl = $_POST["vhccol_bpkbtgl$i"];
			$vhccol_type = $_POST["vhccol_type$i"];
			$vhccol_model = $_POST["vhccol_model$i"];
			$vhccol_merk = $_POST["vhccol_merk$i"];
			$vhccol_tahunpembuatan = $_POST["vhccol_tahunpembuatan$i"];
			$vhccol_jeniskendaran = $_POST["vhccol_jeniskendaran$i"];
			$vhccol_silinder = $_POST["vhccol_silinder$i"];
			$vhccol_warna = $_POST["vhccol_warna$i"];
			$vhccol_norangka = $_POST["vhccol_norangka$i"];
			$vhccol_nomesin = $_POST["vhccol_nomesin$i"];
			$vhccol_bpkbnama = $_POST["vhccol_bpkbnama$i"];
			$vhccol_bpkbaddr1 = $_POST["vhccol_bpkbaddr1$i"];
			$vhccol_bpkbaddr2 = $_POST["vhccol_bpkbaddr2$i"];
			$vhccol_bpkbaddr3 = $_POST["vhccol_bpkbaddr3$i"];
			
			$tsql = "UPDATE tbl_COL_Vehicle SET col_addr1 = '$vhccol_addr1', col_addr2 = '$vhccol_addr2', col_addr3 = '$vhccol_addr3', 
					col_kodepos = '$vhccol_kodepos', col_nopol = '$vhccol_nopol', col_stnk_no = '$vhccol_stnk_no', col_stnkexp = '$vhccol_stnkexp', 
					col_fakturno = '$vhccol_fakturno', col_fakturtgl = '$vhccol_fakturtgl', col_bpkbno = '$vhccol_bpkbno', col_bpkbtgl = '$vhccol_bpkbtgl', col_type = '$vhccol_type', 
					col_model = '$vhccol_model', col_merk = '$vhccol_merk', col_tahunpembuatan = '$vhccol_tahunpembuatan', col_jeniskendaran = '$vhccol_jeniskendaran', 
					col_silinder = '$vhccol_silinder', col_warna = '$vhccol_warna', col_norangka = '$vhccol_norangka',col_nomesin = '$vhccol_nomesin',
					col_bpkbnama = '$vhccol_bpkbnama',col_bpkbaddr1 = '$vhccol_bpkbaddr1', col_bpkbaddr2 = '$vhccol_bpkbaddr2', col_bpkbaddr3 = '$vhccol_bpkbaddr3'
					WHERE ap_lisregno = '$vhcap_lisregno' AND col_id = '$vhccol_id'";

			         $params = array(&$_POST['query']);

			 $stmt = sqlsrv_prepare( $conn, $tsql, $params);
			 if( $stmt )
			 {
			 } 
			 else
			 {
				echo "Error in preparing statement.\n";
				die( print_r( sqlsrv_errors(), true));
			 }

			 if( sqlsrv_execute( $stmt))
			 {
			 }
			 else
			 {
			   echo "Error in executing statement.\n";
			   die( print_r( sqlsrv_errors(), true));
			 }
			 sqlsrv_free_stmt( $stmt);
			
			//update flag dari N ke R
			$tsql = "UPDATE Tbl_CustomerFlag SET custflagapr = 'R' WHERE custnomid = '$custnomid' and custflagapr = 'N'";
			$a = sqlsrv_query($conn, $tsql);
		}
	}
	
	require("../../lib/close_con.php");
}
else
{
	echo Error;
}
?>