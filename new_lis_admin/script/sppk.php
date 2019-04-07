<?
	 
require ("../lib/open_con.php");
$txtid=$_GET['text'];
$total_plafon=0;
$cmp_cp2=0;
$cmp_cp1=0;

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
		$cmp_addr=$row_cmp['custaddr'];
		$cmp_cp1=round($row_cmp['custcreditplafond1']);
		$cmp_cp2=round($row_cmp['custcreditplafond2']);
		$cmp_ct1=$row_cmp['custcredittype1'];
		$cmp_cl1=$row_cmp['custcreditlong1'];
		$cmp_cl2=$row_cmp['custcreditlong2'];
		$cmp_cn2=$row_cmp['custcreditneed2'];
		$cmp_ct2=$row_cmp['custcredittype2'];
		
		$total_plafon=$cmp_cp2+$cmp_cp1;
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

<body style="background-color:yellow;">


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
   <form action="do_sppk.php" method="post">
<table align="center" width="800" border="0">
  <tr>

    <td width="10">&nbsp;</td>
    <td width="8">&nbsp;</td>
    <td width="27">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="36">&nbsp;</td>
    <td width="3">&nbsp;</td>
    <td width="667">&nbsp;</td>
  </tr>
  <tr>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><input type="text0" name="text0" id="text">
      <input type="text" name="text1" id="text1"><a href="javascript:NewCssCal('text1')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">Nomor</td>
    <td>:</td>
    <td colspan="3"><input type="text" name="text2" id="text2"></td>
    </tr>
  <tr>
    <td colspan="3">Lampiran</td>
    <td>:</td>
    <td colspan="3">1 LEMBAR</td>
    </tr>
  <tr>
    <td colspan="3">Prihal</td>
    <td>:</td>
    <td colspan="3"><u>Surat Pemberitahuan Persetujuan Kredit (SPPK)</u></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">Kepada Yth</td>
    </tr>
  <tr>
    <td colspan="7"><input type="text" name="text3" id="text3" value="<?echo $cmp_fname;?>"></td>
    </tr>
  <tr>
    <td colspan="7"><input size="120" type="text" name="text4" id="text4" value="<? echo $cmp_addr;?>"></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">Dengan Hormat,</br>        Menunjuk surat bapak/Ibu tertanggal 
      
      <input type="text" name="text5" id="text5">
<a href="javascript:NewCssCal('text5')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a>      perihal Permohonan Fasilitas Kredit, dengan ini kami sampaikan bahwa PT. Bank Mega, Tbk dapat menyetujui permohonan kredit tersebut dengan syarat dan kondisi sebagai berikut:</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Debitur</td>
    <td>:</td>
    <td><input type="text" name="text6" id="text6"  value="<?echo $cmp_fname;?>">
    </a></td>
    </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Kreditur</td>
    <td>:</td>
    <td>PT.BANK MEGA</td>
    </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Plafon Kredit</td>
    <td>:</td>
    <td><table width="254" border="0">
      <tr>
        <td width="103" align="center">Jenis Kredit</td>
        <td width="141" align="center">Plafon</td>
      </tr>
      <tr>
        <td>Term Loan 1</td>
        <td><input type="text" name="text7" id="text7" value="<? echo $cmp_cp1?>">
        </a></td>
      </tr>
      <tr>
        <td>Term Loan 2</td>
        <td><input type="text" name="text8" id="text8" value="<? echo $cmp_cp2?>">
        </a></td>
      </tr>
      <tr>
        <td>TOTAL</td>
        <td><input type="text" name="text9" id="text9" value="<? echo $total_plafon?>">
        </a></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Jenis Fasilitas Kredit</td>
    <td>:</td>
    <td><input size="90" type="text" name="text10" id="text10" value="<?echo $cmp_ct1." "."dan"." "; echo $cmp_ct2;?>">
    </a></td>
    </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Sifat Kredit </td>
    <td>:</td>
    <td>
      <input size="90" type="text" name="text11" id="text11">
