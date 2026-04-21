@extends('admin.layouts.head')
<div class="container-scroller">

    @include('admin.layouts.side')
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.layouts.nav')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                {{-- @include('admin.layouts.body') --}}
                @yield('body')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @extends('admin.layouts.footer')
