@extends('templates.master')

@section('title')
{{ 'Registrasi' }}
@stop

@section('content')
@include('templates.flash')
<div class="form-register">
{{ Form::open(array('url' => 'register')) }}

<div class="input input-email">
  {{ Form::label('email', 'Email Address') }}
  {{ Form::text('email', Input::old('email'), array('placeholder' => 'your@email.com')) }}
</div>

<div class="input input-username">
  {{ Form::label('username', 'Username') }}
  {{ Form::text('username', Input::old('username'), array('placeholder' => 'yourusername')) }}
</div>

<div class="input input-fullname">
  {{ Form::label('fullname', 'Fullname') }}
  {{ Form::text('fullname', Input::old('fullname'), array('placeholder' => 'your full name')) }}
</div>

<div class="input input-password">
  {{ Form::label('password', 'Password') }}
  {{ Form::password('password', array('placeholder' => 'Minimum 5 characters')) }}
</div>

<div class="input input-validate-password">
  {{ Form::label('validate_password', 'Validate password') }}
  {{ Form::password('validate_password', array('placeholder' => 'Type again your password')) }}
</div>

<div class="input input-submit">{{ Form::submit('Daftar') }}</div>
{{ Form::close() }}
</div>
@stop
