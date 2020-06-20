@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
@section('breadcrumbs')
    <a href="#!" class="breadcrumb">Movimientos</a>
@endsection
@section('head')
	<link rel="stylesheet" href="{{asset('css/movimientos/main.css')}}">	
@endsection
@section('main')
	<div class="row">
		<div class="col s12 xl6">
			<div class="card-panel">
				<div class="row">
					<div class="col s12">
						<center>
							<h5><b>Caja Chica:</b> {{$monto_caja_chica}} Bs</h5>
							<a href="#movimiento" data-title="Cargar abono mensual" class="modal-trigger">Cargar abono mensual</a> 
						</center>
					</div>
				</div>
				<ul class="collapsible">
					@if(session('cargas') || isset($_GET['cargas']))
						@php session()->forget('cargas'); @endphp
				    	<li class="active">
					@else
				    	<li>
					@endif
				    	<div class="collapsible-header"><i class="material-icons">input</i>Cargas</div>
				    	<div class="collapsible-body">
				    		<form action="{{route('buscar_carga')}}">
				    			<div class="row" style="margin:0;padding:0">

				    				<div class="input-field col s4" style="margin-top:0;margin-bottom:0;">
				    					<!--input type="month" name="date" placeholder="Buscar egreso" value="{{date('Y-m')}}"-->
				    					<center>
				    						<!--span class="helper-text">AAAA/MM</span-->
				    					</center>
				    				</div>
				    			</div>
				    			<div class="row" style="margin:0;">

				    				<div class="input-field col s7 offset-s4" style="margin-top:0;margin-bottom:0;">
				    					<input type="text" name="string" placeholder="Buscar carga">
				    				</div>

				    				<div class="input-field col s1" style="margin-top:0;">
				    					<button href="#" class="btn-flat btn"><i class="material-icons">search</i></button>
				    				</div>
				    			</div>

				    		</form>
				    		<div class="row" style="margin:0">
				    			<div class="col s12">
				    				<a href="{{route('movimientos')}}">Resetear resultados</a>
				    			</div>
				    		</div>
				    		<table class="centered">
				    			<thead>
				    				<tr>
					    				<th>Fecha</th>
					    				<th>Monto</th>
					    				<th>A favor de</th>
					    				<th>Concepto</th>
				    				</tr>
				    			</thead>
				    			<tbody>
				    				@forelse($cargas as $carga)
				    				<tr>
					    				<td>{{$carga->created_at}}</td>
					    				<td>{{$carga->monto}}</td>
					    				<td>{{$carga->usuario->persona->nombre}} {{$carga->usuario->persona->apellido}}</td>
					    				<td>{{$carga->concepto}}</td>
				    				</tr>
				    				@empty
				    					No se han registrado cargas para este mes
				    				@endforelse
				    			</tbody>

				    		</table>
				    		<center>
				    			{{$cargas->appends(['cargas'=>$cargas->currentPage()])->links()}}
				    		</center>
				    	</div>
				    	
				    </li>
				    @if(session('tab_retiro_caja_chica') || isset($_GET['retiros']))
				    	@php session()->forget('tab_retiro_caja_chica'); @endphp
				    	<li class="active">
				    @else
				    	<li>
				    @endif
				    	<div class="collapsible-header">
				    			
					    	<i class="material-icons">reply</i>Retiros 
				    	</div>
				    	<div class="collapsible-body">
				    		<div class="row">
				    			<div class="col s4">
				    				<div class="card-panel">
					    				<center>
					    					<h5>Retirar</h5>
					    				</center>
				    					<form id="retirar_caja_chica" action="{{route('retirar_monto')}}" method="post">
				    						@csrf
				    						<div class="input-field">

				    							<input type="text" name="monto" value="{{old('monto')}}">
				    							<span class="helper-text">Monto</span>

				    						</div>
				    						<div class="input-field">

				    							<input type="text" name="concepto" value="{{old('concepto')}}">
				    							<span class="helper-text">Concepto</span>

				    						</div>
				    						<div class="input-field">
				    							<center>
				    								<button class="btn blue darken-2">Guardar</button>
				    							</center>
				    						</div>
				    						
				    					</form>
				    				</div>
				    			</div>
				    			<div class="col s8">
				    				<div class="row">
				    					<div class="col s12">
						    				<div class="card-panel">
									    		<form action="{{route('buscar_retiro')}}">
									    			<div class="row" style="margin:0">

									    				<div class="input-field col s6" style="margin-top:0;margin-bottom:0;">
									    					<!--input type="month" name="date" placeholder="Buscar egreso" value="{{date('Y-m')}}"-->
									    					<center>
									    						<!--span class="helper-text">AAAA/MM</span-->
									    					</center>
									    				</div>
									    			</div>
									    			<div class="row" style="margin:0">

									    				<div class="input-field col s7 offset-s4" style="margin-top:0;margin-bottom:0;">

									    					<input type="text" name="string" placeholder="Buscar retiro">
									    				</div>
									    				<div class="input-field col s1" style="margin-top:0;margin-bottom:0;">
									    					<center>
									    						<button class="btn btn-flat"><i class="material-icons">search</i></button>
									    					</center>
									    				</div>

									    			</div>
									    		</form>
									    		<div class="row" style="margin:0">
									    			<div class="col s12">
									    				<a href="{{route('movimientos')}}">Resetear resultados</a>
									    			</div>
									    		</div>
									    		<table class="centered">
									    			<thead>
									    				<tr>
										    				<th>Fecha</th>
										    				<th>Monto</th>
										    				<th>A favor de</th>
										    				<th>Concepto</th>
									    				</tr>
									    			</thead>
									    			<tbody>
									    				@forelse($retiros as $retiro)
									    				<tr>
										    				<td>{{$retiro->created_at}}</td>
										    				<td>{{$retiro->monto}}</td>
										    				<td>{{$retiro->usuario->persona->nombre}} {{$retiro->usuario->persona->apellido}}</td>
										    				<td>{{$retiro->concepto}}</td>
									    				</tr>
									    				@empty
									    					No hay <b>retiros</b> realizados este mes
									    				@endforelse
									    			</tbody>
									    		</table>
								    			<center>
								    				{{$retiros->appends(['retiros' => $retiros->currentPage()])->links()}}
								    			</center>
						    				</div>
				    					</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	
				    </li>
				    
				</ul>
			</div>
		</div>
		<div class="col s12 xl6">
			<div class="card-panel">

				<div class="row">
					<div class="col s12">
						<center>
							<h5><b>Movimientos</b></h5>(generales)
						</center>
					</div>
				</div>

				<ul class="collapsible">
					@if(session('ingresos') || isset($_GET['ingresos']))
					@php session()->forget('ingresos'); @endphp
				    <li class="active">
					@else
				    <li>
					@endif
				    	<div class="collapsible-header"><i class="material-icons">input</i>Ingresos</div>
				    	<div class="collapsible-body">
				    		<div class="row">
				    			<a href="#modal-crear-ingreso" class="modal-trigger">Agregar ingreso</a>
							</div>
				    		<form action="{{asset('buscar_ingreso')}}">

				    			<div class="row" style="margin:0;">

				    				<div class="input-field col s4" style="margin-top:0;margin-bottom:0">
				    					<!--input type="month" name="date" placeholder="Buscar egreso" value="{{date('Y-m')}}"-->
				    					<center>
				    						<!--span class="helper-text">AAAA/MM</span-->
				    					</center>
				    				</div>

				    			</div>
				    			<div class="row" style="margin:0;">
				    				<div class="input-field col s7 offset-s4" style="margin-top:0;margin-bottom:0">
				    					<input type="text" name="string" placeholder="Buscar ingreso">
				    				</div>

				    				<div class="input-field col s1" style="margin-top:0;margin-bottom:0">
				    					<button class="btn btn-flat darken-2"><i class="material-icons">search</i></button>
				    				</div>

				    			</div>
				    		</form>
				    		<div class="row" style="margin:0">
				    			<div class="col s12">
				    				<center>
				    					<a href="{{route('movimientos')}}">Resetear resultados</a>
				    				</center>
				    			</div>
				    		</div>
				    		<label>Haga clic en algun registro para ver detalles</label>
				    		<table class="centered highlight">
				    			<thead>
				    				<tr>
					    				<th>Fecha</th>
					    				<th>Monto</th>
					    				<th>Concepto</th>
				    				</tr>
				    			</thead>
				    			<tbody>
				    				@forelse($ingresos as $ingreso)
				    				<tr class="registro_editable" data-fecha="{{$ingreso->created_at}}" data-movimiento="{{$ingreso->tipoIngreso->nombre}}" data-pago="{{$ingreso->tipoPago->nombre}}" data-concepto="{{$ingreso->concepto}}" data-recibo="{{$ingreso->numero_recibo}}" data-monto="{{$ingreso->monto}}">
					    				<td>{{$ingreso->created_at}}</td>
					    				<td>{{$ingreso->monto}}</td>
					    				<td>{{$ingreso->concepto}}</td>
				    				</tr>
				    				@empty
				    				<tr>
				    					<td colspan="3">No hay ingresos registrados</td>
				    				</tr>
				    				@endforelse
				    			</tbody>
				    		</table>
				    		{{$ingresos->appends(['ingresos' => $ingresos->currentPage()])->links()}}
				    	</div>
				    	
				    </li>
					@if(session('egresos') || isset($_GET['egresos']))
					@php session()->forget('egresos'); @endphp
				    	<li class="active">
					@else
				    	<li>
					@endif
				    	<div class="collapsible-header">
				    			
					    	<i class="material-icons">reply</i>Egresos 
				    	</div>
				    	<div class="collapsible-body">
				    		<div class="row">
				    			<div class="col s12">
				    				<div class="row">
				    					<a href="#realizar-egreso" class="modal-trigger">Realizar retiro</a>
				    				</div>
				    				<div class="row">
				    					<div class="col s12">
						    				<div class="card-panel">
									    		<form action="{{asset('buscar_egreso')}}">
									    			<div class="row" style="margin:0">
									    				<div class="input-field col s4" style="margin-top:0;margin-bottom:0">
									    					<!--input type="month" name="date" placeholder="Buscar egreso" value="{{date('Y-m')}}"-->
									    					<center>
									    						<!--span class="helper-text">AAAA/MM</span-->
									    					</center>
									    				</div>
									    			</div>
									    			<div class="row" style="margin:0">
									    				<div class="input-field col s7 offset-s4" style="margin-top:0;margin-bottom:0">
									    					<input type="text" name="string" placeholder="Buscar egreso">
									    				</div>
									    				<div class="input-field col s1" style="margin-top:0;margin-bottom:0">
									    					<button class="btn btn-flat darken-2"><i class="material-icons">search</i></button>
									    				</div>
									    			</div>
									    		</form>
									    		<div class="row" style="margin:0">
									    			<div class="col s12">
									    				<center>
									    					<a href="{{route('movimientos')}}">Resetear resultados</a>
									    				</center>
									    			</div>
									    		</div>
									    		<table class="centered">
									    			<thead>
									    				<tr>
										    				<th>Fecha</th>
										    				<th>Monto</th>
										    				<th>Concepto</th>
									    				</tr>
									    			</thead>
									    			<tbody>
									    				@forelse($egresos as $egreso)
										    				<tr class="registro_editable" data-fecha="{{$egreso->created_at}}" data-pago="{{$egreso->tipoPago->nombre}}" data-movimiento="{{$egreso->tipoEgreso->nombre}}" data-concepto="{{$egreso->concepto}}" data-recibo="{{$egreso->numero_recibo}}" data-monto="{{$egreso->monto}}">
											    				<td>{{$egreso->created_at}}</td>
											    				<td>{{$egreso->monto}}</td>
											    				<td>{{$egreso->concepto}}</td>
										    				</tr>
									    				@empty
									    					<tr>
									    						<td colspan="3">No hay ningun egreso registrado</td>
									    					</tr>
									    				@endforelse
									    			</tbody>
									    		</table>
									    		<center>
										    		{{$egresos->appends(['egresos' => $egresos->currentPage()])->links()}}
									    		</center>
						    				</div>
				    					</div>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    	
				    </li>
				</ul>

			</div>
		</div>
	</div>
