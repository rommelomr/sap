<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cotización</title>
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<style type="text/css">
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed,
		figure, figcaption, footer, header, hgroup,
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font: inherit;
			font-size: 100%;
			vertical-align: baseline;
		}

		html {
			line-height: 1;
		}

		ol, ul {
			list-style: none;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
		}

		caption, th, td {
			text-align: left;
			font-weight: normal;
			vertical-align: middle;
		}

		q, blockquote {
			quotes: none;
		}
		q:before, q:after, blockquote:before, blockquote:after {
			content: "";
			content: none;
		}

		a img {
			border: none;
		}

		article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
			display: block;
		}

		body {
			font-family: 'Source Sans Pro', sans-serif;
			font-weight: 300;
			font-size: 12px;
			margin: 0;
			padding: 0;
		}
		body a {
			text-decoration: none;
			color: inherit;
		}
		body a:hover {
			color: inherit;
			opacity: 0.7;
		}
		body .container {
			min-width: 500px;
			margin: 0 auto;
			padding: 0 20px;
		}
		body .clearfix:after {
			content: "";
			display: table;
			clear: both;
		}
		body .left {
			float: left;
		}
		body .right {
			float: right;
		}
		body .helper {
			display: inline-block;
			height: 100%;
			vertical-align: middle;
		}
		body .no-break {
			page-break-inside: avoid;
		}
		header figure {
			float: left;
			width: 60px;
			height: 60px;
			margin-right: 10px;
			background-color: #8BC34A;
			border-radius: 50%;
			text-align: center;
		}
		header figure img {
			margin-top: 13px;
		}
		header .company-address {
			float: left;
			max-width: 150px;
			line-height: 1.7em;
		}
		header .company-address .title {
			color: #8BC34A;
			font-weight: 400;
			font-size: 1.5em;
			text-transform: uppercase;
		}
		header .company-contact {
			float: right;
			height: 60px;
			padding: 0 10px;
			background-color: #8BC34A;
			color: white;
		}
		header .company-contact span {
			display: inline-block;
			vertical-align: middle;
		}
		header .company-contact .circle {
			width: 20px;
			height: 20px;
			background-color: white;
			border-radius: 50%;
			text-align: center;
		}
		header .company-contact .circle img {
			vertical-align: middle;
		}
		header .company-contact .phone {
			height: 100%;
			margin-right: 20px;
		}
		header .company-contact .email {
			height: 100%;
			min-width: 100px;
			text-align: right;
		}

		section .details {
			margin-bottom: 30px;
		}
		section .details .client {
			width: 50%;
			line-height: 20px;
		}
		section .details .client .name {
			color: #8BC34A;
		}
		section .details .data {
			width: 50%;
			text-align: right;
		}
		section .details .title {
			margin-bottom: 0px;
			color: #8BC34A;
			font-size: 3em;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: 0.9166em;
		}
		section table .qty, section table .unit, section table .total {
			width: 15%;
		}
		section table .desc {
			width: 55%;
		}
		section table thead {
			display: table-header-group;
			vertical-align: middle;
			border-color: inherit;
		}
		section table thead th {
			padding: 5px 10px;
			background: #8BC34A;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #FFFFFF;
			text-align: right;
			color: white;
			font-weight: 400;
			text-transform: uppercase;
		}
		section table thead th:last-child {
			border-right: none;
		}
		section table thead .desc {
			text-align: left;
		}
		section table thead .qty {
			text-align: center;
		}
		section table tbody td {
			padding: 10px;
			background: #E8F3DB;
			color: #777777;
			text-align: right;
			border-bottom: 5px solid #FFFFFF;
			border-right: 4px solid #E8F3DB;
		}
		section table tbody td:last-child {
			border-right: none;
		}
		section table tbody h3 {
			margin-bottom: 5px;
			color: #8BC34A;
			font-weight: 600;
		}
		section table tbody .desc {
			text-align: left;
		}
		section table tbody .qty {
			text-align: center;
		}
		section table.grand-total {
			margin-bottom: 45px;
		}
		section table.grand-total td {
			padding: 5px 10px;
			border: none;
			color: #777777;
			text-align: right;
		}
		section table.grand-total .desc {
			background-color: transparent;
		}
		section table.grand-total tr:last-child td {
			font-weight: 600;
			color: #8BC34A;
			font-size: 1.18181818181818em;
		}

		footer 
		{
			position: fixed; left: 0px; bottom: -180px; right: 20px; height: 150px; margin-bottom: 430px;
		}
		footer .thanks {
			margin-bottom: 290px;
			color: #8BC34A;
			font-size: 1.16666666666667em;
			font-weight: 600;
		}
		footer .notice {
			margin-bottom: 290px;
		}
		footer .end {
			padding-top: 5px;
			border-top: 2px solid #8BC34A;
			text-align: center;
		}
	</style>
