<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ApiCategoryController extends Controller
{
    // category
    public function category()
    {
        $categoryData = Category::get();

        return response()->json([
            'category' => $categoryData,
        ]);
    }

    // search category
    public function categorySearch(Request $request)
    {
        $category = Category::select('posts.*')
            ->join('posts', 'categories.category_id', 'posts.category_id')
            ->where('categories.category_title', 'LIKE', '%'.$request->key.'%')
            ->get();

        return response()->json([
            'categorySearch' => $category,
        ]);
    }
}
