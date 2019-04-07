function limitTextArea(paramFieldName,limitField,limitInteger)
{
	var jmlskrng;
	var jmllimit = limitInteger;
	var jmlsisa;
	//alert(document.getElementById(paramFieldName).value.length);
	jmlskrng = document.getElementById(paramFieldName).value.length;
	
	jmlsisa = parseInt(jmllimit) - parseInt(jmlskrng);
	
	document.getElementById(limitField).value = jmlsisa;
	
	if(jmlsisa < 0)
	{
		document.getElementById(limitField).value = 0;
		document.getElementById(paramFieldName).value = document.getElementById(paramFieldName).value.substring(0,limitInteger);
		alert("Jumlah batas karakter telah habis");
		document.getElementById(paramFieldName).focus();
	}
}

function CheckASCII(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	alert (charCode);
	return false;
	return true;
}

function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	return true;
}

function outputDollars(number)
{
	if (number.length <= 3)
		return (number == '' ? '0' : number);
	else
	{
		var mod = number.length%3;
		var output = (mod == 0 ? '' : (number.substring(0,mod)));
		for (i=0 ; i < Math.floor(number.length/3) ; i++)
		{
			if ((mod ==0) && (i ==0))
			output+= number.substring(mod+3*i,mod+3*i+3);
			else
			output+= ',' + number.substring(mod+3*i,mod+3*i+3);
		}
		return (output);
	}
}

function replace(string,text,by)
{
   var strLength = string.length, txtLength = text.length;
   if ((strLength == 0) || (txtLength == 0)) return string;

   var i = string.indexOf(text);
   if ((!i) && (text != string.substring(0,txtLength))) return string;
   if (i == -1) return string;

   var newstr = string.substring(0,i) + by;

   if (i+txtLength < strLength)
	  newstr += replace(string.substring(i+txtLength,strLength),text,by);

   return newstr;
}


function currencyFormat(fld, milSep, decSep, e) {
		var sep = 0;
		var key = '';
		var i = j = 0;
		var len = len2 = 0;
		var strCheck = '0123456789';
		var aux = aux2 = '';
		var whichCode = (window.Event) ? e.which : e.keyCode;

		if (whichCode == 13 ) {return true;} // Enter
		if (whichCode == 8 ) {return true;} //  Backspace
			key = String.fromCharCode(whichCode); // Get key value from key code
		if (strCheck.indexOf(key) == -1) return false; // Not a valid key
			len = fld.value.length;
		for(i = 0; i < len; i++)
		if (fld.value.charAt(i) != '0')
		{
			if (decSep=="")
			{
				if (fld.value.charAt(i) != decSep)
				{
				break;
				}	
			
			}
			else
			{
				break;
			}
		} 
			aux = '';
		for(; i < len; i++)
		if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
		aux += key;
		len = aux.length;
		if (len == 0) fld.value = '';
		
		//if (len == 1) fld.value = '0'+ decSep + '0' + aux;
		//if (len == 2) fld.value = '0'+ decSep + aux;
		if (len > 0) {
			aux2 = '';
			for (j = 0, i = len - 3; i >= 0; i--) {
				if (j == 3) {
					aux2 += milSep;
					j = 0;
				}
				aux2 += aux.charAt(i);
				j++;
		}
		
		fld.value = '';
		len2 = aux2.length;
			fld.value += aux.charAt(i);
		for (i = len2 - 1; i >= 0; i--)
			fld.value += aux2.charAt(i);
			fld.value += decSep + aux.substr(len - 2, len);
		}
		return false;
}

		function currency(idname)
		{
			alert("asdasd");
			var numberValue = document.getElementById(idname).value;
			var temp = accounting.formatMoney(numberValue);
			document.getElementById(idname).value = temp;
		}

		function saveform	(frmid,action)
		{
			var elem = document.getElementById(frmid).elements;
			var StatusAllowSubmit = true;
			
			for(var i = 0; i < elem.length; i++)
			{
				if(elem[i].style.backgroundColor == "yellow" || elem[i].style.backgroundColor == "#ff0" || elem[i].style.backgroundColor == "#ffff00")
				{
				
					if	(elem[i].value == "" || elem[i].value == "Select")
					{
						alert(elem[i].alt + " harus di isi");
						elem[i].focus();
						StatusAllowSubmit=false				
						break;
					}
					else if	(elem[i].type == "textarea" || elem[i].type == "text")
					{
						//alert(elem[i].type);
						varinvalidcharone = elem[i].value.indexOf('\'');	
						varinvalidchartwo = elem[i].value.indexOf('\"');
						if (varinvalidchartwo != -1 || varinvalidcharone != -1)
						{
							alert(elem[i].alt + " tidak boleh menggunakan \' atau \"");
							elem[i].focus();
							StatusAllowSubmit=false	
							return false;
						}
					}
				}
				else if(elem[i].type == "textarea" || elem[i].type == "text")
				{
					//alert(elem[i].type);
					varinvalidcharone = elem[i].value.indexOf('\'');	
					varinvalidchartwo = elem[i].value.indexOf('\"');
					if (varinvalidchartwo != -1 || varinvalidcharone != -1)
					{
						alert(elem[i].alt + " tidak boleh menggunakan \' atau \"");
						elem[i].focus();
						StatusAllowSubmit=false	
						return false;
					}
				}
			}
			
			if(StatusAllowSubmit == true)
			{	
				
				document.getElementById(frmid).action = action;
				
				submitform = window.confirm("Are you sure?")
				if (submitform == true)
				{
					document.getElementById(frmid).submit();
					return true;
				}
				else
				{
					return false;
				} 
			}
			
		}


