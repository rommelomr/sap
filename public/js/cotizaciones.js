document.addEventListener('DOMContentLoaded', function() {
	var select = document.querySelectorAll('select');
	var instances = M.FormSelect.init(select);

	var tab_el = document.querySelectorAll('.tabs');
	var tabs = M.Tabs.init(tab_el[0]);

	if(modal){
		var elems = document.querySelectorAll('.modal');
	    var instances = M.Modal.init(elems,{
	    	'startingTop' : '1%',
	    	'endingTop' : '1%',
	    });
	    instances[1].open();
	}
});
