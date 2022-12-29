<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiPostController extends Controller
{
    // get all post
    public function allPost()
    {
        $post = Post::select('categories.*', 'posts.*')
                    ->join('categories', 'posts.category_id', 'categories.category_id')
                    ->get();

        return response()->json([
            'post' => $post,
        ]);
    }

    // search post
    public function postSearch(Request $request){
        $post = Post::where('post_title', 'LIKE', '%'.$request->key.'%')->get();

        return response()->json([
            'searchData' => $post
        ]);
    }

    // post details
    public function postDetails(Request $request){
        $id = $request->postId;
        $post = Post::where('post_id', $id)->first();

        return response()->json([
            'post' => $post,
        ]);
    }
}
