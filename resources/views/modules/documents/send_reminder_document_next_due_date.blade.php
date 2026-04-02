<!DOCTYPE html>
<html>
<head>
    <title>Document Next Due Date Reminder</title>
</head>
<body>
<h1>Document Next Due Date Reminder</h1>
<p>Hello,</p>
<p>The following Document are either due within the next 10 days or are overdue.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Site</th>
        <th>Title</th>
        <th>Next Due Date</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['site'] }}</td>
            <td>{{ $data['title'] }}</td>
            <td>{{ $data['formatted_date'] }}</td>
            <td><a href="{{ url('/read_documents/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary action is performed.</p>
</body>
</html>
