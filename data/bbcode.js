function insertTag(tagName, hasAttribute, isDouble) {

    var textarea = document.forms['photo'].elements['text'];

    if(document.selection)
    {
        var Selection = document.selection.createRange();
        var SelectionlLength = Selection.text.length;
        Selection.moveStart("character", -textarea.value.length);
        textarea.selectionStart = Selection.text.length - SelectionlLength;
        textarea.selectionEnd = textarea.selectionStart + SelectionlLength;
    }

    var openTag = '';
    if(hasAttribute == false)
        openTag = '[' + tagName + ']';
    var closeTag = '[/' + tagName + ']';

    var txt = new Array();
    if(typeof(textarea.selectionStart) == 'number' && typeof(textarea.selectionEnd) == 'number')
    {
        txt[0] = textarea.value.substring(0, textarea.selectionStart);
        txt[1] = openTag + textarea.value.substring(textarea.selectionStart, textarea.selectionEnd) + ((isDouble == true) ? closeTag : '');
        txt[2] = textarea.value.substring(textarea.selectionEnd);
        textarea.value = txt[0] + txt[1] + txt[2];
    }

    textarea.focus();

}

function colors(tagName, hasAttribute, isDouble) {

    var textarea = document.forms['photo'].elements['text'];

    if(document.selection)
    {
        var Selection = document.selection.createRange();
        var SelectionlLength = Selection.text.length;
        Selection.moveStart("character", -textarea.value.length);
        textarea.selectionStart = Selection.text.length - SelectionlLength;
        textarea.selectionEnd = textarea.selectionStart + SelectionlLength;
    }

    var openTag = '';
    if(hasAttribute == false)
        openTag = '[' + tagName + ']';
    var closeTag = '[/color]';

    var txt = new Array();
    if(typeof(textarea.selectionStart) == 'number' && typeof(textarea.selectionEnd) == 'number')
    {
        txt[0] = textarea.value.substring(0, textarea.selectionStart);
        txt[1] = openTag + textarea.value.substring(textarea.selectionStart, textarea.selectionEnd) + ((isDouble == true) ? closeTag : '');
        txt[2] = textarea.value.substring(textarea.selectionEnd);
        textarea.value = txt[0] + txt[1] + txt[2];
    }

    textarea.focus();

}

function BBCurl() {
	 var textarea = document.forms['photo'].elements['text'];
	 if(document.selection)
    {
        var Selection = document.selection.createRange();
        var SelectionlLength = Selection.text.length;
        Selection.moveStart("character", -textarea.value.length);
        textarea.selectionStart = Selection.text.length - SelectionlLength;
        textarea.selectionEnd = textarea.selectionStart + SelectionlLength;
    }
	var FoundErrors = '';
	var enterURL   = prompt("Wpisz swój adres URL", "");
	//var enterTITLE = prompt("Wpisz nazwę do wyświetlenia", "Nazwa");
	if (!enterURL)    {
		FoundErrors += " Nie wpisałeś adresu URL!";
	}
	//if (!enterTITLE)  {
	//	FoundErrors += " Nie wpisałeś nazwy do wyświetlenia!";
	//}
	if (FoundErrors)  {
		alert("Error!"+FoundErrors);
		return;
	}
		var txt = new Array();
    if(typeof(textarea.selectionStart) == 'number' && typeof(textarea.selectionEnd) == 'number')
    {
	var ToAdd = "[URL="+enterURL+"]"+enterURL+"[/URL]";
	{
        txt[0] = textarea.value.substring(0, textarea.selectionStart);
        txt[1] = ToAdd;
        txt[2] = textarea.value.substring(textarea.selectionEnd);
        textarea.value = txt[0] + txt[1] + txt[2];
    }
	}
 	textarea.focus();
}
function emotki(value)
{
	var textarea = document.forms['photo'].elements['text'];
	if(document.selection)
    {
        var Selection = document.selection.createRange();
        var SelectionlLength = Selection.text.length;
        Selection.moveStart("character", -textarea.value.length);
        textarea.selectionStart = Selection.text.length - SelectionlLength;
        textarea.selectionEnd = textarea.selectionStart + SelectionlLength;
    }
		
		var txt = new Array();
    if(typeof(textarea.selectionStart) == 'number' && typeof(textarea.selectionEnd) == 'number')
    {
        txt[0] = textarea.value.substring(0, textarea.selectionStart);
        txt[1] = value;
        txt[2] = textarea.value.substring(textarea.selectionEnd);
        textarea.value = txt[0] + txt[1] + txt[2];
    }

	
	textarea.focus();
}
			
function BBCimg() {
	 var textarea = document.forms['photo'].elements['text'];
	 if(document.selection)
    {
        var Selection = document.selection.createRange();
        var SelectionlLength = Selection.text.length;
        Selection.moveStart("character", -textarea.value.length);
        textarea.selectionStart = Selection.text.length - SelectionlLength;
        textarea.selectionEnd = textarea.selectionStart + SelectionlLength;
    }
	var FoundErrors = '';
	var enterURL   = prompt("Wpisz adres URL obrazka", "http://");
	if (!enterURL)    {
		FoundErrors += " Nie wpisałeś adresu URL!";
	}
	if (FoundErrors)  {
		alert("Error!"+FoundErrors);
		return;
	}
		var txt = new Array();
    if(typeof(textarea.selectionStart) == 'number' && typeof(textarea.selectionEnd) == 'number')
    {
	var ToAdd = "[img="+enterURL+"]";
	{
        txt[0] = textarea.value.substring(0, textarea.selectionStart);
        txt[1] = ToAdd;
        txt[2] = textarea.value.substring(textarea.selectionEnd);
        textarea.value = txt[0] + txt[1] + txt[2];
    }
	}
 	textarea.focus();
}

