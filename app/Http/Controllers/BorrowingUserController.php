<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingUserController extends Controller
{
    public function userRental(Request $request)
    {
        
        $rentlogs = RentLogs::with(['user', 'book'])
            ->where('user_id', Auth::user()->id)
            ->whereRelation('book', 'deleted_at', '=', null)
            ->whereRelation('user', 'deleted_at', '=', null)
            ->get();
        return view('rent-logs.user-rental', ['rent_logs' => $rentlogs]);
    }

    public function borrowing(Request $request)
    {
        // dd(request()->all());
        $validate = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'verification' => 'required',
            'return_date' => 'required'
            // 'code' => 'required',
        ]);
        $request['rent_date'] = Carbon::now()->toDateString();

        $borrow = RentLogs::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'verification' => $request->verification,
            'return_date' => $request->return_date,
            'rent_date' => $request->rent_date,
        ]);
        // RentLogs::create($validate);
        return redirect('/')->with('status', 'Borrow Book Success');
    }
    
}
