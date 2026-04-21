@extends('admin.layouts.app')
@section('body')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Desc</th>
                <th scope="col">Aciton</th>
            </tr>
        </thead>
        <tbody>
            @include('admin.errors')
            @if (count($products) <= 0)
                <td style="text-align: center;color:white" colspan="6"><b>No Products To Display</b></td>
            @endif
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->desc }}</td>
                    <td><a href="{{ asset("storage/$product->image") }}"><img src="{{ asset("storage/$product->image") }}"
                                width="100px" alt="" srcset=""></a></td>
                    <td>
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button>
                        </form>
                        <h1>
                            <a class="btn btn-success" href="{{ route('admin.products.edit', $product->id) }}">edit</a>
                        </h1>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
