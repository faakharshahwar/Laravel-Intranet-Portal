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
<h1>{{ $mailData['snr_id'] }}</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>
    <tr>
        <th>Origination Date</th>
        <td>{{ format_date($mailData['origination_date']) }}</td>
    </tr>

    <tr>
        <th>Supplier</th>
        <td>{{ $mailData['supplier'] }}</td>
    </tr>

    <tr>
        <th>Supplier Representative</th>
        <td>{{ $mailData['supplier_representative'] }}</td>
    </tr>

    <tr>
        <th>Our PO #</th>
        <td>{{ $mailData['our_po'] }}</td>
    </tr>

    <tr>
        <th>Supplier Order #</th>
        <td>{{ $mailData['supplier_order'] }}</td>
    </tr>

    <tr>
        <th>Product Name</th>
        <td>{{ $mailData['product_name'] }}</td>
    </tr>

    <tr>
        <th>Quantity</th>
        <td>{{ $mailData['quantity'] }}</td>
    </tr>

    <tr>
        <th>Product Description</th>
        <td>{{ $mailData['product_description'] }}</td>
    </tr>

    <tr>
        <th>Supplier RMA #</th>
        <td>{{ $mailData['supplier_rma'] }}</td>
    </tr>

    <tr>
        <th>Requisition #</th>
        <td>{{ $mailData['requisition'] }}</td>
    </tr>

    <tr>
        <th>Sales Order #</th>
        <td>{{ $mailData['sales_order'] }}</td>
    </tr>

    <tr>
        <th>Customer</th>
        <td>{{ $mailData['customer'] }}</td>
    </tr>

    <tr>
        <th>Other</th>
        <td>{{ $mailData['other'] }}</td>
    </tr>

    <tr>
        <th>Description of Nonconformance</th>
        <td>{{ $mailData['description_of_nonconformance'] }}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $mailData['originator'] }}</td>
    </tr>

    <tr>
        <th>Root Cause</th>
        <td>{{ $mailData['root_cause'] }}</td>
    </tr>

    <tr>
        <th>Action to Be Taken</th>
        <td>{{ $mailData['action_to_be_taken'] }}</td>
    </tr>

    <tr>
        <th>Assigned To</th>
        <td>{{ $mailData['assigned_to'] }}</td>
    </tr>

    <tr>
        <th>How Was Effectiveness Evaluated?</th>
        <td>{{ $mailData['effectiveness_evaluated'] }}</td>
    </tr>

    <tr>
        <th>Was Action Taken Effective?</th>
        <td>{{ $mailData['action_taken_effective'] }}</td>
    </tr>

    <tr>
        <th>If NO, What Action Was Taken?</th>
        <td>{{ $mailData['what_action_was_taken'] }}</td>
    </tr>

    <tr>
        <th>If NO, Action Taken By</th>
        <td>{{ $mailData['action_taken_by'] }}</td>
    </tr>

    <tr>
        <th>Target Completion Date</th>
        <td>{{ format_date($mailData['target_completion_date']) }}</td>
    </tr>

    <tr>
        <th>Action That Was Taken</th>
        <td>{{ $mailData['action_that_was_taken'] }}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{ $mailData['completed_by'] }}</td>
    </tr>

    <tr>
        <th>Disposition Decision</th>
        <td>{{ $mailData['disposition_decision'] }}</td>
    </tr>

    <tr>
        <th>Date Completed</th>
        <td>{{ format_date($mailData['date_completed']) }}</td>
    </tr>

    <tr>
        <th>CPAR Required?</th>
        <td>{{ $mailData['cpar_required'] }}</td>
    </tr>

    <tr>
        <th>If Yes, CPAR#</th>
        <td>{{ $mailData['cpar_num'] }}</td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $mailData['closed_by'] }}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ format_date($mailData['closure_date']) }}</td>
    </tr>

    <tr>
        <th>File Attachment 1 (If Any)</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/snrs/{{$mailData['file_attachment_1']}}">{{$mailData['file_attachment_1']}}</a>
        </td>
    </tr>

    <tr>
        <th>File Attachment 2 (If Any)</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/snrs/{{$mailData['file_attachment_2']}}">{{$mailData['file_attachment_2']}}</a>
        </td>
    </tr>

    <tr>
        <th>File Attachment 3 (If Any)</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/snrs/{{$mailData['file_attachment_3']}}">{{$mailData['file_attachment_3']}}</a>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
