<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email HTML Table Template</title>
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
<h1>{{ $mailData['equipment_id']}}</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>Equipment ID</th>
        <td>{{ $mailData['equipment_id']}}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site']}}</td>
    </tr>

    <tr>
        <th>Serial # (If Any)</th>
        <td>{{ $mailData['serial_num']}}</td>
    </tr>

    <tr>
        <th>Equipment Description</th>
        <td>{{ $mailData['equipment_description']}}</td>
    </tr>

    <tr>
        <th>Manufacturer</th>
        <td>{{ $mailData['manufacturer']}}</td>
    </tr>

    <tr>
        <th>Model (If Applicable)</th>
        <td>{{ $mailData['model']}}</td>
    </tr>

    <tr>
        <th>Location</th>
        <td>{{ $mailData['location']}}</td>
    </tr>

    <tr>
        <th>PM Method / Frequency</th>
        <td>{{ $mailData['frequency']}}</td>
    </tr>

    <tr>
        <th>Last Prev. Maintenance Performed</th>
        <td>{{ format_date($mailData['last_maintenance_performed'])}}</td>
    </tr>

    <tr>
        <th>Next Preventive Maintenance Due</th>
        <td>{{ format_date($mailData['next_maintenance_performed'])}}</td>
    </tr>

    <tr>
        <th>Maintenance By</th>
        <td>{{ $mailData['maintenance_by']}}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $mailData['comments']}}</td>
    </tr>

    <tr>
        <th>Equipment Status</th>
        <td>{{ $mailData['equipment_status']}}</td>
    </tr>

    <tr>
        <th>Action Required</th>
        <td>{{ $mailData['action_required']}}</td>
    </tr>

    <tr>
        <th>Attachment (If Any)</th>
        <td>
            <a target="_blank"
               href="{{$mailData['base_url']}}/{{ $mailData['attachment']}}">{{ $mailData['attachment']}}</a>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
