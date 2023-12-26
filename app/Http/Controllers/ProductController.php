<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get user discount
        $user = User::where('user_id', $request->session()->get('userID'))->first();
        $discount = $user->getDisocunt($user->rank);

        $products = Product::paginate(5);

        $products->getCollection()->transform(function ($product) use ($discount) {
            $product->available_quantity = $product->total_quantity - $product->sold_quantity;
            $product->new_price = $product->price * $discount;
            return $product;
        });

        return view('/product/index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/product/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Save image into img file
        $image = $request->file('image');
        $imageExt = $image->getClientOriginalExtension();   // Get extension

        $imageName = bin2hex(random_bytes(5)) . '.' . $imageExt;    // Assign unique name
        $filePath = public_path('img/products');

        $image->move($filePath, $imageName);

        $newProduct = new Product();
        $newProduct->name = $request->name;
        $newProduct->image = $imageName;
        $newProduct->category = $request->category;
        $newProduct->brand = $request->brand;
        $newProduct->price = $request->price;
        $newProduct->total_quantity = $request->quantity;
        $newProduct->sold_quantity = 0;
        $newProduct->save();

        Alert::success('Added Successfully!', 'Product has been added successfully.');

        return redirect()->back();
    }

    public function sort(Request $request)
    {
        // Get user discount
        $user = User::where('user_id', $request->session()->get('userID'))->first();
        $discount = $user->getDisocunt($user->rank);

        $sortBy = $request->sortBy;

        if ($sortBy == 'Brand') {
            $products = Product::where("Brand", $request->brand)->paginate(5);
        } else if (($sortBy == 'Category')) {
            $products = Product::where("Category", $request->category)->paginate(5);
        }

        $products->transform(function ($product) use ($discount) {
            $product->available_quantity = $product->total_quantity - $product->sold_quantity;
            $product->new_price = $product->price * $discount;
            return $product;
        });

        return view('/product/index')->with('products', $products);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
