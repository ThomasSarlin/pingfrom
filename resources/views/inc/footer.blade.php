<?php
    $country = Cookie::get('country');
    $userName = Cookie::get('userName');
?>
<footer class="footer">
    <div class="container text-center">
        @if($userName!=null)
        <span class="text-muted">In all actions on this site you are representing: 
            <strong>{{$country}}</strong> as <strong> {{$userName}}</strong>
        </span>
        @endif
    </div>
</footer>