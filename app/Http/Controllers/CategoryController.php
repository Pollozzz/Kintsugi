<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $language = app()->getLocale();

        $advertisements = $category->advertisements()
            ->where('is_accepted', true)
            ->orderByRaw(
                'CASE WHEN language = ? THEN 0 ELSE 1 END',
                [$language]
            )
            ->orderBy('updated_at', 'desc')->get();
        //  ->paginate(8);
        $categories = Category::all();

        return view('categories.show', compact('category', 'advertisements', 'categories'));
    }
}
