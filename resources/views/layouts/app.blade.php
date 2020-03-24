<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--link type="text/css" rel="stylesheet" href="{{asset('materialize/css/materialize.min.css')}}"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="{{asset('material-design-icons/iconfont/material-icons.css')}}"  media="screen,projection"/-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        @yield('head')
        <title>@yield('title','SAP')</title>

    </head>

    <body>
        <br><br><br>
        @yield('main')    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <!--script type="text/javascript" src="{{asset('materialize/js/materialize.min.js')}}"></script-->
        @yield('js')
    </body>
</html>
