import {F} from '../global_functions_v2.js';
export let Me = {
	resolveResult:(target)=>{
		let id_asesor = document.getElementById('id_asesor');
		id_asesor.value = target.dataset.id;
	},
	insertarData:(response)=>{

		if(response.data.length !== 0){

			F.dom.emptyNodes('#asesores');
			let asesores = response.data;
			let create = {
				id:'asesores',
				insert:[]
			};
			for(let i = 0; i<asesores.length;i++){
				let nombre_asesor = asesores[i].usuario.persona.nombre+' '+asesores[i].usuario.persona.apellido;
				let insert = {
					tag:'option',
					id:'asesores_'+i,
					attrs:{
						value:asesores[i].usuario.persona.cedula+' '+nombre_asesor
					},
					data:{
						smart_searcher_asesores:asesores[i].usuario.persona.cedula+' '+nombre_asesor,
						id:asesores[i].id
					},
					insert:asesores[i].usuario.persona.cedula+' '+nombre_asesor
				}
				create.insert.push(insert);
			}
			F.dom.createElements(create);
		}
	},
	insertarDataDaf:(response)=>{

		if(response.data.length !== 0){

			F.dom.emptyNodes('#dafs');
			let asesores = response.data;
			let create = {
				id:'dafs',
				insert:[]
			};
			for(let i = 0; i<asesores.length;i++){
				let nombre_asesor = asesores[i].usuario.persona.nombre+' '+asesores[i].usuario.persona.apellido;
				let insert = {
					tag:'option',
					id:'daf_'+i,
					attrs:{
						value:asesores[i].usuario.persona.cedula+' '+nombre_asesor
					},
					data:{
						smart_searcher_daf:asesores[i].usuario.persona.cedula+' '+nombre_asesor,
						id:asesores[i].id
					},
					insert:asesores[i].usuario.persona.cedula+' '+nombre_asesor
				}
				create.insert.push(insert);
			}
			F.dom.createElements(create);
		}
	},
	resolveDaf:(target)=>{
		let id_asesor = document.getElementById('id_daf');
		id_asesor.value = target.dataset.id;
	},	
}