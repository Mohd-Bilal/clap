@extends('master')


@section('title')
  Dashboard
@endsection
@include('postvalidate')
@section('content')
  <link rel='stylesheet' href={{URL::to('src/css/dashboard.css')}}>
  <link rel='stylesheet' href={{URL::to('src/css/myposts.css')}}>
  <script src={{URL::to('src/js/myposts.js')}}></script>
  <div id='error' class='error'>
  </div>
  <div id='success' class='success'>
  </div>
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
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('account')}}">Account</a></li>
            <li><a href="{{route('mychats')}}">Chats</a></li>
            <li><a href="{{route('logout')}}">Logout</a></li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
  <body>
    <div id="site-wrapper">
      <div id="site-canvas">
        <div id="site-menu">
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
          <br>
          <br>
          <h2>Albin</h2>
          <small>I really like the idea.im interested lets get tgther a team and start asap.</small>
          <a>accept</a>
        </div>
        <div id="hearts">
          <div class='row newpost'>

            <div class='col-md-9 container-fluid eq_height'>

              <!--</div></div>


              <div name='posts' class='row post'>
              <div class='col-md-3'></div>
              <div class='col-md-9'>-->


              <article data-postid='32'>
                <div class='info'>
                  testuser <br></div><div class="details">11:00pm
                  </div>
                  <p class="postcont">HELLO WORLD</p>
                  <div class='interaction'>
                    <p>
                      <a href='#' class='editpost' id='like'>Edit</a>&nbsp&nbsp
                      <a href='#' id='like'>Delete</a>
                      <a href="#" data-transition="ease" class="pull-right"><i class="fa"></i><span id='like'>Replies&nbsp&nbsp&nbsp</span></a>


                    </p>
                  </div>
                </article>

              </div>
            </div>
          </div>

          <div class="modal" tabindex="-1" role="dialog" id='editmodal'>
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Post</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close">

                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <label>Edit</label>
                  <textarea class='form-control' rows='5' col='5' id='editform'>
                  </textarea>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary bton" id='modal-save'>Save changes</button>
                  <button type="button" class="btn btn-secondary bton1" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


        </div>
        <script>
        var token='{{Session::token()}}';
        var url='{{route('edit')}}';
        var likeurl='{{route('like')}}';
        var  dashboard='{{route('dashboard')}}';
        var createpost='{{route('createpost')}}';
        </script>
      </div>
    </div>
  </div>
  <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>

</body>
@endsection
