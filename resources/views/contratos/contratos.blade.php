@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
	
@section('head')
	<link rel="stylesheet" href="{{asset('css/contratos/main.css')}}">
@endsection
@section('breadcrumbs')
    <a href="#!" class="breadcrumb">Contratos</a>
@endsection
@section('main')
	<div class="row" style="margin-top:5%">
		<div class="col s10 offset-s1">
			<div class="card-panel">
				<form action="{{route('buscar_contratos')}}">

					<div class="row">

						<div class="col s4">

							<input type="month" name="date" value="{{date('Y-m')}}" class="browser-default">

						</div>

						<div class="col s6 offset-s1">

							<input style="width: 100%" type="text" name="string" placeholder="Buscar Contratos" class="browser-default"><br>
							<a class="" href="{{route('contratos')}}">Resetear resultados</a>
							<!--button class="btn blue darken-2">Buscar</button-->
						</div>

						<div class="col s1">

							<label class="material-icons">search</label>

						</div>

					</div>

				</form>
				<div class="row">
					<hr>
					<table class="striped centered">
						<thead>
							<tr>
								<th>Numero de Contrato</th>
								<th>Asesor</th>
								<th>Cliente</th>
								<th>Tipo de contrato</th>
								<th>Monto</th>
								<th>Daf</th>
							</tr>
						</thead>
						<tbody>
							@forelse($contratos as $contrato)
								<tr class="link" data-link="{{route('ver_contrato',$contrato->id)}}">
									<td>{{$contrato->numero_contrato}}</td>
									<td>{{$contrato->asesor->usuario->persona->nombre}} {{$contrato->asesor->usuario->persona->apellido}} </td>
									<td>{{$contrato->cliente->persona->nombre}} {{$contrato->cliente->persona->apellido}} </td>
									<td>{{$contrato->tipoContrato->nombre}}</td>
									<td>{{$contrato->monto}}</td>
									<td>{{$contrato->usuarioDaf->usuario->persona->nombre}} {{$contrato->usuarioDaf->usuario->persona->apellido}}</td>
								</tr>
							@empty
								<tr>
									<td colspan="6">No se han registrado contratos</td>
								</tr>
							@endforelse
						</tbody>
					</table>
					{{$contratos->links()}}
				</div>
			</div>
		</div>
	</div>
 
@endsection

<script type="module" src="{{asset('js/contratos/main.js')}}"></script>