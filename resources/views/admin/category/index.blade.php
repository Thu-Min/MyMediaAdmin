@extends('admin.layouts.app')

@section('content')

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
            <form class="form-horizontal" action="{{ route('admin#categoryCreate') }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="categoryName" placeholder="Category Name" >
                    @error('categoryName')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Description</label>
                  <div class="col-sm-10">
                    <textarea id="" cols="15" rows="5" name="description" class="form-control" placeholder="Description"></textarea>
                    @error('description')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
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
          Category List
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
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{ $item->category_id }}</td>
                <td>{{ $item->category_title }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ route('admin#categoryEditPage', $item->category_id) }}">
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                    </a>

                    <a href="{{ route('admin#categoryDelete', $item->category_id) }}">
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
