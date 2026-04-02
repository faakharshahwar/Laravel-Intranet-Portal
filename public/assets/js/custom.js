$(document).ready(function () {
    datatable = $("#kt_module_table").DataTable({
        "order": [[0, "desc"]],  // Keep sorting by the first column (ID)
        "columnDefs": [
            {
                "targets": 0, // Target the ID column (first column)
                "pageLength": 150,
                "visible": false, // Hide the ID column
                "searchable": false // Disable searching on the ID column
            }
        ]
    });

    const filterSearch = document.querySelector('[data-kt-module-table-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        datatable.search(e.target.value).draw();
    });
});

jQuery(document).ready(function ($) {
    // Handle reset option dynamically
    $('.reset-option-link').click(function () {
        var selectName = $(this).data('select-name'); // Get the associated select name
        $('select[name="' + selectName + '"]').val(null).trigger('change'); // Reset the select
    });
});