@endsection

<div id="modal-crear-ingreso" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5 class="center">Cargar Ingreso</h5>
			</div>
		</div>
		<div class="row">
			<form action="{{route('crear_ingreso')}}" method="POST">
				@csrf
				<div class="input-field col s12 l6">
					<input type="text" name="ingreso_monto" value="{{old('ingreso_monto')}}">
					<span class="helper-text">Monto</span>
				</div>
				<div class="input-field col s12 l6">
					<input type="text" name="ingreso_concepto" value="{{old('ingreso_concepto')}}">
					<span class="helper-text">Concepto</span>
				</div>
				<div class="input-field col s12 l6">
					<input type="text" name="ingreso_numero_recibo" value="{{old('ingreso_numero_recibo')}}">
					<span class="helper-text">Número de recibo</span>
				</div>
				<div class="input field col s12 l6">
					<select name="ingreso_id_tipo_pago" class="browser-default">
						<option disabled selected>Tipo de Pago</option>
						@foreach($tipos_pago as $tipo_pago)
							@if(old('ingreso_id_tipo_pago') == $tipo_pago->id)
								<option selected value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
							@else
								<option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="input-field col s12">
					<center>
							<button class="btn blue darken-2">Guardar</button>
					</center>
				</div>
				
			</form>
		</div>
	</div>
	<div class="modal-footer">
	  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>
