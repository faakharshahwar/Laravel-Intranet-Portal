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
<h1>EFRs Environmental Feedback Records</h1>
<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $efr->site }}</td>
    </tr>

    <tr>
        <th>Type</th>
        <td>{{ $efr->type }}</td>
    </tr>

    <tr>
        <th>Interested Party (IP)</th>
        <td>{{ $efr->interested_party }}</td>
    </tr>

    <tr>
        <th>IP Location</th>
        <td>{{ $efr->ip_location }}</td>
    </tr>

    <tr>
        <th>IP Contact</th>
        <td>{{ $efr->ip_contact }}</td>
    </tr>

    <tr>
        <th>IP Contact Telephone</th>
        <td>{{ $efr->ip_contact_telephone }}</td>
    </tr>

    <tr>
        <th>Feedback</th>
        <td>{{ $efr->feedback}}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{$originator}}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ format_date($efr->date_originated) }}</td>
    </tr>

    <tr>
        <th>Action Taken</th>
        <td>{{ $efr->action_taken}}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{$completed_by}}</td>
    </tr>

    <tr>
        <th>Feedback to IP</th>
        <td>{{ $efr->feedback_to_ip}}</td>
    </tr>

    <tr>
        <th>Feedback to IP By</th>
        <td>{{$feedback_to_ip_by}}</td>
    </tr>

    <tr>
        <th>Date of Feedback</th>
        <td>{{ format_date($efr->date_of_feedback)}}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{$closed_by}}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($efr->closure_date)}}</td>
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
