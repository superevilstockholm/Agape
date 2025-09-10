@extends('App')
@section('layout')
    {{-- Main Wrapper --}}
    <div class="main-wrapper">
        @include('components.topbar')
        @include('components.sidebar')
        <main>
            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <style>
        .header {
            background: #1a7021 !important;
            background: linear-gradient(to right, #699834 0%, #a6d96a 100%) !important;
        }
    </style>
@endsection
