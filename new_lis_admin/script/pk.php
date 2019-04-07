<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
 
require ("../lib/open_con.php");
$txtid=$_GET['text'];


$sql_cmp="select * from Tbl_CustomerMasterPerson where custsex!= 0 and custnomid='$txtid' ";
	$cursortype_cmp = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
	$params_cmp = array(&$_POST['query']);
	$sqlConn_cmp = sqlsrv_query($conn, $sql_cmp, $params_cmp, $cursortype_cmp);
	if($conn==false){die(FormatErrors(sqlsrv_errors()));}
	if(sqlsrv_has_rows($sqlConn_cmp))
	{
		$rowCount_cmp = sqlsrv_num_rows($sqlConn_cmp);
		while($row_cmp = sqlsrv_fetch_array( $sqlConn_cmp, SQLSRV_FETCH_ASSOC))
		{
		$cmp_ao=$row_cmp['custaocode'];
		$cmp_branch=$row_cmp['custbranchcode'];
		$cmp_fname=$row_cmp['custfullname'];
		$cmp_mar=$row_cmp['custmarname'];
		$cmp_ct1=$row_cmp['custcredittype1'];
		$cmp_cn1=$row_cmp['custcreditneed1'];
		$cmp_cp1=$row_cmp['custcreditplafond1'];
	
			$sql_ao="Select * from tbl_ao where ao_code='$cmp_ao'";
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
		
		
			$sql_branch="Select * from tbl_branch where branch_code='$cmp_branch'";
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
				$branch_addr=$row_branch['branch_address'];
				$branch_city=$row_branch['branch_city'];
				}
			}
			sqlsrv_free_stmt( $sqlConn_branch );
		
		}						
	}
	sqlsrv_free_stmt( $sqlConn_cmp );


?>





































<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="../js/datetimepicker_css.js"></script>
<Script Language="JavaScript">
	document.onkeypress = mykeyhandler;
 
        function toggleExpCol(idGrp, idContainer) {
            idContainer = idContainer ? idContainer + '_' : '';
            var div = document.getElementById(idContainer + 'divGrp' + idGrp);
            var vis = div.style.display = (div.style.display == 'none') ? 'block' : 'none';
            document.images[idContainer + 'imgGrp' + idGrp].src = (vis == 'none') ? '/eschool/style/xpexpand2.gif' : '/eschool/style/xpcollapse2.gif';
        }
	function mykeyhandler()
	{
    	   if (window.event && window.event.keyCode == 39)
    	   {
        	window.event.cancelBubble = true;
        	window.event.returnValue = false;
        	return false;
    	   }
    	   if (window.event && window.event.keyCode == 34)
    	   {
        	window.event.cancelBubble = true;
        	window.event.returnValue = false;
        	return false;
    	   }
    	   if (window.event.ctrlKey && window.event.keyCode == 17)
    	   {
              	   cek();
    	   }
	}
 
	function microsoftKeyPress(currentfield, nextfield, musthavecurrentfield, numericfield, defaultvalue, needanotherdefaultvalue)
	{
            var Chars ="0123456789.";
	    varcurrentfield = "document.ulangan." + currentfield + ".focus();";
	    varnextfield = "document.ulangan." + nextfield + ".focus();";
	    if (window.event.keyCode == 13)
	       if (eval('document.ulangan.' + currentfield + '.value') == "" && musthavecurrentfield == 'Y')
	       {
	 	  eval(varcurrentfield);
	       }
	       else
	       {
	       	  if (numericfield == "Y")
	       	  {
	       	   varstatus = true;
	           for (var i = 0; i < eval('document.ulangan.' + currentfield + '.value.length'); i++)
        	   {
       	      		if (Chars.indexOf(eval('document.ulangan.' + currentfield + '.value.charAt(i)')) == -1)
       	      		{
       	      		  varstatus = false;
       	      		  break;
              		}
           	   }
           	   if (varstatus == false)
           	   {
                      alert("Harus Diisi Berupa Angka, Gunakan Tanda . [titik] Untuk Pemisah Decimal");
                      if (defaultvalue == 'N')
                      {
              		  if (document.ulangan.sttbpenerimacitycode.options[document.ulangan.sttbpenerimacitycode.selectedIndex].value == "")
              		  {
		 	     eval('document.ulangan.' + currentfield + '.value =0');
    	   		  }
    	   		  else
    	   		  {
	  	             var temp = document.ulangan.sttbpenerimacitycode.options[document.ulangan.sttbpenerimacitycode.selectedIndex].value + "Price";
	    	             var selectedArray = eval(temp);
		 	     eval('document.ulangan.' + currentfield + '.value =' + selectedArray[needanotherdefaultvalue]);
		 	  }
                      }
                      else
                      {
		 	  eval('document.ulangan.' + currentfield + '.value = defaultvalue');
		      }
		 	  eval(varcurrentfield);
		 	  return false;
           	   }
              	   else
       	      	   {
		     eval(varnextfield);
              	   }           	   
	       	  }
	       	  else
	       	  {
       	             eval('document.ulangan.' + currentfield + '.value = document.ulangan.' + currentfield + '.value.toUpperCase()');
	             eval(varnextfield);
	          }
	       }
	}
 
	function cek()
	{
           var Chars ="0123456789";
	   if (document.ulangan.aspectdate01.value == "")
	   {
	      alert("Tidak boleh kosong");
	      document.ulangan.aspectdate01.focus();
	      return false;
	   }
	   if (document.ulangan.aspectdate01.value.substring(4,5) != "/")
	   {
	      alert("Format Tanggal : yyyy/mm/dd");
	      document.ulangan.aspectdate01.focus();
	      return false;
	   }
	   vartahun = document.ulangan.aspectdate01.value.substring(0,4);
           for (var i = 0; i < vartahun.length; i++)
           {
       	      if (Chars.indexOf(vartahun.charAt(i)) == -1)
       	      {
	         alert("Tahun harus 4 digit angka");
	         document.ulangan.aspectdate01.focus();
	         return false;
       	      }
           }
           submitform = window.confirm("Simpan Data ?")
           if (submitform == true)
           {
              document.ulangan.submit();
              return true;
           }
           else
           {
              return false;
           }
	}
        
        function GantiMenu(theact,theprgcode)
        {
               document.menu.userprgcode.value=theprgcode;
               document.menu.target = "contents";
               document.menu.action=theact;
               varunittemp = "";
               for (var i = 0; i < theact.length; i++)
               {
               	  if (varunittemp == "")
               	  {
       	             if (theact.substring(i,i+7) == "theunit")
       	             {
                      varunittemp = theact.substring(i+8);
                     }
                  }                    
               }
               document.menu.theunit.value=varunittemp;
               document.menu.submit();
        }
     </script>
