@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <meta name="og:image" content="{{ url($product->imageSrc()) }}"/>
    <meta name="og:url" content="{{ Request::url() }}"/>
    <meta name="og:title" content="{{ $product->name }} | Kookaburra Cricket"/>
    <meta name="og:site_name" content="Kookaburra Cricket"/>
    <meta name="og:type" content="Website"/>
    <meta name="og:description" content="{{ $product->description }}"/>
    <meta name="description" content="{{ $product->description }}">
@stop

@section('content')
    <nav class="breadcrumbs">
        <ul>
            @foreach(\App\Breadcrumbs\Breadcrumbs::makeFor($product) as $breadcrumb)
                <li class="breadcrumb"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['name'] }}</a></li>
            @endforeach
        </ul>
    </nav>
    <section class="product-show">
        <div class="product-images-container">
            <div class="main-image">
                <product-gallery initial="{{ $product->imageSrc('web') }}"
                                 alt-text="{{ $product->name }}"
                                 product-id="{{ $product->id }}"
                >
                </product-gallery>
            </div>
        </div>
        <div class="product-details-container">
            <h1 class="sub-heading text-green-hard">{{ $product->name }}</h1>
            <section class="product-description">
                {!! $product->writeup !!}
            </section>
            <p class="product-price text-green-hard">R{{ $product->price->asCurrencyString() }}</p>
            <cart-button product-id="{{ $product->id }}">

            </cart-button>
        </div>
    </section>
@endsection

@section('bodyscripts')

@endsection