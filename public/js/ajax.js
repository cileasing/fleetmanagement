function ajaxObj( meth, url ) {
	var x = new XMLHttpRequest();
	x.open( meth, url, true);
	x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
	    return true;	
	}
}

// Load Page Content
  function load_Page(pageToLoad, caller) {
       //$("#partialLoader").load(pageToLoad);
       $('.pageContent').hide();
       $('#' + pageToLoad).show();
       $(".menuitem").removeClass('activeMenu');
       $("#" + caller).addClass('activeMenu');
    }

 function toggle_visibility(id) {

        var e = document.getElementById(id);
        if (e.style.display == 'block') {
            e.style.display = 'none';
        } else {
            e.style.display = 'block';
        }
    }
    
