@extends('loginNav')

@section('body')
    <div class="flex flex-col items-center mt-32">
        <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md">
            <div>
                <a href="/users/orders/index" class="mt-4 rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Return</a>
            </div>

            <h1 class="mt-4 mb-4 text-2xl font-semibold underline">Order ID: {{ $order->order_id }}</h1>

            @if ($orderProducts->isEmpty())
                <table class="w-full">
                    <tr>
                        <th>No record found.</th>
                    </tr>
                </table>
                <div class="flex flex-col items-center justify-center">
                    <a href="/products/index"
                        class="mt-4 rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Clik Here to
                        Browse Items!</a>
                </div>
            @else
                <table class="w-full">
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Image</th>
                        <th class="text-left">Category</th>
                        <th class="text-left">Brand</th>
                        <th class="text-left">Unit Price(RM)</th>
                        <th class="text-left">Purchase Quantity</th>
                        <th class="text-left">Total Price(RM)</th>
                    </tr>
                    @php
                        $grandTotal = 0.0;
                    @endphp
                    @foreach ($orderProducts as $orderProduct)
                        <tr>
                            <td>{{ $orderProduct->product->name }}</td>
                            <td><img src="{{ asset('/img/products/' . $orderProduct->product->image) }}" alt="Product Image"
                                    height="50" width="50" /></td>
                            <td>{{ $orderProduct->product->category }}</td>
                            <td>{{ $orderProduct->product->brand }}</td>
                            <td>{{ number_format($orderProduct->price, 2) }}</td>
                            <td>{{ $orderProduct->quantity }}</td>
                            <td>{{ number_format($orderProduct->calcProduct(), 2) }}</td>
                        </tr>
                        @php
                            $grandTotal += $orderProduct->calcProduct();
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-right pr-4 font-bold">Grand Total: </td>
                        <td colspan="1" class="font-bold">RM {{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </table>
            @endif
        </section>

        <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md mt-4">
            <h1 class="mb-4 text-2xl font-semibold underline">Checkout</h1>
            <table class="w-full">
                <tr>
                    <th class="text-left h-8">Payment Mode</th>
                    <td>{{ $order->payment_method }}</td>
                </tr>
                <tr>
                    <th class="text-left h-8">Status</th>
                    <td>{{ $order->status }}</td>
                </tr>
                <tr>
                    <th class="text-left h-8">Delivery Address</th>
                    <td>{{ $order->delivery_address }}</td>
                </tr>
                <tr>
                    <th class="text-left h-8">Payment Made</th>
                    <td>{{ $order->created_at }}</td>
                </tr>

            </table>
        </section>
    </div>
@endsection
