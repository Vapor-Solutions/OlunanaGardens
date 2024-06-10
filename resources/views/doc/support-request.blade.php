<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Support Request</title>
    <style>
        /* Reset styles */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        /* Email wrapper */
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        /* Email content */
        .email-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        /* Logo */
        .logo {
            max-width: 150px;
            height: auto;
        }
        /* Notification message */
        .notification-message {
            margin-bottom: 30px;
        }
        /* Button */
        .button {
            display: inline-block;
            background-color: #531502;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <img src="{{ asset('company_logo.png') }}" alt="Logo" class="logo">
                <h2>Support Request</h2>
            </div>
            <div class="notification-message">
                <p>Hello Admin,</p>
                <p>A new contact has requested your support. Details are as follows:</p>
                <ul>
                    <li><strong>Client Name:</strong> {{ $name }}</li>
                    <li><strong>Email Address:</strong> {{ $email }}</li>
                    <li><strong>Phone Number:</strong> {{ $phone }}</li>
                    <li><strong>Subject:<strong> {{ $subject }}</li>
                    <li><strong>Message:<strong> {{ $body }}</li>
                    <!-- Add more booking details as necessary -->
                </ul>
                <p>Please take appropriate action to process this support request.</p>
            </div>
            <div class="footer">
                <p>Thank you!</p>
            </div>
        </div>
    </div>
</body>
</html>
