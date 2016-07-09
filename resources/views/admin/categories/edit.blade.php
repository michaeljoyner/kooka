@extends('admin.base')

@section('content')
    <section class="dd-page-header">
        <h1>Edit this category</h1>
    </section>
    @include('admin.forms.category', ['buttonText' => 'Save Changes'])
@endsection