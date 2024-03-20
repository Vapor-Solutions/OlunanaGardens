<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2> Booking Ref: {{ $booking->booking_ref }}</h2>
        <table>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $booking->client->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $booking->client->email }}</td>
            </tr>
            <tr>
                <td>Event Type</td>
                <td>{{ $booking->eventType->title }}</td>
            </tr>
            <tr>
                <td>Number of Adults</td>
                <td>{{ $booking->capacity_adults }}</td>
            </tr>
            <tr>
                <td>Number of Children</td>
                <td>{{ $booking->capacity_children }}</td>
            </tr>
            <tr>
                <td>Package Choosen</td>
                <td>{{ $booking->package->title }}</td>
            </tr>
            <tr>
                <td>Package Price</td>
                <td>{{ $booking->package->price }}</td>
            </tr>
            <tr>
                <td>Total Cost</td>
                <td>{{ $booking->total_cost}}</td>
            </tr>
        </table>
    </div>
</body>

</html>
