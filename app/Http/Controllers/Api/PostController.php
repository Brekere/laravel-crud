<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\post\PutRequest;
use App\Http\Requests\post\StoreRequest;

class PostController extends Controller
{

    public function index()
    {
        return response()->json(Post::with('category')->paginate(3));
    }

    public function all()
    {
        return response()->json(Post::get());
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Post::create($request->validated()));
    }

    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function update(PutRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json("ok");
    }

    public function slug(Post $post)
    {
        //$post = Post::with("category")->where("slug",$slug)->firstOrFail();
        $post->category;
        return response()->json($post);
    }
}
