@extends('admin.layouts.app')

@section('content')

@if (Session::has('created'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('created') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::has('deleted'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('deleted') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (Session::has('updated'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('updated') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="col-4">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin#createPost') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                  <label class="col-form-label">Title</label>
                  <div class="">
                    <input type="text" class="form-control" name="postTitle" placeholder="Post Title" value="{{ old('postTitle') }}">
                    @error('postTitle')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-form-label">Description</label>
                  <div class="">
                    <textarea id="" cols="15" rows="5" name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                    @error('description')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label">Image</label>
                    <div class="">
                      <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                      @error('image')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label">Category</label>
                    <div class="">
                      <select name="category" id="" class="form-control">
                        <option value="">Choose Category</option>
                        @foreach ($categoryData as $item)
                        <option value="{{ $item->category_id }}">{{ $item->category_title }}</option>
                        @endforeach
                      </select>
                      @error('category')
                        <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                </div>

                <div class="form-group row">
                  <div class="">
                    <button type="submit" class="btn bg-dark text-white">Submit</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          Post List
        </h3>

        <div class="card-tools">
            <div>
                <form action="{{ route('admin#categorySearch') }}" method="POST" class="input-group input-group-sm pt-1" style="width: 150px;">
                    @csrf
                    <input type="text" name="searchData" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Description</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($postData as $item)
            <tr>
                <td>{{ $item->post_id }}</td>
                <td>{{ $item->post_title }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    @if ($item->image != NULL)
                        <img src="{{ asset('postImage/'.$item->image) }}" width="150px" class="mb-2 rounded shadow-lg">
                    @else
                        <img src="{{ asset('default/default.png') }}" width="150px" alt="" class="mb-2 rounded shadow-lg">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin#updatePost', $item->post_id) }}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                    </a>

                    <a href="{{ route('admin#deletePost', $item->post_id) }}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection
