import {F} from '../global_functions_v2.js';
import {Me} from './methods.js';

	F.initSearcher({
		url:'/buscarAsesorAjax',
		id_input:'#buscar_asesor',
		id_value:'#id_asesor',
		data_identifier:'smart_searcher_asesores',
		success:Me.insertarData,
		setInputMatch:Me.resolveResult,
	});
	F.initSearcher({
		url:'/buscarAsesorAjax',
		id_input:'#buscar_daf',
		id_value:'#id_daf',
		data_identifier:'smart_searcher_daf',
		success:Me.insertarDataDaf,
		setInputMatch:Me.resolveDaf,
	});