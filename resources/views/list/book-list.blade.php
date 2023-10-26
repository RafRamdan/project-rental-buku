@extends('layouts.mainlayout')

@section('title', 'Books')

@section('page-name', 'books')
    
@section('content')

    <form action="" method="GET">
        <div class="row justify-content-end">
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3 ">
                    <input type="text" class="form-control" name="title" placeholder="Search book's title">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>

    <div class="my-5">
        @if ($count_data == 0)
            <div class="text-lg-right text-center">
                No data
            </div>
        @endif
        <div class="row">
            @foreach ($books as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                    <div class="card h-100" >
                        <img src="{{ $item->cover != null ? asset('storage/cover/'.$item->cover) : asset('images/not found.jpg') }}" class="card-img-top" draggable="false" >
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->book_code }}</h5>
                            <p class="card-text">{{ $item->title }}</p>
                            <p class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">{{ $item->status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection