<!doctype html>
<html lang="en">

<head>
    <title>Daftar Buku Perpustakaan</title>
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
                    <form action="" method="GET">
                        <div class="input-group mb-3 ">
                            <input type="text" class="form-control" name="title" placeholder="Search book's title">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-4 text-center">
                    <p class="blog-header-logo text-dark">List Book</p>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="btn btn-sm btn-outline-secondary" href="#">Login</a>
                </div>
            </div>
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    @foreach ($categories as $item)
                        <a class="p-2 text-muted" 
                            href="?category={{ $item->id }}">{{ $item->name }}</a>
                    @endforeach
                </nav>
            </div>
        </header>
        <div class="container">
            <h3 class="pb-3 font-italic border-bottom">Daftar Buku</h3>
        </div>
        <div class="card-deck">
            @foreach ($books as $item)
                <div class="card">
                    <img class="card-img-top"
                        src="{{ $item->cover != null ? asset('storage/cover/' . $item->cover) : asset('images/not found.jpg') }}"
                        draggable="false">
                    <div class="card-body">
                        <h4 class="card-title"><a href="/detail/{{ $item->slug }}">{{ $item->title }}</a></h4>
                        <p class="card-title">{{ $item->book_code }}</p>
                        <p class="card-text"><small class="text-muted">{{ $item->author }}</small></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <hr />
    <div class="card-footer pagination justify-content-center">
        {{ $books->links() }}
    </div>
    <hr />
    <nav class="navbar navbar-expand-sm navbar-light d-flex justify-content-between" style="background-color: #e3f2fd;">
        <a class="p-2 text-muted" href="#">&copy; Rafi ramdani - 2023</a>
    </nav>
</body>

</html>
