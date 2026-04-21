<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            @forelse ($products as $product)
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="{{ route('user.products.show', $product->id) }}"><img
                                src="{{ asset("storage/$product->image") }}" alt=""></a>
                        <div class="down-content">
                            <a href="{{ route('user.products.show', $product->id) }}">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <h6>{{ $product->price }}</h6>
                            <p>{{ $product->desc }}</p>
                            <span>quantity: ({{ $product->quantity }})</span>
                        </div>
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
            @empty
                <div>No Data Founded</div>
            @endforelse

        </div>
        {{ $products->links() }}
    </div>
</div>
