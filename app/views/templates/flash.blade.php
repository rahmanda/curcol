@if($errors->any())
<div class="flash flash-errors">
    <p>{{ $errors->first() }}</p>
</div>
@endif

@if(Session::has('message'))
<div class="flash flash-success">
    <p>{{ Session::get('message') }}</p>
</div>
@endif