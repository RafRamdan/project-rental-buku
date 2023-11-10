@extends('layouts.mainlayout')

@section('title', 'Users')

@section('content')

<h1>New User Registered List</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/users" class="btn btn-primary">Approved User List</a>
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
                 @foreach ($registeredUsers as $item)
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
                            <a href="/user-detail/{{$item->slug}}">detail</a>
                        </td>
                    </tr>
            @endforeach
            </tbody>
        </table>
        <div class="card-footer">
            {{ $users->links()  }}
        </div>
    </div>

@endsection