</td>
    </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Tujuan Kredit</td>
    <td>:</td>
    <td><textarea  name="text12" id="text12" cols="90" rows="5"><? echo $cmp_cn1." dan ".$cmp_cn2;?></textarea></td>
    </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Jangka Waktu</td>
    <td>:</td>
    <td><input size="90" type="text" name="text13" id="text13" value="<? echo $cmp_cl1." dan ".$cmp_cl2; ?>"></td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Suku Bunga </td>
    <td>:</td>
    <td><input size="90" type="text" name="text14" id="text14">
    %</td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Angsuran Perbulan</td>
    <td>:</td>
    <td><table width="400" border="0">
      <tr>
        <td><input size="90" type="text" name="text15" id="text15"></td>
      </tr>
      <tr>
        <td><input size="90" type="text" name="text16" id="text16"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4"> Biaya-biaya</td>
    <td>:</td>
    <td><table width="649" border="0">
      <tr>
        <td width="12">1.</td>
        <td width="137">Provisi 1% flat</td>
        <td width="8">:</td>
        <td width="469"><input type="text" name="text17" id="text17">
        </a></td>
      </tr>
      <tr>
        <td>2.</td>
        <td>Administrasi Kredit</td>
        <td>:</td>
        <td><input type="text" name="text18" id="text18">
        </a></td>
      </tr>
      <tr>
        <td>3.</td>
        <td>Asuransi Kerugian</td>
        <td>:</td>
        <td><input type="text" name="text19" id="text19">
        </a></td>
      </tr>
      <tr>
        <td>4.</td>
        <td>Notaris</td>
        <td>:</td>
        <td><input type="text" name="text20" id="text20">
        </a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Agunan</td>
    <td>:</td>
    <td><textarea  name="text21" id="text21" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Perjanjian Kredit</td>
    <td>:</td>
    <td><table width="400" border="0">
      <tr>
        <td><input size="90" type="text" name="text22" id="text22"></td>
      </tr>
      <tr>
        <td><input size="90" type="text" name="text23" id="text23"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Denda </td>
    <td>:</td>
    <td><textarea  name="text24" id="text24" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
    <td align="center">-</td>
    <td colspan="4">Pelunasan </td>
    <td>:</td>
    <td><textarea  name="text25" id="text25" cols="90" rows="5"></textarea></td>
  </tr>
  <tr>
   	<td align="center">-</td>
    <td colspan="4">Lain-lain</td>
    <td>:</td>
    <td><input type="text" name="text26" id="text26" size="90"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">Surat Pemberitahuan Persetujuan Kredit ini bukan merupakan perjanjian kredit yang mengikat Bapak/ibu dengan pihak Bank, dan oleh karenanya apabila ternyata terdapat kekeliruan didalam SPPK ini, maka akan dilakukan perbaikan seperlunya.</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">Demikian surat pemberitahuan kami, dan sebagai tanda persetujuan, harap Bapak/Ibu menandatangani surat ini diatas materai Rp. 6.000,- dan mengembalikannya kepada kami selambat-lambatnya tanggal     
      <input type="text" name="text27" id="text27">
