@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.menu')
@section('breadcrumbs')
    <a href="#!" class="breadcrumb">Personas</a>
@endsection
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
@endsection
@section('main')
    <div class="row">
        <div class="col s12 l6">
            <div class="card">
                <div class="row">
                    <div class="col s12">
                        <center>
                            <h5 class="nav-title">Registrar</h5>
                        </center>

                        <div class="content">

                            <form method="post" action="register">
                                <input name="tipo" value="1" hidden>
                                @csrf
                                <div class="row" style="margin-top:0">
                                    <br>
                                    <div class="col s12">
                                        <label>Datos Generales</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">person</i>
                                        <label for="nombre">Nombre</label>
                                        <input id="nombre" type="text" class="edit_username" name="nombre" @if(old('nombre')) value="{{old('nombre')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">person</i>
                                        <label for="apellido">Apellido</label>
                                        <input id="apellido" type="text" class="edit_username" name="apellido" @if(old('apellido')) value="{{old('apellido')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">credit_card</i>
                                        <label for="cedula">Cédula</label>
                                        <input id="cedula" type="text" name="cedula" @if(old('cedula')) value="{{old('cedula')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="id_ciudad_expedicion" id="">
                                                <option disabled selected>Expedido</option>
                                            @foreach($ciudades as $ciudad)
                                                <option 
                                                    @if($ciudad->id == old('id_ciudad_expedicion'))
                                                        selected
                                                    @endif

                                                value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                            @endforeach
                                        </select>
                                        <span class="helper-text">Expedido</span>
                                    </div>
                                    
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">email</i>
                                        <label for="email">Email</label>
                                        <input id="email" type="text" name="email" @if(old('email')) value="{{old('email')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">local_phone</i>
                                        <label for="telefono">Teléfono local</label>
                                        <input id="telefono" type="text" name="telefono" @if(old('telefono')) value="{{old('telefono')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">phone_android</i>
                                        <label for="celular">Celular</label>
                                        <input id="celular" type="text" name="celular" @if(old('celular')) value="{{old('celular')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">home</i>
                                        <label for="direccion">Dirección</label>
                                        <input id="direccion" type="text" name="direccion" @if(old('direccion')) value="{{old('direccion')}}" @endif>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="id_ciudad_residencia" id="">
                                                <option disabled selected>Residencia</option>
                                            @foreach($ciudades as $ciudad)
                                                <option
                                                    @if($ciudad->id == old('id_ciudad_residencia'))
                                                        selected
                                                    @endif
                                                value="{{$ciudad->id}}">{{$ciudad->nombre}}</option>
                                            @endforeach
                                        </select>
                                        <span class="helper-text">Residencia</span>
                                    </div>
                                    <div class="input-field col s6">
                                        <center>
                                            
                                            <div class="switch">
                                                <label>
                                                    Cliente
                                                    @if(old('type_user')==null)
                                                        <input id="check" type="checkbox" name="type_user">
                                                    @else
                                                        <input id="check" type="checkbox" name="type_user" checked>
                                                    @endif
                                                    <span class="lever"></span>
                                                    Usuario
                                                </label>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                                @if(old('type_user')==null)
                                    <div id="datos-usuario" class="row" style="margin-top:0" hidden>
                                @else
                                    <div id="datos-usuario" class="row" style="margin-top:0">
                                @endif
                                    <div class="col s12">
                                        <label>Datos de cuenta</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">people</i>
                                        <label for="">Nombre de usuario</label>
                                        <input id="username" type="text" name="username" @if(old('username')) value="{{old('username')}}" @endif value=" " class="tooltipped" data-position="top" data-tooltip="Debe rellenar el nombre y apellido para generar un nombre de usuario">
                                    </div>
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">locked</i>
                                        <label for="password">Password</label>
                                        @if(old('password'))
                                            <input id="password" type="text" name="password" value="{{old('password')}}">
                                        @else
                                            <input id="password" type="text" name="password" value="{{$pass}}">
                                        @endif
                                    </div>
                                    

                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">assignment_ind</i>
                                        <select id="nivel" name="nivel">
                                            @if(old('nivel')==1)
                                                <option selected value="1">Administrador</option>
                                            @else
                                                <option value="1">Administrador</option>
                                            @endif
                                            @if(old('nivel')==2)
                                                <option selected value="2">Asesor</option>
                                            @else
                                                <option value="2">Asesor</option>
                                            @endif
                                        </select>
                                        <label>Nivel</label>
                                    </div>
                                    @if(old('nivel')==2)
                                        <div id="datos-asesor">
                                    @else
                                        <div id="datos-asesor" hidden>
                                    @endif
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix">grade</i>
                                            <input id="profesion" type="text" name="profesion" list="profesiones" @if(old('profesion')) value="{{old('profesion')}}" @endif placeholder="Profesion">
                                            <datalist id="profesiones">
                                                
                                                <option disabled selected>Profesion</option>
                                                @forelse($carreras as $carrera)
                                                    <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                                                @empty
                                                    <option>No hay carreras disponibles</option>
                                                @endforelse
                                            </datalist>
                                        </div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix">child_care</i>
                                            <select id="nivel" name="sexo">
                                                <option disabled selected>Sexo</option>
                                                @if(old('sexo')==1)
                                                    <option selected value="1">Femenino</option>
                                                @else
                                                    <option value="1">Femenino</option>
                                                @endif
                                                @if(old('sexo')==2)
                                                    <option selected value="2">Masculino</option>
                                                @else
                                                    <option value="2">Masculino</option>
                                                @endif
                                            </select>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                @if(old('type_user')==null)
                                    <div class="row" style="margin-top:0" id="datos-cliente">
                                @else
                                    <div class="row" style="margin-top:0" id="datos-cliente" hidden>
                                @endif
                                    <div class="col s12">
                                        <label>Datos de cliente</label>
                                    </div>
                                    <div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix">contacts</i>
                                            <label for="cu">C.U</label>
                                            <input id="cu" type="text" name="cu" @if(old('cu')) value="{{old('cu')}}" @endif>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="input-field col s6">
                                            <i class="material-icons prefix">business</i>
                                            <label for="ubicacion">Ubicación</label>
                                            <input id="ubicacion" type="text" name="ubicacion" @if(old('ubicacion')) value="{{old('ubicacion')}}" @endif list="ubicaciones" autocomplete="off">
                                            <datalist id="ubicaciones">
                                                @forelse($ubicaciones as $ubicacion)
                                                    <option value="{{$ubicacion->nombre}}"></option>
                                                @empty
                                                @endforelse
                                            </datalist>
                                        </div>
                                    </div>

                                </div>
                                <div class="row" style="margin:0;padding:0">
                                    <div  class="input-field col s12">
                                        <center>
                                            <button class="btn blue darken-2">Registrar</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 l6">
            <div class="card">
                <div class="row">
                    <div class="col s12">
                        <center>
                            <h5 class="nav-title">Ver Persona</h5>
                        </center>
                        <br>
                        <div class=" row">
                            <div class="col s12">

                                <div class="col s8 offset-s2">
                                    <form action="{{url('buscar_personas')}}" method="get">
                                        @csrf
                                        <div class="input-field">
                                        
                                            <label for="buscar">Busca persona</label>
                                            <input id="buscar_usuario" type="submit" hidden>

                                            <input id="buscar" type="text" name="string">
                                            <span><label for="buscar_usuario"><i class="icon-button material-icons prefix">search</i></label></span>

                                        </div>
                                    </form>
                                </div>
                                @if(isset($personas))
                                    <div class="col s10 offset-s1">
                                        <ul class="collection">
                                            @forelse($personas as $persona)
                                                <li class="collection-item">

                                                    @if($persona->cliente != null)
                                                        <i class="material-icons">school</i>
                                                    @else
                                                        @if($persona->users->asesor != null)
                                                            <i style="color:green" class="material-icons">face</i>
                                                        @else
                                                            <i style="color:blue" class="material-icons">account_circle</i>
                                                        @endif
                                                    @endif
                                                    <b>Nombre:</b> {{$persona->nombre}} {{$persona->apellido}} | <b>Cédula:</b> {{$persona->cedula}}

                                                    <a href="{{route('users/',$persona->id)}}" class="modal-trigger">
                                                        <span style="color:blue" class="badge"><i class="material-icons">remove_red_eyes</i></span>

                                                    </a>
                                                </li>
                                            @empty
                                            @endforelse
                                        </ul>
                                    </div>
                                @endif




                                    @if(false)
                                    @php
                                        if(session('resultBusqueda')){
                                            $resultBusqueda = session('resultBusqueda');
                                            $carreras = session('carreras');
                                        }
                                    @endphp
                                    <?php 

                                            $datos = $resultBusqueda['datos'][array_key_first($resultBusqueda['datos'])];
                                     ?>

                                    <form method="post" action="{{route('edit_person')}}">
                                        @csrf
                                        <input name="id_persona" value="{{$datos['id']}}" hidden>
                                        <input name="id_cliente" value="{{$datos['id_cliente']}}" hidden>
                                        <input name="id_asesor" value="{{$datos['id_asesor']}}" hidden>
                                        <input name="id_user" value="{{$datos['id_user']}}" hidden>
                                        <div class="content row">
                                            <div class="col s12">
                                                <label>Datos Generales</label>
                                                <a class='right dropdown-trigger btn blue darken-2' href='#' style="margin:0" data-target='dropdown2'><i class="material-icons">menu</i></a>

                                              <!-- Dropdown Structure -->
                                                <ul id='dropdown2' class='dropdown-content'>
                                                    @if($datos['estado']==2)
                                                        <li><a class="changeState" data-state="1" href="#!">Activar</a></li>
                                                        <li><a class="changeState" data-state="3" href="#!">Eliminar Definitivamente</a></li>
                                                    @elseif($datos['estado']==1)
                                                        <li><a class="changeState" data-state="2" href="#!">Desactivar</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="input-field col s5">
                                                <i class="material-icons prefix">person</i>
                                                <label for="nombre">Nombre</label>
                                                <input class="input-editable" readonly id="new-nombre" type="text" name="nombre" value="{{$datos['nombre']}}">
                                                <i data-brother="new-nombre" class="icon-button edit material-icons prefix">edit</i>
                                            </div>
                                            <div class="input-field col s5 offset-s1">
                                                <i class="material-icons prefix">person</i>
                                                <label for="apellido">Apellido</label>
                                                <input class="input-editable" readonly id="new-apellido" type="text" name="apellido" value="{{$datos['apellido']}}">
                                                <i data-brother="new-apellido" class="icon-button edit material-icons prefix">edit</i>
                                            </div>
                                            <div class="input-field col s5">
                                                <i class="material-icons prefix">credit_card</i>
                                                <label for="cedula">Cédula</label>
                                                <input class="input-editable " readonly id="new-cedula" type="text" name="cedula" value="{{$datos['cedula']}}">
                                                <i data-brother="new-cedula" class="icon-button edit material-icons prefix">edit</i>
                                            </div>
                                            
                                            <div class="input-field col offset-s1 s5">
                                                <i class="material-icons prefix">email</i>
                                                <label for="email">Email</label>
                                                <input class="input-editable " readonly id="new-email" type="email" name="email" value="{{$datos['email']}}">
                                                <i data-brother="new-email" class="icon-button edit material-icons prefix">edit</i>
                                            </div>

                                            <div class="input-field col s5">
                                                <i class="material-icons prefix">local_phone</i>
                                                <label for="telefono">Telefono</label>
                                                <input class="input-editable " readonly id="new-telefono" type="text" name="telefono" value="{{$datos['telefono']}}">
                                                <i data-brother="new-telefono" class="icon-button edit material-icons prefix">edit</i>
                                            </div>
                                            
                                            <div class="input-field col s5 offset-s1">
                                                <i class="material-icons prefix">phone_android</i>
                                                <label for="celular">Celular</label>
                                                <input class="input-editable " readonly id="new-celular" type="text" name="celular" value="{{$datos['celular']}}">
                                                <i data-brother="new-celular" class="icon-button edit material-icons prefix">edit</i>
                                            </div>

                                            <div class="input-field col s5">
                                                <i class="material-icons prefix">home</i>
                                                <label for="direccion">Dirección</label>
                                                <input class="input-editable " readonly id="new-direccion" type="text" name="direccion" value="{{$datos['direccion']}}">
                                                <i data-brother="new-direccion" class="icon-button edit material-icons prefix">edit</i>
                                            </div>
                                            <div class="input-field col s5 offset-s1">
                                                <center>

                                                    @if($datos['estado']==1)
                                                      <nav class="green">
                                                        <div class="nav-wrapper">
                                                          <div class="col s12">
                                                            <a href="#!" class="breadcrumb">Usuario Activo</a>
                                                    @elseif($datos['estado']==2)
                                                    <nav>
                                                        <div class="nav-wrapper">
                                                          <div class="col s12">
                                                            <a href="#!" class="breadcrumb">Usuario Desactivado</a>
                                                    @endif
                                                            
                                                          </div>
                                                        </div>
                                                      </nav>
                                                </center>
                                            </div>
                                            @if($datos['id_nivel']!=null)
                                                <div id="new-datos-cliente" hidden>
                                            @else
                                                <div id="new-datos-cliente">
                                            @endif
                                                <div class="col s12">
                                                    <label>Datos de Cliente</label>
                                                </div>

                                                <div class="input-field col s5">
                                                    <i class="material-icons prefix">contacts</i>
                                                    <label for="cu">Carnet Universitario</label>
                                                    <input class="input-editable " readonly id="new-cu" type="text" name="cu" value="{{$datos['carnet']}}">
                                                    <i data-brother="new-cu" class="icon-button edit material-icons prefix">edit</i>
                                                </div>
                                            </div>
                                            @if($datos['id_nivel']!=null)
                                                <div id="new-datos-cuenta">
                                            @else
                                                <div id="new-datos-cuenta" hidden>
                                            @endif
                                                
                                                <div class="col s12">
                                                    <label>Datos de cuenta</label>
                                                </div>

                                                <div class="input-field col s5">
                                                    <i class="material-icons prefix">people</i>
                                                    <label for="username">Username</label>
                                                    <input class="input-editable " readonly id="new-username" type="text" name="username" value="{{$datos['username']}}">
                                                    <i data-brother="new-username" class="icon-button edit material-icons prefix">edit</i>
                                                </div>
                                                
                                                <div class="input-field col s5 offset-s1">
                                                    <i class="material-icons prefix">locked</i>
                                                    <label for="pass">Contraseña</label>
                                                    <input class="input-editable " readonly id="new-pass" type="text" name="pass">
                                                    <i data-brother="new-pass" class="icon-button edit material-icons prefix">edit</i>
                                                </div>

                                                @if($datos['id_nivel']==1)
                                                    <div class="input-field col s5" hidden>
                                                @elseif($datos['id_nivel']==2)
                                                    <div class="input-field col s5">
                                                @endif
                                                    <i class="material-icons prefix">grade</i>
                                                    <input id="new-profesion" type="text" name="profesion" list="profesiones" placeholder="Profesion" value="{{$datos['id_carrera']}}" readonly>
                                                    <i data-brother="new-profesion" class="icon-button edit material-icons prefix">edit</i>
                                                    <datalist id="profesiones">
                                                        
                                                        <option disabled selected>Profesion</option>
                                                        @forelse($carreras as $carrera)
                                                            <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                                                        @empty
                                                            <option>No hay carreras disponibles</option>
                                                        @endforelse
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                          <div class="col s12">
                                            <center>
                                                <button id="button-submit" class="btn green ligthen-3">Guardar</button>

                                            </center>
                                          </div>
                                            <!-- Dropdown Trigger -->
                                    </form>
                                    <form id="change-state-form" action="{{route('change_state')}}" method="post" hidden>
                                        @csrf
                                        <input name="id_persona" value="{{$datos['id']}}">
                                        <input id="state" name="state">
                                        <input id="change_state" type="submit">
                                    </form>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div id="#info-persona-modal" class="modal">
    <div class="modal-content">
      <h4>Informacion de la persona</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
