<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailable HTML Table Template</title>
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
<h1>Record Summary</h1>
<table>
    <tbody>
    <tr>
        <th>Record Title</th>
        <td>{{ $mailData['record_title'] }}</td>
    </tr>
    <tr>
        <th>DOC ID (If Applicable)</th>
        <td>{{ $mailData['doc_id'] }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>
    <tr>
        <th>Location</th>
        <td>{{ $mailData['location'] }}</td>
    </tr>
    <tr>
        <th>Type</th>
        <td>{{ $mailData['type'] }}</td>
    </tr>
    <tr>
        <th>File or Manual Title</th>
        <td>{{ $mailData['file_manual_title'] }}</td>
    </tr>
    <tr>
        <th>Maintained By</th>
        <td>{{ $mailData['maintained_by'] }}</td>
    </tr>
    <tr>
        <th>Minimum Retention</th>
        <td>{{ $mailData['minimum_retention'] }}</td>
    </tr>
    <tr>
        <th>Record Status</th>
        <td>{{ $mailData['record_status'] }}</td>
    </tr>
    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $mailData['comments'] }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
