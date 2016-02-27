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

    if ( file.name.match(/[.](jpg|jpeg|png|gif|bmp)$/i) ) {
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