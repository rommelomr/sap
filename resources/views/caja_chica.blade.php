@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
	
@section('head')
	
@endsection
@section('main')
	<div class="row">
		<div class="col s10 offset-s1">
			<div class="card-panel">
				<nav class="blue darken-2">
					<div class="nav-wrapper">
						<div class="brand-logo center">Caja Chica</div>
					</div>
				</nav>
				<br>
				<div class="row">
					<div class="col s12">
						<center>
							<h5><b>Monto actual:</b> 250000$ <a href="#abon$" class="modal-trigger btn blue darken-2"><i class="material-icons">add</i></a></h5> 
						</center>
					</div>
				</div>
				<div class="row">
					<div class="col s6">
						<div class="card-panel">
							<center>
								<h5>Ingresos <a href="#comprobante" class="btn blue darken-2 modal-trigger"><i class="material-icons">add</i></a></h5>
								<table>
									<thead>
										<tr>
											<th>Recibo</th>
											<th>A favor</th>
											<th>Monto</th>
											<th>Fecha</th>
											<th>Concepto</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
									</tbody>
								</table>
							</center>
						</div>
					</div>
					<div class="col s6">
						<div class="card-panel">
							<center>
								<h5>Egresos <a href="#comprobante" class="btn blue darken-2 modal-trigger"><i class="material-icons">add</i></a></h5>
								<table>
									<thead>
										<tr>
											<th>Recibo</th>
											<th>A favor</th>
											<th>Monto</th>
											<th>Fecha</th>
											<th>Concepto</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
										<tr>
											<td>123</td>
											<td>Alennys Palma</td>
											<td>500$</td>
											<td>{{date('d-m-Y')}}</td>
											<td>Pasajes</td>
										</tr>
									</tbody>
								</table>
							</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 
<div id="abono" class="modal">
	<div class="modal-content">
		<h5>Abono a Caja Chica Mes de MMMMMM</h5>
		<form action="#">
			<div class="input-field">
				<label for="monto">Monto del abono</label>
				<input id="monto" type="number">
			</div>
			<div class="input-field">
				<center>
					<button class="btn blue darken-2">Guardar</button>
				</center>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>
<div id="comprobante" class="modal">
	<div class="modal-content">
		<h5>Agregar comprobante</h5>
		<b>Fecha:</b> {{date('d-m-Y h:i:s')}}
		<form action="#">
			<div class="row">
				
				<div class="input-field col s4">

					<label for="monto">Monto del abono</label>
					<input id="monto" type="number">

				</div>

				<div class="input-field col s4">
					<input id="monto" type="text" list="favor" placeholder="A favor de">
					<datalist id="favor">
						<option value="1">Rommel</option>
						<option value="2">Alennys</option>
						<option value="3">Manuel</option>
						<option value="4">Patricio</option>
					</datalist>

				</div>
				<div class="input-field col s4">
					<input id="concepto" type="text" placeholder="Concepto">
				</div>
			</div>

			<div class="input-field">
				<center>
					<button class="btn blue darken-2">Guardar</button>
				</center>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
	</div>
</div>

@endsection
