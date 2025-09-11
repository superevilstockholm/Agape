<!-- Header -->
<div class="header">
    <!-- Logo -->
    <div class="header-left">
        <a href="{{ route('dashboard.index') }}" class="logo">
            <img src="{{ asset('static/img/logo.png') }}" width="40" height="40" alt="Logo Yayasan Agape Hijau Abadi">
        </a>
        <a href="{{ route('dashboard.index') }}" class="logo2">
            <img src="{{ asset('static/img/logo.png') }}" width="40" height="40" alt="Logo Yayasan Agape Hijau Abadi">
        </a>
    </div>
    <!-- /Logo -->
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    <!-- Header Menu -->
    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('static/template_assets/img/profiles/avatar-21.jpg') }}" alt="">
                    <span class="status online"></span></span>
                <span>{{ auth()->user()->name ?? 'Guest' }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="settings.html">Settings</a>
                <button class="dropdown-item logout-button" role="button">Logout</button>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a class="dropdown-item" href="settings.html">Settings</a>
            <button class="dropdown-item logout-button" role="button">Logout</button>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
<!-- /Header -->
<script>
    const logoutButton = document.querySelector('.logout-button');
    logoutButton.addEventListener('click', async function() {
        const token = getCookie('auth_token');
        await axios.post('/api/logout', {}, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        }).then((response) => {
            if (response.data.status === true) {
                Swal.fire({
                    title: 'Success',
                    text: response.data.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            window.location.href = '/login';
        }).catch((error) => {
            if (error.response?.status === 401) {
                Swal.fire({
                    title: 'Unauthorized',
                    text: error.response.data.message,
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: "Terjadi kesalahan saat melakukan logout",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
            window.location.href = '/login';
        })
    });
</script>
