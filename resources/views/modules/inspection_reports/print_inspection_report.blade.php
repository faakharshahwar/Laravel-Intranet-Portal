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
<h1>Inspection Report</h1>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $inspection_report->site }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $inspection_report->description }}</td>
    </tr>
    <tr>
        <th>Report Type</th>
        <td>{{ $inspection_report->report_type }}</td>
    </tr>

    <tr>
        <th>Completion Date</th>
        <td>{{ format_date($inspection_report->completion_date) }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ $inspection_report->status }}</td>
    </tr>

    <tr>
        <th>Next Due Date</th>
        <td>{{ format_date($inspection_report->next_due_date) }}</td>
    </tr>
    <tr>
        <th>Attachment 1</th>
        <td><a target="_blank"
               href="/uploads/inspection_reports/{{$inspection_report->attachment_1}}">{{$inspection_report->attachment_1}}</a>
        </td>
    </tr>
    <tr>
        <th>Attachment 2</th>
        <td><a target="_blank"
               href="/uploads/inspection_reports/{{$inspection_report->attachment_2}}">{{$inspection_report->attachment_2}}</a>
        </td>
    </tr>
    <tr>
        <th>Attachment 3</th>
        <td><a target="_blank"
               href="/uploads/inspection_reports/{{$inspection_report->attachment_3}}">{{$inspection_report->attachment_3}}</a>
        </td>
    </tr>
    <tr>
        <th>Remarks</th>
        <td>{{ $inspection_report->remarks}}</td>
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
