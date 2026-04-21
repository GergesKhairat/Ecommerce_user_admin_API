<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('user.wishlist.index', compact('wishlist'));
    }
    public function addToWishlist(Request $request, $id)
    {
        $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'this product already exists in your wishlist');
        }

        Wishlist::create([
            "user_id" => Auth::id(),
            "product_id" => $id,
        ]);
        return redirect()->back()->with('success', 'added to wishlist successfully');
    }
    public function destroy(Request $request, $id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();
        return redirect()->back()->with('success', 'deleted successfully');
    }
}
