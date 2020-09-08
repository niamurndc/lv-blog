@extends('layouts.admin')

@section('content')
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Author</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
        </div>
      </div>

      <div>
        <h3>Add New Post</h3>
        <form action="/admin/post" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row mb-5">
            <div class="col-md-9">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title">
              </div>
              <div class="form-group">
              <label>Post Content</label>
                <textarea name="description" class="form-control summernote"></textarea>
              </div>
              <input type="submit" value="Publish" class="btn btn-info btn-sm">
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="author">Author</label>
                <select name="author" id="author" class="form-control">
                  @foreach($authors as $author)
                  <option value="{{$author->id}}">{{$author->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                  @foreach($cats as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="cover">Cover Image</label>
                <input type="file" class="form-control" name="cover" id="cover">
              </div>
            </div>
          </div>
        </form>
      </div>
@endsection





          