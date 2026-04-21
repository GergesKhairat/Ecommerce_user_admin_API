@extends('user.layouts.app')
@section('body')
    <div class="best-features">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>About {{ $product->name }}</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="left-content">
                        <h4>Product Name: {{ $product->name }}</h4>
                        <p>Description: {{ $product->desc }}</p>
                        <ul class="featured-list">
                            <li><a href="#">Price: {{ $product->price }}</a></li>
                            <li><a href="#">Quantity: {{ $product->quantity }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="{{ asset("storage/$product->image") }}" alt="">
                    </div>
                </div>
                <div>
                    @if ($product->quantity > 0)
                        <form action="{{ route('user.addToCart', $product->id) }}" method="POST">
                            @csrf
                            <input type="number" name="quantity" placeholder="Quantity">
                            <button type="submit" class="btn btn-primary">Add To Cart</button>
                        </form>
                    @else
                        <form action="{{ route('user.addToWishlist', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add To wishlist</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
