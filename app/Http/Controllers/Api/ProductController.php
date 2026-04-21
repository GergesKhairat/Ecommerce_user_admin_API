<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //Crud Operations
    public function index()
    {
        $products = Product::all();
        if ($products) {
            return ProductResource::collection($products);
        } else {
            return response()->json([
                "msg" => "No Data Founded"
            ], 404);
        }
    }
    //show one
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return new ProductResource($product);
        } else {
            return response()->json([
                "msg" => "No Data Founded"
            ], 404);
        }
    }


    //storing
    public function store(Request $request)
    {
        //validation
        $errors = Validator::make($request->all(), [
            "name" => "required|string",
            "desc" => "required|string",
            "price" => "required|numeric",
            "quantity" => "required|integer",
            "image" => "required|image|mimes:png,jpg,jpeg"
        ]);
        if ($errors->fails()) {
            return response()->json([
                "error" => $errors->errors()
            ], 301);
        }
        //storage
        $image = Storage::putFile("products", $request->image);
        $product = Product::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "image" => $image,
        ]);
        return response()->json([
            "msg" => "Product created successfully"
        ], 201);
    }

    //update
    public function update($id, Request $request)
    {
        $product = Product::find($id);
        if ($product) {
            $errors = Validator::make($request->all(), [
                "name" => "required|string",
                "desc" => "required|string",
                "price" => "required|numeric",
                "quantity" => "required|integer",
                "image" => "image|mimes:png,jpg,jpeg"
            ]);
            if ($errors->fails()) {
                return response()->json([
                    "error" => $errors->errors()
                ], 301);
            }
        } else {
            return response()->json([
                "msg" => "No Data Founded"
            ], 404);
        }

        if ($request->has('image')) {
            Storage::delete($product->image);
            $image = Storage::putFile("products", $request->image);
        } else {
            $image = $product->image;
        }
        $product->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "image" => $image,
        ]);
        return response()->json([
            "msg" => "updated successfully",
            "product" => new ProductResource($product)
        ], 201);
    }
    //delete
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return response()->json([
                "msg" => "No Data Founded"
            ], 404);
        }
        if ($product->image != null) {
            Storage::delete($product->image);
        }
        $product->delete();
        return response()->json([
            "msg" => "Deleted successfully",
        ], 201);
    }
}
