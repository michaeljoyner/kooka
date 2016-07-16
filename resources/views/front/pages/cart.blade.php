@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="product-show" id="product-vue">
        <h1 class="main-heading centered-text text-green-dark">Your Cart</h1>
        <cart-app></cart-app>
    </section>

@endsection

@section('bodyscripts')

@endsection