@extends('layouts.mainlayout')

@section('title', 'Rental Book')
    
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
        <h1 class="mb-5">Book Rent Form</h1>
    </div>
        <div class="mt-5">
            @if (session('message'))
                <div class="alert {{session('alert-class')}}">
                    {{ session('message') }}
                </div>
            @endif
        </div>
        <div class="my-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>User</th>
                        <th>Book</th>
                        <th>Rent Date</th>
                        <th>Return Date</th>
                        <th>Actual Return Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                 
                    @if($count_data == 0)
                        <tr>
                            <td colspan="7" style="text-align:center;">No Data</td>
                        </tr>
                    @endif 
                    @foreach ($log_data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->username }}</td>
                            <td>{{ $item->book->title }}</td>
                            <td>{{ $item->rent_date }}</td>
                            <td>{{ $item->return_date }}</td>
                            <td>{{ $item->actual_return_date }}</td>
                            
                            <td>
                                <a href="/rent-book/approve/{{$item->id}}">detail</a>    
                            </td> 
                            
                        </tr>     
                    @endforeach
                </tbody>
            </table>
        </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.inputbox').select2();
    });
</script>
@endsection