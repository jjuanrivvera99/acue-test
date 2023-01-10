"use strict";

// Class definition
const KTDatatablesServerSide = function () {
    // Shared variables
    var table;
    var dt;

    // Private functions
    const initDatatable = function () {
        dt = $("#datatable").DataTable({
            searchDelay: 500,
            // processing: true,
            serverSide: true,
            order: [
                // [10, 'desc']
            ],
            stateSave: true,
            ajax: {
                url: "/api/courses",
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'course_code' },
                { data: 'workflow_state' },
            ],
            "columnDefs": [
                {
                    // The `data` parameter refers to the data for the cell (defined by the
                    // `data` option, which defaults to the column being worked with, in
                    // this case `data: 0`.
                    "render": function ( data, type, row ) {
                        const color = {
                            available: 'success',
                            unpublished: 'warning',
                        }

                        return '<span class="badge badge-' + color[data] + '">' + data + '</span>';
                    },
                    "targets": 3
                }
            ]
        });

        table = dt.$;

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        dt.on('draw', function () {
            KTMenu.createInstances();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            dt.search(e.target.value).draw();
        });
    }

    // Public methods
    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTDatatablesServerSide.init();
});
