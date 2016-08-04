@extends('front.base')

@section('content')
    <h1 class="main-heading text-green-hard centered-text">Checkout</h1>
    <section class="checkout-container">
        <section class="checkout-help">
            <h2 class="text-green-hard sub-heading">What Happens Now?</h2>
            <p>Once you send us this form you can sit back and let us take over. We will immediately process your order and get back to you with a quote and to organise your delivery. We take care of everything to make sure everything goes as smoothly as possible for you.</p>
        </section>
        <section class="checkout-main">
            <section class="current-order">
                @include('front.partials.ordertable')
            </section>
            <section class="customer-form">
                @include('front.partials.customerform')
            </section>
        </section>
    </section>
@endsection