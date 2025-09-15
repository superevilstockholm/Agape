@extends('layouts.Dashboard')
@section('title', 'Dashboard - Index')
@section('content')
<div class="row">
    <h3>Welcome admin {{ auth()->user()->name }} to the Dashboard 🎉</h3>
    <p>This is your admin panel.</p>
</div>
@endsection
