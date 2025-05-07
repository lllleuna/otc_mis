<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requirements Missing</title>
</head>
<body style="font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #fff7f7; padding: 40px 20px; margin: 0; line-height: 1.5;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 650px; margin: auto; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.08); overflow: hidden;">
        <tr>
            <td style="background-color: #ef4444; padding: 30px 40px; text-align: center;">
                <h1 style="color: #ffffff; margin: 0; font-size: 26px; letter-spacing: 0.5px;">Missing Requirements</h1>
            </td>
        </tr>
        <tr>
            <td style="padding: 40px 40px 30px;">
                <div style="text-align: center; margin-bottom: 30px;">
                    <div style="display: inline-block; width: 80px; height: 80px; background-color: #ef4444; border-radius: 50%; margin-bottom: 15px;">
                        <div style="line-height: 80px; font-size: 40px; color: white;">!</div>
                    </div>
                    <p style="font-size: 18px; color: #ef4444; font-weight: 600; margin: 0;">Attention Required</p>
                </div>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Dear <strong>{{ $name }}</strong>,</p>

                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">We have reviewed your application and found that the following requirements are <strong style="color: #dc2626;">missing or incomplete</strong>:</p>

                <div style="background-color: #fef2f2; border-left: 5px solid #ef4444; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <ul style="font-size: 16px; color: #7f1d1d; padding-left: 20px; margin: 0;">
                        @foreach ($missingRequirements as $requirement)
                            <li>{{ $requirement }}</li>
                        @endforeach
                    </ul>
                </div>

                <div style="background-color: #fff7ed; border-left: 5px solid #f97316; padding: 20px; margin: 25px 0; border-radius: 6px;">
                    <p style="font-size: 16px; color: #9a3412; margin: 0;">Please submit the missing documents as soon as possible to proceed with your application. You may submit it through this email thread.</p>
                </div>


                <p style="font-size: 16px; color: #4b5563; margin-bottom: 20px;">Thank you for your cooperation.</p>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 25px; margin-top: 30px;">
                    <p style="font-size: 16px; color: #4b5563; margin-bottom: 5px;">Best regards,</p>
                    <p style="font-size: 17px; font-weight: bold; color: #b91c1c; margin-bottom: 5px;">Evaluation Team</p>
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
