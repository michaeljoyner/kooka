@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Order #{{ $order->id }}</h1>
        <div class="header-actions pull-right">
            <a href="/admin/orders">
                <div class="btn dd-btn btn-light">
                    Orders
                </div>
            </a>
        </div>
    </section>
    <section class="category-show row">
        <div class="col-md-7">
            <div class="customer-details">
                <p class="lead"><strong>Customer: </strong>{{ $order->customer_name }}</p>
                <p class="lead"><strong>Email: </strong>{{ $order->customer_email }}</p>
                <p class="lead"><strong>Phone: </strong>{{ $order->customer_phone }}</p>
                <p class="lead"><strong>Address: </strong></p>
                <p class="lead">{!! nl2br($order->customer_address) !!}</p>
            </div>
            <div class="order-items-list">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Item name</th>
                        <th>Quantity</th>
                        <th>Quote</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>R{{ $item->quote }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3">Total Quote</td>
                        <td>R{{ $order->original_quote }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div>
                <h4>Additional Info:</h4>
                <p class="lead">{!! nl2br($order->enquiry) !!}</p>
            </div>
        </div>
        <div class="col-md-5">
            <div class="availability order-status-switch-box">
                <p class="lead">Order Status:</p>
                <toggle-switch identifier="1"
                               true-label="Current"
                               false-label="Archived"
                               :initial-state="{{ $order->isArchived() ? 'false' : 'true' }}"
                               toggle-url="/admin/orders/{{ $order->id }}/archive"
                               toggle-attribute="current"
                ></toggle-switch>
            </div>
        </div>
    </section>
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
    <script>
        new Vue({el: 'body'});
    </script>
@endsection