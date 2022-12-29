<?php

namespace App\Http\Controllers\Api;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiActionLogController extends Controller
{
    // set action log
    public function setActionLog(Request $request){
        $data = [
            'user_id' => $request->userId,
            'post_id' => $request->postId,
        ];

        ActionLog::create($data);

        $postData = ActionLog::where('post_id', $request->postId)->get();

        return response()->json([
            'post' => $postData
        ]);
    }
}
