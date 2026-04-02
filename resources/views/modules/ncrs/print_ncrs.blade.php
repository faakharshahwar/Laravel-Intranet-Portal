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
<h1>{{ $ncr->ncr_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>NCR #</th>
        <td>{{ $ncr->ncr_id }}</td>
    </tr>
    <tr>
        <th>Originating Site</th>
        <td>{{ $ncr->originating_site }}</td>
    </tr>

    <tr>
        <th>Date of Issue</th>
        <td>{{ format_date($ncr->date_of_issue) }}</td>
    </tr>

    <tr>
        <th>Results Area / Dept</th>
        <td>{{ $ncr->results_area }}</td>
    </tr>

    <tr>
        <th>Responsible Site</th>
        <td>{{ $ncr->responsible_site }}</td>
    </tr>

    <tr>
        <th>Quantity</th>
        <td>{{ $ncr->quantity}}</td>
    </tr>

    <tr>
        <th>Product / Process Description</th>
        <td>{{ $ncr->process_description }}</td>
    </tr>

    <tr>
        <th>Order #</th>
        <td>{{ $ncr->order_num }}</td>
    </tr>

    <tr>
        <th>Nonconformance Type</th>
        <td>{{ $ncr->nonconformance_type }}</td>
    </tr>

    <tr>
        <th>Customer (If Applicable)</th>
        <td>{{ $ncr->customer_if_applicable }}</td>
    </tr>

    <tr>
        <th>Description of Nonconformance</th>
        <td>{{ $ncr->description_of_nonconformance }}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $ncr->originator }}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ format_date($ncr->date_originated) }}</td>
    </tr>

    <tr>
        <th>NCR Category</th>
        <td>{{ $ncr->ncr_category }}</td>
    </tr>

    <tr>
        <th>System Type</th>
        <td>{{ $ncr->system_type }}</td>
    </tr>

    <tr>
        <th>Disposition Decision</th>
        <td>{{ $ncr->disposition_decision }}</td>
    </tr>

    <tr>
        <th>Disposition (If Other)</th>
        <td>{{ $ncr->disposition_if_other }}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $ncr->root_cause }}</td>
    </tr>

    <tr>
        <th>Action To Be Taken</th>
        <td>{{ $ncr->action_to_be_taken }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $ncr->assigned_to }}</td>
    </tr>

    <tr>
        <th>Target Date</th>
        <td>{{ format_date($ncr->target_date) }}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $ncr->comments_if_any }}</td>
    </tr>

    <tr>
        <th>Authorized By</th>
        <td>{{ $ncr->authorized_by }}</td>
    </tr>

    <tr>
        <th>Authorization Date</th>
        <td>{{ format_date($ncr->authorization_date) }}</td>
    </tr>

    <tr>
        <th>Action Taken</th>
        <td>{{ $ncr->action_taken }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $ncr->effectiveness_evaluated }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $ncr->action_taken_effective }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $ncr->what_action_was_taken }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $ncr->action_taken_by }}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{ $ncr->completed_by }}</td>
    </tr>

    <tr>
        <th>Date Completed</th>
        <td>{{ format_date($ncr->date_completed) }}</td>
    </tr>

    <tr>
        <th>CPAR Required?</th>
        <td>{{ $ncr->cpar_required }}</td>
    </tr>

    <tr>
        <th>If Yes, CPAR#</th>
        <td>{{ $ncr->cpar_num }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $ncr->closed_by }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($ncr->closure_date) }}</td>
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
