<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Problem;
use App\Models\SModel;
use App\Models\SparePart;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth('admin')->check()) {
            $technical=User::Where('user_type', '=', 'technical')->get();
            $agent=User::Where('user_type', '=', 'agent')->get();
            $customer=User::Where('user_type', '=', 'customers')->get();
            $users = User::all();
            $user = User::latest()->limit(10)->get();
            $brand = Brand::all();
            $category = Category::all();
            $spare_part = SparePart::all();
            $model = SModel::all();
            $s_model = SModel::latest()->limit(10)->get();
            $problem = Problem::all();
            $problems = Problem::latest()->limit(10)->get();
            $usermodel=UserModel::all();
            return view('cms.dashboard.dashboard-admin', [
                'users' => $users, 'spare_part' => $spare_part, 'brand' => $brand, 'category' => $category, 'model' => $model, 'problem' => $problem, 'user' => $user, 's_model' => $s_model,
                'problems' => $problems,'usermodel' =>$usermodel,'technical'=> $technical,'agent'=>$agent,'customer'=>$customer
            ]);
        }else{
            if (User::Where('user_type', '=', 'customer')) {
                // if (auth('user')->user_type = 'customers'){

                $users = User::all();
                $user = User::latest()->limit(10)->get();
                $brand = Brand::all();
                $category = Category::all();
                $spare_part = SparePart::all();
                $model = SModel::all();
                $s_model = SModel::latest()->limit(10)->get();
                $problem = Problem::all();
                $problems = Problem::latest()->limit(10)->get();
                return view('cms.dashboard.dashboard-technical', [
                    'users' => $users, 'spare_part' => $spare_part, 'brand' => $brand, 'category' => $category, 'model' => $model, 'problem' => $problem, 'user' => $user, 's_model' => $s_model,
                'problems' => $problems]);
            }elseif (User::Where('user_type', '=', 'customer')) {
                $brand = Brand::all();
                $category=Category::all();
                $categories=Category::latest()->limit(10)->get();
                $model=SModel::all();
                $s_model=SModel::latest()->limit(10)->get();
                $spare_part = SparePart::all(); 
                return view('cms.dashboard.dashboard-user',['brand'=>$brand
                ,'category'=>$category,'model'=>$model,'spare_part'=>$spare_part]);
            }else{
                $users = User::all();
                $user = User::latest()->limit(10)->get();
                $brand = Brand::all();
                $category = Category::all();
                $spare_part = SparePart::all();
                $model = SModel::all();
                $s_model = SModel::latest()->limit(10)->get();
                $problem = Problem::all();
                $problems = Problem::latest()->limit(10)->get();
                return view('cms.dashboard.dashboard-agent', [
                    'users' => $users, 'spare_part' => $spare_part, 'brand' => $brand, 'category' => $category, 'model' => $model, 'problem' => $problem, 'user' => $user, 's_model' => $s_model,
                'problems' => $problems]);
            }
        }
    }
}
