<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->title) {
            $books = Book::where('title', 'like', '%'.$request->title.'%')
                         ->orwhere('book_code','like','%'.$request->title.'%')
                         ->paginate(8);
            $countData = Book::count();
        } elseif ($request->category) {
            $books = Book::whereHas('categories', function($q) use($request) {
                        $q->where('categories.id', $request->category);
                        })->paginate(8);
            $countData = Book::count();
        }
        else {
            $books = Book::orderBy('book_code')->paginate(8);
            $countData = Book::count();
        }
        return view ('list.book-list', ['books' => $books, 'categories' => $categories, 'count_data' => $countData]);
    }
    
}
