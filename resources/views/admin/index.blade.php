@extends('layouts.admin')

@section('content')
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
        </div>
      </div>

      
          <div class="table-responsive">
          <h3>Posts</h3>
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Publish</th>
                  <th>Author</th>
                  <th>Category</th>
                  <th colspan="3">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $post)
                <tr>
                  <td>{{$post->id}}</td>
                  <td>{{$post->title}}</td>
                  <td>{{$post->created_at}}</td>
                  <td>{{$post->category->name}}</td>
                  <td>{{$post->author->name}}</td>
                  <td> <a href="/admin/post/{{$post->id}}/edit" class="btn btn-sm btn-info">Edit</a> </td>
                  <td>
                    <form action="/admin/post/{{$post->id}}" method="post">
                      @csrf 
                      @method('DELETE')
                      <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          



      

@endsection