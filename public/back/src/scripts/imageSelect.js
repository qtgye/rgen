App.createModule( 'ImageSelect', (function (app) {
    
    var module = {};



    
    /**
     * Private variables
     */
    
    var

    $container = $('.js-image-input'),
    $selectableTemplate,    

    token   = $('input[name="_token"]').val(),
    request;

    // Selectable Item Constructor
    function Selectable ($el,ImageInput) {
        
        var _selectable = this,
            selectablesMap = ImageInput.selectablesMap,
            selectables = ImageInput.selectables,
            $modal  = ImageInput.$modal;

        _selectable.$element = $el;
        _selectable.filename = $el.data('filename');
        _parentImageInput    = ImageInput;
        _selectable.isActive = false;

        // 
        // Methods
        // 

        _selectable.select = function () {
            if ( ImageInput.currentValue && ImageInput.currentValue != _selectable.filename ) {
                var index = selectablesMap[ImageInput.currentValue];
                if ( selectables[index] ) selectables[index].unselect();
            }
            ImageInput.$input
                .val(_selectable.filename)
                .trigger('change');
            $modal.modal('hide');
            _selectable.$element.addClass('is-active');
            _selectable.isActive = true;
            ImageInput.currentValue = _selectable.filename;
        }

        _selectable.unselect = function () {
            _selectable.$element.removeClass('is-active');
            _selectable.isActive = false;
        }



        // 
        // Binds
        // 

        _selectable.$element.on('click',function () {
            _selectable.select();            
        });

    }




    /**
     * Private functions
     */
    
    function bindImageInput ( $element ) {        

        var 
        $modal,
        $filesContainer,

        request,
        selectables = [],
        selectablesMap = {}; // file_name to index map of selectables

        var ImageInput = {
            $element            : $element,
            $thumbnailContainer : $element.find('.input-thumbnail'),
            $image              : $element.find('img'),
            $input              : $element.find('input'),
            $modalBtn           : $element.find('.js-image-input-btn'),
            selectables         : selectables,
            selectablesMap      : selectablesMap,
            currentValue        : null
        };

        function isPresent (filename) {
            return filename in selectablesMap;
        }

        function createSelectable ( $DOMItem ) {

            var _selectable = new Selectable($DOMItem,ImageInput);
                selectablesMap[_selectable.filename] = selectables.length;
                selectables.push(_selectable);

            if ( ImageInput.currentValue == _selectable.filename ) {
                _selectable.isActive = true;
                _selectable.$element.addClass('is-active');
                activeSelectable = _selectable;
            }

            return _selectable;
        }

        function newFromFileName (fileName) {
        
            var $new = $selectableTemplate.clone();

            $new
            .attr('data-filename',fileName)
            .prependTo($imagesContainer)
            .find('img').attr('src', '/uploads/' + fileName);

            var _selectable = createSelectable($new);

            return _selectable;
        }

        function onChange () {
        
            ImageInput.currentValue = ImageInput.$input.val();

            if ( ImageInput.currentValue ) {
                ImageInput.$image.attr('src', '/uploads/' + ImageInput.currentValue);
                ImageInput.$element.addClass('has-image');
            } else {
                ImageInput.$element.removeClass('has-image');
            }

        }

        function bindTabs () {
            
            var $tabControl = $modal.find('[data-toggle="tab"]'),
                $tabPane    = $modal.find('.tab-pane'),
                activeSelector;

            $tabControl.each(function () {
                
                var $el = $(this),
                    targetSelector = $el.attr('href');

                $el.on('click',function () {
                   
                    if ( activeSelector != targetSelector ) {
                        // deactivate current
                        if ( activeSelector ) {
                            $tabControl.filter('[href="'+activeSelector+'"').removeClass('active');
                            $tabPane.filter(activeSelector).removeClass('active');
                        }                        
                        // activate target
                        $el.addClass('active');
                        $tabPane.filter(targetSelector).addClass('active');
                    }  

                });

            });

        }

        function bindModal () {

            $modal = $('.js-image-select').clone().removeClass('js-image-select').appendTo($('body'));
            ImageInput.$modal = $modal;

            $modal
            .addClass('modal')
            .modal({
                backdrop    : 'static',
                show        : false
            });

            ImageInput.$modalBtn.on('click',function (e) {
                e.preventDefault();
                console.log('this should only open',$modal );
                $modal.modal('show');
            });

            var $input           = $modal.find('.image-select-input'),
                $btn             = $modal.find('.image-select-selectbtn'),
                $cancel          = $modal.find('.image-select-abortbtn'),
                inputId          = Math.floor(Math.random()*Date.now());

            $input.attr('id',inputId);
            $btn.attr('for',inputId);

            $imagesContainer = $modal.find('.image-select-container');
            $selectableTemplate = $modal.find('.template .image-select-item');
            
            // Bind selectable items
            $imagesContainer.find('.image-select-item').each(function () {            
                var $item = $(this),
                    filename = $item.data('filename');
                if ( !filename || isPresent(filename) ) return;
                createSelectable($item);                
            });

            // Bind input
            $input.on('change', function () {   
                if ( !$input.val() || $input[0].files.length === 0 ) return;

                var file = $input[0].files[0];
                $modal
                .removeClass('is-upload-error is-upload-success')
                .addClass('is-uploading');
                request = null;
                uploadFile(file, function ( xhr ) {
                    var resp;
                    request = null;
                    $modal.removeClass('is-uploading');
                    try {
                        resp = JSON.parse(xhr.responseText);
                        if ( !resp.success ) {
                            onUploadError(xhr);
                            return;
                        }
                    } catch (e) {
                        onUploadError(xhr);
                        return;
                    }
                    var fileData = resp.data,
                        _newSelectable = newFromFileName(resp.data.file_name);
                    _newSelectable.select();
                });
            });

            function onUploadError (xhr) {
                console.warn('The file was not uploaded due to some error. Please try again or select a different file.',xhr);
            }

            // Bind abort
            $cancel.on('click',function () {
               if ( request ) {
                request.abort();            
               }
               $modal
                .removeClass('is-uploading');
                request = null;
            });

        }

        function uploadFile (file, cb) {
            
            if ( !(file instanceof File) ) return;

            var formData = new FormData();
                formData.append('file',file);
                formData.append('file_type',getFileType(file));
                formData.append('_token',token);

            request = $.ajax({
                url  : app.routes.fileUpload,
                type : 'POST',
                data : formData,
                processData : false, // Don't process the files
                contentType : false, // Set content type to false as jQuery will tell the server its a query string request
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    // Upload progress
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            // $progress.css('width',(percentComplete * 100) + '%');
                        }
                    }, false);
                    return xhr;
                },
                complete : function (xhr) {
                    if ( isFunction(cb) ) cb(xhr);
                },
                error : function (xhr) {
                    if ( isFunction(cb) ) cb(xhr);
                }
            });

        }

        // Binds

        ImageInput.$input
        .on('change',onChange)
        .trigger('change');

        // Inits

        bindModal();
        bindTabs();

    }




    /**
     * API
     */




    /**
     * Init
     * @return void
     */
    module.init = function () {

        if ( !$container.length ) return;

        $container.each(function () {
            bindImageInput($(this));
        });
        
    };

    return module;
})(App));