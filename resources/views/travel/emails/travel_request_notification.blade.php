<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $traveler_name ?? 'New Travel Request' }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height:1.5; color:#222;">
<h2 style="margin:0 0 12px;">New Travel Request</h2>

<p>{!! nl2br($bodyText ?? '') !!}</p>

@isset($risk_status)
    <p><strong>Risk Status:</strong> {{ $risk_status }}</p>
@endisset

<p style="margin-top:24px;">Thanks</p>
</body>
</html>
