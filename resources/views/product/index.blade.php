@extends('loginNav')

@section('body')
    <style>
        body {
            overflow: hidden;
        }
    </style>
    <div class="flex h-screen flex-col items-center mt-32">
        <div class="flex flex-row justify-between w-4/5">
            <form class="flex justify-end" method="GET" action="/products/sort" id="sortingForm">
                @csrf
                <div class="mb-4 flex">
                    <select name="sortBy" id="sortBy" class="rounded-md border px-2 py-1 mr-4"
                        onchange="toggleFilterSelection()">
                        <option value="Brand">Brand</option>
                        <option value="Category">Category</option>
                    </select>

                    <select name="brand" id="brand" class="rounded-md border px-2 py-1 mr-4">
                        <option value="Maggi">Maggi</option>
                        <option value="Nestle">Nestle</option>
                        <option value="Nescafe">Nescafe</option>
                        <option value="Rejoice">Rejoice</option>
                        <option value="Faber-Castell">Faber-Castell</option>
                        <option value="Padini">Padini</option>
                        <option value="F&N">F&N</option>
                        <option value="Apple">Apple</option>
                        <option value="Samsung">Samsung</option>
                        <option value="Others">Others</option>
                    </select>

                    <select name="category" id="category" class="rounded-md border px-2 py-1 mr-4 hidden">
                        <option value="Fruits">Fruits</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Shoes">Shoes</option>
                        <option value="Food">Food</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Stationary">Stationary</option>
                        <option value="Health & Beauty">Health & Beauty</option>
                        <option value="Gadgets">Gadgets</option>
                        <option value="Others">Others</option>
                    </select>

                    <button type="submit"
                        class="rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white mr-4">Filter</button>

                    <a href="/products/index"
                        class="rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Clear Filter</a>
                </div>
            </form>
        </div>
        <section class="w-4/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold underline">Products</h1>

            @php
                $count = $products->firstItem();
            @endphp

            @if ($count == 0)
                <table class="w-full">
                    <tr>
                        <th>No record found.</th>
                    </tr>
                </table>
            @else
                <table class="w-full">
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Image</th>
                        <th class="text-left">Category</th>
                        <th class="text-left">Brand</th>
                        <th class="text-left">Price(RM)</th>
                        <th class="text-left">Available Quantity</th>
                        <th class="text-left">Purchase Quantity</th>
                        <th class="text-left">Action</th>
                    </tr>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $product->name }}</td>
                            <td><img src="{{ asset('/img/products/' . $product->image) }}" alt="Product Image"
                                    height="50" width="50" /></td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ number_format($product->new_price, 2) }}</td>
                            <td>{{ $product->available_quantity }}</td>
                            <form method="post" action="/users/orders/store" class="d-inline" id="orderForm">
                                @csrf
                                <input type="hidden" name="prod_id" id="prod_id" value="{{ $product->prod_id }}">
                                <input type="hidden" name="available" id="available"
                                    value="{{ $product->available_quantity }}">
                                <input type="hidden" name="price" id="price"
                                    value="{{ $product->new_price }}">
                                <td><input type="number" name="quantity" id="quantity" class="w-24" value="1"
                                        min="1" max="{{ $product->available_quantity }}"></td>
                                <td><button type="submit" id="addToCart" class="action" title="Add to Cart">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </td>
                            </form>
                        </tr>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                </table>
            @endif
        </section>
        <div class="flex justify-center mt-4">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        function toggleFilterSelection() {
            const sortBy = document.getElementById("sortBy");
            const brand = document.getElementById("brand");
            const category = document.getElementById("category");

            if (sortBy.value == "Brand") {
                brand.classList.remove("hidden");
                category.classList.add("hidden");
            } else if (sortBy.value == "Category") {
                brand.classList.add("hidden");
                category.classList.remove("hidden");
            }
        }
    </script>
@endsection
