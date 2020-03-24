@extends('layouts.app')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col s12 m6-offset-m3">
                <div class="card">
                    
                    <div class="row">
                        <div class="col l6 hide-on-med-and-down">
                            <img src="{{asset('images/logo.png')}}" class="responsive-img">
                        </div>
                        <div class="col l6 s12">
                            <div class="row">
                                <div class="col s12">
                                    <nav class="blue darken-2">
                                    <div class="nav-wrapper">
                                        <a class="brand-logo center">Login</a>
                                    </div>
                                    </nav>
                                    <div class="row">
                                        <form action="{{route('login_user')}}" method="POST">
                                        @csrf
                                        <div class="input-field col s10 offset-s1">
                                            <label for="username">{{ __('Username') }}</label>
                                                <input id="username" type="text" lass="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="input-field col s10 offset-s1">
                                    <label for="password">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" name="password">
                                    <span class="helper-text{{ $errors->has('password') ? ' is-invalid' : '' }}" data-success="right"name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                        {{ __('¿Contraseña olvidada?') }}
                                        </a>
                                    @endif</span>
                                    </div>
                                        <div class="input-field col s10 offset-s1">
                                        <center>
                                        <input class="btn blue darken-2" type="reset" value="limpiar">
                                        <button type="submit" class="btn blue darken-2">{{ __('login') }}</button>
                                                </center>
                                        </div>     
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection