<!-- TITLE -->
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
  <label class="col-sm-2 control-label" for="project_title">Title <span class="required">*</span></label>
  <div class="col-sm-10">
      {!! Form::text('title', isset($project) ? $project->title : '', [
            'class' => 'form-control',
            'id' => 'project_title'
      ]) !!}
  </div>
</div>

<!-- IMAGE SRC -->
<div class="form-group {{ $errors->has('image') ? 'has-error' : '' }} form-image-input js-image-input">
    <label class="control-label col-lg-2" for="project_image">Image (product/logo)</label>
    <div class="col-lg-10">
      <div class="input-thumbnail">
        <img src="" alt="" class="input-image">
        <br><br>
      </div>
      {!! Form::text('image', null,[
          'id' => 'project_image',
          'class' => 'hidden',
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