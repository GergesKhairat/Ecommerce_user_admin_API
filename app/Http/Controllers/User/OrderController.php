<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view("user.order.index", compact('orders'));
    }
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('user.order.show', compact('order'));
    }
    public function makeOrder(Request $request)
    {
        $cart = session()->get('cart');
        $total_price = 0;
        if (!$cart) {
            return redirect()->back()->with("error", "cart is empty");
        }
        foreach ($cart as $key => $value) {
            $total_price += $value['total'];
        }
        $order = Order::create([
            "user_id" => Auth::id(),
            "total_price" => $total_price,
            "status" => "pending"
        ]);
        //products

        foreach ($cart as $id => $value) {
            $product = Product::findOrFail($id);
            if ($product->quantity < $value['quantity']) {
                return redirect()->back()->with('error', 'out of Stock');
            }
            $order->items()->create([
                "product_id" => $id,
                "quantity" => $value['quantity'],
                "price" => $value['price'],

            ]);
            //stock?
            $product->quantity -= $value['quantity'];
            $product->save();
        }
        session()->forget('cart');
        return redirect()->route('home')->with('success', "Order created success");
    }
}
