{!! Form::model($category, ['url' => 'admin/categories/'.$category->id, 'class' => 'dd-form form-horizontal']) !!}
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
    <button type="submit" class="btn dd-btn">{{ $buttonText }}</button>
</div>
{!! Form::close() !!}