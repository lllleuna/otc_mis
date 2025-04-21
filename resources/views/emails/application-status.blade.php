<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #f3f4f6; padding: 40px 20px; margin: 0; line-height: 1.5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); overflow: hidden;">
        <tr>
            <td style="background-color: #4f46e5; padding: 30px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 26px; letter-spacing: 0.5px;">Application Status Update</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <div style="display: inline-block; width: 70px; height: 70px; background-color: #4f46e5; border-radius: 50%; margin-bottom: 15px;">
                        <div style="line-height: 70px; font-size: 35px; color: white;">📋</div>
                    </div>
                </div>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Dear <strong>{{ $application->user->name }}</strong>,</p>

                <div style="background-color: #f5f3ff; border-left: 5px solid #4f46e5; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #4b5563; margin: 0 0 10px 0;">Your application (ID: <strong>{{ $application->id }}</strong>) has been:</p>
                    <p style="font-size: 20px; font-weight: 700; margin: 0; color: #4f46e5;">{{ $status }}</p>
                </div>

                <div style="background-color: #f0f9ff; border-left: 5px solid #3b82f6; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #1e3a8a; margin: 0 0 10px 0;"><strong>Message:</strong></p>
                    <p style="font-size: 16px; color: #1e40af; margin: 0;">{{ $message }}</p>
                </div>

                <div style="text-align: center; margin: 35px 0;">
                    <a href="#" target="_blank" style="display: inline-block; background-color: #4f46e5; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; font-weight: bold; font-size: 16px; transition: background-color 0.3s;">View Application Details</a>
                </div>

                <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; padding: 20px; margin: 25px 0; border-radius: 6px; text-align: center;">
                    <p style="font-size: 16px; color: #6b7280; margin: 0;">If you have any questions, please <a href="#" style="color: #4f46e5; text-decoration: none; font-weight: bold;">contact us</a>.</p>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 25px; margin-top: 30px;">
                    <p style="font-size: 16px; color: #4b5563; margin-bottom: 5px;">Best regards,</p>
                    <p style="font-size: 17px; font-weight: bold; color: #4f46e5; margin-bottom: 5px;">Operations Team</p>
                </div>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e5e7eb;">
                <p style="font-size: 14px; color: #64748b; margin: 0;">This is an automated message. Please do not reply to this email.</p>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-size: 13px; color: #94a3b8; margin-top: 25px;">
        © {{ date('Y') }} All rights reserved.
    </div>
</body>
</html>