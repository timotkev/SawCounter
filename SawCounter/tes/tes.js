

$(document).ready(function()
{
	
	
	$("#dialog").dialog(
	{
		autoOpen: false,
		width: 400,
		modal: true,
		buttons: 
		[
			{
				text: "OK",
				click: function()
				{
					$(this).dialog("close");
				}
			},
			{
				text: "Cancel",
				click: function()
				{
					$(this).dialog("close");
				}
			}
		]

	});

	$( "#dialog" ).dialog( "open" );


	
		
		//event.preventDefault();
	
});
/*
	
	*/