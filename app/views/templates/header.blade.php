<nav class="top-nav">
  <div>
  <h1 class="brand"><a href="{{ route('timeline') }}">Latweet</a></h1>
  <ul class="list-nav">
    <li class="user-fullname">
      @if(Session::has(User::$sessionField['fullname']))
      <a href="{{ route('profile', Session::get(User::$sessionField['username']))}}">
        {{ Session::get(User::$sessionField['fullname']) }}
      </a>
      @endif
    </li>
    <li class="logout">
      <a href="{{ route('logout') }}">logout</a>
    </li>
  </ul>
  </div>
</nav>