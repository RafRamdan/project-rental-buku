@extends('layouts.mainlayout')

@section('title', 'Edit User')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<h1>User edit</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="/user" class="btn btn-info">Back</a>
</div>

<div class="mt-5 w-50">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/user/edit/{{ $user->slug }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ $user->username }}">
        </div>

        <div class="mb-3">
            <label for="nis" class="form-label">Nis</label>
            <input type="text" name="nis" id="nis" class="form-control" placeholder="Nis" value="{{ $user->nis }}">
        </div>

        <div class="mb-3">
            <label for="class" class="form-label">Class</label>
            <input type="text" name="class" id="class" class="form-control" placeholder="Class" value="{{ $user->class }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{ $user->phone }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ $user->address }}">
        </div>

        <div class="card-body">
              <select class="form-select" name="role_id">
                  <option value="3">Petugas</option>
                  <option value="2">User</option>
              </select>
        </div>

        <div class="mt-3">
            <button class="btn btn-success" type="submit">Save</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>
@endsection