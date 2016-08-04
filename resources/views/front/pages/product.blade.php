@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
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
                {{--<img src="" alt="{{ $product->name }}">--}}
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