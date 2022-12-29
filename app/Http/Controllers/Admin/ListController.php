<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    // list page
    public function index(){
        $data = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->get();
        return view('admin.list.index', compact('data'));
    }

    // delete account
    public function deleteAccount($id){
        User::where('id', $id)->delete();

        return back()->with(['deleted' => 'Account has been deleted!']);
    }

    // search
    public function search(Request $request){
        $searchData = $request->searchData;

        $data = User::where('name', 'LIKE', '%'.$searchData.'%')
                    ->orWhere('email', 'LIKE', '%'.$searchData.'%')
                    ->orWhere('phone', 'LIKE', '%'.$searchData.'%')
                    ->orWhere('address', 'LIKE', '%'.$searchData.'%')
                    ->orWhere('gender', 'LIKE', '%'.$searchData.'%')
                    ->get();

        return view('admin.list.index', compact('data'));
    }
}
