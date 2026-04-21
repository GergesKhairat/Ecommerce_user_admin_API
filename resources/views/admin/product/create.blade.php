{{-- @include('admin.errors')
@include('admin.success') --}}
@extends('admin.layouts.app')
@section('body')
    @include('admin.errors')
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">{{ __('message.product Name') }}</label>
            <input type="text" name="name" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter name">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">{{ __('message.product desc') }}</label>
            <textarea type="text" name="desc" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter desc"></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">{{ __('message.product Price') }}</label>
            <input type="number" name="price" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter price">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">{{ __('message.product quantity') }}</label>
            <input type="text" name="quantity" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter price">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">{{ __('message.product image') }}</label>
            <input type="file" name="image" class="form-control text-white" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter email">
        </div>

        <button type="submit" class="btn btn-primary">{{ __("message.Submit") }}</button>
    </form>
@endsection
