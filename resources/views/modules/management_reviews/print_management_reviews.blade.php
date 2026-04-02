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
<h1>Management Review</h1>

<table>
    <tbody>
    <tr>
        <th>Date of Management Review</th>
        <td>{{ format_date($management_reviews->date_of_management_review) }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $management_reviews->site }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ $management_reviews->status }}</td>
    </tr>

    <tr>
        <th>Agenda/Notice</th>
        <td>{{ $management_reviews->agenda }}</td>
    </tr>

    <tr>
        <th>Minutes Attachment</th>
        <td>{{ $management_reviews->minutes_attachment }}</td>
    </tr>

    <tr>
        <th>Attachment 1 (If Any)</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->attachment_1}}">{{$management_reviews->attachment_1}}</a>
        </td>
    </tr>

    <tr>
        <th>Attachment 2 (If Any)</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->attachment_2}}">{{$management_reviews->attachment_2}}</a>
        </td>
    </tr>

    <tr>
        <th>Attachment 3 (If Any)</th>
        <td>
            <a target="_blank"
               href="{{asset('uploads/management_reviews')}}/{{$management_reviews->attachment_3}}">{{$management_reviews->attachment_3}}</a>
        </td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $management_reviews->comments }}</td>
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
