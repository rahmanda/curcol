@if($errors->any())
<div class="flash flash-errors">
    <p>{{ $errors->first() }}</p>
</div>
@endif

@if(isset($message))
<div class="flash flash-success">
    <p>{{ $message }}</p>
</div>
@endif