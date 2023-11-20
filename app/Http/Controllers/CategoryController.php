<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $countData = Category::count();

        if($request->has('search')) {
            $categories = Category::where('name','like','%'.$request->search.'%')
                         ->paginate(10);
        }else{
            $categories = Category::paginate(10);
        }
        
        return view ('categorys.category', ['categories' => $categories, 'count_data' => $countData]);
    }

    public function add(Request $request)
    {
        return view ('categorys.category-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::create($request->all());
        return redirect('/category')->with('status', 'Category added Success');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view ('categorys.category-edit', ['category' => $category]);
    }

    public function update(Request $request,$slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:100',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update($request->all());
        return redirect('/category')->with('status', 'Category Updated Success');
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view ('categorys.category-delete', ['category' => $category]);
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();
        return redirect('/category')->with('status', 'Category Deleted Success');
    }

    public function deletedCategory()
    {
        $deletedCategories = Category::onlyTrashed()->paginate(10);
        
        $countData = Category::onlyTrashed()->count();
        return view ('categorys.category-deleted-list', ['deletedCategories' => $deletedCategories, 'count_data' => $countData]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();
        return redirect('/category/deleted')->with('status', 'Category Restore Success');
    }
}
