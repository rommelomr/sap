@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
	
@section('head')
	
@endsection
@section('main')
	<div class="row">
		<div class="col s12 l6">
			<div class="card-panel">
				<nav class="blue darken-2">
					<div class="nav-wrapper">
						
						<a href="#" class="brand-logo center">Fichas Académicas</a>
					</div>
					
				</nav>
				<div class="row">
					<div class="col s5 offset-s6">
						<form action="#">
							<div class="input-field">
								<label for="buscar">Cliente</label>
								<input id="buscar" type="text">
								<i class="material-icons prefix">search</i>
							</div>
						</form>
					</div>
				</div>
				<div class="row">
					
					<table class="highlight">
						<thead>
							<tr>
								<th>Nro</th>
								<th>Cliente</th>
								<th>Tiempos</th>
								<th>Registro</th>
								<th>Estado</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							@forelse($fichas as $ficha_consulta)
							<tr>
								<td>{{$ficha_consulta->id}}</td>
								<td>{{$ficha_consulta->cliente->persona->nombre}} {{$ficha_consulta->cliente->persona->apellido}}</td>
								@if($ficha_consulta->fecha_inicio==null)
								<td><a href="#">Dato no definido</a></td>
								@else
								<td>{{substr($ficha_consulta->fecha_inicio,0,10)}} - {{substr($ficha_consulta->fecha_fin,0,10)}}</td>
								@endif
								<td>{{substr($ficha_consulta->created_at,0,10)}}</td>
								@if($ficha_consulta->estado == 0)
									<td>En desarrollo</td>
								@elseif($ficha_consulta->estado == 1)
									<td>Cancelada</td>
								@elseif($ficha_consulta->estado == 2)
									<td>Finalizada</td>
								@endif
								<td>
									<center>
										<a href="{{route('ver_ficha',$ficha_consulta->id)}}"><i class="material-icons">remove_red_eye</i></a>
										<a href="{{ route('ficha_academica_pdf', $ficha_consulta->id)}}" class="tooltipped" data-position="top" data-tooltip="Ver Ficha Academica en PDF"><i class="material-icons">picture_as_pdf</i></a>
										<a href="{{ route('ficha_economica.pdf', $ficha_consulta->id)}}" class="tooltipped" data-position="top" data-tooltip="Ver Ficha Economica en PDF"><i class="material-icons">picture_as_pdf</i></a>
									</center>
								</td>
							</tr>
							@empty
								No se han cargado fichas
							@endforelse
							
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
		@if(!session('index') && isset($ficha))
			<div class="col s12 l6">
				<div class="card-panel">
					<nav class="blue darken-2">
						<div class="nav-wrapper">
							
							<a href="#" class="brand-logo center">Descripción</a>
						</div>
						
					</nav>
					
					<div class="row">
						<div class="col s6">
							<br>
							<center>
								<b>Ficha #{{$ficha->id}}</b>
								<a class='dropdown-trigger btn blue darken-2' data-target='opciones_ficha'>Opciones</a>
								<ul id='opciones_ficha' class='dropdown-content'>
									@if($ficha->id_contrato != null && $id_nivel_usuario === 1)
									    <li>
											<a href="{{route('ficha_economica',$ficha->cotizacion->id)}}" class="modal-trigger"><i class="material-icons">attach_money</i> Pagos</a>
									    </li>
									@endif
								    <li>
										<a href="#modal-comentarios" class="modal-trigger"><i class="material-icons">message</i> Comentario</a>
								    </li>
								    <li>
										<a href="{{route('ficha_academica_pdf',$ficha->id)}}" class="darken-2"><i class="material-icons">picture_as_pdf</i> Exportar</a>
								    </li>
								    <li>
										<a href="#modal-editar-ficha" class="modal-trigger"><i class="material-icons">edit</i> Editar</a>
								    </li>
								</ul>

								
							</center>
							@if($ficha->asesor == null)
							<div class="card red lighten-3" style="padding:1%">
								<center>
									No se puede crear una ficha económica sin antes adjuntar un contrato
								</center>
							</div>
							@endif
							<fieldset>
								<legend>
									<b>Nombre:</b>
								</legend>
								{{$ficha->cliente->persona->nombre}}
							</fieldset>

							<fieldset>
								<legend>
									<b>Datos Personales</b>
								</legend>
								<b>Dirección:</b> {{$ficha->cliente->persona->direccion}}<br>
								<b>email:</b> {{$ficha->cliente->persona->email}}<br>
								<b>Teléfono:</b> {{$ficha->cliente->persona->telefono}}
								<b>Celular:</b> {{$ficha->cliente->persona->celular}}
							</fieldset>

							<fieldset>
								<legend>
									<b>Modalidad:</b>
								</legend>
								@if($ficha->cotizacion->modalidad !==null)
									{{$ficha->cotizacion->modalidad->nombre}}
								@else
									<a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a>
								@endif
							</fieldset>

							<fieldset>
								<legend>
									<b>Nivel Académico:</b>
								</legend>
								@if($ficha->cotizacion->nivelAcademico !==null)
									{{$ficha->cotizacion->nivelAcademico->nombre}}
								@else
									<a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a>
								@endif
							</fieldset>
							
							<fieldset>
								<legend>
									<b>Universidad:</b>
								</legend>
								@if($ficha->cotizacion->universidad !==null)
									{{$ficha->cotizacion->universidad->nombre}}
								@else
									<a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a>
								@endif
							</fieldset>
						</div>
						<div class="col s6">

							<fieldset>
								<legend>
									<b>Datos Académicos:</b>
								</legend>
								@if($ficha->cotizacion->cotizacionPosgrado == null)
									@if($ficha->cotizacion->cotizacionGeneral->id_facultad !==null)
										<b>Facultad:</b> {{$ficha->cotizacion->cotizacionGeneral->facultad->nombre}}<br>
									@else
										<b>Facultad:</b> <a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a><br>
									@endif
									@if($ficha->cotizacion->cotizacionGeneral->id_carrera !==null)
										<b>Carrera:</b> {{$ficha->cotizacion->cotizacionGeneral->carrera->nombre}}<br>
									@else
										<b>Carrera:</b> <a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a><br>
									@endif
								@else
										<b>Facultad:</b>N/A<br>
										<b>Carrera:</b> N/A<br>
								@endif


								@if($ficha->cotizacion->id_profesion !==null)
									<b>Profesión:</b> {{$ficha->cotizacion->profesion->nombre}}<br>
								@else
									<b>Profesión:</b> <a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a><br>
								@endif
								@if($ficha->cotizacion->curso !==null)
									<b>Curso:</b> {{$ficha->cotizacion->curso->nombre}}
								@else
									<b>Curso:</b> <a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a>
								@endif
								<br>
								@if($ficha->cotizacion->nivelAcademico !==null)
									<b>Nivel:</b> {{$ficha->cotizacion->nivelAcademico->nombre}}
								@else
									<b>Nivel:</b> <a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a>
								@endif
							</fieldset>

							<fieldset>
								<legend>
									<b>Plazo de Ejecución:</b>
								</legend>
								<b>Monto Total:</b> 
								{{$ficha->cotizacion->precio_total}} <br>
								<b>Días calendario:</b> 
								@if($ficha->fecha_inicio !==null && $ficha->fecha_fin !== null)
								<?php 
							        $date_uno = date_create($ficha->fecha_inicio);
							        $date_dos = date_create($ficha->fecha_fin);
							        $date = date_diff($date_uno,$date_dos)->format('%a');
								 ?>
									<span>{{$date}}</span>
								@else
									<a href="#modal-editar-ficha" class="modal-trigger">Dato no definido</a>
								@endif
								<br>
								<b>Avance:</b> 
									<a class="tooltipped" data-tooltip="Actualizar avance" data-position="top" href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}" class="modal-trigger">
										@if($ficha->cotizacion->avance != null)
											{{$ficha->cotizacion->avance}}
										@else
											0
										@endif
									</a>
								<br>
								@if($ficha->fecha_inicio !==null)
									<b>Fecha Inicio:</b> <span><a href="#modal-editar-ficha" class="modal-trigger">{{$ficha->fecha_inicio}}</a></span> <br>
								@else
									<b>Fecha Inicio:</b> <a href="#modal-editar-ficha" class="modal-trigger">Dato no definido</a><br>
								@endif
								@if($ficha->fecha_fin !==null)
									<b>Fecha Fin:</b> <span><a href="#modal-editar-ficha" class="modal-trigger">{{$ficha->fecha_fin}}</a></span>
								@else
									<b>Fecha Fin:</b> <a href="#modal-editar-ficha" class="modal-trigger">Dato no definido</a>
								@endif
							</fieldset>
							<fieldset>
								<legend>
									<b>Etapa:</b>
								</legend>
								@if($ficha->etapa !==null)
									{{$ficha->etapa->nombre}}
								@else
									<a href="#modal-editar-ficha" class="modal-trigger">Dato no definido</a>
								@endif
							</fieldset>
							
							<fieldset>
								<legend>
									<b>Asesor:</b>
								</legend>
								@if($ficha->asesor !==null)
									{{$ficha->asesor->usuario->persona->nombre}}
								@else
									No se ha realizado ningun contrato
									<a href="#modal-contratos" class="modal-trigger">Adjuntar Contrato</a>
								@endif
							</fieldset>

							<fieldset>
								<legend>
									<b>Número de registros:</b>
								</legend>
								<b>N° Cotización:</b>
								@if($ficha->cotizacion->numero_cotizacion !==null)
									<span>{{$ficha->cotizacion->numero_cotizacion}}</span>
								@else
									<a href="{{asset('cotizacion').'/'.$ficha->cotizacion->id}}">Dato no definido</a>
								@endif
								<br>
								<b>Id Cotización:</b> <span>{{$ficha->cotizacion->id}}</span>
								<br>
								@if($ficha->contrato !==null)
									<b>N° Contrato:</b> {{$ficha->contrato->numero_contrato}}
								@else
									<b>N° Contrato:</b> <a href="#modal-contratos" class="modal-trigger">Dato no definido</a>
								@endif
								<br>
								@if($ficha->contrato !==null)
									<b>Id Contrato:</b> <span>{{$ficha->contrato->id}}</span>
								@else
									<b>Id Contrato:</b> <a href="#modal-contratos" class="modal-trigger">Dato no definido</a>
								@endif
								<br>
							</fieldset>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
	@if(!session('index') && isset($ficha))
		<div id="modal-editar-ficha" class="modal bottom-sheet modal-fixed-footer">
			<div class="modal-content" style="padding: 0;">
				<div class="row" >
						<form action="{{route('editar_ficha')}}" method="post" id="editar-ficha-form">
							<input hidden name="edit_id" id="edit_id" value="{{$ficha->id}}">
							@csrf
							<div class="col s6">
								<div class="input-field">
									@if(old('edit_fecha_inicio'))
										<input type="date" id="edit_fecha_inicio" name="edit_fecha_inicio" value="{{old('edit_fecha_inicio')}}">
									@else
										<input type="date" id="edit_fecha_inicio" name="edit_fecha_inicio" value="{{$ficha->fecha_inicio}}">
									@endif
									<span class="helper-text">Fecha inicio</span>
								</div>
							</div>
							<div class="col s6">
								<div class="input-field">
									@if(old('edit_fecha_fin'))
										<input type="date" id="edit_fecha_fin" name="edit_fecha_fin" value="{{old('edit_fecha_fin')}}">
									@else
										<input type="date" id="edit_fecha_fin" name="edit_fecha_fin" value="{{$ficha->fecha_fin}}">
									@endif
									<span class="helper-text">Fecha finalización</span>
								</div>
							</div>
							<div class="col s6">
								<div class="input-field">
									<select id="edit_id_etapa" name="edit_id_etapa" class="browser-default">
										<option disabled selected>Etapa</option>
										@forelse($etapas as $etapa)
											<option value="{{$etapa->id}}">{{$etapa->nombre}}</option>
										@empty
										@endforelse
									</select>
								</div>
							</div>
							<div class="col s6">
								<center>
									<button class="btn blue darken-2">Guardar Cambios</button>
								</center>
							</div>
						</form>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
			</div>
		</div>
		<div id="modal-comentarios" class="modal modal-fixed-footer">
			<div class="modal-content">
				<div class="row">
					<div class="col s10">
						Observaciones
					</div>	
					<div class="col s2">
						<a href="#!" class="right modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
					</div>	
				</div>
				<div class="row">
					<div class="col s12">
						@forelse($observaciones as $observacion)
							<fieldset>
								<legend>
									<b> {{$observacion->created_at}} </b>
								</legend>
								{{$observacion->observacion}}
							</fieldset>
						@empty
							No se han realizado observaciones
						@endforelse
						@if($observaciones != [])
							{{$observaciones->links()}}
						@endif

					</div>
				</div>
			</div>
			<div class="modal-footer" style="margin:0;padding:0">
				<div class="row" style="margin:0;padding:0">
					<form action="{{route('agregar_observacion')}}" method="POST" style="margin:0;padding:0">
						@csrf
						<input hidden value="{{$ficha->id}}" name="id_ficha">
						<div class="input-field col s10">
							<label for="comentario">Agregar Observacion</label>
							<input type="text" id="comentario" name="observacion">
							<input hidden type="submit">
						</div>
					</form>
				</div>
			</div>
		</div>
		<div id="modal-contratos" class="modal modal-fixed-footer">
			<div class="modal-content">
				<div class="row">
					<div class="col s10">
						<h5>Crear contrato</h5>
					</div>	
					<div class="col s2">
						<a href="#!" class="right modal-close waves-effect waves-green btn-flat"><i class="material-icons">close</i></a>
					</div>	
				</div>
				<div class="row">
					<form action="{{route('crear_contrato')}}" method="POST">
						@csrf
						<div class="input-field col s12">
							@if(old('id_asesor'))
								<input hidden id="id_asesor" type="text" name="id_asesor" value="{{old('id_asesor')}}">
							@else
								<input hidden id="id_asesor" type="text" name="id_asesor">
							@endif

							@if(old('asesor'))
								<input id="buscar_asesor" type="text" list="asesores" name="asesor" value="{{old('asesor')}}">
							@else
								<input id="buscar_asesor" type="text" list="asesores" name="asesor">
							@endif
							<datalist id="asesores">
								@foreach($asesores as $asesor)
									<option data-smart_searcher_asesores="{{$asesor->usuario->persona->cedula}} {{$asesor->usuario->persona->nombre}} {{$asesor->usuario->persona->apellido}}" value="{{$asesor->usuario->persona->cedula}} {{$asesor->usuario->persona->nombre}} {{$asesor->usuario->persona->apellido}}" data-id="{{$asesor->id}}"></option>
								@endforeach
							</datalist>
							<span class="helper-text">Asesor</span>
						</div>
						<div class="input-field col s12 l6">
							<select name="id_tipo_contrato" class="browser-default">
								<option disabled selected>Tipo Contrato</option>
									@foreach($tipos_contrato as $tipo_contrato)
										<?php $old = old('id_tipo_contrato');?>
										@if(($old) && ($old == $tipo_contrato->id))
											<option selected value="{{$tipo_contrato->id}}">{{$tipo_contrato->nombre}}</option>
										@else
											<option value="{{$tipo_contrato->id}}">{{$tipo_contrato->nombre}}</option>
										@endif
									@endforeach
							</select>
						</div>
						<div class="input-field col s12 l6">
							@if(old('monto'))
								<input type="text" name="monto" value="{{old('monto')}}">
							@else
								<input type="text" name="monto">
							@endif
							<span class="helper-text">Monto</span>
						</div>
						<div class="input-field col s12">
							@if(old('id_daf'))
								<input hidden id="id_daf" type="text" name="id_daf" value="{{old('id_daf')}}">
							@else
								<input hidden id="id_daf" type="text" name="id_daf">
							@endif
							@if(old('buscar_daf'))
								<input id="buscar_daf" type="text" list="dafs" name="buscar_daf" value="{{old('buscar_daf')}}">
							@else
								<input id="buscar_daf" type="text" list="dafs" name="buscar_daf">
							@endif
							<datalist id="dafs">
								@foreach($asesores as $asesor)
									<option data-smart_searcher_daf="{{$asesor->usuario->persona->cedula}} {{$asesor->usuario->persona->nombre}} {{$asesor->usuario->persona->apellido}}" value="{{$asesor->usuario->persona->cedula}} {{$asesor->usuario->persona->nombre}} {{$asesor->usuario->persona->apellido}}" data-id="{{$asesor->id}}"></option>
								@endforeach
							</datalist>
							<span class="helper-text">DAF</span>
						</div>
						<div class="input-field col offset-s5">
							<button class="btn s12">Guardar</button>
						</div>
						<input hidden name="id_ficha" value="{{$ficha->id}}">
					</form>
				</div>
			</div>
		</div>

	@endif
<script type="module">
		import {Materialize} from '{{asset("js/fichas/materialize.js")}}';
		window.addEventListener('load',function(){

	    	<?php $messages = session('messages') ? session('messages') : [];?>
	    	@forelse($messages as $message)

	    		M.toast({html:"{{$message}}"});
	    	@empty
	    	@endforelse

			let main = Materialize.main();
			@if(session('contrato'))
	    		main.modals[3].open();
	    		@php session()->forget('contrato'); @endphp
			@endif
			@if(session('editar_ficha'))
	    		main.modals[1].open();
	    		@php session()->forget('editar_ficha'); @endphp
			@endif
			
			@if ($errors->any())
	            @foreach ($errors->all() as $error)
	    			M.toast({html:"{{$error}}"});
	            @endforeach
			@endif
	    	@if($errors->has('observacion'))
	    		main.modals[2].open();
	    	@endif
		    @if(isset($_GET['page']))
		    	main.modals[2].open();
		    @endif

		});

</script>
<script src="{{asset('js/fichas/main.js')}}" type="module"></script>
@endsection
@php
	session()->forget('index');
@endphp