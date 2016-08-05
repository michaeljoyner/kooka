@extends('admin.base')

@section('head')
    <style>
        .login-logo-img {
            display: block;
            width: 55%;
            margin: 50px auto 10px;
        }
        .login-heading {
            text-align: center;
            text-transform: uppercase;
            color: #008058;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @include('admin.forms.login')
    </div>
@endsection
