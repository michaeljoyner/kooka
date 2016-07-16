@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="product-show">
        <div class="product-images-container">
            <div class="main-image">
                <img src="{{ $product->imageSrc('web') }}" alt="{{ $product->name }}">
            </div>
        </div>
        <div class="product-details-container">
            <h1 class="main-heading text-green-dark">{{ $product->name }}</h1>
            <section class="product-description">
                {!! $product->description !!}
            </section>
            <p class="product-price">R{{ $product->price->asCurrencyString() }}</p>
            <cart-button product-id="{{ $product->id }}">

            </cart-button>
        </div>
    </section>
@endsection

@section('bodyscripts')

@endsection