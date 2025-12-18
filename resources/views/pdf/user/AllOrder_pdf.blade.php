<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Invoice - Small Shopping Site</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            position: fixed;
            top: -60px;
            height: 50px;
            width: 100%;
            color: #333;
            font-size: 24px;
            text-align: center;
            line-height: 35px;
            padding-top: 15px;
            font-weight: 700;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        footer {
            position: fixed;
            bottom: -60px;
            height: 50px;
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            line-height: 35px;
            font-size: 12px;
            font-weight: 500;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            background: white;
            line-height: 1.6;
        }

        h4 {
            margin: 0;
            color: #333;
            font-weight: 600;
        }

        h3 {
            color: #667eea;
            font-weight: 700;
            font-size: 16px;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.5rem;
        }

        .section-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        /* Company & Customer Info */
        .company-header {
            margin-bottom: 2rem;
        }

        .company-info {
            font-size: 11px;
            line-height: 1.8;
            color: #666;
        }

        .company-info h4 {
            color: #667eea;
            font-size: 13px;
            margin-bottom: 0.5rem;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: 800;
            color: #333;
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
        }

        .invoice-date {
            font-size: 11px;
            color: #999;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }

        table.products {
            font-size: 12px;
            margin-bottom: 1rem;
        }

        table.products tr {
            border-bottom: 1px solid #eee;
        }

        table.products th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: 0.5px;
            border-radius: 4px;
        }

        table.products tr.items td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 12px;
        }

        table.products tr.items:hover {
            background-color: #f9f9f9;
        }

        table.products td:last-child {
            text-align: right;
            font-weight: 600;
            color: #667eea;
        }

        .product-name {
            font-weight: 600;
            color: #333;
        }

        .product-date {
            font-size: 11px;
            color: #999;
        }

        .qty-cell,
        .price-cell {
            text-align: center;
            font-weight: 600;
        }

        .total-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
        }

        .total-row:last-child {
            border-bottom: none;
            margin-top: 0.5rem;
            padding-top: 1rem;
            border-top: 2px solid #667eea;
            font-size: 16px;
            font-weight: 700;
            color: #667eea;
        }

        .total-label {
            font-weight: 600;
            color: #555;
        }

        .total-amount {
            font-weight: 700;
            color: #667eea;
        }

        .total-row:last-child .total-label {
            color: #333;
        }

        .total-row:last-child .total-amount {
            font-size: 18px;
            color: #667eea;
        }

        .footer {
            font-size: 11px;
            padding: 1.5rem;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            border-radius: 8px;
            margin-top: 2rem;
            text-align: center;
            color: #666;
            border-top: 2px solid #667eea;
        }

        .footer div {
            margin: 0.5rem 0;
        }

        .thank-you {
            font-weight: 700;
            color: #667eea;
            font-size: 13px;
        }

        .company-name {
            font-weight: 700;
            color: #333;
            font-size: 12px;
        }

        /* Delivery Address Section */
        .delivery-section {
            background: #f0f4ff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #667eea;
        }

        .delivery-section h4 {
            color: #667eea;
            font-size: 12px;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .delivery-section p {
            font-size: 11px;
            line-height: 1.8;
            color: #555;
            margin: 0;
        }

        /* Order Header Info */
        .order-info-grid {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .info-box {
            flex: 1;
        }

        .info-box h4 {
            color: #667eea;
            font-size: 12px;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-box p {
            font-size: 11px;
            line-height: 1.8;
            color: #555;
            margin: 0;
        }

        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        /* Page Number */
        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            .page-break {
                page-break-after: always;
            }
        }
    </style>

</head>

<body>

    <header>
        Small Shopping Site
    </header>

    <main style="padding: 40px 20px;">
        <!-- Invoice Header -->
        <div class="company-header">
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem;">
                <div>
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-date">Generated on: {{ date('M d, Y') }}</div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 32px; font-weight: 800; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: -1px;">SS</div>
                    <div style="font-size: 11px; color: #999;">Small Shopping Site</div>
                </div>
            </div>

            <!-- Customer & Company Info -->
            <div style="display: flex; gap: 3rem;">
                <div style="flex: 1;">
                    <div class="company-info">
                        <h4>BILL TO</h4>
                        <?php $firstOrder = $orders->first(); ?>
                        @if($firstOrder)
                            <div style="margin-top: 0.5rem; line-height: 1.8;">
                                <strong>{{ $user }}</strong><br>
                                @if($firstOrder->address_line_1)
                                    {{ $firstOrder->address_line_1 }}<br>
                                @endif
                                @if($firstOrder->address_line_2)
                                    {{ $firstOrder->address_line_2 }}<br>
                                @endif
                                @if($firstOrder->city && $firstOrder->state)
                                    {{ $firstOrder->city }}, {{ $firstOrder->state }}<br>
                                @endif
                                @if($firstOrder->pincode)
                                    Pincode: {{ $firstOrder->pincode }}<br>
                                @endif
                                @if($firstOrder->mobile_no)
                                    <i>Phone: {{ $firstOrder->mobile_no }}</i>
                                @endif
                            </div>
                        @else
                            <div style="margin-top: 0.5rem;">Address not provided</div>
                        @endif
                    </div>
                </div>

                <div style="flex: 1; text-align: right;">
                    <div class="company-info">
                        <h4>FROM</h4>
                        <div style="margin-top: 0.5rem;">
                            <strong>Small Shopping Site</strong><br>
                            C-45, Sanand<br>
                            Ahmedabad, Gujarat<br>
                            India 380021<br>
                            <i>support@smallshoppingsite.com</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="margin-top">
            <table class="products">
                <tr>
                    <th style="width: 40%;">Product Name</th>
                    <th style="width: 20%; text-align: center;">Order Date</th>
                    <th style="width: 15%; text-align: center;">Quantity</th>
                    <th style="width: 25%; text-align: right;">Price</th>
                </tr>
                @foreach ($orders as $order)
                    <tr class="items">
                        <td class="product-name">{{ $order->product->title ?? 'Product' }}</td>
                        <td class="product-date" style="text-align: center;">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="qty-cell">{{ $order->quantity }}</td>
                        <td style="text-align: right; font-weight: 600; color: #667eea;">₹ {{ number_format($order->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <!-- Total Section -->
        <div class="total-section">
            <div class="total-row">
                <span class="total-label">Subtotal:</span>
                <span class="total-amount">₹ {{ number_format($totalPrice, 2) }}</span>
            </div>
            <div class="total-row">
                <span class="total-label">Tax (0%):</span>
                <span class="total-amount">₹ 0.00</span>
            </div>
            <div class="total-row">
                <span class="total-label">Shipping:</span>
                <span class="total-amount">₹ 0.00</span>
            </div>
            <div class="total-row">
                <span class="total-label">TOTAL AMOUNT</span>
                <span class="total-amount">₹ {{ number_format($totalPrice, 2) }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="thank-you">Thank You for Your Order!</div>
            <div style="margin-top: 0.8rem; border-top: 1px solid rgba(102, 126, 234, 0.3); padding-top: 0.8rem;">
                <div class="company-name">&copy; {{ date('Y') }} Small Shopping Site. All Rights Reserved.</div>
                <div style="font-size: 10px; color: #999; margin-top: 0.3rem;">
                    For support, contact us at support@smallshoppingsite.com
                </div>
            </div>
        </div>

    </main>

    <footer>
        Small Shopping Site - Order Invoice | Generated: {{ date('M d, Y H:i:s') }} | Page <span style="page-break-inside: avoid;"></span>
    </footer>

</body>

</html>
                    <tr class="items">
                        <td> {{ $order->product->title }} </td>
                        <td> {{ $order->created_at }} </td>
                        <td> {{ $order->quantity }} </td>
                        <td> {{ $order->total_price }} </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <hr>
        <table class="products">
            <tr class="items">
                <td style="text-align:left;">
                    <h3> Total </h3>
                </td>
                <td style="text-align:right; padding-right:125px;">
                    <h3> {{ $totalPrice }} </h3>
                </td>
            </tr>
        </table>

        <div class="footer margin-top">
            <div>Thank you</div>
            <div>&copy; Small Shopping Site</div>
        </div>

    </main>

</body>
</html>
