<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // category page
    public function index(){

        $data = Category::get();

        return view('admin.category.index', compact('data'));
    }

    // category create
    public function create(Request $request){
        $validator = $this->categoryValidation($request);

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = [
            'category_title' => $request->categoryName,
            'description' => $request->description,
        ];

        Category::create($data);

        return back();
    }

    // delete category
    public function delete($id){
        Category::where('category_id', $id)->delete();

        return back()->with(['deleted' => 'Category has been deleted!']);
    }

    // search category
    public function search(Request $request){
        $data = Category::where('category_title', 'LIKE', '%'.$request->searchData.'%')->get();

        return view('admin.category.index', compact('data'));
    }

    // edit page
    public function editPage($id){
        $data = Category::where('category_id', $id)->first();

        return view('admin.category.editPage', compact('data'));
    }

    // edit process
    public function edit(Request $request, $id){
        $validator = $this->categoryValidation($request);

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = [
            'category_title' => $request->categoryName,
            'description' => $request->description,
        ];

        Category::where('category_id', $id)->update($data);

        return redirect('admin/category/list')->with(['updated' => 'Category information updated!']);
    }

    // category validation
    private function categoryValidation($request){
        return Validator::make($request->all(), [
            'categoryName' => 'required',
            'description' => 'required',
        ]);
    }
}
