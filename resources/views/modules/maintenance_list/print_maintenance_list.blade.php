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
<h1>{{ $maintenance_list->equipment_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>Equipment ID</th>
        <td>{{ $maintenance_list->equipment_id }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $maintenance_list->site }}</td>
    </tr>

    <tr>
        <th>Serial # (If Any)</th>
        <td>{{ $maintenance_list->serial_num }}</td>
    </tr>

    <tr>
        <th>Equipment Description</th>
        <td>{{ $maintenance_list->equipment_description }}</td>
    </tr>

    <tr>
        <th>Manufacturer</th>
        <td>{{ $maintenance_list->manufacturer }}</td>
    </tr>

    <tr>
        <th>Model (If Applicable)</th>
        <td>{{ $maintenance_list->model}}</td>
    </tr>

    <tr>
        <th>Location</th>
        <td>{{ $maintenance_list->location }}</td>
    </tr>

    <tr>
        <th>PM Method / Frequency</th>
        <td>{{ $maintenance_list->frequency }}</td>
    </tr>

    <tr>
        <th>Last Prev. Maintenance Performed</th>
        <td>{{ $maintenance_list->last_maintenance_performed }}</td>
    </tr>

    <tr>
        <th>Next Preventive Maintenance Due</th>
        <td>{{ $maintenance_list->next_maintenance_performed }}</td>
    </tr>

    <tr>
        <th>Maintenance By</th>
        <td>{{ $maintenance_list->maintenance_by }}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $maintenance_list->comments }}</td>
    </tr>

    <tr>
        <th>Equipment Status</th>
        <td>{{ $maintenance_list->equipment_status }}</td>
    </tr>

    <tr>
        <th>Action Required</th>
        <td>{{ $maintenance_list->action_required }}</td>
    </tr>

    <tr>
        <th>Action Required</th>
        <td><a href="{{asset('uploads/maintenance_list')}}/{{$maintenance_list->attachment}}"
               target="_blank">{{$maintenance_list->attachment}}</a></td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        // Function to handle printing
        window.print();
    });
</script>
