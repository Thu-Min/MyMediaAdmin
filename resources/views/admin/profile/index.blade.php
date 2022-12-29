@extends('admin.layouts.app')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('admin#update') }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ old('name', $data->name) }}">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{ old('email', $data->email) }}">
                    @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputPhone" name="phone" placeholder="Phone" value="{{ old('phone', $data->phone) }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea cols="15" rows="5" class="form-control" name="address" placeholder="Address">{{ old('address', $data->address) }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-10">
                    <select name="gender" class="form-control" id="">
                        @if ($data->gender == 'male')
                            <option value="">Choose Gender</option>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        @elseif ($data->gender == 'female')
                            <option value="">Choose Gender</option>
                            <option value="male">Male</option>
                            <option value="female" selected>Female</option>
                            <option value="others">Others</option>
                        @elseif ($data->gender == 'others')
                            <option value="">Choose Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others" selected>Others</option>
                        @elseif ($data->gender == '')
                            <option value="" selected>Choose Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        @endif
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Submit</button>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <a href="{{ route('admin#changePasswordBlade') }}">Change Password</a>
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
@endsection
