// --------------------------------------------------   AJAX LOAD function  --------------------------------------------------


function ajaxShowContentMain(path_chosen)
{
	// replace( /(?:^|\s)opacity0(?!\S)/g , '' );
	document.getElementById("loader").className = "opacity1";

	var contentChange = path_chosen +' #content';
	var menuChange = path_chosen +' #menu';
	$('#content').fadeOut('slow',loadContent);
	$('#menu').fadeOut('slow',loadMenu);

	function loadContent() {
		document.getElementById("content").innerHTML = "";
		$('#page-content').load(contentChange,'',showNewContent());
	}
	function showNewContent() {
		$('#content').fadeIn('slow',hideLoader());
	}
	function loadMenu() {
		$('#menu_container').load(menuChange,'',showNewMenu());
	}
	function showNewMenu() {
		$('#menu').fadeIn('slow', '', removeStyle());
	}
	function hideLoader() {
		// onAjaxSuccess: $('#loader').fadeOut('slow');
		document.getElementById("loader").className = "opacity0";
		document.getElementById("loader").removeAttribute("style");
	}
	function removeStyle() {
		document.getElementById("menu").removeAttribute("style");
	}

	//to change the browser URL to 'path_chosen'
    if(path_chosen!=window.location){
        window.history.pushState({path:path_chosen},'',path_chosen);    
    }

	return false;
}

// ------------------------------------------   AJAX for photos  --------------------------------------------
function goToPhotosFromRoutes(route_path, routeId)
{
	path_chosen = route_path.replace('00000',routeId);  //  00000 because has to be integer

	ajaxShowContentMain(path_chosen);
}


