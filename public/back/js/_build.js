/**
 * Tests whether the argument supplied is a function
 * @return {Boolean}
 */
function isFunction( fn ) {
    return fn instanceof Function;
}

/**
 * Checks whether a given item is present in the given array
 * @param  {any} item = the item to be searched
 * @param  {array} arr  = the array to search from
 * @return {Boolean} 
 */
function inArray( item, arr ) {
    if ( !(arr instanceof Array) ) return false;
    return arr.indexOf(item) > -1;
}

/**
 * gets a short string of the file type
 * @param  {object} fileObject File instance
 * @return {string} photo | video | document | other
 */
function getFileType (file) {       
    if ( ! (file instanceof File) ) return '';

    if ( file.name.match(/[.](jpg|jpeg|png|gif|bmp|ico)$/i) ) {
        return 'image';
    }
    else if ( file.name.match(/[.](mp4|mpeg|avi|mov|3gp|wmv|mkv)$/i) ) {
        return 'video';
    }
    else if ( file.name.match(/[.](wav|mp3|wma)$/i) ) {
        return 'audio';
    }
    else if ( file.name.match(/[.](doc|docx|txt)$/i) ) {
        return 'document';
    }
    else if ( file.name.match(/[.](pdf)$/i) ) {
        return 'pdf';
    }
    return 'other';
}
;(function ( window, $ ) {

    if ( $ !== jQuery ) {
        throw new ReferenceError('Cannot load the Application. JQuery is highly advised to be loaded prior to the App initialization.\r\n\ Please visit http://jquery.com/download/');
    }

    window.App = {};

    /**
     * Collection of all the App modules
     * @type {Array}
     */
    App.modules = [];

    /**
     * Collection of routes
     * @type {Object}
     */
    App.routes = {
        
        // AJAX routes
        fileUpload : '/api/media'
    };

    /**
     * Initializes the App and its modules
     * @return void
     */
    App.init    = function () {
        App.modules.forEach(function ( module ) {    
            if ( isFunction(module.object.init) ) module.object.init();
            module._loaded = true;
            module._isModule = true;
        });
        App.isLoaded = true;
    }

    /**
     * Creates an App module which will be initiated on document ready
     * @param  {string} moduleName   the name of the module
     * @param  {object} moduleObject the module itself
     * @return void              
     */
    App.createModule = function ( moduleName, moduleObject ) {    
        App.modules.push({
            name : moduleName,
            object : moduleObject
        });
        App[moduleName] = moduleObject;
        if ( App.isLoaded && isFunction(moduleObject.init) ) moduleObject.init();
    }


    $(document).ready(function () {
        App.init();
    });

})( window, $ );

