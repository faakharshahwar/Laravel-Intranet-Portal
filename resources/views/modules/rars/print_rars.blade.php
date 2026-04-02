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
<h1>{{ $rar->rar_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>RAR #</th>
        <td>{{ $rar->rar_id }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $rar->site }}</td>
    </tr>

    <tr>
        <th>Date Identified</th>
        <td>{{ format_date($rar->date_identified) }}</td>
    </tr>

    <tr>
        <th>Department</th>
        <td>{{ $rar->department }}</td>
    </tr>

    <tr>
        <th>Risk Type</th>
        <td>{{ $rar->risk_type }}</td>
    </tr>

    <tr>
        <th>Risk Title</th>
        <td>{{ $rar->risk_title}}</td>
    </tr>

    <tr>
        <th>Risk Description</th>
        <td>{{ $rar->risk_description }}</td>
    </tr>

    <tr>
        <th>Risk Source</th>
        <td>{{ $rar->risk_source }}</td>
    </tr>

    <tr>
        <th>Risk Category</th>
        <td>{{ $rar->risk_category }}</td>
    </tr>

    <tr>
        <th>Risk Probability</th>
        <td>{{ $rar->risk_probability }}</td>
    </tr>

    <tr>
        <th>Risk Impact</th>
        <td>{{ $rar->risk_impact }}</td>
    </tr>

    <tr>
        <th>Management System</th>
        <td>{{ $rar->management_system }}</td>
    </tr>

    <tr>
        <th>Mitigation/Contingency</th>
        <td>{{ $rar->mitigation }}</td>
    </tr>

    <tr>
        <th>Risk Priority</th>
        <td>{{ $rar->risk_priority }}</td>
    </tr>

    <tr>
        <th>Responsible Person(s)</th>
        <td>{{ $rar->responsible_person }}</td>
    </tr>

    <tr>
        <th>Next Risk Review Date</th>
        <td>{{ format_date($rar->next_risk_review_date) }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $rar->effectiveness_evaluated }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $rar->action_taken_effective }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $rar->what_action_was_taken }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $rar->action_taken_by }}</td>
    </tr>

    <tr>
        <th>CPAR # (If Applicable)</th>
        <td>{{ $rar->cpar_num }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ $rar->status }}</td>
    </tr>

    <tr>
        <th>Comments</th>
        <td>{{ $rar->comments }}</td>
    </tr>

    <tr>
        <th>Closed Date</th>
        <td>{{ format_date($rar->closed_date) }}</td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        // Function to handle printing
        window.print();
    });
</script>
