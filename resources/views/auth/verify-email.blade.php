<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Verify your Email</h3>

    <h5>Resend email</h5>

    <form action="/email/verification-notification" method="POST">
        @csrf
        <button type="submit">Send verification link</button>
    </form>
</body>
</html>