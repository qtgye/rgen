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