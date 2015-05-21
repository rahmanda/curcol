<div class="bg-modal modal hidden">
<div class="modal-post">
  <header>
    <h3>Compose new post</h3>
    <span class="btn btn-close">X</span>
  </header>
  <div class="content">
    {{ Form::open(array('url' => 'tweet')) }}
    <div class="input input-tweet">
      <textarea name="tweet" spellcheck="false"></textarea>
    </div>
    <div class="acts">
      <div class="input input-submit">{{ Form::submit('Post') }}</div>
    </div>
    {{ Form::close() }}
  </div>
</div>
</div>