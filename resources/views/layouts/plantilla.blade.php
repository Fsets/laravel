<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
</head>

<body>
    @include("layouts.navbar")
    @yield("cabecera")
    
    @include("layouts.card")
    @yield("infoGeneral")
    
    @yield("pie")
        
    Aqui iria el texto del pie

    
</body>
</html>
