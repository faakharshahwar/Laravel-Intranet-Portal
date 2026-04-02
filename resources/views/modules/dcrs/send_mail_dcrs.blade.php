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
<h1>{{ $mailData['doc_id']}}</h1>
<table>
    <tbody>
    <tr>
        <th>Title</th>
        <td>{{ $mailData['title'] }}</td>
    </tr>
    <tr>
        <th>REV</th>
        <td>{{ $mailData['rev'] }}</td>
    </tr>
    <tr>
        <th>DCR #</th>
        <td>{{ $mailData['dcr_num'] }}</td>
    </tr>
    <tr>
        <th>Source Document</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/documents/{{$mailData['source_document'] }}">{{$mailData['source_document']}}</a></td>
    </tr>
    <tr>
        <th>Document For Approval</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/dcrs/{{ $mailData['document_for_approval'] }}">{{$mailData['document_for_approval'] }}</a></td>
    </tr>
    <tr>
        <th>Effective Date</th>
        <td>{{ $mailData['effective_date'] }}</td>
    </tr>
    <tr>
        <th>Approver 1 </th>
        <td>{{ $mailData['approver_1'] }}</td>
    </tr>
    <tr>
        <th>Approver 2</th>
        <td>{{ $mailData['approver_2'] }}</td>
    </tr>
    <tr>
        <th>Approved By 1 </th>
        <td>{{ $mailData['approved_by_1'] }}</td>
    </tr>
    <tr>
        <th>Approved By 2 </th>
        <td>{{ $mailData['approved_by_2'] }}</td>
    </tr>
    <tr>
        <th>Approval Review Comments (If Any)</th>
        <td>{{ $mailData['approval_review_comments'] }}</td>
    </tr>
    <tr>
        <th>Date Approved</th>
        <td>{{ $mailData['date_approved'] }}</td>
    </tr>
    <tr>
        <th>Training Assessed</th>
        <td>{{ $mailData['training_assessed'] }}</td>
    </tr>
    </tbody>
</table>
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
