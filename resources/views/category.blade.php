@extends('layouts.mainlayout')

@section('title', 'Category')

@section('page-name', 'books')
    
@section('content')

<h1>List Category</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="category-add" class="btn btn-primary">Add Data</a>
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
            @foreach ($categories as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>    
                <td>{{ $item->name }}</td>
                <td>
                    <a href="#">Edit</a>    
                    <a href="#">Delete</a>    
                </td>    
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection