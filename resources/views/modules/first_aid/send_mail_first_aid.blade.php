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
<h1>First Aid</h1>
<p>{{ $mailData['personal_message'] }}</p>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>
    <tr>
        <th>Item Name</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $mailData['description'] }}</td>
    </tr>
    <tr>
        <th>Production Date</th>
        <td>{{ format_date($mailData['production_date']) }}</td>
    </tr>
    <tr>
        <th>Expiry Date</th>
        <td>{{ format_date($mailData['expiry_date']) }}</td>
    </tr>
    <tr>
        <th>Required Quantity</th>
        <td>{{ $mailData['required_quantity'] }}</td>
    </tr>
    <tr>
        <th>Available Quantity</th>
        <td>{{ $mailData['available_quantity'] }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
