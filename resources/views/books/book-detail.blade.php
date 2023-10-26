@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')

<h1>Detail Book</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/books" class="btn btn-info">Back</a>
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
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" readonly value="{{$book->status}}">
        </div>
    </div>

@endsection