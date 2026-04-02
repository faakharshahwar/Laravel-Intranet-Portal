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
<h1>Training History</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>TRR #</th>
        <td>{{ $mailData['trr_id']}}</td>
    </tr>

    <tr>
        <th>Person to Notify</th>
        <td>{{ $mailData['ptn_first_name'] . " " . $mailData['ptn_last_name']}}</td>
    </tr>

    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>

    <tr>
        <th>Current Job Title</th>
        <td>{{ $mailData['current_job_title'] }}</td>
    </tr>

    <tr>
        <th>Results Area 1</th>
        <td>{{ $mailData['results_area_1'] }}</td>
    </tr>

    <tr>
        <th>Results Area 2</th>
        <td>{{ $mailData['results_area_2'] }}</td>
    </tr>

    <tr>
        <th>Results Area 3</th>
        <td>{{ $mailData['results_area_3']}}</td>
    </tr>

    <tr>
        <th>Results Area 4</th>
        <td>{{ $mailData['results_area_4']}}</td>
    </tr>

    <tr>
        <th>Results Area 5</th>
        <td>{{ $mailData['results_area_5'] }}</td>
    </tr>

    <tr>
        <th>Results Area 6</th>
        <td>{{ $mailData['results_area_6'] }}</td>
    </tr>

    <tr>
        <th>Results Area 7</th>
        <td>{{ $mailData['results_area_7'] }}</td>
    </tr>

    <tr>
        <th>Results Area 8</th>
        <td>{{ $mailData['results_area_8'] }}</td>
    </tr>

    <tr>
        <th>Results Area 9</th>
        <td>{{ $mailData['results_area_9'] }}</td>
    </tr>

    <tr>
        <th>Results Area 10</th>
        <td>{{ $mailData['results_area_10'] }}</td>
    </tr>

    <tr>
        <th>Results Area 11</th>
        <td>{{ $mailData['results_area_11'] }}</td>
    </tr>

    <tr>
        <th>Results Area 12</th>
        <td>{{ $mailData['results_area_12'] }}</td>
    </tr>

    <tr>
        <th>Assessment Date</th>
        <td>{{ format_date($mailData['assessment_date']) }}</td>
    </tr>

    <tr>
        <th>Must Be Completed By</th>
        <td>{{ format_date($mailData['must_be_completed_by']) }}</td>
    </tr>

    <tr>
        <th>Learning Session Title</th>
        <td>{{ $mailData['learning_session_title'] }}</td>
    </tr>

    <tr>
        <th>Training Type</th>
        <td>{{ $mailData['training_type'] }}</td>
    </tr>

    <tr>
        <th>Instructor</th>
        <td>{{ $mailData['instructor'] }}</td>
    </tr>

    <tr>
        <th>Learning Time (Hours)</th>
        <td>{{ $mailData['learning_time'] }}</td>
    </tr>

    <tr>
        <th>Learning Session Completion Date</th>
        <td>{{ format_date($mailData['learning_session_completion_date']) }}</td>
    </tr>

    <tr>
        <th>Link to Learning Module</th>
        <td>{{ $mailData['link_to_learning_module'] }}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $mailData['comments'] }}</td>
    </tr>

    <tr>
        <th>Attachment 1 (If Any)</th>
        <td><a href="{{$mailData['base_url']}}/uploads/training_history/{{ $mailData['attachment_1']}}">{{ $mailData['attachment_1'] }}</a></td>
    </tr>

    <tr>
        <th>Attachment 2 (If Any)</th>
        <td><a href="{{$mailData['base_url']}}/uploads/training_history/{{ $mailData['attachment_2']}}">{{ $mailData['attachment_2'] }}</a></td>
    </tr>

    <tr>
        <th>Attachment 3 (If Any)</th>
        <td><a href="{{$mailData['base_url']}}/uploads/training_history/{{ $mailData['attachment_3']}}">{{ $mailData['attachment_3'] }}</a></td>
    </tr>

    <tr>
        <th>Employee Status</th>
        <td>{{ $mailData['employee_status'] == 1 ? 'Active' : 'Inactive' }}</td>
    </tr>

    </tbody>
</table>

</body>
</html>
