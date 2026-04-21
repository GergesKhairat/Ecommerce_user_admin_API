@extends('user.layouts.app')
@section('body')
    <div class="container">
        <h1 class="mb-4">Orders</h1>

        @if ($orders->isEmpty())
            <div class="alert alert-info">
                No orders found.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Placed At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span
                                    class="badge
                                @if ($order->status === 'pending') bg-warning
                                @elseif($order->status === 'completed') bg-success
                                @else bg-secondary @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <a href="{{ route('user.order.show', $order->id) }}" class="btn btn-sm btn-primary">
                                    View Details
                                </a>
                                {{-- <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">
                                        Delete
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            {{-- <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div> --}}
        @endif
    </div>
@endsection
