@extends('layouts.mainlayout')

@section('title', 'Detail book')

@section('content')

<h1>Borrow Book Approve</h1>

    <div class="mt-5 d-flex justify-content-end">
        <a href="/borrow-book" class="btn btn-info">Back</a>
    </div>
        <div class="my-5 w-25">
            <div class="mb-3">
                <label for="" class="form-label">nama user</label>
                <input type="text" class="form-control" readonly value="{{$detail->user->username}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">nama book</label>
                <input type="text" class="form-control" readonly value="{{$detail->book->title}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">tanggal peminjaman</label>
                <input type="text" class="form-control" readonly value="{{$detail->rent_date}}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">tenggat pengembalian</label>
                <input type="text" class="form-control" readonly value="{{$detail->return_date}}">
            </div>

            <div class="card-body">
              @if (Auth::user()->role_id == 1)
                <form action="/borrow-book/{{ $detail->id }}" method="post">
              @else 
              <form action="/borrow-book/officer/{{ $detail->id }}" method="post">
              @endif
                  @csrf
                  @method('put')
                  <select class="form-select" name="verification">
                    @if($detail->verification == 'Permintaan')
                      <option value="Disetujui">Setujui Peminjaman</option>
                      <option value="Ditolak">Tolak Peminjaman</option>
                    @elseif($detail->verification == "Disetujui")
                      <option value="Dikembalikan">Buku Dikembalikan</option>
                    @endif
                  </select>

                  <button type="submit" class="btn btn-info mt-2">Proses</button>
                </form>
            </div>
        </div>
@endsection