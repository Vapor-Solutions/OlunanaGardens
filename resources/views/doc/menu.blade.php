<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');

        @page {
            size: A4;
            margin: 20mm;
        }

        * {
            font-family: "Lexend", sans-serif;
        }

        body {
            font-family: "Lexend", sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 100%;
            padding: 10px;
        }

        .header {
            /* text-align: right; */
            margin-bottom: 20px;
        }

        .header .writing {
            text-align: right;
            /* margin-bottom: 20px; */
        }

        .header .logo {
            text-align: left;
            width: 56px;
            /* margin-bottom: 20px; */
        }

        .header h1 {
            font-size: 56px;
            font-weight: 900;
            /* Smaller font size */
            margin: 0;
        }

        .header p {
            font-size: 12px;
            /* Smaller font size */
            color: #555;
        }

        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
            /* Ensure section doesn’t break across pages */
        }

        .section h2 {
            font-size: 18px;
            /* Smaller font size */
            margin-bottom: 10px;
            color: #405a37;
            border-bottom: 1px solid #a57a6c;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 0;
            padding: 15px;
            font-size: 12px;
            /* Smaller font size */
        }

        .title {
            font-family: "Lexend", sans-serif;
            font-size: 12px;
            font-weight: 600;
            /* Smaller font size */
        }

        .description {
            font-size: 8px;
            /* Smaller font size */
        }


        .price {
            font-size: 12px;
            /* Smaller font size */
            font-weight: bold;
            text-align: right;
        }

        /* Ensure that each table row contains exactly 3 items */
        td {
            width: 33.33%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table>

                <td
                    style="background: transparent url({{ env('APP_URL') }}/company_logo.png);width: 56px;height: 56px;background-position: center; margin:auto;background-size: 56px; background-color:black">
                </td>
                <td class="writing">
                    <h1>Menu</h1>
                    <p>MON-FRI 10AM - 10PM </p>
                    <p> SAT-SUN 9AM - 10PM</p>
                </td>
            </table>
        </div>

        @foreach ($menu_categories as $category)
            <div class="section">
                <h2>{{ $category->title }}</h2>
                <table>
                    <tr>
                        @foreach ($menu_items as $key => $item)
                            @if ($category->id == $item->menu_category_id)
                                @if (($key + 1) % 2 != 0)
                                    <td>
                                        <div class="title">{{ $item->title }} <span
                                                style="float: right"><small>KES</small>
                                                {{ number_format($item->price) }}</span> </div>
                                        <div class="description">{{ $item->description }}</div>
                                    </td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        @foreach ($menu_items as $key => $item)
                            @if ($category->id == $item->menu_category_id)
                                @if (($key + 1) % 2 == 0)
                                    <td>
                                        <div class="title">{{ $item->title }} <span
                                                style="float: right"><small>KES</small>
                                                {{ number_format($item->price) }}</span> </div>
                                        <div class="description">{{ $item->description }}</div>
                                    </td>
                                @endif
                            @endif
                        @endforeach
                    </tr>

                </table>
            </div>
        @endforeach
    </div>
</body>

</html>
