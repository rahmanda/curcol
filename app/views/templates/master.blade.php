<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')@if(Route::currentRouteName() != 'home') {{ ' - Latweet' }} @endif</title>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style/flexboxgrid.min.css') }}">
</head>
<body>
  @if(!in_array(Route::currentRouteName(), array('home', 'register')))
    @include('templates.header')
  @endif
  @yield('content')
  @if(in_array(Route::currentRouteName(), array('search', 'timeline', 'profile')))
  @include('templates.modal')
  @endif
  <script src="{{ URL::asset('js/main.js') }}" type="text/javascript" async></script>
</body>
</html>