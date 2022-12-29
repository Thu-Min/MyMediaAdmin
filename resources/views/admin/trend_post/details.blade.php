@extends('admin.layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-7 col-lg-4 mb-5 mb-lg-0 wow fadeIn">
            <div class="card border-0 shadow">
                @if ($data->image != NULL)
                    <img src="{{ asset('postImage/'.$data->image) }}" width="100%" class="mb-2 rounded shadow-lg">
                @else
                    <img src="{{ asset('default/default.png') }}" width="150px" alt="" class="mb-2 rounded shadow-lg">
                @endif

            </div>
        </div>
        <div class="col-lg-8">
            <div class="ps-lg-1-6 ps-xl-5">
                <div class="mb-5 wow fadeIn">
                    <div class="card-body">
                        <div class="mb-4">
                            <h2 class="h1 mb-0 text-primary">Post Title</h2>
                            <h3 class="h4 mb-0">{{ $data->post_title }}</h3>
                            <h4></h4>
                        </div>
                    </div>
                    <div class="text-start mb-1-6 wow fadeIn">
                        <h2 class="h1 mb-0 text-primary">Description</h2>
                    </div>
                    <p>
                        {{ $data->description }}
                    </p>
                    <div class="mt-5">
                        <button class="btn btn-outline-dark" onclick="history.back()">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.icon-box.medium {
    font-size: 20px;
    width: 50px;
    height: 50px;
    line-height: 50px;
}
.icon-box {
    font-size: 30px;
    margin-bottom: 33px;
    display: inline-block;
    color: #ffffff;
    height: 65px;
    width: 65px;
    line-height: 65px;
    background-color: #59b73f;
    text-align: center;
    border-radius: 0.3rem;
}
.social-icon-style2 li a {
    display: inline-block;
    font-size: 14px;
    text-align: center;
    color: #ffffff;
    background: #59b73f;
    height: 41px;
    line-height: 41px;
    width: 41px;
}
.rounded-3 {
    border-radius: 0.3rem !important;
}

.social-icon-style2 {
    margin-bottom: 0;
    display: inline-block;
    padding-left: 10px;
    list-style: none;
}

.social-icon-style2 li {
    vertical-align: middle;
    display: inline-block;
    margin-right: 5px;
}

a, a:active, a:focus {
    color: #616161;
    text-decoration: none;
    transition-timing-function: ease-in-out;
    -ms-transition-timing-function: ease-in-out;
    -moz-transition-timing-function: ease-in-out;
    -webkit-transition-timing-function: ease-in-out;
    -o-transition-timing-function: ease-in-out;
    transition-duration: .2s;
    -ms-transition-duration: .2s;
    -moz-transition-duration: .2s;
    -webkit-transition-duration: .2s;
    -o-transition-duration: .2s;
}

.text-secondary, .text-secondary-hover:hover {
    color: #59b73f !important;
}
.display-25 {
    font-size: 1.4rem;
}

.text-primary, .text-primary-hover:hover {
    color: #ff712a !important;
}

p {
    margin: 0 0 20px;
}

.mb-1-6, .my-1-6 {
    margin-bottom: 1.6rem;
}
</style>
@endsection
