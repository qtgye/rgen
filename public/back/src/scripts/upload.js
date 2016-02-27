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