<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoVault - Secure Digital Asset Management</title>
    <link rel="stylesheet" href="{{ asset('css/home.css?v=2') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        /* COIN DETAILS */
        .coin-header {
            padding: 15px;
            border-bottom: 1px solid #222;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #111;
        }

        .coin-name {
            font-size: 22px;
            font-weight: bold;
        }

        .coin-info-box {
            background: #151515;
            padding: 12px;
            border-radius: 8px;
            display: flex;
            gap: 25px;
            font-size: 15px;
        }

        .coin-info-box div b {
            display: block;
            font-size: 13px;
            color: #bbb;
        }

        /* Timeframes */
        #timeframes {
            padding: 10px 15px;
            background: #111;
            border-bottom: 1px solid #222;
        }

        #timeframes button {
            padding: 6px 14px;
            margin-right: 8px;
            border: none;
            background: #333;
            color: #fff;
            cursor: pointer;
        }

        #timeframes button.active {
            background: #0a84ff;
        }

        /* Chart + Trades Layout */
        .main-content {
            display: flex;
            height: calc(100vh - 190px);
        }

        #chart {
            flex: 3.5;
            height: 100%;
        }

        /* Trades section */
        .trades-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 10px;
        }

        .trade-box {
            background: #111;
            padding: 20px;
            border-radius: 8px;
            height: 48%;
            display: flex;
            flex-direction: column;
        }

        .trade-box h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            text-align: center;
            padding-bottom: 8px;
            border-bottom: 1px solid #333;
        }

        .trade-list {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 6px;
            font-size: 14px;
        }

        .trade {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
        }
    </style>
</head>
