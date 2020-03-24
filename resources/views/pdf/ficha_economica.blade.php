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
						<h3>Ficha Económica</h3>
					</center>
				</div>
				<br>
				<b>Fecha de la consulta:</b> {{date('Y-m-d')}}
				<br>
			</td>
		</tr>
		<tr>
			<td>
				<fieldset>
					<legend><b>Datos del cliente</b></legend>
						<b>Cliente:</b> {{$ficha_e->cotizacion->cliente->persona->nombre}} {{$ficha_e->cotizacion->cliente->persona->apellido}} <br>
						<b>Direccion:</b> {{$ficha_e->cotizacion->cliente->persona->direccion}} <br>
						<b>Email:</b> {{$ficha_e->cotizacion->cliente->persona->email}} <br>
						<b>Telefono:</b> {{$ficha_e->cotizacion->cliente->persona->telefono}} <br>
						<b>Celular:</b> {{$ficha_e->cotizacion->cliente->persona->celular}} <br>
						<b>CI:</b> {{$ficha_e->cotizacion->cliente->persona->cedula}} <br>
						<b>CU:</b> {{$ficha_e->cotizacion->cliente->carnet}} <br>
				</fieldset>
				<fieldset>
					<legend><b>Datos de la asesoría</b></legend>
						<b>Tema:</b> {{$ficha_e->cotizacon->tema}}<br>
						<b>Precio total:</b> {{$ficha_e->cotizacon->precio_total}}<br>
						<b>Avance:</b> {{$ficha_e->cotizacon->tema}}<br>
				</fieldset>
				
			</td>
		</tr>
	</table>

</body>
</html>
