<!doctype html>
<html lang="en">

<head>
    <title>Library</title>
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css"
        integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="mx-3">
                            <circle cx="10.5" cy="10.5" r="7.5"></circle>
                            <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                        </svg>
                    </a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="#">Library</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm btn-outline-secondary" href="login.html">Login</a>
                </div>
            </div>
        </header>
        <div style="background-image: url(https://pijarsekolah.id/wp-content/uploads/2021/12/perpus-1024x576.jpg); background-size: 100%;"
            class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
            <div class="px-0">
                <h1 class="text-light bg-dark display-4 font-italic">Perpustakaan Online</h1>
                <p class="text-light bg-dark lead my-3">Membaca adalah jendela dunia.</p>
            </div>
        </div>
        <div class="container">
            <h3 class="pb-3 font-italic border-bottom">Rekomendasi Buku</h3>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-primary">Non-fiksi</strong>
                        <h3 class="mb-0">
                            <a class="text-dark" href="#">Sapiens: Riwayat Singkat Umat Manusia</a>
                        </h3>
                        <div class="mb-1 text-muted">Yuval Noah Harari (2011)</div>
                        <p class="card-text mb-auto">Sapiens membahas sisi yang tak banyak diungkit buku sejarah atau
                            evolusi manusia lain: bagaimana manusia berangkat dari sekadar satu spesies hewan menjadi
                            makhluk berperadaban.</p>
                    </div>
                    <img class="card-img-right flex-auto d-none d-md-block"
                        src="https://mojokstore.com/wp-content/uploads/2020/02/Sapiens.jpg" alt="Card image cap"
                        height="200px">
                </div>
            </div>
            <div class="col-md-6">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                        <strong class="d-inline-block mb-2 text-success">Pengembangan Diri</strong>
                        <h3 class="mb-0">
                            <a class="text-dark" href="#">Tipping Point: Bagaimana Hal Kecil Berhasil Membuat
                                Perubahan</a>
                        </h3>
                        <div class="mb-1 text-muted">Malcolm Gladwell (2019)</div>
                        <p class="card-text mb-auto">The Tipping Point adalah sebuah peta penunjuk jalan menuju
                            perubahan dengan pesan penuh harapan-bahwa orang yang imajinatif.</p>
                    </div>
                    <img class="card-img-right flex-auto d-none d-md-block"
                        src="https://inc.mizanstore.com/aassets/img/com_cart/produk/the-tipping-point-cover-baru-malcolm-gladwell.jpg"
                        height="200px" alt="Card image cap">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <a href="daftar_buku.html"><button type="button" class="btn-block btn btn-outline-primary"><i
                    class="fas fa-book"></i> Daftar Buku</button></a>
    </div>
    <hr />
    <nav class="navbar navbar-expand-sm navbar-light d-flex justify-content-between" style="background-color: #e3f2fd;">
        <a class="p-2 text-muted" href="#">&copy; Ilham Setia Bhakti - 2022</a>
    </nav>
</body>

</html>
