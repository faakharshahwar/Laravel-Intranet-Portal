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
<h1>{{ $audit_schedule->audit_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $audit_schedule->site }}</td>
    </tr>
    <tr>
        <th>Audit ID</th>
        <td>{{ $audit_schedule->audit_id }}</td>
    </tr>

    <tr>
        <th>Audit Type</th>
        <td>{{ $audit_schedule->audit_type }}</td>
    </tr>

    <tr>
        <th>Sub Type</th>
        <td>{{ $audit_schedule->sub_type }}</td>
    </tr>

    <tr>
        <th>Start Date</th>
        <td>{{ format_date($audit_schedule->start_date) }}</td>
    </tr>

    <tr>
        <th>Acutal Audit Date</th>
        <td>{{ format_date($audit_schedule->dates) }}</td>
    </tr>

    <tr>
        <th>Audit Schedule</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/audit_schedule')}}/{{$audit_schedule->audit_schedule}}">{{$audit_schedule->audit_schedule}}</a>
        </td>
    </tr>

    <tr>
        <th>Audit Checklist (If Any)</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/audit_schedule')}}/{{$audit_schedule->audit_checklist}}">{{$audit_schedule->audit_checklist}}</a>
        </td>
    </tr>

    <tr>
        <th>Audit Year</th>
        <td>{{ $audit_schedule->audit_year }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ $audit_schedule->status }}</td>
    </tr>

    <tr>
        <th>Audit Completion Date</th>
        <td>{{ format_date($audit_schedule->audit_completion_date) }}</td>
    </tr>

    <tr>
        <th>Audit Report</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/audit_schedule')}}/{{$audit_schedule->audit_report}}">{{$audit_schedule->audit_report}}</a>
        </td>
    </tr>

    <tr>
        <th>Number of Issues</th>
        <td>{{ $audit_schedule->num_of_issues }}</td>
    </tr>

    <tr>
        <th>ABS CPAR Acceptance (If Any)</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/audit_schedule')}}/{{$audit_schedule->abs_cpar_acceptance}}">{{$audit_schedule->abs_cpar_acceptance}}</a>
        </td>
    </tr>

    <tr>
        <th>Nonconformity Note Attachment (If Any)</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/audit_schedule')}}/{{$audit_schedule->nonconformity_note_attachment}}">{{$audit_schedule->nonconformity_note_attachment}}</a>
        </td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $audit_schedule->comments }}</td>
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