<div id="movimiento" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5 class="center">Cargar abono mensual</h5>
			</div>
		</div>
		<div class="row">
			<form action="{{route('crear_carga')}}" method="POST">
				@csrf
				<div class="input-field col s12 l6">
					<input type="text" name="monto" value="{{old('monto')}}">
					<span class="helper-text">Monto</span>
				</div>
				<div class="input-field col s12 l6">
					<input type="text" name="concepto" value="{{old('concepto')}}">
					<span class="helper-text">Concepto</span>
				</div>
				<div class="input-field col s12">
					<center>
							<button class="btn blue darken-2">Guardar</button>
					</center>
				</div>
				
			</form>
		</div>
	</div>
	<div class="modal-footer">
	  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>
<div id="realizar-egreso" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<h5 class="center">Retirar</h5>
			</div>
		</div>
		<div class="row">
			<form action="{{route('crear_egreso')}}" method="POST">
				@csrf
				<div class="input-field col s12 l6">
					<input type="text" name="egreso_monto" value="{{old('egreso_monto')}}">
					<span class="helper-text">Monto</span>
				</div>
				<div class="input-field col s12 l6">
					<input type="text" name="egreso_concepto" value="{{old('egreso_concepto')}}">
					<span class="helper-text">Concepto</span>
				</div>
				
				<div class="input-field col s12 l6">
					<input type="text" name="egreso_numero_recibo" value="{{old('egreso_numero_recibo')}}">
					<span class="helper-text">Numero de recibo</span>
				</div>
				<div class="input field col s6">
					<select name="egreso_id_tipo_pago" class="browser-default">
						<option disabled selected>Tipo de Pago</option>
						@foreach($tipos_pago as $tipo_pago)
							@if(old('egreso_id_tipo_pago') == $tipo_pago->id)
								<option selected value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
							@else
								<option value="{{$tipo_pago->id}}">{{$tipo_pago->nombre}}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="input field col s6">
					<select name="egreso_id_tipo_egreso" class="browser-default">
						<option disabled selected>Tipo de Egreso</option>
						@foreach($tipos_egreso as $tipo_egreso)
							@if(old('egreso_id_tipo_egreso') == $tipo_egreso->id)
								<option selected value="{{$tipo_egreso->id}}">{{$tipo_egreso->nombre}}</option>
							@else
								<option value="{{$tipo_egreso->id}}">{{$tipo_egreso->nombre}}</option>
							@endif
						@endforeach
					</select>
				</div>
				
				<div class="input-field col s12">
					<center>
							<button class="btn blue darken-2">Guardar</button>
					</center>
				</div>
				
			</form>
		</div>
	</div>
	<div class="modal-footer">
	  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>

