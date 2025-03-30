<!DOCTYPE html>
<html>
<head>
    <title>Application Rejected</title>
</head>
<body>
    <p>Dear {{ $name }},</p>
    <p>We regret to inform you that your application has been <strong>rejected</strong>.</p>
    <p><strong>Reference Number:</strong> {{ $referenceNumber }}</p>
    <p><strong>Reason for Rejection:</strong> {{ $reason }}</p>
    <p>Please review the provided reason and reapply if necessary.</p>
    <div>
        <a href="https://client.otcs.digital/">OTC Website</a>
    </div>
    <p>Best regards,</p>
    <p>The OTC Team</p>
</body>
</html>
