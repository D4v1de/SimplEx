var TableManaged = function () {

    var initTable = function (idTabella,wrapperTabella) {

        var table = $('#'+idTabella);

        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-12 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            //aggiunti da federico
            "scrollCollapse": true,
            "paging":         false,
            "scrollY":        '40vh',
            //"dom": 'Bfrtip',
            //questa è buona "dom": "<'row'<'col-md-5 col-sm-12'l><'col-md-5 col-sm-12'Bf>r>tip",

            "dom": "Blfrt<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            // set the initial value
            "pageLength": 5,
            "language": {
                "lengthMenu": " _MENU_ elementi",
                "emptyTable": "Non ci sono dati disponibili",
                "infoEmpty": "",
                "infoFiltered": "(di _MAX_ elementi totali)",
                "info": "Mostra da _START_ a _END_ di _TOTAL_ risultati",
                "search": "Cerca:",
                "paging": {
                    "previous": "Precedente",
                    "next": "Prossimo"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#'+wrapperTabella);

        tableWrapper.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }

    return {

        //main function to initiate the module
        init: function (idTabella,wrapperTabella) {
            if (!jQuery().dataTable) {
                return;
            }
            initTable(idTabella,wrapperTabella);
            //initTable1();
            //initTable2();
            //initTable3();
        }

    };

}();

var TableManaged2 = function () {

    var initTable = function (idTabella,wrapperTabella) {

        var table = $('#'+idTabella);

        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(di _MAX_ elementi totali)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            //aggiunti da federico
            "dom": "Blfrt<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            //"dom": "<'row'<'col-md-3 col-sm-12'l><'col-md-6 col-sm-12'Bf>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
            // set the initial value
            "pageLength": 5,
            "language": {
                "lengthMenu": " _MENU_ elementi",
                "emptyTable": "Non ci sono dati disponibili",
                "zeroRecords": "Non ci sono dati disponibili",
                "infoEmpty": "",
                "info": "Mostra da _START_ a _END_ di _TOTAL_ risultati",
                "infoFiltered": "(di _MAX_ elementi totali)",
                "search": "Cerca:",
                "paging": {
                    "previous": "Precedente",
                    "next": "Prossimo"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#'+wrapperTabella);

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });

        tableWrapper.find('.dataTables_length select').select2(); // initialize select2 dropdown
    }

    return {

        //main function to initiate the module
        init: function (idTabella,wrapperTabella) {
            if (!jQuery().dataTable) {
                return;
            }
            initTable(idTabella,wrapperTabella);
            //initTable1();
            //initTable2();
            //initTable3();
        }

    };

}();