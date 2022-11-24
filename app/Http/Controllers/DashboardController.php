<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\SparePart;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(){
    if (auth()->user() == 'admin') {
        $users = User::all();
        $spare_part = SparePart::all(); 
        $brand = Brand::all();
        return view('cms.dashboard-admin',['users'=>$users,'spare_part'=>$spare_part,'brand'=>$brand]);
    }elseif(auth()->user() == 'user') {
        return view('cms.dashboard.user');

    }
   }
}
