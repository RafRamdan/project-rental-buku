@extends('layouts.mainlayout')

@section('title', 'Add Category')

@section('content')

<h1>New Add Category</h1>

<form action="#" method="POST">
    <div class="mt-5 w-50">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
    </div>

    <div class="mt-3">
        <button class="btn btn-success">Save</button>
    </div>
</form>

@endsection