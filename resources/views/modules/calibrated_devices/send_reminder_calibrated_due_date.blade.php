<!DOCTYPE html>
<html>
<head>
    <title>Calibration Due Reminder</title>
</head>
<body>
<h1>Calibration Due Reminder</h1>
<p>Hello,</p>
<p>The following calibrations are either due within the next 10 days or have passed their calibration due date.</p>

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
    <tr>
        <th>Device ID</th>
        <th>Next Calibration Due Date</th>
        <th>Record</th>
    </tr>
    </thead>
    <tbody>
    @foreach($mailData as $data)
        <tr>
            <td>{{ $data['device_id'] }}</td>
            <td>{{ $data['formatted_date'] }}</td>
            <td><a href="{{ url('/read_calibrated_devices/' . $data['id']) }}">View Record</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Please ensure the necessary arrangements are made.</p>
</body>
</html>
