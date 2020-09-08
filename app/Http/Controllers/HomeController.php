<?php

namespace App\Http\Controllers;

use App\Category;
use App\Author;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->read = $post->read + 1;
        $post->update();
        return new PostResource($post);
    }

    public function byCategory($id)
    {
        $post = Post::where('category_id', $id)->get();
        return PostResource::collection($post);
    }

    public function byAuthor($id)
    {
        $post = Post::where('author_id', $id)->get();
        return PostResource::collection($post);
    }

    public function getCategory()
    {
        $category = Category::all();
        return response()->json($category, 200);
    }

    public function getAuthor($id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author, 200);
    }
    
}
