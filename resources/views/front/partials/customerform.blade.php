{!! Form::open(['url' => '/checkout', 'class' => 'checkout-form']) !!}
<div class="form-group">
    <label for="customer_name">Your Name: </label>
    {!! Form::text('customer_name', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="customer_email">Your Email: </label>
    {!! Form::email('customer_email', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="customer_phone">Contact number: </label>
    {!! Form::text('customer_phone', null, ['class' => "form-control"]) !!}
</div>
<div class="form-group">
    <label for="customer_address">Address (for delivery): </label>
    {!! Form::textarea('customer_address', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="enquiry">Additional Info: </label>
    {!! Form::textarea('enquiry', null, ['class' => 'form-control', 'placeholder' => 'Feel free to give further info or ask any questions']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn checkout-button">Get Quote</button>
</div>
{!! Form::close() !!}