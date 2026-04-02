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
<h1>{{ $csr->csr_id}}</h1>

<table>
    <tbody>
    <tr>
        <th>CSR #</th>
        <td>{{ $csr->csr_id }}</td>
    </tr>
    <tr>
        <th>Date Data Collected</th>
        <td>{{ $csr->date_data_collected }}</td>
    </tr>

    <tr>
        <th>Customer Company Name</th>
        <td>{{ $csr->customer_company_name }}</td>
    </tr>

    <tr>
        <th>Customer Contact(s)</th>
        <td>{{ $csr->customer_contact }}</td>
    </tr>

    <tr>
        <th>Customer Location</th>
        <td>{{ $csr->customer_location }}</td>
    </tr>

    <tr>
        <th>Contact Phone (If Applicable)</th>
        <td>{{ $csr->contact_phone}}</td>
    </tr>

    <tr>
        <th>Contact Email Address (If Any)</th>
        <td>{{ $csr->contact_email_address }}</td>
    </tr>

    <tr>
        <th>Site Representative</th>
        <td>{{ $csr->site_representative }}</td>
    </tr>

    <tr>
        <th>Site</th>
        <td>{{ $csr->site }}</td>
    </tr>

    <tr>
        <th>Customer Service and Assistance</th>
        <td>{{ $csr->customer_service_assistance }}</td>
    </tr>

    <tr>
        <th>Quality of Product/Service</th>
        <td>{{ $csr->quality_of_product }}</td>
    </tr>

    <tr>
        <th>Our Performance vs. Expectations</th>
        <td>{{ $csr->performance_vs_expectation }}</td>
    </tr>

    <tr>
        <th>On Time Shipment</th>
        <td>{{ $csr->on_time_shipment }}</td>
    </tr>

    <tr>
        <th>Does CheckPoint Pumps & Systems (CP) have permission to reprint your comments?</th>
        <td>{{ $csr->permission }}</td>
    </tr>

    <tr>
        <th>Like a Sales Rep. to Call?</th>
        <td>{{ $csr->like_a_sales_rep }}</td>
    </tr>

    <tr>
        <th>Average - All Applicable Ratings Comments & Suggestions (If Any)</th>
        <td>{{ $csr->comments }}</td>
    </tr>

    <tr>
        <th>CFR # (If Any)</th>
        <td>{{ $csr->cfr_no }}</td>
    </tr>

    <tr>
        <th>Sales Notes (If Any)</th>
        <td>{{ $csr->sales_note }}</td>
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
