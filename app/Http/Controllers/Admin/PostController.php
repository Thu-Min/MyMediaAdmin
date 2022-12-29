<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // post page
    public function index(){
        $categoryData = Category::get();

        $postData = Post::get();

        return view('admin.post.index', compact('categoryData', 'postData'));
    }

    // create post
    public function createPost(Request $request){
        $validator = $this->postValidation($request);

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        if(!empty($request->image)){
            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postImage', $fileName);

            $data = $this->postData($request, $fileName);
        } else{
            $data = $this->postData($request, NULL);
        }

        Post::create($data);

        return back()->with(['created' => 'New Post Has Been Created!']);
    }

    // delete post
    public function deletePost($id){
        $data = Post::where('post_id', $id)->first();
        $dbImage = $data['image'];

        Post::where('post_id', $id)->delete();

        if(File::exists(public_path().'/postImage/'.$dbImage)){
            File::delete(public_path().'/postImage/'.$dbImage);
        }

        return back()->with(['deleted' => 'Post Has Been Deleted!']);
    }

    // update post page
    public function updatePost($id){
        $categoryData = Category::get();
        $postData = Post::where('post_id', $id)->first();
        $post = Post::get();

        return view('admin.post.update', compact('categoryData', 'postData', 'post'));
    }

    // update post process
    public function updatePostProcess($id, Request $request){
        $validator = $this->postValidation($request);

        if($validator->fails()){
            return back()
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = $this->updateData($request);

        if(isset($request->image)){
            // get from client
            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();

            $data['image'] = $fileName;

            // get image from database
            $postData = Post::where('post_id', $id)->first();
            $dbImage = $postData['image'];

            // delete old image
            if(File::exists(public_path().'/postImage/'.$dbImage)){
                File::delete(public_path().'/postImage/'.$dbImage);
            }

            // add new image
            $file->move(public_path().'/postImage', $fileName);

            Post::where('post_id', $id)->update($data);
        } else{
            Post::where('post_id', $id)->update($data);
        }

        return redirect('/admin/post')->with(['updated' => 'Post Has Been Updated!']);
    }

    // post validation
    private function postValidation($request){
        return Validator::make($request->all(), [
            'postTitle' => 'required',
            'description' => 'required',
            'category' => 'required',
        ],[
            // 'postTitle.required' => 'Hi'
        ]);
    }

    // get post data
    private function postData($request, $fileName){
        return [
            'post_title' => $request->postTitle,
            'description' => $request->description,
            'image' => $fileName,
            'category_id' => $request->category,
        ];
    }

    // get update post data
    private function updateData($request){
        return [
            'post_title' => $request->postTitle,
            'description' => $request->description,
            'category_id' => $request->category,
            'updated_at' => Carbon::now(),
        ];
    }
}
