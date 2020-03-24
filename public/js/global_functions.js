export let F = {
	
	onClick:function(el,f){
		let dom_elems = document.querySelectorAll(el);
		for(let i=0; i<dom_elems.length;i++){
			dom_elems[i].onclick = f;
		}
	},
	getDataset:function(el){
		return document.getElementById(el).dataset;
	},
	setValue:function(elems,data){
		let dom_elems = document.querySelectorAll(elems);
		for(let i=0; i<dom_elems.length;i++){
			dom_elems[i].value = data;
		}
	},
	
	
}