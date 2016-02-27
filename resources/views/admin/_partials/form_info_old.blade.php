<!-- TITLE -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  <label class="col-sm-2 control-label" for="info_name">Name <span class="required">*</span></label>
  <div class="col-sm-10">
      {!! Form::text('name', isset($info) ? $info->name : '', [
            'class' => 'form-control',
            'id' => 'info_name'
      ]) !!}
  </div>
</div>

<div class="c-conditional-input js-conditional-input">
    
<!-- VALUE TYPE -->
<div class="form-group js-conditional-select {{ $errors->has('value_type') ? 'has-error' : '' }}">
    <label class="control-label col-lg-2" for="category_products">Value Type <span class="required">*</span></label>
    <div class="col-lg-10">
        {!! Form::select('value_type', [
            'short_text' => 'Short text',
            'long_text' => 'Long Text',
            'editor' => 'Editor',
            'image' => 'Image'
        ], isset($info) ? $info->value_type : '' , [
            'class' => 'form-control m-bot15',
            'id' => 'category_products'
        ]) !!}
    </div>
</div>

<!-- VALUE -->
<div class="form-group">
  <label class="col-sm-2 control-label" for="">Value<span class="required">*</span></label>
  <div class="col-sm-10">
      
    <div class="short_text-input">
        {!! Form::text('value_short_text', isset($info) && $info->value_type == 'short_text' ? $info->value : '', [
                'class' => 'form-control'
          ]) !!}
    </div>

    <div class="long_text-input">
        {!! Form::textarea('value_long_text', isset($info) && $info->value_type == 'long_text' ? $info->value : '', [
                'class' => 'form-control',
                'rows' => 4
          ]) !!}
    </div>

    <div class="editor-input">
        {!! Form::textarea('value_editor', isset($info) && $info->value_type == 'editor' ? $info->value : '', [
            'class'=> "form-control ckeditor",
            'rows' => "6"
        ]) !!}
    </div>

    <div class="image-input">
        <div class="form-image-input js-image-input">
            <div class="input-thumbnail">
                <img src="" alt="" class="input-image">
                <br><br>
            </div>
                {!! Form::text('value_image', isset($info) &&$info->value_type == 'image' ? $info->value : '',[
                  'class' => 'hidden'
                ]) !!}   
            <div>
            <div class="btn btn-default js-image-input-btn" data-toggle="modal" data-target="#imageSelectModal">
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

    <br>

  </div>
</div>



</div>
