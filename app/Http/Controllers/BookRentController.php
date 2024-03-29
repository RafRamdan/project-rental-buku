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
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('role_id', '!=', 3)->where('status', '!=', 'inactive')->get();
        $books = Book::where('status', '!=', 'not available')->get();
        return view('rental.book-rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        $book = Book::findOrFail($request->book_id)->only('status');

        if($book['status'] != 'in stock') {
            Session::flash('message', 'Cannot rent, the book is not avaible');
            Session::flash('alert-class', 'alert-danger');
            if(Auth::user()->role_id == 1) {
                return redirect('/rent-book');
            }else{
                return redirect('/book-rent/officer');
            }
        }
        else{
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)
            ->count();

            if($count >= 3) {
                Session::flash('message', 'Cannot rent, user has reach limit of book');
                Session::flash('alert-class', 'alert-danger');
                if(Auth::user()->role_id == 1) {
                    return redirect('/rent-book');
                }else{
                    return redirect('/book-rent/officer');
                }
            }
            else{
                try {
                    DB::beginTransaction();
                    
                    RentLogs::create($request->all());
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();

                    Session::flash('message', 'Rent book success!!!');
                    Session::flash('alert-class', 'alert-success');
                    if(Auth::user()->role_id == 1) {
                        return redirect('/rent-book');
                    }else{
                        return redirect('/book-rent/officer');
                    } 
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
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
