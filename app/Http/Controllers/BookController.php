<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $countData = Book::count();

        if($request->has('search')) {
            $books = Book::with('categories')->where('title','like','%'.$request->search.'%')
                         ->orwhere('book_code','like','%'.$request->search.'%')
                         ->paginate(10);
        }else{
            $books = Book::with('categories')->paginate(10);
        }

        return view('books.books', ['books' => $books, 'count_data' => $countData]);
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();
        if (Auth::user()) {
            if (Auth::user()->role_id == 1) {
                return view('books.book-detail', ['book' => $book]);
            }else {
                return view('list.book-user-detail', ['book' => $book]);
            }
        }
        else {
        return view('list.book-user-detail', ['book' => $book]);
        }
    }

    public function add()
    {
        $categories = Category::all();
        return view ('books.book-add', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:255',
            'title' => 'required|max:255',
            'publisher' => 'required|max:225',
            'author' => 'required|max:255',
            'stock' => 'required|max:4|min:1',
            'image' => 'image|mimes:jpeg,png,jpg|max:5048',
            'publication_date' => 'required',
        ]);

        $newName = '';
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }
        
        $request['cover'] = $newName;
        $book = Book::create([
            'book_code' => $request->book_code,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'page' => $request->page,
            'stock' => $request->stock,
            'publisher' => $request->publisher,
            'slug' => $request->slug,
            'publication_date' => $request->publication_date,
            'cover' => $request->cover,
        ]);
        $book->categories()->sync($request->categories);
        return redirect('/book')->with('status', 'Books Added Success');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view ('books.book-edit', ['categories' => $categories, 'book' => $book]);
    }

    public function update(Request $request, $slug)
    {
        
        if($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'.'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }

        $book = Book::where('slug', $slug)->first();
        $book->update($request->all());

        if($request->categories) {
            $book->categories()->sync($request->categories);
        }

        return redirect('/book')->with('status', 'Books Updated Success');
    }

    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('books.book-delete', ['book' => $book]);
    }

    public function destroy($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();
        return redirect('/book')->with('status', 'Book Deleted Success');
    }

    public function deletedBook()
    {
        $deletedBooks = Book::onlyTrashed()->paginate(10);
        $countData = Book::onlyTrashed()->count();
        return view ('books.book-deleted-list', ['deletedBooks' => $deletedBooks,'count_data' => $countData]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();
        return redirect('/book/deleted')->with('status', 'Book Restore Success');
    }
}
