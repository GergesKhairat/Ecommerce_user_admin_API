@extends('user.layouts.app')


@section('body')
    <div class="container">
        <h1 class="mb-4">Order #{{ $order->id }}</h1>

        {{-- Customer Info --}}
        <div class="card mb-4">
            <div class="card-header">Customer Information</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="card mb-4">
            <div class="card-header">Order Summary</div>
            <div class="card-body">
                <p><strong>Status:</strong>
                    <span
                        class="badge
                    @if ($order->status === 'pending') bg-warning
                    @elseif($order->status === 'completed') bg-success
                    @else bg-secondary @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                <p><strong>Placed At:</strong> {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="card mb-4">
            <div class="card-header">Items</div>
            <div class="card-body">
                @if ($order->items->isEmpty())
                    <p>No items in this order.</p>
                @else
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <a href="{{ route('user.order.all') }}" class="btn btn-secondary mt-3">back to my orders</a>
            </div>
        </div>

        {{-- Actions --}}
        {{-- <div class="d-flex gap-2">
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit Order</a>
        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('Delete this order?')">
                Delete Order
            </button>
        </form>
    </div> --}}
    </div>
@endsection
