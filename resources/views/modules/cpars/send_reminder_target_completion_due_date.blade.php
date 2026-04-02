<!DOCTYPE html>
<html>
<head>
    <title>Target Completion Next Due Date Reminder</title>
</head>
<body>
<h1>Target Completion Next Due Date Reminder</h1>
<p>Hello,</p>
<p>The following CPAR are either due within the next 10 days or are overdue.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Site</th>
        <th>CPAR Type</th>
        <th>Target Completion Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['site'] }}</td>
            <td>{{ $data['cpar_type'] }}</td>
            <td>{{ $data['formatted_date'] }}</td>
            <td><a href="{{ url('/read_cpars/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary action is performed.</p>
</body>
</html>
