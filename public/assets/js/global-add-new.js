jQuery(document).ready(function ($) {
    function initializeSelect2() {
        $('.add-new-select, [data-control="select2"]').each(function () {
            if (!$(this).hasClass('select2-hidden-accessible')) {
                $(this).select2(); // Ensure Select2 is applied
            }
        });
    }

    initializeSelect2(); // Run on page load

    $(document).on('change', '.add-new-select', function () {
        if ($(this).val() === 'add_new') {
            let selectId = $(this).attr('id');
            let placeholderText = $(this).attr('data-placeholder') || 'Enter new value';
            let apiUrl = $(this).attr('data-api-url');

            if (!apiUrl) {
                console.error('API URL is missing for', selectId);
                return;
            }

            let modalHtml = `
                <div class="modal fade" id="${selectId}-modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="${selectId}-input" class="form-control" placeholder="${placeholderText}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary save-new-btn" data-select-id="${selectId}" data-api-url="${apiUrl}">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            $('body').append(modalHtml);
            $('#' + selectId + '-modal').modal('show');
        }
    });

    $(document).on('click', '.save-new-btn', function () {
        let selectId = $(this).attr('data-select-id');
        let apiUrl = $(this).attr('data-api-url');
        let newValue = $('#' + selectId + '-input').val().trim();

        if (newValue) {
            $.ajax({
                url: apiUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    value: newValue
                },
                success: function (response) {
                    if (response.success) {
                        alert('Added successfully!');

                        let selectElement = $('#' + selectId);

                        let newOption = `<option value="${newValue}">${newValue}</option>`;
                        selectElement.append(newOption);

                        selectElement.val(newValue).trigger('change');
                        
                        $('#' + selectId + '-modal').modal('hide').remove();
                    } else {
                        alert(response.message || 'Failed to add.');
                    }
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
        } else {
            alert('Please enter a valid name.');
        }
    });
});
