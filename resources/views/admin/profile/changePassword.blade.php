@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
          @if (Session::has('new&confirm'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('new&confirm') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if (Session::has('longer'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('longer') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          @if (Session::has('notMatch'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('notMatch') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('admin#changePassword') }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Old Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="oldPass" placeholder="Old Password" value="">
                    @error('oldPass')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">New Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="newPass" placeholder="New Password" value="">
                    @error('newPass')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Confirm Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" name="confirmPass" placeholder="Confirm Password" value="">
                    @error('confirmPass')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-3 col-sm-8">
                    <button type="submit" class="btn btn-outline-danger">Change</button>
                  </div>
                </div>

              </form>
            </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
