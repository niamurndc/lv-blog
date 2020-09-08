<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Author;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return view('admin.index', ['posts' => $post]);
    }

    public function create()
    {
        $cat = Category::all();
        $author = Author::all();
        return view('admin.addpost', ['cats' => $cat, 'authors' => $author]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $description=$request->input('description');
        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name= "/upload/" . time().$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $description = $dom->saveHTML();

        $post = new Post();

        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->body = $description;
        $post->author_id = $request->author;
        $post->category_id = $request->category;

        $cover = $request->file('cover');
        if($cover){
            $cover_ext = $cover->getClientOriginalExtension();

            $new_cover = $post->slug . '-cover.'. $cover_ext;

            $path = public_path('/image/post-cover');
            $cover->move($path, $new_cover);
            
            $post->cover = $new_cover;
        }else{
            $post->cover = 'cover.jpg';
        }
        
        $post->save();
        return redirect('/admin/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $cat = Category::all();
        $author = Author::all();
        return view('admin.editpost', ['post' => $post, 'cats' => $cat, 'authors' => $author]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $description=$request->input('description');
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');

            if (preg_match('/data:image/',$data)){
                preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
                $mime_type=$groups['mime'];
                $data = base64_decode($data);

                $image_name= "/upload/" . time().$k.'.png';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);
                
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }

        }

        $description = $dom->saveHTML();

        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->body = $description;
        $post->author_id = $request->author;
        $post->category_id = $request->category;

        $cover = $request->file('cover');
        if($cover){
            $cover_ext = $cover->getClientOriginalExtension();

            $new_cover = $post->slug . '-cover.'. $cover_ext;

            $path = public_path('/image/post-cover');
            $cover->move($path, $new_cover);
            
            $post->cover = $new_cover;
        }
        
        $post->update();
        return redirect('/admin/post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $path = public_path('/image/cover'). '/'. $post->cover;
        $post->delete();
        return redirect('/admin/post');
    }
}
