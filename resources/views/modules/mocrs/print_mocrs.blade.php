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
<h1>Management of Change Record</h1>
<table>
    <tbody>
    <tr>
        <th>Change Requested By</th>
        <td>{{ $mocr->requested_by_first_name . " " .$mocr->requested_by_last_name }}</td>
    </tr>
    <tr>
        <th>Date Requested</th>
        <td>{{ format_date($mocr->date_requested) }}</td>
    </tr>
    <tr>
        <th>MOCR #</th>
        <td>{{ $mocr->mocr_id }}</td>
    </tr>
    <tr>
        <th>Proposed QMS Change</th>
        <td>{{ $mocr->proposed_qms_change }}</td>
    </tr>
    <tr>
        <th>Purpose of Change</th>
        <td>{{ $mocr->purpose_of_change }}</td>
    </tr>
    <tr>
        <th>Potential Consequence of Change</th>
        <td>{{ $mocr->potential_consequence_of_change }}</td>
    </tr>
    <tr>
        <th>Impact on Integrity of QMS</th>
        <td>{{ $mocr->impact_on_integrity_of_qms }}</td>
    </tr>
    <tr>
        <th>Availability of Resources</th>
        <td>{{ $mocr->availability_of_resources }}</td>
    </tr>
    <tr>
        <th>Allocation or Reallocation of Responsibilities and Authorities</th>
        <td>{{ $mocr->allocation_or_reallocation }}</td>
    </tr>
    <tr>
        <th>Additional Considerations</th>
        <td>{{ $mocr->additional_considerations }}</td>
    </tr>
    <tr>
        <th>Change Authorized By</th>
        <td>{{ $mocr->authorized_by_first_name . " " . $mocr->authorized_by_last_name}}</td>
    </tr>
    <tr>
        <th>Date Authorized</th>
        <td>{{ format_date($mocr->date_authorized) }}</td>
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
