var UINestable = function () {

    var updateOutput = function (e) {
        var list = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };


    return {
        //main function to initiate the module
        init: function (n) {

        //instanzia le tabelle in base al n° passato
            for(i=0;i<n;i++){

                $('#nestable_list_'+i).nestable({
                        maxDepth: 1
                    })
                    .on('change', updateOutput);

                updateOutput($('#nestable_list_'+i).data('output', $('#nestable_list_'+i+'_output')));


            }





            $('#nestable_list_menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });



        }

    };

}();