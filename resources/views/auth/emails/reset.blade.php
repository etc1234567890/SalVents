<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        <h1 style="font-size: 24px;">Reset Your Password</h1>
        <p style="font-size: 18px; margin-bottom: 20px;">Please click the link below to reset your password:</p>
        <a href="{{ url('password/reset/' .$email.'/'. $token) }}}" class="button">Reset Password</a>
        <p style="font-size: 14px; margin-top: 20px;">If you did not tried to reset your password, no further action is required.</p>
    </div>
</body>
</html>