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
<h1>HSE Key Data</h1>
<table>
    <tbody>
    <tr>
        <th>For Month Starting</th>
        <td>{{ format_date($hse->for_month_starting) }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $hse->site }}</td>
    </tr>
    <tr>
        <th># of First Aids</th>
        <td>{{ $hse->num_of_first_aids }}</td>
    </tr>
    <tr>
        <th># of Near Misses</th>
        <td>{{ $hse->num_of_near_misses }}</td>
    </tr>
    <tr>
        <th># of Safety Violations</th>
        <td>{{ $hse->num_of_safety_violations }}</td>
    </tr>
    <tr>
        <th># of Medical Cases</th>
        <td>{{ format_date($hse->num_of_medical_cases) }}</td>
    </tr>
    <tr>
        <th># of Restricted Cases</th>
        <td>{{ format_date($hse->num_of_restricted_cases) }}</td>
    </tr>
    <tr>
        <th># of Lost Time Cases</th>
        <td>{{ $hse->num_of_lost_time_cases }}</td>
    </tr>
    <tr>
        <th># of Recordable Cases</th>
        <td>{{ $hse->num_of_recordable_cases }}</td>
    </tr>
    <tr>
        <th># of Environmental Issues</th>
        <td>{{ $hse->num_of_environmental_issues }}</td>
    </tr>
    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $hse->comments}}</td>
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
