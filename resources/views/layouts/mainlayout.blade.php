<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Perpustakaan Online| @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

    <div class="main d-flex flex-column justify-content-between">
        <nav class="navbar navbar-dark navbar-expand-lg bg-primary">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="#">Perpustakaan Online</a>
            @if (Auth::user())
              @if (Auth::user()->role_id == 1  || Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
              
              <a class="navbar-brand row justify-content-end" href="/logout">Logout</a>
              
              @endif
              @else 
                <a class="navbar-brand row justify-content-end" href="/login">Login</a>
            @endif
            </div>
          </nav>
          <div class="body-content h-100">
              <div class="row g-0 h-100">
                  <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarTogglerDemo03">
                      @if (Auth::user())
                        @if (Auth::user()->role_id == 1)
                              <a class="{{ request()->is('dashboard*') ? 'active' : '' }}" href="/dashboard">Dashboard</a>
                              <a class="{{ request()->is('book*') ? 'active' : '' }}" href="/book">Books</a>
                              <a class="{{ request()->is('category*') ? 'active' : '' }}" href="/category">Categories</a>
                              <a class="{{ request()->is('user*') ? 'active' : '' }}" href="/user" >Users</a>
                              <a class="{{ request()->is('rent-logs*') ? 'active' : '' }}" href="/rent-logs" >Borrower history</a>
                              <a class="{{ request()->is('/*') ? 'active' : '' }}" href="/" >Book List</a>
                              <a class="{{ request()->is('borrow-book*') ? 'active' : '' }}" href="/borrow-book" >Borrow Book</a>
                              <a class="{{ request()->is('return-book*') ? 'active' : '' }}" href="/return-book" >Book Return</a>
                        @elseif (Auth::user()->role_id == 3)
                              <a class="{{ request()->is('dashboard/officer*') ? 'active' : '' }}" href="/dashboard/officer">Dashboard</a>
                              <a class="{{ request()->is('rent-logs/officer*') ? 'active' : '' }}" href="/rent-logs/officer">Borrower history</a>
                              <a class="{{ request()->is('/*') ? 'active' : '' }}" href="/">Book List</a>
                              <a class="{{ request()->is('borrow-book/officer*') ? 'active' : '' }}" href="/borrow-book/officer" >Borrow Book</a>
                              <a class="{{ request()->is('return-book/officer*') ? 'active' : '' }}" href="/return-book/officer" >Book Return</a>
                        @else
                              {{-- <a class="{{ request()->is('profile*') ? 'active' : '' }}" href="/profile" >Profile</a> --}}
                              <a class="{{ request()->is('user-rental*') ? 'active' : '' }}" href="/user-rental" >Your borrowing history</a>
                              <a class="{{ request()->is('/*') ? 'active' : '' }}" href="/" >Book List</a>
                        @endif
                      @endif
                  </div>
                  <div class="content p-5 col-lg-10">
                      @yield('content')
                  </div>
              </div>
          </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>