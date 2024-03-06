@extends('layouts.mainlayout')

@section('title', 'Book list')

@section('page-name', 'books')
    
@section('content')

<style>
    h5,a{
       color: #000000;
       text-decoration: none;
    }
</style>

    <form action="" method="GET">
        <div class="row ">
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="">Select category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
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
                            <h5 class="card-title"><a href="/detail/{{$item->slug}}">{{ $item->book_code }}</a></h5>
                            <p class="card-text">{{ $item->title }}</p>
                            <div class="container text-center">
                                <div class="row">
                                    <p class="col">Kategori:</p>
                                    @foreach ($books[0]->categories as $category)
                                    <p class="col">{{ $category->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <p class="card-text text-end fw-bold {{ $item->status == 'in stock' ? 'text-success' : 'text-danger' }}">{{ $item->status }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ( request()->get('title') || (request()->get('category')))
        <div class="card-footer">
            {{ $books->appends(request()->input())->links()}}
        </div> 
        @else
        <div class="card-footer">
            {{ $books->links()  }}
        </div>
        @endif
        
    </div>
@endsection