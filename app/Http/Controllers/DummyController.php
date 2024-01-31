<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class DummyController extends Controller
{
    public function index(Request $request)
    {
        $countData = Book::count();

        if($request->has('search')) {
            $books = Book::with('categories')->where('title','like','%'.$request->search.'%')
                         ->orwhere('book_code','like','%'.$request->search.'%')
                         ->get();
        }else{
            $books = Book::with('categories')->get();
        }

        return view('ui.index', ['books' => $books, 'count_data' => $countData]);
    }

    public function daftar(Request $request)
    {
        $categories = Category::all();

        if ($request->title) {
            $books = Book::where('title', 'like', '%'.$request->title.'%')
                         ->paginate(3);
            $countData = Book::count();
        } elseif ($request->category) {
            $books = Book::whereHas('categories', function($q) use($request) {
                        $q->where('categories.id', $request->category);
                        })->paginate(3);
            $countData = Book::count();
        }
        else {
            $books = Book::paginate(3);
            $countData = Book::count();
        }
        return view ('ui.daftar', ['books' => $books, 'categories' => $categories, 'count_data' => $countData]);
    }

    public function dummy()
    {
        $books = Book::all();
        return view ('ui.detail', ['books' => $books]);
    }

}
