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