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
					    				<th>N° Cotización</th>
					    				<th>Cliente</th>
					    				<th>Identificacion</th>
					    				<th>Carrera</th>
					    				<th>Fecha</th>
					    				<th>Precio</th>
					    				<th>Opciones</th>
					    			</tr>
					    		</thead>
					    		<tbody>
					    			
					    			@foreach($cotizaciones as $cotizacion)
					    			<tr>
					    				<td>{{$cotizacion->id}}</td>
					    				<td>{{$cotizacion->cliente->persona->nombre}}</td>
					    				<td>CI: {{$cotizacion->cliente->persona->cedula}} <br> CU: {{$cotizacion->cliente->carnet}}</td>

					    				<td>
					    					@if(isset($cotizacion->cotizacionUniversitaria))

						    					@if($cotizacion->cotizacionUniversitaria->cotizacionPosgrado == null)
							    					@if($cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_carrera != null)
							    						{{$cotizacion->cotizacionUniversitaria->cotizacionGeneral->carrera->nombre}}			
							    					@else
							    						Carrera no seleccionada
							    					@endif
						    					
						    					@else
						    						Posgrado
						    					@endif
					    					@else
					    						Básico
					    					@endif
					    				</td>
					    				<td>{{$cotizacion->created_at}}</td>
					    				<td>{{$cotizacion->precio_total}} $</td>
					    				<td>
					    					<a href="#modal-edit" data-position="top" data-tooltip="Editar cotizacion" class="tooltipped modal-trigger"
					    					><i class="material-icons edit_cotizacion"
					    					data-info='{
					    					@if(!isset($cotizacion->id))
					    						"edit_id":{"data":"","type":"default"},
					    					@else
					    						"edit_id":{"data":"{{$cotizacion->id}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->nombre))
					    						"edit_nombre":{"data":"","type":"default"},
					    					@else
					    						"edit_nombre":{"data":"{{$cotizacion->cliente->persona->nombre}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->direccion))
					    						"edit_direccion":{"data":"","type":"default"},
					    					@else
					    						"edit_direccion":{"data":"{{$cotizacion->cliente->persona->direccion}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->celular))
					    						"edit_celular":{"data":"","type":"default"},
					    					@else
					    						"edit_celular":{"data":"{{$cotizacion->cliente->persona->celular}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->cliente->persona->telefono))
					    						"edit_telefono":{"data":"","type":"default"},
					    					@else
					    						"edit_telefono":{"data":"{{$cotizacion->cliente->persona->telefono}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->nivelAcademico->id))
												"edit_niveles":{"data":"","type":"select","selector":".niveles_option"},
					    					@else
												"edit_niveles":{"data":"{{$cotizacion->nivelAcademico->nombre}}","type":"select","selector":".niveles_option"},
					    					@endif
					    					@if(!isset($cotizacion->cotizacionUniversitaria->id_universidad))
					    						"edit_universidades":{"data":"","type":"default"},
					    					@else
					    						"edit_universidades":{"data":"{{$cotizacion->cotizacionUniversitaria->universidad->nombre}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->curso))
												"edit_curso":{"data":"","type":"select","selector":".curso_option"},
					    					@else
												"edit_curso":{"data":"{{$cotizacion->curso}}","type":"select","selector":".curso_option"},
					    					@endif
					    					@if(!isset($cotizacion->paralelo))
												"edit_paralelo":{"data":"","type":"select","selector":".paralelo_option"},
					    					@else
												"edit_paralelo":{"data":"{{$cotizacion->paralelo}}","type":"select","selector":".paralelo_option"},
					    					@endif
					    					@if(!isset($cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_facultad))
												"edit_facultades":{"data":"","type":"select","selector":".facultades_option"},
					    					@else
												"edit_facultades":{"data":"{{$cotizacion->cotizacionUniversitaria->cotizacionGeneral->facultad->nombre}}","type":"select","selector":".facultades_option"},
					    					@endif
					    					@if(!isset($cotizacion->cotizacionUniversitaria->cotizacionGeneral->id_carrera))
					    						"edit_carreras":{"data":"","type":"default"},
					    					@else
					    						"edit_carreras":{"data":"{{$cotizacion->cotizacionUniversitaria->cotizacionGeneral->carrera->nombre}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->cotizacionUniversitaria->id_profesion))
					    						"edit_profesiones":{"data":"","type":"default"},
					    					@else
					    						"edit_profesiones":{"data":"{{$cotizacion->cotizacionUniversitaria->profesion->nombre}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->id_tipo_cotizacion))
												"edit_tipo_cotizacion":{"data":"","type":"select","selector":".tipo_cotizacion_option"},
					    					@else
												"edit_tipo_cotizacion":{"data":"{{$cotizacion->tipoCotizacion->nombre}}","type":"select","selector":".tipo_cotizacion_option"},
					    					@endif
					    					@if(!isset($cotizacion->id_modalidad))
												"edit_modalidades":{"data":"","type":"select","selector":".modalidades_option"},
					    					@else
												"edit_modalidades":{"data":"{{$cotizacion->modalidad->nombre}}","type":"select","selector":".modalidades_option"},
					    					@endif
					    					@if(!isset($cotizacion->validez))
					    						"edit_validez":{"data":"","type":"default"},
					    					@else
					    						"edit_validez":{"data":"{{$cotizacion->validez}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->precio_total))
					    						"edit_precio":{"data":"","type":"default"},
					    					@else
					    						"edit_precio":{"data":"{{$cotizacion->precio_total}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->tema))
					    						"edit_tema":{"data":"","type":"default"},
					    					@else
					    						"edit_tema":{"data":"{{$cotizacion->tema}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->observaciones))
					    						"edit_observaciones":{"data":"","type":"default"},
					    					@else
					    						"edit_observaciones":{"data":"{{$cotizacion->observaciones}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->avance))
					    						"edit_avance":{"data":"","type":"default"},
					    					@else
					    						"edit_avance":{"data":"{{$cotizacion->avance}}","type":"default"},
					    					@endif
					    					@if(!isset($cotizacion->id_medio))
					    						"edit_medios":{"data":"","type":"select","selector":".medios_option"},
					    					@else
					    						"edit_medios":{"data":"{{$cotizacion->medio->nombre}}","type":"select","selector":".medios_option"},
					    					@endif
					    					@if(!isset($cotizacion->cotizacionUniversitaria->cotizacionPosgrado))
					    						"edit_posgrado":{"data":"","type":"default"}
					    					@else
					    						"edit_posgrado":{"data":"{{$cotizacion->cotizacionUniversitaria->cotizacionPosgrado->posgrado->nombre}}","type":"default"}
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
					<div class="">
						<form action="{{route('guardarCotizacion')}}" method="post" autocomplete="off">
							@csrf
							<div class="row">
								<div class="col s12">
									<b>Fecha:</b> {{date('Y-m-d H:m:i')}}
									<hr>
									<div class="row">

										<div class="input-field col s6">
											<i class="material-icons prefix">person</i>
											<input autocomplete="off" id="nombre" type="text" placeholder="Nombre del cliente" list="nombres" name="nombre" @if(old('nombre')) value="{{old('nombre')}}" @endif>
											<datalist id="nombres"></datalist>
										</div>

										<div class="input-field col s3">
											<i class="material-icons prefix">phone_android</i>
											<input id="celular" type="text" readonly placeholder="celular" name="celular" @if(old('celular')) value="{{old('celular')}}" @endif>
										</div>

										<div class="input-field col s3">

											<i class="material-icons prefix">local_phone</i>
											<input id="telefono" type="text" readonly placeholder="telefono" name="telefono" @if(old('telefono')) value="{{old('telefono')}}" @endif>
										</div>

										<div class="input-field col s12">

											<i class="material-icons prefix">home</i>
											<input id="direccion" type="text" readonly placeholder="direccion" name="direccion" @if(old('direccion')) value="{{old('direccion')}}" @endif>
										</div>

										<input hidden id="id_cliente" name="id_cliente" @if(old('id_cliente')) value="{{old('id_cliente')}}" @endif>

										<div class="input-field col s6">

										    <select name="nivel" class="browser-default">
										    	<option disabled selected>Nivel</option>
										    	@foreach($niveles as $nivel)
										    			<option 
										    			@if(old('nivel') == $nivel->id)
										    				selected
										    			@endif
										    			value="{{$nivel->id}}">{{$nivel->nombre}}</option>
										    	@endforeach
										    </select>
										</div>

										<div class="input-field col s6">

										    <select name="tipo_cotizacion" class="browser-default">
										    		<option disabled selected>Tipo</option>
										    	@foreach($tipos_cotizacion as $tipo_cotizacion)
										    		<option
										    		@if(old('tipo_cotizacion') == $tipo_cotizacion->id)
									    				selected
									    			@endif
										    		value="{{$tipo_cotizacion->id}}">{{$tipo_cotizacion->nombre}}</option>
										    	@endforeach
										    </select>
										</div>
										<div class="input-field col s6">
											<i class="material-icons prefix">local_convenience_store</i>
											<input type="text" list="dl-universidades" id="universidades" placeholder="Universidad" name="universidad" value="{{old('universidad')}}">

										    <datalist id="dl-universidades">
										    	@foreach($universidades as $universidad)
										    		<option value="{{$universidad->nombre}}"></option>
										    	@endforeach
										    </select>
										</div>
										<div class="input-field col s6">
										    
										    <select id="facultades" placeholder="Facultad" name="facultad" class="browser-default">
										    	<option disabled selected>Facultad</option>
										    	
										    	@foreach($facultades as $facultad)
										    		<option
										    		@if(old('facultad') == $facultad->id)
									    				selected
									    			@endif
										    		value="{{$facultad->id}}">{{$facultad->nombre}}</option>
										    	@endforeach
										    		
										    </select>								
										</div>
									</div>
									<div class="row">

										<div class="input-field col s6">

											<i class="material-icons prefix">group_work</i>
											<input type="text" list="dl-carreras" id="carreras" placeholder="Carrera" name="carrera" value="{{old('carrera')}}">
										    
										    <datalist id="dl-carreras" class="browser-default" name="carrera">
										    	<option disabled selected>Carrera</option>
										    	<div id="carreras_options">
											    	@foreach($carreras as $carrera)
											    		<option
											    		@if(old('carrera') == $carrera->id)
										    				selected
										    			@endif
											    		value="{{$carrera->nombre}}"></option>
											    	@endforeach
										    	</div>
										    </datalist>
										</div>
										<div class="input-field col s6">

										    <select name="curso" class="browser-default">
										    	<option disabled selected>Curso</option>
										    	@for($i = 1; $i<=10; $i++)
										    		<option
										    		@if(old('curso')==$i)
										    			selected
										    		@endif
										    		value="{{$i}}">{{$i}}°</option>
										    	@endfor
										    </select>
										</div>
										</div>
										<div class="row">

										<div class="input-field col s6">
											<i class="material-icons prefix">clear_all</i>
											<input type="text" id="posgrado" name="posgrado" list="dl-posgrados" placeholder="Posgrado" value="{{old('posgrado')}}">
											<datalist id="dl-posgrados">
												@forelse($posgrados as $posgrado)
													<option value="{{$posgrado->nombre}}">{{$posgrado->nombre}}</option>
												@empty
												@endforelse
											</datalist>
										</div>

										<div class="input-field col s6">

											<i class="material-icons prefix">assignment_ind</i>
											<input type="text" list="dl-profesiones" id="profesiones" placeholder="Profesion" name="profesion" value="{{old('profesion')}}">
										    <datalist id="dl-profesiones">
										    	@foreach($profesiones as $profesion)
										    		<option value="{{$profesion->nombre}}"></option>
										    	@endforeach
										    </datalist>
										</div>
										<div class="input-field col s6">

										    <select name="modalidad" class="browser-default">
										    	<option disabled selected>Modalidad</option>
										    	@foreach($modalidades as $modalidad)
										    		<option
										    		@if(old('modalidad') == $modalidad->id)
									    				selected
									    			@endif
										    		value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
										    	@endforeach
										    </select>
										    
										</div>
										<div class="input-field col s6">
											<label for="tema">Tema</label>
											<textarea id="tema" name="tema">{{old('tema')}}</textarea>
										</div>
										<div class="input-field col s6">
											<label for="observaciones">Observaciones</label>
											<textarea id="observaciones" name="observacion">{{old('observacion')}}</textarea>
										</div>
										<div class="input-field col s6">

										    <select name="paralelo" class="browser-default">
										    	<option disabled selected>Paralelo</option>
										    	@for($i = 65; $i<=70; $i++)
										    		<option 
										    		@if(old('paralelo')==chr($i))
										    			selected
										    		@endif
										    		value="{{chr($i)}}">{{chr($i)}}</option>
										    	@endfor
										    </select>

										</div>
										
										<div class="input-field col s6">
											<i class="material-icons prefix">date_range</i>
											<label for="validez">Validez</label>
											<input type="number" id="validez" name="validez" value="{{old('validez')}}">
										</div>
										
										<div class="input-field col s6">
											<i class="material-icons prefix">attach_money</i>
											<label for="precio">Precio</label>
											<input type="number" id="precio" name="precio" value="{{old('precio')}}">
										</div>
										<div class="input-field col s6">
											<i class="material-icons prefix">insert_chart</i>
											<label for="avance">Avance %</label>
											<input type="number" id="avance" name="avance" value="{{old('avance')}}">
										</div>
										<div class="input-field col s6">
										    <select id="dl-medios" name="medio" class="browser-default">
										    	<option disabled selected>Medio</option>
										    	@foreach($medios as $medio)
										    		<option
										    		@if(old('medio') == $medio->id)
										    			selected
										    		@endif
										    		value="{{$medio->id}}">{{$medio->nombre}}</option>
										    	@endforeach
										    </select>
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
    		<div class="row">
	    		<div class="s12">
	    			<center>
	    				<h4 id="edit_titulo">Detalles de Cotización</h4>
	    			</center>
	    		</div>
				<div class="input-field col s12 l4">
					<i class="material-icons prefix">person</i>
					<input class="unvaluable" id="edit_nombre" type="text" readonly list="nombres" name="edit_nombre" @if(old('edit_nombre')) value="{{old('edit_nombre')}}" @elseif(session('edit_nombre')) value="{{session('edit_nombre')}}" @endif>
					<span class="helper-text">Nombre</span>
					<datalist id="nombres"></datalist>
				</div>

				<div class="input-field col s12 l4">
					<i class="material-icons prefix">phone_android</i>
					<input class="unvaluable" id="edit_celular" type="text" readonly readonly name="edit_celular" @if(old('edit_celular')) value="{{old('edit_celular')}}" @elseif(session('edit_celular')) value="{{session('edit_celular')}}" @endif>
					<span class="helper-text">celular</span>
				</div>

				<div class="input-field col s12 l3">
					<i class="material-icons prefix">local_phone</i>
					<input class="unvaluable" id="edit_telefono" type="text" readonly name="edit_telefono" @if(old('edit_telefono')) value="{{old('edit_telefono')}}" @elseif(session('edit_telefono')) value="{{session('edit_telefono')}}" @endif>
					<span class="helper-text">telefono</span>
				</div>

				<div class="input-field col s11">

					<i class="material-icons prefix">home</i>
					<input class="unvaluable" id="edit_direccion" type="text" readonly readonly name="edit_direccion" @if(old('edit_direccion')) value="{{old('edit_direccion')}}" @elseif(session('edit_direccion')) value="{{session('edit_direccion')}}" @endif>
					<span class="helper-text">direccion</span>
				</div>
			</div>
			<div class="row">

		<form action="{{route('modificar_cotizacion')}}" method="post">
				<input class="unvaluable" id="edit_id" name="edit_id_cotizacion" @if(old('edit_id_cotizacion')) value="{{old('edit_id_cotizacion')}}" @elseif(session('edit_id_cotizacion')) value="{{session('edit_id_cotizacion')}}" @endif hidden>
				@csrf
				<div class="input-field col s11 l5 offset-l1">

					<select class="unvaluable browser-default" name="edit_nivel" id="edit_niveles">

						<option disabled selected>Niveles</option>
						@foreach($niveles as $nivel)
							<option class="niveles_option" value="{{$nivel->id}}">{{$nivel->nombre}}</option>
						@endforeach

					</select>
					<span class="helper-text">Nivel</span>
				</div>

				<div class="input-field col s11 l5">
					<select class="select-editable unvaluable browser-default" name="edit_tipo_cotizacion" id="edit_tipo_cotizacion">
						<option disabled selected>Tipo</option>
						@foreach($tipos_cotizacion as $tipo_cotizacion)
							<option class="tipo_cotizacion_option" value="{{$tipo_cotizacion->id}}">{{$tipo_cotizacion->nombre}}</option>
						@endforeach						
					</select>
					<span class="helper-text">Tipo</span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 l5 offset-l1">
					<i class="material-icons prefix">local_convenience_store</i>
					<input class="unvaluable input-editable" type="text" list="dl-edit_universidades" id="edit_universidades" placeholder="Universidad" name="edit_universidad" readonly
					@if(old('edit_universidad'))
						value="{{old('edit_universidad')}}"
					@elseif(session('edit_universidad')) value="{{session('edit_universidad')}}"
					@endif
					>
					<datalist id="dl-edit_universidades">
						@foreach($universidades as $universidad)
						<option value="{{$universidad->nombre}}">{{$universidad->nombre}}</option>
						@endforeach
					</datalist>
					<span class="helper-text">Universidad <a href="#" class="edit" data-brother="edit_universidades">(Editar)</a></span>
				</div>
				<div class="input-field col s11 l5">
					<select class="select-editable unvaluable browser-default" name="edit_facultades" id="edit_facultades">
						<option disabled selected>Facultad</option>
						@foreach($facultades as $facultad)
							<option class="facultades_option" value="{{$facultad->id}}">{{$facultad->nombre}}</option>
						@endforeach
					</select>
					<span class="helper-text">Facultad</span>
				</div>	
			</div>
			<div class="row">

				<div class="input-field col s11 l5 offset-l1">
					<i class="material-icons prefix">group_work</i>

					<input class="input-editable unvaluable" type="text" list="dl-edit_carreras" id="edit_carreras" placeholder="Carrera" name="edit_carreras" readonly
					@if(old('edit_carreras'))
						value="{{old('edit_carreras')}}"
					@elseif(session('edit_carreras')) value="{{session('edit_carreras')}}"
					@endif
					>
					<datalist id="dl-edit_carreras">
						@foreach($carreras as $carrera)
							<option value="{{$carrera->nombre}}">{{$carrera->nombre}}</option>
						@endforeach
					</datalist>
					<span class="helper-text">Carrera <a href="#" class="edit" data-brother="edit_carreras">(Editar)</a></span>

				</div>

				<div class="input-field col s11 l5">
					<select name="edit_curso" id="edit_curso" class="select-editable browser-default">
						<option disabled selected>Curso</option>
						@for($i = 1; $i <= 10; $i++)
							<option class="curso_option" value="{{$i}}">{{$i}}</option>
						@endfor
					</select>
					<span class="helper-text">Curso</span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 l5 offset-l1">
					<i class="material-icons prefix">clear_all</i>
					<input class="input-editable unvaluable" type="text" list="dl-edit_posgrado" id="edit_posgrado" placeholder="Posgrado" name="edit_posgrado" readonly
					@if(old('edit_posgrado'))
						value="{{old('edit_posgrado')}}"
					@elseif(session('edit_posgrado')) value="{{session('edit_posgrado')}}"
					@endif
					>
					<span class="helper-text">Posgrado <a href="#" class="edit" data-brother="edit_posgrado">(Editar)</a></span>
					<datalist id="dl-edit_posgrado">
						@foreach($posgrados as $posgrado)
							<option value="{{$posgrado->nombre}}">{{$posgrado->nombre}}</option>
						@endforeach
					</datalist>
				</div>	
				<div class="input-field col s11 l5">
					<i class="material-icons prefix">assignment_ind</i>
					<input class="input-editable unvaluable" type="text" list="dl-edit_profesiones" id="edit_profesiones" placeholder="Profesion" name="edit_profesion" readonly
					@if(old('edit_profesion'))
						value="{{old('edit_profesion')}}"
					@elseif(session('edit_profesion')) value="{{session('edit_profesion')}}"
					@endif
					>
					<datalist id="dl-edit_profesiones">
					@foreach($profesiones as $profesion)
						<option value="{{$profesion->nombre}}">{{$profesion->nombre}}</option>
					@endforeach
					</datalist>
					<span class="helper-text">Profesion <a href="#" class="edit" data-brother="edit_profesiones">(Editar)</a></span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 l5 offset-l1">
					<select name="edit_modalidades" id="edit_modalidades" class="select-editable browser-default">
						<option disabled selected>Modalidad</option>
						@foreach($modalidades as $modalidad)
							<option class="modalidades_option" value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
						@endforeach
					</select>
					<span class="helper-text">Modalidad</span>
				</div>
				<div class="input-field col l5 s11">
					<textarea class="input-editable unvaluable" id="edit_tema" name="edit_tema" readonly>@if(old('edit_tema')){{old('edit_tema')}}@elseif(session('edit_tema')){{session('edit_tema')}}@endif</textarea>
					<span class="helper-text">Tema <a href="#" class="edit" data-brother="edit_tema">(Editar)</a></span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 l5 offset-l1">
					<textarea class="input-editable unvaluable" id="edit_observaciones" name="edit_observacion" readonly

						@if(old('edit_observacion')) 
							value="{{old('edit_observacion')}}"
						@elseif(session('edit_observacion'))
							value="{{session('edit_observacion')}}
						@endif
						></textarea>
					<span class="helper-text">Observaciones <a href="#" class="edit" data-brother="edit_observaciones">(Editar)</a></span>
				</div>
				<div class="input-field col s11 l5">
					<select name="edit_paralelo" id="edit_paralelo" class="select-editable browser-default">
						<option disabled selected>Paralelo</option>
				    	@for($i = 65; $i<=70; $i++)
				    		<option class="paralelo_option" value="{{chr($i)}}">{{chr($i)}}</option>
				    	@endfor
					</select>
					<span class="helper-text">Paralelo</span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 l5 offset-l1">
					<i class="material-icons prefix">date_range</i>
					<input class="input-editable unvaluable" type="number" id="edit_validez" name="edit_validez" readonly
					@if(old('edit_validez'))
						value="{{old('edit_validez')}}"

					@elseif(session('edit_validez')!=null)
						value="{{session('edit_validez')}}"
					@endif
					>
					<span class="helper-text">Validez <a href="#" class="edit" data-brother="edit_validez">(Editar)</a></span>
				</div>
				<div class="input-field col s11 l5">
					<i class="material-icons prefix">attach_money</i>
					<input class="input-editable unvaluable" type="number" id="edit_precio" name="edit_precio" readonly required
					@if(old('edit_precio'))
						value="{{old('edit_precio')}}"
					@elseif(session('edit_precio')) value="{{session('edit_precio')}}"
					@endif
					>
					<span class="helper-text">Precio <a href="#" class="edit" data-brother="edit_precio">(Editar)</a></span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s11 l5 offset-l1">
					<input class="input-editable unvaluable" type="number" id="edit_avance" name="edit_avance" readonly
					@if(old('edit_avance'))
						value="{{old('edit_avance')}}"
					@elseif(session('edit_avance')) value="{{session('edit_avance')}}"
					@endif
					>
					<span class="helper-text">Avance % <a href="#" class="edit" data-brother="edit_avance">Editar</a></span>
				</div>
				<div class="input-field col s11 l5">
					<select name="edit_medio" id="edit_medio" class="select-editable browser-default">
						<option disabled selected>Medio</option>
						@foreach($medios as $medio)
							<option class="medios_option" value="{{$medio->id}}">{{$medio->nombre}}</option>
						@endforeach						
					</select>
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
		</form>
    </div>
  </div>
    @if(isset($modal) && $modal)
	  <!-- Modal Structure -->
	  <div id="modal1" class="modal">
	    <div class="modal-content">
	    	<div class="row ">
	    		<div class="col s6">
	      			<h5><b>Cotización # 12345</b></h5>
	    		</div>
	    		<div class="col s6" align="right">
	    			<b>dd/mm/aaaa hh:mm:ss</b> <br>
	    		</div>
	    	</div>
	      <div class="card-panel">
	      	<div class="row">
	      		<div class="row ">
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
<script type="module">
	import {Me} from "{{asset('js/cotizaciones/Methods.js')}}";
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
			//console.log(option);
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
			console.log(e.target.dataset.info);
			let data = JSON.parse(e.target.dataset.info);
			console.log(data);
			let edit_options_selected = [];
			for(let key in data){
				switch (data[key].type){
					case "default":{
						let input = document.getElementById(key);
						input.value = data[key].data;
					}
						break;
					case "select":{
						let option = document.querySelectorAll(data[key].selector);


						for(let i = 0; i < option.length; i++){

							if(option[i].innerText == data[key].data){
								edit_options_selected.push(option[i]);
								option[i].setAttribute('selected',true);
							}
						}
						instances_modal[1].options.onCloseEnd = function(){

							Me.resetEditModal(edit_options_selected);
							
						}
						
						break;
					}
					
				}
				

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