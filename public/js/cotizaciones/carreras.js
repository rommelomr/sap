import {D} from './Domm/Domm.js';
export let Carreras = {
	success:function(e){

		D.dom.emptyNodes('#carreras_options');
		let create = {
			id:'carreras_options',
			insert:[]
		}
		for(let i = 0; i<e.data.length;i++){
			console.log(e.data[i].nombre);
			let element = {
				tag:'option',
				id:'option_'+i,
				attrs:{
					value:e.data[i].nombre
				},
				insert:''
			}
			create.insert.push(element);
		}
		console.log(create);
		D.dom.createElements(create);
		

	},
	error:function(e){
		console.log(e);

	}
}