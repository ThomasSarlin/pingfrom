<?php
    $userName = Cookie::get('userName');
?>
<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">{{config('app.name','ClickWars')}}</a>
      @if($userName!=null)
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      @endif
    </div>
    @if($userName!=null)
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="/ping">Click</a></li>
        <li><a href="/stats">Stats</a></li>
        <li><a href="/chat">Chat</a></li>
        <li><a href="/userinfo">User Info</a></li>
      </ul>
    </div>
    @endif
  </div>
</nav>