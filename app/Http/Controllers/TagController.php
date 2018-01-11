<?php
namespace app\Http\Controllers;
use \App\Tag;
use \App\Post;
use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class TagController extends Controller{
    public function manualtag(Request $request){
        $tags=['t1'=>$request['t1'],'t2'=>$request['t2'],'t3'=>$request['t3'],'t4'=>$request['t4'],'t5'=>$request['t5']];
        $string=serialize($tags);
        $tosave=new Tag();
        $tosave->tags=$string;
        $tosave->save();
        return response()->json(['tagid'=>$tosave->id]);
    }
}
