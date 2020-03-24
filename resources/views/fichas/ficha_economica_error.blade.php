@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.menu')

@section('head')
    
@endsection
@section('main')
    <div class="row">
    	<div class="col s12 l6 offset-l3">
    		<div class="card-panel">
    			<center>
    				No se puede cargar una ficha económica si no se ha designado un contrato previamente
    				<br>
    				<br>
    				<a class="btn blue darken-2" href="{{route('cotizaciones')}}">Regresar</a>
    			</center>
    		</div>
    	</div>
    </div>

@endsection
