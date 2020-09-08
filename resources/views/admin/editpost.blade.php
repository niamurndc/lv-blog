@extends('layouts.admin')

@section('content')
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
        </div>
      </div>

      <div>
        <h3>Add New Post</h3>
        <form action="/admin/post/{{$post->id}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row mb-5">
            <div class="col-md-9">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
              </div>
              <div class="form-group">
              <label>Post Content</label>
                <textarea name="description" rows="40" class="form-control summernote">{{$post->body}}</textarea>
              </div>
              <input type="submit" value="Update" class="btn btn-info btn-sm">
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="author">Author</label>
                <select name="author" id="author" class="form-control">
                  @foreach($authors as $author)
                    <option value="{{$author->id}}" {{ ($author->id == $post->author_id) ? 'selected' : ''}}>{{$author->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                  @foreach($cats as $cat)
                    <option value="{{$cat->id}}" {{ ($cat->id == $post->category_id) ? 'selected' : ''}}>{{$cat->name}}</option>
                  @endforeach
                </select>
              </div>
              @if($post->cover)
              <img src="/image/post-cover/{{$post->cover}}" class="edit-form-cover">
              @endif
              <div class="form-group">
                <label for="cover">Cover Image</label>
                <input type="file" class="form-control" name="cover" id="cover">
              </div>
            </div>
          </div>
        </form>
      </div>
      
@endsection





          