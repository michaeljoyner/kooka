@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
    <meta name="og:image" content="{{ url("/images/assets/kooka_fb.png") }}"/>
    <meta name="og:url" content="{{ Request::url() }}"/>
    <meta name="og:title" content="Kookaburra Cricket - Bringing Kookaburra direct to your door!"/>
    <meta name="og:site_name" content="Kookaburra Cricket"/>
    <meta name="og:type" content="Website"/>
    <meta name="og:description" content="Kookaburra Cricket offers Kookaburra cricket sports equipment for all, delivered directly to your doorstep!"/>
    <meta name="description" content="Kookaburra Cricket offers Kookaburra cricket sports equipment for all, delivered directly to your doorstep!">
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
                <p>083 257 9611</p>
            </div>
            <div class="contact-method-box email-box">
                <a href="mailto:ryan@absolutesport.co.za">@include('svgicons.email_icon')
                <p>ryan@absolutesport.co.za</p></a>
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
    {{--<template>--}}
        {{--<div id="previous">--}}
            {{--@include('svg.left_arrow')--}}
        {{--</div>--}}
    {{--</template>--}}
@endsection

@section('initialscripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
@endsection

@section('bodyscripts')
    @if(session()->has('thanks_message'))
        <script>
            swal({
                type: "success",
                title: "Thank You, {{ session('thanks_message.name') }}",
                text: "Thank you for your request. We will get back to you as soon as possible.",
                showConfirmButton: true
            });
        </script>
    @endif
@endsection