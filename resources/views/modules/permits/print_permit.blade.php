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
<h1>Permit</h1>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $permit->site }}</td>
    </tr>
    <tr>
        <th>Permit Type</th>
        <td>{{ $permit->permit_type }}</td>
    </tr>
    <tr>
        <th>Permit ID</th>
        <td>{{ $permit->permit_id }}</td>
    </tr>
    <tr>
        <th>Agency Type</th>
        <td>{{ $permit->agency_type}}</td>
    </tr>
    <tr>
        <th>Agency Name</th>
        <td>{{ $permit->agency_name }}</td>
    </tr>
    <tr>
        <th>Expiration Date</th>
        <td>{{ format_date($permit->expiration_date) }}</td>
    </tr>
    <tr>
        <th>Attachment</th>
        <td><a target="_blank"
               href="/uploads/permits/{{$permit->attachment}}">{{ $permit->attachment }}</a></td>
    </tr>
    <tr>
        <th>Copy of Permit</th>
        <td><a target="_blank"
               href="/uploads/permits/{{$permit->copy_of_permit}}">{{ $permit->copy_of_permit }}</a></td>
    </tr>
    <tr>
        <th>Monthly Requirements</th>
        <td>{{ $permit->monthly_requirements }}</td>
    </tr>
    <tr>
        <th>Quarterly Requirements</th>
        <td>{{ $permit->quarterly_requirements }}</td>
    </tr>
    <tr>
        <th>Annual Requirements</th>
        <td>{{ $permit->annual_requirements }}</td>
    </tr>
    <tr>
        <th>Comments</th>
        <td>{{ $permit->comments }}</td>
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
