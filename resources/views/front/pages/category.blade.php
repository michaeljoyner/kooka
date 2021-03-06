@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <meta name="og:image" content="{{ url($category->imageSrc()) }}"/>
    <meta name="og:url" content="{{ Request::url() }}"/>
    <meta name="og:title" content="{{ $category->name }} | Kookaburra Cricket"/>
    <meta name="og:site_name" content="Kookaburra Cricket"/>
    <meta name="og:type" content="Website"/>
    <meta name="og:description" content="{{ $category->description }}"/>
    <meta name="description" content="{{ $category->description }}">
@stop

@section('content')
    <nav class="breadcrumbs">
        <ul>
            @foreach(\App\Breadcrumbs\Breadcrumbs::makeFor($category) as $breadcrumb)
                <li class="breadcrumb"><a href="{{ $breadcrumb['href'] }}">{{ $breadcrumb['name'] }}</a></li>
            @endforeach
        </ul>
    </nav>
    <section class="category-products">
        <h1 class="main-heading text-green-hard centered-text">{{ $category->name }}</h1>
        <div class="category-products-container">
            @foreach($category->products as $product)
            <div class="product-summary-card">
                <a href="/products/{{ $product->slug }}"><img src="{{ $product->imageSrc('thumb') }}" alt="{{ $product->name }}">
                <h4 class="small-heading text-green-soft centered-text product-summary-card-name">{{ $product->name }}</h4>
                <span class="product-summary-card-price">R{{ $product->price->asCurrencyString() }}</span></a>
            </div>
            @endforeach
        </div>

    </section>
@endsection