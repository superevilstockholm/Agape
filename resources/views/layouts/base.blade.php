@extends('App')
@section('layout')
<x-loading-overlay-component />
@if (data_get($meta, 'show_navbar', true))
    <x-navbar-component />
@endif
<main>
    @yield('content')
</main>
@if (data_get($meta, 'show_footer', true))
    <x-footer-component />
@endif
@endsection
