window.addEventListener('load',function(){
    let elems_collapsible = document.querySelectorAll('.collapsible');
	let instances = M.Collapsible.init(elems_collapsible);

	let elems_select = document.querySelectorAll('select');
    let instances_select = M.FormSelect.init(elems_select);
});