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
<h1>{{ $snr->snr_id }}</h1>

<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $snr->site }}</td>
    </tr>
    <tr>
        <th>Origination Date</th>
        <td>{{ format_date($snr->origination_date) }}</td>
    </tr>

    <tr>
        <th>Supplier</th>
        <td>{{ $snr->supplier }}</td>
    </tr>

    <tr>
        <th>Supplier Representative</th>
        <td>{{ $snr->supplier_representative }}</td>
    </tr>

    <tr>
        <th>Our PO #</th>
        <td>{{ $snr->our_po }}</td>
    </tr>

    <tr>
        <th>Supplier Order #</th>
        <td>{{ $snr->supplier_order}}</td>
    </tr>

    <tr>
        <th>Product Name</th>
        <td>{{ $snr->product_name }}</td>
    </tr>

    <tr>
        <th>Quantity</th>
        <td>{{ $snr->quantity }}</td>
    </tr>

    <tr>
        <th>Product Description</th>
        <td>{{ $snr->product_description }}</td>
    </tr>

    <tr>
        <th>Supplier RMA #</th>
        <td>{{ $snr->supplier_rma }}</td>
    </tr>

    <tr>
        <th>Requisition #</th>
        <td>{{ $snr->requisition }}</td>
    </tr>

    <tr>
        <th>Sales Order #</th>
        <td>{{ $snr->sales_order }}</td>
    </tr>

    <tr>
        <th>Customer</th>
        <td>{{ $snr->customer }}</td>
    </tr>

    <tr>
        <th>Other</th>
        <td>{{ $snr->other }}</td>
    </tr>

    <tr>
        <th>Description of Nonconformance</th>
        <td>{{ $snr->description_of_nonconformance }}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $snr->originator }}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $snr->root_cause }}</td>
    </tr>

    <tr>
        <th>Action to Be Taken</th>
        <td>{{ $snr->action_to_be_taken }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $snr->assigned_to }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $snr->effectiveness_evaluated }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $snr->action_taken_effective }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $snr->what_action_was_taken }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $snr->action_taken_by }}</td>
    </tr>

    <tr>
        <th>Target Completion Date</th>
        <td>{{ format_date($snr->target_completion_date) }}</td>
    </tr>

    <tr>
        <th>Action That Was Taken</th>
        <td>{{ $snr->action_that_was_taken }}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{ $snr->completed_by }}</td>
    </tr>

    <tr>
        <th>Disposition Decision</th>
        <td>{{ $snr->disposition_decision }}</td>
    </tr>

    <tr>
        <th>Date Completed</th>
        <td>{{ format_date($snr->date_completed) }}</td>
    </tr>

    <tr>
        <th>CPAR Required?</th>
        <td>{{ $snr->cpar_required }}</td>
    </tr>

    <tr>
        <th>If Yes, CPAR#</th>
        <td>{{ $snr->cpar_num }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $snr->closed_by }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($snr->closure_date) }}</td>
    </tr>

    <tr>
        <th>File Attachment 1 (If Any)</th>
        <td>{{ $snr->file_attachment_1 }}</td>
    </tr>

    <tr>
        <th>File Attachment 2 (If Any)</th>
        <td>{{ $snr->file_attachment_2 }}</td>
    </tr>

    <tr>
        <th>File Attachment 3 (If Any)</th>
        <td>{{ $snr->file_attachment_3 }}</td>
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
