<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basket Purchase Confirmation</title>
</head>
<body style="margin:0; padding:0; background:#f5f5f5; font-family: Arial, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f5f5; padding:20px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:8px; overflow:hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background:#4f46e5; padding:20px; text-align:center; color:#ffffff; font-size:22px; font-weight:bold;">
                            Basket Purchase Confirmation
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding:20px 30px; font-size:15px; color:#333;">
                            <p>Hi <strong>{{ $user_name }}</strong>,</p>
                            <p>Thank you for purchasing the following basket:</p>
                        </td>
                    </tr>

                    <!-- Basket Details -->
                    <tr>
                        <td style="padding: 0 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ddd; border-radius:6px;">
                                <tr>
                                    <td style="padding:12px; font-size:14px; border-bottom:1px solid #eee;">
                                        <strong>Basket Name:</strong> {{ $basket_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px; font-size:14px; border-bottom:1px solid #eee;">
                                        <strong>Amount:</strong> ${{ $amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px; font-size:14px;">
                                        <strong>Purchase Date:</strong> {{ $purchase_date }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Snapshot Section -->
                    <tr>
                        <td style="padding: 0 30px;">
                            <p style="font-size:15px; font-weight:bold; color:#333;">Basket Snapshot</p>

                            <!-- Items Table -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ddd; border-radius:6px;">
                                <tr style="background:#f3f4f6;">
                                    <th style="padding:10px; font-size:13px; text-align:left; border-bottom:1px solid #ddd;">Coin</th>
                                    <th style="padding:10px; font-size:13px; text-align:left; border-bottom:1px solid #ddd;">Percentage</th>
                                </tr>

                                @foreach($snapshot['items'] as $item)
                                <tr>
                                    <td style="padding:10px; font-size:13px; border-bottom:1px solid #eee;">{{ $item['symbol'] }}</td>
                                    <td style="padding:10px; font-size:13px; border-bottom:1px solid #eee;">{{ $item['percentage'] }}%</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <!-- Return Cycles -->
                    <tr>
                        <td style="padding: 20px 30px;">
                            <p style="font-size:15px; font-weight:bold; color:#333;">Return Cycles</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #ddd; border-radius:6px;">
                                <tr style="background:#f3f4f6;">
                                    <th style="padding:10px; font-size:13px; text-align:left; border-bottom:1px solid #ddd;">Duration (Months)</th>
                                    <th style="padding:10px; font-size:13px; text-align:left; border-bottom:1px solid #ddd;">Return %</th>
                                </tr>

                                @foreach($snapshot['return_cycles'] as $cycle)
                                <tr>
                                    <td style="padding:10px; font-size:13px; border-bottom:1px solid #eee;">{{ $cycle['months'] }} Months</td>
                                    <td style="padding:10px; font-size:13px; border-bottom:1px solid #eee;">{{ $cycle['return_percentage'] }}%</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding:20px 30px; font-size:13px; color:#666; text-align:center;">
                            Thank you for choosing our platform.<br>
                            If you have any questions, feel free to contact us.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
