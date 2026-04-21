@extends('user.layouts.app')

@section('body')
    <div class="container py-5">
        <h2 class="mb-4">Your Shopping Cart</h2>

        {{-- 1. Authentication Check --}}
        @guest
            <div class="alert alert-info">
                Please <a href="{{ route('login') }}" class="alert-link">login</a> to save your cart and proceed to checkout.
            </div>
        @endguest

        @if ($cart && count($cart) > 0)
            <div class="row">
                <div class="col-md-8">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cart as $id => $details)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage') }}/{{ $details['image'] }}" width="50"
                                                class="rounded me-3">
                                            <span>{{ $details['name'] }}</span>
                                        </div>
                                    </td>
                                    <td>${{ $details['price'] }}</td>
                                    <td>{{ $details['quantity'] }} </td>
                                    <td>${{ $details['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 text-end">
                        <form action="{{ route('user.makeOrder') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Make Order</button>
                        </form>
                    </div>
                </div>

            </div>
        @else
            <div class="text-center py-5">
                <h4>Your cart is empty!</h4>
            </div>
        @endif
    </div>
@endsection
