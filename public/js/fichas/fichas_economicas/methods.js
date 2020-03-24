import {D} from './Domm/Domm.js';
export let Me = {
	sendForm:function(data){


		let input_monto = document.getElementById('input_monto');
		let monto = document.getElementById(data.dataset.input);
		input_monto.value = monto.value;

		let input_tipo = document.getElementById('input_tipo');
		input_tipo.value = data.dataset.tipo;

		let input_id = document.getElementById('input_id');
		console.log(data.dataset);
		input_id.value = data.dataset.id_pago;


		let form = document.getElementById('update_form');
		form.setAttribute('action','/actualizar_pago');
		form.submit();
	},
	enableInputEdit:function(data){
		let save_button = document.getElementById(data.dataset.button_brother);
		save_button.removeAttribute('disabled');
		let input = document.getElementById(data.dataset.input_brother);
		input.removeAttribute('disabled');
		

	},
	configurePayCard:function(data){

		if(data.dataset.tipo == 'asesor'){
			document.getElementById('container_asesor').removeAttribute('hidden');
			let container_cliente = document.getElementById('container_cliente');
			if(!container_cliente.hasAttribute('hidden')){
				container_cliente.setAttribute('hidden',true);
			}
		}else{
			document.getElementById('container_cliente').removeAttribute('hidden');
			let container_asesor = document.getElementById('container_asesor');
			if(!container_asesor.hasAttribute('hidden')){
				container_asesor.setAttribute('hidden',true);
			}
		}
	},
	init:function(){
		D.addEvent.onClick('.editar',this.enableInputEdit);
		D.addEvent.onClick('.guardar',this.sendForm);
		D.addEvent.onClick('.registrar_pago',this.configurePayCard);
	}

}