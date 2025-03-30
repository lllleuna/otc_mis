<!DOCTYPE html>
<html>
<head>
    <title>Application Evaluation Notification</title>
</head>
<body>
    <h3 class="my-4">Reference Number: <span class="text-green-700">{{ $application->reference_number }}</span></h3>
    <p>Dear {{ $application->tc_name }},</p>
    <p class="mt-2">Your application has been successfully evaluated.</p>
    {{-- <p><strong>Evaluation Notes:</strong> {{ $evaluationNotes }}</p> --}}
    <p>We will keep you updated, please monitor your emails.</p>
    <p>Thank you for your patience.</p>
    <br>
    <p class="mt-2">Best regards,</p>
    <p>Operation Team</p>
    <p>Office of the Transportation Cooperatives</p>
</body>
</html>
