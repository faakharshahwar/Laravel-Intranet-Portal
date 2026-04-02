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
<h1>Training History</h1>

<table>
    <tbody>
    <tr>
        <th>TRR #</th>
        <td>{{$training_history->trr_id}}</td>
    </tr>
    <tr>
        <th>Employee Name</th>
        <td>{{$employee_first_name . " " . $employee_last_name}}</td>
    </tr>
    <tr>
        <th>Person to Notify</th>
        <td>{{$ptn_first_name . " " . $ptn_last_name}}</td>
    </tr>

    <tr>
        <th>Site</th>
        <td>{{ $site }}</td>
    </tr>

    <tr>
        <th>Current Job Title</th>
        <td>{{ $current_job_title }}</td>
    </tr>

    <tr>
        <th>Results Area 1</th>
        <td>{{ $results_area_1 }}</td>
    </tr>

    <tr>
        <th>Results Area 2</th>
        <td>{{ $results_area_2}}</td>
    </tr>

    <tr>
        <th>Results Area 3</th>
        <td>{{ $results_area_3 }}</td>
    </tr>

    <tr>
        <th>Results Area 4</th>
        <td>{{ $results_area_4 }}</td>
    </tr>

    <tr>
        <th>Results Area 5</th>
        <td>{{ $results_area_5 }}</td>
    </tr>

    <tr>
        <th>Results Area 6</th>
        <td>{{ $results_area_6 }}</td>
    </tr>

    <tr>
        <th>Results Area 7</th>
        <td>{{ $results_area_7 }}</td>
    </tr>

    <tr>
        <th>Results Area 8</th>
        <td>{{ $results_area_8 }}</td>
    </tr>

    <tr>
        <th>Results Area 9</th>
        <td>{{ $results_area_9 }}</td>
    </tr>

    <tr>
        <th>Results Area 10</th>
        <td>{{ $results_area_10 }}</td>
    </tr>

    <tr>
        <th>Results Area 11</th>
        <td>{{ $results_area_11 }}</td>
    </tr>

    <tr>
        <th>Results Area 12</th>
        <td>{{ $results_area_12 }}</td>
    </tr>

    <tr>
        <th>Assessment Date</th>
        <td>{{ format_date($training_history->assessment_date) }}</td>
    </tr>

    <tr>
        <th>Must Be Completed By</th>
        <td>{{ format_date($training_history->must_be_completed_by) }}</td>
    </tr>

    <tr>
        <th>Learning Session Title</th>
        <td>{{ $training_history->learning_session_title }}</td>
    </tr>

    <tr>
        <th>Training Type</th>
        <td>{{ $training_history->training_type }}</td>
    </tr>

    <tr>
        <th>Instructor</th>
        <td>{{ $training_history->instructor }}</td>
    </tr>

    <tr>
        <th>Learning Time (Hours)</th>
        <td>{{ $training_history->learning_time }}</td>
    </tr>

    <tr>
        <th>Learning Session Completion Date</th>
        <td>{{ format_date($training_history->learning_session_completion_date) }}</td>
    </tr>

    <tr>
        <th>Link to Learning Module</th>
        <td>{{ $training_history->link_to_learning_module }}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $training_history->comments }}</td>
    </tr>

    <tr>
        <th>Attachment 1 (If Any)</th>
        <td><a target="_blank"
               href="{{asset('uploads/training_history')}}/{{$training_history->attachment_1}}">{{$training_history->attachment_1}}</a>
        </td>
    </tr>

    <tr>
        <th>Attachment 2 (If Any)</th>
        <td><a target="_blank"
               href="{{asset('uploads/training_history')}}/{{$training_history->attachment_2}}">{{$training_history->attachment_2}}</a>
        </td>
    </tr>

    <tr>
        <th>Attachment 3 (If Any)</th>
        <td><a target="_blank"
               href="{{asset('uploads/training_history')}}/{{$training_history->attachment_3}}">{{$training_history->attachment_3}}</a>
        </td>
    </tr>

    <tr>
        <th>Employee Status</th>
        <td>{{$employee_status}}</td>
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
