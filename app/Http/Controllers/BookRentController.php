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
            'status' => $borrow->book->status = 'not available',
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

        if ($borrow->book->stock == 1) {
            if ($request['verification'] == 'Disetujui') {
                $borrow->update($verification);
                $borrow->book->update($stockMin);
                $borrow->book->update($status);
            } else if ($request['verification'] == 'Ditolak') {
                $borrow->update($verification);
            } 
            // else if ($request['status'] == 'Dikembalikan') {
            //     $borrow->update($status);
            //     $borrow->book->update($stockPlus);
            // }
        }else if ($borrow->book->stock > 1){
            if ($request['verification'] == 'Disetujui') {
                $borrow->update($verification);
                $borrow->book->update($stockMin);
            } else if ($request['verification'] == 'Ditolak') {
                $borrow->update($verification);
            } 
        }else {
            if ($request['verification'] == 'Ditolak') {
                $borrow->update($verification);
                // $borrow->book->update($status);
            }
            //  else if ($request['status'] == 'Dikembalikan') {
            //     $borrow->update($status);
            //     $borrow->book->update($stockPlus);
            // } 
            else {
                return redirect('/borrow-book')->with('failed', 'Stock buku habis, tidak bisa menyetujui peminjaman!');
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

        $borrow->actual_return_date = Carbon::now()->toDateString();
        
        // $dueDate = $borrow->actual_return_date;
        // $status_created = [
        //     'verification' => $request['verification'],
        //     'created_at' => now(),
        // ];
        $dueDate = Carbon::createFromFormat('Y-m-d', $borrow->return_date);

        $returnDate = Carbon::now();

        if ($dueDate < $returnDate ) {
            $diffDays = $dueDate->diffInDays($returnDate);
        }else {
            $diffDays = $dueDate->diffInDays($returnDate);
            $diffDays = $diffDays * -1;
        }
        // dd($diffDays);

        $mulctPrice = 1000;

        if ($diffDays <= 0) {
            $mulct = 0;
        }else {
            $mulct = max(0, $diffDays) * $mulctPrice;
        }

        $verification = [
            'verification' => $request['verification']
        ];

        $stockPlus = [
            'stock' => $borrow->book->stock + 1,
        ];

        $status = [
            'status' => $borrow->book->status = 'in stock',
        ];
        // $stockPlus = [
        //     'stock' => $booking->book->stock + 1,
        // ];
        if ($borrow->book->stock == 0) {
            $borrow->update($verification);
            $borrow->book->update($stockPlus);
            $borrow->book->update($status);
            $borrow->total_mulct = $mulct;
            $borrow->save();
        }else{
            $borrow->update($verification);
            $borrow->book->update($stockPlus);
            $borrow->total_mulct = $mulct;
            $borrow->save();
        }

            // else if ($request['status'] == 'Dikembalikan') {
            //     $borrow->update($status);
            //     $borrow->book->update($stockPlus);
            // }

        return redirect('/return-book')->with('status', 'Return Book Success');
    
    }
}
