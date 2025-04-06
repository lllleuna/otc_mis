<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Application Approved</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 40px; margin: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <tr>
            <td style="padding: 30px 40px;">
                <h2 style="color: #333333; margin-top: 0;">Application Approved</h2>
                <p style="font-size: 16px; color: #555;">Dear <strong>{{ $name }}</strong>,</p>

                <p style="font-size: 16px; color: #555;">We are pleased to inform you that your application has been <strong style="color: #28a745;">approved</strong>.</p>

                <p style="font-size: 16px; color: #555;"><strong>Reference Number:</strong> {{ $referenceNumber }}</p>

                <p style="font-size: 16px; color: #555;">For the release of your Certificate, please regularly check your account.</p>

                <div style="margin: 30px 0;">
                    <a href="https://client.otcs.digital/" target="_blank" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 12px 20px; border-radius: 5px; font-weight: bold;">Visit OTC Website</a>
                </div>

                <p style="font-size: 16px; color: #555;">Thank you for your cooperation.</p>

                <p style="font-size: 16px; color: #555;">Best regards,</p>
                <p style="font-size: 16px; font-weight: bold; color: #333;">The OTC Team</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 12px; color: #aaa; margin-top: 20px;">
        © {{ date('Y') }} Office of the Transportation Cooperatives. All rights reserved.
    </div>
</body>
</html>
