<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 20px;
            border-bottom: 2px solid #003D20;
            margin-bottom: 20px;
        }

        .header-left {
            flex: 1;
        }

        .header-info h1 {
            font-size: 26px;
            color: #003D20;
            margin: 0 0 5px 0;
            font-weight: 700;
        }

        .header-info h2 {
            font-size: 16px;
            color: #555;
            margin: 0 0 8px 0;
            font-weight: 500;
        }

        .header-info p {
            font-size: 13px;
            color: #666;
            margin: 0;
            line-height: 1.5;
        }

        .header-right {
            text-align: right;
            margin-top:20px;
        }

        .header-right h4 {
            font-size: 14px;
            color: #003D20;
            margin: 0;
            font-weight: 600;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        thead {
            background-color: #003D20;
            color: white;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        td {
            font-size: 14px;
        }

        .no-data-row td {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <div class="header-info">
                <h1>@yield('title')</h1>
                <h2>Kabupaten Berau, Kalimantan Timur</h2>
                <p>Jl. Pulau Panjang, Tj. Redeb, Kec. Tj. Redeb, Kabupaten Berau, Kalimantan Timur 77315</p>
            </div>
        </div>
        <div class="header-right">
            <h4>Dicetak: {{ now()->format('d-m-Y H:i') }}</h4>
        </div>
    </div>
    @yield('content')
</body>
</html>