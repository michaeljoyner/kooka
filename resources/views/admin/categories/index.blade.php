@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Categories</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-category-modal">
                New Category
            </button>
        </div>
    </section>
    @foreach($categories as $category)
        <a href="/admin/categories/{{ $category->id }}"><div class="category-card">
            <div class="category-card-image-box">
                <img src="{{ $category->imageSrc('thumb') }}" alt="">
            </div>
            <div class="category-card-details">
                <h1 class="category-card-title">{{ $category->name }}</h1>
                <p class="category-card-description lead">{{ $category->description }}</p>
            </div>
        </div></a>
    @endforeach
    @include('admin.partials.deletemodal')
    @include('admin.forms.categorymodal')
@endsection

{{--@section('bodyscripts')--}}
    {{--@include('admin.partials.modalscript')--}}
    {{--<script>--}}
        {{--new Vue({el: 'body'});--}}
    {{--</script>--}}
{{--@endsection--}}