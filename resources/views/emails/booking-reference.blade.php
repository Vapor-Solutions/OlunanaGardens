<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - OluNana Gardens</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Content */
        .content {
            padding: 40px 30px;
        }

        .greeting {
            margin-bottom: 30px;
            font-size: 16px;
        }

        .greeting strong {
            color: #667eea;
        }

        /* Booking Reference Box */
        .reference-box {
            background: #f8f9ff;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .reference-box p {
            margin: 5px 0;
            font-size: 14px;
        }

        .reference-box .ref-number {
            font-size: 18px;
            font-weight: bold;
            color: #667eea;
        }

        /* Details Section */
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #667eea;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .detail-item .label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .detail-item .value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th {
            background-color: #f8f9fa;
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            color: #667eea;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table td {
            padding: 12px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Summary Box */
        .summary-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 30px;
        }

        .summary-box p {
            margin: 5px 0;
            font-size: 14px;
        }

        .summary-box .total-label {
            font-size: 12px;
            opacity: 0.9;
            text-transform: uppercase;
        }

        .summary-box .total-amount {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }

        /* Next Steps */
        .next-steps {
            background: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .next-steps p {
            margin: 8px 0;
            font-size: 14px;
            color: #333;
        }

        .next-steps strong {
            color: #ff9800;
        }

        /* CTA Button */
        .cta-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s;
        }

        .cta-button:hover {
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .header {
                padding: 30px 15px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content {
                padding: 20px 15px;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .summary-box .total-amount {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📅 Booking Confirmed!</h1>
            <p>Your event at OluNana Gardens</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                Hello <strong>{{ $booking->client->name }}</strong>,
                <br><br>
                Thank you for choosing OluNana Gardens! Your booking has been confirmed and we're excited to host your event.
            </div>

            <!-- Reference Box -->
            <div class="reference-box">
                <p class="ref-number">Booking Reference: #{{ $booking->booking_ref }}</p>
                <p>Status: <strong>{{ ucfirst($booking->status) }}</strong></p>
                <p style="font-size: 12px; color: #999; margin-top: 10px;">Please save this reference for your records</p>
            </div>

            <!-- Event Details -->
            <div class="section-title">Event Details</div>
            <div class="details-grid">
                <div class="detail-item">
                    <div class="label">Event Type</div>
                    <div class="value">{{ $booking->eventType->title }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Status</div>
                    <div class="value">
                        @if($booking->isPending())
                            <span style="color: #ff9800;">⏳ Pending</span>
                        @elseif($booking->isConfirmed())
                            <span style="color: #4caf50;">✓ Confirmed</span>
                        @elseif($booking->isCancelled())
                            <span style="color: #f44336;">✗ Cancelled</span>
                        @else
                            <span style="color: #9e9e9e;">{{ ucfirst($booking->status) }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Booking Information -->
            <div class="section-title">Booking Information</div>
            <table>
                <thead>
                    <tr>
                        <th>Detail</th>
                        <th>Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>📅 Date & Time</td>
                        <td>{{ $booking->start_time->format('F d, Y - g:i A') }}</td>
                    </tr>
                    <tr>
                        <td>👥 Guests</td>
                        <td>
                            {{ $booking->capacity_adults }} Adult(s)
                            @if($booking->capacity_children > 0)
                                + {{ $booking->capacity_children }} Child(ren)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>📦 Package</td>
                        <td>{{ $booking->package->title }}</td>
                    </tr>
                    <tr>
                        <td>📍 Sections</td>
                        <td>
                            @foreach($booking->sections as $section)
                                <span style="background: #f0f0f0; padding: 2px 6px; border-radius: 3px; margin-right: 5px;">{{ $section->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    @if($booking->notes)
                    <tr>
                        <td>📝 Notes</td>
                        <td>{{ $booking->notes }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pricing Summary -->
            <div class="section-title">Pricing Summary</div>
            <table>
                <tbody>
                    <tr>
                        <td>Adults ({{ $booking->capacity_adults }} × KES {{ number_format($booking->price, 0) }})</td>
                        <td style="text-align: right; font-weight: 600;">KES {{ number_format($booking->capacity_adults * $booking->price, 0) }}</td>
                    </tr>
                    @if($booking->capacity_children > 0)
                    <tr>
                        <td>Children ({{ $booking->capacity_children }} × KES {{ number_format($booking->price * 0.5, 0) }})</td>
                        <td style="text-align: right; font-weight: 600;">KES {{ number_format($booking->capacity_children * ($booking->price * 0.5), 0) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <!-- Total Cost Summary -->
            <div class="summary-box">
                <p class="total-label">Total Amount</p>
                <div class="total-amount">
                    KES {{ number_format(($booking->capacity_adults * $booking->price) + ($booking->capacity_children * $booking->price * 0.5), 0) }}
                </div>
                <p style="font-size: 12px;">Payment required before the event date</p>
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <p><strong>What's Next?</strong></p>
                <p>✓ Complete payment to confirm your booking</p>
                <p>✓ We'll send you further instructions via email</p>
                <p>✓ Arrive 30 minutes early on your event date</p>
                <p style="margin-top: 10px; font-size: 12px;">Have questions? Contact us at <strong>support@olunana.com</strong></p>
            </div>

            <!-- CTA Button -->
            <div class="cta-container">
                <a href="{{ route('booking-details', $booking->booking_ref) ?? '#' }}" class="cta-button">View Booking Details</a>
            </div>

            <!-- Contact Information -->
            <div class="section-title">Questions?</div>
            <p style="font-size: 14px; margin-bottom: 15px;">
                If you have any questions about your booking or need to make changes, please don't hesitate to contact us:
            </p>
            <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; font-size: 14px;">
                <p><strong>Email:</strong> <a href="mailto:bookings@olunana.com" style="color: #667eea; text-decoration: none;">bookings@olunana.com</a></p>
                <p><strong>Phone:</strong> +254 (0) XXX XXX XXX</p>
                <p><strong>Website:</strong> <a href="https://olunana.com" style="color: #667eea; text-decoration: none;">www.olunana.com</a></p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} OluNana Gardens. All rights reserved.</p>
            <p>This is an automated email. Please do not reply directly to this message.</p>
            <p style="margin-top: 10px;">
                <a href="#">Unsubscribe</a> | <a href="#">Preferences</a> | <a href="#">Contact Us</a>
            </p>
        </div>
    </div>
</body>
</html>
