<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ximilu Ammar</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="text-primary m-0">Ximilu Ammar</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto p-4 p-lg-0">
                <a href="#" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#products" class="nav-item nav-link">Products</a>
            </div>
            <!-- Login Button - visible on lg screens (right), in collapse menu on mobile (bottom) -->
            <div class="d-flex justify-content-center pt-3 pt-lg-0">
                <a href="{{ route('login') }}" class="nav-item btn btn-outline-primary border-1 rounded-pill px-4 py-2">Login</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn min-vh-100" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: #ffe8ba; z-index: 1;"></div>
                <div class="container position-relative" style="z-index: 2; height: 95vh; display: flex; align-items: center;">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <img class="img-fluid rounded" src="{{ asset('img/profile.png') }}" alt="Small Image" style="max-width: 800%; height: auto;">
                        </div>
                        <div class="col-md-8">
                            <h1 class="display-4 text-dark mb-4">Enaknya Bikin Mood Naik</h1>
                            <p class="text-dark fs-5 mb-4">Ximilu Ammar adalah UMKM kuliner yang menyediakan berbagai pilihan menu seperti dimsum mentai, ximilu, donat, croffle, dan aneka camilan lainnya, yang seluruhnya diolah dari bahan berkualitas dengan proses pembuatan higienis untuk menghadirkan produk yang fresh dan lezat. Seiring perkembangan usaha, kami menerapkan pengelolaan yang lebih terstruktur agar kualitas produk dan pelayanan tetap terjaga, serta terus berinovasi agar dapat memberikan pengalaman kuliner yang memuaskan, cepat, dan terpercaya bagi setiap pelanggan.</p>
                            <a href="https://linktr.ee/andace19" class="btn btn-primary rounded-pill py-3 px-5">Pesan Sekarang!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: #ffe8ba; z-index: 1;"></div>
                <div class="container position-relative" style="z-index: 2; height: 95vh; display: flex; align-items: center;">

                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <h1 class="display-4 text-dark mb-4">Dari Satu Gerai, Tumbuh Jadi Puluhan</h1>
                            <p class="text-dark fs-5 mb-4">Banyak juragan Es Teh Poci memulai dari kecil dan kini mengelola puluhan gerai berkat dukungan sistem dan merek yang kuat.</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img class="img-fluid rounded" src="{{ asset('img/uni.png') }}" alt="Person 1" style="max-width: 110%; height: 110;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-xxl py-6" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp text-center" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="img/profile_about.png" alt="" style="max-width: 80%; height: auto;">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h1 class="display-6 mb-4">Menghadirkan Rasa Terbaik Melalui Proses yang Berkualitas</h1>
                        <p>Ximilu Ammar adalah UMKM kuliner yang menyajikan berbagai pilihan menu seperti dimsum mentai, ximilu, donat, croffle, dan aneka camilan lainnya. Dengan penggunaan bahan berkualitas dan proses pembuatan yang higienis, kami berkomitmen menghadirkan produk yang fresh dan lezat untuk setiap pelanggan.</p>
                        <p>Untuk mendukung operasional yang semakin berkembang, kami menerapkan pengelolaan yang lebih terstruktur sehingga kualitas produk dan pelayanan tetap terjaga. Kami terus berinovasi agar dapat memberikan pengalaman kuliner yang memuaskan dan terpercaya.</p>
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Produk Berkualitas
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Segar & Buatan Sendiri
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Online Order
                            </div>
                            <div class="col-sm-6">
                                <i class="fa fa-check text-primary me-2"></i>Pelayanan Cepat
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Product Start -->
    <div class="container-xxl bg-light my-6 py-6 pt-0">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;" id="products">
                <h1 class="display-6 mb-4">Pilihan Menu Terbaik Kami</h1>
            </div>
            <div class="row g-4">
                @foreach ($products as $product)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="text-center p-4">
                            <h3 class="mb-3">{{ $product->nama }}</h3>
                            <div class="d-inline-block border border-primary rounded-pill px-3 mb-3">{{ $product->harga_satuan }}</div>
                        </div>
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="{{ asset('storage/'. $product->gambar) }}" alt="">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
    <!-- Product End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer my-6 mb-0 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-light mb-4">Office Address</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright text-light py-4 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; 2025 <a href="#">Ximilu Ammar</a> | All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
