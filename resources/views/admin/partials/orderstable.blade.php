<section class="orders-list">
    <table class="table table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Original Quote</th>
            <th>Placed</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><a href="/admin/orders/{{ $order->id }}">{{ $order->customer_name }}</a></td>
                <td>R{{ $order->original_quote }}</td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $orders->links() !!}
</section>