<a href="javascript:NewCssCal('text27')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a> (maksimal 14 hari sejak tanggal SPPK ini). Apabila sampai dengan tanggal
<input type="text" name="text28" id="text28"><a href="javascript:NewCssCal('text28')"><img src="../images/calendar.gif" style="text-decoration:none; border:0;" ></img></a> 
(maksimum 30 hari kalender sejak tanggal surat ini) tidak dilaksanakan pengikatan/akad kredit, maka Surat Pemberitahuan Persetujuan Kredit ini dianggap tidak berlaku lagi (batal).</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><table width=100% border="0">
      <tr>
        <td width=25%>PT BANK MEGA</td>
        <td width=25%>&nbsp;</td>
        <td align="center" colspan="2">Setuju dengan kondisi diatas:</td>
        </tr>
      <tr>
        <td><input type="text" name="text29" id="text29" value="<? echo $branch_name;?>"></td>
        <td>&nbsp;</td>
        <td width="25%">&nbsp;</td>
        <td width="25%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center">
          <input type="text" name="text30" id="text30">
        </div></td>
        <td><div align="center">
          <input type="text" name="text31" id="text31" value="<? echo $ao_name;?>">
        </div></td>
        <td><div align="center">
          <input type="text" name="text32" id="text32" value="<?echo $cmp_fname;?>">
        </div></td>
        <td><div align="center">
          <input type="text" name="text33" id="text33" value="<? echo $cmp_mar; ?>">
        </div></td>
      </tr>
      <tr>
        <td><div align="center">Pimpinan Cabang</div></td>
        <td><div align="center">Account officer</div></td>
        <td><div align="center">Debitur</div></td>
        <td><div align="center">Istri</div></td>
      </tr>
    </table></td>
    </tr>
  <tr>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="7">LAMPIRAN<br/>
      SURAT PEMBERITAHUAN PERSETUJUAN KREDIT</td>
    </tr>
  <tr>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="7">SYARAT-SYARAT DAN KETENTUAN PERJANJIAN KREDIT</td>
    </tr>
  <tr>
    <td align="center" colspan="7"><input type="text" name="text34" id="text34" value="<?echo $cmp_fname;?>"></td>
    </tr>
  <tr>
    <td colspan="7">
    <ul>Syarat-syarat Penandatanganan Perjanjian Kredit:
    <li> Mengembalikan SPPK sebagai tanda persetujuan saudara telah ditandatangani oleh pejabat yang berwenang diatas materai Rp. 6.000,- dengan dibubuhi nama jelas.
</li>
<li>Menyerahkan dokumen legalitas debitur</li>
<li>Debitur Perorangan</br>
<table width="641" border="0">
  <tr>
    <td width="631">
    	<ul>
        	<li>
        	  <input size="90" type="text" name="text35" id="text35">
            </li>	
            <li>
        	  <input size="90" type="text" name="text36" id="text36">
            </li>
        </ul>
    </td>
    </tr>
</table>

</li>
<li>Menyerahkan dokumen-dokumen jaminan</br>
  <table width="641" border="0">
    <tr>
      <td width="631"><ul>
        <li>
          <input size="90" type="text" name="text37" id="text37">
        </li>
        <li>
          <input size="90" type="text" name="text38" id="text38">
        </li>
      </ul></td>
    </tr>
  </table>
</li>
<li>Menandatangani Surat Pernyataan bahwa debitur tidak masuk dalam daftar hitam.
</br>
<li>Telah dilakukan pengecakan jaminan di BPN setempat dengan hasil baik.</br>
<li>Telah dilakukan pengecekan persil di BPN (disesuaikan dgn term & condition fasilitas dan apabila disyaratkan oleh komite ) </br>

</ul>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">
    <ul>Syarat-syarat Pencairan atau Penarikan Kredit :
    <li>Telah melaksanakan pengikatan kredit dengan baik dan sempurna.
</li>
    <li>Telah membuka rekening koran/tabungan dan menyediakan dana yang cukup utnuk <br>
membayar semua biaya-biaya.</li>
    <li>Telah menyerahkan dokumen lain yang relevan atau wajar yang diminta oleh bank</li>
    <li>Telah menandatangani TTUN atau Surat Sanggup.</li>
    <li>Blokir dana 1 kali angsuran selama jangka waktu kredit.</li>
    </ul>
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><ul>Lain-lain
    <li>Segala biaya yang timbul atau akan timbul akibat pengikatan kredit seperti biaya notaris, <br>
asuransi dan lain-lain adalah merupakan beban debitur yang harus dibayar.<br>
    </li>
    <li>Syarat-syarat dan ketentuan-ketentuan lainnya sebagaimana yang akan diatur dan di tuang<br>
kan dalam perjanjian kredit dan accesoirnya.<br>
    </li>
    <li>Asuransi dicover pada perusahaan asuransi rekanan Bank Mega dengan Banker's Clause<br>
Bank Mega<br>
    </li>
    <li>Aktifitas keuangan dialihkan ke Bank Mega</li>
    </ul></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right" colspan="7"><input type="submit" name="submit" id="submit" value="Submit"></td>
    </tr>
</table>
</form>
</body>
</html>