<div style="text-align:center;">
<input type="button" id="btn_print" name="btn_print" value="Print" onclick="onPrint()" class="button" />
<script type="text/javascript">
	function onPrint()
	{
		$(":button").css("display","none");
		$("#linkblacklist").css("display","none");
		$("#approvepermission").css("display","none");
		$(".unprint").css("display","none");
		window.print();
	}
</script>
</div>