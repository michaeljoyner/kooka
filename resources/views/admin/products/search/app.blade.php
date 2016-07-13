@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@endsection

@section('content')
    <product-search></product-search>
@endsection

@section('bodyscripts')
    <script>
        new Vue({
            el: 'body',
        });
    </script>
@endsection