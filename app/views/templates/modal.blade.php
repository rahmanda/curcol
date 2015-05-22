<div class="bg-modal modal hidden">
<div class="modal-post">
  <header>
    <h3>Compose new post</h3>
    <span class="btn btn-close">X</span>
  </header>
  <div class="content">
    {{ Form::open(array('url' => 'tweet')) }}
    <div class="input input-tweet">
      <textarea name="tweet" spellcheck="false" maxlength="140"></textarea>
    </div>
    <div class="acts">
      <div class="input input-submit">{{ Form::submit('Post') }}</div>
      <p class="word-count">140</p>
    </div>
    {{ Form::close() }}
  </div>
</div>
</div>