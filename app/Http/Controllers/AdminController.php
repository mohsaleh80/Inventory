<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //


    public function profile(Request $request)
    {

         $id = Auth::user()->id;
         $adminData = User::find($id);

         return view('admin.admin_profile_view', compact('adminData'));


    } // End Method

    public function editProfile(Request $request)
    {

        $id = Auth::user()->id;
        $editData = User::find($id);

        return view('admin.admin_profile_edit', compact('editData'));
         


    } // End Method


    public function updateProfile(Request $request){

        $id = Auth::user()->id;
        $Data = User::find($id);

        //upload Image
        $filename="";
        if($request->file('upload-image')){
            $file= $request->file('upload-image');
            $filename= date('YmdHi')."_".$file->getClientOriginalName();
            $file-> move(public_path('backend/assets/images/users'), $filename);
            // save to DB
            $Data['image']= 'backend/assets/images/users/'.$filename;
        }

        // save to DB
       // $image = 'backend/assets/images/users/'.$filename;
        //$Data->image = $image;
        
        $Data->name = $request->name;
        $Data->email = $request->email;

        $Data->save();
       
        $notification = array(
            'message' => 'Admin Profile Updated Successfully', 
            'alert-type' => 'success'
        );

         return redirect()->route('admin.profile')->with($notification);

    }//end method


    public function changePassword(){

        return view('admin.admin_change_password');

    }//end method

    public function updatePassword(Request $request){


        $request->validate([
            'old_password' => 'required|min:8',
             Hash::make($request->old_password)=> 'exists:users,password',
            'new_password'=>'required|min:8|different:old_password',
            'confirm_password'=>'required|min:8|same:new_password'
        ]);

         
        $id= Auth::user()->id;
        $user = User::find($id);

        
        // old password match passowrd in DB for a specific user
        if(Hash::check($request->old_password, $user->password)){
           
            $user->password = Hash::make($request->new_password);
            //save to db
            $user->save();
            $notification = array(
                'message' => 'Admin Passowrd Updated Successfully', 
                'alert-type' => 'success'
            );

            return redirect()->route('admin.profile')->with($notification);

        }else{
            
           
            return redirect()->back()
                             ->withErrors( 'Old Password Is Invalid!');
        }
        

       // session()->flash('message','Admin Passowrd Updated Successfully');

       
        
        
    }//end method


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }// End Method
}
