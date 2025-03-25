<!DOCTYPE html>
<html>
<head>
    <title>Application Status Update</title>
</head>
<body>
    <h2>Application Status Update</h2>
    <p>Dear {{ $application->user->name }},</p>
    
    <p>Your application (ID: {{ $application->id }}) has been <strong>{{ $status }}</strong>.</p>

    <p><strong>Message:</strong> {{ $message }}</p>

    <p>If you have any questions, please contact us.</p>

    <p>Best regards,</p>
    <p>Accreditation Team</p>
</body>
</html>
