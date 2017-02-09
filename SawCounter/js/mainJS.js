function showPass()
{
	
	var checkBox = document.getElementById('passField');
	if(checkBox.checked == false)
	{
		checkBox.setAttribute('type', 'text');
		//alert(checkBox.checked);
		checkBox.checked = true;
	}
		
	else
	{
		checkBox.setAttribute('type', 'password');
		checkBox.checked = false;
	}
	
	//alert(document.getElementsByClassName('checkBox').innerHTML);
	//alert('tes');

}

$(document).ready(function()
{
	$('#menu').menu();
});

function ubahFunction()
{
	$(document).ready(function()
	{
			$('#editForm').dialog('open');
			//alert('asdf');
	});
}

$(document).ready(function()
{
	
	$('#editForm').dialog(
	{
		autoOpen:false,
		width:300,
		modal: true,
		buttons:
		[
			{
				text: "Cancel",
				click: function()
				{
					$(this).dialog("close");
				}
			},
			{
				text: "Submit Form",

				click: function()
				{
					$('#myForm').submit();
					//$(this).dialog("close");
				}
			}
		]
	});
	

	
	
});

$(document).ready(function()
{
	$('#about-us').dialog(
	{
		autoOpen:false,
		width:600,
		modal: true,
		buttons:
		[
			{
				text: "Close",
				click: function()
				{
					$(this).dialog("close");
				}
			}
		]
	});
	
	//$().on();
	
	$('#question').click(function()
	{
		$('#about-us').dialog('open');
	});
	
});

$(document).ready(function()
{
	$('.helpText').dialog(
	{
		autoOpen:false,
		width:600,
		modal: true,
		buttons:
		[
			{
				text: "Close",
				click: function()
				{
					$(this).dialog("close");
				}
			}
		]
	});
	
	//$().on();
	
	$('.help').click(function()
	{
		$('.helpText').dialog('open');
	});
	
});



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

function loadPemasok()
{
	var selectedIDProduct = document.getElementById('fieldSKU').value;
	//alert(selectedIDProduct);
	
	
	var xHttp = new XMLHttpRequest();
	xHttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			document.getElementById('textAjax').innerHTML = this.responseText;
		}
	};
	xHttp.open('GET', 'database/managePemasok.php?whatever='+ selectedIDProduct, true);
	//xHttp.open('GET', 'tes/tes.php', true);
	//xHttp.send();
	//xHttp.open('GET', 'tes/test2.php', true);
	xHttp.send();
	
}

function loadBobot()
{
	var selectedIDProduct = document.getElementById('fieldSKU').value;
	//alert(selectedIDProduct);
	
	
	var xHttp = new XMLHttpRequest();
	xHttp.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			document.getElementById('textAjax').innerHTML = this.responseText;
		}
	};
	xHttp.open('GET', 'database/manageBobot.php?whatever='+ selectedIDProduct, true);
	//xHttp.open('GET', 'tes/tes.php', true);
	//xHttp.send();
	//xHttp.open('GET', 'tes/test2.php', true);
	xHttp.send();
	
}

function editSukses()
{
	//alert('data berhasil diedit');
	//document.getElementById('textAjax').innerHTML='hehehe';
	$("#dialogEditSukses").css("color", "black");
		$("#dialogEditSukses").dialog(
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

	$( "#dialogEditSukses" ).dialog( "open" );
	
}

$(document).ready(function()
{
	$(".tambah").click(function()
	{
		var node = document.getElementById('selectBox');
		var fieldsetX = document.createElement('fieldset');
		var label1 = document.createElement('label');
		var textNode1 = document.createTextNode('Masukkan Pemasok: ');
		label1.appendChild(textNode1)
		fieldsetX.appendChild(label1);
		
		
		var select1 = document.createElement('select');
		
		
		
		var xHttp = new XMLHttpRequest();
		xHttp.onreadystatechange = function()
		{
			if(this.readyState == 4 && this.status == 200)
			{

				var option1 = document.createElement('option');
				var splitan = this.responseText.split('</option><option>');
				
				var cariSplit = splitan.substr(1,4);
				//var textNodeA = splitan.split('</option>');
				//var xxx = 'asdfasdfasdf';
				
				alert('s');

			}

		};
		xHttp.open('GET', 'database/selectOption.php', true);
		xHttp.send();
		

		fieldsetX.appendChild(select1);
		
		node.appendChild(fieldsetX);
		
	});
	
	$(".kurang").click(function()
	{
		var node = document.getElementById('selectBox');
		var selectedChild = node.childElementCount;
		//alert(selectedChild);
		node.removeChild(node.children[selectedChild - 1]);
		//var childTerakhir = node.lastChild.value;
		//var childTerakhir = node.childElementCount;
		/*
		var s = '';
		var i = 0;
		while(i<4)
		{
			var childTerakhir = node.children[i].nodeName;
			s = s + String(childTerakhir);
			i++;
		}
		
		
		alert(s);
		*/
	});
	
	$(document).tooltip(
	{
		position:
		{
			my: "center bottom-20",
			at: "center top",
			using: function(position, feedback)
			{
				$(this).css(position);
				$("<div>")
					.addClass("arrow")
					.addClass(feedback.vertical)
					.addClass(feedback.horizontal)
					.appendTo(this);
			}
		}
	});
});