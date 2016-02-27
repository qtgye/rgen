<!-- image input modal -->
<div class="js-modal fade c-image-select js-image-select" style="display:none" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select image</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                  
                    <div class="panel image-select-panel">
                  
                        <header class="panel-heading tab-bg-primary image-select-tabheader">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href=".images-tab" data-toggle="tab">Images</a></li>
                                <li class="">
                                    <a href=".upload-tab" data-toggle="tab">Upload</a>                                    
                                </li>                                
                            </ul>
                        </header>

                        <div class="panel-body">
                            <div class="container">
                                <div class="tab-content row">
                                    <div class="images-tab tab-pane active images-tab">
                                        <div class="row image-select-container">
                                            
                                            @foreach ($images as $image)
                                                <div class="col-sm-6 col-md-4 col-lg-3 image-select-item" data-filename="{{ $image->file_name }}">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="image-select-thumbnail">
                                                                <img src="/uploads/{{ $image->file_name }}" title="{{ $image->title }}" alt="" class="image-select-image">
                                                            </div>
                                                        </div>
                                                    </div>                                
                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="template hidden">
                                            <div class="col-sm-6 col-md-4 col-lg-3 image-select-item" data-filename="">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class="image-select-thumbnail">
                                                            <img src="" alt="" class="image-select-image">
                                                        </div>
                                                    </div>
                                                </div>                                
                                            </div>
                                        </div>

                                    </div>
                                    <div class="upload-tab tab-pane upload-tab">
                                        <div class="container">

                                                <div class="spinner-block">
                                                    <i class="fa fa-circle-o-notch fa-spin fa-3x"></i>
                                                </div>

                                                <!-- error text -->
                                                <div class="alert alert-danger image-select-error">
                                                    The selected file cannot be uploaded due to an error.
                                                    Please try again or select another file.
                                                </div>
                                                
                                                <label class="btn btn-default image-select-selectbtn">Upload Image</label>
                                                <input type="file" class="hidden image-select-input" accept="image/*" hidden>
                                                
                                                <div class="btn btn-default image-select-abortbtn">Cancel</div>
                                                                                    

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

              </div>
            </div>
        </div>
    </div>
</div>