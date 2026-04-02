<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printable HTML Table Template</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            font-size: 14px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            color: #000000;
            width: 200px;
        }

        td {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
<h1>{{ $cds->device_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>Calibration Device Front Image</th>
        <td>
            <img width="100px" height="100px"
                src="{{asset('uploads/calibrated_devices')}}/{{$cds->calibration_device_front_image}}"
                alt="image">
        </td>
    </tr>
    <tr>
        <th>Calibration Device Back Image</th>
        <td>
            <img width="100px" height="100px"
                src="{{asset('uploads/calibrated_devices')}}/{{$cds->calibration_device_back_image}}"
                alt="image">
        </td>
    </tr>
    <tr>
        <th>Device ID</th>
        <td>{{ $cds->device_id }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $cds->site }}</td>
    </tr>

    <tr>
        <th>Calibration Category</th>
        <td>{{ $cds->calibration_category }}</td>
    </tr>

    <tr>
        <th>Calibration Supplier</th>
        <td>{{ $cds->calibration_supplier }}</td>
    </tr>

    <tr>
        <th>Serial #</th>
        <td>{{ $cds->serial_no }}</td>
    </tr>

    <tr>
        <th>Device Description</th>
        <td>{{ $cds->device_description}}</td>
    </tr>

    <tr>
        <th>Model</th>
        <td>{{ $cds->model }}</td>
    </tr>

    <tr>
        <th>Location</th>
        <td>{{ $cds->location }}</td>
    </tr>

    <tr>
        <th>Calibration Type</th>
        <td>{{ $cds->calibration_type }}</td>
    </tr>

    <tr>
        <th>Calibration Frequency</th>
        <td>{{ $cds->calibration_frequency }}</td>
    </tr>

    <tr>
        <th>Accuracy Required</th>
        <td>{{ $cds->accuracy_required }}</td>
    </tr>

    <tr>
        <th>Standards Used</th>
        <td>{{ $cds->standards_used }}</td>
    </tr>

    <tr>
        <th>Method of Calibration</th>
        <td>{{ $cds->method_of_calibration }}</td>
    </tr>

    <tr>
        <th>Readings - Nominal Values</th>
        <td>{{ $cds->readings_nominal_values }}</td>
    </tr>

    <tr>
        <th>Readings - Actual Values 1</th>
        <td>{{ $cds->readings_actual_values_1 }}</td>
    </tr>

    <tr>
        <th>Readings - Actual Values 2</th>
        <td>{{ $cds->readings_actual_values_2 }}</td>
    </tr>

    <tr>
        <th>Readings - Actual Values 3</th>
        <td>{{ $cds->readings_actual_values_3 }}</td>
    </tr>

    <tr>
        <th>Readings - Corrected Values</th>
        <td>{{ $cds->readings_corrected_values }}</td>
    </tr>

    <tr>
        <th>Date Last Calibrated</th>
        <td>{{ format_date($cds->date_last_calibrated) }}</td>
    </tr>

    <tr>
        <th>Next Calibration Due Date</th>
        <td>{{ format_date($cds->next_calibration_due_date) }}</td>
    </tr>

    <tr>
        <th>Temperature</th>
        <td>{{ $cds->temperature }}</td>
    </tr>

    <tr>
        <th>C/F</th>
        <td>{{ $cds->temp_unit }}</td>
    </tr>

    <tr>
        <th>Humidity</th>
        <td>{{ $cds->humidity }}</td>
    </tr>

    <tr>
        <th>Calibrated By</th>
        <td>{{ $cds->calibrated_by }}</td>
    </tr>

    <tr>
        <th>Approved By</th>
        <td>{{ $cds->approved_by }}</td>
    </tr>

    <tr>
        <th>Device Status</th>
        <td>{{ $cds->device_status }}</td>
    </tr>

    <tr>
        <th>Calibration Status</th>
        <td>{{ $cds->calibration_status }}</td>
    </tr>

    <tr>
        <th>Third Party Calibration Results - 'AS FOUND" Conditions</th>
        <td>{{ $cds->tp_calibrated_results_as_found }}</td>
    </tr>

    <tr>
        <th>Third Party Calibration Results - 'AS LEFT" Conditions</th>
        <td>{{ $cds->tp_calibrated_results_as_left }}</td>
    </tr>

    <tr>
        <th>Attachment</th>
        <td>
            {{ $cds->attachment }}
        </td>
    </tr>

    <tr>
        <th>NCR # (If Out of Calibration)</th>
        <td>{{ $cds->ncr }}</td>
    </tr>

    <tr>
        <th>Comments, If Any</th>
        <td>{{ $cds->comments }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        // Function to handle printing
        window.print();
    });
</script>
