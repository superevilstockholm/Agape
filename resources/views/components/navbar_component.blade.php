<div class="d-flex flex-column sticky-top">
    <header class="bg-success d-md-block d-none">
        <div class="container">
            <div class="row justify-content-end align-items-center py-2">
                <div class="col-auto d-flex gap-3" style="font-size: 0.9rem;">
                    <ul class="list-inline py-0 my-0">
                        <li class="list-inline-item"><a class="nav-link" href="https://wa.me/+6285817203458" target="_blank"><i class="bi bi-whatsapp"></i>
                                Whatsapp</a></li>
                        <li class="list-inline-item"><a class="nav-link" href="tel:085817203458" target="_blank"><i class="bi bi-phone"></i>
                                Telephone</a></li>
                        <li class="list-inline-item"><a class="nav-link" href="mailto:balilombok11@gmail.com" target="_blank"><i class="bi bi-envelope"></i>
                                Email</a></li>
                    </ul>
                    <span>|</span>
                    <ul class="list-inline py-0 my-0">
                        <li class="list-inline-item"><a class="nav-link" href="https://www.facebook.com/p/Agape-Hijau-Abadi-100085181980166/" target="_blank"><i
                                    class="bi bi-facebook"></i></a></li>
                        <li class="list-inline-item"><a class="nav-link" href="#"><i
                                    class="bi bi-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="nav-link" href="https://www.instagram.com/agapehijauabadi/" target="_blank"><i
                                    class="bi bi-instagram"></i></a></li>
                        <li class="list-inline-item"><a class="nav-link" href="#"><i
                                    class="bi bi-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand fw-medium text-muted d-flex align-items-center gap-2" href="{{ route('index') }}">
                <img src="{{ asset('static/img/logo.png') }}" height="50" alt="Logo Yayasan Agape">
                Yayasan <span class="text-success">Agape</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link{{ Route::is('index') ? ' active' : '' }}" aria-current="page"
                            href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Route::is('institution.jakarta') || Route::is('institution.tangerang') || Route::is('institution.serang') ? ' active' : '' }}" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            institution
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm p-3 rounded-0">
                            <li><a class="dropdown-item{{ Route::is('institution.jakarta') ? ' active' : '' }}" href="{{ route('institution.jakarta') }}">Jakarta</a></li>
                            <li><a class="dropdown-item{{ Route::is('institution.tangerang') ? ' active' : '' }}" href="{{ route('institution.tangerang') }}">Tangerang</a></li>
                            <li><a class="dropdown-item{{ Route::is('institution.serang') ? ' active' : '' }}" href="{{ route('institution.serang') }}">Serang</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ Route::is('news') ? ' active' : '' }}" href="{{ route('news') }}">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link{{ Route::is('gallery') ? ' active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<style>
    header {
        color: rgba(var(--bs-body-bg-rgb), 0.75);
        transition: all 200ms ease-in-out;
    }
    .nav-link.active {
        color: rgba(var(--bs-body-color-rgb), 1) !important;
    }
    .dropdown-item {
        color: var(--bs-secondary);
    }
    header .nav-link:hover {
        color: rgba(var(--bs-body-bg-rgb), 1) !important;
    }
    nav.navbar {
        transition: background-color 300ms ease, box-shadow 300ms ease;
    }
    nav.navbar.scrolled {
        background-color: #fff !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    /* Hanya aktif untuk layar >= md */
    @media (min-width: 768px) {
        .navbar .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    }
</style>
<script>
    window.addEventListener("scroll", function() {
        const navbar = document.querySelector("nav.navbar");
        if (window.scrollY > 10) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>
