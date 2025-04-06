<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Evaluation Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 40px; margin: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 30px 40px;">
                <h2 style="color: #333333; margin-top: 0;">Application Evaluation Notification</h2>
                <p style="font-size: 16px; color: #555;"><strong>Reference Number:</strong> <span style="color: #28a745;">{{ $application->reference_number }}</span></p>

                <p style="font-size: 16px; color: #555;">Dear <strong>{{ $application->tc_name }}</strong>,</p>

                <p style="font-size: 16px; color: #555;">We are pleased to inform you that your application has been successfully <strong style="color: #28a745;">evaluated</strong>.</p>

                <!-- Uncomment if notes are needed -->
                <!-- <p style="font-size: 16px; color: #555;"><strong>Evaluation Notes:</strong> {{ $evaluationNotes }}</p> -->

                <p style="font-size: 16px; color: #555;">We will keep you updated. Please continue monitoring your email for further notifications.</p>

                <p style="font-size: 16px; color: #555;">Thank you for your patience and cooperation.</p>

                <div style="margin: 30px 0;">
                    <a href="https://client.otcs.digital/" target="_blank" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 12px 20px; border-radius: 5px; font-weight: bold;">Visit OTC Website</a>
                </div>

                <p style="font-size: 16px; color: #555;">Best regards,</p>
                <p style="font-size: 16px; font-weight: bold; color: #333;">Operations Team</p>
                <p style="font-size: 16px; color: #777;">Office of the Transportation Cooperatives</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 12px; color: #aaa; margin-top: 20px;">
        © {{ date('Y') }} Office of the Transportation Cooperatives. All rights reserved.
    </div>
</body>
</html>