</head>

<body>


<Script Language="JavaScript">
var nav = (document.layers); 
var iex = (document.all);
var skn = (nav) ? document.topdeck : topdeck.style;
if (nav) document.captureEvents(Event.MOUSEMOVE);
document.onmousemove = get_mouse;
 
function pop(msghead,msgdetil,bak) 
{
 
var content ="<TABLE WIDTH=400 BORDER=0 CELLPADDING=2 CELLSPACING=0 BGCOLOR=#FFCC66><TR><TD><TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0><TR><TD><CENTER><FONT COLOR=#000000 face=Arial SIZE=2><B>"+msghead+"</B></FONT></CENTER></TD></TR></TABLE><TABLE WIDTH=100% BORDER=0 CELLPADDING=2 CELLSPACING=0 BGCOLOR="+bak+"><TR><TD>"+msgdetil+"</TR></TABLE></TD></TR></TABLE>";
 
  if (nav) 
  { 
    skn.document.write(content); 
	  skn.document.close();
	  skn.visibility = "visible";
  }
    else if (iex) 
  {
	  document.all("topdeck").innerHTML = content;
	  skn.visibility = "visible";  
  }
}
 
function get_mouse(e) 
{
	var x = (nav) ? e.pageX : event.x+document.body.scrollLeft; 
	var y = (nav) ? e.pageY : event.y+document.body.scrollTop;
	var z = document.body.scrollTop;
	skn.left = 280;
        skn.top  = z + 10;
}
 
function kill() 
{
  skn.visibility = "hidden";
}
   </script>
   <form action="do_pk.php" method="get">
<table width="800" border="0" align="center">
  <tr>
    <td align="center" colspan="10">
