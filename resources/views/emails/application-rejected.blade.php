<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Rejected</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #fbf8f6; padding: 40px 20px; margin: 0; line-height: 1.5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); overflow: hidden;">
        <tr>
            <td style="background-color: #6b7280; padding: 30px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 26px; letter-spacing: 0.5px;">Application Status Update</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 40px 30px;">
                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Dear <strong>{{ $name }}</strong>,</p>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">We have completed reviewing your application. Unfortunately, we regret to inform you that your application has been <strong style="color: #dc2626;">rejected</strong>.</p>

                <div style="background-color: #f3f4f6; border-left: 5px solid #6b7280; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 10px 0;"><strong>Reference Number:</strong></p>
                    <p style="font-size: 18px; color: #374151; font-weight: 600; margin: 0;">{{ $referenceNumber }}</p>
                </div>

                <div style="background-color: #fef2f2; border-left: 5px solid #dc2626; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #991b1b; margin: 0 0 10px 0;"><strong>Reason for Rejection:</strong></p>
                    <p style="font-size: 16px; color: #7f1d1d; margin: 0;">{{ $reason }}</p>
                </div>

                <div style="background-color: #f0f9ff; border-left: 5px solid #3b82f6; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #1e40af; margin: 0;"><strong>Next Steps:</strong> Please review the reason above and consider reapplying with the necessary modifications.</p>
                </div>

                <div style="text-align: center; margin: 35px 0;">
                    <a href="https://client.otcs.digital/" target="_blank" style="display: inline-block; background-color: #4b5563; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: bold; font-size: 16px; transition: background-color 0.3s;">Visit OTC Website</a>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 25px; margin-top: 30px;">
                    <p style="font-size: 16px; color: #4b5563; margin-bottom: 5px;">Best regards,</p>
                    <p style="font-size: 17px; font-weight: bold; color: #374151; margin-bottom: 5px;">Operation Team</p>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;">
                <p style="font-size: 14px; color: #64748b; margin: 0;">If you need assistance, please contact our support team</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 13px; color: #94a3b8; margin-top: 25px;">
        © {{ date('Y') }} Office of the Transportation Cooperatives. All rights reserved.
    </div>
</body>
</html>