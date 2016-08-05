@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section>
        <h1 class="main-heading centered-text text-green-hard">Your Cart</h1>
        <cart-app></cart-app>
    </section>
    <section class="cart-help">

        <p><span class="text-green-hard sub-heading">Note: </span>By proceeding to and completing the checkout process you are not committing to anything. You are just letting us know what you are looking for. Once you have submitted your quote request, we will contact you with a quote and further instructions.</p>
    </section>

@endsection

@section('bodyscripts')

@endsection