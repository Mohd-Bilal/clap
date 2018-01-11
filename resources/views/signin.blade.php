@extends('master')

@section('title')
Sign In
@endsection

@section('content')
<link rel='stylesheet' href={{URL::to('src/css/signin.css')}}>
<div class="toptext">
    <h3 class="grey">Build your world.</h3>
    <h3 class="grey">Yourself.</h3>
    <h3 class="blacktext">Renegade</h3>
</div>
    @if(count($errors) > 0)
        <div class="row">
          <div class="col-md-6">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                @endforeach
            </ul>
          </div>
        </div>
    @endif
    <div class="row fields">

        <div class="col-md-6 col-xs-12 block">
                <form action="{{route('postsignin')}}" method="post">
                  <div class='form-group {{$errors -> has('email') ? 'has-error' : '' }}'>
                    
                    <input class='form-control' type='text' name='username' id='name' value="{{ Request::old('username')}}" placeholder="Username">
                  
                </div>

                  <div class='form-group {{$errors -> has('password') ? 'has-error' : '' }}'>
                    
                    <input class='form-control' type='password' name='password' id='password' placeholder="Password">
                  </div>

                    <button type='submit' class='bton'>Log In</button>
                    <input type='hidden' name='_token' value='{{Session::token()}}'>
                </form>

            </div>
        </div>


       <!-- <script type="text/javascript">
      /*$(window).scroll(function() {
    if ($(this).scrollTop() > 1000) { // this refers to window
        alert('blah');
    }
});*/



       var $win = $(window);
    var winH = $win.height()/2;   // Get the window height.

    $win.on("scroll", function () {
        if ($(this).scrollTop() > winH ) {
            $('body').addClass("bg");
        } else {
            $('body').removeClass("bg");
        }
    }).on("resize", function(){ // If the user resizes the window
       winH = $(this).height()/2; // you'll need the new height value
    });

    </script>-->

@endsection
