{{--  @extends('master')

@section('title')
Account
@endsection

@section('content')
<link rel='stylesheet' href={{URL::to('src/css/account.css')}}>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('dashboard')}}">Renegade</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


        <ul class="nav navbar-nav navbar-right">
          <li><a href="{{route('dashboard')}}">Dashboard</a></li>
          <li><a href="{{route('logout')}}">Logout</a></li>

        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


    <section class="row new-post">
      <div class="col-md-3"><div class="left"><h5>first name last name</h5>
        <h6>@<span>username</span></h6></div></div>
        <div class="col-md-9">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="" id="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="" id="last_name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="" id="email">
                </div>
                <div class='form-group'>
                    <button  id='changepwd' name='changepwd' type="button">Change Password</button>
                    <div id="change" style="display:None">
                        <label for="Currentpassword">Current Password</label>
                        <input type="password" name="curpwd">
                        <label for="newpassword">New Password</label>
                        <input type="password" name="newpwd">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpwd">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="bton">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        <!--</div>
    </section>-->
    
        <!--<section class="row new-post">
            <div class="col-md-6 col-md-offset-3">-->
                <img src="" alt="" class="img-responsive" style="height:200px;">
            </div>
        </section>
    
@endsection  --}}
@extends('master')

@section('title')
Account
@endsection

@section('content')
<link rel='stylesheet' href={{URL::to('src/css/account.css')}}>
 <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{route('dashboard')}}">Renegade</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{route('account')}}">Account</a></li>
            <li><a href="{{route('mychats')}}">Chats</a></li>
            <li><a href="{{route('myposts')}}">My Posts</a></li>
            <li><a href="{{route('logout')}}">Logout</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>

    <section class="row new-post">
      <div class="col-md-3 col-sm-12"><div class="left">
          {{--  <h5><!--{{ $user->first_name }}&nbsp{{ $user->last_name }}</h5>
        <h6>@<span>{{ $user->username }}</span></h6>-->  --}}
         {{--  <img src='{{Auth::user()->avatar}}' class='img-responsive'  alt='Profile picture'>   --}}
         <h5>John appleseed</h5>
         <p class="des">Profession<br>
         25,&nbspMale<br>
         California<br>
        <strong>Bio</strong> <br>
         tghhehhehhhhdh</p>



        </div></div>
        <div class="col-md-9 col-sm-12">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
                <div class='form-group'>
                    <button  id='changepwd' class="bton" name='changepwd' type="button">Change Password</button>
                    <div id="change" style="display:None">
                        <label for="Currentpassword">Current Password</label>
                        <input type="password" class="form-control" name="curpwd">
                        <label for="newpassword">New Password</label>
                        <input type="password" class="form-control" name="newpwd">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password"  class="form-control" name="confirmpwd">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image" >
                </div>
                <button type="submit" class="bton">Save Account</button>
                <input type="hidden"  name="_token">
            </form>
        </div>
    </section>
    {{--  @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))-->
        <section class="row new-post">
            <div class="col-md-6 col-md-offset-3">  --}}
                {{--  <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive" style="height:200px;">  --}}
            {{--  </div>
        </section>
    @endif  --}}
@endsection
