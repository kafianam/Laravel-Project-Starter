<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Email</title>
</head>
<body>
    <h2>Hello {{ $user->name }},</h2>

    <p>Thank you for registering with us as a {{ $user->role }}.</p>

    <p>We're excited to have you onboard!</p>
</body>
</html>
