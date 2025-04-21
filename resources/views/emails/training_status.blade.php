<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Request Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .email-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .footer {
            margin-top: 40px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Training Request Update</h2>

        <p>Dear {{ $training->email }},</p>

        <p>Your training request with reference number <strong>{{ $training->reference_no }}</strong> has been <strong>{{ ucfirst($training->status) }}</strong>.</p>

        @if($training->status == 'approved')
            <p><strong>Training Type:</strong> {{ ucfirst($training->training_type) }}<br>
            <strong>Scheduled On:</strong> {{ \Carbon\Carbon::parse($training->training_date_time)->format('F d, Y h:i A') }}</p>

            @if($training->meeting_link)
                <p>You can join the training using the link below:</p>
                <a href="{{ $training->meeting_link }}" class="btn">Join Meeting</a>
            @endif
        @endif

        <p>If you have any questions, feel free to reply to this email.</p>

        <div class="footer">
            <p>Operation Team</p>
        </div>
    </div>
</body>
</html>