PERJANJIAN KREDIT</br>
FASILITAS PEMBIAYAAN MEGA USAHA KECIL MENENGAH</br>
("MEGA UKM")</br>
Nomor : <input type="text" name="text0" id="text0">
</td>
  </tr>
   <tr>
  	<td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10">
    Perjanjian Kredit MEGA UKM ini (selanjutnya disebut Perjanjian MEGA UKM) dibuat dan ditandatangani pada hari</br>
    <input type="text" name="text1" id="text1" />
    tanggal 
    <input type="text" name="text2" id="text2" />
    <a href="javascript:NewCssCal('text2')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a>oleh dan antara : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td width="14">1.</td>
    <td colspan="9">PT. Bank Mega, Tbk., berkedudukan di Jakarta, suatu bank berbentuk perseroan terbatas yang didirikan menurut dan</br> berdasarkan hukum Republik Indonesia, dengan cabang-cabang antara lain beralamat di </br> <input type="text" name="text3" id="text3"  size="100" value="<? echo $branch_addr;?>"/>
    yang dalam hal ini diwakili oleh :</td>
  </tr>
  <tr height="10">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="14">a.</td>
    <td width="6" >&nbsp;</td>
    <td colspan="7"><input type="text" name="text4" size="120" id="text4" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>b.</td>
    <td>&nbsp;</td>
    <td colspan="7"><input size="120" type="text" name="text5" id="text5" /></td>
  </tr>
  <tr>
  	<td colspan="10">&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="9">Masing-masing bertindak dalam jabatannya tersebut selaku kuasa dari Direksi PT Bank Mega, Tbk, berdasarkan</br> Surat Kuasa nomor SK
      <input type="text" name="text6" id="text6" />
      , tanggal
      <input type="text" name="text7" id="text7" /><a href="javascript:NewCssCal('text7')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a>
dan nomor 
<input type="text" name="text8" id="text8" />
,</br> tanggal 
<input type="text" name="text9" id="text9" />
<a href="javascript:NewCssCal('text9')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a>
;</br>
- Untuk selanjutnya disebut "BANK";
</td>
  </tr>
   <tr>
  	<td colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td>2.</td>
    <td colspan="9" rowspan="4"><textarea name="text10" cols="95" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9">- Untuk selanjutnya disebut "DEBITUR".</td>
  </tr>
  <tr>
    <td colspan="10">BANK dan DEBITUR telah saling setuju untuk membuat, melaksanakan dan mematuhi Perjanjian MEGA UKM ini dengan</br> syarat-syarat dan ketentuan-ketentuan sebagai berikut:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="191">&nbsp;</td>
    <td width="4">&nbsp;</td>
    <td width="296">&nbsp;</td>
    <td width="1">&nbsp;</td>
    <td width="4">&nbsp;</td>
    <td width="40">&nbsp;</td>
    <td width="166">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="10">PASAL 1</br>
FASILITAS KREDIT
</td>
  </tr>
  <tr>
    <td>1.</td>
    <td colspan="9">Fasilitas Kredit yang diberikan BANK kepada DEBITUR  adalah : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jenis Fasilitas </td>
    <td>:</td>
    <td colspan="5"><input type="text" size="100" name="text11" id="text10" value="<? echo $cmp_ct1;?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Tujuan Penggunaan</td>
    <td>:</td>
    <td colspan="5"><input type="text" size="100" name="text12" id="text11" value="<? echo $cmp_cn1;?>" /></td>
  </tr>
  <tr>
    <td height="24">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jumlah Fasilitas</td>
    <td>:</td>
    <td colspan="5"><input type="text" size="100" name="text13" id="text12" value="<? echo $cmp_cp1;?>" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Suku Bunga</td>
    <td>:</td>
    <td colspan="5"><textarea name="text14" cols="75" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Jangka Waktu</td>
    <td>:</td>
    <td colspan="5"><input type="text"size="100" name="text15" id="text13" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Angsuran</td>
    <td>:</td>
    <td colspan="5"><textarea name="text16" cols="75" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Biaya Provisi</td>
    <td>:</td>
    <td colspan="5"><input type="text" size="100" name="text17" id="text14" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Biaya Administrasi</td>
    <td>:</td>
    <td colspan="5"><input type="text" size="100" name="text18" id="text15" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Denda Keterlambatan Pembayaran Angsuran</td>
    <td>:</td>
    <td colspan="5"><textarea name="text19" cols="75" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Denda Pembayaran Dipercepat</td>
    <td>:</td>
    <td colspan="5"><textarea name="text20" cols="75" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="7" align="center">
    PASAL 2</br>
JAMINAN
</td>
  </tr>
  <tr>
    <td colspan="10">Untuk menjamin pembayaran kembali sebagaimana mestinya semua jumlah uang yang terhutang dan wajib dibayar oleh</br> DEBITUR kepada BANK berdasarkan Perjanjian MEGA UKM berikut setiap perubahannya, maka DEBITUR dan / atau</br> pihak ketiga memberikan jaminan (-jaminan)  kepada BANK sebagaiberikut  : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>1.</td>
    <td colspan="8"><textarea name="text21" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2</td>
    <td colspan="8"><textarea name="text22" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>3</td>
    <td colspan="8"><textarea style="font-family:'Arial Black', Gadget, sans-serif" name="text23" cols="90" rows="5"></textarea></td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" align="center">PASAL  3</br>
