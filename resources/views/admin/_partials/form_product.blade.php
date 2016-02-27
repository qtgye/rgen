<!-- NAME -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  <label class="col-sm-2 control-label" for="products_name">Product Name <span class="required">*</span></label>
  <div class="col-sm-10">
      {!! Form::text('name', null, [
            'class' => 'form-control',
            'id' => 'products_name'
      ]) !!}
  </div>
</div>

<!-- CATEGORY -->
<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
    <label class="control-label col-lg-2" for="category_products">Category <span class="required">*</span></label>
    <div class="col-lg-10">
        {!! Form::select('category', [
            'residential' => 'Residential',
            'commercial' => 'Commercial',
            'industrial' => 'Industrial',
        ], isset($product) ? $product->category : '' , [
            'class' => 'form-control m-bot15',
            'id' => 'category_products'
        ]) !!}
    </div>
</div>

<!-- TYPE -->
<!-- small,multifamily,industrial,other -->
<div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
    <label class="control-label col-lg-2" for="type_products">Type <span class="required">*</span></label>
    <div class="col-lg-10">
        {!! Form::select('type', [
            'small' => 'Small',
            'multifamily' => 'Multi Family',
            'industrial' => 'Industrial',
            'other' => 'Other',
        ], isset($product) ? $product->type : '' , [
            'class' => 'form-control m-bot15',
            'id' => 'type_products'
        ]) !!}
    </div>
</div>

<!-- DESCRIPTION -->
<div class="form-group">
    <label class="control-label col-lg-2" for="description_products">Description</label>
    <div class="col-lg-10">
        {!! Form::textarea('description', isset($product) ? $product->description : '', [
            'id' => "description_products",
            'class'=> "form-control ckeditor",
            'rows' => "6"
        ]) !!}
    </div>
</div>

<!-- IMAGE SRC -->
<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }} form-image-input js-image-input">
    <label class="control-label col-lg-2" for="product_image">Image (product/logo)</label>
    <div class="col-lg-10">
      <div class="input-thumbnail">
        <img src="" alt="" class="input-image">
        <br><br>
      </div>
      {!! Form::text('image', null,[
          'id' => 'product_image',
          'class' => 'hidden',
      ]) !!}   
      <div>
        <div class="btn btn-default js-image-input-btn" data-toggle="modal">
          <span class="select">
            Select Image
          </span>
          <span class="replace">
            Replace Image
          </span>
        </div>
      </div>      
    </div>    
</div>

<!-- pdf select -->
<div class="form-group {{ $errors->has('info_file') ? 'has-error' : '' }} form-pdf-input js-pdf-input">
    <label class="control-label col-lg-2" for="product_info-file">Product Info File</label>
    <div class="col-lg-10">
      <p class="input-text">{{ isset($product) ? $product->toArray()['info_file'] : '' }}</p>
      <p class="show-on-error alert alert-danger">
        Please select a valid pdf file.
      </p>
      <label for="product_info_file" class="btn btn-default">
          <span class="select">
            Select File
          </span>
          <span class="replace">
            Replace File
          </span>
      </label>
      {!! Form::file('info_file',[
          'id' => 'product_info-file',
          'class' => 'hidden',
          'id' => 'product_info_file'
      ]) !!}
      <p class="help-block">Accepted file type is PDF.</p>
    </div>    
</div>