<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Due Reminder</title>
</head>
<body>
<h1>Maintenance Due Reminder</h1>
<p>Hello,</p>
<p>The following maintenance tasks are either due within the next 10 days or are overdue.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Equipment ID</th>
        <th>Next Maintenance Due Date</th>
        <th>Record</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['equipment_id'] }}</td>
            <td>{{ $data['formatted_date'] }}</td>
            <td><a href="{{ url('/read_maintenance_list/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary maintenance is performed.</p>
</body>
</html>
