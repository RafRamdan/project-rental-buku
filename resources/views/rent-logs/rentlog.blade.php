@extends('layouts.mainlayout')

@section('title', 'Rent Log')

@section('content')
    <h1>list rent logs</h1>
    @if (Auth::user()->role_id == 3)
        <div class="mt-5 d-flex justify-content-end">
            <a href="/exportpdf/officer" class="btn btn-info me-3">Export PDF</a>
        </div>
    @else
        <div class="mt-5 d-flex justify-content-end">
            <a href="/exportpdf" class="btn btn-info me-3">Export PDF</a>
        </div>
    @endif
    
    <div class="mt-5">
        <x-rent-log-table :rentlog='$rent_logs'/>
    </div>
@endsection