@extends('layouts.mainlayout')

@section('title', 'Banned Users')

@section('content')

<h1>Banned List user</h1>

<div class="mt-5 d-flex justify-content-end">
    <a href="/user" class="btn btn-primary me-3">Back</a>
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
                    <th>Username</th>
                    <th>Nis</th>
                    <th>Class</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($count_data == 0)
                    <tr>
                        <td colspan="7" style="text-align:center;">No Data</td>
                    </tr>
                @endif 
                @foreach ($bannedUsers as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->nis }}</td>
                        <td>{{ $item->class }}</td>
                        <td>
                            @if ($item->phone)
                                {{ $item->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="/user/restore/{{$item->slug}}">restore</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer">
            {{ $bannedUsers->links()  }}
        </div>
    </div>

@endsection