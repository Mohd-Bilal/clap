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
        $fields=$client->get('http://localhost:3000/public/information/fields')->getBody();
        $interests=json_decode($fields);
        // return($interests);
      if($obj->state == "success" && $obj->description_slug == "success-feeds"){

          return view('dashboard',['posts'=>$obj->data,'fields'=>$interests]);
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
          'post_image'=>null,
          'sub_field_add'=>[1]
          ]
      ])->getBody();
      return ($body);

    }
    public function fetchfield(){
      $client=new Client();
      $body=$client->get('http://localhost:3000/public/information/fields')->getBody();
      $interests=json_decode($body);
      return response()->json(['fields'=>$interests]);
    } 
    public function fetchsubfield(Request $request){
      $client=new Client();
      $body=$client->get($request['suburl'])->getBody();
      $interests=json_decode($body);
      return response()->json(['subfield'=>$interests,'fieldid'=>$request['field_id']]);
      


    }
    public function getDeletePost($post_id,Request $request)
    {
      $client=new Client();
      $value = $request->session()->get('jwt_token');
      $body=$client->request('POST','http://localhost:3000/private/delete/post',[
        'headers'=>[
          'Authorization'=>'Bearer '.$value
        ],
        'json'=>[
          'post_id'=>$post_id,
          ]
      ])->getBody();
      $obj = json_decode($body);
      if($obj->state=="success"){
        return redirect()->route('dashboard')->with(['message' => 'Successfully Deleted!']);
      }
      else {
        return redirect()->route('dashboard')->with(['message' => 'Not Able to Delete Post']);
      }
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
      $value = $request->session()->get('jwt_token');

      if($value){
        $client = new Client(); //GuzzleHttp\Client
        if($request['Like']=='like'){
          $like="add";
        }
        elseif($request['Like']=='unlike'){
          $like="sub";
        }
        $body = $client->request('POST', 'http://localhost:3000/private/update/post/like', [
          'headers' => [
            'Authorization' => 'Bearer '.$value
          ],
          'debug' => false,
          'json' =>[
            $like => [$request['post_id']]
          ]

          ])->getBody();

          $obj = json_decode($body);
          return response()->json(['post_id'=>$request['post_id']]);
    }
  }




}
