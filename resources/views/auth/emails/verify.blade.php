<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <style>
        /* Inline styles */
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: #f3f4f6;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            font-size: 16px;
            background-color: #1d2630;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #3d4247;
        }

        a:link {
            color: #f1eaea;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="font-size: 24px;">Hi {{ $user->name }},</h1>
        <p style="font-size: 18px; margin-bottom: 20px;">Please click the button below to verify your email address:</p>
        <a href="{{ route('verify.email', ['token' => $token]) }}" class="button">Verify Email</a>
        <p style="font-size: 14px; margin-top: 20px;">If you did not create an account, no further action is required.</p>
    </div>
</body>
</html>