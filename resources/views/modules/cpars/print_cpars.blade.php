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
<h1>{{ $cpar->cpar_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>CPAR #</th>
        <td>{{ $cpar->cpar_id }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $cpar->site }}</td>
    </tr>

    <tr>
        <th>Date of Issue</th>
        <td>{{ format_date($cpar->date_of_issue) }}</td>
    </tr>

    <tr>
        <th>CPAR Type</th>
        <td>{{ $cpar->cpar_type }}</td>
    </tr>

    <tr>
        <th>Reason</th>
        <td>{{ $cpar->reason }}</td>
    </tr>

    <tr>
        <th>Reason (If Other)</th>
        <td>{{ $cpar->reason_if_other}}</td>
    </tr>

    <tr>
        <th>Description of Issue</th>
        <td>{{ $cpar->description_of_issue }}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $cpar->order_num }}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ format_date($cpar->date_originated) }}</td>
    </tr>

    <tr>
        <th>Results Area/Dept.</th>
        <td>{{ $cpar->results_area }}</td>
    </tr>

    <tr>
        <th>Responsible Manager</th>
        <td>{{ $cpar->responsible_manager }}</td>
    </tr>

    <tr>
        <th>Resp. Manager Acceptance Date</th>
        <td>{{ format_date($cpar->manager_acceptance_date) }}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $cpar->root_cause }}</td>
    </tr>

    <tr>
        <th>Attachment 1</th>
        <td>{{ $cpar->attachment_1 }}</td>
    </tr>

    <tr>
        <th>Attachment 2</th>
        <td>{{ $cpar->attachment_2 }}</td>
    </tr>

    <tr>
        <th>Action To Be Taken</th>
        <td>{{ $cpar->action_to_be_taken }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $cpar->assigned_to }}</td>
    </tr>

    <tr>
        <th>Target Completion Date</th>
        <td>{{ format_date($cpar->target_completion_date) }}</td>
    </tr>

    <tr>
        <th>Date Action Was Completed</th>
        <td>{{ format_date($cpar->date_action_was_completed) }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $cpar->effectiveness_evaluated }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $cpar->action_taken_effective }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $cpar->what_action_was_taken }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $cpar->action_taken_by }}</td>
    </tr>

    <tr>
        <th>Documents Revised/Reissued</th>
        <td>{{ $cpar->documents_revised }}</td>
    </tr>

    <tr>
        <th>Date Documents Revised/Reissued</th>
        <td>{{ format_date($cpar->date_documents_revised) }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $cpar->closed_by }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($cpar->closure_date) }}</td>
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
