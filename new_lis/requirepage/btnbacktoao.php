<?

	if($userpermission=="A")
	{
		echo '
		<script type="text/javascript" src="../js/jquery-1.7.2.min.js" ></script>
		<script type="text/javascript">
			function validation()
			{	
				var approvepermission=$("#approvepermission").val();
				var note=$("#note").val();
				if (approvepermission == "")
				{
					alert("Pilih Konfirmasi.");
					$("#approvepermission").focus();
				}
				else
				{
					if (note=="")
					{
						alert("Note harus di isi.");
						$("#note").focus();
					}
					else
					{
						//alert("masuk save flow.");
						document.getElementById("frm").action = "../../requirepage/do_saveflowview.php";
						submitform = window.confirm("SAVE FLOW?")
						if (submitform == true)
						{
							document.getElementById("frm").submit();
							return true;
						}
						else
						{
							return false;
						}
					}
				}
			}
			function showtextshowtext()
			{
				var approvepermission=$("#approvepermission").val();
				if (approvepermission == "")
				{
					document.getElementById("confirmation").style.display="none";
					document.getElementById("note").value="";
				}
				else
				{
					
					document.getElementById("confirmation").style.display="block";
					document.getElementById("note").value="";
					$("#note").focus();
					if (approvepermission=="A")
					{
					document.getElementById("btnconfirm").value="APPROVE";
					}
					else if (approvepermission=="R")
					{
					document.getElementById("btnconfirm").value="Back To AO";
					}
				}
			}
		</script>
		
		<select id="approvepermission" name="approvepermission" style="width:150px;" onchange="showtextshowtext();">
		<option value=""> -- Pilih Confirmation -- </option>'.$optionall.'
		</select>
		
		<div style="display:none;" id="confirmation" style="width:300px;">
		<input type="text" name="note" id="note" maxlength="40">
		<input type="button" id="btnconfirm" name="btnconfirm" value="" style="width:300px;" class="button" onclick="validation();"/>
		</div>
		';
	}
	else
	{
		echo '
		<script type="text/javascript">
			function validation()
			{					
				document.getElementById("frm").action = "../../requirepage/do_saveflowview.php";
				submitform = window.confirm("SAVE FLOW?")
				if (submitform == true)
				{
					document.getElementById("frm").submit();
					return true;
				}
				else
				{
					return false;
				}
			}
		</script>
		<input type="button" id="btnsumbit" name="btnsumbit" value="Submit" style="width:300px;" class="button" onclick="validation();"/>
		';
	}
?>