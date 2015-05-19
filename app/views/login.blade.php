@extends('templates.master')

@section('title')
{{ 'Welcome to the jungle, we\'ve got fun \'n games' }}
@stop

@section('content')
@include('templates.flash')
<div class="form-login">
<h1 class="form-title">Latweet</h1>
{{ Form::open(array('url' => 'login')) }}

<div class="input input-username">
    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', Input::old('username'), array('placeholder' => 'your username')) }}
</div>

<div class="input input-password">
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
</div>

<div class="input input-submit">{{ Form::submit('Login') }}</div>
<div class="link-register"><p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a> dulu yuk!</p></div>
{{ Form::close() }}
</div>
@stop