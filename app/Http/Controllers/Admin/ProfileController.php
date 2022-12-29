<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // profile page
    public function index(){

        $data = User::select('id', 'name', 'email', 'phone', 'address', 'gender')->where('id', Auth::user()->id)->first();

        return view('admin.profile.index')->with(compact('data'));
    }

    // update admin account
    public function updateAdmin(Request $request){
        $updateData = $this->getUpdateData($request);

        $validator = $this->validation($request);

        // Return the message
        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', Auth::user()->id)->update($updateData);

        return back()->with(['success' => 'Account Information Updated!']);
    }

    // change password page
    public function changePasswordBlade(){
        return view('admin.profile.changePassword');
    }

    // change password process
    public function changePassword(Request $request){

        $validator = $this->changePassValidation($request);

        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $oldPass = $request->oldPass;
        $newPass = $request->newPass;
        $confirmPass = $request->confirmPass;
        $dbPass = User::select('password')->where('id', Auth::user()->id)->first();

        if(Hash::check($oldPass, $dbPass['password'])){
            if(strlen($newPass) > 6 && strlen($confirmPass) > 6){
                if($newPass === $confirmPass){
                    $hashPass = Hash::make($confirmPass);
                    User::where('id', Auth::user()->id)->update(['password' => $hashPass]);
                } else{
                    return back()->with(['new&confirm' => 'New Password and Confirm Password does not match!']);
                }
            } else{
                return back()->with(['longer' => "New Password must longer than 8 letters"]);
            }
        } else{
            return back()->with(['notMatch' => 'These credentials do not match our records.']);
        }

        return back();
    }

    // get update data
    private function getUpdateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
    }

    // validation
    private function validation($request){
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            // 'phone' => 'required',
            // 'address' => 'required',
            // 'gender' => 'required'
        ]);

        return $validator;
    }

    // password validation
    private function changePassValidation($request){
        return Validator::make($request->all(), [
            'oldPass' => 'required',
            'newPass' => 'required',
            'confirmPass' => 'required',
        ]);
    }
}
