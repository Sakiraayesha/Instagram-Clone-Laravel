<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function store(\App\Models\Post $post, Request $request){
        $request = request()->validate([
            'comment' => 'required'
        ]);
        
        return Comments::create([
            'comment' => $request['comment'],
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);
    }
}
