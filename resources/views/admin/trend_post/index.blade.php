@extends('admin.layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post Page</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
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
              <th>Image</th>
              <th>View</th>
              <th></th>
            </tr>
          </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->actionLog_id }}</td>
                        <td>{{ $item->post_title }}</td>
                        <td>
                            @if ($item->image != NULL)
                                <img src="{{ asset('postImage/'.$item->image) }}" width="150px" class="mb-2 rounded shadow-lg">
                            @else
                                <img src="{{ asset('default/default.png') }}" width="150px" alt="" class="mb-2 rounded shadow-lg">
                            @endif
                        </td>
                        <td><i class="fa-solid fa-eye"></i> {{ $item->postCount }}</td>
                        <form action="{{ route('admin#trendPostDetails', $item->actionLog_id) }}">
                            <td>
                                <button class="btn btn-sm bg-dark" type="submit">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                @endforeach
              </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3 me-3">
            {{-- {{ $data->links() }} --}}
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
