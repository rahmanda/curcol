@extends('templates.master')

@section('title')
User setting
@stop

@section('content')
@include('templates.flash')
<div class="setting">
  <header id="header" class="setting-header">
    <h2 class="title">Account</h2>
    <p class="desc">Change your basic account and language settings</p>
  </header>
  <div class="content">
    {{ Form::open(array('url' => route('setting'))) }}
    <div class="group-settings">
      <div class="input input-username">
        <div>
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', $user->username) }}
        </div>
        <p class="desc">{{ route('profile', $user->username) }}</p>
      </div>
      <div class="input input-fullname">
        <div>
        {{ Form::label('fullname', 'Fullname') }}
        {{ Form::text('fullname', $user->fullname) }}
        </div>
        <p class="desc">Your fullname would better represents the one that your moms had given it to you</p> 
      </div>
      <div class="input input-email">
        <div>
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', $user->email) }}
        </div>
        <p class="desc">Email will not publicly displayed</p>
      </div>
    </div>
    <div class="setting-acts">
      <div class="input input-submit">
        {{ Form::submit('Save') }}
      </div>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop