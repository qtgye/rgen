<section class="panel">
  <header class="panel-heading tab-bg-primary ">
      <ul class="nav nav-tabs">
          <li class="active">
              <a data-toggle="tab" href="#general">General Info</a>
          </li>
          <li class="">
              <a data-toggle="tab" href="#statements">Statements</a>
          </li>
          <li class="">
              <a data-toggle="tab" href="#assets">Assets</a>
          </li>
      </ul>
  </header>
  <div class="panel-body">
      <div class="tab-content">

          <div id="general" class="tab-pane active">
            
            <!-- SITE TITLE -->
            <div class="form-group {{ $errors->has('site-title') ? 'has-error' : '' }}">
              <label class="col-sm-2 control-label" for="info_site-title">Site Title <span class="required">*</span></label>
              <div class="col-sm-10">
                  {!! Form::text('site-title', isset( $infos['site-title'] ) ? $infos['site-title'] : '' , [
                        'class' => 'form-control',
                        'id' => 'info_site_title'
                  ]) !!}
              </div>
            </div>

            <!-- ADDRESS -->
            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
              <label class="col-sm-2 control-label" for="info_address">Address<span class="required">*</span></label>
              <div class="col-sm-10">
                  {!! Form::text('address', isset( $infos['address'] ) ? $infos['address'] : '' , [
                        'class' => 'form-control',
                        'id' => 'info_address'
                  ]) !!}
              </div>
            </div>

            <div class="form-group">
                <div class="col-md-10 pull-right">
                    <div class="row">
                        
                        <!-- PHONE -->
                        <div class="col-md-6 {{ $errors->has('phone') ? 'has-error' : '' }}">
                          <label class="control-label" for="info_phone">Phone<span class="required">*</span></label>
                          {!! Form::text('phone', isset( $infos['phone'] ) ? $infos['phone'] : '' , [
                                'class' => 'form-control',
                                'id' => 'info_address'
                          ]) !!}
                        </div>

                        <!-- FAX -->
                        <div class="col-md-6 {{ $errors->has('fax') ? 'has-error' : '' }}">
                          <label class="control-label" for="info_fax">Fax</label>
                          {!! Form::text('fax', isset( $infos['fax'] ) ? $infos['fax'] : '' , [
                                'class' => 'form-control',
                                'id' => 'info_address'
                          ]) !!}
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 {{ $errors->has('email') ? 'has-error' : '' }}">
                          <label class="control-label" for="info_email">Contact Email <span class="required">*</span></label>
                          {!! Form::text('email', isset( $infos['email'] ) ? $infos['email'] : '' , [
                                'class' => 'form-control',
                                'id' => 'info_address'
                          ]) !!}
                        </div>

                    </div>
                </div>
            </div>            

          </div>

          <div id="statements" class="tab-pane">
            
            <!-- DESCRIPTION -->
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label class="control-label col-lg-2" for="info_description">Description <span class="required">*</span></label>
                <div class="col-lg-10">
                    {!! Form::textarea('description', isset( $infos['description'] ) ? $infos['description'] : '' , [
                        'id' => "info_description",
                        'class'=> "form-control",
                        'rows' => "3"
                    ]) !!}
                </div>
            </div>

            <!-- MISSION -->
            <div class="form-group {{ $errors->has('mission') ? 'has-error' : '' }}">
                <label class="control-label col-lg-2" for="info_mission">Mission</label>
                <div class="col-lg-10">
                    {!! Form::textarea('mission', isset( $infos['mission'] ) ? $infos['mission'] : '' , [
                        'id' => "info_description",
                        'class'=> "form-control mission ckeditor",
                        'rows' => "3"
                    ]) !!}
                </div>
            </div>

            <!-- VISION -->
            <div class="form-group {{ $errors->has('vision') ? 'has-error' : '' }}">
                <label class="control-label col-lg-2" for="info_vision">Vision</label>
                <div class="col-lg-10">
                    {!! Form::textarea('vision', isset( $infos['vision'] ) ? $infos['vision'] : '' , [
                        'id' => "info_description",
                        'class'=> "form-control vision",
                        'rows' => "3"
                    ]) !!}
                </div>
            </div>

          </div>

          <div id="assets" class="tab-pane">
                
            <!-- LOGO -->
            <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }} form-image-input js-image-input">
                <label class="control-label col-lg-2" for="product_image">Logo <span class="required">*</span></label>
                <div class="col-lg-10">
                  <div class="input-thumbnail">
                    <img src="" alt="" class="input-image">
                    <br><br>
                  </div>
                  {!! Form::text('logo', isset( $infos['logo'] ) ? $infos['logo'] : '',[
                      'id' => 'product_image',
                      'class' => 'hidden',
                  ]) !!}   
                  <div>
                    <div class="btn btn-default js-image-input-btn">
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

            <!-- FAVICON -->
            <div class="form-group {{ $errors->has('favicon') ? 'has-error' : '' }} form-image-input js-image-input">
                <label class="control-label col-lg-2" for="product_image">Favicon <span class="required">*</span></label>
                <div class="col-lg-10">
                  <div class="input-thumbnail">
                    <img src="" alt="" class="input-image">
                    <br><br>
                  </div>
                  {!! Form::text('favicon', isset( $infos['favicon'] ) ? $infos['favicon'] : '',[
                      'id' => 'product_image',
                      'class' => 'hidden',
                  ]) !!}   
                  <div>
                    <div class="btn btn-default js-image-input-btn">
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

            <!-- VIDEO -->
            <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
              <label class="col-sm-2 control-label" for="info_video">Video Link</label>
              <div class="col-sm-10">
                  {!! Form::text('video', isset( $infos['video'] ) ? $infos['video'] : '' , [
                        'class' => 'form-control',
                        'id' => 'info_address'
                  ]) !!}
              </div>
            </div>

          </div>
      </div>
  </div>
</section>