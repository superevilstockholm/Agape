@extends('App')
@section('layout')
@if (data_get($meta, 'show_navbar', true))
    @include('components.navbar_component')
@endif
<main>
    @yield('content')
</main>
@if (data_get($meta, 'show_footer', true))
    @include('components.footer_component')
@endif
@endsection
