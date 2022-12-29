@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">User Table</h3>
        @if (Session::has('deleted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-tools">
            <div >
                <form action="{{ route('admin#search') }}", method="POST" class="input-group input-group-sm pt-1" style="width: 150px;">
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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Address</th>
                  <th>Gender</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                    <form action="{{ route('admin#deleteAccount', $item->id) }}" method="POST">
                        @csrf
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>
                            <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                            @if ($item->id == Auth::user()->id)
                                <button class="btn btn-sm bg-danger text-white" disabled type="submit"><i class="fas fa-trash-alt"></i></button>
                            @else
                                <button class="btn btn-sm bg-danger text-white" type="submit"><i class="fas fa-trash-alt"></i></button>
                            @endif
                            </td>
                        </tr>
                    </form>
                @endforeach
              </tbody>
            </table>
          </div>

      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
