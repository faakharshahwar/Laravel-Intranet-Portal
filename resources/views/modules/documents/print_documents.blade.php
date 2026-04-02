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
<h1>{{ $document->doc_id}}</h1>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $document->site }}</td>
    </tr>
    <tr>
        <th>Management Systems</th>
        <td>{{ $document->management_system }}</td>
    </tr>
    <tr>
        <th>Location</th>
        <td>{{ $document->location }}</td>
    </tr>
    <tr>
        <th>Sub Location</th>
        <td>{{ $document->sub_location }}</td>
    </tr>
    <tr>
        <th>Document Type</th>
        <td>{{ $document->document_type }}</td>
    </tr>
    <tr>
        <th>Title</th>
        <td>{{ $document->title }}</td>
    </tr>
    <tr>
        <th>DOC ID</th>
        <td>{{ $document->doc_id}}</td>
    </tr>
    <tr>
        <th>Revision</th>
        <td>{{ $document->revision}}</td>
    </tr>
    <tr>
        <th>Document Attachment</th>
        <td><a target="_blank"
               href="/uploads/Documents/{{$document->document_attachment}}">{{$document->document_attachment}}</a></td>
    </tr>

    <tr>
        <th>Document Review Date</th>
        <td>{{ format_date($document->document_review_date)}}</td>
    </tr>

    <tr>
        <th>Next Review Date</th>
        <td>{{ format_date($document->document_next_review_date)}}</td>
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
{{--                   href="/uploads/Documents/Master/{{$document->master_document_attachment}}">{{$document->master_document_attachment}}</a>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 1</th>--}}
{{--            <td>{{ $document->results_area_1 == '' ? 'N/A' :  $document->results_area_1}}</td>--}}
{{--            <th>Results Area 2</th>--}}
{{--            <td>{{ $document->results_area_2 == '' ? 'N/A' :  $document->results_area_2}}</td>--}}
{{--            <th>Results Area 3</th>--}}
{{--            <td>{{ $document->results_area_3 == '' ? 'N/A' :  $document->results_area_3}}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 4</th>--}}
{{--            <td>{{ $document->results_area_4 == '' ? 'N/A' :  $document->results_area_4}}</td>--}}
{{--            <th>Results Area 5</th>--}}
{{--            <td>{{ $document->results_area_5 == '' ? 'N/A' :  $document->results_area_5}}</td>--}}
{{--            <th>Results Area 6</th>--}}
{{--            <td>{{ $document->results_area_6 == '' ? 'N/A' :  $document->results_area_6}}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 7</th>--}}
{{--            <td>{{ $document->results_area_7 == '' ? 'N/A' :  $document->results_area_7}}</td>--}}
{{--            <th>Results Area 8</th>--}}
{{--            <td>{{ $document->results_area_8 == '' ? 'N/A' :  $document->results_area_8}}</td>--}}
{{--            <th>Results Area 9</th>--}}
{{--            <td>{{ $document->results_area_9 == '' ? 'N/A' :  $document->results_area_9}}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Results Area 10</th>--}}
{{--            <td>{{ $document->results_area_10 == '' ? 'N/A' :  $document->results_area_10}}</td>--}}
{{--            <th>Results Area 11</th>--}}
{{--            <td>{{ $document->results_area_11 == '' ? 'N/A' :  $document->results_area_11}}</td>--}}
{{--            <th>Results Area 12</th>--}}
{{--            <td>{{ $document->results_area_12 == '' ? 'N/A' :  $document->results_area_12}}</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}

{{--    <table>--}}
{{--        <tbody>--}}
{{--        <tr>--}}
{{--            <th>Training Completion Days Allowed</th>--}}
{{--            <td>{{ $document->training_completion_days_allowed }}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Learning Time (Hours)</th>--}}
{{--            <td>{{ $document->learning_time }}</td>--}}
{{--        </tr>--}}
{{--        <tr>--}}
{{--            <th>Training Note for Training History Comments</th>--}}
{{--            <td>{{ $document->training_note_for_training_history_comments }}</td>--}}
{{--        </tr>--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--@endif--}}
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
