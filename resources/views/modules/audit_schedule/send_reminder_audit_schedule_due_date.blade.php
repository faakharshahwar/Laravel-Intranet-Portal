<!DOCTYPE html>
<html>
<head>
    <title>Audit Schedule Due Reminder</title>
</head>
<body>
<h1>Audit Schedule Due Reminder</h1>
<p>Hello,</p>
<p>The following audit schedule are either due within the next 10 days or have passed their audit schedule due date.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Audit ID</th>
        <th>Audit Type</th>
        <th>Start Date</th>
        <th>Record</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['audit_id'] }}</td>
            <td>{{ $data['audit_type'] }}</td>
            <td>{{ $data['start_date'] }}</td>
            <td><a href="{{ url('/read_audit_schedule/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary arrangements are made.</p>
</body>
</html>
