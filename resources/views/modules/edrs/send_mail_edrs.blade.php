<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailable HTML Table Template</title>
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
<h1>EDRs Emergency Drill Records</h1>
<table>
    <tbody>
    <tr>
        <th>EDR #</th>
        <td>{{ $mailData['edr_id'] }}</td>
    </tr>

    <tr>
        <th>Date and Time of Drill</th>
        <td>{{ format_date_time($mailData['date_and_time_drill']) }}</td>
    </tr>

    <tr>
        <th>Site</th>
        <td>{{ $mailData['site'] }}</td>
    </tr>

    <tr>
        <th>Type of Emergency Simulated</th>
        <td>{{ $mailData['type_of_emergency_simulated'] }}</td>
    </tr>

    <tr>
        <th>Person(s) Conducting The Drill</th>
        <td>{{ $mailData['person_conducting_the_drill'] }}</td>
    </tr>

    <tr>
        <th>Notification Used</th>
        <td>{{ $mailData['notification_used'] }}</td>
    </tr>

    <tr>
        <th>Staff On Duty/Participating</th>
        <td>{{ $mailData['staff_on_duty'] }}</td>
    </tr>

    <tr>
        <th>Attachment Staff Participating</th>
        <td>{{ $mailData['attachment_staff_participating'] }}</td>
    </tr>

    <tr>
        <th>Number Evacuated</th>
        <td>{{ $mailData['number_evacuated'] }}</td>
    </tr>
    <tr>
        <th>Weather Conditions</th>
        <td>{{$mailData['weather_conditions'] }}</td>
    </tr>

    <tr>
        <th>Time Required to Complete (Minutes)</th>
        <td>{{ $mailData['time_required'] }}</td>
    </tr>

    <tr>
        <th>Problems Encountered (If Any)</th>
        <td>{{ $mailData['problems_encountered'] }}</td>
    </tr>

    <tr>
        <th>CPAR #s (If Any)</th>
        <td>{{ $mailData['cpars'] }}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $mailData['comments'] }}</td>
    </tr>

    <tr>
        <th>Photo 1 Description (If Any)</th>
        <td>{{ $mailData['photo_1_description'] }}</td>
    </tr>

    <tr>
        <th>Photo 1 (If Any)</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/edrs/{{ $mailData['photo_1'] }}">{{ $mailData['photo_1'] }}</a>
        </td>
    </tr>

    <tr>
        <th>Photo 2 Description (If Any)</th>
        <td>{{ $mailData['photo_2_description'] }}</td>
    </tr>

    <tr>
        <th>Photo 2 (If Any)</th>
        <td><a target="_blank"
               href="{{$mailData['base_url']}}/uploads/edrs/{{ $mailData['photo_2'] }}">{{ $mailData['photo_2'] }}</a>
        </td>
    </tr>

    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
