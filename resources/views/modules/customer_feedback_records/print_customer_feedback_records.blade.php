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
<h1>{{ $cfr->cfr_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>CFR #</th>
        <td>{{ $cfr->cfr_id }}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $cfr->site }}</td>
    </tr>

    <tr>
        <th>Type</th>
        <td>{{ $cfr->type }}</td>
    </tr>

    <tr>
        <th>Customer</th>
        <td>{{ $cfr->customer }}</td>
    </tr>

    <tr>
        <th>Customer Location</th>
        <td>{{ $cfr->customer_location }}</td>
    </tr>

    <tr>
        <th>Customer Contact</th>
        <td>{{ $cfr->customer_contact}}</td>
    </tr>

    <tr>
        <th>Customer Contact Telephone</th>
        <td>{{ $cfr->customer_phone }}</td>
    </tr>

    <tr>
        <th>Customer Contact Email (If Any)</th>
        <td>{{ $cfr->customer_email }}</td>
    </tr>

    <tr>
        <th>Description</th>
        <td>{{ $cfr->description }}</td>
    </tr>

    <tr>
        <th>CFR Category</th>
        <td>{{ $cfr->cfr_category }}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $cfr->originator }}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ $cfr->date_originated }}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $cfr->root_cause }}</td>
    </tr>

    <tr>
        <th>Action To Be Taken</th>
        <td>{{ $cfr->action_to_be_taken }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $cfr->assigned_to }}</td>
    </tr>

    <tr>
        <th>Target Completion Date</th>
        <td>{{ $cfr->target_completion_date }}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{ $cfr->completed_by }}</td>
    </tr>

    <tr>
        <th>Date Completed</th>
        <td>{{ $cfr->date_completed }}</td>
    </tr>

    <tr>
        <th>Feedback to Customer</th>
        <td>{{ $cfr->feedback_to_customer }}</td>
    </tr>

    <tr>
        <th>Feedback By</th>
        <td>{{ $cfr->feedback_by }}</td>
    </tr>

    <tr>
        <th>Date of Feedback</th>
        <td>{{ $cfr->date_of_feedback }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $cfr->effectiveness_evaluated }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $cfr->action_taken_effective }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $cfr->what_action_was_taken }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $cfr->action_taken_by }}</td>
    </tr>

    <tr>
        <th>CPAR Required?</th>
        <td>{{ $cfr->cpar_required }}</td>
    </tr>

    <tr>
        <th>If Yes, CPAR#</th>
        <td>{{ $cfr->if_yes_cpar }}</td>
    </tr>

    <tr>
        <th>Attachment (If Any)</th>
        <td>{{ $cfr->attachment_field }}</td>
    </tr>

    <tr>
        <th>Photo Field (If Any)</th>
        <td>{{ $cfr->photo_field }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $cfr->closed_by }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ $cfr->closure_date }}</td>
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
