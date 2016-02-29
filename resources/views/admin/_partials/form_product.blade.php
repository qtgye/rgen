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

<?php $category = isset($product->category) ? $product->category : null;?>
<!-- CATEGORY -->
<div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
    <label class="control-label col-lg-2" for="">Category <span class="required">*</span></label>
    <div class="col-lg-10">
        <!-- Residential -->
        <div class="form-group">
          <div class="col-md-3">
            <label class="control-label col-sm-12" for="">Residential :</label>
          </div>
          <div class="col-md-9">
            <label class="text-left control-label col-lg-3" for="category-residential-small">
              {!! Form::checkbox('category[]', 'residential-small', (isset($category) && in_array('residential-small',$category) ? true : false ), ['id'=>'category-residential-small'] ) !!} 
              Small
            </label>
            <label class="text-left control-label col-lg-3" for="category-residential-multifamily">
              {!! Form::checkbox('category[]', 'residential-multifamily', (isset($category) && in_array('residential-multifamily',$category) ? true : false ), ['id'=>'category-residential-multifamily'] ) !!} 
              Multi Family
            </label>
            <label class="text-left control-label col-lg-3" for="category-residential-other">
              {!! Form::checkbox('category[]', 'residential-other', (isset($category) && in_array('residential-other',$category) ? true : false ), ['id'=>'category-residential-other'] ) !!} 
              <em>Other</em>
            </label>
          </div>    
          <hr>      
        </div>
        <!-- Commercial -->
        <div class="form-group">
          <div class="col-md-3">
            <label class="control-label col-sm-12" for="">Commercial :</label>
          </div>
          <div class="col-md-9">
            <label class="text-left control-label col-lg-3" for="category-commercial-default">
              {!! Form::checkbox('category[]', 'commercial-default', (isset($category) && in_array('commercial-default',$category) ? true : false ), ['id'=>'category-commercial-default'] ) !!} 
              Commercial
            </label>
            <label class="text-left control-label col-lg-3" for="category-commercial-other">
              {!! Form::checkbox('category[]', 'commercial-other', (isset($category) && in_array('commercial-other',$category) ? true : false ), ['id'=>'category-commercial-other'] ) !!} 
              <em>Other</em>
            </label>
          </div>        
          <hr>  
        </div>
        <!-- Industrial -->
        <div class="form-group">
          <div class="col-md-3">
            <label class="control-label col-sm-12" for="">Industrial :</label>
          </div>
          <div class="col-md-9">
            <label class="text-left control-label col-lg-3" for="category-industrial-default">
              {!! Form::checkbox('category[]', 'industrial-default', (isset($category) && in_array('industrial-default',$category) ? true : false ), ['id'=>'category-industrial-default'] ) !!} 
              Industrial
            </label>
            <label class="text-left control-label col-lg-3" for="category-industrial-other">
              {!! Form::checkbox('category[]', 'industrial-other', (isset($category) && in_array('industrial-other',$category) ? true : false ), ['id'=>'category-industrial-other'] ) !!} 
              <em>Other</em>
            </label>
          </div>          
        </div>
        
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