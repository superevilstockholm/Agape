@extends('layouts.dashboard')
@section('title', 'Dashboard - Profile')
@section('content')
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-12">
            <img id="profile-picture" src="{{ asset('static/img/no_image_placeholder.png') }}"
                    class="rounded-circle mb-3" width="200" height="200" alt="Profile Picture">
            <h4 id="profile-name" class="mb-1">Loading...</h4>
            <p id="profile-email" class="text-muted">Loading...</p>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                const response = await axios.get('/api/user/profile', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${getCookie('auth_token')}`
                    }
                });
                if(response.data.status) {
                    const profile = response.data.data;
                    document.getElementById('profile-name').textContent = profile.name ?? '-';
                    document.getElementById('profile-email').textContent = profile.email ?? '-';
                    document.getElementById('profile-picture').src = profile.url_profile_picture ??
                        "{{ asset('static/img/no_image_placeholder.png') }}";
                } else {
                    document.getElementById('profile-name').textContent = 'Failed to load profile';
                    document.getElementById('profile-email').textContent = '';
                }
            } catch(err) {
                console.error(err);
                document.getElementById('profile-name').textContent = 'Failed to load profile';
                document.getElementById('profile-email').textContent = '';
            }
        });
    </script>
@endsection
