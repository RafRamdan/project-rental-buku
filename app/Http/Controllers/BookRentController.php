<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index(Request $request)
    {
        $countData = RentLogs::where('verification', '=', 'Permintaan')->count();
        // $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 3)->where('status', '!=', 'inactive')->get();
        // $books = Book::where('status', '!=', 'not available')->get();
        $log_data = RentLogs::with(['user', 'book'])->where('verification', '=', 'Permintaan')->get();
        return view('rental.book-rent', ['log_data' => $log_data, 'count_data' => $countData]);
        
    }

    public function edit($id)
    {
        $detail = RentLogs::with(['user', 'book'])->where('id', $id)->first();
        if (Auth::user()) {
            if (Auth::user()->role_id == 1) {
                return view('rental.book-approve', ['detail' => $detail]);
            }else {
                return view('list.book-user-detail', ['detail' => $detail]);
            }
        }
    }
       
    public function update(Request $request, $id)
    {
        $borrow = RentLogs::with(['user', 'book'])->where('id', $id)->first();
        
        $verification = [
            'verification' => $request['verification']
        ];

        $status = [
            'status' => 'not available',
        ];
        // $status_created = [
        //     'verification' => $request['verification'],
        //     'created_at' => now(),
        // ];

        $stockMin = [
            'stock' => $borrow->book->stock - 1,
        ];

        // $stockPlus = [
        //     'stock' => $booking->book->stock + 1,
        // ];

        if ($borrow->book->stock > 0) {
            if ($request['verification'] == 'Disetujui') {
                $borrow->update($verification);
                $borrow->book->update($stockMin);
            } else if ($request['verification'] == 'Ditolak') {
                $borrow->update($verification);
            } 
            // else if ($request['status'] == 'Dikembalikan') {
            //     $borrow->update($status);
            //     $borrow->book->update($stockPlus);
            // }
        } else {
            if ($request['verification'] == 'Ditolak') {
                $borrow->update($verification);
                // $borrow->book->update($status);
            }
            //  else if ($request['status'] == 'Dikembalikan') {
            //     $borrow->update($status);
            //     $borrow->book->update($stockPlus);
            // } 
            else {
                return redirect()->back()->with('failed', 'Stock buku habis, tidak bisa menyetujui peminjaman!');
            }
        }

        return redirect('/borrow-book')->with('status', 'Borrow Book Update Success');
    
    }

    public function returnBook()
    {
        $countData = RentLogs::where('verification', '=', 'Disetujui')->count();
        // $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 3)->where('status', '!=', 'inactive')->get();
        // $books = Book::where('status', '!=', 'not available')->get();
        $log_data = RentLogs::with(['user', 'book'])->where('verification', '=', 'Disetujui')->get();
        return view('return.return-book', ['log_data' => $log_data, 'count_data' => $countData]);
    }

    public function show($id)
    {
        $detail = RentLogs::with(['user', 'book'])->where('id', $id)->first();
        if (Auth::user()) {
            if (Auth::user()->role_id == 1) {
                return view('return.return-approve', ['detail' => $detail]);
            }else {
                return view('list.book-user-detail', ['detail' => $detail]);
            }
        }
    }

    public function saveReturnBook(Request $request, $id)
    {
        // dd(request()->all());
        $borrow = RentLogs::with(['user', 'book'])->where('id', $id)->first();
        
        $verification = [
            'verification' => $request['verification']
        ];

        $borrow->actual_return_date = Carbon::now()->toDateString();
        
        // $status_created = [
        //     'verification' => $request['verification'],
        //     'created_at' => now(),
        // ];

        $stockPlus = [
            'stock' => $borrow->book->stock + 1,
        ];

        // $stockPlus = [
        //     'stock' => $booking->book->stock + 1,
        // ];

        $borrow->update($verification);
        $borrow->book->update($stockPlus);
        $borrow->save();

            // else if ($request['status'] == 'Dikembalikan') {
            //     $borrow->update($status);
            //     $borrow->book->update($stockPlus);
            // }

        return redirect('/return-book')->with('status', 'Return Book Success');
    
    }
}
