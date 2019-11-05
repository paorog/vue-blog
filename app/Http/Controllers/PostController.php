<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;

class PostController extends Controller
{
    public function getAllPosts()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        $data = [];
        foreach($posts as $index => $post)
        {
            $user = User::find($post->user_id);

            $data[$index] = [
                'title'  => $post->title,
                'body'   => $post->body,
                'slug'   => $post->slug,
                'author' => $user->name,
                'date'   => $post->created_at
            ];
        }

        return response()->json(['error' => false, 'data'=> $data]);
    }

    public function createPost(Request $request)
    {
        $user = Auth::user();
        $input = $request->except('_token');

        $post = Post::create([
            'title'   => $input['title'],
            'body'    => $input['body'],
            'slug'    => $input['slug'],
            'user_id' => $user->id
        ]);

        return response()->json(['error' => false, 'data' => $post]);
    }

    public function checkSlugAvailability($slug)
    {
        $post = Post::whereSlug($slug)->first();
        return response()->json(['error' => $post ? true : 'false', 'post' => $post]);
    }

    public function viewPost($slug)
    {
        $post = Post::whereSlug($slug)->first();
        $user = User::find($post->user_id);
        return view('post')->with(compact('post', 'user'));
        //return response()->json(['error' => false, 'data' => $post]);
    }
}
