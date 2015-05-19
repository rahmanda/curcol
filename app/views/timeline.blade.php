@extends('templates.master')

@section('title')
  @if(Route::currentRouteName() == 'timeline')
  {{ 'Timeline' }}
  @elseif(Route::currentRouteName() == 'profile')
  {{ 'Profil' }}
  @endif
@stop

@section('content')
@include('templates.flash')
<div class="timeline">
@if(Route::currentRouteName() == 'timeline')
<div class="box-tweet">
  {{ Form::open(array('url' => 'tweet')) }}
  <div class="input input-tweet">
    <textarea name="tweet" spellcheck="false" placeholder="What is happening?"></textarea>
  </div>
  <div class="input input-submit">{{ Form::submit('Tweet') }}</div>
  {{ Form::close() }}
</div>
@else
<div class="box-profile">
  <div class="profile-img"></div>
  <div class="profile-fullname"><p>{{ $profile->fullname }}</p></div>
  <div class="profile-username"><p>{{ '@'.$profile->username }}</p></div>
</div>
@endif
@if(isset($tweets))
  @if(Route::currentRouteName() == 'timeline')
    @foreach($tweets as $tweet)
    <div class="tweet">
      <header>
        <ul class="list-userdata">
          <li class="userdata-fullname"><a href="{{ route('profile', $tweet->username) }}">{{ $tweet->fullname }}</a></li>
          <li class="userdata-username">@<a href="{{ route('profile', $tweet->username) }}">{{ $tweet->username }}</a></li>
          <li class="userdata-date"><a href="#">{{ date_format(date_create($tweet->created_at), 'd M Y') }}</a></li>
        </ul>
      </header>
      <p class="message">{{ $tweet->tweet }}</p>
    </div>
    @endforeach
  @else
  @foreach($tweets as $tweet)
    <div class="tweet">
      <header>
        <ul class="list-userdata">
          <li class="userdata-fullname"><a href="{{ route('profile', $profile->username) }}">{{ $profile->fullname }}</a></li>
          <li class="userdata-username">@<a href="{{ route('profile', $profile->username) }}">{{ $profile->username }}</a></li>
          <li class="userdata-date"><a href="#">{{ date_format(date_create($tweet->created_at), 'd M Y') }}</a></li>
        </ul>
      </header>
      <p class="message">{{ $tweet->tweet }}</p>
    </div>
  @endforeach
  @endif
@endif
</div>
@stop