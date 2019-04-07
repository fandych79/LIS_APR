$(document).ready(function(){

$('#cssmenu > ul > li:has(ul)').addClass("has-sub");

//$('ul').slideDown('normal');
//$('li').addClass('active');

var $aSelected = $('#cssmenu').find('li');

if( $aSelected.hasClass('selected') ){
  //alert( 'FOUND' );
  $('.selected > ul').css({
   'display' : 'block'});
  $('.selected').addClass('active');
  
}

var $bSelected = $('#cssmenu').find('li');

if( $bSelected.hasClass('sub_selected') ){
  //alert( 'FOUND' );
  $('.sub_selected a').addClass('active');
  
}

$('#cssmenu > ul > li > a').click(function() {

	var checkElement = $(this).next();

	$('#cssmenu li').removeClass('active');
	$(this).closest('li').addClass('active');

	if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
		$(this).closest('li').removeClass('active');
		checkElement.slideUp('normal');
	}

	if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
		$('#cssmenu ul ul:visible').slideUp('normal');
		checkElement.slideDown('normal');
	}

	if (checkElement.is('ul')) {
		return false;
	} else {
		return true;	
	}
});

});