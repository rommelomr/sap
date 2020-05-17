<!DOCTYPE html>
<html>
<head>
	<title>Fichas Academicas</title>
	<style type="text/css">
		*{
			margin:0;
			padding:0;
		}
		#container-table{
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
			padding-top: 1.5%;
			padding-bottom: 3%;
		}
		
		#content{		
			padding:10px;
			border-color: #eeeeee;
			border-collapse: collapse;
		}		
		#container{
			padding:10%;

		}		
		#footer{
			margin-top:5%;

		}		
		
		.striped{
			background: lightgrey;
		}

		fieldset{
			padding:1%;
			margin:1%;
		}


	</style>
</head>
<body>
	<div id="container">
		
		<table id="container-table">
			<tr>
				<td id="logo"><img src="images/logo.png" height="150" width="250"></td>
				<td id="title">
					<div id="title-content">
						<center>
							@if($cotizacion->cotizacionUniversitaria == null)

								<h3>Cotización Básica</h3>

							@elseif($cotizacion->cotizacionUniversitaria->cotizacionGeneral == null)

								<h3>Cotización Posgrado</h3>

							@else

								<h3>Cotización General</h3>

							@endif
						</center>
					</div>
					<br>
						<center>
							<b>Fecha de la consulta:</b> {{date('Y-m-d')}}						
						</center>
					<br>
				</td>
			</tr>
			<tr>
				<td valign="top" align="center">
					<fieldset>
						<legend class="legend">
							<b>Datos del cliente:</b> 
						</legend>
						<b>Nombre:</b> {{$cotizacion->cliente->persona->nombre}} {{$cotizacion->cliente->persona->apellido}}<br>
						<b>Cedula:</b> {{$cotizacion->cliente->persona->cedula}}<br>
						<b>Telefono:</b> {{$cotizacion->cliente->persona->telefono}}<br>
						<b>Celular:</b> {{$cotizacion->cliente->persona->celular}}<br>
						<b>Direccion:</b> {{$cotizacion->cliente->persona->direccion}}<br>
					</fieldset>
					<br>
					Pje. George Rouma #313 <br>
					64-37323 / 64-10334 <br>
					73430040 - 70322900
					con_positivo@hotmail.com

					<br><br>

					<b>Asesoramos en:</b>
						Tesis de Grado<br>
						Proyectos de Grado<br>
						Internados<br>
						Pasantías<br>
						Trabajos Dirigidos<br>
						Monografías<br>
						Ensayos Profesionales<br>
						Tesina<br>
				</td>
				<td valign="top">
					<fieldset>
						<legend class="legend"><b>Datos de cotización</b></legend>
						<fieldset class="striped">
							<b>Curso:</b> {{$cotizacion->curso}}°
						</fieldset>
						<fieldset>
							<b>Paralelo:</b> {{$cotizacion->paralelo}}
						</fieldset>					
						<fieldset class="striped">
							<b>Observación:</b> {{$cotizacion->observaciones}}
						</fieldset>					
						<fieldset>
							<b>Tema:</b> {{$cotizacion->tema}}
						</fieldset>					
						<fieldset class="striped">
							<b>Avance:</b> {{$cotizacion->avance}}
						</fieldset>					
						<fieldset>
							<b>Precio total:</b> {{$cotizacion->precio_total}} Bs.
						</fieldset>					
						@if($cotizacion->cotizacionUniversitaria != null)

							@if($cotizacion->cotizacionUniversitaria->cotizacionGeneral == null)
								
								<fieldset class="striped">
									<b>Posgrado:</b> {{$cotizacion->cotizacionUniversitaria->cotizacionPosgrado->posgrado->nombre}}
								</fieldset>					

							@else
								
								<fieldset class="striped">
									<b>Facultad:</b> {{$cotizacion->cotizacionUniversitaria->cotizacionGeneral->facultad->nombre}}
								</fieldset>					
								<fieldset>
									<b>Carrera:</b> {{$cotizacion->cotizacionUniversitaria->cotizacionGeneral->carrera->nombre}}
								</fieldset>					
								

							@endif
						@endif
					</fieldset>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<div id="footer">
						<center>
							Para egresados y profesionales, el trabajo de investigación concluye cuando el tribunal fija fecha de defensa. <br>
							Para estudiantes de último año, el trabajo de investigación concluye a la finalización del tercer panel.
						</center>
					</div>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
