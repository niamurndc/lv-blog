@extends('layouts.admin')

@section('content')
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Author</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
        </div>
      </div>


      <div class="row mb-5">
        <div class="col-md-6">
          <h4>Add New</h4>
          <form action="/author" method="post" enctype="multipart/form-data">
            @csrf 
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
              <label for="avatar">Avatar</label>
              <input type="file" name="avatar" id="avatar" class="form-control">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea name="desc" id="description" rows="3" class="form-control"></textarea>
            </div>
            <input type="submit" value="Add" class="btn btn-sm btn-info">
          </form>
        </div>
        <div class="col-md-6">
        <h4>Authors</h4>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Avatar</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($authors as $author)
                <tr>
                  
                  <td> <img src="/image/author-avatar/{{$author->avatar}}" class="admin-avatar"> </td>
                  <td>{{$author->name}}</td>
                  <td>{{$author->description}}</td>
                  <td>
                    <form action="/author/{{$author->id}}" method="post">
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
        </div>
      </div>
@endsection