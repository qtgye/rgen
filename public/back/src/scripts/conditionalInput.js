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