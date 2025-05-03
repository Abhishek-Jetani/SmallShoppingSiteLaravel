<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style>
        header {
            position: fixed;
            top: -60px;
            height: 50px;
            width: 100%;
            color: black;
            font-size: 25px;
            text-align: center;
            line-height: 35px;
            padding-top: 15px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            height: 50px;
            width: 100%;
            background-color: #000000;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            padding: 0.5rem;
            text-align: left
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }
    </style>

</head>

<body>

    <header>
        Small Shopping Site
        <hr>
    </header>

    <main>
        <table class="w-full mt-2">
            <tr>
                {{-- <td class="w-half">
                    <img src="https://www.shutterstock.com/shutterstock/photos/2270561027/display_1500/stock-vector-amazon-logo-icon-logo-sign-art-design-symbol-famous-industry-jeff-bezos-corporate-text-isolated-2270561027.jpg" alt="laravel daily" width="200" />
                </td> --}}
                <td class="w-half">
                    {{-- <h2>Invoice ID: 1234565432123432343233</h2> --}}
                </td>
            </tr>
        </table>
        <div class="margin-top">
            <table class="w-full">
                <tr>
                    <td class="w-half">
                        <div>
                            <h4>To: {{ $user }}</h4>
                        </div>
                        <div>new factory </div>
                        <div>A-12, Iscon Cross Road, </div>
                        <div> Ahmedabad</div>
                    </td>
                    <td class="w-half">
                        <div>
                            <h4>From: Small Shopping Site</h4>
                        </div>
                        <div>C-45, Sanand </div>
                        <div>Ahmedabad, Gujarat, India</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="margin-top">
            <table class="products">
                <tr>
                    <th>Product Name</th>
                    <th>Order Date</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                @foreach ($orders as $order)
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
