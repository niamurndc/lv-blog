<?php

namespace App\Http\Controllers;

use App\Author;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;

class AuthorController extends Controller
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
        $author = Author::all();
        return view('admin.author', ['authors' => $author]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();

        $author->name = $request->name;
        $author->description = $request->desc;
        $author->slug = str_slug($request->name);
        
        $avatar = $request->file('avatar');
        $avatar_ext = $avatar->getClientOriginalExtension();

        $new_avatar = $author->slug. '-avatar.' . $avatar_ext;
        
        $author->avatar = $new_avatar;

        $path = public_path('/image/author-avatar');
        $avatar->move($path, $new_avatar);
        $author->save();
        return redirect('/author');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $path = public_path('/image/author-avatar'). '/' . $author->avatar;
        unlink($path);
        $author->delete();
        return redirect('/author');
    }
}
