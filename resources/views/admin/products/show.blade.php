@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $product->name }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/products/{{ $product->id }}/edit">
                <div class="btn dd-btn btn-light">
                    Edit
                </div>
            </a>
            @include('admin.partials.deletebutton', [
                'objectName' => $product->name,
                'deleteFormAction' => '/admin/products/'.$product->id
            ])
        </div>
    </section>
    <section class="category-show row">
        <div class="col-md-7">
            <p class="lead">{{ $product->description }}</p>
            <p><strong>Price: </strong>R{{ $product->price->asCurrencyString() }}</p>
            <div class="product-writeup">
                {!! $product->writeup !!}
            </div>
        </div>
        <div class="col-md-5">
            <div class="availability">
                <p class="lead">Is this product available?</p>
                <toggle-switch identifier="1"
                               true-label="yes"
                               false-label="no"
                               :initial-state="{{ $product->available ? 'true' : 'false' }}"
                               toggle-url="/admin/products/{{ $product->id }}/availability"
                               toggle-attribute="available"
                ></toggle-switch>
                <p class="lead">Promote this product?</p>
                <toggle-switch identifier="2"
                               true-label="yes"
                               false-label="no"
                               :initial-state="{{ $product->isPromoted() ? 'true' : 'false' }}"
                               toggle-url="/admin/products/{{ $product->id }}/promote"
                               toggle-attribute="promote"
                ></toggle-switch>
            </div>
            <div class="category-img-box single-image-uploader-box">
                <single-upload default="{{ $product->imageSrc() }}"
                               url="/admin/products/{{ $product->id }}/images"
                               shape="square"
                               size="large"
                ></single-upload>
                <section class="gallery-thumbs">
                    <a href="/admin/products/{{ $product->id }}/gallery"><h2>Product Gallery</h2></a>
                    @foreach($product->getGalleryMedia() as $image)
                        <img src="{{ $image->getUrl('thumb') }}" alt="" class="gallery-thumb" width="80px" height="80px">
                    @endforeach
                </section>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
    <script>
        new Vue({el: 'body'});
    </script>
@endsection