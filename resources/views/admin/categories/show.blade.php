@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">{{ $category->name }}</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-product-modal">
                Add Product
            </button>
            <a href="/admin/categories/{{ $category->id }}/edit">
                <div class="btn dd-btn btn-light">
                    Edit
                </div>
            </a>
            @include('admin.partials.deletebutton', [
                'objectName' => $category->name,
                'deleteFormAction' => '/admin/categories/'.$category->id
            ])
        </div>
    </section>
    <section class="category-show row">
        <div class="col-md-7">
            <p class="lead">{{ $category->description }}</p>
            <section class="category-products">
                <h2>Category Products</h2>
                @foreach($category->products as $product)
                <a href="/admin/products/{{ $product->id }}"><div class="product-index-card">
                    <div class="product-index-card-image-box">
                        <img src="{{ $product->imageSrc('thumb') }}" alt="">
                    </div>
                    <div class="product-index-card-details">
                        <h3 class="product-index-card-name">{{ $product->name }}</h3>
                        <p class="product-index-card-description lead">{{ $product->description }}</p>
                    </div>
                </div></a>
                @endforeach
            </section>
        </div>
        <div class="col-md-5">
            <div class="category-img-box single-image-uploader-box">
                <single-upload default="{{ $category->imageSrc() }}"
                               url="/admin/categories/{{ $category->id }}/images"
                               shape="square"
                               size="large"
                ></single-upload>
            </div>
        </div>
    </section>
    @include('admin.partials.deletemodal')
    @include('admin.forms.productmodal')
@endsection

@section('bodyscripts')
@include('admin.partials.modalscript')
<script>
new Vue({el: 'body'});
</script>
@endsection