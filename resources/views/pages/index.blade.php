@extends('layouts.base')
@section('title', 'Yayasan Agape Hijau Abadi')
@section('content')
    {{-- Hero Section --}}
    <section class="position-relative mb-5" style="height: 573px;">
        <div id="heroCarousel" class="carousel slide carousel-fade position-absolute top-0 start-0 w-100 h-100 z-n1"
            data-bs-ride="carousel">
            <div class="carousel-inner w-100 h-100">
                <div class="carousel-item active w-100 h-100">
                    <img loading="lazy" src="https://images3.alphacoders.com/118/1184187.jpg"
                        class="d-block w-100 h-100 object-fit-cover" style="object-position: center;" alt="Slide 1">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img loading="lazy"
                        src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1350&q=80"
                        class="d-block w-100 h-100 object-fit-cover" style="object-position: center;" alt="Slide 2">
                </div>
                <div class="carousel-item w-100 h-100">
                    <img loading="lazy"
                        src="https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1350&q=80"
                        class="d-block w-100 h-100 object-fit-cover"
                        style="object-position: center; -webkit-filter: drop-shadow( 3px 3px 2px rgba(0, 0, 0, .7)); filter: drop-shadow( 3px 3px 2px rgba(0, 0, 0, .7));"
                        alt="Slide 3">
                </div>
            </div>
        </div>
        <div class="position-absolute w-100 h-100 top-0 start-0 z-n1" style="background-color: rgba(0, 0, 0, 0.5);"></div>
        <div class="position-absolute w-100 h-100 p-0 m-0 top-0 start-0 d-none d-md-block z-3">
            <button class="carousel-control-prev px-0 mx-0" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon px-0 mx-0"></span>
            </button>
            <button class="carousel-control-next px-0 mx-0" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon px-0 mx-0"></span>
            </button>
        </div>
        <div class="container h-100 z-2 top-0 start-0">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-md-8 col-12 text-center text-white">
                    <h1 class="display-4 fw-bold text-center">Yayasan <span class="text-success">Agape</span> Hijau Abadi
                    </h1>
                    <p class="fs-5 text-light">Serving with Christ's love through free education, scholarship programs, and
                        social and disaster relief. With the support of our partners and donors, including those from Korea,
                        we are here to bring light and hope.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- About Section --}}
    <section class="mb-5">
        <div class="container">
            <div class="row flex-md-row-reverse align-items-md-center">
                <div class="col-md-5 col-12 mb-4 mb-md-0">
                    <img loading="lazy" class="img-fluid w-100 object-fit-cover rounded"
                        style="max-height: 450px; object-position: center;"
                        src="https://huggingface.co/front/assets/homepage/modalities-dark.svg" alt="">
                </div>
                <div class="d-none d-md-block col-md-1"></div>
                <div class="col-md-6 col-12">
                    <span class="border border-success text-success rounded-pill px-3 py-1" style="font-size: 0.9rem;">About
                        Us</span>
                    <h1 class="fw-bold mt-3 display-5">Yayasan <span class="text-success">Agape</span> Hijau Abadi</h1>
                    <p class="fw-medium text-muted">The Agape Hijau Abadi Foundation is a Christian ministry committed to
                        developing the younger generation through free education, scholarship programs, and compassionate
                        service in response to disasters. With the support of partners from within and outside the country,
                        we continue to bring hope to the community.</p>
                    <div class="d-flex align-items-center gap-2">
                        <a href="#" class="btn btn-success">Learn More</a>
                        <a href="#" class="btn btn-outline-success">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Image Section --}}
    <section class="mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img loading="lazy" class="img-fluid w-100 rounded shadown-sm object-fit-cover"
                        style="max-height: 500px;"
                        src="https://sph.edu/wp-content/uploads/2022/02/sph-studentLife-studentLeadership-top-v1.jpg"
                        alt="">
                </div>
            </div>
        </div>
    </section>
    {{-- Program Section --}}
    <section class="mb-5 d-flex align-items-center" id="programs">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-12">
                    <span class="border border-success text-success rounded-pill px-3 py-1" style="font-size: 0.9rem;">
                        Our Mission
                    </span>
                    <h2 class="fw-bold mt-3 display-6"><span class="text-success">Programs</span> & Initiatives</h2>
                    <p class="text-muted">Together with our donors, we support education, relief, and hope for the
                        community.</p>
                </div>
            </div>
            <div class="row g-md-4">
                <div class="col-md-4 col-12">
                    <div class="card h-100 border-0" style="box-shadow: 0 0 0 0 !important;">
                        <div class="card-body text-center border-0" style="box-shadow: 0 0 0 0 !important;">
                            <i class="bi bi-mortarboard-fill text-success fs-1 mb-3"></i>
                            <h5 class="fw-bold fs-5 mb-2">Free Education</h5>
                            <p class="text-muted">Providing free education for children who need opportunities to grow and
                                learn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card h-100 border-0" style="box-shadow: 0 0 0 0 !important;">
                        <div class="card-body text-center border-0" style="box-shadow: 0 0 0 0 !important;">
                            <i class="bi bi-heart-fill text-success fs-1 mb-3"></i>
                            <h5 class="fw-bold fs-5 mb-2">Scholarship Programs</h5>
                            <p class="text-muted">Supporting talented students with scholarships to pursue their dreams.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="card h-100 border-0" style="box-shadow: 0 0 0 0 !important;">
                        <div class="card-body text-center border-0" style="box-shadow: 0 0 0 0 !important;">
                            <i class="bi bi-people-fill text-success fs-1 mb-3"></i>
                            <h5 class="fw-bold fs-5 mb-2">Community Relief</h5>
                            <p class="text-muted">Helping communities in times of natural disasters and social needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Gallery Section --}}
    <section class="mb-5" id="gallery">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-12">
                    <span class="border border-success text-success rounded-pill px-3 py-1" style="font-size: 0.9rem;">
                        Our Gallery
                    </span>
                    <h2 class="fw-bold mt-3 display-6"><span class="text-success">Moments</span> of Service</h2>
                    <p class="text-muted">Snapshots from our education, scholarship, and community relief programs.</p>
                </div>
            </div>
            <div class="owl-carousel owl-theme" id="gallery-carousel">
                <div class="item">
                    <img src="https://sph.edu/wp-content/uploads/2021/08/sph-home-img-02.jpg" class="img-fluid rounded"
                        alt="Gallery 1">
                </div>
                <div class="item">
                    <img src="https://sph.edu/wp-content/uploads/2023/06/tabs-img.jpg" class="img-fluid rounded"
                        alt="Gallery 2">
                </div>
                <div class="item">
                    <img src="https://sph.edu/wp-content/uploads/2021/08/sph-home-img-04.jpg" class="img-fluid rounded"
                        alt="Gallery 3">
                </div>
                <div class="item">
                    <img src="https://sph.edu/wp-content/uploads/2022/04/header-sph-extracurricular-v2.jpg"
                        class="img-fluid rounded" alt="Gallery 4">
                </div>
                <div class="item">
                    <img src="https://sph.edu/wp-content/uploads/2022/02/sph-studentLife-studentLeadership-side-v1.jpg"
                        class="img-fluid rounded" alt="Gallery 5">
                </div>
            </div>
        </div>
    </section>
    {{-- Vision & Mission Section --}}
    <section class="mb-5" id="vision-mission">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-12">
                    <h2 class="fw-bold mt-3 display-6">Vision & <span class="text-success">Mission</span></h2>
                </div>
            </div>
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-md-6 col-12 mb-4 mb-md-0">
                    <img loading="lazy" class="img-fluid w-100 object-fit-cover rounded"
                        style="max-height: 450px; object-position: center;"
                        src="https://sph.edu/wp-content/uploads/2022/02/header-sph-phhDormitory-v1.jpg" alt="">
                </div>
                <div class="col-md-1 d-none d-md-block"></div>
                <div class="col-md-5 col-12 mb-4 mb-md-0">
                    <div class="d-flex flex-column gap-3">
                        <span class="border border-success text-success rounded-pill px-3 py-1 ms-0 me-auto"
                            style="font-size: 0.9rem;">
                            Our Vision & Mission
                        </span>
                        <div class="d-flex flex-column gap-1">
                            <h4 class="fw-bold text-success">Vision</h4>
                            <p class="text-muted">
                                Showing love to Indonesian children, underprivileged and neglected families.
                            </p>
                            <h4 class="fw-bold text-success">Mission</h4>
                            <ol class="text-muted mb-0 ps-3" style="list-style: decimal;">
                                <li class="mb-2">Supporting regional development in disaster recovery.</li>
                                <li class="mb-2">Supporting efforts to create jobs for underdeveloped areas.</li>
                                <li>Providing education and health services to underprivileged communities.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- News Section --}}
    <section class="mb-5" id="news">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col-12">
                    <span class="border border-success text-success rounded-pill px-3 py-1" style="font-size: 0.9rem;">
                        Latest News
                    </span>
                    <h2 class="fw-bold mt-3 display-6">Our <span class="text-success">News</span></h2>
                    <p class="text-muted">Stay updated with the latest activities, programs, and initiatives.</p>
                </div>
            </div>
            <div class="owl-carousel owl-theme" id="news-carousel"></div>
        </div>
    </section>
    <script>
        // News Carousel
        function equalizeCardHeights() {
            const cards = document.querySelectorAll('#news-carousel .card');
            let maxHeight = 0;

            // reset dulu
            cards.forEach(card => {
                card.style.height = "auto";
                maxHeight = Math.max(maxHeight, card.offsetHeight);
            });

            // set semua card ke tinggi maksimum
            cards.forEach(card => {
                card.style.height = maxHeight + "px";
            });
        }

        document.addEventListener("DOMContentLoaded", async function () {
            try {
                const newestNews = await axios.get('/api/master-data/news?limit=9', {
                    headers: { 'Accept': 'application/json' }
                });
                const newsCarousel = document.getElementById('news-carousel');
                console.log("Response:", newestNews.data);

                if (newestNews.data.status && Array.isArray(newestNews.data.data.data)) {
                    let data = newestNews.data.data.data;
                    if (data.length > 9) data = data.slice(0, 9);

                    data.forEach(news => {
                        const item = document.createElement('div');
                        item.classList.add('item');
                        item.innerHTML = `
                            <div class="card h-100 border-0 shadow-sm d-flex flex-column">
                                <img src="${news.image_url || '/static/img/no_image_placeholder.png'}"
                                    class="card-img-top"
                                    style="height:350px; object-fit:cover"
                                    alt="${news.title}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="fw-bold">${news.title}</h5>
                                    <p class="text-muted small mb-0 flex-grow-1">
                                        ${(news.content || "").replace(/<[^>]+>/g, "").substring(0, 120)}...
                                    </p>
                                </div>
                            </div>
                        `;
                        newsCarousel.appendChild(item);
                    });

                    console.log("Init carousel…");
                    $("#news-carousel").owlCarousel({
                        loop: true,
                        margin: 15,
                        nav: false,
                        dots: false,
                        autoplay: true,
                        autoplayTimeout: 2500,
                        responsive: {
                            0: { items: 1 },
                            576: { items: 2 },
                            992: { items: 3 }
                        }
                    });

                    // panggil equalizer setelah carousel selesai inisialisasi
                    $("#news-carousel").on('initialized.owl.carousel resized.owl.carousel refreshed.owl.carousel', function () {
                        setTimeout(equalizeCardHeights, 100);
                    });

                } else {
                    console.warn("Data kosong atau format tidak sesuai:", newestNews.data);
                }
            } catch (err) {
                console.error("Error load news:", err);
            }
        });
        // Gallery Carousel
        document.addEventListener("DOMContentLoaded", function () {
            $("#gallery-carousel").owlCarousel({
                loop: true,
                margin: 15,
                nav: false,
                dots: false,
                autoplay: true,
                autoplayTimeout: 2500,
                responsive: {
                0: { items: 1 },
                576: { items: 2 },
                992: { items: 3 }
                }
            });
        });
    </script>
    <style>
        @media (min-width: 768px) {
            #programs {
                height: 480px;
            }
        }
        #gallery .owl-carousel .item img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            object-position: center;
        }
        .card .text-muted {
            display: -webkit-box;
            -webkit-line-clamp: 3;   /* tampilkan max 3 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
