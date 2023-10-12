@extends('layouts.mainlayout')

@section('title', 'Rent Log')

@section('content')
    <h1>list rent logs</h1>

    <div class="mt-5">
        <x-rent-log-table :rentlog='$rent_logs' />
    </div>
@endsection