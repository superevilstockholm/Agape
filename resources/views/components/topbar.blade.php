<!-- Header -->
<div class="header">
    <!-- Logo -->
    <div class="header-left">
        <a href="{{ route('dashboard.index') }}" class="logo">
            <img src="{{ asset('static/img/logo.png') }}" width="40" height="40"
                alt="Logo Yayasan Agape Hijau Abadi">
        </a>
        <a href="{{ route('dashboard.index') }}" class="logo2">
            <img src="{{ asset('static/img/logo.png') }}" width="40" height="40"
                alt="Logo Yayasan Agape Hijau Abadi">
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
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="search.html">
                    <input class="form-control" type="text" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </li>
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ auth()->user()->getUrlProfilePictureAttribute() }}"
                        alt="">
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
            <a class="dropdown-item logout-button" role="button">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
</div>
<!-- /Header -->
<script>
    const logoutButtons = document.querySelectorAll('.logout-button');
    logoutButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const confirmation = await Swal.fire({
                title: 'Logout Confirmation',
                text: 'Are you sure you want to logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Logout',
                cancelButtonText: 'Cancel',
                showLoaderOnConfirm: true,
                customClass: {
                    confirmButton: 'btn btn-secondary me-2',
                    cancelButton: 'btn btn-success'
                },
                buttonsStyling: false,
                preConfirm: () => true
            });
            if (!confirmation.isConfirmed) return;
            const token = getCookie('auth_token');
            try {
                const response = await axios.post('/api/logout', {}, {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                Swal.fire({
                    title: response.data.status ? 'Success' : 'Error',
                    text: response.data.message,
                    icon: response.data.status ? 'success' : 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.location.href = '/login';
            } catch (error) {
                Swal.fire({
                    title: error.response?.status === 401 ? 'Unauthorized' : 'Error',
                    text: error.response?.data?.message ??
                        "An error occurred while logging out",
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.location.href = '/login';
            }
        });
    });
</script>
