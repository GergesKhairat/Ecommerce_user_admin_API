@extends('user.layouts.app')


@section('body')
    <div class="container">
        <h1 class="mb-4">My Wishlist</h1>

        @if ($wishlist->isEmpty())
            <div class="alert alert-info">
                Your wishlist is empty.
            </div>
        @else
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Added On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wishlist as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('user.products.show', $item->product->id) }}"
                                    class="btn btn-sm btn-primary">
                                    View
                                </a>
                                <form action="{{ route('user.wishlist.delete', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Remove from wishlist?')">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
