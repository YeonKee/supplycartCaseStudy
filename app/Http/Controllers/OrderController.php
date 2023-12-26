<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Order_Product;
use App\Models\Product;
use App\Models\Log;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::where('user_id', $request->session()->get('userID'))
            ->whereNot('status', 'Cart')
            ->paginate(15);

        return view('/user/order/index')->with('orders', $orders);
    }

    /**
     * Display a listing of the resource.
     */
    public function cart(Request $request)
    {
        $user = User::find($request->session()->get('userID'));
        $cart = $user->getCart();

        if ($cart == null) {      // If cart not yet created
            $cart = $user->createCart();
        }

        // Get all products in cart
        $cartProducts = Order_Product::where('order_id', $cart->order_id)->get();

        return view('/user/order/cart')->with('cartProducts', $cartProducts);
    }

    /**
     * Remove item from cart.
     */
    public function deleteItem($id, Request $request)
    {
        $orderProduct = Order_Product::find($id);
        $product = Product::find($orderProduct->prod_id);
        $orderProduct->delete();

        // Log for success cart item removal
        $log = new Log();
        $log->user_id = $request->session()->get('userID');
        $log->description = "You have removed product " . $product->name . " from your cart.";
        $log->save();

        Alert::success('Removed Successfully!', 'The product has been removed from your cart!');
        return redirect()->back();
    }

    /**
     * Check out item in cart.
     */
    public function checkout(Request $request)
    {
        $validators = [
            'address' => 'required|max:255'
        ];

        $errMsgs = [
            'address.required' => 'Address should not be empty. ',
        ];

        if ($request->paymentMethod == "Credit/Debit") {
            $paymentValidators = [
                'name' => 'required|max:100|regex:/^[A-Za-z ]+$/',
                'cardNo' => ['required', 'regex:/^((4\d{3})|(5[1-5]\d{2})|(6011)|(34\d{1})|(37\d{1}))-?\s?\d{4}-?\s?\d{4}-?\s?\d{4}|3[4,7][\d\s-]{15}$/'],
                'exp' => ['required', 'regex:/^(0[1-9]|1[0-2]|[1-9])\/(1[4-9]|[2-9][0-9]|[1-9][1-9])$/'],
                'cvv' => 'required|regex:/^\d{3,4}$/'
            ];

            $paymentErrMsgs = [
                'name.required' => 'Name should not be empty.',
                'name.regex' => 'Name should contains alphabets only.',
                'cardNo.required' => 'Card Number should not be empty.',
                'cardNo.regex' => 'Card Number should be in correct format (Ex: 1234 1234 1234 1234)',
                'exp.required' => 'Card Number Expiration should not be empty.',
                'exp.regex' => 'Card Number Expiration should be in correct format (Ex: mm/yyyy)',
                'cvv.required' => 'CVV should not be empty.',
                'cvv.regex' => 'CVV should should be in correct format (Ex: 123)'
            ];

            $validators = array_merge($validators, $paymentValidators);
            $errMsgs = array_merge($errMsgs, $paymentErrMsgs);
        }

        $validated = $request->validate($validators, $errMsgs);

        $user = User::find($request->session()->get('userID'));
        $cart = $user->getCart();

        // Get all items in cart
        $cartProducts = Order_Product::where('order_id', $cart->order_id)->get();

        // Update product sold quantity
        foreach ($cartProducts as $cartProduct) {
            $product = Product::find(($cartProduct->product->prod_id));
            $product->sold_quantity += $cartProduct->quantity;
            $product->save();
        }

        // Update order table (Cart changed to paid)
        $cart->status = 'Paid';
        $cart->payment_method = $request->paymentMethod;
        $cart->delivery_address = $request->address;
        $cart->save();

        // Increase point for user + upgrade rank
        $user->point += (int) $cart->calcTotal();
        $newRank = $user->getRank($user->point);
        $user->rank = $newRank;
        $user->save();

        $request->session()->put('userRank', $user->rank);

        // Log for success making purchase
        $log = new Log();
        $log->user_id = $request->session()->get('userID');
        $log->description = "You have make a purchase for order " . $cart->order_id . ".";
        $log->save();

        return view('user.order.successPurchase');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get user details
        $user = User::find($request->session()->get('userID'));

        $cart = $user->getCart();
        $prodID = $request->prod_id;

        // Create new cart to hold product if no cart available
        if (!$cart) {
            $cart = $user->createCart();
        }

        // If quantity > available quantity, return back
        if ($request->quantity > $request->available) {
            Alert::success('Fail to Add!', 'You have selected a maximum capacity! (Max: ' . $request->available . ')');
            return redirect()->back();
        } else if ($request->quantity == 0) {
            Alert::success('Fail to Add!', 'You cannot add 0 quantity!');
            return redirect()->back();
        } else {
            // Get all products from current cart
            $cartProduct = $cart->getCartItem($prodID);

            if ($cartProduct != null) {
                $cartProduct->quantity += $request->quantity;
                $cartProduct->save();
            } else {
                $newCartProduct = new Order_Product();
                $newCartProduct->order_id = $cart->order_id;
                $newCartProduct->prod_id = $request->prod_id;
                $newCartProduct->quantity = $request->quantity;
                $newCartProduct->price = $request->price;
                $newCartProduct->save();
            }

            // Get product details
            $product = Product::find($prodID);

            // Log for success add to cart
            $log = new Log();
            $log->user_id = $request->session()->get('userID');
            $log->description = "You have added product " . $product->name . " x" . $request->quantity . " into your cart.";
            $log->save();

            Alert::success('Added Successfully!', 'The product has been added to your cart! ');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get all products in order & order
        $order = Order::where('order_id', $id)->first();
        $orderProducts = Order_Product::where('order_id', $id)->get();

        return view('/user/order/orderDetails', compact('orderProducts', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Order $order__Product)
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
