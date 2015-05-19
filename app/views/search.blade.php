@extends('templates.master')

@section('title')
{{ 'Pencarian untuk '.$query }}
@stop

@section('content')
@include('templates.flash')
<div class="query-title">
  <h2>{{ $query }}</h2>
</div>
<div class="search-result row">
  @foreach($results as $result)
  <div class="search-item col-md-4 col-sm-6 col-xs-12">
    <div>
    <header>
      <div class="img"></div>
    </header>
    <div class="info">
      <span class="fullname"><a href="{{ route('profile', $result->username) }}">{{ $result->fullname }}</a></span>
      <span class="username">@<a href="{{ route('profile', $result->username) }}">{{ $result->username }}</a></span>
    </div>
    <div class="act">
      @if(in_array($result->id, $followIds))
      <a class="btn-unfollow" href="{{ route('unfollow', $result->id) }}">Unfollow</a>
      @else
      <a class="btn-follow" href="{{ route('follow', $result->id) }}">Follow</a>
      @endif
    </div>
    </div>
  </div>
  @endforeach
</div>
@stop