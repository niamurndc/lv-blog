@extends('layouts.admin')

@section('content')
    
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          
        </div>
      </div>


      <div class="row mb-5">
        <div class="col-md-6">
          <h4>Add New</h4>
          <form action="/category" method="post">
            @csrf 
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <input type="submit" value="Add" class="btn btn-sm btn-info">
          </form>
        </div>
        <div class="col-md-6">
        <h4>Categories</h4>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($category as $cat)
                <tr>
                  <td>{{ $cat->id }}</td>
                  <td><b>{{ $cat->name }}</b></td>
                  <td>{{ $cat->slug }}</td>
                  <td>
                    <form action="/category/{{$cat->id}}" method="post">
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