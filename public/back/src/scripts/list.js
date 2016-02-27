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