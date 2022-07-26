<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Arr;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $following = auth()->user()->following()->pluck('profiles.user_id');
        $users = Arr::collapse([$following, [auth()->user()->id]]);
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        $suggestions = User::whereNotIn('id', $users)->latest()->take(5)->get();

        return view('posts.index', compact('posts', 'suggestions'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){

        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
       
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(\App\Models\Post $post){
        $likes = (auth()->user()) ? auth()->user()->likes->contains($post->id) : false;
        $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;
        $comments = Comments::whereIn('post_id', [$post->id])->latest()->get();
        $loadmoreComments = $comments->count() > 3 ? $comments->count() - 3 : 0;
        $likesCount = $post->likes->count(); 

        return view('posts.show', compact('post', 'likes', 'follows', 'comments', 'likesCount', 'loadmoreComments'));
    }
}
