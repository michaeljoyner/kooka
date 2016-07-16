@extends('front.base')

@section('content')
<section class="home-section hero">

</section>
<section class="home-section top-sellers">

</section>
<section class="home-section how-it-works">
    <h1 class="main-heading centered-text">How it works</h1>
    <p class="body-text">1. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    <p class="body-text">2. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    <p class="body-text">3. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    <p class="body-text">4. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
</section>
<section class="home-section categories">
    <h1 class="main-heading centered-text text-orange">Categories</h1>
    <div class="categories-container">
        @foreach($categories as $category)
                <div class="category-card">
                    <a href="/categories/{{ $category->slug }}">
                        <img src="{{ $category->imageSrc('web') }}" alt="{{ $category->name }}">
                    </a>
                </div>
        @endforeach
    </div>
</section>
@endsection