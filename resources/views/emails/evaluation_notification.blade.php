<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Evaluation Notification</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #f2f5fa; padding: 40px 20px; margin: 0; line-height: 1.5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); overflow: hidden;">
        <tr>
            <td style="background-color: #6366f1; padding: 30px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 26px; letter-spacing: 0.5px;">Application Evaluation Complete</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <div style="display: inline-block; width: 80px; height: 80px; background-color: #6366f1; border-radius: 50%; margin-bottom: 15px;">
                        <div style="line-height: 80px; font-size: 40px; color: white;">🔍</div>
                    </div>
                    <p style="font-size: 18px; color: #4f46e5; font-weight: 600; margin: 0;">Evaluation Success</p>
                </div>

                <div style="background-color: #eef2ff; border-left: 5px solid #6366f1; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #4338ca; margin: 0 0 10px 0;"><strong>Reference Number:</strong></p>
                    <p style="font-size: 20px; color: #4338ca; font-weight: 700; margin: 0;">{{ $application->reference_number }}</p>
                </div>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Dear <strong>{{ $application->tc_name }}</strong>,</p>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">We are pleased to inform you that your application has been successfully <strong style="color: #4f46e5; font-size: 17px;">evaluated</strong>.</p>

                <!-- Uncomment if notes are needed -->
                <!-- <div style="background-color: #f9fafb; border-left: 5px solid #9ca3af; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 10px 0;"><strong>Evaluation Notes:</strong></p>
                    <p style="font-size: 16px; color: #4b5563; margin: 0;">{{ $evaluationNotes }}</p>
                </div> -->

                <div style="background-color: #dbeafe; border-left: 5px solid #3b82f6; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #1e40af; margin: 0;"><strong>Next Steps:</strong> We will keep you updated on your application. Please continue monitoring your email for further notifications.</p>
                </div>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Thank you for your patience and cooperation.</p>

                <div style="text-align: center; margin: 35px 0;">
                    <a href="https://client.otcs.digital/" target="_blank" style="display: inline-block; background-color: #4f46e5; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: bold; font-size: 16px; transition: background-color 0.3s;">Visit OTC Website</a>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 25px; margin-top: 30px;">
                    <p style="font-size: 16px; color: #4b5563; margin-bottom: 5px;">Best regards,</p>
                    <p style="font-size: 17px; font-weight: bold; color: #4f46e5; margin-bottom: 5px;">Operations Team</p>
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