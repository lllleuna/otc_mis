<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Approved</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #f0f9f2; padding: 40px 20px; margin: 0; line-height: 1.5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); overflow: hidden;">
        <tr>
            <td style="background-color: #10b981; padding: 30px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 26px; letter-spacing: 0.5px;">Application Approved</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <div style="display: inline-block; width: 80px; height: 80px; background-color: #10b981; border-radius: 50%; margin-bottom: 15px;">
                        <div style="line-height: 80px; font-size: 40px; color: white;">✓</div>
                    </div>
                    <p style="font-size: 18px; color: #10b981; font-weight: 600; margin: 0;">Congratulations!</p>
                </div>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Dear <strong>{{ $name }}</strong>,</p>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">We are pleased to inform you that your application has been <strong style="color: #10b981; font-size: 17px;">APPROVED</strong>.</p>

                <div style="background-color: #ecfdf5; border-left: 5px solid #10b981; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #065f46; margin: 0 0 10px 0;"><strong>Reference Number:</strong></p>
                    <p style="font-size: 20px; color: #065f46; font-weight: 700; margin: 0;">{{ $referenceNumber }}</p>
                </div>

                <div style="background-color: #f0f9ff; border-left: 5px solid #3b82f6; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #1e40af; margin: 0;"><strong>Next Steps:</strong> For the release of your Certificate, please regularly check your account.</p>
                </div>

                <div style="text-align: center; margin: 35px 0;">
                    <a href="https://client.otcs.digital/" target="_blank" style="display: inline-block; background-color: #059669; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: bold; font-size: 16px; transition: background-color 0.3s;">Visit OTC Website</a>
                </div>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Thank you for your cooperation.</p>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 25px; margin-top: 30px;">
                    <p style="font-size: 16px; color: #4b5563; margin-bottom: 5px;">Best regards,</p>
                    <p style="font-size: 17px; font-weight: bold; color: #059669; margin-bottom: 5px;">Operation Team</p>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;">
                <p style="font-size: 14px; color: #64748b; margin: 0;">If you have any questions, please contact our support team</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 13px; color: #94a3b8; margin-top: 25px;">
        © {{ date('Y') }} Office of the Transportation Cooperatives. All rights reserved.
    </div>
</body>
</html>