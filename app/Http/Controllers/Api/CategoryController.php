<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\category\PutRequest;
use App\Http\Requests\category\StoreRequest;

class CategoryController extends Controller
{

    public function index()
    {
        return response()->json(Category::paginate(3));
    }

    public function all()
    {
        return response()->json(Category::get());
    }

    public function store(StoreRequest $request)
    {
       return response()->json(Category::create($request->validated()));
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        response()->json("ok");
    }

    public function posts(Category $category)
    {
        // $posts = Post::join('categories',"categories.id","=","posts.category_id")
        // ->select("posts.*", "categories.title as category")
        // ->where("category_id", $category->id)
        // ->get();
        // ->toSql()

        $posts = Post::with("category")
        ->where("category_id", $category->id)
        ->get();

        return response()->json($posts);
    }

    public function slug($slug)
    {
        $category = Category::where("slug",$slug)->firstOrFail();
        return response()->json($category);
    }
}
