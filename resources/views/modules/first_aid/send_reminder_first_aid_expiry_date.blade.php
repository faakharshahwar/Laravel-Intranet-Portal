<!DOCTYPE html>
<html>
<head>
    <title>First Aid Expiry Reminder</title>
</head>
<body>
<h1>First Aid Expiry Reminder</h1>
<p>Hello,</p>
<p>The following First Aid are either due within the next 10 days or are overdue.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Item Name</th>
        <th>Expiry Date</th>
        <th>Record</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['item_name'] }}</td>
            <td>{{ $data['expiry_date'] }}</td>
            <td><a href="{{ url('/read_first_aid/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary maintenance is performed.</p>
</body>
</html>
