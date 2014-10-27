// --------------------------------------------------   First function  --------------------------------------------------

function showContentMain(option, path_chosen)
{
	// $('div#event_link').animate({'right' : '1000px'}, {duration : 3000});
	// $('div#tech_link').animate({'left' : '1000px'}, {duration : 3000});
	$('div#event_link').fadeOut('normal');
	$('div#tech_link').fadeOut('normal');
	$('div#event_link').className += "hidden_div";
	$('div#tech_link').className += "hidden_div";

	document.getElementById("loader").className.replace( /(?:^|\s)opacity0(?!\S)/g , '' );
	document.getElementById("loader").className += "opacity1";

	var toLoad = path_chosen +' #content';
	var headerChange = path_chosen +' #breadCrumb';
	$('#content').fadeOut('normal',loadContent);

	function loadContent() {
		$('#content').load(toLoad,'',showNewContent())
	}
	function showNewContent() {
		$('#content').fadeIn('slow',hideLoader());
		$('#breadCrumb').fadeOut('normal',loadHeader);
	}
	function loadHeader() {
		$('#breadCrumb').load(headerChange,'',showNewHeader());
	}
	function showNewHeader() {
		$('#breadCrumb').fadeIn('slow');
	}
	function hideLoader() {
		$('#loader').fadeOut('normal');
		document.getElementById("loader").className.replace( /(?:^|\s)opacity1(?!\S)/g , '' );
		document.getElementById("loader").className += "opacity0";
		// document.getElementById("home_button").className = "";
		// document.getElementById("home_button").className += "opacity1";
		if (option == 'event') {
			document.getElementById("main_title").className = "";
			document.getElementById("main_title").className += "maroon ";
			document.getElementById("footer").className = "";
			document.getElementById("footer").className += "maroon ";
		}
		else if (option == 'tech') {
			document.getElementById("main_title").className = "";
			document.getElementById("main_title").className += "blue ";
			document.getElementById("footer").className = "";
			document.getElementById("footer").className += "blue ";
			document.getElementById("html_body_page").className = "";
			document.getElementById("html_body_page").className += "second_background";
		}
		else {
			return false;
		}
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}

// -------------------------------------------   Second function - Event  -----------------------------------------------

function showContentEvent(id_chosen, path_chosen)
{
	
	document.getElementById("loader").className.replace( /(?:^|\s)opacity0(?!\S)/g , '' );
	document.getElementById("loader").className += "opacity1";

	var toLoad = path_chosen +' #content';
	var headerChange = path_chosen +' #breadCrumb';
	if (id_chosen == 'wed_link') {
		$('button#eve_link_button').fadeOut('normal',loadContent);
		document.getElementById("wed_link").className += "flip_button";
		// $('div#eve_link').animate({rotateY : '90deg'}, {duration : 500});
	}
	else if (id_chosen == 'eve_link') {
		$('button#wed_link_button').fadeOut('normal',loadContent);
		document.getElementById("eve_link").className += "flip_button";
	}

	function loadContent() {
		$('#content').load(toLoad,'',showNewContent())
	}
	function showNewContent() {
		$('#content').fadeIn('slow',hideLoader());
		$('#breadCrumb').fadeOut('normal',loadHeader);
	}
	function loadHeader() {
		$('#breadCrumb').load(headerChange,'',showNewHeader());
	}
	function showNewHeader() {
		$('#breadCrumb').fadeIn('slow');
	}
	function hideLoader() {
		$('#loader').fadeOut('normal');
		document.getElementById("loader").className.replace( /(?:^|\s)opacity1(?!\S)/g , '' );
		document.getElementById("loader").className += "opacity0";
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}
