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
<h1>{{ $external_documents->doc_id}}</h1>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $external_documents->site }}</td>
    </tr>
    <tr>
        <th>DOC ID</th>
        <td>{{ $external_documents->doc_id }}</td>
    </tr>
    <tr>
        <th>Document Type</th>
        <td>{{ $external_documents->document_type }}</td>
    </tr>
    <tr>
        <th>Organization / Customer</th>
        <td>{{ $external_documents->organization }}</td>
    </tr>
    <tr>
        <th>Title</th>
        <td>{{ $external_documents->title }}</td>
    </tr>
    <tr>
        <th>Effective Date</th>
        <td>{{ format_date($external_documents->effective_date) }}</td>
    </tr>
    <tr>
        <th>Verification Date</th>
        <td>{{ format_date($external_documents->verification_date) }}</td>
    </tr>
    <tr>
        <th>Verification Method</th>
        <td>{{ $external_documents->verification_method }}</td>
    </tr>
    <tr>
        <th>Verification By</th>
        <td>{{ $verified_by }}</td>
    </tr>
    <tr>
        <th>Next Verification Due Date</th>
        <td>{{ format_date($external_documents->next_verification_due_date) }}</td>
    </tr>
    <tr>
        <th>Primary Location Held</th>
        <td>{{ $external_documents->primary_location_held}}</td>
    </tr>
    <tr>
        <th>Attachment</th>
        <td><a target="_blank"
               href="/uploads/external_documents/{{$external_documents->attachment}}">{{$external_documents->attachment}}</a>
        </td>
    </tr>
    <tr>
        <th>Web Linked File</th>
        <td>{{ $external_documents->web_linked_file}}</td>
    </tr>
    <tr>
        <th>Comments</th>
        <td>{{ $external_documents->comments}}</td>
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
