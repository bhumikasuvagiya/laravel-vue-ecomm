$(document).ready(function(e)
{
	$("#del_chk").on('change',function()
	{
		if($('#del_chk').is(':checked'))
		{
		 	$('.all_del').prop('checked',true);
		}
		else
		{
			$('.all_del').prop('checked',false);	
		}
	});
	
});	
function giveNotation(textToShow)
{
	if(textToShow == null || textToShow == "undefined")
		textToShow = "Please select items to remove.";
		
	var bvm=0;
	 $(".all_del").each(function (i) {
    	isChecked = $(".all_del").is(':checked');
		if(isChecked)
		{
			bvm++;
		} 
	});
	
	if(bvm == 0)
	{
		alert(textToShow);
		return false;
	}
	else
		return confirm("Are You Sure?");
}
function show_message(msg)
{
	$('.kg-success-message').css("display", "block");
	$('.kg-success-message').html(msg);
	
	setTimeout(function(){ 
		$('.kg-success-message').css("display", "none");
	}, 5000);
}