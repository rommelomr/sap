@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
	
@section('head')
@endsection
@section('main')
@php
	if(session('tab'))
		$tab = session('tab');
	else if(isset($_GET['ingresos']))
		$tab = 'ingreso';
	else if(isset($_GET['pagos']))
		$tab = 'egreso';
	else 
		$tab = false;
	if(session('open'))
		$open = session('open');
	else
		$open = false;
	
@endphp
	<div class="row">
		<div class="col s12 l6">
			<div class="card-panel">
				<div class="row valign-wrapper">
					<div class="col s6">
						<fieldset>
							<legend><b>Detalles económicos</b></legend>
							<b>Precio de la asesoría:</b>  {{$ficha->cotizacion->precio_total}} <br>
							<b>Asesor:</b> {{$ficha->cotizacion->ficha->asesor->usuario->persona->nombre}} {{$ficha->cotizacion->ficha->asesor->usuario->persona->apellido}}<br>
							<b>Cliente:</b> {{$ficha->cotizacion->cliente->persona->nombre}} {{$ficha->cotizacion->cliente->persona->apellido}}<br>
							<b>Fecha del contrato:</b> {{$ficha->contrato->created_at}} <br>
							<b>Monto acordado con el asesor:</b> {{$ficha->contrato->monto}} <br>
							<b>Abono al asesor:</b> {{$abono_asesor}} <br>
							<b>Abono del cliente:</b> {{$abono_cliente}} <br>
						</fieldset>
					</div>
					<div class="col s6">
						<center>
							<button class="registrar_pago btn blue" data-tipo="asesor">
								Pagar al asesor
							</button><br><br>
							<button class="registrar_pago btn green" data-tipo="cliente">
								Registrar pago del cliente
							</button>
							
						</center>
					</div>
				</div>
				<ul class="collapsible">
					@if($tab === 'ingreso')
				    	<li class="active">
					@else
				    	<li>
					@endif
				    	<div class="collapsible-header"><i class="material-icons">face</i>Ejecución financiera del cliente</div>
				    	<div class="collapsible-body">
				    		<table class="">
				    			</tr>
				    				<th>Fecha</th>
				    				<th>Monto</th>
				    				<th>Opciones</th>
				    			</tr>
				    		@forelse($pagos_cliente as $pagos)
				    			<tr>
				    				<td>{{$pagos->created_at}}</td>
				    				<td>
				    					<input style="width:70%" id="ingreso_{{$pagos->ingreso->id}}" disabled type="text" value="{{$pagos->ingreso->monto}}">

				    					<button disabled class="btn blue darken-2 guardar" data-id_pago="{{$pagos->ingreso->id}}" id="button_ingreso_{{$pagos->ingreso->id}}" data-tipo="ingreso" data-input="ingreso_{{$pagos->ingreso->id}}"><i class="material-icons">save</i></button>
				    				</td>
				    				<td>
				    					<a class="editar" data-button_brother="button_ingreso_{{$pagos->ingreso->id}}" data-input_brother="ingreso_{{$pagos->ingreso->id}}"><i class="material-icons">edit</i></a>
				    					<a href="#"><i class="material-icons">remove_red_eyes</i></a>
				    				</td>
				    			</tr>
				    				
				    		@empty
				    			No se ha registrado ningun pago
				    		@endforelse
				    			
				    		</table>
				    		<center>
				    			{{$pagos_cliente->links()}}
				    		</center>
				    	</div>
				    	
				    </li>
				    @if($tab === 'egreso')
				    	<li class="active">
					@else
				    	<li>
					@endif
				    	<div class="collapsible-header"><i class="material-icons">assignment_ind</i>Ejecución financiera del asesor</div>
				    	<div class="collapsible-body">
				    		<table class="centered">
				    			</tr>
				    				<th>Fecha</th>
				    				<th>Monto</th>
				    				<th>Opciones</th>
				    			</tr>
				    		@forelse($pagos_asesor as $pagos)
				    			<tr>
				    				<td>{{$pagos->created_at}}</td>
				    				<td>
				    					<input style="width:70%" id="egreso_{{$pagos->egreso->id}}" disabled type="text" value="{{$pagos->egreso->monto}}">

				    					<button disabled class="btn blue darken-2 guardar" data-id_pago="{{$pagos->egreso->id}}" id="button_pago_{{$pagos->egreso->id}}" data-tipo="egreso" data-input="egreso_{{$pagos->egreso->id}}"><i class="material-icons">save</i></button>
				    				</td>
				    				<td>
				    					<a class="editar" data-button_brother="button_pago_{{$pagos->egreso->id}}" data-input_brother="egreso_{{$pagos->egreso->id}}"><i class="material-icons">edit</i></a>
				    					<a href="#"><i class="material-icons">remove_red_eyes</i></a>
				    				</td>
				    			</tr>
				    				
				    		@empty
				    			No se ha registrado ningun pago
				    		@endforelse
				    		</table>
				    		<center>
				    			{{$pagos_asesor->links()}}
				    		</center>
				    	</div>

				    </li>
				</ul>
			</div>
		</div>
		<div class="col s12 l6">
			@if($open == 'cliente')
				<div id="container_cliente" class="card-panel">
			@else
				<div id="container_cliente" class="card-panel" hidden="true">
			@endif
				<center><h5>Registrar pago del cliente</h5></center>
				<hr>
				<form action="{{route('pagar_cliente')}}" method="POST">
					@csrf
					<input hidden name="id_cliente" value="{{$ficha->cotizacion->cliente->id}}">
					<input hidden name="id_ficha_economica" value="{{$ficha->id}}">
					<div class="row">
						<div class="input field col s12 l6">
							<select name="cliente_id_tipo_pago">
								<option disabled selected>Tipo de Pago</option>
								@foreach($tipos_pago as $tipo_pago)
									@if(old('cliente_id_tipo_pago') == $tipo_pago->id)
										<option selected value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
									@else
										<option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="input field col s12 l6">
							<select name="cliente_id_modalidad">
								<option disabled selected>Modalidad</option>
								@foreach($modalidades as $modalidad)
									@if(old('cliente_id_modalidad') == $modalidad->id)
										<option selected value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
									@else
										<option value="{{$modalidad->id}}">{{$modalidad->nombre}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="input field col s12 l6">
							@if(old('cliente_numero_recibo'))
								<input type="text" name="cliente_numero_recibo" value="{{old('cliente_numero_recibo')}}">
							@else
								<input type="text" name="cliente_numero_recibo">
							@endif
							<span class="helper-text">N° Recibo</span>
						</div>
						<div class="input field col s12 l6">
							@if(old('cliente_monto'))
								<input type="text" name="cliente_monto" value="{{old('cliente_monto')}}">
							@else
								<input type="text" name="cliente_monto">
							@endif
								<span class="helper-text">Monto</span>
						</div>
						<div class="input field col s12 l6">
							@if(old('cliente_concepto'))
								<input type="text" name="cliente_concepto" value="{{old('cliente_concepto')}}">
							@else
								<input type="text" name="cliente_concepto">
							@endif
							<span class="helper-text">Concepto</span>
						</div>
						<div class="input field col s12">
							<br>
							<center>
								<button class="btn blue">Registrar</button>
							</center>
						</div>
					</div>

				</form>
			</div>
		</div>
		
		@if($open == 'asesor')
			<div id="container_asesor" class="col s12 l6">
		@else
			<div id="container_asesor" class="col s12 l6" hidden>
		@endif
			<div class="card-panel">
				<center><h5>Realizar pago al asesor</h5></center>
				<hr>
				<form action="{{route('pagar_asesor')}}" method="POST">
					@csrf
					<input hidden name="id_asesor" value="{{$ficha->cotizacion->ficha->asesor->id}}">
					<input hidden name="id_ficha_economica" value="{{$ficha->id}}">
					<input hidden name="asesor_id_modalidad" value="{{$ficha->cotizacion->id_modalidad}}">
					<div class="row">
						<div class="input field col s12 l6">
							<select name="asesor_tipo_pago">
								<option disabled selected>Tipo de Pago</option>
								@foreach($tipos_pago as $tipo_pago)
									@if(old('asesor_tipo_pago') == $tipo_pago->id)
										<option selected value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
									@else
										<option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="input field col s12 l6">
							@if(old('asesor_monto'))
								<input type="text" name="asesor_monto" value="{{old('asesor_monto')}}">
							@else
								<input type="text" name="asesor_monto">
							@endif
							<span class="helper-text">Monto</span>
						</div>
						<div class="input field col s12 l6">
							@if(old('asesor_numero_recibo'))
								<input type="text" name="asesor_numero_recibo" value="{{old('asesor_numero_recibo')}}">
							@else
								<input type="text" name="asesor_numero_recibo">
							@endif
							<span class="helper-text">N° Recibo</span>
						</div>
						<div class="input field col s12 l6">
							@if(old('asesor_concepto'))
								<input type="text" name="asesor_concepto" value="{{old('asesor_concepto')}}">
							@else
								<input type="text" name="asesor_concepto">
							@endif
							<span class="helper-text">Concepto</span>
						</div>
						<div class="input field col s12">
							<br>
							<center>
								<button class="btn blue darken-2">Realizar pago</button>
							</center>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
<form id="update_form" action="{{route('actualizar_pago')}}" method="post" hidden>
	@csrf
	<input id="input_id" name="id" value="">
	<input id="input_tipo" name="tipo">
	<input id="input_monto" type="text" name="monto">
	<button class="btn blue darken-2">Guardar</button>
</form>
@endsection
<script>
	window.addEventListener('load',function(){
		@if ($errors->any())
            @foreach ($errors->all() as $error)
    			M.toast({html:"{{$error}}"});
            @endforeach
		@endif
	});
</script>

<script src="{{asset('js/fichas/fichas_economicas/materialize.js')}}"></script>
<script src="{{asset('js/fichas/fichas_economicas/main.js')}}" type="module"></script>