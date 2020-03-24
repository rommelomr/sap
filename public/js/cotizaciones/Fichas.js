import {F} from '../global_functions.js';
export let Fichas = {
	setAddButtons:function(e){
		F.setValue('#cf-id_cotizacion',e.target.dataset.id_cotizacion);
		let form = document.getElementById('form-crear-ficha');
		form.submit();
	}
}