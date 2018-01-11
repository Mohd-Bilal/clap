@extends('master')



@section('title')
Sign Up
@endsection

@section('content')
<link rel='stylesheet' href={{URL::to('src/css/signup.css')}}>

    <h3>Sign up. Now.</h3>

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
        

                <form action="{{route('postsignup')}}" method="post">

                   <div class="row fields"><div class="col-md-6 col-xs-6">

                   <div class='form-group {{$errors -> has('first_name') ? 'has-error' : '' }}'>

                    <input class='form-control' type='text' name='first_name' id='first_name' value="{{ Request::old('first_name')}}" placeholder="First name">
                  </div>
                   </div>
                   <div class="col-md-6 col-xs-6">

                   <div class='form-group {{$errors -> has('user_name') ? 'has-error' : '' }}'>

                    <input class='form-control' type='text' name='username' id='username' value="{{ Request::old('username')}}" placeholder="Username">
                  </div>


                </div></div>
                <div class="row fields"><div class="col-md-6 col-xs-6">

                  <div class='form-group {{$errors -> has('last_name') ? 'has-error' : '' }}'>

                    <input class='form-control' type='text' name='last_name' id='last_name' value="{{ Request::old('last_name')}}" placeholder="Last name">
                  </div>


                </div>
                <div class="col-md-6 col-xs-6">

                  <div class='form-group'>

                    <input class='form-control' type='password' name='password' id='password' placeholder="Password">
                  </div>
                </div></div>

                 <div class="row fields"><div class="col-md-6 col-xs-12">
                  <div class='form-group {{$errors -> has('email') ? 'has-error' : '' }}'>

                    <input class='form-control' type='text' name='email' id='email' value="{{ Request::old('email')}}" placeholder="E-mail">
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">

                   <div class='form-group'>

                    <input class='form-control' type='password' name='confirmpassword' id='confirmpassword' placeholder="Confirm password">
                  </div>
                </div></div>
                  <div class="row fields"><div class="col-md-6 col-xs-12">

                  <div class='form-group'>
                  <select name="channel">
                    <option value=""disabled selected>Profession</option>
                    <option value="channel1">Student</option>
                    <option value="channel2">Engineer</option>
                    <option value="channel2">Doctor</option>
                    <option value="channel2">Police</option>
                    <option value="channel2">Techie</option>
                  </select>
                  </div>
                </div>
                <div class="col-md-6 col-xs-6">

                  <div class='form-group'>

                  <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  </div>

                </div></div>
                  
                  <div class="row fields"><div class="col-md-5 col-xs-5">
                      <label>Interest</label>
                  <div class='form-group'>
                      
                      <input class="check" type='checkbox' name='i1' >Arts</input>
                      <input class="check" type='checkbox' name='i2' >Science</input>
                      <input class="check" type='checkbox' name='i3' >Tech</input>
                      <input class="check" type='checkbox' name='i4' >Music</input>
                      <input class="check" type='checkbox' name='i5' >Business</input>

                  </div>



                </div></div>
                  {{--  <div class='form-group'>
                   <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" name='channel' type="button" data-toggle="dropdown">
                    Channels<span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">First</a></li>
                        <li><a href="#">Second</a></li>
                      </ul>
                   </div>
                  </div>
                  <div class='form-group'>
                   <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" name='gender' data-toggle="dropdown">
                    Gender<span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Male</a></li>
                        <li><a href="#">Female</a></li>
                      </ul>
                   </div>
                  </div>
                  <div class='form-group'>
                   <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" name='interest' data-toggle="dropdown">
                    Interest<span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Interest 1</a></li>
                        <li><a href="#">Interest 2</a></li>
                        <li><a href="#">Interest 3</a></li>
                      </ul>
                   </div>
                  </div> //  --}}
                  <div class="wrapper">
                    <button type='submit' class="bton">Sign Up</button><br>

                  </div>
                <input type='hidden' name='_token' value='{{Session::token()}}'>
              </form>
              <div class="wrapper">
                <a href="{{route('facebook')}}">  <button  class="bton"><i class="fa fa-facebook" aria-hidden="true"></i>&nbsp&nbspSign up with Facebook</button><a/>
              </div>
              <div class="wrapper">
                <a href="{{route('google')}}">  <button  class="bton"><i class="fa fa-google" aria-hidden="true"></i>&nbsp&nbspSign up with Google</button><a/>
              </div>
              <body>
                <script>
                  window.fbAsyncInit = function() {
                    FB.init({
                      appId      : '1657608050971549',
                      xfbml      : true,
                      version    : 'v2.11'
                    });
                    FB.AppEvents.logPageView();
                  };
                
                  (function(d, s, id){
                     var js, fjs = d.getElementsByTagName(s)[0];
                     if (d.getElementById(id)) {return;}
                     js = d.createElement(s); js.id = id;
                     js.src = "https://connect.facebook.net/en_US/sdk.js";
                     fjs.parentNode.insertBefore(js, fjs);
                   }(document, 'script', 'facebook-jssdk'));
                </script>
              </body>


@endsection
