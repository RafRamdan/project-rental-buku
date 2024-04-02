@extends('layouts.mainlayout')

@section('title', 'Book list')

@section('page-name', 'books')

@section('content')

    <br>
    <h1>Detail Book</h1>
    <br>
    <div class="container">
        <div class="row">
            <div class="card mb-3" style="max-width: 100%;">
                <div class="row g-0">
                    <div class="col-12 col-md-4">
                        <img src="{{ $books[0]->cover != null ? asset('storage/cover/' . $books[0]->cover) : asset('images/not found.jpg') }}"
                            draggable="false" alt="..." style="width: 100%; border-radius: 20px; margin-top: 40px;">
                    </div>
                    <div class="col-12, col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{ $books[0]->title }}</h3>
                            <h5 class="code">{{ $books[0]->book_code }}</h5>
                            <p class="date">Publication Date: {{ $books[0]->publication_date }}</p>
                            <p class="author">Author: {{ $books[0]->author }}</p>
                            <p class="publisher">Publisher: {{ $books[0]->publisher }}</p>
                            <p class="page">Page: {{ $books[0]->page }}</p>
                            <p>Deskripsi:</p>
                            <p class="description">
                                {{ $books[0]->description }}
                            </p>
                            <div class="mb-3">
                                <label for="" class="form-label">Category</label>
                                <ul>
                                    @foreach ($books[0]->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <p>Status:</p>
                            <p class="status {{ $books[0]->status == 'in stock' ? 'text-success' : 'text-danger' }}">{{ $books[0]->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>

@endsection
