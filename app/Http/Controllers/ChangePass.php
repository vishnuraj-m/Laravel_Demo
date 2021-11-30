<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    public function CPassword(){
        return view('admin.body.change_pass');
    }



    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPasswprd = Auth::user()->password;
        if(Hash::check($request -> oldpassword,$hashedPasswprd)){
            $user = User::find(Auth::id());
            $user -> password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password Is Changed Successfully');
        }else{
            return redirect()->back()->with('error','Current Password is Invalid');
        }
    }


    public function ProUpdate(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }



    public function UpdateProfile(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user -> name =$request['name']; 
            $user -> email =$request['email'];     
            $user -> Save();
            return redirect()->back()->with('success', 'User Profile Updated Successfully');  
        }else{
            return redirect()->back();
        }

    }
}
