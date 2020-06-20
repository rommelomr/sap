@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
	
@section('breadcrumbs')
    <a href="#!" class="breadcrumb">Contratos</a>
    <a href="#!" class="breadcrumb">Ver contrato</a>
@endsection
@section('main')
 	<div class="container">
 		<div class="card-panel center">
 			<div class="row">
 				<div class="col s12">
 					<span><h5>Contrato # {{$contrato->id}}</h5></span>
 				</div>
 			</div>
 			<div class="divider"></div>
 			<div class="row">
 				<div class="col s8 offset-s2">
 					<form id="formulario-editar" action="{{route('editar_contrato')}}">
 						<input name="id_contrato" value="{{$contrato->id}}" hidden>
			 			<table class="striped centered">
			 				<tr>
			 					<th>
			 						Numero de contrato
			 					</th>
			 					<td>
			 						<input type="text" value="{{$contrato->numero_contrato}}" class="browser-default col s12" disabled>
			 					</td>
			 				</tr>
			 				<tr>
			 					<th>
			 						Tipo de contrato
			 					</th>
			 					<td>
			 						<select name="id_tipo_contrato" class="browser-default">
			 							@foreach($tipos_contrato as $tipo_contrato)
			 								@if($contrato->id_tipo_contrato == $tipo_contrato->id)
			 									<option value="{{$tipo_contrato->id}}">{{$tipo_contrato->nombre}}</option>
			 								@endif
			 							@endforeach
			 						</select>
			 					</td>
			 				</tr>
			 				<tr>
			 					<th>
			 						Monto
			 					</th>
			 					<td>
			 						<input type="text" name="monto" value="{{$contrato->monto}}" class="browser-default col s12">
			 					</td>
			 				</tr>
			 				<tr>
			 					<th>
			 						Cliente
			 					</th>
			 					<td>
			 						<input type="text" value="{{$contrato->cliente->persona->nombre}} {{$contrato->cliente->persona->apellido}}" class="browser-default col s12" disabled>
			 					</td>
			 				</tr>
			 				<tr>
			 					<th>
			 						Asesor
			 					</th>
			 					<td>
			 						<input type="text" value="{{$contrato->asesor->usuario->persona->nombre}} {{$contrato->asesor->usuario->persona->apellido}}" class="browser-default col s12" disabled>
			 					</td>
			 				</tr>
			 				<tr>
			 					<th>
			 						DAF
			 					</th>
			 					<td>
			 						<input type="text" value="{{$contrato->usuarioDaf->usuario->persona->nombre}} {{$contrato->asesor->usuario->persona->apellido}}" class="browser-default col s12" disabled>
			 					</td>
			 				</tr>
			 				
			 			</table>
			 			<input type="submit" id="boton-enviar" hidden>
 					</form>
			 			<a href="#modal_confirmar_cambios" class="btn green modal-trigger">Guardar cambios</a>
 				</div>
 			</div>
 		</div>

 	</div>
<div class="modal" id="modal_confirmar_cambios">
	<div class="modal-content">
		<span class="center">¿Está seguro que desea guardar los cambios?</span>
	</div>
	<div class="modal-footer">
		<label for="boton-enviar" class="btn green">Estoy seguro</label>
		<button class="btn red modal-close">Cancelar</button>
	</div>
</div>
@endsection
<script>
	window.addEventListener('load',function(){

	    let elems = document.querySelectorAll('.modal');
	    let instances_modal = M.Modal.init(elems);

	    let form = document.getElementById('formulario-editar');
	    form.addEventListener('keyup',function(e){
	    	
	    	if(e.which == 13){
	    		return false;
	    	}
	    })

	});	

</script>