KONDISI TERTENTU
</td>
  </tr>
  <tr>
    <td colspan="10">Dalam kondisi tertentu dimana tingkat suku bunga perbankan pada umumnya mengalami kenaikan diluar batas kewajaran, maka BANK atas pertimbangannya sendiri berhak untuk menyesuaikan tingkat suku bunga yang berlaku, perubahan mana akan diberitahukan secara tertulis  kepada DEBITUR, dan pemberitahuan mana mengikat DEBITUR.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" align="center">PASAL 4</br>
PERSETUJUAN TUNDUK PADA </br>
SYARAT DAN KETENTUAN UMUM MEGA USAHA KECIL MENENGAH (SKU MEGA UKM)
</td>
  </tr>
  <tr>
    <td colspan="10">Debitur dengan ini menyatakan telah membaca, mengerti, memahami, dengan jelas dan menerima baik serta mengikat diri untuk tunduk terhadap seluruh syarat-syarat dan ketentuan umum sebagaimana tertunag dalam Lampiran Perjanjian Kredit Fasilitas Pembiayaan Mega Usaha Kecil Menengah, lampiran mana merupakan satu kesatuan yang tidak terpisahkan dengan Perjanjian  MEGA UKM.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" align="center">PASAL 5</br>
KETENTUAN LAIN-LAIN

</td>
  </tr>
  <tr>
    <td colspan="10"><textarea name="text24" cols="95" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10" align="center">PASAL 6</br>
KORESPONDENSI
</td>
  </tr>
  <tr>
    <td colspan="10">Semua surat menyurat atau pemberitahuan yang perlu dikirim oleh masing-masing pihak kepada pihak yang lain mengenai atau sehubungan dengan Perjanjian MEGA UKM ini harus dilakukan secara langsung dengan surat tercatat atau melalui ekspedisi facsimile, kawat atau telex ke alamat-alamat dibawah ini : </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>1.</td>
    <td>&nbsp;</td>
    <td>BANK</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9"><textarea name="text25" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>2.</td>
    <td>&nbsp;</td>
    <td>DEBITUR</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="9"><textarea name="text26" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
    <td colspan="10"><p>Setiap perubahan dari data dan  alamat tersebut di atas wajib diberitahukan secara tertulis oleh pihak yang  mengalami perubahan kepada pihak lainnya.</p></td>
  </tr>
  <tr>
    <td colspan="10" align="center">PASAL 7</br>
DOMISILI HUKUM
</td>
  </tr>
  <tr>
    <td colspan="10">Kecuali ditetapkan lain dalam Perjanjian MEGA UKM, maka kedua belah pihak memilih tempat kedudukan hukum yang tetap dan seumumnya di Kantor Kepaniteraan Pengadilan Negeri 
      <input type="text" name="text27" id="text16" value="<? echo $branch_city; ?>"/>
    27, namun, tidak mengurangi hak dan wewenang BANK untuk memohon pelaksanaan (eksekusi) atau mengajukan tuntutan/gugatan hukum terhadap DEBITUR berdasarkan Ketentuan Umum  ini dimuka pengadilan lain dalam wilayah Republik Indonesia.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10">Demikian setelah ketentuan-ketentuan ini dibaca dan dipelajari dengan seksama oleh DEBITUR  dan isinya telah dimengerti oleh DEBITUR dan dengan penuh kesadaran dan tanggung jawab, tanpa ada unsur paksaan dan tekanan dari pihak manapun menandatangani Perjanjian MEGA UKM ini pada tanggal dan tahun sebagaimana tersebut diatas</td>
  </tr>
</table>
</br>
</br>
<table align="center" width="800" border="0">
  <tr>

    <td width="200"> BANK</td>
    <td width="200">&nbsp;</td>
    <td width="200">DEBITUR</td>
    <td width="200">Menyetujui : </td>
  </tr>
  <tr>
    <td>PT. Bank Mega, Tbk. </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="110">&nbsp;</td>
    <td>&nbsp;</td>
    <td > MATERAI</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"size="28" name="text28" id="text17" /></td>
    <td><input type="text" size="28" name="text29" id="text19" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="text"size="28" name="text30" id="text18" /></td>
    <td><input type="text"size="28" name="text31" id="text20" /></td>
    <td><input type="text"size="28" name="text32" id="text21" value="<? echo $cmp_fname; ?>" /></td>
    <td><input type="text"size="28" name="text33" id="text22" value="<? 	if($cmp_mar==null)
		{
		echo "";
		}
		else {echo $cmp_mar;}?>" /></td>
  </tr>
</table>
</br>
</br>
<table align="center" border="0" width="800">
<tr>
	<td align="right"><input name="submit" type="submit" value="submit" />
    </td>
</tr>
</table>
</form>
</body>
</html>