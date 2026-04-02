<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailable HTML Table Template</title>
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
<h1>Qualified Auditors List</h1>
<p>{{ $mailData['personal_message'] }}</p>
<table>
    <tbody>
    <tr>
        <th>Auditor's Name</th>
        <td>{{ $mailData['auditor_name'] }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>
    <tr>
        <th>Auditor Status</th>
        <td>{{ $mailData['auditor_status'] }}</td>
    </tr>
    <tr>
        <th>Qualification Basis 1</th>
        <td>{{ $mailData['qualification_basis_1'] }}</td>
    </tr>
    <tr>
        <th>Qualification Basis 2</th>
        <td>{{ $mailData['qualification_basis_2'] }}</td>
    </tr>
    <tr>
        <th>Qualification Basis 3</th>
        <td>{{ $mailData['qualification_basis_3'] }}</td>
    </tr>
    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $mailData['comments'] }}</td>
    </tr>
    <tr>
        <th>File Attachment 1</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/qualified_auditors_list/{{$mailData['file_attachment_1']}}">{{$mailData['file_attachment_1']}}</a></td>
    </tr>
    <tr>
        <th>File Attachment 2</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/qualified_auditors_list/{{$mailData['file_attachment_2']}}">{{$mailData['file_attachment_2']}}</a></td>
    </tr>
    <tr>
        <th>Web Link 1</th>
        <td>{{ $mailData['web_link_1'] }}</td>
    </tr>
    <tr>
        <th>Web Link 2</th>
        <td>{{ $mailData['web_link_2'] }}</td>
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
