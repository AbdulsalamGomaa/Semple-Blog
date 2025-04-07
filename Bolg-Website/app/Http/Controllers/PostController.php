<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index() {

        $allPosts = Post::all(); // collection object
        return view('posts.index', ['posts' => $allPosts]);
    }

    public function show(post $post) {

        return view('posts.show', ['post' => $post]);
    }

    public function create() {

        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store() {

        // validation
        request()->validate([

            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
            'post_creator' => ['required', 'exists:users,id']
        ]);

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);

        return to_route('posts.index');
    }

    public function edit(Post $post) {

        $users = User::all();
        return view('posts.edit', ['users' => $users, 'post' => $post]);
    }

    public function update($postId) {

        // validation
        request()->validate([

            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:5'],
            'post_creator' => ['required', 'exists:users,id']
        ]);

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        $post = Post::findOrFail($postId);
        $post->update([

            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);

        return to_route('posts.show', $postId);
    }

    public function destroy($postId) {

        $deletePost = Post::findOrFail($postId);
        $deletePost->delete();
        return to_route('posts.index');
    }
}
