@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
@section('breadcrumbs')
    <a href="#!" class="breadcrumb">Personas</a>
    <a href="#!" class="breadcrumb">Ver persona</a>
@endsection
@section('main')
	<div class="container">
		<form action="{{url('modificar_persona')}}" method="post">
			@csrf
			<input name="id" value="{{$persona->id}}" hidden>
			<div class="row">

				
				<div class="col s12 l6">
					<div class="card-panel">
						<center>
							<h5>Datos generales</h5>
						</center>
						<hr>
						<div class="row">
							<div class="col s12">
								<b>Rol:</b>
								@if($rol == 'asesor')
									Asesor
									<input hidden name="tipo" type="text" value="asesor">
								@elseif($rol == 'usuario')
									Usuario del sistema
									<input hidden name="tipo" type="text" value="usuario">
								@else
									Cliente
									<input hidden name="tipo" type="text" value="cliente">
								@endif
							</div>
						</div>
						<div class="row">
							
							<div class="input-field col s12 l6">
								<span class="helper-text">Nombre</span>
								<input type="text" name="nombre" value="{{$persona->nombre}}">
							</div>
							<div class="input-field col s12 l6">
								<span class="helper-text">Apellido</span>
								<input type="text" name="apellido" value="{{$persona->apellido}}">
							</div>
							<div class="input-field col s12 l6">
								<span class="helper-text">Cedula</span>
								<input type="text" name="cedula" value="{{$persona->cedula}}">
							</div>
							@if($rol == 'cliente')
								<div class="input-field col s12 l6">

									<span class="helper-text">Expedido</span>
									<select name="expedicion">
										@foreach($ciudades as $ciudad)
											<option
												@if($ciudad->id == $persona->cliente->expedicion->nombre)
												 selected
												@endif
											value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
										@endforeach
										
									</select>

								</div>
							@endif
							<div class="input-field col s12 l6">
								<span class="helper-text">Telefono</span>
								<input type="text" name="telefono" value="{{$persona->telefono}}">
							</div>
							<div class="input-field col s12 l6">
								<span class="helper-text">Celular</span>
								<input type="text" name="celular" value="{{$persona->celular}}">
							</div>
							<div class="input-field col s12 l6">
								<span class="helper-text">Direccion</span>
								<input type="text" name="direccion" value="{{$persona->direccion}}">
							</div>
							<div class="input-field col s12 l6">
								<span class="helper-text">Email</span>
								<input type="text" name="email" value="{{$persona->email}}">
							</div>
							<div class="input-field col s12 l6">
								<span class="helper-text">Estado</span>
								<select name="estado">
									<option @if($persona->estado == 1) selected @endif value="1">Activo</option>
									<option @if($persona->estado == 0) selected @endif value="0">Inactivo</option>
									
								</select>
							</div>
						</div>
					</div>
					
				</div>

				<div class="col s12 l6">
					
					<div class="card-panel">
						<center>
							<h5>Datos Específicos</h5>
						</center>
						<hr>
						@if($rol == 'cliente')
							<b>Datos de Cliente</b>
							<div class="row">

								<div class="input-field col s12 l6">

									<span class="helper-text">Residencia</span>
									<select name="residencia">
										@foreach($ciudades as $ciudad)
											<option
												@if($ciudad->id == $persona->cliente->residencia->nombre)
												 selected
												@endif
											value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
										@endforeach
										
									</select>

								</div>
								<div class="input-field col s12 l6">

									<span class="helper-text">Carnet</span>
									<input type="text" name="carnet" value="{{$persona->cliente->carnet}}">

								</div>
								
							</div>
						@else
							<b>Datos de Usuario</b>

							<div class="row">
								
								<div class="input-field col s12 l6">

									<span class="helper-text">Nombre de usuario</span>
									<input type="text" name="usuario" value="{{$persona->users->username}}">

								</div>
								<div class="input-field col s12 l6">

									<span class="helper-text">Contraseña</span>
									<input type="text" name="contrasena">

								</div>
							</div>

							@if($rol == 'asesor')

								<b>Datos de Asesor</b>

								<div class="row">
									<div class="input-field col s12 l6">
										<span class="helper-text">Carrera</span>
										<select name="carrera" id="">
											@foreach($carreras as $carrera)
												<option
													@if($carrera->id == $persona->users->asesor->id_carrera)
														selected
													@endif
												value="{{$carrera->id}}">{{$carrera->nombre}}</option>
											@endforeach
										</select>

									</div>
									<div class="input-field col s12 l6">
										<span class="helper-text">Sexo</span>
										<select name="sexo">
											<option @if($persona->users->asesor->sexo == 1) selected @endif value="1">Femenino</option>
											<option @if($persona->users->asesor->sexo == 2) selected @endif value="2">Masculino</option>
											
										</select>

									</div>
									
								</div>
							@endif
						@endif
					</div>
				</div>
			</div>
		<input type="submit" id="submit" hidden>
		</form>
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<center>
						<a href="#modal" class="btn green modal-trigger">Guardar Cambios</a>
					</center>
				</div>
			</div>
		</div>
		
	</div>
  <div id="modal" class="modal">
    <div class="modal-content">
    	<center>
	      <h4>¿Realmente desea guardar los cambios?</h4><br>
	      <label for="submit" class="btn green">Guardar</label>
	      <a href="#!" class="modal-close btn red darken-1">Cancelar</a>
    		
    	</center>
    </div>
  </div>

@endsection
<script type="module">

	window.addEventListener('load',function(){
		
		@if ($errors->any())
            @foreach ($errors->all() as $error)
    			M.toast({html:"{{$error}}"});
            @endforeach
		@endif

	    var elems_select = document.querySelectorAll('select');
    	var instances = M.FormSelect.init(elems_select);

    	var elems_modal = document.querySelectorAll('.modal');
    	var instances = M.Modal.init(elems_modal);
	});

</script>
