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
<h1>{{ $mailData['cpar_id']}}</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>CPAR #</th>
        <td>{{ $mailData['cpar_id'] }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>

    <tr>
        <th>Date of Issue</th>
        <td>{{ format_date($mailData['date_of_issue']) }}</td>
    </tr>

    <tr>
        <th>CPAR Type</th>
        <td>{{ $mailData['cpar_type'] }}</td>
    </tr>

    <tr>
        <th>Reason</th>
        <td>{{ $mailData['reason'] }}</td>
    </tr>

    <tr>
        <th>Reason (If Other)</th>
        <td>{{ $mailData['reason_if_other'] }}</td>
    </tr>

    <tr>
        <th>Description of Issue</th>
        <td>{{ $mailData['description_of_issue']}}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $mailData['originator']}}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ format_date($mailData['date_originated']) }}</td>
    </tr>

    <tr>
        <th>Results Area/Dept.</th>
        <td>{{ $mailData['results_area'] }}</td>
    </tr>

    <tr>
        <th>Responsible Manager</th>
        <td>{{ $mailData['responsible_manager'] }}</td>
    </tr>

    <tr>
        <th>Resp. Manager Acceptance Date</th>
        <td>{{ format_date($mailData['manager_acceptance_date']) }}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $mailData['root_cause'] }}</td>
    </tr>

    <tr>
        <th>Attachment 1 (If Any)</th>
        <td><a href="{{$mailData['base_url']}}/uploads/CPARs/{{ $mailData['attachment_1']}}">{{ $mailData['attachment_1'] }}</a></td>
    </tr>

    <tr>
        <th>Attachment 2 (If Any)</th>
        <td><a href="{{$mailData['base_url']}}/uploads/CPARs/{{ $mailData['attachment_2']}}">{{ $mailData['attachment_2'] }}</a></td>
    </tr>

    <tr>
        <th>Action To Be Taken</th>
        <td>{{ $mailData['action_to_be_taken'] }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $mailData['assigned_to'] }}</td>
    </tr>

    <tr>
        <th>Target Completion Date</th>
        <td>{{ format_date($mailData['target_completion_date']) }}</td>
    </tr>

    <tr>
        <th>Date Action Was Completed</th>
        <td>{{ format_date($mailData['date_action_was_completed']) }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $mailData['effectiveness_evaluated'] }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $mailData['action_taken_effective'] }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $mailData['what_action_was_taken'] }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $mailData['action_taken_by'] }}</td>
    </tr>

    <tr>
        <th>Documents Revised/Reissued</th>
        <td>{{ $mailData['documents_revised'] }}</td>
    </tr>

    <tr>
        <th>Date Documents Revised/Reissued</th>
        <td>{{ format_date($mailData['date_documents_revised']) }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $mailData['closed_by'] }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($mailData['closure_date']) }}</td>
    </tr>

    </tbody>
</table>

</body>
</html>
