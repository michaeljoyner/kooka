@extends('front.base')

@section('content')
    <section class="category-products">
        <h1 class="main-heading text-green-dark centered-text">{{ $category->name }}</h1>
        <div class="category-products-container">
            @foreach($category->products as $product)
            <div class="product-summary-card">
                <a href="/products/{{ $product->slug }}"><img src="{{ $product->imageSrc('thumb') }}" alt="{{ $product->name }}"></a>
                <h4 class="small-heading text-green-soft centered-text product-summary-card-name">{{ $product->name }}</h4>
                <span class="product-summary-card-price">R{{ $product->price->asCurrencyString() }}</span>
            </div>
            @endforeach
        </div>

    </section>
@endsection