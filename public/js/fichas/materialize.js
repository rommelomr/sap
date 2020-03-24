export let Materialize = {

	configureMaterialize:function(){

			//Tooltips
	    let elems_tooltip = document.querySelectorAll('.tooltipped');
    	let instances_tooltip = M.Tooltip.init(elems_tooltip);

		let elems = document.querySelectorAll('.modal');
	    let instances_modal = M.Modal.init(elems);

		let elems_dropdown = document.querySelectorAll('.dropdown-trigger');
	    let instances = M.Dropdown.init(elems_dropdown);

	    let elems_collapsible = document.querySelectorAll('.collapsible');
    	let instances_collapsible = M.Collapsible.init(elems_collapsible);
    	return {
    		tooltips:instances_tooltip,
    		modals:instances_modal
    	};
	},

	main:function(){
		return this.configureMaterialize();
	}	


}