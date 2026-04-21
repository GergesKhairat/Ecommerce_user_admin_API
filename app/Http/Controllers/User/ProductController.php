<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //show
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.product.show', compact('product'));
    }
    //view cart
    public function cart()
    {
        $cart = session()->get('cart');
        return view('user.cart.index', compact('cart'));
    }
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        //catch
        $quantity = $request->quantity;
        //session---cart
        $cart = session()->get('cart');
        if ($quantity <= $product->quantity) {
            if (!$cart) {
                $cart = [
                    $id => [
                        "name" => $product->name,
                        "price" => $product->price,
                        "quantity" => $quantity,
                        "image" => $product->image,
                        "total" => $product->price * $quantity
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->back();
            } else {
                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] += $quantity;
                    $cart[$id]['total'] = $product->price * $cart[$id]['quantity'];
                } else {
                    $cart[$id] = [
                        "name" => $product->name,
                        "price" => $product->price,
                        "quantity" => $quantity,
                        "image" => $product->image,
                        "total" => $product->price * $quantity
                    ];
                }
                session()->put('cart', $cart);
                return redirect()->back();
            }
        } else {
            return redirect()->back()->with('error', 'out of Stock');
        }
    }
}
