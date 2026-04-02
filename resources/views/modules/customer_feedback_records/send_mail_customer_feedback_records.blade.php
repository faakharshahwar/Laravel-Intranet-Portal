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
<h1>{{ $mailData['cfr_id']}}</h1>
<p>{{ $mailData['personal_message'] }}</p>

<table>
    <tbody>
    <tr>
        <th>CFR #</th>
        <td>{{ $mailData['cfr_id']}}</td>
    </tr>
    <tr>
        <th>Site</th>
        <td>{{ $mailData['site']}}</td>
    </tr>

    <tr>
        <th>Type</th>
        <td>{{ $mailData['type']}}</td>
    </tr>

    <tr>
        <th>Customer</th>
        <td>{{ $mailData['customer']}}</td>
    </tr>

    <tr>
        <th>Customer Location</th>
        <td>{{ $mailData['customer_location']}}</td>
    </tr>

    <tr>
        <th>Customer Contact</th>
        <td>{{ $mailData['customer_contact']}}</td>
    </tr>

    <tr>
        <th>Customer Contact Telephone</th>
        <td>{{ $mailData['customer_phone']}}</td>
    </tr>

    <tr>
        <th>Customer Contact Email (If Any)</th>
        <td>{{ $mailData['customer_email']}}</td>
    </tr>

    <tr>
        <th>Description</th>
        <td>{{ $mailData['description']}}</td>
    </tr>

    <tr>
        <th>CFR Category</th>
        <td>{{ $mailData['cfr_category']}}</td>
    </tr>

    <tr>
        <th>Originator</th>
        <td>{{ $mailData['originator']}}</td>
    </tr>

    <tr>
        <th>Date Originated</th>
        <td>{{ $mailData['date_originated']}}</td>
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
        <th>Target Completion Date</th>
        <td>{{ $mailData['target_completion_date']}}</td>
    </tr>

    <tr>
        <th>Completed By</th>
        <td>{{ $mailData['completed_by']}}</td>
    </tr>

    <tr>
        <th>Date Completed</th>
        <td>{{ $mailData['date_completed']}}</td>
    </tr>

    <tr>
        <th>Feedback to Customer</th>
        <td>{{ $mailData['feedback_to_customer']}}</td>
    </tr>

    <tr>
        <th>Feedback By</th>
        <td>{{ $mailData['feedback_by']}}</td>
    </tr>

    <tr>
        <th>Date of Feedback</th>
        <td>{{ $mailData['date_of_feedback']}}</td>
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
        <th>CPAR Required?</th>
        <td>{{ $mailData['cpar_required']}}</td>
    </tr>

    <tr>
        <th>If Yes, CPAR#</th>
        <td>{{ $mailData['if_yes_cpar']}}</td>
    </tr>

    <tr>
        <th>Attachment (If Any)</th>
        <td>
            <a href="{{$mailData['base_url']}}/uploads/customer_feedback_records/{{ $mailData['attachment_field']}}">{{ $mailData['attachment_field']}}</a>
        </td>
    </tr>

    <tr>
        <th>Photo Field (If Any)</th>
        <td>
            <a href="{{$mailData['base_url']}}/uploads/customer_feedback_records/{{ $mailData['photo_field']}}">{{ $mailData['photo_field']}}</a>
        </td>
    </tr>

    <tr>
        <th>Closed By</th>
        <td>{{ $mailData['closed_by']}}</td>
    </tr>

    <tr>
        <th>Closure Date</th>
        <td>{{ $mailData['closure_date']}}</td>
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
