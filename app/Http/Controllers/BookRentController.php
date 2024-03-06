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

    public function show()
    {
        # code...
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
       
    public function update(Request $request)
    {
        $status = [
            'status' => $request['status']
        ];

        $status_created = [
            'status' => $request['status'],
            'created_at' => now(),
        ];

        $stockMin = [
            'stock' => $booking->book->stock - 1,
        ];

        $stockPlus = [
            'stock' => $booking->book->stock + 1,
        ];

        if ($booking->book->stock > 0) {
            if ($request['status'] == 'Disetujui') {
                $booking->update($status_created);
                $booking->book->update($stockMin);
            } else if ($request['status'] == 'Ditolak') {
                $booking->update($status);
            } else if ($request['status'] == 'Dikembalikan') {
                $booking->update($status);
                $booking->book->update($stockPlus);
            }
        } else {
            if ($request['status'] == 'Ditolak') {
                $booking->update($status);
            } else if ($request['status'] == 'Dikembalikan') {
                $booking->update($status);
                $booking->book->update($stockPlus);
            } else {
                return redirect()->back()->with('failed', 'Stock buku habis, tidak bisa menyetujui peminjaman!');
            }
        }

        return redirect('/admin/booking');
    
    }

    public function returnBook()
    {
        $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 3)->where('status', '!=', 'inactive')->get();
        $books = Book::where('status', '!=', 'in stock')->get();
        return view('return.return-book', ['users' => $users, 'books' => $books]);
    }

    public function saveReturnBook(Request $request)
    {
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();

        if($countData == 1) {
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $book = Book::findOrFail($request->book_id);
            $book->status = 'in stock';
            $book->save();
            $rentData->save();

            Session::flash('message', 'The Book is returned successfull');
            Session::flash('alert-class', 'alert-success');
            if(Auth::user()->role_id == 1) {
                return redirect('/return-book');
            }else{
                return redirect('/book-return/officer');
            }
        }
        else {
            Session::flash('message', 'There is error in process');
            Session::flash('alert-class', 'alert-danger');
            if(Auth::user()->role_id == 1) {
                return redirect('/return-book');
            }else{
                return redirect('/book-return/officer');
            }
        }
    }
}
