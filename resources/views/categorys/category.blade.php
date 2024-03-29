@extends('layouts.mainlayout')

@section('title', 'Categories')
    
@section('content')

<h1>List Category</h1>
<nav class="navbar">
    <div class="mt-5 d-flex justify-content-end">
        <a href="/category/deleted" class="btn btn-secondary me-3">View Deleted Data</a>
        <a href="/category/add" class="btn btn-primary">Add Data</a>
    </div>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search name category" name="search" aria-label="Search" value="{{ request('search') }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
</nav>


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
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($count_data == 0)
                <tr>
                    <td colspan="7" style="text-align:center;">No Data</td>
                </tr>
            @endif 
            @foreach ($categories as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>    
                <td>{{ $item->name }}</td>
                <td>
                    <a href="/category/edit/{{$item->slug}}">Edit</a>    
                    <a href="/category/delete/{{$item->slug}}">Delete</a>    
                </td>    
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer">
        {{ $categories->links()  }}
    </div>
</div>

@endsection