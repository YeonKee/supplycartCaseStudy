@extends('loginNav')

@section('body')
    <div class="flex flex-col items-center mt-32">
        <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold underline">Orders</h1>
            @if ($orders->isEmpty())
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
                <table class="w-full divide-4">
                    <tr>
                        <th class="text-left h-8">Order ID</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Payment Method</th>
                        <th class="text-left">Delivery Address</th>
                        <th class="text-left">Action</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="h-8">{{ $order->order_id }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->delivery_address }}</td>
                            <td>
                                <form method="GET" action="/users/orders/viewOrderDetail/{{ $order->order_id }}">
                                    <button type="submit" id="viewBtn" title="View">
                                        <i class="fa fa-eye fa-lg"></i> View Details
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
        </section>
        <div class="flex justify-center mt-4">
            {{ $orders->links() }}
        </div>
        @endif
    @endsection
