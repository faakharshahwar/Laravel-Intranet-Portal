jQuery(document).ready(function ($) {
    function updateURL() {
        var selectedDocumentType = $('#document_type').val();
        var selectedSite = $('#site').val();
        var selectedLocation = $('#location').val();
        var selectedCalibrationCategory = $('#calibration_category').val();
        var selectedDeviceStatus = $('#device_status').val();
        var selectedNCRStatus = $('#ncr_status').val();

        var currentUrl = window.location.href;
        var baseUrl = currentUrl.split('?')[0];
        var newUrl = baseUrl + '?';

        if (selectedDocumentType) {
            newUrl += 'document_type=' + encodeURIComponent(selectedDocumentType);
        }

        if (selectedSite) {
            if (newUrl.slice(-1) !== '?') {
                newUrl += '&';
            }
            newUrl += 'site=' + encodeURIComponent(selectedSite);
        }

        if (selectedLocation) {
            if (newUrl.slice(-1) !== '?') {
                newUrl += '&';
            }
            newUrl += 'location=' + encodeURIComponent(selectedLocation);
        }

        if (selectedCalibrationCategory) {
            if (newUrl.slice(-1) !== '?') {
                newUrl += '&';
            }
            newUrl += 'calibration_category=' + encodeURIComponent(selectedCalibrationCategory);
        }

        if (selectedDeviceStatus) {
            if (newUrl.slice(-1) !== '?') {
                newUrl += '&';
            }
            newUrl += 'device_status=' + encodeURIComponent(selectedDeviceStatus);
        }

        if (selectedNCRStatus) {
            if (newUrl.slice(-1) !== '?') {
                newUrl += '&';
            }
            newUrl += 'ncr_status=' + encodeURIComponent(selectedNCRStatus);
        }

        window.location.href = newUrl;
    }

    // Bind change events for all filters
    $('#document_type').change(function () {
        updateURL();
    });

    $('#site').change(function () {
        updateURL();
    });

    $('#location').change(function () {
        updateURL();
    });

    $('#calibration_category').change(function () {
        updateURL();
    });

    $('#device_status').change(function () {
        updateURL();
    });

    $('#ncr_status').change(function () {
        updateURL();
    });
});
