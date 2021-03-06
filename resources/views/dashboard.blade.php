@extends('master') 
@section('title') Dashboard
@endsection
  @include('postvalidate') 
@section('content')
<link rel='stylesheet' href={{URL::to( 'src/css/dashboard.css')}}>
<div id='error' class='error'>
</div>
<div id='success' class='success'>
</div>
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
          aria-expanded="false">
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
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
<div class='row newpost'>
  <div class='col-md-3 container-fluid eq_height '>
    <div class="left">
      <h5>Your Feed</h5>
      {{-- <img src='{{Auth::user()->avatar}}' class='img-responsive' style='height:175px;' alt='Profile picture'> --}}
    </div>
  </div>
  <div class='col-md-9 container-fluid eq_height'>
    <section class='newpost'>

      <div class='form-group'>
        <textarea name='body' id='newpost' class='form-control' rows='7' placeholder='Share your thoughts here..'></textarea>
      </div>
      <button type='submit' class='bton' id='postit'>Post</button>

      <input type='hidden' value='{{Session::token()}}' name='_token'>

    </section>
    <!--</div></div>

      <div name='posts' class='row post'>
      <div class='col-md-3'></div>
      <div class='col-md-9'>-->
    @if ($posts != "success-feeds-empty") @php $username=session()->get('username'); @endphp @foreach($posts as $post)
    <article data-postid="{{$post->id}}">
      <div class='info'>
        {{$post->author->username}} <br></div>
      <div class="details">{{date("H:i:s | Y-m-d", strtotime($post->createdAt))}}
      </div>
      <p class="postcont">{{$post->post_content}}</p>
      <div class='interaction'>
        <a class="likecount" id="#{{$post->id}}">{{$post->like_count}}</a> @php $converted_res = ($post->current_user_post_like_state)
        ? 'true' : 'false'; @endphp @if ($converted_res =='true')
        <a href="javascript:void(0)" class="like" id='liked' name="{{$post->id}}">&nbspLike</a> @else
        <a href="javascript:void(0)" class="like" id='unliked' name="{{$post->id}}">&nbspLike&nbsp</a> @endif @if($username ==
        $post->author->username)
        <a class="delete" id="delete" href='{{route('post.delete',['post_id ' => $post->post_id])}}'>Delete</a>&nbsp&nbsp
        @endif {{--
        <p>
          <a href='#' class='like'>{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ?$likecount[$post->id]['likes'].' You liked this post' :$likecount[$post->id]['likes'].' Like':$likecount[$post->id]['likes'].' Like'  }}</a>&nbsp&nbsp
          <a href='#' class='like'>{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ?$likecount[$post->id]['dislikes'].' You don\'t like this post' :$likecount[$post->id]['dislikes'].' Dislike' :$likecount[$post->id]['dislikes'].' Dislike'  }}</a>          &nbsp&nbsp
          <a href='#' class='editpost'>Edit</a>&npbsp&nbsp
          <a href='{{route(' post.delete ',['post.id ' => $post->id])}}'>Delete</a>&nbsp&nbsp
          <a href='#'>Report</a>
        </p> --}}
      </div>
    </article>
    @endforeach @endif
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
<div class="modal" tabindex="-1" role="dialog" id='tagmodal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tags</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <label>Add tags</label>
        <div class="container">
          <div class="dropdown col-md-4 dropdown-size">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Select Tags
                <span class="caret"></span></button> @foreach($fields as $field)
            <option class="dropdown-menu">
              <li class="dropdown-submenu">
                <a class="test" tabindex="-1" href="#" id='{{$field->id}}'>{{$field->field_name}} <span class="caret"></span></a>
                <ul class="dropdown-menu dropdown-menu-form" role="menu" id='{{-$field->id}}'>
                  <li>
                    <label class="checkbox submenu">
                                <input type="checkbox" class='subfield'>
                            </label>
                  </li>
                </ul>
              </li>
            </option>
            @endforeach {{-- </li>
            </ul> --}}
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bton" id='tagsave'>Save </button>
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
var sub='{{route('fetchsubfield')}}';
</script>
</div>
@endsection