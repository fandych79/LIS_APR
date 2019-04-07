   	  function changeMenu(theid)
   	  {
   	  	document.formsec.action = "./script/" + theid;
   	  	document.formsec.submit();
   	  }
   	  function changeMenu2(theid)
   	  {
   	  	document.formsec.action = "./script/" + theid;
   	  	document.formsec.userprogramact.value = theid;
   	  	document.formsec.submit();
   	  }
