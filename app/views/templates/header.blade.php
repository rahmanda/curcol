<nav class="top-nav">
  <div>
  <h1 class="brand"><a href="{{ route('timeline') }}">Curcol</a></h1>
  <ul class="list-nav">
    <li class="profile-menu hidden">
      @if(Session::has(User::$sessionField['fullname']))
      {{ Session::get(User::$sessionField['fullname']) }}
      @endif
      <ul class="profile-sub-menu">
        <li class="menu-profile"><a href="{{ route('profile', Session::get(User::$sessionField['username'])) }}">Profile</a></li>
        <li class="menu-setting"><a href="{{ route('setting') }}">Account setting</a></li>
        <li class="menu-logout"><a href="{{ route('logout') }}">Logout</a></li>
      </ul>
    </li>
    <li class="post-menu">
      <a href="#">Post</a>
    </li>
  </ul>
  <div class="form-search">
  {{ Form::open(array('url' => 'search', 'method' => 'GET')) }}
  {{ Form::text('query', Input::old('query'), array('placeholder' => 'Pencarian')) }}
  {{ Form::close() }}
  </div>
  </div>
</nav>