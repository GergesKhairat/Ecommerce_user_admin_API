<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::hasUser()) {
            $role = Auth::user()->role;
            if ($role == 1) {
                return view('admin.dashboard');
            } else {
                $products = Product::paginate(3);
                return view('user.dashboard')->with('products', $products);
            }
        } else {
            $products = Product::paginate(3);
            return view('user.dashboard')->with('products', $products);
        }
    }
}
