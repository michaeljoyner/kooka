@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>

@stop

@section('content')
    <section class="home-section hero">
        <img src="/images/assets/kooka_logo_2.svg" alt="kookaburra logo" class="logo">
        <p class="tagline main-heading">BRINGING KOOKABURRA DIRECT TO YOUR DOOR!</p>
    </section>
    <section class="home-section top-sellers top-seller-slider">
        <h1 class="main-heading centered-text text-green-hard">Top Sellers</h1>
        @include('front.partials.home.slideshow')
    </section>
    <section class="home-section how-it-works">
        <h1 class="main-heading centered-text">How it works</h1>
        <div class="how-it-works-container">
            @include('front.partials.home.howitworks')
        </div>
    </section>
    <section class="home-section categories" id="categories">
        <h1 class="main-heading centered-text text-green-hard">Categories</h1>
        <div class="categories-container">
            @foreach($categories as $category)
                <div class="category-card">
                    <a href="/categories/{{ $category->slug }}">
                        <img src="{{ $category->imageSrc('thumb') }}" alt="{{ $category->name }}">
                        <h3 class="small-heading">{{ $category->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
    <section class="home-section bat-sizes" id="batsizes">
        <h1 class="main-heading centered-text">Bat Sizes</h1>
        @include('front.partials.home.batsizes')
    </section>
    <section class="home-section contact" id="contact">
        <h1 class="main-heading centered-text text-green-hard">Contact Us</h1>
        <section class="contact-panel">
            <div class="contact-method-box phone-box">
                @include('svgicons.Phone_icon')
                <p>+27 31 1234 333</p>
            </div>
            <div class="contact-method-box email-box">
                @include('svgicons.email_icon')
                <p>ryan@absolutesport.co.za</p>
            </div>
            <div class="contact-method-box message-box">
                <label for="contact-toggle">
                @include('svgicons.message_icon')
                <p>Click to send message</p>
                </label>
            </div>
        </section>
        <input type="checkbox" id="contact-toggle">
        <section class="contact-form">
            <contact-form form-action="/contact"></contact-form>
        </section>
    </section>
    <template>
        <div id="previous">
            @include('svg.left_arrow')
        </div>
    </template>
@endsection

@section('bodyscripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
@endsection