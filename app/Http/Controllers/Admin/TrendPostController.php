<?php

namespace App\Http\Controllers\Admin;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TrendPostController extends Controller
{
    // trend post page
    public function index(){
        $data = ActionLog::select('action_logs.*', 'posts.*', DB::raw('COUNT(action_logs.post_id) as postCount'))
                    ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
                    ->groupBy('action_logs.post_id')
                    ->get();

        return view('admin.trend_post.index', compact('data'));
    }

    // trend post detail pag
    public function trendPostDetails($id){
        $data = ActionLog::select('action_logs.*', 'posts.*')
                    ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
                    ->where('actionLog_id', $id)
                    ->first();
        // dd($data->toArray());
        return view('admin.trend_post.details', compact('data'));
    }
}
