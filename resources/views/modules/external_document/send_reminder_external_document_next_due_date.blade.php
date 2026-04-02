<!DOCTYPE html>
<html>
<head>
    <title>External Document Reminder</title>
</head>
<body>
<h1>External Document Next Due Date Reminder</h1>
<p>Hello,</p>
<p>The following External Document are either due within the next 10 days or are overdue.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Doc ID</th>
        <th>Document Type Type</th>
        <th>Next Verification Due Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['doc_id'] }}</td>
            <td>{{ $data['document_type'] }}</td>
            <td>{{ $data['formatted_date'] }}</td>
            <td><a href="{{ url('/read_external_document/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary action is performed.</p>
</body>
</html>
