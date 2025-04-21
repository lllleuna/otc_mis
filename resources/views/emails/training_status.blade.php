<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Request Update</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
        
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f6f9fc;
            color: #333;
            padding: 20px;
            margin: 0;
            line-height: 1.6;
        }

        .email-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            max-width: 600px;
            margin: 20px auto;
        }

        .header {
            border-bottom: 2px solid #f0f4f8;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 50px;
        }

        h2 {
            color: #2c3e50;
            margin: 0;
            font-weight: 600;
            font-size: 24px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 500;
            margin-top: 10px;
        }

        .status-approved {
            background-color: #e3f8e9;
            color: #28a745;
        }

        .status-pending {
            background-color: #fff8e1;
            color: #ffa000;
        }

        .status-rejected {
            background-color: #ffebee;
            color: #f44336;
        }

        .training-details {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .training-details p {
            margin: 8px 0;
        }

        .detail-label {
            font-weight: 500;
            color: #566573;
            display: inline-block;
            width: 130px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 20px;
            background-color: #4361ee;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            letter-spacing: 0.3px;
            text-align: center;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }

        .venue-box {
            background-color: #f0f7ff;
            border-left: 4px solid #4361ee;
            padding: 15px;
            margin-top: 15px;
            border-radius: 4px;
        }

        .map-link {
            display: inline-block;
            color: #4361ee;
            text-decoration: none;
            font-weight: 500;
            margin-top: 8px;
        }

        .map-link:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #f0f4f8;
            font-size: 0.9em;
            color: #7f8c8d;
        }

        .signature {
            font-weight: 500;
            color: #2c3e50;
        }

        .contact-info {
            margin-top: 10px;
        }

        .social-links {
            margin-top: 15px;
        }

        .social-icon {
            display: inline-block;
            margin-right: 10px;
            width: 30px;
            height: 30px;
            background-color: #e0e6ed;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">
                <img src="/api/placeholder/180/50" alt="Company Logo">
            </div>
            <h2>Training Request Update</h2>
            <div class="status status-{{ $training->status }}">
                {{ ucfirst($training->status) }}
            </div>
        </div>

        <p>Dear {{ $training->email }},</p>

        <p>We're reaching out to inform you that your training request with reference number <strong>{{ $training->reference_no }}</strong> has been <strong>{{ ucfirst($training->status) }}</strong>.</p>

        @if ($training->status == 'approved')
            <div class="training-details">
                <h3>Training Information</h3>
                <p><span class="detail-label">Type:</span> {{ ucfirst($training->training_type) }}</p>
                <p><span class="detail-label">Date & Time:</span> {{ \Carbon\Carbon::parse($training->training_date_time)->format('F d, Y h:i A') }}</p>
                
                @if ($training->training_type === 'online' && $training->meeting_link)
                    <p><span class="detail-label">Format:</span> Virtual Session</p>
                    <p>You can join the training using the button below:</p>
                    <a href="{{ $training->meeting_link }}" class="btn">Join Training Session</a>
                @elseif($training->training_type === 'face-to-face')
                    <p><span class="detail-label">Format:</span> In-person Session</p>
                    <div class="venue-box">
                        <p><strong>Venue Location:</strong></p>
                        <p>
                            Training Room, 8th Floor Columbia Towers<br>
                            H3V4+QFQ, Ortigas Ave, Mandaluyong, Metro Manila
                        </p>
                        <a href="https://maps.app.goo.gl/nyhGcJoLtsnonWT37" target="_blank" class="map-link">View on Google Maps</a>
                    </div>
                @endif
            </div>

            <p>Please arrive 15 minutes before the scheduled time. Don't forget to bring your company ID for quick access to the facility.</p>
        @endif

        <p>If you have any questions or need to make changes to your request, please reply to this email or contact our training department directly.</p>

        <div class="footer">
            <p class="signature">Best regards,</p>
            <p>The Operations Team</p>
        </div>
    </div>
</body>
</html>