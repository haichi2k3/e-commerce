<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .subTotal {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <p>{{ $data['body'] }}</p>
        <h2>Review & Payment</h2>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $subTotal = 0;
                @endphp
                @if (count($cart) > 0)
                    @foreach ($cart as $productId => $item) 
                        @php
                            $product = $products->where('id', $productId)->first();
                            $total = $product->price * $item['qty'];
                            $subTotal += $total;
                        @endphp
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->price }}</td>
                            <td>{{ $item['qty'] }}</td>
                            <td>${{ $total }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="3">Cart Sub Total</td>
                            <td class="subTotal">${{ $subTotal }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Exo Tax</td>
                            <td>$2</td>
                        </tr>
                        <tr>
                            <td colspan="3">Shipping Cost</td>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <td colspan="3">Total</td>
                            <td class="subTotal">${{ $subTotal + 2 }}</td>
                        </tr>
                @else 
                <tr>
                    <td colspan="4">Giỏ hàng trống.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
