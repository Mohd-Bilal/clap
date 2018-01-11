<?php

namespace app\Http\Controllers;
use \App\Post;
use \App\Like;
use \App\Tag;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PostController extends Controller{

    public function getDashboard(){
        $posts=Post::orderBy('created_at','desc')->get();
        $userinterest=unserialize(Auth::user()->interest);
        $likecount[0]=0;
        if($posts)
        foreach($posts as $post){
            $likecount[$post->id]=$this->likecount($post->id);
        }
        return view('dashboard',['posts'=>$posts,'likecount'=>$likecount,'userinterest'=>$userinterest]);

        }

    public function createPost(Request $request){
        $post=new Post();
        $passedtag=['t1'=>$request['t1'],'t2'=>$request['t2'],'t3'=>$request['t3'],'t4'=>$request['t4'],'t5'=>$request['t5']];
        $tags=serialize($passedtag);
        $message='Body field required';
        if($request['body']){
        $post->body=$request['body'];
        $post->tags=$tags;
        $this->validate($request,[
            'body'=>'required|max:1000'
        ]);
        if($request->user()->posts()->save($post)){
           $message='Post successfully created';
        }
    }

        return response()->json(['message'=>$message,'body'=>$request['body']], 200);
          
    }

    public function getDeletePost($post_id)
      {
        $post = Post::where('id',$post_id) ->first();
        if (Auth::user() != $post->user){
          return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully Deleted!']);
      }

    public function editPost(Request $request){
        $this->validate($request,[
            'body'=>'required'
        ]);
        $post=Post::find($request['postId']);
        $post->body=$request['body'];
        $post->update();
        return response()->json(['new_body'=>$post->body],200);

    }

    public function likecount($postid){
        $postlike=DB::table('likes')->get()->where('post_id',$postid);
        $lcount=0;
        $dcount=0;
        foreach($postlike as &$likepost){
            if($likepost->like)
                $lcount++;
            else
                $dcount++;

        }
            return ['likes'=>$lcount,'dislikes'=>$dcount];
    }
    public function postLike(Request $request){
        $count=0;
        $update=false;
        $postid=$request['postId'];
        $islike=$request['isLike']==='true';
        $post=Post::find($postid);
        if(!$post){
            return null;
        }
        $user=Auth::user();
        $likes=$user->likes()->where('post_id',$postid)->first();

        if($likes){
            $alreadylike=$likes->like;
            $update=true;
            if($alreadylike==$islike){
                $likes->delete();

            }
        }else{
            $likes=new Like();
        }
        $likes->like=$islike;
        $likes->user_id=$user->id;
        $likes->post_id=$postid;
        if($update){
            $likes->update();
        }
        else{
            $likes->save();
        }
        $count=$this->likecount($postid);

        return response()->json(['number'=>$count['likes'],'dislikes'=>$count['dislikes']]);
    }

   
}
