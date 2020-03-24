<!DOCTYPE html>
<html>
<head>
	<title>Fichas Academicas</title>
	<style type="text/css">
		#container{
			width:100%;
		}
		
		#logo{
			height:200px;
			width:25%;
		}
		#title{
			width:75%;
			float:left;
		}
		#title-content{
			border:1px solid grey;
			background: lightblue;
		}
		
		#content{		
			padding:10px;
			border-color: #eeeeee;
			border-collapse: collapse;
			text-align: center;
		}		
		.striped > td{
			background: lightgrey;
		}
	</style>
</head>
<body>
	<table id="container" align="center">
		<tr>
			<td id="logo"><img src="images/logo.png" height="150" width="250"></td>
			<td id="title">
				<div id="title-content">
					<center>
						<h3>Ficha Académica</h3>
					</center>
				</div><br>
				<b>Fecha de la consulta:</b> {{date('Y-m-d')}}
			</td>
		</tr>
		<tr>
			<td>
				<fieldset>
					<legend><b>Datos Personales</b></legend>
						<b>Cliente:</b> {{$ficha->cliente->persona->nombre}} {{$ficha->cliente->persona->apellido}} <br>
						<b>Direccion:</b> {{$ficha->cliente->persona->direccion}} <br>
						<b>Email:</b> {{$ficha->cliente->persona->email}} <br>
						<b>Telefono:</b> {{$ficha->cliente->persona->telefono}} <br>
						<b>Celular:</b> {{$ficha->cliente->persona->celular}} <br>
						<b>CI:</b> {{$ficha->cliente->persona->cedula}} <br>
						<b>CU:</b> {{$ficha->cliente->persona->cu}} <br>
				</fieldset>
			</td>
			<td>
				<table>
					<tr>
						<td>
							<fieldset>
								<legend>
									<b>Modalidad:</b>
								</legend>
								@if($ficha->cotizacion->modalidad !==null)
									{{$ficha->cotizacion->modalidad->nombre}}
								@else
									Dato no definido
								@endif
							</fieldset>

							<fieldset>
								<legend>
									<b>Nivel Académico:</b>
								</legend>
								@if($ficha->cotizacion->nivelAcademico !==null)
									{{$ficha->cotizacion->nivelAcademico->nombre}}
								@else
									Dato no definido
								@endif
							</fieldset>
						</td>
						<td>
							<fieldset>
								<legend>
									<b>Universidad:</b>
								</legend>
								@if($ficha->cotizacion->universidad !==null)
									{{$ficha->cotizacion->universidad->nombre}}
								@else
									Dato no definido
								@endif
							</fieldset>
						</td>
						<td>							
							<fieldset>
								<legend>
									<b>Asesor:</b>
								</legend>
								@if($ficha->asesor !==null)
									{{$ficha->asesor->usuario->persona->nombre}}
								@else
									No se ha realizado ningun contrato
								@endif
							</fieldset>
						</td>
					</tr>
					<tr>
						<td>
							<fieldset>
								<legend>
									<b>Datos Académicos:</b>
								</legend>
								@if($ficha->cotizacion->cotizacionPosgrado == null)
									@if($ficha->cotizacion->cotizacionGeneral->id_facultad !==null)
										<b>Facultad:</b> {{$ficha->cotizacion->cotizacionGeneral->facultad->nombre}}<br>
									@else
										<b>Facultad:</b> Dato no definido<br>
									@endif
									@if($ficha->cotizacion->cotizacionGeneral->id_carrera !==null)
										<b>Carrera:</b> {{$ficha->cotizacion->cotizacionGeneral->carrera->nombre}}<br>
									@else
										<b>Carrera:</b> Dato no definido<br>
									@endif
								@else
										<b>Facultad:</b>N/A<br>
										<b>Carrera:</b> N/A<br>
								@endif


								@if($ficha->cotizacion->id_profesion !==null)
									<b>Profesión:</b> {{$ficha->cotizacion->profesion->nombre}}<br>
								@else
									<b>Profesión:</b> Dato no definido<br>
								@endif
								@if($ficha->cotizacion->curso !==null)
									<b>Curso:</b> {{$ficha->cotizacion->curso->nombre}}
								@else
									<b>Curso:</b> Dato no definido
								@endif
								<br>
								@if($ficha->cotizacion->nivelAcademico !==null)
									<b>Nivel:</b> {{$ficha->cotizacion->nivelAcademico->nombre}}
								@else
									<b>Nivel:</b> Dato no definido
								@endif
							</fieldset>
						</td>
						<td>

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
									Dato no definido
								@endif
								<br>
								<b>Avance:</b> 
									@if($ficha->cotizacion->avance != null)
										{{$ficha->cotizacion->avance}}
									@else
										0
									@endif
								<br>
								@if($ficha->fecha_inicio !==null)
									<b>Fecha Inicio:</b> <span>{{$ficha->fecha_inicio}}</span> <br>
								@else
									<b>Fecha Inicio:</b> Dato no definido<br>
								@endif
								@if($ficha->fecha_fin !==null)
									<b>Fecha Fin:</b> <span>{{$ficha->fecha_fin}}</span>
								@else
									<b>Fecha Fin:</b> Dato no definido
								@endif
							</fieldset>
							<fieldset>
								<legend>
									<b>Etapa:</b>
								</legend>
								@if($ficha->etapa !==null)
									{{$ficha->etapa->nombre}}
								@else
									Dato no definido
								@endif
							</fieldset>
						</td>
						<td>
							<fieldset>
								<legend>
									<b>Número de registros:</b>
								</legend>
								<b>N° Cotización:</b>
								@if($ficha->cotizacion->numero_cotizacion !==null)
									<span>{{$ficha->cotizacion->numero_cotizacion}}</span>
								@else
									Dato no definido
								@endif
								<br>
								<b>Id Cotización:</b> <span>{{$ficha->cotizacion->id}}</span>
								<br>
								@if($ficha->contrato !==null)
									<b>N° Contrato:</b> {{$ficha->contrato->numero_contrato}}
								@else
									<b>N° Contrato:</b> Dato no definido
								@endif
								<br>
								@if($ficha->contrato !==null)
									<b>Id Contrato:</b> <span>{{$ficha->contrato->id}}</span>
								@else
									<b>Id Contrato:</b> Dato no definido
								@endif
								<br>
							</fieldset>
						</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>

</body>
</html>
