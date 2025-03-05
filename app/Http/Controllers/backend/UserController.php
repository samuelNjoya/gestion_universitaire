<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

   public function my_account(){
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['meta_title'] = "my account";
        return view('backend.my_account',$data);
   }

   public function update_account(Request $request){

       $user = User::getSingle(Auth::user()->id);
       $user->name = trim($request->name);
       
       if(Auth::user()->is_admin != 3)
       {
        $user->last_name = trim($request->last_name);
       }

       if(!empty($request->file('profile_pic'))){
        $ext = $request->file('profile_pic')->getClientOriginalExtension();
        $file = $request->file('profile_pic');
        $randomStr = date('Ymdhis').Str::random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/profile/', $filename);

        $user->profile_pic = $filename;
      
    }

    $user->save();

    return redirect()->back()->with('success','Account successifuly updated');
   }


    public function change_password(){
        $data['meta_title'] = "Change password";
         return view('backend.change_password',$data);
    }

    public function update_password(Request $request)
    {
       if($request->new_password == $request->confirm_password)
       {
          $user = User::getSingle(Auth::user()->id);
          if(Hash::check($request->old_password, $user->password))
          {
             $user->password = Hash::make($request->new_password);
             $user->save();

             return redirect()->back()->with('success','password successifuly updated');
          }
          else
          {
            return redirect()->back()->with('error','Old password is not correct');
          }
       }
       else
       {
        return redirect()->back()->with('error','New password and Confirm password does not match');
       }
    }
}
