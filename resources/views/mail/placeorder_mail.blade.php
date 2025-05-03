{{-- mail/placeorder_mail.blade.php  --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            color: #555;
        }

        .invoice-details {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #ddd;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: center;
        }

        .total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Invoice Header -->
        <h1>Order Invoice</h1>
        <p>Hello,</p>
        <p>We're happy to inform you that your order has been placed successfully.</p>

        <!-- Order Information -->
        <div class="invoice-details">
            <h3>Order Details:</h3>
        </div>

        <!-- Order Details Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (₹)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mailData as $product)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/product/' . $product['image']) }}"
                                alt="{{ $product['title'] }}" />

                        </td>
                        <td>{{ $product['title'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ number_format($product['total_price'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Subtotal and Closing -->
        <div class="total">
            <h3>Total Order Price: ₹{{ number_format($Total_Order_Price, 2) }}</h3>
        </div>

        <p>Thank you for shopping with us!</p>

        <p>Best regards,<br>Small Shopping Site Team</p>
    </div>
</body>

</html>
