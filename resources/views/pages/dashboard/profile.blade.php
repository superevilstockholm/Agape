@extends('layouts.dashboard')
@section('title', 'Dashboard - Profile')
@section('content')
    <div class="row justify-content-center my-4">
        <div class="col-md-6 col-12 text-center">
            <a href="/dashboard/users">
                <img id="profile-picture" src="{{ asset('static/img/no_image_placeholder.png') }}"
                    class="rounded-circle mb-3 border border-2 border-light shadow" width="180" height="180" alt="Profile Picture">
                <h4 id="profile-name" class="mb-1 text-success fw-semibold">Loading...</h4>
                <p id="profile-email" class="text-muted">Loading...</p>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-12 my-4">
            <h2 class="text-center">Latest News</h2>
        </div>
    </div>
    <div class="row g-3" id="news-list">
        <!-- News cards akan dimasukkan di sini -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const newsContainer = document.getElementById('news-list');
            function createNewsCard(news) {
                return `
                    <div class="col-lg-4 col-md-6 col-12">
                        <a href="/dashboard/news">
                            <div class="card h-100 shadow-sm">
                                <img src="${news.image_url}" class="card-img-top object-fit-cover w-100 h-100" style="max-height: 170px; object-position: center;" alt="${news.title}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title p-0 mb-1">${news.title}</h5>
                                    <p class="card-text text-truncate" style="max-height: 4.5em;">${news.content.replace(/(<([^>]+)>)/gi, "")}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                `;
            }
            try {
                const response = await axios.get('/api/user/profile', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${getCookie('auth_token')}`
                    }
                });
                if (response.data.status) {
                    const profile = response.data.data.user;
                    document.getElementById('profile-name').textContent = profile.name ?? '-';
                    document.getElementById('profile-email').textContent = profile.email ?? '-';
                    document.getElementById('profile-picture').src = profile.url_profile_picture ??
                        "{{ asset('static/img/no_image_placeholder.png') }}";
                    const newsList = response.data.data.news;
                    if (newsList.length) {
                        newsContainer.innerHTML = newsList.map(n => createNewsCard(n)).join('');
                    } else {
                        newsContainer.innerHTML = '<p class="text-center text-muted">No news available</p>';
                    }
                } else {
                    document.getElementById('profile-name').textContent = 'Failed to load profile';
                    document.getElementById('profile-email').textContent = '';
                }
            } catch (err) {
                console.error(err);
                document.getElementById('profile-name').textContent = 'Failed to load profile';
                document.getElementById('profile-email').textContent = '';
                newsContainer.innerHTML = '<p class="text-center text-danger">Failed to load news</p>';
            }
        });
    </script>
@endsection
