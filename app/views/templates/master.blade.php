<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')@if(Route::currentRouteName() != 'home') {{ ' - Curcol' }} @endif</title>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style/style.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style/flexboxgrid.min.css') }}">
</head>
<body>
  @if(!in_array(Route::currentRouteName(), array('home', 'register')))
    @include('templates.header')
  @endif
  @yield('content')
  @if(in_array(Route::currentRouteName(), array('search', 'timeline', 'profile', 'setting')))
  @include('templates.modal')
  @endif
  <script src="{{ URL::asset('js/main.js') }}" type="text/javascript" async></script>
  @if(Route::currentRouteName() === 'timeline')
  <script src="{{ URL::asset('js/timeline.js') }}" type="text/javascript" async></script>
  @endif
</body>
</html>
