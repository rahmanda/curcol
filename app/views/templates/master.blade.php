<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title')@if(Route::currentRouteName() != 'home') {{ ' - Latweet' }} @endif</title>
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('style.css') }}">
</head>
<body>
  @if(Route::currentRouteName() != 'home' && Route::currentRouteName() != 'register')
    @include('templates/header')
  @endif
  @yield('content')
</body>
</html>