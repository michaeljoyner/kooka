{!! Form::model($user, ['url' => 'admin/users/'.$user->id, 'class' => 'dd-form form-narrow form-horizontal']) !!}
@include('errors')
<div class="form-group">
    <label for="name">Name: </label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="email">Email: </label>
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn dd-btn">Save Changes</button>
</div>
{!! Form::close() !!}