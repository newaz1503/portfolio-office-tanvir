<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        return view('frontend.profile.index');
    }
    public function profile_update(Request $request){
        $profile = User::find(Auth::id());
         $profile->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
         ]);
         Toastr::success('Profile updated successfully');
         return back();
    }
    public function password_update(Request $request)
    {
        $request->validate([
            'current_password' => ['required','min:6'],
            'password' => ['required','min:6', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            Toastr::success('Success','Password Updated Successfully');
            Auth::logout();
            return redirect('/');
        }else{
            Toastr::error('Error','Current Password does not match with Old Password');
            return back();

        }
    }

}
