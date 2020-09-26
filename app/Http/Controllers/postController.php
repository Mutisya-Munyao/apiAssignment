<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postController extends Controller
{

    public function getDashboard()
    {
        $posts = Post::all();
        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {

        $this->validate($request, [
            'body' => 'required|max:5000',
        ]);

            $post = new Post();
            $post->body = $request['body'];
            $message = 'Your post was not succesfully submitted. Please try again';
           if($request->user()->post()->save($post)){
                $message = 'Your post was successfully created';
           }
            return redirect()->route('dashboard')->with(['message' => $message]);

    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        $post -> delete();
        return redirect()->route('dashboard'-with(['message' => 'Your post has been successfully deleted']));
    }
}