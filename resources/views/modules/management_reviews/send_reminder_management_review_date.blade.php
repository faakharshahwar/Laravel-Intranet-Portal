<!DOCTYPE html>
<html>
<head>
    <title>Management Review Due Reminder</title>
</head>
<body>
<h1>Management Review Due Reminder</h1>
<p>Hello,</p>
<p>The following management review tasks are either due within the next 10 days or are overdue.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Date of Management Review</th>
        <th>Site</th>
        <th>Status</th>
        <th>Record</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['date_of_management_review'] }}</td>
            <td>{{ $data['site'] }}</td>
            <td>{{ $data['status'] }}</td>
            <td><a href="{{ url('/read_management_reviews/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary actions are performed.</p>
</body>
</html>
