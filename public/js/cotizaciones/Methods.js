import {D} from './Domm/Domm.js';

export let Me = {
	prepareResetEditOptions:function(){

		
	},
	resetEditModal:function(options){
		console.log(options);
		D.dom.unvalue('.unvaluable');
		for(let i = 0; i<options.length;i++){
			options[i].removeAttribute('selected');
		}
	},

}