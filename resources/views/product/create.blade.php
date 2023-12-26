@extends('loginNav')

@section('body')
    <style>
        body {
            overflow: hidden;
        }
    </style>

    <div class="flex h-screen flex-col items-center justify-center">
        <section class="w-2/5 rounded-md bg-gray-100 p-6 shadow-md">
            <h1 class="mb-4 text-2xl font-semibold">Add Product</h1>

            <form method="POST" action="/products/store" class="" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 flex flex-col">
                    <label for="name" class="mb-2">Name</label>
                    <input type="text" id="name" name="name" placeholder="Apple"
                        class="w-full rounded-md border px-2 py-1" />
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="image" class="mb-2">Image</label>
                    <input type="file" id="image" name="image" accept="image/png, image/jpeg"
                        class="rounded-md border px-2 py-1" />
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="category" class="mb-2">Category</label>
                    <select name="category" id="category" class="rounded-md border px-2 py-1">
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
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="brand" class="mb-2">Brand</label>
                    <select name="brand" id="brand" class="rounded-md border px-2 py-1">
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
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="price" class="mb-2">Price</label>
                    <input type="text" id="price" name="price" placeholder="12.00"
                        class="rounded-md border px-2 py-1" />
                </div>

                <div class="mb-4 flex flex-col">
                    <label for="quantity" class="mb-2">Total Quantity</label>
                    <input type="text" id="quantity" name="quantity" placeholder="100"
                        class="rounded-md border px-2 py-1" />
                </div>

                <div class="flex flex-col items-center justify-center">
                    <button type="submit"
                        class="mt-4 rounded-full bg-gray-500 hover:bg-gray-700 px-4 py-2 font-bold text-white">Add Product</button>
                </div>

            </form>
        </section>
    </div>
@endsection
