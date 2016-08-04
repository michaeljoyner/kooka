{{--<div class="slider js_slider">--}}
    {{--<div class="frame js_frame">--}}
        {{--<ul class="slides js_slides">--}}
            {{--@foreach($topSellers as $product)--}}
                {{--<li class="js_slide">--}}
                    {{--<img src="{{ $product->imageSrc('thumb') }}" alt="">--}}
                    {{--<a class="product-link" href="/products/{{ $product->slug }}">{{ $product->name }}</a>--}}
                {{--</li>--}}
            {{--@endforeach--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="prev-arrow arrow">--}}
        {{--@include('svg.left_arrow')--}}
    {{--</div>--}}
    {{--<div class="next-arrow arrow">--}}
        {{--@include('svg.right_arrow')--}}
    {{--</div>--}}
{{--</div>--}}
<div class="product-slider">
    @foreach($topSellers as $product)
    <li>
    <img src="{{ $product->imageSrc('thumb') }}" alt="">
    <a class="product-link" href="/products/{{ $product->slug }}">{{ $product->name }}</a>
    </li>
    @endforeach
</div>