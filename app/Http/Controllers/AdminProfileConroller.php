<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class AdminProfileConroller extends Controller
{
    public function EditProfile()
    {
        return response()->view('cms.admin.admin_profile_view');
    }  
    public function profileUpdate(Request $request){
        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255'
        ]);
        $user =Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('message','Profile Updated');
    }
}
