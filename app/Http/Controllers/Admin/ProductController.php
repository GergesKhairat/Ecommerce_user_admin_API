<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Crud Operations
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }
    //create form
    public function createForm()
    {
        return view("admin.product.create");
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "desc" => "required|string",
            "price" => "required|numeric",
            "quantity" => "required|integer",
            "image" => "required|image|mimes:png,jpg,jpeg"
        ]);

        //storage
        $data['image'] = Storage::putFile("products", $request->image);
        Product::create($data);
        session()->flash("success", "Product Added Successfully");
        return redirect()->route('admin.products.all');
    }
    //delete
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();
        session()->flash("success", "product deleted successfully");
        return redirect()->route('admin.products.all');
    }
    //update
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit')->with('product', $product);
    }
    public function update($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $data = $request->validate([
            "name" => "required|string|max:20",
            "desc" => "required|string",
            "price" => "required|numeric",
            "quantity" => "required|numeric",
            "image" => "image|mimes:png,jpg,jpeg"
        ]);
        if ($request->has('image')) {
            Storage::delete($product->image);
            $data['image'] = Storage::putFile("products", $request->image);
        } else {
            $data['image'] = $product->image;
        }
        $product->update($data);
        session()->flash("success", "updated successfully");
        return redirect()->route('admin.products.all');
    }
}