App.createModule( 'Upload', (function (app) {
    
    var module = {};



    
    
    var $container = $('.js-upload'),
        $filesContainer = $container.find('.files-container'),
        $fileTemplate = $container.find('.template').find('.preview-item'),

        $input = $container.find('.js-input'),
        $addBtn = $container.find('.js-file-btn'),
        $clearBtn = $container.find('.js-clear-btn'),
        $uploadBtn = $container.find('.js-upload-btn'),
        $abortBtn = $container.find('.js-abort-btn'),
        $statusText = $container.find('.js-upload-status'),
        $errorText = $container.find('.js-upload-error'),
        $successText = $container.find('.js-upload-success'),
        $resetBtn = $container.find('.js-reset-btn'),

        token = $('input[name="_token"]').val(),
        uploadLimit,
        requestsCount = 0,
        uploaded = 0,
        fileObjects = [],
        fileObjectsMap = {}, // filename to index reference of each fileObjects item;

        URL = window.URL || window.webkitURL;

    // Creates an instance for each file
    var FileObject = function (file) {
        
        var _file = this,
            request = null;

        _file.dataURL = URL.createObjectURL(file);

        _file.name          = file.name;
        _file.size          = file.size;
        _file.mimeType      = file.mimeType;
        _file.originalFile  = file;
        _file.$element      = $fileTemplate.clone();
        _file.isUploadSuccess = false;
        _file.isUploadDone  = false;

        var $image      = _file.$element.find('.thumbnail-image'),
            $progress   = _file.$element.find('.js-preview-progress'),
            $text       = _file.$element.find('.preview-text'),
            $error      = _file.$element.find('.preview-error'),
            $btn        = _file.$element.find('.preview-btn');

        // private functions  

        function onUploadSuccess (data,uploadDone) {
            uploaded++;
            requestsCount++;
            _file.isUploadSuccess = true;
            _file.isUploadDone = true;
            if ( isFunction(uploadDone) ) uploadDone();
            _file.$element.removeClass('is-uploading').addClass('is-success');
            console.log('data',data);
        }

        function onUploadError (data,uploadDone) {
            request = null;
            requestsCount++;
            _file.isUploadDone = true;

            if ( isFunction(uploadDone) ) uploadDone();
            _file.$element.removeClass('is-uploading').addClass('is-error');

            var errorText   = ( data.data && data.data.message ) ?
                              data.data.message :
                              'This file was not uploaded due to an error.';

            $error.text(errorText);            
            console.warn('The file '+_file.name+' was not uploaded due to an error:', data);       
        }

        function onRequestError (xhr,uploadDone) {
            request = null;
            requestsCount++;
            _file.isUploadDone = true;

            if ( isFunction(uploadDone) ) uploadDone();
            _file.$element.removeClass('is-uploading').addClass('is-error');

            $error.text('This file was not uploaded due to an error.');       

            if ( xhr.statusText == 'abort' ) {
                $error.text('This file was aborted.');    
                console.warn('The file ' + _file.name + ' was aborted.'); return;
            }            

            console.warn('The file '+_file.name+' was not uploaded due to an error:', xhr);
        }

        /**
         * Uploads the file object
         * @param  {Function} uploadDone callback function for the request
         * @return void
         */
        function upload ( uploadDone ) {

            var formData = new FormData();
            formData.append('file',_file.originalFile);
            formData.append('_token',token);
            _file.$element.addClass('is-uploading');
            request = $.ajax({
                url : app.routes.fileUpload,
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
                            $progress.css('width',(percentComplete * 100) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success : function (data,status,xhr) {
                    request = null;
                    if ( !data.success ) {
                        onUploadError(data,uploadDone); return;
                    }
                    onUploadSuccess(data, uploadDone);
                },
                error : function (xhr) {
                    onRequestError(xhr,uploadDone);
                }
            });
        }

        function abort () {
            if ( request ) {
                request.abort();                
            }
            _file.$element
            .removeClass('is-uploading')
            .addClass('is-error');
        }

        function remove () {
            var index = fileObjectsMap[_file.name];
            abort();
            _file.$element.remove();
            if (index > -1) {
                fileObjects[index] = null;
            }
            delete fileObjectsMap[_file.name];
        }

        // methods

        _file.remove = remove;
        _file.upload = upload;
        _file.abort = abort;

        // DOM update

        if ( _file.type == 'image' ) {
            $image.attr('src',_file.dataURL);
        }
        $text.text(_file.name);
        _file.$element.addClass('filetype-'+_file.type);

        // Binds

        $btn.on('click', remove);

        fileObjectsMap[_file.name] = fileObjects.length;        
        fileObjects.push(_file);
    }

    // Checks whether a given file has already been processed
    FileObject.isFilePresent = function ( file ) {
        var filename = file.name;
        return filename in fileObjectsMap;
    }



    /**
     * Private functions
     */
    
    function getFileObjects () {
        return fileObjects.filter(function (file) {
            return file;
        });
    }

    function uploadAll () {
        requestsCount = 0;
        uploaded = 0;
        $container.addClass('is-uploading');

        var fileObjects = getFileObjects(),
            totalCount  = fileObjects.length;

        $statusText.text( 'Uploaded 0 of ' + totalCount + ' items.' );

        fileObjects.forEach(function ( _fileObject ) {
           _fileObject.upload(function () {
                $statusText.text( 'Uploaded ' + uploaded + ' of ' + totalCount + ' items.' );
                if ( requestsCount === totalCount ) {                    
                    // Finished all requests
                    $container.removeClass('is-uploading');
                    if ( uploaded === totalCount ) {
                        $container.addClass('is-success');
                    }
                    else if ( uploaded === 0 ) {
                        $errorText.text( 'No file was uploaded. Please check your internet connection.' );
                        $container.addClass('is-error');
                    }
                    else {
                        $errorText.text( 'Only ' + uploaded + ' of ' + totalCount + ' items were uploaded.' );
                        $container.addClass('is-error');
                    }
                }
           });
        });
    }

    function abort () {
        getFileObjects().forEach(function ( _fileObject ) {
           if ( !_fileObject.isUploadDone )  {
                _fileObject.abort();
           }
        });
    }

    function bindEvents () {
        
        $input.on('change', onInputChange);
        $clearBtn.on( 'click', clear );
        $resetBtn.on( 'click', clear );
        $uploadBtn.on( 'click', uploadAll );
        $abortBtn.on( 'click', abort );

    }

    function onInputChange (e) {
        
        if ( !$input[0].files.length ) return;

        [].map.call( $input[0].files, function ( file ) {
            if ( FileObject.isFilePresent(file) ) return; // do not process if file is already present         
            var _fileObject = new FileObject(file);
            $filesContainer.append(_fileObject.$element);
        });

        $container.toggleClass( 'has-files', getFileObjects().length > 0 );

    }

    function clear () {
        $input.val('');
        fileObjects.forEach(function ( _fileObject ) {
            _fileObject.remove();
        });
        fileObjectsMap = {};
        fileObjects = [];
        $container
        .removeClass( 'has-files is-error is-uploading is-success' );
    }

    function getUploadLimit () {
        $.ajax({
            url : '/api/get_upload_limit',
            type : 'POST',
            data : {
                _token : token
            },
            dataType : 'json',
            complete : function (xhr) {
                if ( xhr.status == 200 ) {
                    try {
                        var resp = JSON.parse(xhr.responseText);
                        if ( !resp.success ) {
                            onError(xhr,resp);
                            return;
                        }
                        uploadLimit = resp.data.post_max_size < resp.data.upload_max_filesize ? resp.data.post_max_size : resp.data.upload_max_filesize;
                    } catch(e) {
                        onError(xhr,e);
                    }
                } else {
                    onError(xhr);
                    
                }
            }
        });

        function onError (xhr,err) {
            var errorText = 'Unable to fetch upload limit information from server to due an error. Will apply common defaults instead.\r\n';
            errorText += '%cError : %d %s %O';
            console.warn(errorText,"color:red",xhr.status,xhr.statusText,(err?err:'{}'));
            uploadLimit = 2097152;
        }

    }



    /**
     * API
     */
    
    module.getFileObjects = getFileObjects;

    module.getFileObjectsMap = function () {
        return fileObjectsMap;
    };



    /**
     * Init
     * @return void
     */
    module.init = function () {
        if ( $container.length > 0 ) {
            getUploadLimit();
            bindEvents();
        }
    };

    return module;
})(App));
App.createModule( 'List', (function (app) {
    


    var module = {};



    /**
     * Private variables
     */    
    
    var 

    $container  = $('.js-list'),
    $rows       = $container.find('.list-row'),

    $modals         = $('.js-modal'),
    $confirmModal   = $modals.filter('[data-modal-type="confirm"]'),

    model       = $container.data('model'),
    currentId;




    /**
     * Private functions
     */
    
    function onCancel () {
        currentId = null;
    }
    
    function bindConfirmModal () {
        
        if ( ! $confirmModal.length ) return;

        var $confirm = $confirmModal.find('.js-confirm-btn'),
            $cancel  = $confirmModal.find('.js-cancel-btn');

        function onConfirm () {
            if ( !currentId ) return false;   
            var token = $('input[name="_token"]').val();        
            $.ajax({
                url : '/api/' + model + '/' + currentId,
                type : 'DELETE',
                data: {
                    _token : token,
                    id      : currentId
                },
                success : function (data) {                    
                    if ( data.success ) {
                        $rows.filter('[data-item-id='+currentId+']').remove();
                        currentId = null;
                        return;
                    }
                    currentId = null;
                    // Wasnt able to delete
                    console.log(data.data.message);
                },
                error : function (xhr) {
                    console.log(xhr);
                }
            });
        }

        $confirm.on('click',onConfirm);
        $cancel.on('click',onCancel);
    }

    function bindRows () {
        $rows.each(function () {
           
            var $row    = $(this),
                itemId  = $row.data('itemId'),
                $delete = $row.find('.js-item-delete');

            $delete.on('click',function () {
               currentId = itemId; 
            });

        });
    }
    



    /**
     * API
     */



    /**
     * Init
     * @return void
     */
    module.init = function () {
        bindConfirmModal();
        bindRows();
    };

    return module;
})(App));
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
App.createModule( 'ImageSelect', (function (app) {
    
    var module = {};



    
    /**
     * Private variables
     */
    
    var

    $container = $('.js-pdf-input'),
    $text        = $container.find('.input-text'),
    $input       = $container.find('input'),

    currentValue;



    /**
     * Private functions
     */
    
    function bindPdfInput () {

        if ( !$container.length ) return;

        $input
        .on('change',function () {

            var file = $input[0].files[0];

            console.log($text.text());

            $container.toggleClass('has-file', ( $text.text() ? true : false));

            if ( !file ) return;

            if ( !file.name.match( /[.]pdf$/i ) ) {

                $container.addClass('has-error');

            } else {

                currentValue = file.name;
                $text.text(currentValue);

                $container
                .removeClass('has-error');               

            }

        })
        .trigger('change');

    }




    /**
     * API
     */
    


    /**
     * Init
     * @return void
     */
    module.init = function () {
        bindPdfInput();
    };

    return module;
})(App));
App.createModule( 'ImageSelect', (function (app) {
    
    var module = {};



    
    /**
     * Private variables
     */
    
    var 

    $container = $('.js-conditional-input'),

    $select;


    /**
     * Private functions
     */
    
    function bindConditionalInput () {
        
        if ( !$container.length ) return;

        $select = $container.find('.js-conditional-select select');

        $select
        .on('change',onChange)
        .trigger('change');

    }

    function onChange () {
        
        var val = $select.val();

        var classToRemove = $container[0].className.match(/type-.+/i);

        if ( classToRemove && classToRemove.length ) {
            $container.removeClass(function () {
                return classToRemove[0];
            });
        }

        $container.addClass('type-'+val);

    }




    /**
     * API
     */
    
    module.getSelectables = function () {
        return selectables;
    };




    /**
     * Init
     * @return void
     */
    module.init = function () {
        bindConditionalInput();
    };

    return module;
})(App));