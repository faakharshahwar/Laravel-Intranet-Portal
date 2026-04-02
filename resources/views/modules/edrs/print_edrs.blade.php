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
<h1>{{ $edr->edr_id}}</h1>
<table>
    <tbody>
    <tr>
        <th>EDR #</th>
        <td>{{ $edr->edr_id }}</td>
    </tr>

    <tr>
        <th>Date and Time of Drill</th>
        <td>{{ format_date_time($edr->date_and_time_drill) }}</td>
    </tr>

    <tr>
        <th>Site</th>
        <td>{{ $edr->site }}</td>
    </tr>

    <tr>
        <th>Type of Emergency Simulated</th>
        <td>{{ $edr->type_of_emergency_simulated }}</td>
    </tr>

    <tr>
        <th>Person(s) Conducting The Drill</th>
        <td>{{ $edr->person_conducting_the_drill }}</td>
    </tr>

    <tr>
        <th>Notification Used</th>
        <td>{{ $edr->notification_used }}</td>
    </tr>

    <tr>
        <th>Staff On Duty/Participating</th>
        <td>{{ $edr->staff_on_duty}}</td>
    </tr>

    <tr>
        <th>Attachment Staff Participating</th>
        <td>{{ $edr->attachment_staff_participating}}</td>
    </tr>

    <tr>
        <th>Number Evacuated</th>
        <td>{{ $edr->number_evacuated}}</td>
    </tr>

    <tr>
        <th>Weather Conditions</th>
        <td>{{ $edr->weather_conditions}}</td>
    </tr>

    <tr>
        <th>Time Required to Complete (Minutes)</th>
        <td>{{ $edr->time_required}}</td>
    </tr>

    <tr>
        <th>Problems Encountered (If Any)</th>
        <td>{{ $edr->problems_encountered}}</td>
    </tr>

    <tr>
        <th>CPAR #s (If Any)</th>
        <td>{{ $edr->cpars}}</td>
    </tr>

    <tr>
        <th>Comments (If Any)</th>
        <td>{{ $edr->comments}}</td>
    </tr>

    <tr>
        <th>Photo 1 Description (If Any)</th>
        <td>{{ $edr->photo_1_description}}</td>
    </tr>

    <tr>
        <th>Photo 1 (If Any)</th>
        <td><a target="_blank"
               href="/uploads/edrs/{{$edr->photo_1_description}}">{{$edr->photo_1}}</a></td>
    </tr>

    <tr>
        <th>Photo 2 Description (If Any)</th>
        <td>{{ $edr->photo_2_description}}</td>
    </tr>

    <tr>
        <th>Photo 2 (If Any)</th>
        <td><a target="_blank"
               href="/uploads/edrs/{{$edr->photo_2}}">{{$edr->photo_2}}</a></td>
    </tr>
    </tbody>
</table>

</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        // Function to handle printing
        window.print();
    });
</script>
