@extends('layouts.mainlayout')

@section('title', 'Deleted Books')
    
@section('content')

<h1>Deleted Book List</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="/books" class="btn btn-primary me-3">Back</a>
</div>

<div class="mt-5">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
</div>

<div class="my-5">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Code</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($count_data == 0)
                <tr>
                    <td colspan="7" style="text-align:center;">No Data</td>
                 </tr>
            @endif 
            @foreach ($deletedBooks as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>    
                <td>{{ $item->book_code }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->author }}</td>
                <td>
                    @foreach ($item->categories as $category)
                        {{ $category->name }}
                    @endforeach
                </td>
                <td>{{ $item->status }}</td>
                <td>
                    <a href="/book-restore/{{$item->slug}}">Restore</a>
                </td>    
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection