<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
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
        /* Confirmation message */
        .confirmation-message {
            margin-bottom: 30px;
        }
        /* Button */
        .button {
            display: inline-block;
            background-color: #007bff;
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
                <h2>Booking Confirmation</h2>
            </div>
            <div class="confirmation-message">
                <p>Dear {{ $bookingRequest->client->name }},</p>
                <p>We are pleased to confirm your booking request. Details of your booking are as follows:</p>
                <ul>
                    {{-- <li><strong>Booking Reference:</strong> [Booking Reference]</li> --}}
                    <li><strong>Booking Date:</strong> {{ Carbon\Carbon::parse($bookingRequest->start_time)->format('jS F, Y h:i:s A') }}</li>
                    <li><strong>Capacity:</strong> {{ $bookingRequest->capacity_adults }}adults & {{ $bookingRequest->capacity_children }}children</li>
                    <!-- Add more booking details as necessary -->
                </ul>
                <p>If you have any questions or need further assistance, please don't hesitate to contact us.</p>
            </div>
            <div class="footer">
                <p>Thank you for choosing us!</p>
            </div>
        </div>
    </div>
</body>
</html>
