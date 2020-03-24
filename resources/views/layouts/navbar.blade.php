<nav class="blue darken-2" style="position: fixed; z-index: 2">
	<div class="nav-wrapper">
	  
	  <ul id="nav-mobile" class="right hide-on-med-and-down">
	  	@if(\Auth::user()->id_nivel === 1)
		    <li><a href="{{route('/')}}">Inicio</a></li>
		    <li><a href="{{route('users')}}">Personas</a></li>
		    <li><a href="{{route('cotizaciones')}}">Cotizaciones</a></li>
		    <li><a href="{{route('fichas_academicas')}}">Fichas</a></li>
		    <li><a href="#">Comprobantes</a></li>
		    <li><a href="{{route('contratos')}}">Contratos</a></li>
		    <li><a href="{{route('movimientos')}}">Movimientos</a></li>
		    <li><a href="#">Estadisticas</a></li>
	  	@else
		    <li><a href="{{route('cotizaciones')}}">Cotizaciones</a></li>
		    <li><a href="{{route('fichas_academicas')}}">Fichas</a></li>	    	
	  	@endif
		    <li><a href="{{ route('logout') }}">{{ __('logout') }}</a></li>
	  </ul>

	  <ul class="right hide-on-large-only">

	    <li><a class="blue darken-2 btn modal-trigger" href="#modal_menu"><i class="material-icons">menu</i></a></li>

	  </ul>

	</div>
</nav>