@endsection

<script>
    
    var submitEnabled = false;
    function selectInput(e){
        var element = e.target;
        var id = element.dataset.brother;
        input = document.getElementById(id);
        input.removeAttribute('readonly');
        input.focus();
        old_input_value = input.value;
    }
    function activateSubmit(e){
        var input_modified = old_input_value == input.value;
        if(!submitEnabled && !input_modified){
            var button = document.getElementById('button-submit');
            button.removeAttribute('disabled');
        }
    }
    function setChangeState(e){
        var input_state = document.getElementById('state');
        input_state.value = e.target.dataset.state;
        document.getElementById('change-state-form').submit();
    }
      
    window.onload = function(){
        var elems_dropdowns = document.querySelectorAll('.dropdown-trigger');
        var instances_dropdowns = M.Dropdown.init(elems_dropdowns);

        var elems_select = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems_select);

        var edit = document.querySelectorAll('.edit');
        var max = edit.length;
        for(var i = 0; i<max; i++){

            edit[i].onclick = selectInput;
        }
        var changeState = document.querySelectorAll('.changeState');
        var max_change = changeState.length;

        for(var i = 0; i<max_change; i++){

            changeState[i].onclick = setChangeState;
        }

        var inputs = document.querySelectorAll('.input-editable');
        var max = inputs.length;
        for(var i = 0; i<max; i++){
            inputs[i].onkeyup = activateSubmit;
        }


        var checks = document.querySelectorAll('.check-editable');
        var max = checks.length;
        for(var i = 0; i<max; i++){

            checks[i].onchange = activateSubmit;
        }


        let check = document.getElementById('check');
        let usuario = document.getElementById('datos-usuario');
        let cliente = document.getElementById('datos-cliente');
        let nivel = document.getElementById('nivel');
        let asesor = document.getElementById('datos-asesor');

        nivel.onchange = function(){
            //console.log(check.checked);
            console.log(nivel.value);

            if(nivel.value==1){

                asesor.setAttribute("hidden",true);
            }else{

                asesor.removeAttribute("hidden");
            }
        }
        
        check.onchange = function(){
            console.log(check.checked);
            if(check.checked){

                if((editable[0].value == '') || (editable[1].value == '')){

                    instances_tooltips[0].open();
                }
            }else{
                instances_tooltips[0].close();

            }
            if(check.checked){
                cliente.setAttribute("hidden",true);
                usuario.removeAttribute("hidden");
            }else{
                cliente.removeAttribute("hidden");
                usuario.setAttribute("hidden",true);
            }
        }


        @if(isset($resultBusqueda))
            M.toast({html:  '{{$resultBusqueda['mensaje']}}' })
        @endif
        @if(session('messages'))
            @foreach(session('messages') as $messages)
                M.toast({html:  '{{$messages}}' })
            @endforeach

        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            M.toast({html:  '{{ $error }}' })
            @endforeach
        @endif


        let editable = document.querySelectorAll('.edit_username');
        let username = document.querySelector('#username');
        console.log(username);

        let num_new_user = Math.floor(Math.random() * (1 - 100)) + 100;
        function changeUsername(e){
            if((editable[0].value != '') && (editable[1].value != '')){
                instances_tooltips[0].close();
                let new_username = '';

                new_username = editable[0].value.substr(0,1) + editable[1].value + num_new_user;
                username.value = new_username;
            }else{
                let check = document.getElementById('check');
                if(check.checked){
                    instances_tooltips[0].open();
                    username.value="";
                }
            }
        }
        for(let i=0; i<editable.length;i++){
            editable[i].onkeyup = changeUsername;
        }

        var tooltips = document.querySelectorAll('.tooltipped');
        var instances_tooltips = M.Tooltip.init(tooltips);

        console.log(instances_tooltips);
    }

</script>

