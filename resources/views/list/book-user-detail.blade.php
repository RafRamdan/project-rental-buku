@extends('layouts.mainlayout')

@section('title', 'Book User Detail')

@section('content')

<h1>Detail Book</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/" class="btn btn-info">Back</a>
    </div>

    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="my-5 w-25">
        <div class="mb-3">
            <label for="currentImage" class="form-label" style="display:block">Current Image</label>
            @if ($book->cover!='')
                <img src="{{ asset('storage/cover/'.$book->cover) }}" alt="" width="300px">
            @else 
                <img src="{{ asset('images/not found.jpg') }}" alt="" width="300px">
            @endif
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Code book</label>
            <input type="text" class="form-control" readonly value="{{$book->book_code}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Title book</label>
            <input type="text" class="form-control" readonly value="{{$book->title}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Author</label>
            <input type="text" class="form-control" readonly value="{{$book->author}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Publisher</label>
            <input type="text" class="form-control" readonly value="{{$book->publisher}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Publication date</label>
            <input type="text" class="form-control" readonly value="{{$book->publication_date}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Page</label>
            <input type="text" class="form-control" readonly value="{{$book->page}}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea name="" id="" cols="30" rows="7" class="form-control" style="resize: none" readonly>{{ $book->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Category</label>
            <ul>
                @foreach ($book->categories as $category)
                    <li>{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" readonly value="{{$book->status}}">
        </div>
        @if ($book->status == 'in stock')
     
            <div class="card-body">
                @auth
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Pinjam Buku
                </button>
                @else
                <a href="/login" class="btn btn-info" >Pinjam Buku</a>
                @endauth
            </div>
   
        @endif  
</div>
@endsection
@if (Auth::user())

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="/borrowing" method="post">
          @csrf
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Pinjam Buku {{ $book->title }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            {{-- <div class="mb-3">
              <label for="alasan" class="form-label">Alasan Pinjam</label>
              <textarea class="form-control" id="alasan" rows="3" name="alasan"></textarea>
            </div> --}}
            <div class="mb-3">
              <label for="return_date" class="form-label">Meminjam sampai tanggal</label>
              <input type="date" class="form-control" id="return_date" name="return_date">
            </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <input type="text" name="user_id" value="{{ auth()->user->id }}" hidden> --}}
              <input type="text" name="book_id" value="{{ $book->id }}" hidden>
              <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden>
              <input type="text" name="verification" value="{{ 'Permintaan' }}" hidden>
              <button type="submit" class="btn btn-info">Setuju Pinjam</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endif