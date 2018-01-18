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
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
class PostController extends Controller{

  public function getDashboard(Request $request){
    $value = $request->session()->get('jwt_token');
    if($value){
      $client = new Client(); //GuzzleHttp\Client
      $body = $client->request('POST', 'http://localhost:3000/private/information/feed', [
        'headers' => [
          'Authorization' => 'Bearer '.$value
        ],
        'debug' => false,
        'json' =>[
          'requested_number' =>10,
          'offset' => 0
        ]

        ])->getBody();

        $obj = json_decode($body);
        if($obj->state == "success" && $obj->description_slug == "success-feeds"){
          return view('dashboard',['posts'=>$obj->data]);
        }
        else {
          return view('dashboard',['posts'=>$obj->description_slug]);
        }
    }
    else{
      return redirect()->route('welcome');
    }
  }

    public function createPost(Request $request){     
      $client=new Client();
      $value = $request->session()->get('jwt_token');
      $body=$client->request('POST','http://localhost:3000/private/create/post/',[
        'headers'=>[
          'Authorization'=>'Bearer '.$value
        ],
        'json'=>[
          'post_content'=>$request['body'],
          'post_text'=>null,
          'post_image'=>null
          ]
      ])->getBody();   
      return ($body);
  
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

    // public function likecount($postid){
    //   $postlike=DB::table('likes')->get()->where('post_id',$postid);
    //   $lcount=0;
    //   $dcount=0;
    //   foreach($postlike as &$likepost){
    //     if($likepost->like)
    //     $lcount++;
    //     else
    //     $dcount++;

    //   }
    //   return ['likes'=>$lcount,'dislikes'=>$dcount];
    // }
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
