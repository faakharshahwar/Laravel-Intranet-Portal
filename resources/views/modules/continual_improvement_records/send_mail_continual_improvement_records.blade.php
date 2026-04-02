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
<h1>{{ $mailData['cir_id'] }}</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>CIR #</th>
        <td>{{ $mailData['cir_id'] }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>

    <tr>
        <th>CIR Concise Description</th>
        <td>{{ $mailData['cir_concise_description'] }}</td>
    </tr>

    <tr>
        <th>Improvement Opportunity</th>
        <td>{{ $mailData['improvement_opportunity'] }}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $mailData['originator'] }}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ $mailData['date_originated'] }}</td>
    </tr>

    <tr>
        <th>CIR Type</th>
        <td>{{ $mailData['cir_type'] }}</td>
    </tr>

    <tr>
        <th>Department</th>
        <td>{{ $mailData['department'] }}</td>
    </tr>

    <tr>
        <th>Responsible Manager</th>
        <td>{{ $mailData['responsible_manager'] }}</td>
    </tr>

    <tr>
        <th>Responsible Mgr Approval Date</th>
        <td>{{ $mailData['responsible_mgr_approval_date'] }}</td>
    </tr>

    <tr>
        <th>Action To Be Taken</th>
        <td>{{ $mailData['action_to_be_taken'] }}</td>
    </tr>

    <tr>
        <th>File Attachment 1 (If Any)</th>
        <td>{{ $mailData['file_attachment_1'] }}</td>
    </tr>

    <tr>
        <th>File Attachment 2 (If Any)</th>
        <td>{{ $mailData['file_attachment_2'] }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $mailData['assigned_to'] }}</td>
    </tr>

    <tr>
        <th>Target Completion Date</th>
        <td>{{ $mailData['target_completion_date'] }}</td>
    </tr>

    <tr>
        <th>Action That Was Taken</th>
        <td>{{ $mailData['action_that_was_taken'] }}</td>
    </tr>

    <tr>
        <th>Action Completed By</th>
        <td>{{ $mailData['action_completed_by'] }}</td>
    </tr>

    <tr>
        <th>Date Action Was Completed</th>
        <td>{{ $mailData['date_action_was_completed'] }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $mailData['closed_by'] }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ $mailData['closure_date'] }}</td>
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
