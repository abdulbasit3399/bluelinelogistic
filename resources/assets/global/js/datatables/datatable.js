

// active buttons export table

$('body').on('click', '.buttons-export-table .dropdown-menu .btn-export', function() {
    var typeExport = $(this).data('export'),
        table_id = $(this).data('table-id'),
        wrapperTable = $(`#${table_id}_wrapper`);
    wrapperTable.find(`.buttons-${typeExport}`).click()
})