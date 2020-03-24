@extends('layouts.app')
@extends('layouts.navbar')
@section('head')
	<link rel="stylesheet" href="{{asset('css/cotizaciones.css')}}">
@endsection
@section('main')
@extends('layouts.menu')
  <div class="row">
    <div class="col s12 l10 offset-l1 card-panel">
    	<ul class="tabs">

      		<li class="tab col s6">
      			@if(session('tab')===2)
      				<a href="#test1" class="active">Cotizaciones</a>
      			@else
      				<a href="#test1">Cotizaciones</a>
      			@endif
      		</li>
        	<li class="tab col s6">
        		@if($errors->has('id_cliente') || $errors->has('precio') || (session('tab')===1))
        			<a class="active" href="#test2">Crear Cotizacion</a>
        		@else
        			<a href="#test2">Crear Cotizacion</a>
        		@endif
        		
        	</li>
      	</ul>
	    <div id="test1" class="col s12 l10 offset-l1">
	    	<div class="row">
	    		<div class="col s12">
	    			<div class="card-panel">
	    				
						<div class="row">
							<div class="col l3 offset-l8 s6 offset-s3" align="right">
								<!--form action="{{route("cotizaciones")}}" method="post"-->
								<form action="{{route("buscarCotizaciones")}}" method="get">
									@csrf
									<div class="input-field">
										<label for="buscar">Buscar</label>
										<input id="buscar_cotizacion" type="submit" name="buscar" hidden>


										<input id="buscar" type="text" name="buscar" value="" for="buscar_cotizacion">
										<i for="buscar_cotizacion" class="prefix material-icons">search</i>
										<span class="helper-text"><a href="{{route('cotizaciones')}}">Ver todas las cotizaciones</a></span>
									</div>
								</form>
							</div>
				    	</div>
				    	
						<div class="row">
					    	<table class="highlight centered">
					    		<thead>
					    			<tr>
					    				<th>Nro</th>
					    				<th>N° Cotización</th>
					    				<th>Cliente</th>
					    				<th>Identificacion</th>
					    				<th>Carrera/Profesion</th>
					    				<th>Fecha</th>
					    				<th>Precio</th>
					    				<th>Opciones</th>
					    			</tr>
					    		</thead>
					    		<tbody>
					    			
					    			@foreach($cotizaciones as $cotizacion)
					    			<tr>
					    				<td>{{$cotizacion->id}}</td>
					    				<td>{{$cotizacion->numero_cotizacion}}</td>
					    				<td>{{$cotizacion->cliente->persona->nombre}}</td>
					    				<td>CI: {{$cotizacion->cliente->persona->cedula}} <br> CU: {{$cotizacion->cliente->carnet}}</td>

					    				<td>
					    					@if($cotizacion->cotizacionPosgrado == null)
						    					@if($cotizacion->cotizacionGeneral->id_carrera != null)
						    						{{$cotizacion->cotizacionGeneral->carrera->nombre}}			
						    					@else
						    						Carrera no seleccionada
						    					@endif
					    					@else
					    						Posgrado
					    					@endif
					    				</td>
					    				<td>{{$cotizacion->created_at}}</td>
					    				<td>{{$cotizacion->precio_total}} $</td>
					    				<td>
					    					<a href="#modal-edit" data-position="top" data-tooltip="Editar cotizacion" class="tooltipped modal-trigger"
					    					><i class="material-icons edit_cotizacion"
					    					data-info='{
					    					@if(!isset($cotizacion->id))
					    						"edit_id":"",
					    					@else
					    						"edit_id":"{{$cotizacion->id}}",
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->nombre))
					    						"edit_nombre":"",
					    					@else
					    						"edit_nombre":"{{$cotizacion->cliente->persona->nombre}}",
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->direccion))
					    						"edit_direccion":"",
					    					@else
					    						"edit_direccion":"{{$cotizacion->cliente->persona->direccion}}",
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->celular))
					    						"edit_celular":"",
					    					@else
					    						"edit_celular":"{{$cotizacion->cliente->persona->celular}}",
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->telefono))
					    						"edit_telefono":"",
					    					@else
					    						"edit_telefono":"{{$cotizacion->cliente->persona->telefono}}",
					    					@endif
					    					@if(!isset($cotizacion->nivelAcademico->id))
					    						"edit_niveles":"",
					    					@else
					    						"edit_niveles":"{{$cotizacion->id_nivel_academico}}",
					    					@endif
					    					@if(!isset($cotizacion->id_universidad))
					    						"edit_universidades":"",
					    					@else
					    						"edit_universidades":"{{$cotizacion->id_universidad}}",
					    					@endif
					    					@if(!isset($cotizacion->cotizacionGeneral->id_facultad))
					    						"edit_facultades":"",
					    					@else
					    						"edit_facultades":"{{$cotizacion->cotizacionGeneral->id_facultad}}",
					    					@endif
					    					@if(!isset($cotizacion->cotizacionGeneral->id_carrera))
					    						"edit_carreras":"",
					    					@else
					    						"edit_carreras":"{{$cotizacion->cotizacionGeneral->id_carrera}}",
					    					@endif
					    					@if(!isset($cotizacion->id_profesion))
					    						"edit_profesiones":"",
					    					@else
					    						"edit_profesiones":"{{$cotizacion->id_profesion}}",
					    					@endif
					    					@if(!isset($cotizacion->id_curso))
					    						"edit_curso":"",
					    					@else
					    						"edit_curso":"{{$cotizacion->id_curso}}",
					    					@endif
					    					@if(!isset($cotizacion->id_modalidad))
					    						"edit_modalidades":"",
					    					@else
					    						"edit_modalidades":"{{$cotizacion->id_modalidad}}",
					    					@endif
					    					@if(!isset($cotizacion->validez))
					    						"edit_validez":"",
					    					@else
					    						"edit_validez":"{{$cotizacion->validez}}",
					    					@endif
					    					@if(!isset($cotizacion->precio_total))
					    						"edit_precio":"",
					    					@else
					    						"edit_precio":"{{$cotizacion->precio_total}}",
					    					@endif
					    					@if(!isset($cotizacion->tema))
					    						"edit_tema":"",
					    					@else
					    						"edit_tema":"{{$cotizacion->tema}}",
					    					@endif
					    					@if(!isset($cotizacion->observacion))
					    						"edit_observaciones":"",
					    					@else
					    						"edit_observaciones":"{{$cotizacion->observacion}}",
					    					@endif
					    					@if(!isset($cotizacion->avance))
					    						"edit_avance":"",
					    					@else
					    						"edit_avance":"{{$cotizacion->avance}}",
					    					@endif
					    					@if(!isset($cotizacion->id_medio))
					    						"edit_medios":""
					    					@else
					    						"edit_medios":"{{$cotizacion->id_medio}}"
					    					@endif
					    				}'>edit</i></a>
					    					@if($cotizacion->ficha === null)
					    						<a href="#" class="crear-ficha tooltipped" data-position="top" data-tooltip="Crear ficha"><i data-id_cotizacion="{{$cotizacion->id}}" class="material-icons">add</i></a>
					    					@else
					    						<a href="{{asset('fichas_academicas').'/'.$cotizacion->ficha->id}}" class="tooltipped" data-position="top" data-tooltip="Ver Ficha"><i class="material-icons">chrome_reader_mode</i></a>
					    					@endif
					    					<!--a href="#" class="tooltipped" data-position="top" data-tooltip="Ver cotización en PDF"><i class="material-icons">picture_as_pdf</i></a-->
					    					<a href="{{ route('cotizacion.pdf', $cotizacion->id)}}" class="tooltipped" data-position="top" data-tooltip="Ver cotización en PDF"><i class="material-icons">picture_as_pdf</i></a>
					    					<a href="#" class="tooltipped" data-position="top" data-tooltip="Agregar observación"><i class="material-icons">message</i></a>
					    				</td>
					    			</tr>
					    			@endforeach
					    		</tbody>
					    	</table>
						</div>
						<div class="row">
							<div class="col s12">
								<center>
									{{ $cotizaciones->links() }}
								</center>
							</div>
						</div>			

	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <div id="test2" class="col s12 l10 offset-l1">

		    <div class="row">
				<div class="col s12"><br>
					<div class="card-panel">
						<div class="row" style="padding: 0;margin: 0;">
							<div class="col s6">
								<b>Fecha de cotización:</b> {{date('d/m/Y - h:i:s')}}
							</div>
							<div class="col s6">
								<center>
									<b>Numero de cotización:</b> 98
								</center>
							</div>
						</div>
						<hr>
							<div class="row">
								<div class="col s12 l6">
									<div class="row">

						<form action="{{route('guardarCotizacion')}}" method="post">

										<div class="input-field col s12">
											<input autocomplete="off" id="nombre" type="text" placeholder="Nombre" list="nombres" name="nombre" @if(old('nombre')) value="{{old('nombre')}}" @endif>
											<datalist id="nombres"></datalist>
										</div>

										<div class="input-field col s4">
											<input id="direccion" type="text" readonly placeholder="direccion" name="direccion" @if(old('direccion')) value="{{old('direccion')}}" @endif>
										</div>

										<div class="input-field col s4">
											<input id="celular" type="text" readonly placeholder="celular" name="celular" @if(old('celular')) value="{{old('celular')}}" @endif>
										</div>

										<div class="input-field col s4">
											<input id="telefono" type="text" readonly placeholder="telefono" name="telefono" @if(old('telefono')) value="{{old('telefono')}}" @endif>
										</div>
									@csrf
									<input hidden id="id_cliente" name="id_cliente" @if(old('id_cliente')) value="{{old('id_cliente')}}" @endif>

										<div class="input-field col s4">
											<input type="text" list="dl-niveles" id="niveles" placeholder="Nivel" name="nivel" value="{{old('nivel')}}">
										    <datalist id="dl-niveles">
										    	@foreach($niveles as $nivel)
										    			<option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>

										<div class="input-field col s4">
											<input type="text" list="dl-universidades" id="universidades" placeholder="Universidad" name="universidad">
										    <datalist id="dl-universidades">
										    	@foreach($universidades as $universidad)
										    		<option value="{{$universidad->id}}">{{$universidad->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>

										<div class="input-field col s4">
											<input type="text" list="dl-facultades" id="facultades" placeholder="Facultad" name="facultad">
										    <datalist id="dl-facultades">
										    	@foreach($facultades as $facultad)
										    		<option value="{{$facultad->id}}">{{$facultad->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>

										<div class="input-field col s4">
											<input type="text" list="dl-carreras" id="carreras" placeholder="Carrera" name="carrera">
										    <datalist id="dl-carreras">
										    	@foreach($carreras as $carrera)
										    		<option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>

										<div class="input-field col s4">
											<input type="text" list="dl-profesiones" id="profesiones" placeholder="Profesion" name="profesion">
										    <datalist id="dl-profesiones">
										    	@foreach($profesiones as $profesion)
										    		<option value="{{$profesion->id}}">{{$profesion->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>

										<div class="input-field col s4">
											<input type="text" list="dl-cursos" id="cursos" placeholder="Curso" name="curso">
										    <datalist id="dl-cursos">
										    	@foreach($cursos as $curso)
										    		<option value="{{$curso->id}}">{{$curso->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>

									</div>
								</div>
								<div class="col s12 l6">
									<br><br>
									<div class="row">
										<div class="input-field col s4">
											<input type="text" list="dl-modalidades" id="modalidades" placeholder="Modalidad" name="modalidad">
										    <datalist id="dl-modalidades">
										    	@foreach($modalidades as $modalidad)
										    		<option value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>
										<div class="input-field col s4">
											<label for="validez">Validez de la oferta</label>
											<input type="number" id="validez" name="validez">
										</div>
										<div class="input-field col s4">
											<label for="precio">Precio</label>
											<input type="number" id="precio" name="precio">
										</div>
										<div class="input-field col s6">
											<label for="tema">Tema</label>
											<textarea id="tema" name="tema"></textarea>
										</div>
										<div class="input-field col s6">
											<label for="observaciones">Observaciones</label>
											<textarea id="observaciones" name="observacion"></textarea>
										</div>
										<div class="input-field col s6">
											<label for="avance">Avance %</label>
											<input type="number" id="avance" name="avance">
										</div>
										<div class="input-field col s6">
											<input type="text" list="dl-medios" id="medios" placeholder="medio" name="medio">
										    <datalist id="dl-medios">
										    	@foreach($medios as $medio)
										    		<option value="{{$medio->id}}">{{$medio->nombre}}</option>
										    	@endforeach
										    </datalist>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<center>
										<button class="btn blue darken-2">Guardar</button>
										<input class="btn blue darken-2" type="reset" value="Limpiar">
									</center>
								</div>
							</div>
						</form>
					</div>
				</div>
		    </div>
	    </div>
    </div>
  </div>

  <form id="form-crear-ficha" action="{{route('crear_ficha')}}" method="post" hidden>
  	@csrf
  	<input id="cf-id_cotizacion" name="id_cotizacion">
  </form>


  <!-- Modal Structure -->
  <div id="modal-edit" class="modal">
    <div class="modal-content">
		<form action="{{route('modificar_cotizacion')}}" method="post">
				@csrf
    		<div class="row">
				<input id="edit_id" name="edit_id_cotizacion" @if(old('edit_id_cotizacion')) value="{{old('edit_id_cotizacion')}}" @elseif(session('edit_id_cotizacion')) value="{{session('edit_id_cotizacion')}}" @endif hidden>
	    		<div class="s12">
	    			<center>
	    				<h4 id="edit_titulo">Nombre</h4>
	    			</center>
	    		</div>
				<div class="input-field col s12">
					<input id="edit_nombre" type="text" readonly list="nombres" name="edit_nombre" @if(old('edit_nombre')) value="{{old('edit_nombre')}}" @elseif(session('edit_nombre')) value="{{session('edit_nombre')}}" @endif>
					<span class="helper-text">Nombre</span>
					<datalist id="nombres"></datalist>
				</div>

				<div class="input-field col s12 l4">

					<input id="edit_direccion" type="text" readonly readonly name="edit_direccion" @if(old('edit_direccion')) value="{{old('edit_direccion')}}" @elseif(session('edit_direccion')) value="{{session('edit_direccion')}}" @endif>
					<span class="helper-text">direccion</span>
				</div>

				<div class="input-field col s12 l4">
					<input id="edit_celular" type="text" readonly readonly name="edit_celular" @if(old('edit_celular')) value="{{old('edit_celular')}}" @elseif(session('edit_celular')) value="{{session('edit_celular')}}" @endif>
					<span class="helper-text">celular</span>
				</div>

				<div class="input-field col s12 l4">
					<input id="edit_telefono" type="text" readonly name="edit_telefono" @if(old('edit_telefono')) value="{{old('edit_telefono')}}" @elseif(session('edit_telefono')) value="{{session('edit_telefono')}}" @endif>
					<span class="helper-text">telefono</span>
				</div>

				<div class="input-field col s11 l3">
					<input class="input-editable" type="text" list="dl-edit_niveles" id="edit_niveles" placeholder="Nivel" name="edit_nivel" readonly
					@if(old('edit_nivel'))
						value="{{old('edit_nivel')}}"
					@elseif(session('edit_nivel')) value="{{session('edit_nivel')}}"						
					@endif
					>
					<i class="material-icons prefix edit" data-brother="edit_niveles">edit</i>
					<span class="helper-text">Nivel</span>
					<datalist id="dl-edit_niveles">
						@foreach($niveles as $nivel)
							<option value="{{$nivel->id}}">{{$nivel->nombre}}</option>
						@endforeach
					</datalist>
				</div>

				<div class="input-field col s11 l3 offset-l1">
					<input class="input-editable" type="text" list="dl-edit_universidades" id="edit_universidades" placeholder="Universidad" name="edit_universidad" readonly
					@if(old('edit_universidad'))
						value="{{old('edit_universidad')}}"
					@elseif(session('edit_universidad')) value="{{session('edit_universidad')}}"
					@endif
					>
					<i class="material-icons prefix edit" data-brother="edit_universidades">edit</i>
					<span class="helper-text">Universidad</span>
					<datalist id="dl-edit_universidades">
						@foreach($universidades as $universidad)
							<option value="{{$universidad->id}}">{{$universidad->nombre}}</option>
						@endforeach
					</datalist>
				</div>

				<div class="input-field col s11 l3 offset-l1">
					<input class="input-editable" type="text" list="dl-edit_facultades" id="edit_facultades" placeholder="Facultad" name="edit_facultad" readonly
					@if(old('edit_facultad'))
						value="{{old('edit_facultad')}}"
					@elseif(session('edit_facultad')) value="{{session('edit_facultad')}}"
					@endif
					>
					<i class="material-icons prefix edit" data-brother="edit_facultades">edit</i>
					<span class="helper-text">Facultad</span>
					<datalist id="dl-edit_facultades">
						@foreach($facultades as $facultad)
							<option value="{{$facultad->id}}">{{$facultad->nombre}}</option>
						@endforeach
					</datalist>
				</div>	
			</div>
			<div class="row">

				<div class="input-field col s11 l3">
					<input class="input-editable" type="text" list="dl-edit_carreras" id="edit_carreras" placeholder="Carrera" name="edit_carrera" readonly
					@if(old('edit_carrera'))
						value="{{old('edit_carrera')}}"
					@elseif(session('edit_carrera')) value="{{session('edit_carrera')}}"
					@endif
					>
					<i class="material-icons prefix edit" data-brother="edit_carreras">edit</i>
					<span class="helper-text">Carrera</span>
					<datalist id="dl-edit_carreras">
						@foreach($carreras as $carrera)
							<option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
						@endforeach
					</datalist>
				</div>

				<div class="input-field col s11 l3 offset-l1">
					<input class="input-editable" type="text" list="dl-edit_profesiones" id="edit_profesiones" placeholder="Profesion" name="edit_profesion" readonly
					@if(old('edit_profesion'))
						value="{{old('edit_profesion')}}"
					@elseif(session('edit_profesion')) value="{{session('edit_profesion')}}"
					@endif
					>
					<i class="material-icons prefix edit" data-brother="edit_profesiones">edit</i>
					<span class="helper-text">Profesion</span>
					<datalist id="dl-edit_profesiones">
					@foreach($profesiones as $profesion)
						<option value="{{$profesion->id}}">{{$profesion->nombre}}</option>
					@endforeach
					</datalist>
				</div>

				<div class="input-field col s11 l3 offset-l1">
					<input class="input-editable" type="text" list="dl-edit_cursos" id="edit_curso" placeholder="Curso" name="edit_curso" readonly
					@if(old('edit_curso'))
						value="{{old('edit_curso')}}"
					@elseif(session('edit_curso'))
						value="{{session('edit_curso')}}"
					@endif
					>
					<i class="material-icons prefix edit" data-brother="edit_curso">edit</i>
					<span class="helper-text">curso</span>
					<datalist id="dl-edit_cursos">
					@foreach($cursos as $curso)
						<option value="{{$curso->id}}">{{$curso->nombre}}</option>
					@endforeach
					</datalist>
				</div>
				<div class="row">
					<div class="input-field col s11 l3">
						<input class="input-editable" type="text" list="dl-edit_modalidades" id="edit_modalidades" placeholder="Modalidad" name="edit_modalidad" readonly
						@if(old('edit_modalidad'))
							value="{{old('edit_modalidad')}}"
						@elseif(session('edit_modalidad')) value="{{session('edit_modalidad')}}"
						@endif
						>
						<i class="material-icons prefix edit" data-brother="edit_modalidades">edit</i>
						<span class="helper-text">Modalidad</span>
						<datalist id="dl-edit_modalidades">
							@foreach($modalidades as $modalidad)
								<option value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
							@endforeach
						</datalist>
					</div>
					<div class="input-field col s11 l3 offset-l1">
						<input class="input-editable" type="number" id="edit_validez" name="edit_validez" readonly
						@if(old('edit_validez'))
							value="{{old('edit_validez')}}"

						@elseif(session('edit_validez')!=null)
							value="{{session('edit_validez')}}"
						@endif
						>
						<i class="material-icons prefix edit" data-brother="edit_validez">edit</i>
						<span class="helper-text">Validez de la oferta</span>
					</div>
					<div class="input-field col s11 l3 offset-l1">
						<input class="input-editable" type="number" id="edit_precio" name="edit_precio" readonly required
						@if(old('edit_precio'))
							value="{{old('edit_precio')}}"
						@elseif(session('edit_precio')) value="{{session('edit_precio')}}"
						@endif
						>
						<i class="material-icons prefix edit" data-brother="edit_precio">edit_total</i>
						<span class="helper-text">Precio</span>
					</div>
					<div class="col s12">
						<div class="row">
							
							<div class="input-field col l5 s11">
								<textarea class="input-editable" id="edit_tema" name="edit_tema" readonly>@if(old('edit_tema')){{old('edit_tema')}}@elseif(session('edit_tema')){{session('edit_tema')}}@endif</textarea>
								<i class="material-icons prefix edit" data-brother="edit_tema">edit</i>
								<span class="helper-text">Tema</span>
							</div>
							<div class="input-field col s11 l5 offset-l1">
								<textarea class="input-editable" id="edit_observaciones" name="edit_observacion" readonly>@if(old('edit_observacion')) {{old('edit_observacion')}} @elseif(session('edit_observacion')) {{session('edit_observacion')}} @endif</textarea>
								<i class="material-icons prefix edit" data-brother="edit_observaciones">edit</i>
								<span class="helper-text">Observaciones</span>
							</div>
						</div>
					</div>
					<div class="input-field col s11 l5">
						<input class="input-editable" type="number" id="edit_avance" name="edit_avance" readonly
						@if(old('edit_avance'))
							value="{{old('edit_avance')}}"
						@elseif(session('edit_avance')) value="{{session('edit_avance')}}"
						@endif
						>
						<i class="material-icons prefix edit" data-brother="edit_avance">edit</i>
						<span class="helper-text">Avance %</span>
					</div>
					<div class="input-field col s11 l5 offset-l1">
						<input class="input-editable" type="text" list="dl-edit_medios" id="edit_medios" placeholder="medio" name="edit_medio" readonly
						@if(old('edit_medio'))
							value="{{old('edit_medio')}}"
						@elseif(session('edit_medio')) value="{{session('edit_medio')}}"
						@endif
						>
						<i class="material-icons prefix edit" data-brother="edit_medios">edit</i>
						<span class="helper-text">medio</span>
						<datalist id="dl-edit_medios">
							@foreach($medios as $medio)
								<option value="{{$medio->id}}">{{$medio->nombre}}</option>
							@endforeach
						</datalist>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<center>
							<button id="button-submit" class="btn blue darken-2" disabled>Guardar</button>
							<input class="btn blue darken-2" type="reset" value="Limpiar">
						</center>
					</div>
				</div>
			</div>
		</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
    @if(isset($modal) && $modal)
	  <!-- Modal Structure -->
	  <div id="modal1" class="modal">
	    <div class="modal-content">
	    	<div class="row valign-wrapper">
	    		<div class="col s6">
	      			<h5><b>Cotización # 12345</b></h5>
	    		</div>
	    		<div class="col s6" align="right">
	    			<b>dd/mm/aaaa hh:mm:ss</b> <br>
	    		</div>
	    	</div>
	      <div class="card-panel">
	      	<div class="row">
	      		<div class="row valign-wrapper">
		      		<div class="col s6">
		      			<u><b>Información del cliente</b></u><br>
		      			<b>Nombre:</b> Rommel Montoya<br>
		      			<b>Dirección:</b> Dirección Ejemplo<br>
		      			<b>Telefono:</b> 1234567<br>
		      			<b>Celular:</b> 1234567<br>
		      			
		      		</div>
		      		<div class="col s6">
		      			<img src="{{asset('images/logo.png')}}" class="responsive-img">
		      		</div>
	      		</div>
	      		
	      		<table>
	      			<tbody>
		      			<tr><td><b>Nivel:</b></td> <td> Nivel ejemplo</td></tr>
		      			<tr><td><b>Universidad:</b></td> <td> Universidad Ejemplo</td></tr>
		      			<tr><td><b>Facultad:</b></td> <td> Facultad Ejemplo</td></tr>
		      			<tr><td><b>Carrera:</b></td> <td> Carrera Ejemplo</td></tr>
		      			<tr><td><b>Profesión:</b></td> <td> Profesion Ejemplo</td></tr>
		      			<tr><td><b>Curso:</b></td> <td> Curso Ejemplo</td></tr>
		      			<tr><td><b>Asesor:</b></td> <td> Alennys Palma</td></tr>
		      			<tr><td><b>Modalidad:</b></td> <td> Modalidad Ejemplo</td></tr>
		      			<tr><td><b>Validez:</b></td> <td> 123</td></tr>
		      			<tr><td><b>Precio:</b></td> <td> 900</td></tr>
		      			<tr><td><b>Tema:</b></td> <td> Tema ejemplo</td></tr>
		      			<tr><td><b>Observaciones:</b></td> <td> Observaciones ejemplo</td></tr>
						<tr><td><b>Avance:</b></td> <td> 35 %</td></tr>
		      			<tr><td><b>Medio:</b></td> <td> Redes sociales</td></tr>
	      				
	      			</tbody>
	      		</table>

	      		<div class="col s6">
	      			
	      			
	      		</div>
	      		<div class="col s6">

	      		</div>
	      	</div>

	      </div>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
	    </div>
	  </div>
    @endif
<script>
	let modal;
    @if(isset($modal) && $modal)
    	modal = true;
    @else
    	modal = false;
    @endif
	
</script>
<script src="{{asset('js/cotizaciones.js')}}">
        @if(isset($resultBusqueda))
            M.toast({html:  '{{$resultBusqueda['mensaje']}}' })
        @endif
        @if(session('messages'))
            @foreach(session('messages') as $messages)
                M.toast({html:  '{{$messages}}' })
                
            @endforeach

        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            M.toast({html:  '{{ $error }}' })
            @endforeach
        @endif
</script>
<script src="{{asset('js/edit_inputs.js')}}"></script>
<script type="module" src="{{asset('js/cotizaciones/main.js')}}"></script>
<script>
	window.addEventListener('load',execute);
	function execute(){
		let name = document.getElementById('nombre');
		let direccion = document.getElementById('direccion');
		let celular = document.getElementById('celular');
		let telefono = document.getElementById('telefono');
		let id_cliente = document.getElementById('id_cliente');

		//Se obtiene dataset
		let datalist_nombres = document.getElementById('nombres');
		name.addEventListener('keyup',function(){

			let http = new XMLHttpRequest();

			let url = "{{route('buscarCliente')}}";


			http.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					let datos = JSON.parse(this.responseText);

					//Comprobamos si llegaron datos del servidor
					if(datos.length > 0){

						//console.log(datalist_nombres);

						//Si tiene opciones, las borrará (esto para la segunda busqueda en adelante)
						
						while(datalist_nombres.hasChildNodes()){
							datalist_nombres.removeChild(datalist_nombres.firstChild);
						}
						//por cada resultado:
						for(let i = 0; i<datos.length; i++){
							//Crear string para la opcion
							let string = (i+1) + ' ' +datos[i].persona.nombre+' '+datos[i].persona.apellido;

							//creara el elemento <option></option>
							let new_node = document.createElement('option');

							//Creará el contenido para un nodo
							let content_node = document.createTextNode(string);

							//Se le agregará al elemento option el contenido creado y todos los atributos necesarios para utilizarlo despues
							new_node.setAttribute('value',string);
							new_node.setAttribute('data-direccion',datos[i].persona.direccion);
							new_node.setAttribute('data-telefono',datos[i].persona.telefono);
							new_node.setAttribute('data-celular',datos[i].persona.celular);
							new_node.setAttribute('data-id_cliente',datos[i].id);
							
							//se insertará el nodo al datalist
							datalist_nombres.insertBefore(new_node,null);
						}
						
					}

				}
			}
			http.open('GET',url+'?name='+name.value,true);
			http.send();

		});
		name.addEventListener('input',function(e){
			let option = document.querySelector('[value="'+this.value+'"]');
			console.log(option);
			if(this.value!='' && option!=null){
				if(option.dataset.direccion!=undefined){

					direccion.value = option.dataset.direccion;
					celular.value = option.dataset.celular;
					telefono.value = option.dataset.telefono;
					id_cliente.value = option.dataset.id_cliente;
				}

			}else{
						direccion.value = '';
						celular.value = '';
						telefono.value = '';
						id_cliente.value = '';

			}
		})

		function setEditInputs(e){
			let data = JSON.parse(e.target.dataset.info);
			console.log(data);
			for(let key in data){
				let input = document.getElementById(key);
				input.value = data[key];

				//console.log(document.getElementById(key));
			}

		}

		let edit = document.querySelectorAll('.edit_cotizacion');
		for(let i = 0; i<edit.length; i++){
			edit[i].onclick = setEditInputs;
		}

	    @if ($errors->any())
	        @foreach ($errors->all() as $error)
	        	M.toast({html:  '{{ $error }}' })
	        @endforeach
	    
	    @endif
        @if(isset($resultBusqueda))
            M.toast({html:  '{{$resultBusqueda['mensaje']}}' })
        @endif
        @if(session('messages'))
            @foreach(session('messages') as $messages)
                M.toast({html:  '{{$messages}}' })                
            @endforeach

        @endif
        
	    let elems = document.querySelectorAll('.modal');
	    let instances_modal = M.Modal.init(elems);
	    
	    @if(session('tab')===2)
	    	instances_modal[1].open();
	    @endif	

	    let elems_tooltip = document.querySelectorAll('.tooltipped');
    	let instances_tooltip = M.Tooltip.init(elems_tooltip);
	}

</script>
@endsection
@php
	session()->forget('tab')
@endphp