</head>

<body>
	<section>
    <header class="clearfix">
    	<table>
    		<tr>
				<th class="qty container">
					<div id="logo">
					<img src="images/logo.png" style="left: 0px; right: 50px; height: 150px; width: 250px; margin-bottom: 100px;">
					</div>
				</th>
				<th class="desc">
					<div class="details clearfix data left">
						<div class="title">Cotizaciones</div>
							<div class="email">Nº: {{$cotizacion->id}}<br></div>
							<div class="email">Fecha: {{$cotizacion->created_at}}<br></div>
							<div class="email">
								Señor(es): {{$cotizacion->cliente->persona->nombre}} {{$cotizacion->cliente->persona->apellido}}<br>
							</div>
							<div class="email">
								Direccion: {{$cotizacion->cliente->persona->direccion}} <br>
							</div>
							<div class="email">
								Telefono: {{$cotizacion->cliente->persona->telefono}}<br>
							</div>
							<div class="email">
								Celular: {{$cotizacion->cliente->persona->celular}}<br>
							</div>
						</div>
					</div>
				</th>
			</tr>
      </table>
    </header>

			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="qty">Referencia</th>
						<th class="desc">Descripción</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="qty"><h3>Nivel:</h3></td>
						<td class="desc">{{$nivel->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Universidad:</h3></td>
						<td class="desc">{{$universidad->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Facultad:</h3></td>
						<td class="desc">{{$facultad->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Carrera:</h3></td>
						<td class="desc">{{$carrera->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Profesion:</h3></td>
						<td class="desc">{{$profesion->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Curso/Grado:</h3></td>
						<td class="desc">{{$grado->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Modalidad:</h3></td>
						<td class="desc">{{$modalidad->nombre}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Tema:</h3></td>
						<td class="desc">{{$cotizacion->tema}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Avance:</h3></td>
						<td class="desc">{{$cotizacion->avance}}</td>
					</tr>
					<tr>
						<td class="qty"><h3>Observaciones:</h3></td>
						<td class="desc">{{$cotizacion->observaciones}}</td>
					</tr>

				</tbody>
			</table>
			<div class="no-break">
				<table class="grand-total">
					<tbody>
						<tr>
							<td class="desc"></td>
							<td class="unit" colspan="2">TOTAL:</td>
							<td class="total">{{$cotizacion->precio_total}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<div class="thanks">Forma de Pago 50% al inicio del trabajo de investigacion y el saldo a la entrega.</div>
			<div class="notice">
				<div>Validez de la Oferta: 5 dias calendario</div>
				<div>Por que medios se enteró de la Consultora: REDES SOCIALES (FACEBOOK)</div>
				<div>Para egresados y profesionales, el trabajo de investigacion concluye cuando el tribunal fija fecha de defensa.</div>
				<div>Para estudiantes de ultimo año, el trabajo de investigacion concluye a la finalización del tercer panel.</div>
		</div>
			</div>
			
	</footer>

</body>
</html>
