<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail HTML Table Template</title>
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
<h1>{{ $mailData['doc_id']}}</h1>
<p>{{ $mailData['personal_message'] }}</p>
<hr>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>
    <tr>
        <th>Management Systems</th>
        <td>{{ $mailData['management_system'] }}</td>
    </tr>
    <tr>
        <th>Location</th>
        <td>{{ $mailData['location'] }}</td>
    </tr>
    <tr>
        <th>Sub Location</th>
        <td>{{ $mailData['sub_location'] }}</td>
    </tr>
    <tr>
        <th>Document Type</th>
        <td>{{ $mailData['document_type'] }}</td>
    </tr>
    <tr>
        <th>Title</th>
        <td>{{ $mailData['title'] }}</td>
    </tr>
    <tr>
        <th>DOC ID</th>
        <td>{{ $mailData['doc_id']}}</td>
    </tr>
    <tr>
        <th>Revision</th>
        <td>{{ $mailData['revision']}}</td>
    </tr>
    <tr>
        <th>Document Attachment</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/Documents/{{ $mailData['document_attachment'] }}">{{ $mailData['document_attachment'] }}</a>
        </td>
    </tr>

    <tr>
        <th>Document Review Date</th>
        <td>{{ $mailData['document_review_date']}}</td>
    </tr>

    <tr>
        <th>Next Review Date</th>
        <td>{{ $mailData['document_next_review_date']}}</td>
    </tr>
    </tbody>
</table>

{{--@if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Super Admin'))--}}
{{--    <h3>Administrative Use Only</h3>--}}

{{--    <table>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <th>Master Document Attachment</th>--}}
{{--            <td><a target="_blank"--}}
{{--                   href="{{$mailData['base_url']}}/uploads/Documents/Master/{{ $mailData['master_document_attachment'] }}">{{ $mailData['master_document_attachment'] }}</a>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 1</th>--}}
{{--            <td>{{ $mailData['results_area_1'] == '' ? 'N/A' :  $mailData['results_area_1']}}</td>--}}
{{--            <th>Results Area 2</th>--}}
{{--            <td>{{ $mailData['results_area_2'] == '' ? 'N/A' :  $mailData['results_area_2']}}</td>--}}
{{--            <th>Results Area 3</th>--}}
{{--            <td>{{ $mailData['results_area_3'] == '' ? 'N/A' :  $mailData['results_area_3']}}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 4</th>--}}
{{--            <td>{{ $mailData['results_area_4'] == '' ? 'N/A' :  $mailData['results_area_4']}}</td>--}}
{{--            <th>Results Area 5</th>--}}
{{--            <td>{{ $mailData['results_area_5'] == '' ? 'N/A' :  $mailData['results_area_5']}}</td>--}}
{{--            <th>Results Area 6</th>--}}
{{--            <td>{{ $mailData['results_area_6'] == '' ? 'N/A' :  $mailData['results_area_6']}}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 7</th>--}}
{{--            <td>{{ $mailData['results_area_7'] == '' ? 'N/A' :  $mailData['results_area_7']}}</td>--}}
{{--            <th>Results Area 8</th>--}}
{{--            <td>{{ $mailData['results_area_8'] == '' ? 'N/A' :  $mailData['results_area_8']}}</td>--}}
{{--            <th>Results Area 9</th>--}}
{{--            <td>{{ $mailData['results_area_9'] == '' ? 'N/A' :  $mailData['results_area_9']}}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 10</th>--}}
{{--            <td>{{ $mailData['results_area_10'] == '' ? 'N/A' :  $mailData['results_area_10']}}</td>--}}
{{--            <th>Results Area 11</th>--}}
{{--            <td>{{ $mailData['results_area_11'] == '' ? 'N/A' :  $mailData['results_area_11']}}</td>--}}
{{--            <th>Results Area 12</th>--}}
{{--            <td>{{ $mailData['results_area_12'] == '' ? 'N/A' :  $mailData['results_area_12']}}</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}

{{--    <table>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <th>Training Completion Days Allowed</th>--}}
{{--            <td>{{ $mailData['training_completion_days_allowed'] }}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Learning Time (Hours)</th>--}}
{{--            <td>{{ $mailData['learning_time'] }}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Training Note for Training History Comments</th>--}}
{{--            <td>{{ $mailData['training_note_for_training_history_comments'] }}</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--@endif--}}
</body>
</html>
