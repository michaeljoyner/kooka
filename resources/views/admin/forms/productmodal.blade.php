<div class="modal fade dd-modal" id="create-product-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add a new product to this category</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => '/admin/categories/' . $category->id . '/products', 'class' => 'form-horizontal dd-form modal-form']) !!}
                <div class="form-group">
                    <label for="title">Name: </label>
                    {!! Form::text('name', null, ['class' => "form-control", 'placeholder' => 'Category name', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="description">Description: </label>
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'What you want to see in the search results']) !!}
                </div>
                <div class="form-group">
                    <label for="price">Price: </label>
                    {!! Form::text('price', null, ['class' => "form-control", 'placeholder' => 'As rand value, e.g. 125.00']) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dd-btn btn-light dd-modal-cancel-btn" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn dd-btn dd-modal-confirm-btn">Create</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->