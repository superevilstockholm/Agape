@extends('App')
@section('layout')
@include('components.navbar_component')
<main>
    @yield('content')
</main>
@include('components.footer_component')
@endsection
