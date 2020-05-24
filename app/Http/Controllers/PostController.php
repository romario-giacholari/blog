<?php

namespace App\Http\Controllers;

use \stdClass;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['show', 'index']);
    }

    public function index()
    {
        $viewModel = new stdClass;
        $postsCollection = Cache::remember('posts', $minutes = 60 * 24, function () {
            return Post::with('creator')->latest()->paginate(15) ?? null;
        });
        $viewModel->posts = $postsCollection;
        $viewModel->pageTitle = 'Posts';

        return view('posts.index', ['viewModel' => $viewModel]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validatePost($request);

        $attributes = [
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->title,
            'excerpt' => $request->body,
        ];

        $user = auth()->user();
        $post = $user->posts()->create($attributes);

        return redirect($post->path());
    }

    public function show(Post $post)
    {
        $viewModel = new stdClass;
        $viewModel->post = null;
        $viewModel->author = null;
        $viewModel->pageTitle = '';

        if ($post != null && $post->title != null && $post->creator != null && $post->creator->name != null) {
            $viewModel->post = $post;
            $viewModel->pageTitle = $post->title;
            $viewModel->author = $post->creator->name;
        }

        return view('posts.show', ['viewModel' => $viewModel]);
    }

    public function edit(Post $post)
    {
        $viewModel = new stdClass;
        $viewModel->post = null;
        $viewModel->pageTitle = '';

        if ($post != null && $post->title != null) {
            $viewModel->post = $post;
            $viewModel->pageTitle = $post->title;
        }

        return view('posts.edit', ['viewModel' => $viewModel]);
    }

    public function update(Request $request, Post $post)
    {
        $this->validatePost($request, $post->id);

        $attributes = [
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->title,
            'excerpt' => $request->body,
        ];

        $post->fill($attributes);
        $post->save();

        return redirect(route('home.posts'));
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back();
    }

    private function validatePost(Request $request, int $postId = 0)
    {
        $this->validate($request, [
            "title" => "required|max:20|unique:posts,title,{$postId}",
            "body" => "required|max:1500",
        ]);
    }
}
