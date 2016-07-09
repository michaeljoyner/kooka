{!! Form::model($product, ['url' => 'admin/products/'.$product->id, 'class' => 'dd-form form-horizontal']) !!}
@include('errors')
<div class="form-group">
    <label for="name">Name: </label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="description">Description: </label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="writeup">Writeup: </label>
    {!! Form::textarea('writeup', null, ['class' => 'form-control', 'id' => 'writeup']) !!}
</div>
<div class="form-group">
    <label for="price">Price: </label>
    {!! Form::text('price', null, ['class' => "form-control", 'placeholder' => 'As rand value, e.g. 125.00']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn dd-btn">{{ $buttonText }}</button>
</div>
{!! Form::close() !!}