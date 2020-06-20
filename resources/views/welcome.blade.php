@extends('layouts.app')
@extends('layouts.menu')
@extends('layouts.navbar')
@section('breadcrumbs')
    <a href="#!" class="breadcrumb">Principal</a>
@endsection
@section('main')
    <div class="row">
        
  <div id="modal_menu">
    <div class="modal-content">
      <center>
        
        <h4>Menú principal</h4>
      </center>
      <div class="row">
        @if(\Auth::user()->id_nivel === 1)
        <div class="col s3">
          <a href="{{route('/')}}">
            <div class="card-panel blue lighten-3">
              <center>
                <i class="material-icons">home</i>
                <br>
                Inicio
              </center>
            </div>
          </a>
        </div>
        <div class="col s3">
          <a href="{{route('users')}}">
            <div class="card-panel purple lighten-3">
              <center>
                <i class="material-icons">person</i>
                <br>
                Personas
              </center>
            </div>
          </a>
        </div>
        <div class="col s3">
          <a href="{{route('cotizaciones')}}">
            <div class="card-panel green lighten-3">
              <center>
                <i class="material-icons">content_paste</i>
                <br>
                Cotizaciones
              </center>
            </div>
          </a>
        </div>
        <div class="col s3">


          <a href="{{route('fichas_academicas')}}">
            <div class="card-panel yellow lighten-3">
              <center>
                <i class="material-icons">chrome_reader_mode</i>
                <br>
                Fichas
              </center>
            </div>
          </a>
        </div>
        <div class="col s3">
          <a href="{{route('contratos')}}">
            <div class="card-panel brown lighten-3">
              <center>
                <i class="material-icons">assignment</i>
                <br>
                Contratos
              </center>
            </div>
          </a>
        </div>
        <div class="col s3" hidden>
          <a href="#">
            <div class="card-panel orange lighten-3">
              <center>
                <i class="material-icons">poll</i>
                <br>
                Estadisticas
              </center>
            </div>
          </a>
        </div>
        <div class="col s3">
          <a href="{{route('movimientos')}}">
            <div class="card-panel grey">
              <center>
                <i class="material-icons">attach_money</i>
                <br>
                Movimientos
              </center>
            </div>
          </a>
        </div>
        @else
        <div class="col s3">
          <a href="{{route('cotizaciones')}}">
            <div class="card-panel green lighten-3">
              <center>
                <i class="material-icons">content_paste</i>
                <br>
                Cotizaciones
              </center>
            </div>
          </a>
        </div>
        <div class="col s3">


          <a href="{{route('fichas_academicas')}}">
            <div class="card-panel yellow lighten-3">
              <center>
                <i class="material-icons">chrome_reader_mode</i>
                <br>
                Fichas
              </center>
            </div>
          </a>
        </div>
        @endif
        <div class="col s3">


          <a href="{{route('logout')}}">
            <div class="card-panel red lighten-3">
              <center>
                <i class="material-icons">settings_power</i>
                <br>
                Cerrar Sesión
              </center>
            </div>
          </a>
        </div>
        
      </div>
    </div>
  </div>
  
    </div>
@endsection
