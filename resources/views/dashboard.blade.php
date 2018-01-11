@extends('master')


@section('title')
Dashboard
@endsection
@include('postvalidate')
@section('content')
<link rel='stylesheet' href={{URL::to('src/css/dashboard.css')}}>
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
        <li><a href="{{route('account')}}">Account</a></li>
        <li><a href="{{route('logout')}}">Logout</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>
<div class='row newpost'>
    <div class='col-md-3 container-fluid eq_height '>
      <div class="left">
        <h5>Your Feed</h5>
        <img src='{{Auth::user()->avatar}}' class='img-responsive' style='height:175px;' alt='Profile picture'>
      </div>
    </div>
    <div class='col-md-9 container-fluid eq_height'>
        <section class='newpost'>
             

                 <div class='form-group'>
                      <textarea name='body' id='newpost' class='form-control'  rows='7' placeholder='What do you have to say?'></textarea>
                 </div>
                <button type='submit' class='bton' id='postit'>Post</button>


                <input type='hidden' value='{{Session::token()}}' name='_token'>
            

         </section>
     <!--</div></div>


         <div name='posts' class='row post'>
            <div class='col-md-3'></div>
            <div class='col-md-9'>-->
               

@foreach($posts as $post)
    @if(!(Auth::user() == $post->user))
      @if((Auth::user()->channel == "channel2") && ($likecount[$post->id]['likes'] > 0))
                 <article data-postid='{{$post->id}}'>
                             @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
                             <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="User" class="img-responsive" style="height:40px;">
                             @endif
                          <div class='info'>
                             {{$post->user['username']}}<br></div><div class="details">{{$post->created_at}}
                     </div>
                        <p class="postcont">{{$post->body}}</p>
                      
                     <div class='interaction'>
                    <p>

                    <a href='#' class='like' >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ?$likecount[$post->id]['likes'].' You liked this post' :$likecount[$post->id]['likes'].' Like':$likecount[$post->id]['likes'].' Like'  }}</a>&nbsp&nbsp
                    <a href='#' class='like' >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ?$likecount[$post->id]['dislikes'].' You don\'t like this post' :$likecount[$post->id]['dislikes'].' Dislike' :$likecount[$post->id]['dislikes'].' Dislike'  }}</a>
                    {{--  @if(Auth::user() == $post->user)
                    &nbsp&nbsp<a href='#' class='editpost'>Edit</a>&nbsp&nbsp
                    <a href='{{route('post.delete',['post.id' => $post->id])}}'>Delete</a>
                    @endif  --}}
                     </p>
                    </div>
                         </article>

            @endif
            @if(Auth::user()->channel == "channel1")
              @php
                $tag=unserialize($post->tags);
              @endphp
              @if((($userinterest['i1']== 1)&&($tag['t1'] == "true"))||(($userinterest['i2']== 1)&&($tag['t2'] == "true"))||(($userinterest['i3']== 1)&&($tag['t3'] == "true"))
              ||(($userinterest['i4']== 1)&&($tag['t4'] == "true"))||(($userinterest['i5']== 1)&&($tag['t5'] == "true")))
               <article data-postid='{{$post->id}}'>
                 <div class='info'>
                 {{$post->user['username']}} <br></div><div class="details">{{$post->created_at}}
                 </div>
                <p class="postcont">{{$post->body }}</p>
                  <div class='interaction'>
                <p>
                <a href='#' class='like' >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ?$likecount[$post->id]['likes'].' You liked this post' :$likecount[$post->id]['likes'].' Like':$likecount[$post->id]['likes'].' Like'  }}</a>&nbsp&nbsp
                <a href='#' class='like' >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ?$likecount[$post->id]['dislikes'].' You don\'t like this post' :$likecount[$post->id]['dislikes'].' Dislike' :$likecount[$post->id]['dislikes'].' Dislike'  }}</a>
                {{--  @if(Auth::user() == $post->user)
                &nbsp&nbsp<a href='#' class='editpost'>Edit</a>&nbsp&nbsp
                <a href='{{route('post.delete',['post.id' => $post->id])}}'>Delete</a>
                @endif  --}}
            </p>
            </div>
          </article>
              @endif
            @endif
        @else
        <article data-postid='{{$post->id}}'>
            <div class='info'>
            {{$post->user['username']}} <br></div><div class="details">{{$post->created_at}}
            </div>
           <p class="postcont">{{$post->body }}</p>
             <div class='interaction'>
           <p>
           <a href='#' class='like' >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ?$likecount[$post->id]['likes'].' You liked this post' :$likecount[$post->id]['likes'].' Like':$likecount[$post->id]['likes'].' Like'  }}</a>&nbsp&nbsp
           <a href='#' class='like' >{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ?$likecount[$post->id]['dislikes'].' You don\'t like this post' :$likecount[$post->id]['dislikes'].' Dislike' :$likecount[$post->id]['dislikes'].' Dislike'  }}</a>
           &nbsp&nbsp<a href='#' class='editpost'>Edit</a>&nbsp&nbsp
           <a href='{{route('post.delete',['post.id' => $post->id])}}'>Delete</a>
    
       </p>
       </div>
     </article>
@endif
@endforeach
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
                <input type='checkbox' id='t1' value='t1'>Arts</input>
                <input type='checkbox' id='t2' value='t2'>Science</input>
                <input type='checkbox' id='t3' value='t3'>Tech</input>
                <input type='checkbox' id='t4' value='t4'>Music</input>
                <input type='checkbox' id='t5' value='t5'>Business</input>
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
      </script>
</div>
@endsection
