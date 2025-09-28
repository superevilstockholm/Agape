@extends('App')
@section('layout')
    {{-- Main Wrapper --}}
    <div class="main-wrapper">
        <x-topbar-component />
        <x-sidebar-component />
        <main>
            <!-- Page Wrapper -->
            <div class="page-wrapper">
                <!-- Page Content -->
                <div class="content container">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    <style>
        .header {
            background: #1a7021 !important;
            background: linear-gradient(to right, #a8e063 0%, #56ab2f 100%) !important;
        }
    </style>
@endsection
