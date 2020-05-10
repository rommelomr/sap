import {F} from '../global_functions.js';
import {Fichas} from './Fichas.js';
import {Carreras} from './carreras.js';
import {D} from './Domm/Domm.js';
window.addEventListener('load',function(){

	F.onClick('.crear-ficha',Fichas.setAddButtons);

	D.addEvent.onChange('#facultades',function(e){
		//console.log(e.value);
		D.getAjax({
			url:'/filtrar_carreras',
			asyn:true,
			params:{
				id:e.value
			},
			success:Carreras.success,
			error:Carreras.error,
		});
	});
	/*
	*/
});