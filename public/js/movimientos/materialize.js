import {D} from './Domm/Domm.js';
export let Mat = {
	loadMaterialize:function(){
		let arr = [];
	    let elems_collapsible = document.querySelectorAll('.collapsible');
		let instances_collapsible = M.Collapsible.init(elems_collapsible);
		arr['collapsibles'] = instances_collapsible;
		var elems_modal = document.querySelectorAll('.modal');
	    var instances_modal = M.Modal.init(elems_modal);
		arr['modals'] = instances_modal;
	    return arr;
	},

	setEventIngresos:function(modal){
		D.addEvent.onClick('.registro_editable',function(e){
			if(e.dataset.ingreso == ''){
				document.getElementById('tipo_movimiento').innerText = 'Ingreso';
			}else{
				document.getElementById('tipo_movimiento').innerText = 'Egreso';
			}
			document.getElementById('ingreso_egreso').innerText = e.dataset.movimiento;
			document.getElementById('fecha').innerText = e.dataset.fecha;
			document.getElementById('pago').innerText = e.dataset.pago;
			document.getElementById('concepto').innerText = e.dataset.concepto;
			document.getElementById('recibo').innerText = e.dataset.recibo;
			document.getElementById('monto').innerText = e.dataset.monto;
			modal.open();
		});

	}
	
}