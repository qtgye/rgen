<div class="panel panel-default js-upload c-upload">

    <header class="panel-heading">
        Upload Files
    </header>

    <div class="panel-body">

        <div class="form-group">
            <div class="col-sm-12">

                <!-- select/add button -->
                <label class="btn btn-primary js-file-btn add-btn hide-on-uploading hide-on-error hide-on-success" for="files_input">
                    <i class="fa fa-plus"></i> 
                    Add Files
                </label>
                <input type="file" multiple hidden id="files_input" class="hidden js-input">

                <!-- status -->
                <p class="upload-status pull-left show-on-uploading">
                    <i class="fa fa-circle-o-notch fa-spin"></i> 
                    <span class="status-text js-upload-status">
                        <!-- dynamic through js -->
                    </span>
                </p>

                <!-- error -->
                <p class="upload-error pull-left show-on-error text-warning">
                    <i class="fa fa-warning"></i> 
                    <span class="status-text js-upload-error">
                        <!-- dynamic through js -->
                    </span>
                </p>

                <!-- success -->
                <p class="upload-error pull-left show-on-success text-success">
                    <i class="fa fa-check-circle"></i> 
                    <span class="status-text js-upload-success">
                        All files were uploaded successfully.
                    </span>
                </p>

                <!-- clear button -->
                <div class="btn btn-default clear-btn js-clear-btn hide-on-empty">
                    Clear All
                </div>

                <!-- upload action button -->
                <div class="btn btn-success upload-btn js-upload-btn hide-on-empty pull-right">
                    <i class="fa fa-upload"></i> 
                    Upload
                </div>

                <!-- retry on error -->
                <div class="btn btn-default reset-btn js-reset-btn pull-right">
                    Reset
                </div>

                <!-- go to media -->
                <a href="/admin/media" class="btn btn-success media-link show-on-success pull-right">
                    Go to Media
                </a>

                <a href="javascript://void" class="pull-right show-on-uploading js-abort-btn">Abort unfinished files</a>

            </div>
        </div>
            
        <!-- files preview -->
        <div class="container">
            <div class="row files-container">
                <!-- dynamically loaded elements -->
            </div>
        </div>  <!-- end files preview -->

        <!-- template for each file -->
        <div class="template hidden">
            <div class="col-sm-6 col-md-4 col-lg-3 preview-item">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="preview-thumb">

                            <img src="{{ asset('/back/images/image.png') }}" alt="" class="preview-thumb-image thumbnail-image">
                            <img src="{{ asset('/back/images/video.png') }}" alt="" class="preview-thumb-image thumbnail-video">
                            <img src="{{ asset('/back/images/audio.png') }}" alt="" class="preview-thumb-image thumbnail-audio">
                            <img src="{{ asset('/back/images/document.png') }}" alt="" class="preview-thumb-image thumbnail-document">
                            <img src="{{ asset('/back/images/other.png') }}" alt="" class="preview-thumb-image thumbnail-other">

                            <div class="preview-progress js-preview-progress"></div>
                            <div class="preview-success">
                                <i class="fa fa-check fa-2x"></i>
                            </div>
                            <p class="preview-error text-danger show-on-error">
                                <!-- dynamic through js -->
                            </p>
                        </div>
                        <br>
                        
                        <div class="preview-meta">
                            
                            <p>
                                <small class="preview-text">
                                    <!-- Filename -->
                                </small>
                            </p>

                            <p>
                                
                            </p>


                        </div>
                        
                        <div class="btn btn-default btn-sm preview-btn">
                            Remove
                        </div>
                    </div>                            
                </div>
            </div>
        </template>        

    </div>

</div>