<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::where('role_id', '!=', 1)->count();
        $data = RentLogs::with(['user', 'book'])->get();
        $borrowedCount = RentLogs::where('actual_return_date', null)->count();
        $returnedCount = RentLogs::where('actual_return_date', '!=', null)->count();
        $countData = RentLogs::count();
        return view('dashboard.dashboard', ['book_count' => $bookCount, 'category_count' => $categoryCount, 'user_count' => $userCount, 'data' => $data, 'borrowed_count' => $borrowedCount, 'count_data' => $countData, 'returned_count' => $returnedCount]);
    }
}
