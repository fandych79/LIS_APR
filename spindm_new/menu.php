<?php
# Copyright 2012
# Written by : PPC Team
# Leader     : Budi Hartoyo

/*
<script language=JavaScript>
<!--

//Disable right mouse click Script
//By Maximus (maximus@nsimail.com) w/ mods by DynamicDrive
//For full source code, visit http://www.dynamicdrive.com

var message="Function Disabled!";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("alert(message);return false")

// --> 
</script>
*/
?>

      <div id="header">
        <div id="masthead">
        	 <img src="Source/img/header.jpg" width="960" height="77" alt="E-Filling System">
           <form name=formsec method=post>
           	  <input type=hidden name=userid value='<? echo $userid ?>'>
           	  <input type=hidden name=userpwd value='<? echo $userpwd ?>'>
           	  <input type=hidden name=username value='<? echo $username ?>'>
           	  <input type=hidden name=userorganization value='<? echo $userorganization ?>'>
           	  <input type=hidden name=act value='signout'>
          </form>
<script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryMenuBarDownHover.gif", imgRight:"SpryMenuBarRightHover.gif"});
var MenuBar2 = new Spry.Widget.MenuBar("MenuBar2", {imgRight:"SpryMenuBarRightHover.gif"});
function changeMenu(theappl)
{
	document.formsec.action = "./" + theappl;
	document.formsec.submit();
}
//-->
</script>
        </div>
      </div>

<?
