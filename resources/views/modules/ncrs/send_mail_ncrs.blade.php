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
<h1>{{ $mailData['ncr_id']}}</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>NCR #</th>
        <td>{{ $mailData['ncr_id']}}</td>
    </tr>
    <tr>
        <th>Originating Site</th>
        <td>{{ $mailData['originating_site']}}</td>
    </tr>

    <tr>
        <th>Date of Issue</th>
        <td>{{ format_date($mailData['date_of_issue'])}}</td>
    </tr>

    <tr>
        <th>Results Area / Dept</th>
        <td>{{ $mailData['results_area']}}</td>
    </tr>

    <tr>
        <th>Responsible Site</th>
        <td>{{ $mailData['responsible_site']}}</td>
    </tr>

    <tr>
        <th>Quantity</th>
        <td>{{ $mailData['quantity']}}</td>
    </tr>

    <tr>
        <th>Product / Process Description</th>
        <td>{{ $mailData['process_description']}}</td>
    </tr>

    <tr>
        <th>Order #</th>
        <td>{{ $mailData['order_num']}}</td>
    </tr>

    <tr>
        <th>Nonconformance Type</th>
        <td>{{ $mailData['nonconformance_type']}}</td>
    </tr>

    <tr>
        <th>Customer (If Applicable)</th>
        <td>{{ $mailData['customer_if_applicable']}}</td>
    </tr>

    <tr>
        <th>Description of Nonconformance</th>
        <td>{{ $mailData['description_of_nonconformance']}}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $mailData['originator']}}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ format_date($mailData['date_originated'])}}</td>
    </tr>

    <tr>
        <th>NCR Category</th>
        <td>{{ $mailData['ncr_category']}}</td>
    </tr>

    <tr>
        <th>System Type</th>
        <td>{{ $mailData['system_type']}}</td>
    </tr>

    <tr>
        <th>Disposition Decision</th>
        <td>{{ $mailData['disposition_decision']}}</td>
    </tr>

    <tr>
        <th>Disposition (If Other)</th>
        <td>{{ $mailData['disposition_if_other']}}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $mailData['root_cause']}}</td>
    </tr>

    <tr>
        <th>Action To Be Taken</th>
        <td>{{ $mailData['action_to_be_taken']}}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $mailData['assigned_to']}}</td>
    </tr>

    <tr>
        <th>Target Date</th>
        <td>{{ format_date($mailData['target_date'])}}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $mailData['comments_if_any']}}</td>
    </tr>

    <tr>
        <th>Authorized By</th>
        <td>{{ $mailData['authorized_by']}}</td>
    </tr>

    <tr>
        <th>Authorization Date</th>
        <td>{{ format_date($mailData['authorization_date'])}}</td>
    </tr>

    <tr>
        <th>Action Taken</th>
        <td>{{ $mailData['action_taken']}}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $mailData['effectiveness_evaluated']}}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $mailData['action_taken_effective']}}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $mailData['what_action_was_taken']}}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $mailData['action_taken_by']}}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{ $mailData['completed_by']}}</td>
    </tr>

    <tr>
        <th>Date Completed</th>
        <td>{{ format_date($mailData['date_completed'])}}</td>
    </tr>

    <tr>
        <th>CPAR Required?</th>
        <td>{{ $mailData['cpar_required']}}</td>
    </tr>

    <tr>
        <th>If Yes, CPAR#</th>
        <td>{{ $mailData['cpar_num']}}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $mailData['closed_by']}}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($mailData['closure_date'])}}</td>
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
