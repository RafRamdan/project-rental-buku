@extends('layouts.mainlayout')

@section('title', 'Dashboard')

    
@section('content')

    <h1>Welcome, {{Auth::user()->username}}</h1>

    <div class="row mt-5">
        <div class="col-lg-4 ">
            <div class="card-data book">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journal-bookmark"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Buku</div>
                        <div class="card-count">{{$book_count}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6"><i class="bi bi-list-task"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Kategori</div>
                        <div class="card-count">{{$category_count}}</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 ">
            <div class="card-data user">
                <div class="row">
                    <div class="col-6"><i class="bi bi-people"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">User</div>
                        <div class="card-count">{{$user_count}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ">
            <div class="card-data book">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journals"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Jumlah peminjaman</div>
                        <div class="card-count">{{$count_data}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="card-data category">
                <div class="row">
                    <div class="col-6"><i class="bi bi-clock"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Sedang dipinjam</div>
                        <div class="card-count">{{$borrowed_count}}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 ">
            <div class="card-data user">
                <div class="row">
                    <div class="col-6"><i class="bi bi-journal-check"></i></div>
                    <div class="col-6 d-flex flex-column justify-content-center align-items-end">
                        <div class="card-desc">Selesai dipinjam</div>
                        <div class="card-count">{{$returned_count}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h2>#Rent Log</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>User</th>
                    <th>Book Title</th>
                    <th>Rent Date</th>
                    <th>Renturn Date</th>
                    <th>Actual Return Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if($count_data == 0)
                    <tr>
                        <td colspan="7" style="text-align:center;">No Data</td>
                    </tr>
                @endif 
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->username }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->rent_date }}</td>
                    <td>{{ $item->return_date }}</td>
                    <td>{{ $item->actual_return_date }}</td>
                    <td>{{ $item->book->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection