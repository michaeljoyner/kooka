@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Archived Orders</h1>
        <div class="header-actions pull-right">
            <a href="/admin/orders" class="btn dd-btn btn-dark">Back to Orders</a>
        </div>
    </section>
    @include('admin.partials.orderstable')
@endsection

