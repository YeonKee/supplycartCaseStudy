@extends('loginNav')

@section('body')
    <div class="flex flex-col items-center mt-32">
        <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold underline">Cart</h1>

            @if ($cartProducts->isEmpty())
                <table class="w-full">
                    <tr>
                        <th>No record found.</th>
                    </tr>
                </table>
                <div class="flex flex-col items-center justify-center">
                    <a href="/products/index"
                        class="mt-4 rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Clik Here to Browse Items!</a>
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
                        <th class="text-left">Action</th>
                    </tr>
                    @php
                        $grandTotal = 0.0;
                    @endphp
                    @foreach ($cartProducts as $cartProduct)
                        <tr>
                            <td>{{ $cartProduct->product->name }}</td>
                            <td><img src="{{ asset('/img/products/' . $cartProduct->product->image) }}" alt="Product Image"
                                    height="50" width="50" /></td>
                            <td>{{ $cartProduct->product->category }}</td>
                            <td>{{ $cartProduct->product->brand }}</td>
                            <td>{{ number_format($cartProduct->price, 2) }}</td>
                            <td>{{ $cartProduct->quantity }}</td>
                            <td>{{ number_format($cartProduct->calcProduct(), 2) }}</td>
                            <td>
                                <form method="post"
                                    action="/users/orders/cart/deleteItem/{{ $cartProduct->order_prod_id }}"
                                    class="d-inline" id="deleteForm">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" id="removeFromCart" class="action" title="Remove from Cart"
                                        onclick="return confirmDelete()">
                                        <i class="fa fa-trash fa-lg text-red-600"></i> <span
                                            class="text-red-600">Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $grandTotal += $cartProduct->calcProduct();
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="7" class="text-right pr-4 font-bold">Grand Total: </td>
                        <td colspan="1" class="font-bold">RM {{ number_format($grandTotal, 2) }}</td>
                    </tr>
                </table>
            @endif
        </section>

        @if ($cartProducts->isNotEmpty())
            <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md mt-4">
                <h1 class="mb-4 text-2xl font-semibold underline">Checkout</h1>

                <form method="POST" action="/users/orders/checkout" class="">
                    @csrf
                    <div class="mb-4 flex flex-col">
                        <label for="address" class="mb-2">Delivery Address</label>
                        <input type="text" id="address" name="address" placeholder="Jalan 10, Ampang Park"
                            class="rounded-md border px-2 py-1" value="{{ $cartProduct->order->user->address }}" />
                        @error('address')
                            <small class="text-red-600" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>

                    <div class="mb-4 flex flex-col">
                        <label for="paymentMethod" class="mb-2">Payment Method</label>
                        <select name="paymentMethod" id="paymentMethod" class="rounded-md border px-2 py-1 mr-4"
                            onchange="togglePaymentSelection()">
                            <option value="Credit/Debit">Credit/Debit Card</option>
                            <option value="COD">Cash on Delivery</option>
                        </select>

                        <div class="creditPayment" id="creditPayment">
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="name" class="mb-2 block">Name on Card</label>
                                    <input type="text" id="name" name="name" placeholder="John Doe"
                                        class="w-full rounded-md border px-2 py-1" value="{{ old('name') }}" />
                                    @error('name')
                                        <small class="text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div>
                                    <label for="cardNo" class="mb-2 block">Card Number</label>
                                    <input type="text" id="cardNo" name="cardNo" placeholder="1234 1234 1234 1234"
                                        class="w-full rounded-md border px-2 py-1" value="{{ old('cardNo') }}" />
                                    @error('cardNo')
                                        <small class="text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="cvv" class="mb-2 block">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123"
                                        class="w-full rounded-md border px-2 py-1" value="{{ old('cvv') }}" />
                                    @error('cvv')
                                        <small class="text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div>
                                    <label for="exp" class="mb-2 block">Expiration</label>
                                    <input type="text" id="exp" name="exp" placeholder="01/25"
                                        class="w-full rounded-md border px-2 py-1" value="{{ old('exp') }}" />
                                    @error('exp')
                                        <small class="text-red-600" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <button type="submit"
                                class="mt-4 rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Check
                                Out</button>
                        </div>
                    </div>
            </section>
        @endif
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to remove this product from cart?');
        }

        function togglePaymentSelection() {
            const paymentMethod = document.getElementById("paymentMethod");
            const creditPayment = document.getElementById("creditPayment");

            if (paymentMethod.value == "Credit/Debit") {
                creditPayment.classList.remove("hidden");
            } else if (paymentMethod.value == "COD") {
                creditPayment.classList.add("hidden");
            }
        }
    </script>
@endsection
