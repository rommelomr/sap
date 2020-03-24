@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
	
@section('head')
@endsection
@section('main')
	<div class="row" style="margin-top:5%">
		<div class="col s10 offset-s1">
			<div class="card-panel">
				<div class="row">
					<form action="{{route('buscar_contratos')}}">
						<div class="input-field col s2">
							<input type="month" name="date" value="{{date('Y-m')}}">
							<span class="helper-text">YYYY/MM</span>
						</div>
						<div class="input-field col s8">
							<input type="text" name="string" placeholder="Buscar Contratos">
							<a class="" href="{{route('contratos')}}">Resetear resultados</a>
						</div>
					</form>
					<div class="col s2">
						<center>
							<button class="btn blue darken-2">Buscar</button>
						</center>
					</div>
				</div>
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
								<tr>
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