<div id="ver-ingreso" class="modal">
	<div class="modal-content">
		<div class="row">
			<div class="col s12">
				<center><h5>Detalles del <span id="tipo_movimiento"></span></h5></center>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<table class="striped">
					<tbody>
						<tr>
							<th>Fecha de registro</th>
							<td id="fecha"></td>
						</tr>
							<th>Tipo de movimiento</th>
							<td id="ingreso_egreso"></td>
						<tr>
							<th>Tipo de pago</th>
							<td id="pago"></td>
						</tr>
							<th>Concepto</th>
							<td id="concepto"></td>
						<tr>
							<th>Numero de recibo</th>
							<td id="recibo"></td>
						</tr>
						<tr>
							<th>Monto</th>
							<td id="monto"></td>
						</tr>
					</tbody>
				</table>	
			</div>
		</div>
	</div>
	<div class="modal-footer">
	  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>

<script type="module">
	import {Mat} from '{{asset("js/movimientos/materialize.js")}}';
	window.addEventListener('load',function(){
		let vars = Mat.loadMaterialize();

	    @if ($errors->any())
	        @foreach ($errors->all() as $error)
	        	M.toast({html:  '{{ $error }}' })
	        @endforeach
	    
	    @endif
        @if(session('messages'))
            @foreach(session('messages') as $messages)
                M.toast({html:  '{{$messages}}' })                
            @endforeach

        @endif
        @if(session('crear_egreso'))
        	vars['modals'][2].open();
        @endif
        @if(session('ingreso'))
        	vars['modals'][0].open();
        @endif
        @if(session('carga'))
        	vars['modals'][1].open();
        @endif

        Mat.setEventIngresos(vars['modals'][3]);
	});
</script>
<script src="{{asset('js/movimientos/main.js')}}" type="module"></script>