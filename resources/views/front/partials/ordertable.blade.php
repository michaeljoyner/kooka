<table class="checkout-order-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Item name</th>
        <th>Qty</th>
        <th>Quote</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderedItems as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->qty }}</td>
            <td>R{{ $item->subtotal }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th class="foot-heading" colspan="3">Subtotal:</th>
        <th>R{{ $cart_subtotal }}</th>
    </tr>
    </tfoot>
</table>