@extends('admin.base')

@section('head')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection

@section('content')
    <section class="dd-page-header">
        <h1>Edit this product</h1>
    </section>
    @include('admin.forms.product', ['buttonText' => 'Save Changes'])
@endsection

@section('bodyscripts')
    @include('admin.partials.tinymce.writeup')
@endsection